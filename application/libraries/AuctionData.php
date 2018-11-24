<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AuctionData {

    public function __construct() {
        $this->token = "582df15de91b3f12d8e710073e43f4f8";
    }

    public function AuctionData() {
        $this->__construct();
    }

    public function setToken($token) {
        $this->token = $token;
    }


    public function getHttpUrl() {
        if('develop' ==XY_ENVIRONMENT || 'testing' ==XY_ENVIRONMENT || 'local' ==XY_ENVIRONMENT){
            $http_url = "http://sdkdev.xyzs.com";
        }else{
            $http_url = "http://sdkol.xyzs.com";
        }
        return $http_url;
    }

    /* 一、
     * 获取最新的商品id
     * @url http://sdkdev.xyzs.com/integration/getlastproductid.php
     * @method POST
     */
    public function getNewProductid() {
        
        $url = $this->getHttpUrl()."/integration/getlastproductid.php";
        $ret = curl_request($url, '', 'post');
        $ret = json_decode($ret, true);

        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /* 二、
    * @uses 添加积分商城商品
    * @url    http://sdkdev.xyzs.com/integration/addproduct.php
    * @method post
    * @param arrary $params  添加的内容
     * @user chun 
     */
    public function addProduct($params = array()) {
        $post_string = "";
        $sign = gen_safe_sign($params, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/addproduct.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);
//        print_r($post_string);
//        print_r($ret);
        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }

    /* 三、
     * 获取商品详情
     * @url http://sdkdev.xyzs.com/integration/getproductdetail.php
     * @method POST
     * @param int       $id             商品id
     * @param string    $sign           签名
     */
    public function getProductDetail($id) {
        $post_string = "";
        $post_param = array('id' => $id);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/getproductdetail.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }

    /* 四、
    * @uses 修改商品信息
    * @url    http://sdkdev.xyzs.com/integration/editproduct.php
    * @method post
    * @param arrary $params  商品有关信息数组
    * @user chun
    */
    public function editProduct($params = array()) {
        $post_string = "";
        $sign = gen_safe_sign($params, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/editproduct.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

//        print_r($post_string);
        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;

    }

    /* 五、
     * 获取商品列表接口（admin后台调用）
     * @url http://sdkdev.xyzs.com/integration/getproductlist.php
     * @method POST
     * @param	int	$id              		商品id（选传）
     * @param	string	$title           	商品名称（选传）
     * @param	int	$stime           		始时间
     * @param	int	$etime           		结束时间
     * @param      int     $offset          分页偏移量
     * @param      int     $num             数量
     * @param      int     $orderSort       排序字段名
     * @param      int     $orderField      排序方向
     * @param	string	$sign    	 		签名密钥
     */
    public function getProductList($id=null,$title=null, $stime=null, $etime=null, $num=null,$offset=0, $orderSort='desc', $orderField=null) {
        $post_string = "";
        $post_param = array('id' => $id, 'title'=>$title, 'stime'=>$stime, 'etime'=>$etime, 'num'=>$num, 'offset'=>$offset, 'orderSort'=>$orderSort, 'orderField'=>$orderField);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/getproductlist.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }

    /* 六、
    * 获取商品兑换记录（admin后台调用）
    * @url http://sdkdev.xyzs.com/integration/getexchangeorderlist.php
    * @method POST
    * @param	int	$productid       商品id（选传）
    * @param	int	$stime           开始时间
    * @param	int	$etime           结束时间
    * @param      int     $offset          分页偏移量
    * @param      int     $num             数量
    * @param      int     $orderSort       排序字段名
    * @param      int     $orderField      排序方向
    * @param	string	$sign    	 签名密钥
     */
    public function getProductExchangeList($productid=null,$stime=null, $etime=null, $num=null, $offset=0, $orderSort='desc', $orderField='ctime') {

        $post_string = "";
        $post_param = array('productid'=>$productid,'stime'=>$stime, 'etime'=>$etime, 'num'=>$num, 'offset'=>$offset,'orderSort'=>$orderSort, 'orderField'=>$orderField);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/getexchangeorderlist.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

//        print_r($post_string);
        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;

//        if ($ret['ret'] != 0) {
//            return false;
//        }
//        return $ret['data'];
    }

    /*七、
    * 获取商品订单详情记录（admin后台调用）
    * @url http://sdkdev.xyzs.com/integration/getorders.php
    * @method POST
    *
    * @param   int     $productid       商品id（必传）
    * @param	int		$uid             uid（选传）
    * @param	int		$stime           开始时间
    * @param	int		$etime           结束时间
    * @param   int     $offset          分页偏移量
    * @param   int     $num             数量
    * @param   int     $orderSort       排序字段名
    * @param   int     $orderField      排序方向
    * @param	string	$sign    	 签名密钥
    */
    public function getProductOrders($productid=null,$uid=null,$stime=null, $etime=null, $num=null, $offset=0, $orderSort='desc', $orderField='ctime'){
        $post_string = "";
        $post_param = array('productid'=>$productid,'uid'=>$uid,'stime'=>$stime, 'etime'=>$etime, 'num'=>$num, 'offset'=>$offset,'orderSort'=>$orderSort, 'orderField'=>$orderField);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/getorders.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

//        print_r($ret);
//        print_r($post_string);

        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }

    /*八、
     * 后台上传商品兑换码
     * @url http://sdkdev.xyzs.com/integration/uploadcode.php
     * @method POST
     *
     * @param       int       $productid      商品id
     * @param       string    $filename       商品码文件名称
     * @param       string    $sign           签名
     */
    public function getUploadCode($productid=null,$filename=null) {
        $post_string = "";
        $post_param = array('productid' => $productid,'filename'=>$filename);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/uploadcode.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }

    /*十七、查询兑换码
     * 积分商城，获取商品兑换码接口（admin后台调用）
     * @url http://sdk.xyzs.com/integration/getproductcode.php
     * @method POST
     * @param	int	$productid       商品id（选传）
     * @param	string	$code        商品兑换码（选传）
     * @param	int	$stime           开始时间
     * @param	int	$etime           结束时间
     * @param   int     $offset          分页偏移量
     * @param   int     $num             数量
     * @param   int     $orderSort       排序字段名
     * @param   int     $orderField      排序方向
     * @param	string	$sign    	 签名密钥
     */
    public function getProductCode($productid=null,$code=null,$stime=null, $etime=null, $num=null, $offset=0, $orderSort='desc', $orderField='ctime', $action='getlist'){
        $post_string = "";
        $post_param = array('productid'=>$productid,'code'=>$code,'stime'=>$stime, 'etime'=>$etime, 'num'=>$num, 'offset'=>$offset,'orderSort'=>$orderSort, 'orderField'=>$orderField, 'action'=>$action);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/getproductcode.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

//        print_r($ret);
//        print_r($post_string);

        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }

    /*十八、补充商品码接口
     * 补充商品码（后端调用）
     * @url http://sdk.xyzs.com/integration/supplementpcode.php
     * @method POST
     * @param      int     $productid      商品id
     * @param      string  $sign           签名
     */
    public function supplementProductCode($productid=null) {
        $post_string = "";
        $post_param = array('productid' => $productid);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/supplementpcode.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }

    /* 十一、
     * 添加渠道充值配置
     * @url http://sdkdev.xyzs.com/integration/setpaychannel.php
     * @method POST
     * @param string    $sign           签名
     * @param $params   array           参数数组
     * 元素列表
     * @field string    $paychannel     充值渠道名称
     * @field float     $rate           积分获取比例
     * @field string    $announcement   渠道公告
     * @field int       $stime          开始时间
     * @field int       $etime          结束时间
     */
    public function addPayChannel($params = array()) {
        $post_string = "";
        $sign = gen_safe_sign($params, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/setpaychannel.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }

    /* 十二、
     * 编辑渠道充值配置
     * @url http://sdkdev.xyzs.com/integration/editpaychannel.php
     * @method POST
     * @param $params   array           参数数组
     *
     * @param string    $paychannel     充值渠道名称（必传）
     * @param float     $rate           积分获取比例（选传）
     * @param string    $announcement   渠道公告（选传）
     * @param int       $status         启用状态，1：启用，0：禁用（选传）
     * @param int       $isdel          删除状态，1：已删除，0：未删除（选传）
     * @param int       $stime          开始时间（选传）
     * @param int       $etime          结束时间（选传）
     * @param string    $sign           签名
     */
    public function editPayChannel($params = array()) {
        $post_string = "";
        $sign = gen_safe_sign($params, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/editpaychannel.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

//        print_r($post_string);
//        print_r($ret);

        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }


    /* 十三、
     * 渠道充值配置列表接口（admin后台调用）
     * @url http://sdkdev.xyzs.com/integration/getpaychannellist.php
     * @method POST
     * @param	int	$paychannel      渠道代码（选传）
     * @param	string	$title           商品名称（选传）
     * @param	int	$stime           开始时间
     * @param	int	$etime           结束时间
     * @param      int     $offset          分页偏移量
     * @param      int     $num             数量
     * @param      int     $orderSort       排序字段名
     * @param      int     $orderField      排序方向
     * @param	string	$sign    	 签名密钥
     */
    public function getPaychannelList($paychannel=null,$title=null, $stime=null, $etime=null, $num=null, $offset=0, $orderSort='desc', $orderField='ctime') {

        $post_string = "";
        $post_param = array('paychannel' => $paychannel, 'title'=>$title, 'stime'=>$stime, 'etime'=>$etime, 'num'=>$num, 'offset'=>$offset,'orderSort'=>$orderSort, 'orderField'=>$orderField);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/getpaychannellist.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }


    /* 十四、
     * 添加游戏app充值配置
     * @url http://sdkdev.xyzs.com/integration/setapps.php
     * @method POST
     * @param $params   array           参数数组
     * 元素列表
     * @field int       $appid          游戏id
     * @field string    $appname        游戏名称
     * @field float     $rate           积分获取比例
     * @field int       $stime          开始时间
     * @field int       $etime          结束时间
     * @param string    $sign           签名
     */
    public function addSetApp($params = null) {
        $post_string = "";
        $sign = gen_safe_sign($params, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/setapps.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }

    /* 十五、
     * 编辑游戏app充值配置
     * @url http://sdkdev.xyzs.com/integration/editappset.php
     * @method POST
     * @param $params   array           参数数组
     *
     * @param string    $appid          appid（必传）
     * @param string    $appname        游戏名称（选传）
     * @param int       $rate           积分获取比例（选传）
     * @param int       $status         启用状态，1：启用，0：禁用（选传）
     * @param int       $isdel          删除状态，1：已删除，0：未删除（选传）
     * @param int       $stime          开始时间（选传）
     * @param int       $etime          结束时间（选传）
     * @param string    $sign           签名
     */
    public function editAppSet($params = null) {

        $post_string = "";
        $sign = gen_safe_sign($params, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/editappset.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

//        print_r($post_string);
//        print_r($ret);

        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }

    /* 十六、
     * 游戏app充值配置列表接口（admin后台调用）
     * @url http://sdkdev.xyzs.com/integration/getappsetlist.php
     * @method POST
     * @param	int	$appname         app名称（选传）
     * @param	string	$appid           商品名称（选传）
     * @param	int	$stime           开始时间
     * @param	int	$etime           结束时间
     * @param      int     $offset          分页偏移量
     * @param      int     $num             数量
     * @param      int     $orderSort       排序字段名
     * @param      int     $orderField      排序方向
     * @param	string	$sign    	 签名密钥
     */
    public function getAppSetList($appid=null,$appname=null, $stime=null, $etime=null, $num=null, $offset=0, $orderSort='desc', $orderField='ctime') {

        $post_string = "";
        $post_param = array('appid'=>$appid,'appname' => $appname, 'stime'=>$stime, 'etime'=>$etime, 'num'=>$num, 'offset'=>$offset,'orderSort'=>$orderSort, 'orderField'=>$orderField);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/getappsetlist.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);

        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }

    /*
     * 获取积分商城数据统计接口（admin后台调用）
     * @url http://sdk.xyzs.com/integration/getintegrationstat.php
     * @method POST
     *
     * @param	int	$stime           开始时间
     * @param	int	$etime           结束时间
     * @param      int     $offset          分页偏移量
     * @param      int     $num             数量
     * @param      int     $orderSort       排序字段名
     * @param      int     $orderField      排序方向
     * @param	string	$sign    	 签名密钥
     */
    public function getIntegrationStat($stime=null, $etime=null, $num=null, $offset=0, $orderSort='desc', $orderField='ctime') {

        $post_string = "";
        $post_param = array('stime'=>$stime, 'etime'=>$etime, 'num'=>$num, 'offset'=>$offset,'orderSort'=>$orderSort, 'orderField'=>$orderField);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = $this->getHttpUrl()."/integration/getintegrationstat.php";
        $ret = curl_request($url, $post_string, 'post');
        $ret = json_decode($ret, true);
//        print_r($post_string);

        if (!$ret || empty($ret)) {
            return false;
        }
        return $ret;
    }


    //获取所有的支付方式
    public function getPaychannel() {
        $post_string = "";
        //$post_param = array('version' => '100.0.0', 'amount' => '10');
        $post_param = array('terminal' => 'all');
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        if('develop' ==XY_ENVIRONMENT || 'testing' ==XY_ENVIRONMENT){
            $payurl = "http://paydev.xyzs.com";
        }else{
            $payurl = "http://pay.xyzs.com";
        }
        $ret = curl_request($payurl.'/channels.php', $post_string);
        $data = json_decode($ret, true);
        if(!empty($data)){
            $data['test_recharge'] = array('name'=>'测试充值');
            $data['rebate_recharge'] = array('name'=>'返利充值');
            $data['manual_recharge'] = array('name'=>'人工充值');
            $data['xyzs'] = array('name'=>'人工返利');
            $data['xyzspay'] = array('name'=>'XY平台币充值');
        }
        return $data;
    }
}