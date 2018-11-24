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
        $this->feedBack           = new \Xy\Application\Models\FeedBackModel();
    }

    public function index(){
        $info = $this->input->request(null, true);
        $data['type'] = $info['type'];
        $this->displayMain($data);
    }

    public function referee(){
        $info = $this->input->request(null, true);
        if (is_ajax_post()) {
            $data['name'] = $info['name'];
            $data['iphone'] = $info['iphone'];
            $data['sex'] = $info['sex'];
            $data['city'] = $info['city'];
            $data['opinion'] = $info['opinion'];
            $data['others'] = $info['others'];
            $data['textare'] = $info['textare'];
            $data['uid'] = $info['uid'];
            $data['create_dt'] = NOW_DATE_TIME;
            $this->feedBack->addUserInfo($data);
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

    public function travel(){
        $info = $this->input->request(null, true);
        $data['type'] = $info['type'];
        $this->displayMain($data);
    }

    public function feedback(){
        $info = $this->input->request(null, true);
        $uid = $info['uid'];
        if (is_ajax_post()) {
            $data['username'] = $info['username'];
            $data['iphone'] = $info['iphone'];
            $data['sex'] = $info['sex'];
            $data['city'] = $info['city'];
            $data['opinion'] = $info['opinion'];
            $data['others'] = $info['others'];
            $data['textare'] = $info['textare'];
            $data['uid'] = $info['uid'];
            $data['create_dt'] = NOW_DATE_TIME;
            $this->feedBack->addUserInfo($data);
            $this->AjaxReturn('200','成功',site_url('User', 'center'));
        } else {
            $data = $this->Users->getUserInfoByOpId($this->_data['openId']);
            $this->displayMain($data);
        }
    }

    public function register(){
        $info = $this->input->request(null, true);
        $res = $this->Users->getUserInfoByOpId($this->_data['openId']);
        /**
        if($res['wx_info'] == '') {
            $url = site_url('Publics', 'getUserInfo',array('type' => $info['type']));
            //$ulr = 'http://'.SERVER_NAME.'/dev/Publics/getUserInfo?type='.$info['type'];
            $this->get_openid($url);exit;
            //$this->getUserInfo();exit;
        } else
        */
        if($res['status'] == 2) {
            redirect(site_url('User', 'center'));
        }
        $Wx_Info = json_decode($res['wx_info'], true);
        $data['nickname'] = $Wx_Info['nickname'];
        $data['sex'] = $Wx_Info['sex'];
        $data['type'] = $info['type'];
        $data['uid'] = $res['uid'];
        $this->displayMain($data);
    }

    public function login(){
        $info = $this->input->request(null, true);
        $uid = $info['uid'];
        $ret = $this->Users->getUserInfoByOpId($this->_data['openId']);
        if($ret['status'] == 2) {
            $this->AjaxReturn('200','您已注册过了，请勿重复注册',site_url('User', 'center')); exit;
        }
        $data['iphone'] = $info['iphone'];
        $data['name'] = $info['name'];
        $data['code'] = $info['code'];
        $data['sex'] = $info['sex'];
        $data['type'] = $info['type'];
        $data['province'] = $info['province'];
        $data['city'] = $info['city'];
        if($data['code'] != get_cookie('code')) {
            $this->AjaxReturn('202','验证码不正确');
        }
        $ret = verify_count($data['name'], 10);
        if(!$ret) {
            $this->AjaxReturn('202','用户名长度应小于五');
        }
        if($info['type'] == 1) {
            $data['merchants'] = $info['merchants'];
            $data['car'] = $info['car'];
        } else {
            $data['line'] = $info['line'];
            $data['time'] = $info['time'];
            $data['recommend'] = $info['recommend'];
        }
        $res = [
            'nickname'  => $info['name'],
            'info'      => json_encode($data),
            'type'      => $data['type'],
            'iphone'    => $data['iphone'],
            'status'    => 2
        ];
        $ret = $this->Users->getUserInfoByOpId($this->_data['openId']);
        $uid = $ret['uid'];
        $tempData = [
            'kmi_id'	    => $ret['code'],
            'name'	        => $info['name'],
            'mobile'	    => $info['iphone'],
            'model_id'	    => $info['car_id'],
            'nameplate_of_interest' => $info['car_code'],
            'creation_time'   =>NOW_DATE_TIME,
            'province'	    => $info['province'],
            'city'	        => $info['city'],
            'need_lms' => 1,
        ];
        //var_dump($tempData);exit;
        $push = new ReportModel();
        $ret = $push->reportOwner($tempData, $info['merchants']);
        $time = NOW_DATE_TIME;
        $sql = "insert into l462_18songzan_push (info, uid, create_dt) values ('{$ret}', '{$uid}', '{$time}');";
        $this->Users->execute($sql);

        $this->Users->editUserUid($uid, $res);
        $this->AjaxReturn('200','注册成功',site_url('User', 'center'));
    }
}

