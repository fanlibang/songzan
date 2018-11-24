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
                $this->AjaxReturn('202','验证码不正确'); exit;
            }
            $res = $this->Users->getUserInfoByPhone($info['phone']);
            $token = rand_str(32);
            $openid = get_cookie('openId');
            $open_id = isset($openid) ? $openid : '';
            if($res) {
                if(is_weixin() && empty($res['open_id'])){
                    $this->Users->editUserId($res['id'], ['open_id' => $open_id]);
                }
                set_cookie('token', $token);
                $url = site_url('User', 'center');
                header('Location:'.$url);
            }
            $data['name'] = $info['name'];
            $data['phone'] = $info['phone'];
            $data['open_id'] = $open_id;
            $data['driver_number'] = $info['driver_number'];
            $data['card_number'] = $info['card_number'];
            $data['token'] = $token;
            $url = site_url('Invite', 'index', array('invite_code' => 123123));
            $data['qr_code_img'] = "http://api.k780.com:88/?app=qr.get&data=$url";
            $data['created_at'] = NOW_DATE_TIME;
            $this->Users->addUserOpenId($data);
            set_cookie('token', $token);
            $this->AjaxReturn('200','成功',site_url('User', 'center'));
        } else {
            if($this->isLogin()) {
                $url = site_url('User', 'center');
                header('Location:'.$url);
            }
            //$data = $this->Users->getUserInfoByOpId($this->_data['openId']);
            $this->displayMain();
        }
    }

    public function center(){
        if(!$this->isLogin()) {
            $url = site_url('User', 'referee');
            header('Location:'.$url);
        }
        $data = $this->isLogin();
        $this->displayMain($data);
    }
}

