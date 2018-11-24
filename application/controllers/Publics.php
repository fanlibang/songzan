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
        $html = '';
        if (!$this->upload->do_upload('file')) {
            $error = $this->upload->display_errors();
            $result['status'] = -1;
            echo $result['mes'] = '上传失败~' . return_ip(false, true) . $error;
            echo 2;
		//$this->ajaxReturn(self::AJ_RET_FAIL, $result['mes']);
            //return $result;
        } else {
            $upload_data = $this->upload->data();
            //路径
            $file = HTTP_HOST . UPLOAD_FILE . $upload_data['file_name'];

            $result['status']   = '1';
            $result['mes']      =  '上传成功~';
            $result['file']     = $file;

            $html .= '<div class="picture auto flex jc">';
            $html .= '<div class="photo">';
            $html .= '<img class="photo_img" src="'.$file.'" alt="">';
            $html .= '<div class="close-img"></div></div>';
            $html .= '</div>';
            $html .= '<div class="write-box auto">';
            $html .= '<textarea autoHeight="true" placeholder="分享今天的发现吧" class="text-cont content"></textarea>';
            $html .= '</div>';
            $html .= '</div>';
        }
        echo $html;
    }

    public function pink(){
        $info = $this->input->request(null, true);
        if (is_ajax_post()) {
            $option = new \Xy\Application\Models\UserOptionModel();
            $diary  = new \Xy\Application\Models\UserDiaryModel();
            if($info['pink'] == 2) {
                $res = $option->addUserOption($this->_data['openId'], $info['item_id'], 2);
                if($res) {
                    $diary->updateLike($info['item_id'], $info['pink']);
                }
                $this->AjaxReturn('200','点赞成功');
            } else {
                $res = $option->delUserOption($this->_data['openId'], $info['item_id']);
                if($res) {
                    $diary->updateLike($info['item_id'], $info['pink']);
                }
                $this->AjaxReturn('200','取消成功');
            }
        }
    }
	
    public function getLocation()
    {
        $info = $this->input->request(null, true);
        $lat = $info['lat'];
        $lng = $info['lng'];
        $url = "http://api.map.baidu.com/geocoder?output=json&location=$lat,$lng&key=0GqzSQ3xydw23V1uVNBazMwG6ql8iEr3";
	$res = curl_request($url, '', 'get');
        $res = json_decode($res,true);
        if($res['status'] == 'OK') {
            $res = $res['result']['addressComponent'];
	    $rul  = "http://wthrcdn.etouch.cn/weather_mini?city=".$res['province'];
            $contents = file_get_contents("compress.zlib://".$rul);
            //转化为json
            $datas = json_decode($contents,true);
            $info  = $datas['data']['yesterday'];
            $data['type'] = $info['type'];

	    $data['province'] = '【'.$res['province'].'】';
            //$data['province'] = $res['province'];
            //$data['district'] = $res['district'];
	    $data['district'] = $res['district'].$res['street'];
            $this->AjaxReturn('200',$data);
        } else {
            $this->AjaxReturn('400','获取位置错误');
        }
    }
	
    public function button(){
        $info = $this->input->request(null, true);
        $url =  $info['url'];
        $openId = $this->_data['openId'];
        $res = false;
        if($openId) {
            $time = NOW_DATE_TIME;
            $sql = "insert into l462_18songzan_button (url, openId, create_dt) values ('{$url}', '{$openId}', '{$time}');";
            $res = $this->Users->execute($sql);
        }
        if($res) {
            $this->AjaxReturn('200','成功');
        } else {
            $this->AjaxReturn('400','失败');
        }
        exit;
    }	
}
