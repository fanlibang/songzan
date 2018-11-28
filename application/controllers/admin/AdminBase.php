<?php
defined('BASEPATH') or exit('No direct script access allowed');


include_once APPPATH . 'controllers/Common.php';

class AdminBase extends Common
{
    /**
     * 后台公用APPID
     * @var intAdmin
     */
    protected $appId = 1;
    /**
     * 后台公用Token值
     * @var string
     */
    protected $token = '8zVbpn5CaEs3ih8r1Noawj0QhvNOaSJk';

    const DEFAULT_PAGE_LIST     = 100;//默认分页
    const MD5_STR_PREFIX        = 'xyzs@l#s￥m%&!*';//md5 加密前缀字符串
    const SMS_LOGIN             = 3;//false 不需要 1 pc 2 mobile 3 全部
    const VALIDATE_CODE         = false;
    const MORE_LOGIN            = true;//是否开启多种登录模式 true 为开启 false 关闭

    //超级管理员用户id组
    public $super_admin_ids = array(
        312,//dongjw
        1398,//huangchunchang
        2827,//xuj
        3358,//bianhy
        3503,//huyw
        3325,//libaolong
        1299,//lifl
    );

    //管理app 角色 编号 运营总监 及开发相关人员
    protected $manager_app_role_ids = array(2,6,7,8);

    public $admin_user_info = array();

    public $_is_main_html = false;

    /**
     * 无权限判断访问的地址设置
     *
     * @var array
     */
    private $free_url       = array(
        'Api'               => '*',
        'DataCenter'        => '*',
        'Publics'           => '*',
        'Tool'              => '*',
        'Login'             => '*',
    );


    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();

        #载入后台权限操作相关(管理员 菜单 角色)
        $this->AdminUsers           = new \Xy\Application\Models\AdminUsersModel();
        $this->AdminCates           = new \Xy\Application\Models\AdminCatesModel();


        //手机访问 1pc 非1手机
        $get_moblie_status = 1;//get_cookie('moblie_status');

        //入口模板判断
        if ($this->agent->is_mobile()) {
            if ($get_moblie_status == '' || $get_moblie_status != 1) {
                //配置模板路径
                $this->_more_view_path = PROJECT_NAME . '_m';
                $this->_is_main_html = true;
            } else {
                $this->_more_view_path = PROJECT_NAME;
            }
        } else {
            $this->_more_view_path = PROJECT_NAME;
        }

        //获取用户登录的session信息
        $this->admin_user_info = $this->session->get_userdata();
        $this->admin_user_info['id'] = get_cookie('admin_user_id');
        $this->admin_user_info['tel'] = 111;
        $this->admin_user_info['user_name'] = get_cookie('admin_user_name');

        //页面变量
        $this->_data['more_login']      = self::MORE_LOGIN;//是否开启多种登录模式 true 为开启 false 关闭
        $this->_data['sms_login']       = XY_ENVIRONMENT == 'production' ? self::SMS_LOGIN : false;//0 不需要 1 pc 2 mobile 3 全部
        $this->_data['validate_code']   = XY_ENVIRONMENT == 'production' ? self::VALIDATE_CODE : false;//true 需要 false 不要

        $this->_data['is_super_admin']  = isset($this->admin_user_info['id']) ? (in_array($this->admin_user_info['id'], $this->super_admin_ids) ? true : false) : false;
        $this->_data['dwz_path']        = $this->_data['assets_path'] . 'dwz/';
        $this->_data['page_list_arr']   = array(30, 50, 100, 200, 300, 500, 1000, 2000);
        $this->_data['site_title']      = 'XYZS 信息管理中心';
        $this->_data['copyright']       = 'Copyright &copy; 2014 xyzs-php开发小组 沪网文[2010]0352-001 ICP证：沪B2-20100077 沪ICP备10215773号-19';
        $this->_data['copyright_m']     = 'Copyright &copy; 2014 xyzs-php开发小组';
        $this->_data['admin_user_info'] = $this->admin_user_info;
        $this->_data['super_admin_ids'] = $this->super_admin_ids;
        //验证是否登录
        if (!$this->isLogin() && !in_array($this->_data['method'], array('phoneSmsSendByLogin', 'phoneSmsSendByRegister', 'webClick'))) {
            if (is_ajax() && !in_array($this->_data['controller'], array('Login', 'Api'))) {
                $this->dwzAjaxReturn(self::AJ_RET_NOLOGIN, '登录失效，请重新登录~');
            }
        }
    }

    /**
     * 设置默认权限
     *
     * @param null $user_id
     * @return bool
     */
    public function addDefaultCates($user_id = null)
    {
        if ($user_id == null) {
            return false;
        }
        $batch = array(
            array('cate_id'   => 1, 'user_id'   => $user_id),
            array('cate_id'   => 39, 'user_id'   => $user_id),
            array('cate_id'   => 40, 'user_id'   => $user_id),
            array('cate_id'   => 41, 'user_id'   => $user_id)
        );
        $ret = $this->AdminCateHasUsers->addBatch($batch);

        return $ret;
    }

    /**
     * 验证用户是否存在
     *
     * @param null $user_name
     * @param null $tel
     * @param null $email
     * @param null $id
     * @return bool
     */
    public function checkUserInfo($user_name = null, $tel= null, $email = null, $id = null)
    {
        $where = array();
        if ($user_name) {
            $where['or_where']['user_name'] = $user_name;
        }

        if ($tel) {
            $where['or_where']['tel'] = $tel;
        }

        if ($email) {
            $where['or_where']['email'] = $email;
        }

        $info = $this->AdminUsers->getOne($where);

        return empty($info) || $info['id'] == $id ? false : $info;
    }

    /**
     * 根据用户id查询用户信息 Api.php用
     *
     * @param null $id
     * @return bool
     */
    public function checkUserInfoById($id = null)
    {
        if (!isset($id) || !is_numeric($id)) {
            return false;
        }
        $where = array();

        if ($id) {
            $where['where']['id'] = $id;
        }

        $info = $this->AdminUsers->getOne($where);

        return empty($info) ? false : $info;
    }

    /**
     * 判断用户是否有权限
     */
    public function isAction()
    {
        $controller = ucfirst($this->router->fetch_class());
        $controller = $controller ? $controller : 'Index';
        $method = $this->router->fetch_method();
        $method = $method ? $method : 'index';

        if($method == 'httpUploadFile' || $method == 'localUploadFile2'){
            return true;
        }
        $user_id = isset($this->admin_user_info['id']) ? $this->admin_user_info['id'] : null;

        //超级管理员拥有所有权限
        if (in_array($user_id, $this->super_admin_ids)) {
            return true;
        }

        $cate_url = $controller.'/'.$method;

        //判断是否在无权限设置设置数组中
        if (isset($this->free_url[$controller])) {
            if ($this->free_url[$controller] == '*' || in_array($method, $this->free_url[$controller])) {
                return true;
            }
        }

        $role_ids = array_index_value($this->AdminUserHasRoles->getAll(array('user_id' =>$user_id)), 'role_id', 'role_id');

        if(in_array(26, $role_ids)){
            if(in_array($controller, $this->special_url[26])){
                return true;
            }
        }

        if(in_array(27, $role_ids)){
            if(in_array($controller, $this->special_url[27])){
                return true;
            }
        }

        if(in_array(29, $role_ids)){
            if(in_array($controller, $this->special_url[29])){
                return true;
            }
        }
        if(in_array(30, $role_ids)){
            if(in_array($controller, $this->special_url[30])){
                return true;
            }
        }


        //检查管理菜单是否加入到后台管理菜单中
        $where = array('url' => $cate_url);
        $cate_info = $this->AdminCates->getOne($where);

        if ($cate_info) {
            $user_cate_ids = $this->getCateIdsByUserId($user_id);

            if (in_array($cate_info['id'], $user_cate_ids)) {
                return true;
            } else {
                //没有权限
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 登录用户根据请求地址判断用户权限
     *
     * @param null $url
     * @return bool
     */
    protected function isActionByUrl($url = null)
    {
        $user_id = get_cookie('admin_user_id');

        //超级管理员拥有所有权限
        if (in_array($user_id, $this->super_admin_ids)) {
            return true;
        }

        if ($url == null) {
            return false;
        }

        $where = array('url' => $url);
        $cate_info = $this->AdminCates->getOne($where);

        if ($cate_info) {
            $user_cate_ids = $this->getCateIdsByUserId($user_id);

            if (in_array($cate_info['id'], $user_cate_ids)) {
                return true;
            } else {
                //没有权限
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 判断是否登录
     *
     * @return bool
     */
    public function isLogins()
    {
        $cookie_admin_user_id = get_cookie('admin_user_id');

        if ($cookie_admin_user_id) {
            return true;
        }

        return false;
    }

    /**
     * 获取 Dev 用户信息 （可批量）
     *
     * @param null $ids
     * @return array|mixed|null|number
     */
    public function getDevUsersByUserIds($ids = null){
        $ret = array();

        $search_ids = array();

        if(is_numeric($ids)){
            $search_ids = array($ids);
        }

        if(is_array($ids) && !empty($ids)){
            $search_ids = $ids;
        }

        if(!empty($search_ids)){
            $ret = array_index_value($this->DevUser->getAll(array('where_in' => array('id' => $search_ids))), 'id');
        }

        return $ret;
    }

    /**
     * 获取用户所有的权限分类ID
     *
     * @param $user_id
     * @return array
     */
    public function getCateIdsByUserId($user_id)
    {
        static $caches = array();

        if (isset($caches[$user_id])) {
            return $caches[$user_id];
        } else {
            $rcate_ids = $this->AdminCateHasRoles->getCateIdsByUserId($user_id);
            $rcate_ids = !empty($rcate_ids) ? array_index_value($rcate_ids, 'cate_id', 'cate_id') : array();

            $ucate_ids = array();

            if (in_array($user_id, $this->super_admin_ids)) {
                //超级管理员是所有菜单
                $cate_ids = $this->AdminCates->getAll();

                foreach ((array)$cate_ids as $k => $v) {
                    $ucate_ids[] = $v['id'];
                }
            } else {
                $cate_ids = $this->AdminCateHasUsers->getCateIdsByUserId($user_id);

                foreach ((array)$cate_ids as $k => $v) {
                    $ucate_ids[] = $v['cate_id'];
                }
            }

            $ucate_ids = !empty($ucate_ids) ? $ucate_ids : array();

            $has_cate_ids = array_unique(array_merge($rcate_ids, $ucate_ids));

            $caches[$user_id] = $has_cate_ids;

            return $has_cate_ids;
        }
    }

    /**
     * 获取用户角色信息
     *
     * @param $user_id
     * @return bool
     */
    public function getRolesByUserId($user_id)
    {
        if ((!$user_id || !is_numeric($user_id)) &&  $user_id != 1) {
            return false;
        }

        if (in_array($user_id, $this->super_admin_ids)) {
            //超级管理员是所有权限
            $list = $this->AdminRoles->getAll();
        } else {
            $list = $this->AdminUserHasRoles->getRolesByUserId($user_id);
        }

        return $list;
    }

    /**
     * 密码md5加密后截取
     *
     * @param $pwd
     * @return string
     */
    public function pwdMd5($pwd)
    {
        return substr(md5($pwd.self::MD5_STR_PREFIX), 0, 10);
    }

    /**
     * 检查用户是否有 Dev app的 管理权限
     *
     * @return bool
     */
    public function checkUserHasDevAppPermission()
    {
        $user_id = isset($this->admin_user_info['id']) ? $this->admin_user_info['id'] : null;

        //超级管理员拥有所有权限
        if (in_array($user_id, $this->super_admin_ids)) {
            return true;
        } else {
            $role_list = $this->getRolesByUserId($user_id);

            $has_role = false;
            foreach ((array)$role_list as $k => $v) {
                if ($has_role == false && in_array($v['id'], $this->manager_app_role_ids)) {
                    $has_role = true;
                }
            }
        }

        return $has_role;
    }

    /**
     * 检查用户是否有 Dev app的 操作权限
     *
     * @param null $app_id
     * @param int $type
     * @return bool
     */
    public function checkUserHasDevAppOperationPermission($type = 1, $app_id = null)
    {
        $user_id = isset($this->admin_user_info['id']) ? $this->admin_user_info['id'] : null;

        $check_user = $this->checkUserHasDevAppPermission();

        $app_publish_manager        = read_config('admin.app_publish_manager');

        $show_all = false;

        if($check_user){
            $show_all = true;
        }

        $search_type = null;

        if($type == 1){
            $app_publish_manager_arr    =$app_publish_manager['ios']['user_ids'];

            if(in_array($user_id, $app_publish_manager_arr[0]) && in_array($user_id, $app_publish_manager_arr[1])){
                $check_user = true;
            }else{
                if(in_array($user_id, $app_publish_manager_arr[0])){
                    $search_type = 0;
                }elseif(in_array($user_id, $app_publish_manager_arr[1])){
                    $search_type = 1;
                }

                if(in_array($search_type, array(0,1)) && is_numeric($search_type)){
                    $check_user = true;
                }
            }
        }elseif($type == 2){
            $app_publish_manager_arr    = $app_publish_manager['android']['user_ids'];

            if(in_array($user_id, $app_publish_manager_arr)){
                $check_user = true;
            }
        }

        if ($check_user) {
            $app_ids = true;
        } else {
            $app_ids = $this->AdminUserHasApps->getAppIdsByUserId($user_id, (int)$type);
        }

        if ($app_ids && !empty($app_ids)) {
            $app_info = array();
            $check_permission = false;

            if ($app_id && is_numeric($app_id)) {
                if ($type == 1) {
                    $app_info = $this->DevIosGame->getOne(array('itunesid' => $app_id));
                } elseif ($type == 2) {
                    $app_info = $this->DevAndroidGame->getOne(array('f_appid' => $app_id));
                }

                $check_permission = is_array($app_ids) ? (in_array($app_id, $app_ids) ? true : false) : false;
            }

            /**
             * app_info         应用信息
             * app_ids          用户拥有管理应用id(多个)
             * check_permission 检查用户管理应用权限
             * check_manager    检查用户是否有分配管理应用的权限
             */
            $result = array('app_info' => $app_info, 'app_ids' => $app_ids, 'check_permission' => $check_permission, 'check_manager' => $check_user);

            //特殊权限判断添加
            if($show_all == false){
                if($type == 1){
                    $result['add_where'] = array(
                        'fatheritunesid'    => 0
                    );

                    if(in_array($search_type, array(0, 1)) && is_numeric($search_type)){
                        $result['add_where']['type']    = $search_type;
                    }
                }
            }

            return $result;
        } else {
            return false;
        }
    }

    /**
     * 检测应用证书信息(非渠道)
     *
     * @param null $app_id
     * @return bool
     */
    protected function iosSignCertCheck($app_id = null)
    {
        if (empty($app_id) || !is_numeric($app_id)) {
            return false;
        }

        $special_sign_app = read_config('common.special_sign_app');

        $certs      = $special_sign_app[$app_id];

        if (!empty($certs)) {
            $cert_arr = explode(',', $certs);
        } else {
            $cert_arr = read_config('common.special_sign_cert');
        }

        return $cert_arr;
    }

    /**
     * 可用证书列表
     *
     * @return array
     */
    public function iosSignCertList(){
        $special_sign_app = read_config('common.special_sign_app');

        $list = array();
        foreach((array)$special_sign_app as $k => $v){
            $cert_arr = explode(',', $v);
            foreach((array)$cert_arr as $vk => $vv){
                $list[] = $vv;
            }
        }

        $special_sign_cert_arr = read_config('common.special_sign_cert');
        foreach((array)$special_sign_cert_arr as $sk => $sv){
            $list[] = $sv;
        }

        $channel_sign_cert_arr = read_config('common.channel_sign_cert');

        foreach((array)$channel_sign_cert_arr as $ck => $cv){
            $list[] = $cv;
        }

        return array_unique($list);
    }

    /**
     * 检测应用证书信息(渠道)
     *
     * @param null $app_id
     * @return bool
     */
    protected function iosSignChannelCertCheck($app_id = null)
    {
        if (empty($app_id) || !is_numeric($app_id)) {
            return false;
        }

        $special_sign_app = read_config('common.special_sign_app');

        $certs      = $special_sign_app[$app_id];

        if (!empty($certs)) {
            $cert_arr = explode(',', $certs);
        } else {
            $cert_arr = read_config('common.channel_sign_cert');
        }

        return $cert_arr;
    }

    /**
     * 获取签名证书信息
     *
     * @param null $app_id              签名id
     * @param int $is_first             是否是签名一个证书
     * @param bool|false $is_channel    是否是签名渠道包
     * @param bool|true $return_title   是否反面证书对应简称
     * @return array|bool
     */
    protected function iosSignCertInfo($app_id = null, $is_first = 1, $is_channel = false, $return_title = true)
    {
        if ($is_channel) {
            $cert_arr = $this->iosSignChannelCertCheck($app_id);
        } else {
            $cert_arr = $this->iosSignCertCheck($app_id);
        }

        if ($cert_arr) {
            if ($return_title) {
                if ($is_first == 1) {
                    $cert_ids = $cert_arr[0];
                } else {
                    $cert_ids = implode(',', $cert_arr);
                }

                $cert_obj = new Cert();

                $ret = $cert_obj->search($cert_ids);

                if (isset($ret['code']) && $ret['code'] == 200) {
                    $ret_arr = $ret['data']['cert_arr'];

                    foreach ((array)$ret_arr as $k => $v) {
                        $ret_arr[$k]['cert_name'] = $v['cert_name'] . '.mobileprovision';
                    }

                    return $ret_arr;
                } else {
                    return array('ret_data' => $ret);
                }
            } else {
                return $cert_arr;
            }
        } else {
            return array();
        }
    }

    /**
     * 状态选择合并
     *
     * @param array $arr
     * @return array
     */
    protected function select_status_merge($arr = array())
    {
        $add_arr = array(9999 => '全部');
        return $add_arr+$arr;
    }

    /**
     * 登录发送验证码
     */
    public function phoneSmsSendByLogin()
    {
        $user_name      = $this->input->get('user_name', true);
        $password       = $this->input->get('password', true);
        $validate_code  = $this->input->get('validate_code', true);

        if (empty($user_name)) {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '请输入登录账号');
        }

        if (empty($password)) {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '请输入登录密码');
        }

        if (empty($validate_code) && self::VALIDATE_CODE) {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '请输入验证码');
        }

        $user_info = $this->checkUserInfo($user_name);

        if (empty($user_info)) {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '如第一次用kingnet账号登录无需手机验证码，之后则必须通过手机验证码登录');
        }

        if (empty($user_info['tel'])) {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '请联系系统管理员添加你的管理员绑定手机号码');
        }

        $real_password = $this->pwdMd5($password);

        if ($real_password != $user_info['password']) {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '登录账号或者密码错误');
        }

        $check_validate_code = $this->validateCodeCheck();
        if (!$check_validate_code) {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '验证码错误，请刷新重试~');
        }

        $unms = 3;
        $check_ret = $this->AdminUsers->checkUserPhoneCodeNums($user_info['tel'].'send_login', $unms);

        if ($check_ret) {
            $sms_str = rand_str(6);

            $msg = "XY苹果助手管理后台，验证短信码为：" . $sms_str . "。请勿透漏给他人。";

            $sms_notice_obj = new SmsNotice();
            $sms_ret = $sms_notice_obj->send($user_info['tel'], $msg);//send

            if ($sms_ret['code'] == 200) {
                //生成验证码代码
                $ret = $this->AdminUsers->setUserPhoneCode($user_info['tel'], $sms_str);

                $this->dwzAjaxReturn(self::AJ_RET_SUCC, '获取短信成功,5分钟内有效#'.$ret, dwz_rel('Index', 'index'));
            } else {
                $this->dwzAjaxReturn(self::AJ_RET_FAIL, '获取短信失败,请稍后重试');
            }
        } else {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '请求短信验证次数过于频繁~');
        }
    }

    /**
     * 注册发送验证码
     */
    public function phoneSmsSendByRegister()
    {
        $user_name      = $this->input->get('user_name', true);
        $validate_code  = $this->input->get('validate_code', true);

        if (empty($user_name)) {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '请输入登录账号');
        }

        if (!preg_match("/^1[34578]{1}[0-9]{1}[0-9]{8}$/", $user_name)) {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '手机号码格式错误');
        }

        if (empty($validate_code) && self::VALIDATE_CODE) {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '请输入验证码');
        }

        $check_validate_code = $this->validateCodeCheck();
        if (!$check_validate_code) {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '验证码错误，请刷新重试~');
        }

        $unms = 3;
        $check_ret = $this->AdminUsers->checkUserPhoneCodeNums($user_name.'send_register', $unms);

        if ($check_ret) {
            $sms_str = rand_str(6);

            $msg = "XY苹果助手管理后台，验证短信码为：" . $sms_str . "。请勿透漏给他人。";

            $sms_notice_obj = new SmsNotice();
            $sms_ret = $sms_notice_obj->send($user_name, $msg);//send

            if ($sms_ret['code'] == 200) {
                //生成验证码代码
                $ret = $this->AdminUsers->setUserPhoneCode($user_name, $sms_str);

                $this->dwzAjaxReturn(self::AJ_RET_SUCC, '获取短信成功,5分钟内有效#'.$ret);
            } else {
                $this->dwzAjaxReturn(self::AJ_RET_FAIL, '获取短信失败,请稍后重试');
            }
        } else {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '请求短信验证次数过于频繁');
        }
    }

    /**
     * 短信发送
     */
    public function phoneSmsSend()
    {
        $tel = $this->admin_user_info['tel'];

        $tel = !empty($tel) ? $tel : $this->input->get('tel', true);

        if ($this->phoneSmsCheck($tel)) {
            $unms = 3;
            $check_ret = $this->AdminUsers->checkUserPhoneCodeNums($tel.'send', $unms);

            if ($check_ret) {
                $sms_str = rand_str(6);

                $msg = "XY苹果助手管理后台，验证短信码为：" . $sms_str . "。，请勿透漏给他人。";

                $sms_notice_obj = new SmsNotice();
                $sms_ret = $sms_notice_obj->send($tel, $msg);//send

                if ($sms_ret['code'] == 200) {
                    //生成验证码代码
                    $ret = $this->AdminUsers->setUserPhoneCode($tel, $sms_str);

                    $this->dwzAjaxReturn(self::AJ_RET_SUCC, '获取短信成功,5分钟内有效#'.$ret, dwz_rel('Index', 'index'));
                } else {
                    $this->dwzAjaxReturn(self::AJ_RET_FAIL, '获取短信失败,请稍后重试#'.$sms_ret);
                }
            } else {
                $this->dwzAjaxReturn(self::AJ_RET_FAIL, '请求短信验证次数过于频繁');
            }
        } else {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '手机号码错误#'.$tel);
        }
    }

    /**
     * 手机短信绑定
     */
    public function phoneSmsBind()
    {
        $tel = $this->input->get_post('tel', true);

        $old_tel = $this->input->get_post('old_tel', true);

        $old_tel = $old_tel ? $old_tel : $tel;

        if ($this->phoneSmsCheck($old_tel, true)) {
            $unms = 3;
            $check_ret = $this->AdminUsers->checkUserPhoneCodeNums($old_tel.'bind', $unms);

            if ($check_ret) {
                $user_id = $this->admin_user_info['id'];

                $info = array(
                    'last_ip'       => ip2long($this->input->ip_address()),
                    'last_time'     => time(),
                    'tel'           => $tel
                );

                $ret = $this->AdminUsers->edit($info, array('id' => $user_id));

                if ($ret) {
                    $session_user_info  = array(
                        'tel' => $tel
                    );
                    $this->session->set_userdata($session_user_info);

                    $this->dwzAjaxReturn(self::AJ_RET_SUCC, '绑定成功', dwz_rel('Index', 'index'));
                } else {
                    $this->dwzAjaxReturn(self::AJ_RET_FAIL, '绑定失败');
                }
            } else {
                $this->dwzAjaxReturn(self::AJ_RET_FAIL, '请求短信验证次数过于频繁');
            }
        } else {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '手机验证码错误');
        }
    }


    /**
     * DWZ公共返回数据处理方法
     *
     * @param int $code
     * @param null $msg
     * @param null $rel
     * @param null $data
     * @param string $callback
     * @param null $url
     * @param bool $more_data
     */
    public function dwzAjaxReturn($code = self::AJ_RET_SUCC, $msg = null, $rel = null, $data = null, $callback = 'close', $url = null, $more_data = false)
    {
        if($code == 1) {
            $code = 200;
        }
        if (is_object($data)) {
            $data = get_object_vars($data);
        } elseif (!is_array($data)) {
            $data = array(
                "flag" => $data
            );
        }

        $data["statusCode"] = $code;
        $data["code"]       = $code;
        $data["msg"]        = $msg;
        $data["message"]    = $msg;

        $rel = is_string($rel) && (strpos($rel, "/") !== false || strpos($rel, "_") !== false) ? $rel :dwz_rel($rel);

        $data["navTabId"] = $rel;
        $data["rel"] = $rel;

        switch ($callback) {
            case "forward"://刷新指定窗口
            case "close"://关闭当前窗口
                if ($callback == "forward" && $url) {
                    $data["forwardUrl"] = $url;
                } else {
                    $data["callbackType"] = "closeCurrent";
                }
                break;
            default:
                //不进行页面窗口的操作
                break;
        }

        if ($more_data) {
            $data = array_merge($this->_data, $data);
        } else {
            $data["controller"] = $this->_data["controller"];
            $data["method"] = $this->_data["method"];
        }

        echo $this->output ->set_content_type(self::JSON)->set_output(json_encode($data))->_display();
        exit;
    }

    /**
     * DWZ公共返回数据处理方法
     *
     * @param int $code
     * @param null $msg
     * @param null $rel
     * @param null $data
     * @param string $callback
     * @param null $url
     * @param bool $more_data
     */
    public function dwzBoxReturn($code = self::AJ_RET_SUCC, $msg = null, $rel = null, $data = null, $callback = 'close', $url = null, $more_data = false)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        } elseif (!is_array($data)) {
            $data = array(
                "flag" => $data
            );
        }

        $data["statusCode"] = $code;
        $data["code"]       = $code;
        $data["msg"]        = $msg;
        $data["message"]    = $msg;

        //$rel = strpos($rel, "/") !== false || strpos($rel, "_") !== false ? $rel :dwz_rel($rel);

        $data["navTabId"] = "";
        $data["rel"] = $rel;

        switch ($callback) {
            case "forward"://刷新指定窗口
            case "close"://关闭当前窗口
                if ($callback == "forward" && $url) {
                    $data["forwardUrl"] = $url;
                } else {
                    $data["callbackType"] = "closeCurrent";
                }
                break;
            default:
                //不进行页面窗口的操作
                break;
        }

        if ($more_data) {
            $data = array_merge($this->_data, $data);
        } else {
            $data["controller"] = $this->_data["controller"];
            $data["method"] = $this->_data["method"];
        }

        echo $this->output ->set_content_type(self::JSON)->set_output(json_encode($data))->_display();
        exit;
    }

    /**
     * 导出excel 方法
     *
     * @param $title
     * @param array $data
     */
    public function exportExcel($title, $data = array()){
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=".$title.".xls");
        foreach((array)$data as $val){
            foreach($val as $item){
                echo iconv("UTF-8","GB2312//IGNORE",$item) ."\t";
            }
            echo "\n";
        }
    }

    /**
     * 无限分类格式化成数组
     *
     * @param $items
     * @return array
     */
    public function genTree($items)
    {
        $tree = array(); //格式化的树
        /**
         * 定义树中的所有子孙节点所对应的键值 :
         * 如元素： array('id' => 14, 'pid' => 1, 'name' => '二级14' ),则 $son_keys[9] = "[1]['son'][5]['son'][9]"，
         * 则：$parent[1][14] = 14
         */

        $parent = array();  //以键值作为父节点的子

        /**
         * 定义树中的所有子孙节点所对应的键值:
         * 如 $tree[1]['son'][5]['son'][9]= array('id' => 9, 'pid' => 1, 'name' => '二级13' )
         * 则 $son_keys[9] = "[1]['son'][5]['son'][9]"
         */

        $son_keys = array();

        foreach ($items as $value) {
            //如果当前节点的父亲是一级（暂时是在一级）
            if (isset($tree[$value['pid']])) {
                $tree[$value['pid']]['son'][$value['id']] = $value;

                $son_keys[$value['id']] = "[{$value['pid']}]['son'][{$value['id']}]";
                //如果有以当前节点作为父节点
                if (isset($parent[$value['id']])) {
                    foreach ($parent[$value['id']] as $val) {
                        $tree[$value['pid']]['son'][$value['id']]["son"][$val]=$tree[$val];

                        unset($tree[$val]);

                        $son_keys[$val] = "[{$value['pid']}]['son'][{$value['id']}]['son'][$val]";
                    }
                    unset($parent[$value['id']]);
                }
            } elseif (isset($son_keys[$value['pid']])) { //如果当前节点的父亲类是二级或以上
                $current_key = "{$son_keys[$value['pid']]}['son'][{$value['id']}]";

                $son_keys[$value['id']] = $current_key;

                eval('$tree'.$current_key.'=$value;');
                //如果有以当前节点作为父节点
                if (isset($parent[$value['id']])) {
                    foreach ($parent[$value['id']] as $val) {
                        eval('$tree'.$current_key.'["son"][$val]=$tree[$val];');

                        unset($tree[$val]);

                        $son_keys[$val] = "{$current_key}['son'][$val]";
                    }
                    unset($parent[$value['id']]);
                }
            } else { //当前节点或暂时没有父亲
                $tree[$value['id']] = $value;
                //如果有以当前节点作为父节点
                if (isset($parent[$value['id']])) {
                    foreach ($parent[$value['id']] as $val) {
                        $tree[$value['id']]["son"][$val]=$tree[$val];

                        unset($tree[$val]);

                        $son_keys[$val] = "[{$value['id']}]['son'][$val]";
                    }
                    unset($parent[$value['id']]);
                }
            }
            $parent[$value['pid']][$value['id']] = $value['id'];
        }

        return $tree;
    }



    /**
     *  注销用户信息
     */
    protected function unsetLoginInfo()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('tel');

        delete_cookie('admin_user_id');
        delete_cookie('admin_user_name');
        delete_cookie('oosUserName');
    }

    /**
     * 访问接口方法
     * @param $url
     * @param $params
     * @return bool|mixed
     */
    public function jsonCall($url, $params){
        $post_string = "";
        gen_safe_sign($params, $this->token, $post_string);
//        echo  $post_string;exit;
//        echo $url . '?' . $post_string;exit;//访问地址
        $ret = curl_request($url, $post_string, 'post', 0, 1, 20);
        if (!$ret || empty($ret)) {
            return false;
        }
        return json_decode($ret, true);
    }
    //获取dev上传的所有应用
    public function getAllApp($iosapp_where = array(), $Andapp_where = array()){
        $iosapp_where  = array_filter($iosapp_where);
        $Andapp_where  = array_filter($Andapp_where);
        $ios_where = array('status !=' => 0,'bundleid !=' =>'');
        $And_where = array('status !=' => 0,'f_packagename !=' =>'');

        if($iosapp_where){
            $ios_where = array_merge ($iosapp_where,$ios_where);
        }
        if($Andapp_where){
            $And_where = array_merge ($Andapp_where,$And_where);
        }
        $Android    = $this->DevAndroidGame->getAll($And_where);
        $Ios        = $this->DevIosGame->getAll($ios_where);
        $data       = array();
        if(!empty($Ios)){
            foreach ($Ios as $key => $val) {
                $data[$val['itunesid']]['itunesid'] = $val['itunesid'];
                $data[$val['itunesid']]['title']    = $val['title'];
                $data[$val['itunesid']]['bundleid'] = $val['bundleid'];
                $data[$val['itunesid']]['userid'] = $val['userid'];
                $data[$val['itunesid']]['package_version'] = $val['package_version'];
                $data[$val['itunesid']]['first_class_id'] = $val['first_class_id'];
                $data[$val['itunesid']]['first_class_id'] = $val['first_class_id'];
                $data[$val['itunesid']]['equipmenttype'] = $val['equipmenttype'];
                $data[$val['itunesid']]['is_j_install'] = $val['is_j_install'];
            }
        }
        if(!empty($Android)){
            foreach($Android as $key => $val){
                $data[$val['f_appid']]['itunesid']  = $val['f_appid'];
                $data[$val['f_appid']]['title']     = $val['f_appname'];
                $data[$val['f_appid']]['bundleid']  = $val['f_packagename'];
                $data[$val['f_appid']]['f_version'] = $val['f_version'];
                $data[$val['f_appid']]['userid']    = $val['userid'];
                $data[$val['f_appid']]['f_fatherid'] = $val['f_fatherid'];
                $data[$val['f_appid']]['f_childid'] = $val['f_childid'];
            }
        }
        return $data;
    }
}
