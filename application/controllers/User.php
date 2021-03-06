<?php

defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class User extends Base
{

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $info = $this->input->request(null, true);
        $data['type'] = $info['type'];
        $this->displayMain($data);
    }

    public function referee()
    {
        $url = site_url('User', 'center');
        $info = $this->input->request(null, true);
        if (is_ajax_post()) {
            $this->AjaxReturn('401', ' 感谢您的热情参与，目前活动名额已满。感谢您对路虎品牌的支持，祝您生活愉快！'); exit;
            $info['name'] = trim($info['name']);
            if(empty($info['name'])) {
                $this->AjaxReturn('401', '用户名不能为空');
                exit;
            }

            if ($info['code'] != get_cookie($info['phone'])) {
                $this->AjaxReturn('401', '验证码不正确');
                exit;
            }
            if (!preg_match("/^1[3-9]\d{9}$/", $info['phone'])) {
                $this->AjaxReturn('403', '电话号码格式不正确');
                exit;
            }

            if(!empty($info['driver_number'])) {
                $res = $this->Users->getUserInfoByDriver($info['driver_number']);
                if($res) {
                    $this->AjaxReturn('401', '当前行驶证已参加过活动');exit;
                }
            }

            if(!empty($info['card_number']) && !validateIDCard($info['card_number'])) {
                $this->AjaxReturn('401', '请填写正确身份证信息');
                exit;
            }

            if(!empty($info['driver_number']) && !preg_match('/^[0-9a-zA-Z]+$/',$info['driver_number'])) {
                $this->AjaxReturn('401', '请填写正确身行驶证信息');
                exit;
            }

            $res = $this->Users->getUserInfoByPhone($info['phone']);
            $token = rand_str(32);
            $openid = get_cookie('openId');
            $open_id = isset($openid) ? $openid : '';
            if ($res) {
                if (is_weixin() && empty($res['open_id'])) {
                    $this->Users->editUserId($res['id'], ['open_id' => $open_id]);
                }
                set_cookie('token', $token);
                $data['token'] = $token;
                $this->Users->editUserUid($res['id'], $data);
                $this->Users->incrementSubmitNum($res['id']);
                $this->AjaxReturn('201', '您已拥有推荐码，点击“推荐进度”查看。', $url);exit;
            }

            $this->AjaxReturn('401', ' 感谢您的热情参与，目前活动名额已满。感谢您对路虎品牌的支持，祝您生活愉快！'); exit;

            $data['name'] = $info['name'];
            $data['phone'] = $info['phone'];
            $data['open_id'] = $open_id;
            $data['driver_number'] = $info['driver_number'];
            $data['driver_json'] = $info['driver_json'];
            $data['card_number'] = $info['card_number'];
            $data['card_json'] = $info['card_json'];
            $data['token'] = $token;
            $data['source'] = get_cookie('source') ? get_cookie('source') : 0;
            $data['created_at'] = NOW_DATE_TIME;
            if(!empty($info['driver_number']) && !empty($info['card_number'])) {
                $data['status'] = 1;
            }
            $uid = $this->Users->addUserOpenId($data);
            $stepModel = new \Xy\Application\Models\StepModel();
            $inviteCode = $stepModel->genId('invite_code');
            $invite_url = site_url('Invite', 'index', array('invite_code' => $inviteCode, 'utm_source' => $data['source']));
            $invite_url = urlencode($invite_url);
            $update['invite_code'] = $inviteCode;
            $update['qr_code_img'] = "http://api.qrserver.com/v1/create-qr-code/?size=117x117&data=$invite_url";
            //生成短连接
            $long_url = site_url('Invite', 'index', array('invite_code' => $inviteCode, 'utm_source' => $data['source']));
            $update['short_url'] = getSinaShortUrl('1555751977',$long_url);
            $sms_notice_obj = new SendSms();
            $ret = $sms_notice_obj->send($data['phone'], $update['short_url'], 2);
            $update['report_result'] = json_encode($ret);
            $this->Users->editUserUid($uid, $update);
            $wb_openid = get_cookie('wb_openId');
            $wb_openid = isset($wb_openid) ? $wb_openid : '';
            $uploadModel = (new \Xy\Application\Models\UploadLogModel());
            $uploadModel->editUploadInfo($uid, $openid, $wb_openid);
            $this->Users->incrementSubmitNum($uid);
            set_cookie('token', $token);
            $url = site_url('Invite', 'share', array('invite_code' => $inviteCode));
            $sql = "select * from `ownerreferral_201812_data`";
            $info = $this->Users->execute($sql);
            $data = $info[0];
            if(date('Y-m-d H:i:s') > $data['time']) {
                $this->AjaxReturn('200', '感谢您参与路虎推荐活动，活动已进入倒计时，目前您依旧可以留资并购车，但礼品数量有限，先到先得，选完即止', $url);exit;
            } else {
                $this->AjaxReturn('200', '活动礼遇将在信息审核通过后进行寄送。确认提交前，请确保信息的准确性。', $url);exit;
            }
        } else {
            if ($this->isLogin()) {
                $url = site_url('User', 'center');
                header('Location:' . $url);
            }
            $this->displayMain();
        }
    }

    public function updateInfo()
    {
        $info = $this->input->request(null, true);
        $id = $info['id'];
        if (!$this->isLogin()) {
            $url = site_url('Index', 'index');
            header('Location:' . $url);
        } else {
            $userInfo = $this->isLogin();
            if($userInfo['id'] != $id){
                $url = site_url('Index', 'index');
                header('Location:' . $url);
            }
        }
        $url = site_url('User', 'center');
        if (is_ajax_post()) {
            if(!validateIDCard($info['card_number'])) {
                $this->AjaxReturn('202', '请填写正确身份证信息');
                exit;
            }

            $info['driver_number'] = trim($info['driver_number']);
            if(empty($info['driver_number'])) {
                $this->AjaxReturn('401', '行驶证不能为空');
                exit;
            }

            $res = $this->Users->getUserInfoByDriver($info['driver_number']);
            if($res && $res['id'] != $id) {
                $this->AjaxReturn('401', '当前行驶证已参加过活动');exit;
            }


            if(!empty($info['driver_number']) && !preg_match('/^[0-9a-zA-Z]+$/',$info['driver_number'])) {
                $this->AjaxReturn('401', '请填写正确身行驶证信息');
                exit;
            }

            $res = $this->Users->getUserInfoByid($id);
            $openid = get_cookie('openId');
            $open_id = isset($openid) ? $openid : '';
            if ($res) {
                if (is_weixin() && empty($res['open_id'])) {
                    $this->Users->editUserId($res['id'], ['open_id' => $open_id]);
                }
            }
            $data['driver_number'] = $info['driver_number'];
            $data['driver_json'] = $info['driver_json'];
            $data['card_number'] = $info['card_number'];
            $data['card_json'] = $info['card_json'];
            if($info['status'] != 3) {
                $data['status'] = 1;
            } else {
                $data['driver_img'] = 1;
            }
            $this->Users->editUserUid($id, $data);
            $this->AjaxReturn('200', '完善资料成功', $url);exit;
        } else {
            $data = $this->Users->getUserInfoByid($id);
            $this->displayMain($data);
        }
    }
    public function center()
    {
        if (!$this->isLogin()) {
            $url = site_url('User', 'referee');
            header('Location:' . $url);
        }
        $data = $this->isLogin();
        if ($data['master_uid'] > 0) {
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
        }
        $this->displayMain($data);
    }

    public function login()
    {
        $info = $this->input->request(null, true);
        if (is_ajax_post()) {
            if ($info['code'] != get_cookie($info['phone'])) {
                $this->AjaxReturn('202', '验证码不正确');
                exit;
            }
            $res = $this->Users->getUserInfoByPhone($info['phone']);
            if ($res) {
                $token = rand_str(32);
                $openid = get_cookie('openId');
                $open_id = isset($openid) ? $openid : '';
                if (is_weixin() && empty($res['open_id'])) {
                    $this->Users->editUserId($res['id'], ['open_id' => $open_id]);
                }
                set_cookie('token', $token);
                if(empty($res['from_invite_code'])) {
                    $url = site_url('User', 'center');
                } else {
                    $url = site_url('Invite', 'index');
                }
                $this->Users->editUserUid($res['id'], ['token' => $token]);
                $this->AjaxReturn('200', '成功', $url);exit;
            } else {
                $url = site_url('User', 'referee');
                $this->AjaxReturn('404', '没有用户信息', $url);exit;
            }
        }
    }

    public function state()
    {
        $result = $this->isLogin();
        if (!$result) {
            $url = site_url('User', 'referee');
            header('Location:' . $url);
            exit;
        }
        if ($result['master_uid'] > 0) {
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
            exit;
        }
        $uid = $result['id'];
        $info = $this->Users->getInviteInfoByUid($uid);
        $shopCarInfo    = new \Xy\Application\Models\ShopCarModel();
        $Reward         = new \Xy\Application\Models\RewardModel();
        $success = 0;
        foreach($info as $k => $v) {
            $carInfo        = $shopCarInfo->getCarInfoByUid($v['id']);
            $rewardCount    = $Reward->getRewardInfoCount($v['id']);
            $state          = isset($carInfo['state']) ? $carInfo['state'] : '';
            if($state == 3 && $result['status'] == 3) {
                $success += 1;
                $info[$k]['state'] = 3;
            } else {
                $info[$k]['state'] = $state > 0 ? 1 : 0;
            }
            $info[$k]['reward_count']     = $rewardCount;
        }

        //var_dump($info);
        $result['invite_info']   = $info;
        $result['success_count'] = $success;
        $result['reward_count']  = $Reward->getCarInfoCount($result['id']);
        $reward_info = $Reward->getAllUserRewardInfo($result['id']);
        $result['reward_count']  = count($reward_info);
        if($result['reward_count'] > 0) {
            $Item         = new \Xy\Application\Models\ItemModel();
            foreach($reward_info as $k => $v){
                $ret = $Item->getItemInfoByType($v['type']);
                $result['reward_user'][$k]['name'] = $ret['name'];
            }
        }
        $this->displayMain($result);
    }

    public function reward()
    {
        $result = $this->isLogin();
        if (!$result) {
            $url = site_url('User', 'referee');
            header('Location:' . $url);
            exit;
        }
        if ($result['master_uid'] > 0) {
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
            exit;
        }
        $Item         = new \Xy\Application\Models\ItemModel();
        $item = $Item->getItemAllInfo();
        $result['item1'] = $item[0]['num'];
        $result['item2'] = $item[1]['num'];
        $result['item3'] = $item[2]['num'];
        $this->displayMain($result);
    }

    public function mgs()
    {
        $result = $this->isLogin();
        if (!$result) {
            $url = site_url('User', 'referee');
            header('Location:' . $url);
            exit;
        }
        if ($result['master_uid'] > 0) {
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
            exit;
        }
        $this->displayMain($result);
    }

    public function site()
    {
        $result = $this->isLogin();
        if (!$result) {
            $url = site_url('User', 'referee');
            header('Location:' . $url);
            exit;
        }
        if ($result['master_uid'] > 0) {
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
            exit;
        }
        $info = $this->input->request(null, true);
        $type = $info['type'];
        if (is_ajax_post()) {
            $Reward         = new \Xy\Application\Models\RewardModel();
            $Item           = new \Xy\Application\Models\ItemModel();
            $res = $Item->getItemInfoByType($type);
            if($res['num'] == 0) {
                $this->AjaxReturn('403', '当前礼品已领完请选择其他礼品');exit;
            }
            $rewardCount    = $Reward->getRewardInfoCount($result['id']);
            if($rewardCount > 1) {
                $this->AjaxReturn('403', '你已经领取过奖励了');exit;
            }

            $info['site_name'] = trim($info['site_name']);
            if(empty($info['site_name'])) {
                $this->AjaxReturn('401', '用户名不能为空');
                exit;
            }

            $info['site'] = trim($info['site']);
            if(empty($info['site'])) {
                $this->AjaxReturn('401', '收货地址不能为空');
                exit;
            }

            $data['site_name']  = $info['site_name'];
            $data['site_phone'] = $info['site_phone'];
            if (!preg_match("/^1[3-9]\d{9}$/", $data['site_phone'])) {
                $this->AjaxReturn('403', '电话号码格式不正确');exit;
            }
            $data['province']   = $info['province'];
            $data['city']       = $info['city'];
            $data['site']       = $info['site'];
            $data['type']       = $type;
            $data['uid']        = $result['id'];
            $info = $this->Users->getInviteSuccByUid($result['id']);
            if(!isset($info[$rewardCount]['id'])) {
                $this->AjaxReturn('403', '你已经领取过奖励了');exit;
            }
            $data['reward_uid'] = $info[$rewardCount]['id'];
            $data['create_dt'] = NOW_DATE_TIME;
            $Reward = new \Xy\Application\Models\RewardModel();
            $res = $Reward->addUserReward($data);
            if($res) {
                if($type == 3) {
                    $title = '您已选择延保服务，工作人员将在10个工作日之内联系您确认延保服务具体事宜。如有疑问，可致电400-820-0187。';
                } else {
                    $title = '您已成功提交收货信息，工作人员将在14个工作日之内（春节期间可能延迟哦）寄送礼品。如有疑问，可致电400-820-0187。';
                }
                $sql = 'UPDATE ownerreferral_201812_items SET num = `num` - 1 WHERE item_id = '.$type;
                $Reward->execute($sql);
                $this->AjaxReturn('200', $title, site_url('User', 'state'));
            } else {
                $this->AjaxReturn('404', '选择礼物失败');
            }
        }
        $city = new \Xy\Application\Models\CityModel();
        $province = $city->getCityInfo(0);
        $city_arr = [];
        foreach($province as &$v) {
            $info = $city->getCityInfoByCity($v['city_id']);
            foreach($info as $val) {
                $city_arr[$v['city_name']][] = $val['city_name'];
            }
        }
        //var_dump($city_arr);exit;
        $result['city_arr'] = json_encode($city_arr);
        $result['type'] = $type;
        $this->displayMain($result);
    }
}

