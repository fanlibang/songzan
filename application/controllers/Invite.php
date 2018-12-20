<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/17
 * Time: 下午3:46
 */
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Base.php';

class Invite extends Base
{

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 被邀请人首页
     */
    public function index()
    {
        $info = $this->input->request(null, true);
        $inviteCode = $info['invite_code'] ? $info['invite_code'] : '';

        $url = site_url('Invite', 'info', array('invite_code' => $inviteCode));
        $result = $this->isLogin();
        if ($result) {
            header('Location:' . $url);
            exit;
        }
        $carInfo = new \Xy\Application\Models\CarInfoModel();
        if (is_ajax_post()) {
            $openId = get_cookie('openId');
            $data['open_id'] = isset($openId) ? $openId : '';
            $code = $info['code'];
            $data['phone'] = $info['phone'];
            if (!preg_match("/^1[3-9]\d{9}$/", $data['phone'])) {
                $this->AjaxReturn('403', '电话号码格式不正确');
                exit;
            }
            if (empty($inviteCode)) {
                $this->AjaxReturn('403', '邀请码格式不正确');
                exit;
            }
            if ($info['car_id'] == 0) {
                $this->AjaxReturn('403', '请选择车型');
                exit;
            }
            /**
            if (!in_array($info['car_id'], [1, 2])) {
                $this->AjaxReturn('203', '感谢您的选择，此次活动需在成功购买路虎揽胜、路虎揽胜运动版后，方可赢取至瑧礼包。');
                exit;
            }
             */
            $data['name'] = $info['name'];
            $data['from_invite_code'] = $info['invite_code'];
            $data['car_id'] = $info['car_id'];
            $data['created_at'] = NOW_DATE_TIME;
            $masterUserInfo = $this->Users->getUserInviteCode($inviteCode);
            if (empty($masterUserInfo)) {
                $this->AjaxReturn('401', '邀请人不存在');
                exit;
            }
            if ($code != get_cookie($data['phone'])) {
                $this->AjaxReturn('402', '验证码不正确');
                exit;
            }
            $data['master_uid'] = $masterUserInfo['id'];

            $havePhoneInfo = $this->Users->getUserInfoByPhone($data['phone']);
            if ($havePhoneInfo['invite_code'] == $inviteCode) {
                $this->AjaxReturn('403', '活动参与者不可同时注册推荐人和被推荐人，以首次参与活动的身份为准。');
                exit;
            }
            if (!empty($havePhoneInfo)) {
                if (is_weixin() && empty($havePhoneInfo['open_id']) && !empty($data['open_id'])) {
                    $this->Users->editUserId($havePhoneInfo['id'], ['open_id' => $data['open_id']]);
                }
                $this->Users->incrementSubmitNum($havePhoneInfo['id']);
                if ($havePhoneInfo['invite_code'] != $inviteCode) {
                    set_cookie('token', $havePhoneInfo['token']);
                    $this->AjaxReturn('202', '很抱歉，您已有推荐人，如有疑问，可致电400-820-0187。点击下方按钮，查看推荐状态 ', $url);
                    exit;
                }
                set_cookie('token', $havePhoneInfo['token']);
                $this->AjaxReturn('201', '您已参与过活动，请前往个人主页查看最新状态。', $url);
                exit;
            }
            $ret = verify_count($data['name'], 8);
            if (!$ret) {
                $this->AjaxReturn('404', '用户名长度应小于四');
                exit;
            }
            $data['name'] = trim($data['name']);
            if(empty($data['name'])) {
                $this->AjaxReturn('401', '用户名不能为空');
                exit;
            }
            $token = rand_str(32);
            $data['token'] = $token;
            set_cookie('token', $token);
            $data['source'] = get_cookie('source') ? get_cookie('source') : 0;
            $uid = $this->Users->addUserOpenId($data);
            $this->Users->incrementSubmitNum($uid);
            if ($data['car_id'] > 0) {
                $carInfo = $carInfo->getCarInfoByid($data['car_id']);
                $tempData = [
                    'kmi_id'                => $uid,
                    'activity_id'           => 'CRM_Owner_Referral_201812_Test',
                    'name'                  => $info['name'],
                    'mobile'                => $info['phone'],
                    'model_id'              => $carInfo['cid'],
                    'nameplate_of_interest' => $carInfo['alias'],
                    'creation_time'         => NOW_DATE_TIME,
                    'need_lms'              => 1,
                    'other1'                => $masterUserInfo['phone'],
                ];
                $push = new ReportModel();
                $result = $push->reportOwner($tempData);
                $this->Users->editUserId($uid, ['report_result' => $result]);
            }
            $this->AjaxReturn('200', "活动礼遇将根据您所提交的信息进行审核。确认提交前，请确保信息的准确性。<dd>请留意后续客服的电话，给您安排试驾。购车成功后，请返回此页面提交您的购车凭证。</dd>", $url);
            exit;
        }
        $data['car_record'] = $carInfo->getAllCarInfo();
        $data['invite_code'] = $inviteCode;
        $this->displayMain($data);
    }

    /**
     * 被邀请人信息
     */
    public function info()
    {
        $info = $this->input->request(null, true);
        $invite_code = $info['invite_code'] ? $info['invite_code'] : '';
        $result = $this->isLogin();
        if (!$result) {
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
            exit;
        }
        if ($result['master_uid'] == 0) {
            $url = site_url('User', 'center');
            header('Location:' . $url);
            exit;
        }
        $result['invite_diff'] = 0;
        if($invite_code > 0 && $result['from_invite_code'] != $invite_code) {
            $result['invite_diff'] = 1;
        }
        $carInfo = new \Xy\Application\Models\CarInfoModel();
        $result['car_info'] = $carInfo->getCarInfoByid($result['car_id']);
        $this->displayMain($result);
    }

    public function editInfo()
    {
        $result = $this->isLogin();
        if (!$result) {
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
            exit;
        }
        if ($result['master_uid'] == 0) {
            $url = site_url('User', 'center');
            header('Location:' . $url);
            exit;
        }
        $info = $this->input->request(null, true);
        $carInfo = new \Xy\Application\Models\CarInfoModel();
        if (is_ajax_post()) {
            if (empty($info['car_id'])) {
                $this->AjaxReturn('403', '请选择车型');
                exit;
            }
            if (!in_array($info['car_id'], [1, 2])) {
                $this->AjaxReturn('404', '参加本次活动的车型为揽胜或揽胜运动版');
                exit;
            }
            $carInfo = $carInfo->getCarInfoByid($info['car_id']);
            $masterUserInfo = $this->Users->getUserInviteCode($result['from_invite_code']);
            $tempData = [
                'kmi_id'                => $result['id'],
                'activity_id'           => 'CRM_Owner_Referral_201812_Test',
                'name'                  => $result['name'],
                'mobile'                => $result['phone'],
                'model_id'              => $carInfo['cid'],
                'nameplate_of_interest' => $carInfo['alias'],
                'creation_time'         => NOW_DATE_TIME,
                'need_lms'              => 1,
                'other1'                => $masterUserInfo['phone'].'+'.$result['name'],
            ];
            $push = new ReportModel();
            $rsp = $push->reportOwner($tempData);
            $this->Users->editUserId($result['id'], array('report_result' => $rsp, 'car_id' => $info['car_id']));
            $this->AjaxReturn('200', '完善资料成功', site_url('Invite', 'info'));
            exit;
        }
        $result['car_record'] = $carInfo->getAllCarInfo();
        $this->displayMain($result);
    }

    public function share()
    {
        $info = $this->input->request(null, true);
        $inviteCode = $info['invite_code'] ? $info['invite_code'] : '';
        $data = $this->isLogin();
        if (!$data) {
            $url = site_url('Invite', 'index', array('invite_code' => $inviteCode));
            header('Location:' . $url);
            exit;
        }
        if ($data['master_uid'] > 0) {
            $url = site_url('Invite', 'info');
            header('Location:' . $url);
            exit;
        }
        $shareImg = $data['share_img'];
        if (empty($data['share_img'])) {
            $imgPath = HTTP_HOST . STATIC_ASSETS . 'images/bg-5.jpg';
            $bigImg = imagecreatefromstring(file_get_contents($imgPath));
            $qCodeImg = imagecreatefromstring(file_get_contents($data['qr_code_img']));
            list($qCodeWidth, $qCodeHight, $qCodeType) = getimagesize($data['qr_code_img']);
            imagecopymerge($bigImg, $qCodeImg, 315, 1014, 0, 0, $qCodeWidth, $qCodeHight, 100);
            $white = imagecolorallocate($bigImg, 255, 255, 255);
            $font = ROOTPATH . '/assets/common/font/LANDROVER-BOLD.ttf';

            imagettftext($bigImg, 25, 0, 330, 500, $white, $font, $data['invite_code']);

            $savePath = UPLOAD_FILE . time() . '_' . $data['id'] . '_share.jpg';
            imagejpeg($bigImg, $_SERVER['DOCUMENT_ROOT'] . $savePath);

            imagedestroy($bigImg);
            imagedestroy($qCodeImg);

            $shareImg = HTTP_HOST . $savePath;
            $this->Users->editUserId($data['id'], ['share_img' => $shareImg]);
        }
        $data['img_url'] = $shareImg;
        $this->displayMain($data);
    }

    public function state()
    {
        $result = $this->isLogin();
        if (!$result) {
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
            exit;
        }
        if ($result['master_uid'] == 0) {
            $url = site_url('User', 'center');
            header('Location:' . $url);
            exit;
        }
        $shopCarInfo    = new \Xy\Application\Models\ShopCarModel();
        $Reward         = new \Xy\Application\Models\RewardModel();
        $carInfo        = $shopCarInfo->getCarInfoByUid($result['id']);
        $rewardCount    = $Reward->getRewardInfoCount($result['id']);
        $invite_info    = $this->Users->getUserInfoByid($result['master_uid']);
        $result['car_id']           = isset($carInfo['id']) ? $carInfo['id'] : '';
        $result['state']            = isset($carInfo['state']) ? $carInfo['state'] : '';
        $result['status']            = isset($invite_info['status']) ? $invite_info['status'] : '';
        $result['reward_count']     = $rewardCount;
        $this->displayMain($result);
    }

    public function shopCar()
    {
        $result = $this->isLogin();
        if (!$result) {
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
            exit;
        }
        if ($result['master_uid'] == 0) {
            $url = site_url('User', 'center');
            header('Location:' . $url);
            exit;
        }
        $info = $this->input->request(null, true);
        $car_id = $info['car_id'];
        $shopCarInfo = new \Xy\Application\Models\ShopCarModel();
        if (is_ajax_post()) {
            $data['card_front'] = $info['card_front'];
            $data['car_img'] = $info['car_img'];
            $data['other'] = $info['other'];
            if(empty($car_id)) {
                $data['uid'] = $result['id'];
                $data['create_dt'] = NOW_DATE_TIME;
                $res = $shopCarInfo->addUserCar($data);
            } else {
                $data['state'] = 1;
                $res = $shopCarInfo->editUserCar($car_id, $data);
            }
            if($res) {
                $info = $this->Users->getUserInfoByid($result['master_uid']);
                if(empty($info['card_number']) || empty($info['driver_number'])) {
                    //生成短连接
                    $long_url = site_url('User', 'center');
                    $short_url = getSinaShortUrl('1555751977',$long_url);
                    $sms_notice_obj = new SendSms();
                    $mgs[0] = $result['name'];
                    $mgs[1] = $short_url;
                    $ret = $sms_notice_obj->send($info['phone'], $mgs, 3);
                    $update['content'] = json_encode($ret);
                    $id = $car_id ? $car_id : $res;
                    $shopCarInfo->editUserCar($id, $update);
                }
                $this->AjaxReturn('200', '您的资料我们已收到，我们将在7个工作日内完成审核，及时关注【路虎中国】的短信，获取最新审核状态。', site_url('Invite', 'state'));
            } else {
                $this->AjaxReturn('404', '提交资料失败');
            }
        }
        $result['car_id'] = $car_id;
        $this->displayMain($result);
    }

    public function reward()
    {
        $result = $this->isLogin();
        if (!$result) {
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
            exit;
        }
        if ($result['master_uid'] == 0) {
            $url = site_url('User', 'center');
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
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
            exit;
        }
        if ($result['master_uid'] == 0) {
            $url = site_url('User', 'center');
            header('Location:' . $url);
            exit;
        }
        $this->displayMain($result);
    }

    public function site()
    {
        $result = $this->isLogin();
        if (!$result) {
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
            exit;
        }
        if ($result['master_uid'] == 0) {
            $url = site_url('User', 'center');
            header('Location:' . $url);
            exit;
        }
        $info = $this->input->request(null, true);
        $type = $info['type'];
        if (is_ajax_post()) {
            $Reward         = new \Xy\Application\Models\RewardModel();
            $rewardCount    = $Reward->getRewardInfoCount($result['id']);
            if($rewardCount > 0) {
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

            $info['site'] = trim($info['site']);
            $data['province']   = $info['province'];
            $data['city']       = $info['city'];
            $data['site']       = $info['site'];
            $data['type']       = $type;
            $data['uid']        = $result['id'];
            $data['reward_uid'] = $result['master_uid'];
            $data['create_dt'] = NOW_DATE_TIME;
            $Reward = new \Xy\Application\Models\RewardModel();
            $res = $Reward->addUserReward($data);
            if($res) {
                if($type == 3) {
                    $title = '您已选择养车无忧尊享礼包，工作人员将在10个工作日之内联系您。如有疑问，可致电400-820-0187。';
                } else {
                    $title = '您已成功提交收货信息，工作人员将在14个工作日之内（新年期间可能延迟）寄送礼品。如有疑问，可致电400-820-0187。';
                }
                $sql = 'UPDATE ownerreferral_201812_items SET num = `num` - 1 WHERE item_id = '.$type;
                $Reward->execute($sql);
                $this->AjaxReturn('200', $title, site_url('Invite', 'state'));
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
