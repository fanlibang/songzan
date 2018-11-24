<?php

defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Test extends Base
{

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        //$jssdk = new Location(APPID, SECRET); //实例化引入文件的类，并将2个参数传进去，自己在微信公众后台看
        //$signPackage = $jssdk->GetSignPackage(); //获取jsapi_ticket，生成JS-SDK权限验证的签名。
	//$data['wx'] = $signPackage;
        $this->displayMain();
    }
}
