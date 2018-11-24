<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppInfo {

    public function __construct() {
        $this->token = "lIU=-6tghjkLKHuytr56342";
    }

    public function AppBaseInfo() {
        $this->__construct();
    }

    /**
     * 新创建appkey
     */
    public function genAppKey($appid, $uid, $appname) {
        $post_string = "";
        $post_param = array('appid' => $appid, 'uid' => $uid, 'appname' => $appname, 'time' => time());
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://appinfo.xyzs.com/genAppKey.php";
        $ret = curl_request($url, $post_string);
        $ret = json_decode($ret, true);

        if ($ret['ret'] != 0 || !$ret['appkey']) {
            return false;
        }
        return $ret['appkey'];
    }

    /**
     * 读取appkey
     */
    public function getAppInfo($appid, $uid) {
        $post_string = "";
        $post_param = array('appid' => $appid, 'uid' => $uid, 'time' => time());
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://appinfo.xyzs.com/getAppKey.php";
        $ret = curl_request($url, $post_string);
        $ret = json_decode($ret, true);
        if ($ret['ret'] != 0) {
            return false;
        }
        return $ret['data'];
    }

    /**
     * 重新生成appkey
     */
    public function chgAppKey($appid, $uid) {
        $post_string = "";
        $post_param = array('appid' => $appid, 'uid' => $uid, 'time' => time());
        $sign = gen_safe_sign($post_param, $this->token, $post_string);

        $url = "http://appinfo.xyzs.com/chgAppKey.php";
        $ret = curl_request($url, $post_string);
        $ret = json_decode($ret, true);
        if ($ret['ret'] != 0 || !$ret['appkey']) {
            return false;
        }
        return $ret['appkey'];
    }

    /**
     * 设置应用信息
     * @param	int		appid
     * @param	array	appinfo		app信息，array('appname' => 'xxx', 'rate'=>10, 'currency'=>'元宝', 'payrul'=> 'httpxxxxxxxxx', 'payurltest'=> 'http://xxxxxxxxx.com/', 'resource_id'=>1231231)
     */
    public function setAppInfo($appid, $uid, $appinfo) {
        $post_string = "";
        if (!is_array($appinfo) || !$appinfo || !$appid) {
            return false;
        }
        $appinfo['appid'] = $appid;
        $appinfo['uid'] = $uid;
        $appinfo['time'] = time();
        $sign = gen_safe_sign($appinfo, $this->token, $post_string);
        $url = "http://appinfo.xyzs.com/setAppInfo.php";
        $ret = curl_request($url, $post_string);
        $ret = json_decode($ret, true);
        if ($ret['ret'] == 0 && $ret['res'] == "ok") {
            return true;
        }
        return false;
    }

    /**
     * 支付白名单
     * @param	int		appid
     */
    public function getWhiteList($appid) {
        $post_string = "";
        if (!$appid) {
            return false;
        }
        $appinfo['appid'] = $appid;
        $appinfo['time'] = time();
        $sign = gen_safe_sign($appinfo, $this->token, $post_string);
        $url = "http://appinfo.xyzs.com/getWhiteList.php";
        $ret = curl_request($url, $post_string);
        $ret = json_decode($ret, true);
        if ($ret['ret'] == 0 && is_array($ret['list'])) {
            return $ret['list'];
        }
        return false;
    }

    /**
     * 支付白名单
     * @param	int		appid
     */
    public function setWhiteList($appid, $list) {
        $post_string = "";
        if (!$appid || !$list || !is_array($list)) {
            return false;
        }
        $appinfo['appid'] = $appid;
        $appinfo['list'] = json_encode($list);
        $appinfo['time'] = time();
        $sign = gen_safe_sign($appinfo, $this->token, $post_string);
        $url = "http://appinfo.xyzs.com/setWhiteList.php";
        $ret = curl_request($url, $post_string);
        $ret = json_decode($ret, true);
        if ($ret['ret'] == 0 && is_array($ret)) {
            return true;
        }
        return false;
    }

    /**
    *@uses读取注册帐号白名单IP
    * @method	post
    * @param	int		time
    * @param	string	sign
    * @url		http://appinfo.xyzs.com/getRegWhiteList.php
    */
    public function getWhiteIpList() {
        $post_string = "";
        $post_param['time'] = time();
        $sign = gen_safe_sign($post_param, $this->token, $post_string);
        $url = "http://appinfo.xyzs.com/getRegWhiteList.php";
        $ret = curl_request($url, $post_string);
        $ret = json_decode($ret, true);
        if ($ret['ret'] == 0 && is_array($ret['list'])) {
            return $ret['list'];
        }
        return false;
    }

    /**
    * @uses添加注册帐号白名单IP
    * @method	post
    * @param	int		time
    * @param	json	whiteip
    * @param	string	sign
    * @url		http://appinfo.xyzs.com/setRegWhiteList.php
    */
    public function setWhiteIpList($whiteip) {
        $post_string = "";
        if (!$whiteip) {
            return false;
        }
        
        $post_param['list'] = json_encode(array($whiteip));
        $post_param['time'] = time();
        $sign = gen_safe_sign($post_param, $this->token, $post_string);
        $url = "http://appinfo.xyzs.com/setRegWhiteList.php";
        $ret = curl_request($url, $post_string);
        $ret = json_decode($ret, true);
        if ($ret['ret'] == 0 && is_array($ret)) {
            return true;
        }
        return false;
    }
}