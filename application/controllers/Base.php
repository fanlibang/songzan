<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once APPPATH . 'controllers/Common.php';

class Base extends Common
{
    const DEFAULT_PAGE_LIST = 5;//默认分页
    const MD5_STR_PREFIX = 'xyzs@l#s￥m%&!*';//md5 加密前缀字符串
    const VALIDATE_CODE = false;
    const SMS_LOGIN = 3;//false 不需要 1 pc 2 mobile 3 全部

    public $user_info = array();//登录用户信息 session


    /**
     * 无权限判断访问的地址设置
     * @var array
     */
    private $free_url = array();

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        #载入后台权限操作相关(管理员 菜单 角色)
        $this->Users = new \Xy\Application\Models\UserModel();
        $this->UserWx = new \Xy\Application\Models\UserWxModel();
        //set_cookie('openId', '');exit;
        //set_cookie('openId', 'oRNe1s0avPHH7yRP4MpzjM-30u0I');exit;

        if (!$this->isLogin()) {
            if (is_weixin()) {
                $this->_data['browser'] = 1; //微信浏览器
                $controller = ucfirst($this->router->fetch_class());
                if ($controller != 'Publics') {
                    $this->isOpenid();
                }
            } else {
                $this->_data['browser'] = 2; //其他浏览器
            }
        }
        /**
         * //配置模板路径
         * $this->_more_view_path = PROJECT_NAME;
         * $controller = ucfirst($this->router->fetch_class());
         * if($controller != 'Publics' && $controller != 'Article') {
         * $res = $this->isLogin();
         * }
         * $this->_data['openId'] = get_cookie('openId');
         * if($controller == 'Index') {
         * if($res['status'] == '2') {
         * redirect(site_url('User', 'center'));
         * }
         * }*/

    }

    /**
     * 判断是否在无权限访问
     */
    public function isLogin()
    {
        $token = get_cookie('token');
        if ($token) {
            $userInfo = $this->Users->getUserToken($token);
            if (!empty($userInfo)) {
                return $userInfo;
            }
        }
        return false;
    }

    /**
     * 判断是否在无权限访问
     */
    public function isOpenid()
    {
        $openid = get_cookie('openId');
        if (!empty($openid)) {
            $weixinInfo = $this->UserWx->getWxInfoByOpId($openid);
            if (!empty($weixinInfo)) {
                $res = $this->Users->getUserInfoByOpId($openid);
                if (!empty($res)) {
                    $token = $res['token'];
                    set_cookie('token', $token);
                    if ($res['master_uid'] > 0) {
                        $url = site_url('Invite', 'info');
                        header('Location:' . $url);
                    } else {
                        $url = site_url('User', 'center');
                        header('Location:' . $url);
                    }
                }
                return true;
            }
        }
        $this->getOpenid();
    }


    /**
     * 操作跳转提示方法
     * @param null $url
     * @param null $message
     * @param null $app_id
     */
    protected function redirectTips($url = null, $message = null, $app_id = null)
    {
        redirect(site_url('Publics', 'tips', array('url' => $url, 'message' => $message, 'app_id' => $app_id)));
    }

    /**
     * 渲染 main 模板
     * @param array $data
     * @param null $view
     */
    public function displayMain($data = array(), $view = null)
    {
        if ($view == null) {
            $view = $this->_more_view_path . '/' . strtolower($this->router->fetch_class()) . '/' . $this->router->fetch_method();
        } else {
            $view = $this->_more_view_path . '/' . $view;
        }

        $jsSdk = new Location(APPID, SECRET); //实例化引入文件的类，并将2个参数传进去，自己在微信公众后台看
        $signPackage = $jsSdk->GetSignPackage(); //获取jsapi_ticket，生成JS-SDK权限验证的签名。
        $data['wx'] = $signPackage;

        $data = array_merge($this->_data, $data);

        $data['main_html'] = $this->load->view($view, $data, true);

        $this->load->view($this->_more_view_path . '/' . 'publics/main', $data);

        //统计页面访问量
        $url_info = $this->_data;
        if (strtolower($this->router->fetch_class()) == 'article') {
            $this->view_play($this->_data['openId'], $data['id']);
        }
        //$url = '/'.PROJECT_NAME.'/'.$url_info['controller'].'/'.$url_info['method'];
        $url = '/dev/' . $url_info['controller'] . '/' . $url_info['method'];
        $this->view_assess($url);
        //调试页面执行时间用
        if (IS_DEBUG) {
            echo 'page_run_time:</br>';
            var_dump(code_run_time());
        }
    }

    /**
     * 密码md5加密后截取
     * @param $pwd
     * @return string
     */
    public function pwdMd5($pwd)
    {
        return substr(md5($pwd . self::MD5_STR_PREFIX), 0, 10);
    }


    /**
     * 登录发送验证码
     */
    public function phoneSmsSendByLogin()
    {
        if (IS_GET) {
            $iphone = $this->input->get('iphone', true);

            //set_cookie($iphone, 123456);
            //$this->AjaxReturn(self::AJ_RET_SUCC, '获取短信成功,5分钟内有效#');exit;
            $sms_str = rand_str(6);
            $sms_notice_obj = new SendSms();
            $sms_ret = $sms_notice_obj->send($iphone, $sms_str);
            if ($sms_ret['code'] == 200) {
                set_cookie($iphone, $sms_str);
                $this->AjaxReturn(self::AJ_RET_SUCC, '获取短信成功,5分钟内有效#');
            } else {
                $this->AjaxReturn(self::AJ_RET_FAIL, $sms_ret['msg']);
            }
        } else {
            $this->AjaxReturn(self::AJ_RET_FAIL, '请求失败~');
        }
    }


    /**
     * ajax返回格式
     * @param int $code
     * @param null $msg
     * @param null $rel
     * @param null $data
     */
    public function AjaxReturn($code = self::AJ_RET_SUCC, $msg = null, $rel = null, $data = null)
    {
        $arr["code"] = $code;
        $arr["msg"] = $msg;
        $arr["forward"] = $rel;
        $arr["data"] = $data;
        echo json_encode($arr);
        exit;
    }


    /**
     *  获取用户openid，保存名片用
     * @param string $url
     */
    public function getOpenid($url = '')
    {
        $state = rand(1,10000);
        $appid = APPID;
        if (empty($url)) {
            $url = site_url('Publics', 'addOpenid');
        }
        //echo $url;exit;
        $redirect_uri = urlencode($url);
        //对url处理，此url为访问上面jump方法的url
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_base&state=$state#wechat_redirect";
        header('Location:' . $url);
    }

    /**
     *  获取用户openid，保存名片用
     * @param string $url
     */
    public function getWxInfo($url = '')
    {
        $state = '222';
        $appid = APPID;
        if (empty($url)) {
            $url = site_url('Publics', 'jump');
        }
        //echo $url;exit;
        $redirect_uri = urlencode($url);
        //对url处理，此url为访问上面jump方法的url
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=$state#wechat_redirect";
        header('Location:' . $url);
    }
}
