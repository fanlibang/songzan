<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppData {

    public function __construct() {
        $this->token = "582df15de91b3f12d8e710073e43f4f8";
    }

    public function AppData() {
        $this->__construct();
    }

    public function setToken($token) {
        $this->token = $token;
    }

    /*
     * @uses   获取SDK报表
     * @url    http://stat.xyzs.com/stat_data.php
     * @method post
     * @param  intval    appid  应用ID
     * @param  string    begin  开始时间
     * @param  string    end    截止时间
     * @param  intval    start  分页查询起始数
     * @param  intval    num    分页查询条数
     * @param  intval    total  数据总数
     * @param  string    sign   签名串
     * @param  string    sortfield   排序字段
     * @param  string    orderby   升序、降序
     */

    public function getSdkData($appid, $begin, $end, $start = 0, $num = 30, $total = 0, $sortfield = '', $orderby = 'desc', $channel = '-1', $type = '', $terminal = null, $adminid = 0) {
        $post_string = "";
        $post_param = array('appid' => $appid, 'begin' => $begin, 'end' => $end, 'start' => $start, 'num' => $num, 'total' => $total, 'sortfield' => $sortfield, 'orderby' => $orderby, 'channel' => $channel, 'type' => $type, 'terminal' => $terminal, 'adminid' => $adminid);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/stat_data.php";
        $ret = curl_request($url, $post_string, 'post', 0, 1, 50);
//        print_r($ret);
        $ret = json_decode($ret, true);
//        echo $post_string.'<br>';
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /**
     * 获取每日统计结果
     */
    public function getEverydayData($appid, $uid, $begin, $end, $type = '',$channel='') {
        $post_string = "";
        $post_param = array('appid' => $appid, 'uid' => $uid, 'begin' => $begin, 'end' => $end, 'type' => $type);

        if($channel){
            $post_param['channel'] = $channel;
        }

        $sign = gen_safe_sign($post_param, $this->token, $post_string);
        $url = "http://stat.xyzs.com/stat_day.php";
        $ret = curl_request($url, $post_string, 'post', 0, 1, 50);
        $ret = json_decode($ret, true);
//         print_r($post_string);
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /**
     * 消费排行榜
     */
    public function getRankData($appid, $uid, $begin, $end) {
        $post_string = "";
        $post_param = array('appid' => $appid, 'uid' => $uid, 'begin' => $begin, 'end' => $end);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/pay_rank.php";
        $ret = curl_request($url, $post_string);
        $ret = json_decode($ret, true);
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /**
     * 订单查询
     */
    public function getOrderData($appid, $uid, $begin, $end, $stat, $isdev, $start, $num, $channel = '-1') {
        $post_string = "";
        $post_param = array('appid' => $appid, 'uid' => $uid, 'begin' => $begin, 'end' => $end, 'stat' => $stat, 'isdev' => $isdev, 'start' => $start, 'num' => $num, 'channel' => $channel);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);
        $url = "http://stat.xyzs.com/order.php";
        $ret = curl_request($url, $post_string, 'post', 0, 1, 35);
        $ret = json_decode($ret, true);
//        print_r($post_string);
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /**
     * 后台获取订单信息接口调用处
     * @param type $orderid
     * @param type $uid
     * @param type $begin
     * @param type $end
     * @param type $stat
     * @param type $isdev
     * @param type $start
     * @param type $num
     * @return type 
     */
    public function getAdminOrderData($orderid, $payno, $uid, $begin, $end, $start, $num, $stat = -1, $isdev = -1) {
        $post_string = "";
        $post_param = array('orderid' => $orderid, 'payno' => $payno, 'uid' => $uid, 'begin' => $begin, 'end' => $end, 'stat' => $stat, 'isdev' => $isdev, 'start' => $start, 'num' => $num);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/order.php";
        $ret = curl_request($url, $post_string, 'post', 0, 1, 35);
        $ret = json_decode($ret, true);
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /**
     * 数据概览
     */
    public function getTotalData($appid, $uid, $channel = '-1') {
        $post_string = "";
        $post_param = array('appid' => $appid, 'uid' => $uid, 'channel' => $channel);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/stat_total.php";
        $ret = curl_request($url, $post_string);
        $ret = json_decode($ret, true);
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /* SDK数据统计汇总
     * @url    http://stat.xyzs.com/stat_summary.php
     * @method post
     * @param  intval    appid  应用ID
     * @param  string    begin  开始时间
     * @param  string    end    截止时间
     * @param  string    sign   签名串
     * @return json	  result
     * @user chun 
     */

    public function getStat_summaryData($appid = 0, $begin = null, $end = null, $channel = '', $type = 'total', $terminal = null, $adminid = 0) {
        $channel = $channel ? $channel : -1;
        $post_string = "";
        $post_param = array('appid' => $appid, 'begin' => $begin, 'end' => $end, 'channel' => $channel, 'type' => $type, 'terminal' => $terminal, 'adminid' => $adminid);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/stat_summary.php";
        $ret = curl_request($url, $post_string, 'post', 0, 1, 50);
        $ret = json_decode($ret, true);
//       echo '<br>#######<br>'; print_r($post_string);
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /**
     * @uses   获取SDK报表
     * @url    http://stat.xyzs.com/stat_data.php
     * @param  string    type   查询类型：day\app
     * @param  string    begin  开始时间
     * @param  string    end    截止时间
     * @param  intval    start  分页查询起始数
     * @param  intval    num    分页查询条数
     * @param  intval    total  数据总数
     * @param  string    sign   签名串
     * @param  string    sortfield   排序字段
     * @param  string    orderby   升序、降序
     * @user chun 
     */

    public function getSdkDataByDay($appid, $begin, $end, $start = 0, $num = 20, $total = 0, $sortfield = '', $orderby = 'desc', $type = 'day', $channel = '', $terminal = null, $adminid = 0) {
        $channel = $channel ? $channel : -1;
        $post_string = "";
        $post_param = array('appid' => $appid, 'begin' => $begin, 'end' => $end, 'start' => $start, 'num' => $num, 'total' => $total, 'sortfield' => $sortfield, 'orderby' => $orderby, 'type' => $type, 'channel' => $channel, 'terminal' => $terminal, 'adminid' => $adminid);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/stat_data.php";
        $ret = curl_request($url, $post_string, 'post', 0, 1, 50);
        $ret = json_decode($ret, true);
//        echo '<br>###############<br>';print_r($post_string);
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /**
     * @uses   更新添加的cps游戏统计数据
     * @url    http://stat.xyzs.com/modify_stat_data.php
     * @param  intval    appid  应用ID
     * @param  string    day    时间
     * @param  json    data     数据
     * @param  string    sign   签名串
     * @user chun 
     */

    public function modifyStatByDay($appid, $day, $data = array()) {
        $post_string = "";
        $post_param = array('appid' => $appid, 'day' => $day, 'data' => json_encode($data));
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/modify_stat_data.php";
        $ret = curl_request($url, $post_string);
        $ret = json_decode($ret, true);
//        print_r($post_string);
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret;
    }

    //获取所有的支付方式
    public function getPaychannel() {
        $post_string = "";
//        $post_param = array('version' => '100.0.0', 'amount' => '10');
        $post_param = array('terminal' => 'all');
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $ret = curl_request('http://pay.xyzs.com/channels.php', $post_string);
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

    /**
     * @uses   获取用户的充值记录
     * @url    http://stat.xyzs.com/get_user_pay.php
     * @param  intval    appid  应用ID
     * @param  intval    uid    用户ID
     * @param  string    sign   签名串
     * @user chun 
     */

    public function getUserPay($appid, $uid) {
        $post_string = "";
        $post_param = array('appid' => $appid, 'uid' => $uid);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/get_user_pay.php";

        $ret = curl_request($url, $post_string, 'post', 0, 1, 35);
        $ret = json_decode($ret, true);
        //print_r($post_string);
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret;
    }

    /*
     * @uses   获取用户近期玩的游戏
     * @url    http://stat.xyzs.com/get_user_login.php
     * @param  intval    appid  应用ID
     * @param  intval    uid    用户ID
     * @param  string    sign   签名串
     * @user chun 
     */

    public function getUserLogin($appid, $uid) {
        $post_string = "";
        $post_param = array('appid' => $appid, 'uid' => $uid);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/get_user_login.php";

        $ret = curl_request($url, $post_string, 'post', 0, 1, 35);
        $ret = json_decode($ret, true);
        //print_r($post_string);
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret;
    }

    /**
     * @uses   修改订单补发通知次数接口
     * @url    http://stat.xyzs.com/modify_order_retrynum.php
     * @method post
     * @param  string orderid   订单号
     * @param  string sign      签名密码
     * @return json   result    array(ret=>状态码,msg=>描述信息)
     */
    public function getOrderRetrynum($orderid) {
        $post_string = "";
        $post_param = array('orderid' => $orderid);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/modify_order_retrynum.php";
        $ret = curl_request($url, $post_string);
        $ret = json_decode($ret, true);
        return $ret;
    }

    /**
     * @uses   更新用户信息数据
     * @url    http://stat.xyzs.com/modify_account_data.php
     * @method post
     * @param  int    uid     用户ID
     * @param  json   data    修改数据
     * @param  string sign    签名密码
     * @return json   result
     *        array(ret=>状态码,msg=>描述信息)
     * @user chun 
     */

    public function getModifyAccount($uid, $data = array()) {
        $post_string = "";
        $post_param = array('uid' => $uid, 'data' => json_encode($data));
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/modify_account_data.php";
        $ret = curl_request($url, $post_string);
        $ret = json_decode($ret, true);
        return $ret;
    }

    /**
     * @url    http://stat.xyzs.com/stat_day_by_ref.php
     * @method post
     * @param  int    appid
     * @param  int    uid
     * @param  string channel
     * @param  string begin
     * @param  string end
     * @param  string sign
     * @return json	  result
     * @use联运后台的每天数据；
     */
    public function getEverydayDataByChannel($appid, $uid, $begin, $end, $channel = '-1',$type='day', $terminal = null, $adminid = 0) {
        $post_string = "";
        $post_param = array('appid' => $appid, 'uid' => $uid, 'begin' => $begin, 'end' => $end, 'channel' => $channel, 'type' => $type,'terminal' => $terminal, 'adminid' => $adminid);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/stat_day_by_ref.php";
        $ret = curl_request($url, $post_string, 'post', 0, 1, 35);
        $ret = json_decode($ret, true);
//        print_r($post_string);
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /**
     * @uses   联运后台获取SDK报表
     * @url    http://stat.xyzs.com/stat_lianyun_data.php
     * @param  string    type   查询类型：day\app
     * @param  string    begin  开始时间
     * @param  string    end    截止时间
     * @param  intval    start  分页查询起始数
     * @param  intval    num    分页查询条数
     * @param  intval    total  数据总数
     * @param  string    sign   签名串
     * @param  string    sortfield   排序字段
     * @param  string    orderby   升序、降序
     * @user chun 
     */
    public function getChannelSdkDataByDay($appid, $begin, $end, $start = 0, $num = 20, $total = 0, $sortfield = '', $orderby = 'desc', $type = 'day', $channel = '', $terminal = null, $adminid = 0) {
        $channel = $channel ? $channel : -1;
        $post_string = "";
        $post_param = array('appid' => $appid, 'begin' => $begin, 'end' => $end, 'start' => $start, 'num' => $num, 'total' => $total, 'sortfield' => $sortfield, 'orderby' => $orderby, 'type' => $type, 'channel' => $channel, 'terminal' => $terminal, 'adminid' => $adminid);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/stat_lianyun_data.php";
        $ret = curl_request($url, $post_string, 'post', 0, 1, 50);
        $ret = json_decode($ret, true);
//        echo '<br>###############<br>';print_r($post_string);
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /*
     * @uses   联运后台获取SDK报表
     * @url    http://stat.xyzs.com/stat_lianyun_data.php
     * @method post
     * @param  intval    appid  应用ID
     * @param  string    begin  开始时间
     * @param  string    end    截止时间
     * @param  intval    start  分页查询起始数
     * @param  intval    num    分页查询条数
     * @param  intval    total  数据总数
     * @param  string    sign   签名串
     * @param  string    sortfield   排序字段
     * @param  string    orderby   升序、降序
     */
    public function getChannelSdkData($appid, $begin, $end, $start = 0, $num = 30, $total = 0, $sortfield = '', $orderby = 'desc', $channel = '-1', $type = '', $terminal = null, $adminid = 0) {
        $post_string = "";
        $post_param = array('appid' => $appid, 'begin' => $begin, 'end' => $end, 'start' => $start, 'num' => $num, 'total' => $total, 'sortfield' => $sortfield, 'orderby' => $orderby, 'channel' => $channel, 'type' => $type, 'terminal' => $terminal, 'adminid' => $adminid);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/stat_lianyun_data.php";
        $ret = curl_request($url, $post_string, 'post', 0, 1, 50);
        $ret = json_decode($ret, true);
//        echo $post_string.'<br>';
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /**
     * http请求方法，通用
     * @param string $url       请求的url
     * @param array $params     参数数组
     * @return boolean|array    结果集
     */
    public function getHttpRequestData($url, $params) {
        $post_string = "";
        gen_safe_sign($params, $this->token, $post_string);

        $ret = curl_request($url, $post_string, 'post', 0, 1, 30);
        $ret = json_decode($ret, true);

        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /**
     * http请求方法，通用
     * @param string $url       请求的url
     * @param array $params     参数数组
     * @return boolean|array    结果集
     */
    public function getHttpRequestNew($url, $params) {
        $post_string = "";
        gen_safe_sign($params, $this->token, $post_string);

        $ret = curl_request($url, $post_string, 'post', 0, 1, 15);
        return json_decode($ret, true);
    }

    /**
     * 获取游戏LTV数据统计
     */
    public function getSataLtvData($appid, $uid, $begin, $end, $type = '') {
        $post_string = "";
        $post_param = array('appid' => $appid, 'uid' => $uid, 'begin' => $begin, 'end' => $end, 'type' => $type);
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://stat.xyzs.com/stat_ltv.php";
        //echo $post_string;
        $ret = curl_request($url, $post_string, 'post', 0, 1, 50);
        $ret = json_decode($ret, true);

        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

}
