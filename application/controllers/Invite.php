<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/11/24
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
        $url = site_url('Invite', 'info');
        $result = $this->isLogin();
        if ($result) header('Location:' . $url);
        $info = $this->input->request(null, true);
        $inviteCode = $info['invite_code'];
        $carInfo = new \Xy\Application\Models\CarInfoModel();
        if (is_ajax_post()) {
            $openId = get_cookie('openId');
            $data['open_id'] = isset($openId) ? $openId : '';
            $code = $info['code'];
            $data['phone'] = $info['phone'];
            if (!preg_match("/^1[34578]{1}[0-9]{1}[0-9]{8}$/", $data['phone'])) {
                $this->AjaxReturn('403', '电话号码格式不正确');
                exit;
            }
            if (empty($inviteCode)) {
                $this->AjaxReturn('403', '邀请码格式不正确');
                exit;
            }
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
                $this->AjaxReturn('403', '自己不能直接邀请自己');
                exit;
            }
            if (!empty($havePhoneInfo)) {
                if (is_weixin() && empty($havePhoneInfo['open_id']) && !empty($data['open_id'])) {
                    $this->Users->editUserId($havePhoneInfo['id'], ['open_id' => $data['open_id']]);
                }
                if ($havePhoneInfo['invite_code'] != $inviteCode) {
                    $this->AjaxReturn('202', '很抱歉，目前系统不支持修改推荐人。如有疑问，可详询400-820-0187。', $url);
                    exit;
                }
                set_cookie('token', $havePhoneInfo['token']);
                $this->AjaxReturn('201', '您已参与过活动，请前往个人主页查看最新状态。', $url);
                exit;
            }
            $ret = verify_count($data['name'], 10);
            if (!$ret) {
                $this->AjaxReturn('202', '用户名长度应小于五');
                exit;
            }
            $token = rand_str(32);
            $data['token'] = $token;
            set_cookie('token', $token);
            $uid = $this->Users->addUserOpenId($data);

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
            ];
            $push = new ReportModel();
            $result = $push->reportOwner($tempData);
            $this->Users->editUserId($uid, ['report_result' => $result]);
            $this->AjaxReturn('200', '活动礼遇将根据您所提交的信息进行审核派发，请确保信息的准确性。您可保存此链接以便后续进入活动页面。', $url);
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
        $result = $this->isLogin();
        if (!$result) {
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
        }
        if ($result['master_uid'] == 0) {
            $url = site_url('User', 'center');
            header('Location:' . $url);
        }
        $carInfo = new \Xy\Application\Models\CarInfoModel();
        $result['car_info'] = $carInfo->getCarInfoByid($result['car_id']);
        $this->displayMain($result);
    }

    public function share()
    {
        $data = $this->isLogin();
        if (!$data) {
            $url = site_url('User', 'center');
            header('Location:' . $url);
        }
        if ($data['master_uid'] > 0) {
            $url = site_url('Invite', 'info');
            header('Location:' . $url);
        }
        $shareImg = $data['share_img'];
        if (empty($data['share_img'])) {
            $imgPath = HTTP_HOST . STATIC_ASSETS . 'images/bg-2.jpg';
            $bigImg = imagecreatefromstring(file_get_contents($imgPath));
            $qCodeImg = imagecreatefromstring(file_get_contents($data['qr_code_img']));
            list($qCodeWidth, $qCodeHight, $qCodeType) = getimagesize($data['qr_code_img']);
            imagecopymerge($bigImg, $qCodeImg, 300, 950, 0, 0, $qCodeWidth, $qCodeHight, 100);
            $white = imagecolorallocate($bigImg, 255, 255, 255);
            $font = ROOTPATH . '/assets/common/font/Elephant.ttf';

            imagettftext($bigImg, 25, 0, 300, 480, $white, $font, $data['invite_code']);

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
}
