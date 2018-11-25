<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Base.php';
class Publics extends Base {

	/**
	 * 初始化
	 */
    public function __construct() {
        parent::__construct();
    }
	
    public function del(){
        $info = $this->input->request(null, true);
        if (is_ajax_post()) {
            $diary  = new \Xy\Application\Models\UserDiaryModel();
            $where['id'] = $info['item_id'];
            $diary->del($where);
	    $this->AjaxReturn('200','删除成功', site_url('Diary', 'index'));
        }
    }

    public function jump()
    {
	    $appid  = APPID;
        $secret = SECRET;
        $code = $_GET['code'];//获取code 
        $type = isset($_GET['type']) ? $_GET['type'] : false;//获取code
	
	    //获取参数
        $weixin = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code");

        //通过code换取网页授权access_token
        $jsondecode = json_decode($weixin);
        //对JSON格式的字符串进行编码
        $array = get_object_vars($jsondecode);
	    //var_dump($array);exit;

	    $openid = $array['openid'];
	    $access_token = $array['access_token'];
	
	    $get_user_info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
        $userInfo = getJson($get_user_info_url);
        $user_Info = json_encode($userInfo);
        //输出openid
        if (!empty($openid)) {
            $res = $this->UserWx->getWxInfoByOpId($openid);
            if($res) {
                set_cookie('openId', $res['open_id']);
            } else {
                $url = site_url('Index', 'index');
                $data = [
                    'open_id'   => $openid,
                    'nick_name' => $user_Info['nickname'],
                    'avatar'    => $userInfo['headimgurl'],
                    'create_dt' => NOW_DATE_TIME,
                ];
                $this->Users->addUserOpenId($data);
            }
            header('Location:'.$url);
        }
    }

    public function getUserInfo()
    {
        $appid  = APPID;
        $secret = SECRET;
        $code = $_GET['code'];//获取code
        $type = $_GET['type'];

        //第一步:取全局access_token
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
        $token = getJson($url);
	

	//第二步:取得openid
        $oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
        $oauth2 = getJson($oauth2Url);


	//第三步:根据全局access_token和openid查询用户信息
        $access_token = $token["access_token"];
        $openid = $oauth2['openid'];
        $get_user_info_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
        $userInfo = getJson($get_user_info_url);
        $user_Info = json_encode($userInfo);
        $data = [
            'avatar'    => $userInfo['headimgurl'],
            'wx_info'   => $user_Info,
        ];
        $this->Users->editUserOpenId($this->_data['openId'], $data);
        $url = site_url('User', 'register', array('type' => $type));
        header('Location:'.$url);
    }

    //获取上传图片信息
    public function getImageInfo() {
        $info = $this->input->request();
        $type = $info['type'] ? $info['type'] : 1; //1身份证2行驶证
        $url = $this->imageUpload();
        $html = '123456';
        if($type == 1) {

        } else {

        }
        echo $html;
    }

    public function imageUpload()
    {
        //不存在当前上传文件则上传
        if(!file_exists($_FILES['upload_file']['name'])) move_uploaded_file($_FILES['upload_file']['tmp_name'],iconv('utf-8','gb2312',$_FILES['upload_file']['name']));
        //输出图片文件<img>标签
        //echo "<textarea><img src='{$_FILES['upload_file']['name']}'/></textarea>";
	if($_FILES["file"]["size"] > 10485760) {
            echo 1;exit;
            //$this->ajaxReturn(self::AJ_RET_FAIL, '');
        }
        $config['allowed_types'] = '*';
        $config['overwrite'] = 'true';
        //文件名
        $config['file_name'] = $_FILES["file"]["name"];
        //文件路径
        $config['show_path']   = UPLOAD_FILE;
	$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . $config['show_path'];
        mkdirs($config['upload_path']);
        $config['file_ext_tolower'] = true;
        $this->load->library('upload', $config);
        $this->upload->set_allowed_types('*');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
            $error = $this->upload->display_errors();
            $result['status'] = -1;
            $result['mes'] = '上传失败~' . return_ip(false, true) . $error;
            return false;
		//$this->ajaxReturn(self::AJ_RET_FAIL, $result['mes']);
            //return $result;
        } else {
            $upload_data = $this->upload->data();
            //路径
            $file = HTTP_HOST . UPLOAD_FILE . $upload_data['file_name'];

            $result['status']   = '1';
            $result['mes']      =  '上传成功~';
            $result['file']     = $file;
            return $file;
        }
    }

}
