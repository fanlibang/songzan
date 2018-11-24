<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Login extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 后台登录
     */
    public function login()
    {
        if ($this->isLogin()) {
            redirect(site_url('Index', 'index'));
        }

        $user_name  = $this->input->post('user_name', true);
        $password   = $this->input->post('password', true);

        $check_login   = $this->input->post('check_login', true);

        if ($user_name && $password) {
            $user_info = $this->AdminUsers->getOne(array('username' => $user_name));

            //没有开启多种登录模式时重新跳转到登录页
            if ($user_info['status'] == 1) {
                redirect(site_url('Publics', 'tips', array('message' =>'您的账号已被禁用，请联系管理员开发')));
            }

            $password = $this->pwdMd5($password);

            if (empty($user_info)) {
                redirect(site_url('Publics', 'tips', array('message' =>'账号不存在，请联系管理员添加')));
            }

            if ($user_info['status'] == 1) {
                redirect(site_url('Publics', 'tips', array('message' =>'账号已被禁用，请联系管理员解禁')));
            }


                if ($password == $user_info['password']) {
                    $session_user_info  = array(
                        'id' => $user_info['id'],
                        'user_name' => $user_info['user_name'],
                        'tel' => $user_info['tel']
                    );
                    $this->session->set_userdata($session_user_info);
                    set_cookie('admin_user_id', $user_info['id']);
                    set_cookie('admin_user_name', $user_info['user_name']);

                    $this->AdminUsers->edit(array('last_ip' =>return_ip(true), 'last_time' =>time()), array('id'    => $user_info['id']));

                    redirect(site_url('Index', 'index'));
                } else {
                    redirect(site_url('Publics', 'tips', array('message' =>'登录密码错误'.$password .'#'. $user_info['password'])));
                }
        } else {
            if ($check_login == 1) {
                redirect(site_url('Publics', 'tips', array('message' =>'请输入登录账号和密码')));
            } else {
                $display_data               = array();

                if($this->_is_main_html == 1){
                    $display_data['page_css']   = 'admin_m-login-login-css';
                    $display_data['page_js']    = 'admin_m-login-login-js';
                }
                $this->display($display_data);
            }
        }
    }

    /**
     * 后台注册
     */
    public function register()
    {
        if ($this->isLogin()) {
            redirect(site_url('Index', 'index'));
        }

        $user_name  = $this->input->post('user_name', true);
        $password   = $this->input->post('password', true);

        $check_login   = $this->input->post('check_register', true);

        if ($user_name && $password) {
            redirect(site_url('Publics', 'tips', array('message' =>'注册入口关闭~')));
            if(!preg_match("/^1[34578]{1}[0-9]{1}[0-9]{8}$/", $user_name)){
                redirect(site_url('Publics', 'tips', array('message' =>'手机号码格式错误')));
            }

            $unms = 2;
            $check_ret = $this->AdminUsers->checkUserPhoneCodeNums($user_name.'register', $unms);

            if($check_ret){
                if(in_array($this->_data['sms_login'] , array(1, 3))){
                    $validate_code_check = $this->validateCodeCheck();

                    if(!$validate_code_check){
                        redirect(site_url('Publics', 'tips', array('message' =>'验证码错误')));
                    }

                    $phone_sms_check = $this->phoneSmsCheck($user_name, true);
                    if(!$phone_sms_check){
                        redirect(site_url('Publics', 'tips', array('message' =>'短信码错误')));
                    }
                }

                $session_user_info  = array(
                    'user_name' => $user_name,
                    'tel'       => $user_name,
                    'password'  => $this->pwdMd5($password),
                    'last_time' => time(),
                    'add_time'  => time(),
                    'status'    => 2
                );

                $ret = $this->AdminUsers->add($session_user_info);

                if($ret){
                    unset($session_user_info['password'],$session_user_info['last_time'],$session_user_info['add_time'],$session_user_info['status']);
                    $session_user_info['id'] = $ret;

                    $this->session->set_userdata($session_user_info);

                    set_cookie('admin_user_id', $ret);
                    set_cookie('admin_user_name', $user_name);

                    redirect(site_url('Index', 'index'));
                }else{
                    redirect(site_url('Publics', 'tips', array('message' =>'注册失败，请稍候重试~')));
                }
            }else{
                redirect(site_url('Publics', 'tips', array('message' =>'请求短信次数过于频繁~')));
            }

        } else {
            if ($check_login == 1) {
                redirect(site_url('Publics', 'tips', array('message' =>'请输入登录账号和密码')));
            } else {
                $display_data               = array();

                if($this->_is_main_html == 1){
                    $display_data['page_css']   = 'admin_m-login-login-css';
                    $display_data['page_js']    = 'admin_m-login-login-js';
                }

                $this->display($display_data);
            }
        }
    }

    /**
     * 系统弹框登录
     */
    public function loginDialog()
    {
        $this->display();
    }

    /**
     * 退出系统
     */
    public function logout()
    {
        self::unsetLoginInfo();
        redirect(site_url('Login', 'login'));
    }
}
