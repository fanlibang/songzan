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
        $client = new AipOcr('14897920', '7eDaRmySnE4mFHvys8B9H48E', 'LniOpofpOHOyWVYG7mmRuxGiT7oo2dL9');
        $options = array();
        $options["detect_direction"] = "true";
        $info = $client->idcard('http://tjaguar-songzan.wedochina.cn/upfile/2018/crm/ownerreferral/%E5%BE%AE%E4%BF%A1%E5%9B%BE%E7%89%87_20181125162443.jpg', 'front', $options);
        var_dump($info);exit;
        //$jssdk = new Location(APPID, SECRET); //实例化引入文件的类，并将2个参数传进去，自己在微信公众后台看
        //$signPackage = $jssdk->GetSignPackage(); //获取jsapi_ticket，生成JS-SDK权限验证的签名。
	//$data['wx'] = $signPackage;
        $this->displayMain();
    }
}
