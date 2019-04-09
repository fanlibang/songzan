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
<<<<<<< HEAD
        $a = [['2321'=>[0=>['222' => 333, '3333'=>4444]],'aaaa' => [0=>['222' => 333, '3333'=>4444]]]];
        echo json_encode($a);

        $b = '{"3":[{"222":333,"3333":4444}],"5":[{"222":333,"3333":4444}]}';
        var_dump(json_decode($b, true));
        echo '1111';exit;
=======

>>>>>>> 4a363b83ea601bc0cdf403428e8d6601904d353d
        $sms_notice_obj = new SendSms();
        $sms_ret = $sms_notice_obj->send('18116270122');
        var_dump($sms_ret);
        exit;
        $client = new AipOcr('14897920', '7eDaRmySnE4mFHvys8B9H48E', 'LniOpofpOHOyWVYG7mmRuxGiT7oo2dL9');
        $options = array();
        $options["detect_direction"] = "true";
        $image = file_get_contents('http://tjaguar-songzan.wedochina.cn/upfile/2018/crm/ownerreferral/%E5%BE%AE%E4%BF%A1%E5%9B%BE%E7%89%87_20181125162443.jpg');
        $info = $client->idcard($image, 'front', $options);
        var_dump($info);exit;
        //$jssdk = new Location(APPID, SECRET); //实例化引入文件的类，并将2个参数传进去，自己在微信公众后台看
        //$signPackage = $jssdk->GetSignPackage(); //获取jsapi_ticket，生成JS-SDK权限验证的签名。
	//$data['wx'] = $signPackage;
        $this->displayMain();
    }
}
