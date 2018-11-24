<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Publics extends Base
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 提示跳转页面
     */
    public function tips()
    {
        $message    = $this->input->get_post('message', true);
        $message    = $message ? $message : '操作错误，请稍后刷新页面重试！';
        $url        = $this->input->get_post('url', true);
        if ($this->isLogin()) {
            $url        = $url ? $url : site_url('Index', 'index');
        } else {
            $url        = $url ? $url : site_url('Login', 'login');
        }

        $data = array(
            'message'   => $message,
            'url'       => $url
        );
        $this->display($data);
    }

    /**
     * 关于我们
     */
    public function about()
    {
        $display_data               = array();
        $display_data['page_css']   = 'admin_m-publics-about-css';
        $display_data['page_js']    = 'admin_m-publics-about-js';

        $display_data['nav']        = 'about';

        $this->display($display_data);
    }

    /**
     * 电脑版
     */
    public function loginSwitch()
    {
        $login_status = get_cookie('moblie_status');
        if(empty($login_status) || $login_status != 1) {
            set_cookie('moblie_status', 1);
        } else {
            set_cookie('moblie_status', 2);
        }

        redirect(site_url("Login", "login"));
    }

    /**
     * 设置登录session
     */
    public function validateCode(){
        $obj_vc = new ValidateCode();  //实例化一个对象
        $obj_vc->doimg();

        $validate_code = $obj_vc->getCode();

        if($validate_code){
            $arr = array(
                'validate_code'    => $obj_vc->getCode()
            );
            $this->session->set_userdata($arr);
        }
    }

    /**
     * 浏览器提示
     */
    public function alertExplorer(){
        $this->display(array());
    }

    /**
     * 最新 app type (dwz 下拉框选择)
     */
    public function appTypeSelect(){
        $request       = $this->input->request(null, true, 'hsc');

        if($request['type']){
            $data = $this->XyAppType->getFirstType($request['type']);
        }else{
            $data = $this->XyAppType->getSecondType($request['first_id']);
        }

        $result = array();

        foreach((array)$data as $k => $v){
            $result[] = array($v['classid'], $v['name']);
        }

        if (empty($new_ret)) {
            $result = array(array('', '请选择'));
        }

        echo json_encode($result);
    }
}
