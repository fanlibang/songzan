<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountCenter
{
	public function __construct($appid="", $appkey=""){
		$this->appid = 1;
		$this->appkey = "8zVbpn5CaEs3ih8r1Noawj0QhvNOaSJk";
	}
	public function AccountCenter($appid="", $appkey="") {
		$this->__construct($appid, $appkey);
	}
	/**
	 * 注册
	 */
	public function createAccount($account, $password1, $password2, $nick, $source, $macaddr="")
	{
		if(!$account || !$password1 || !$password2) {
			return false;
		}
		if(!$source) {
			$source = "pc";
		}
		$post_string = "";
		$post_param = array('account' => $account, 'appid' => $this->appid, 'password1' => $password1, 'password2' => $password2, 'nick' => $nick, 'source' => $source, 'macaddr' => $macaddr);
		$sign = gen_safe_sign($post_param, $this->appkey, $post_string);

		$url = "http://passport.xyzs.com/createAccount.php";
		$ret = curl_request($url, $post_string);
		if(!$ret) {
			return false;
		}
		$ret = json_decode($ret, true);
		return $ret;
	}

	/**
	 * 判断用户名是否存在
	 */
	public function checkAccount($account)
	{
		if(!$account) {
			return false;
		}
		$post_string = "";
		$post_param = array('account' => $account);
		$post_string = "account=".$account;

		$url = "http://passport.xyzs.com/checkAccount.php";
		$ret = curl_request($url, $post_string);
		if(!$ret) {
			return false;
		}
		$ret = json_decode($ret, true);
		return $ret;
	}

	/**
	 * 登录
	 */
	public function login($account, $password)
	{
		if(!$account || !$password) {
			return false;
		}
		$post_string = "";
		$post_param = array('account' => $account, 'password' => $password, 'appid' => $this->appid);
		$sign = gen_safe_sign($post_param, $this->appkey, $post_string);

		$url = "http://passport.xyzs.com/login.php";
		$ret = curl_request($url, $post_string);
		if(!$ret) {
			return false;
		}
		$ret = json_decode($ret, true);
		return $ret;
	}

	/**
	 * 修改用户信息
	 * appinfo = array('nick'=>1, 'idcard'=>1, 'sex'=>1, 'birth'=>1, 'address'=>1, 'safeq1'=>1, 'safea1'=>1);
	 */
	public function chgAccountInfo($uid, $token, $appinfo)
	{
		if(!$uid || !is_numeric($uid) || $uid <= 0) {
			return false;
		}
		$post_string = "";
		if(!is_array($appinfo) || !$appinfo) {
			return false;
		}
		$appinfo['uid'] = $uid;
		$appinfo['appid'] = $this->appid;
		$appinfo['token'] = $token;
		$sign = gen_safe_sign($appinfo, $this->appkey, $post_string);
		$url = "http://passport.xyzs.com/chgAccountInfo.php";
		$ret = curl_request($url, $post_string);
		if(!$ret) {
			return false;
		}
		$ret = json_decode($ret, true);
		return $ret;
	}

	/**
	 * 生成随机用户名
	 */
	public function genAccount()
	{
		$post_string = "";
		$appinfo = array();
		$appinfo['appid'] = $this->appid;
		$appinfo['time'] = time();
		$sign = gen_safe_sign($appinfo, $this->appkey, $post_string);
		$url = "http://passport.xyzs.com/genAccount.php";
		$ret = curl_request($url, $post_string);
		if(!$ret) {
			return false;
		}
		$ret = json_decode($ret, true);
		return $ret;
	}

    /**
     * 重置密码
     */
    public function restPwd($account, $newpwd, $code = '',$adminid = 0)
    {
        $post_string = "";
        $appinfo = array();
        $appinfo['adminid']  = $adminid;
        $appinfo['account'] = $account;
        $appinfo['newpwd']   = $newpwd;
        $appinfo['code']   = $code;
        $sign = gen_safe_sign($appinfo, $this->appkey, $post_string);
        $url = "http://passport.xyzs.com/resetPassword.php";
        $ret = curl_request($url, $post_string);
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }
    
    /**
     * 重置密保
     */
    public function restPwdSafe($uid, $type)
    {
        if(!$uid || !$type) {
                return false;
        }
        $post_string = "";
        $post_param = array('uid' => $uid, 'type' => $type);
        $sign = gen_safe_sign($post_param, $this->appkey, $post_string);
        $url = "http://passport.xyzs.com/resetPwdSafe.php";
        $ret = curl_request($url, $post_string);
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }
    /**
     * 根据UID获取帐号
     */
    public function getAccountByUid($uid)
    {
        $post_string = "u=".$uid;
        $sign = 'lkjIU5O7y'.date('Y').'98768Hhkjhiuy'.date('m').'78HK87hl'.date('d').'ihKLh98';
        $post_string .= '&sign='.$sign;
        $url = "http://passport.xyzs.com/getAccount.php";
        $ret = curl_request($url, $post_string, 'get');
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    /**
     * 根据账号获取UID
     */
    public function getUidByAccount($account)
    {
        $post_string = "a=".$account;
        $sign = 'lkjIU5O7y'.date('Y').'98768Hhkjhiuy'.date('m').'78HK87hl'.date('d').'ihKLh98';
        $post_string .= '&sign='.$sign;
        $url = "http://passport.xyzs.com/getUid.php";
        $ret = curl_request($url, $post_string, 'get');
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    /**
     * 根据UID获取帐号 手机号码、邮箱地址中间有加密处理
     */
    public function getAccountByUidNew($uid, $token)
    {
        if(!$uid || !$token) {
            return false;
        }

        $post_string = "";
        $post_param  = array(
            'uid'       => $uid,
            'token'     => $token,
            'appid'     => $this->appid
        );
        $sign = gen_safe_sign($post_param, $this->appkey, $post_string);
        $url  = "http://passport.xyzs.com/getAccountInfo.php";
        $ret  = curl_request($url, $post_string);
        if(!$ret) {
            return false;
        }
        return json_decode($ret, true);
    }

    //手机注册时，发送手机验证码
    public function sendCode($phone)
    {
        if(!$phone) {
            return false;
        }
        $post_string = "";
        $post_param  = array('number' => $phone, 'appid' => $this->appid, 'type' => 'mobile');
        $sign        = gen_safe_sign($post_param, $this->appkey, $post_string);

        $url = "http://passport.xyzs.com/regVerifyCode.php";
        $ret = curl_request($url, $post_string);

        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    /**
     * 手机号码注册
     */
    public function createMobileAccount($phone, $code, $pwd, $source='pc')
    {
        if(!$phone || !$code || !$pwd) {
            return false;
        }
        $post_string = "";
        $post_param  = array('account' => $phone, 'code' => $code, 'appid' => $this->appid, 'password1' => $pwd, 'password2' => $pwd,'type' => 'mobile', 'source' => $source);
        $sign        = gen_safe_sign($post_param, $this->appkey, $post_string);

        $url = "http://passport.xyzs.com/createAccount.php";
        $ret = curl_request($url, $post_string);
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    //修改密保(手机、邮箱)信息时，发送给原手机、邮箱的验证信息
    public function sendEditCodeToOld($uid, $token, $type = 'mobile', $extra = '')
    {
        if(!$uid || !$token || !$type) {
            return false;
        }
        $post_string = "";
        $post_param  = array(
            'appid'    => $this->appid,
            'uid'      => $uid,
            'type'     => $type,
            'token'    => $token,
            'terminal' => 'web',
            'callback' => urlencode($extra)
        );
        $sign        = gen_safe_sign($post_param, $this->appkey, $post_string);
        $url = "http://passport.xyzs.com/orgVerifyCode.php";
        $ret = curl_request($url, $post_string);

        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    //检测证码是否正确
    public function checkVerifyCode($uid, $number, $code, $type)
    {
        if(!$uid || !$number || !$code || !$type) {
            return false;
        }
        $post_string = "";
        $post_param  = array('uid' => $uid, 'appid' => $this->appid, 'number' => $number, 'code' => $code, 'type' => $type);
        $sign        = gen_safe_sign($post_param, $this->appkey, $post_string);
        $url = "http://passport.xyzs.com/checkVerifyCode.php";
        $ret = curl_request($url, $post_string);

        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    //修改密保(手机、邮箱)信息时，发送给新手机、邮箱的验证信息
    public function sendEditCodeToNew($uid, $number, $token, $type = 'phone', $extra = '')
    {
        if(!$uid || !$number || !$token || !$type) {
            return false;
        }
        $post_string = "";
        $post_param  = array('uid' => $uid, 'number' => urldecode($number), 'appid' => $this->appid, 'type' => $type, 'token' => $token, 'callback' => urlencode($extra));
        $sign        = gen_safe_sign($post_param, $this->appkey, $post_string);
        $url = "http://passport.xyzs.com/genVerifyCode.php";
        $ret = curl_request($url, $post_string);

        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    //修改邮箱密保
    public function editboundMobile($uid, $number, $code, $token)
    {
        if(!$uid || !$number || !$code || !$token) {
            return false;
        }

        $post_string = "";
        $post_param  = array(
            'uid'       => $uid,
            'number'    => $number,
            'code'      => $code,
            'type'      => 'mobile',
            'token'     => $token,
            'appid'     => $this->appid
        );
        $sign = gen_safe_sign($post_param, $this->appkey, $post_string);
        $url  = "http://passport.xyzs.com/boundMobile.php";
        $ret  = curl_request($url, $post_string);
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    public function getBoundInfo($account)
    {
        if(!$account) {
            return false;
        }

        $post_string = "";
        $post_param  = array(
            'account'   => $account,
            'appid'     => $this->appid
        );
        $sign = gen_safe_sign($post_param, $this->appkey, $post_string);

        $url = "http://passport.xyzs.com/getBoundInfo.php";
        $ret = curl_request($url, $post_string);
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    public function sendRandPwd($uid, $type)
    {
        if(!$uid || !$type) {
            return false;
        }

        $post_string = "";
        $post_param  = array(
            'uid'       => $uid,
            'appid'     => $this->appid,
            'type'      => $type,
        );
        $sign = gen_safe_sign($post_param, $this->appkey, $post_string);

        $url = "http://passport.xyzs.com/sendRandPwd.php";
        $ret = curl_request($url, $post_string);
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    //获取密保问题列表
    public function getSafeQ()
    {
        $url = "http://passport.xyzs.com/getSafeQ.php";
        $ret = curl_request($url, '');
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    //检测密保答案是否正确
    public function checkSafeQ($uid, $safea1, $safea2)
    {
        if(!$uid || !$safea1 || !$safea2) {
            return false;
        }

        $post_string = "";
        $post_param  = array(
            'uid'       => $uid,
            'appid'     => $this->appid,
            'safea1'    => $safea1,
            'safea2'    => $safea2,
        );
        $sign = gen_safe_sign($post_param, $this->appkey, $post_string);

        $url = "http://passport.xyzs.com/checkSafeQ.php";
        $ret = curl_request($url, $post_string);
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    public function resetPassword($account, $newpwd)
    {
        if(!$account || !$newpwd) {
            return false;
        }

        $post_string = "";
        $post_param  = array(
            'account'   => $account,
            'appid'     => $this->appid,
            'newpwd'    => md5($newpwd),
        );
        $sign = gen_safe_sign($post_param, $this->appkey, $post_string);
        $url  = "http://passport.xyzs.com/resetPassword.php";
        $ret  = curl_request($url, $post_string);
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    //应用帐号修改
    public function updateAppAccount($appinfo)
    {
            $post_string = "";
            $sign = gen_safe_sign($appinfo, '582df15de91b3f12d8e710073e43f4f8', $post_string);
            $url = "http://passport.xyzs.com/upAppUid.php";
            $ret = curl_request($url, $post_string);
            if(!$ret) {
                    return false;
            }
            $ret = json_decode($ret, true);
            return $ret;
    }

    //第三方登录绑定XY账号
    public function oauthBound($openid, $type, $nick='', $source='', $macaddr='', $avatar='')
    {
        if(!$openid || !$type) {
            return false;
        }

        $post_string = "";
        $post_param  = array(
            'appid'     => $this->appid,   //必传,appid
            'openid'    => $openid,  //必传,授权ID
            'type'      => $type,    //必传,账号类型：qq,weibo
            'source'    => $source,  //渠道来源
            'macaddr'   => $macaddr, //设备号
            'avatar'    => $avatar,  //用户头像
            'nick'      => $nick,    //用户昵称
        );
        $sign = gen_safe_sign($post_param, $this->appkey, $post_string);
        $url  = "http://passport.xyzs.com/oauthBound.php";
        $ret  = curl_request($url, $post_string);
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }

    //修改密码
    public function chgPassword($uid, $token, $oldpwd, $newpwd1, $newpwd2)
    {
        if(!$uid || !$token || !$oldpwd || ! $newpwd1 || !$newpwd2) {
            return false;
        }
        $post_string = "";
        $post_param  = array(
            'appid'     => $this->appid,   //必传,appid
            'uid'       => $uid,
            'token'     => $token,
            'oldpwd'    => $oldpwd,
            'newpwd1'   => $newpwd1,
            'newpwd2'   => $newpwd2,
        );
        $sign = gen_safe_sign($post_param, $this->appkey, $post_string);
        $url  = "http://passport.xyzs.com/chgPassword.php";
        $ret  = curl_request($url, $post_string);
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret;
    }
    
    //获取设备的马克地址
    function genGuid($namespace = '') {    
        $uid   = uniqid('', true);
        $data  = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        $data .= $_SERVER['LOCAL_ADDR'];
        $data .= $_SERVER['LOCAL_PORT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        $guid = substr($hash,  0,  8) .
                '-' .
                substr($hash,  8,  4) .
                '-' .
                substr($hash, 12,  4) .
                '-' .
                substr($hash, 16,  4) .
                '-' .
                substr($hash, 20, 12) ;
        return $guid;
    }

    public function getNotice($uid, $token)
    {
        if(!$uid || !$token) {
            return false;
        }
        $post_string = "";
        $post_param  = array(
            'appid'     => $this->appid,   //必传,appid
            'uid'       => $uid,
            'token'     => $token,
            'terminal'  => 1,
            'dtype'     => 1,
            'cartid'    => 1,
            'channel'   => 1,
            'version'   => 1,
        );
        $sign = gen_safe_sign($post_param, $this->appkey, $post_string);
        $url  = "http://interface.xyzs.com/v2/sdk/notice/index";
        $ret  = curl_request($url, $post_string);
        if(!$ret) {
            return false;
        }
        $ret = json_decode($ret, true);
        return $ret['data'];
    }

}