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
        if ($this->_data['browser'] == 1) {
            $this->isLogin();
        }
        $info = $this->input->request(null, true);
        $data['invite_code'] = $info['invite_code'];
        if (is_ajax_post()) {
            $data['code'] = $info['code'];
            $data['phone'] = $info['phone'];
            if (!preg_match("/^1[34578]{1}[0-9]{1}[0-9]{8}$/", $data['phone'])) {
                $this->AjaxReturn('403', '电话号码格式不正确');
                exit;
            }
            $data['name'] = $info['name'];
            $data['invite_code'] = $info['invite_code'];
            $data['car_id'] = $info['car_id'];
            $data['create_dt'] = NOW_DATE_TIME;
            $masterUserInfo = $this->Users->getUserInviteCode($data['invite_code']);
            if (empty($masterUserInfo)) {
                $this->AjaxReturn('401', '邀请人不存在');
                exit;
            }
            if ($data['code'] != get_cookie('code')) {
                $this->AjaxReturn('402', '验证码不正确');
                exit;
            }
            $havePhoneInfo = $this->Users->getUserInfoByPhone($data['phone']);
            if (!empty($havePhoneInfo)) {
                $this->AjaxReturn('403', '手机号已注册');
                exit;
            }

            $ret = verify_count($data['name'], 10);
            if (!$ret) {
                $this->AjaxReturn('202', '用户名长度应小于五');
            }

            $this->Users->addUserInfo($data);
            $this->AjaxReturn('200', '成功', site_url('User', 'center'));
        }
        $carInfo = new \Xy\Application\Models\CarInfoModel();
        $data['car_record'] = $carInfo->getAllCarInfo();
        $this->displayMain($data);

    }

    /**
     * 被邀请人信息
     */
    public function info()
    {
        $this->displayMain();
    }
}
