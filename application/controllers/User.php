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

    public function index(){
        $info = $this->input->request(null, true);
        $data['type'] = $info['type'];
        $this->displayMain($data);
    }

    public function referee(){
        $info = $this->input->request(null, true);
        if (is_ajax_post()) {
            if($info['code'] != get_cookie('code')) {
                $this->AjaxReturn('202','验证码不正确');
            }
            $res = $this->Users->getUserInfoByPhone($info['iphone']);
            if($res) {
                $token = rand_str(32);
                set_cookie('token', $token);
                $url = site_url('User', 'center');#Todo
                header('Location:'.$url);
            }
            $openid = get_cookie('openId');
            $open_id = isset($openid) ? $openid : '';
            $data['name'] = $info['name'];
            $data['phone'] = $info['phone'];
            $data['open_id'] = $open_id;
            $data['driver_number'] = $info['driver_number'];
            $data['card_number'] = $info['card_number'];
            $data['token'] = $token;
            $data['created_at'] = NOW_DATE_TIME;
            $this->Users->addUserOpenId($data);
            $this->AjaxReturn('200','成功',site_url('User', 'center'));
        } else {
            //$data = $this->Users->getUserInfoByOpId($this->_data['openId']);
            $this->displayMain();
        }
    }

    public function center(){
        $info = $this->input->request(null, true);

        $data = $this->Users->getUserInfoByOpId($this->_data['openId']);
        if($data['status'] == 1 || !$data) {
            redirect(site_url('User', 'register', array('type'=> $info['type'])));
        }
        $data['wx_info'] = json_decode($data['wx_info'],true);
        $data['nickname'] = $data['wx_info']['nickname'];
        $data['type'] = $info['type'];
        $this->displayMain($data);
    }
}

