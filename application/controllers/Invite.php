<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/11/24
 * Time: 下午3:46
 */
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Base.php';
class Invite extends Base {

    /**
     * 初始化
     */
    public function __construct() {
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
            $data['name'] = $info['name'];
            $data['master_uid'] = $info['invite_code'];
            $data['car_id'] = $info['car_id'];
            $data['create_dt'] = NOW_DATE_TIME;
            $this->Users->addUserInfo($data);
            $this->AjaxReturn('200','成功',site_url('User', 'center'));
        }
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
