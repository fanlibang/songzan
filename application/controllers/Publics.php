<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Base.php';

class Publics extends Base
{

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function del()
    {
        $info = $this->input->request(null, true);
        if (is_ajax_post()) {
            $diary = new \Xy\Application\Models\UserDiaryModel();
            $where['id'] = $info['item_id'];
            $diary->del($where);
            $this->AjaxReturn('200', '删除成功', site_url('Diary', 'index'));
        }
    }

    public function jump()
    {
        $appid = APPID;
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
        //输出openid
        if (!empty($openid)) {
            $res = $this->UserWx->getWxInfoByOpId($openid);
            set_cookie('openId', $res['open_id']);
            $url = site_url('Index', 'index');
            if (empty($res)) {
                $data = [
                    'open_id'    => $openid,
                    'nick_name'  => $userInfo['nickname'],
                    'avatar'     => $userInfo['headimgurl'],
                    'created_at' => NOW_DATE_TIME,
                ];
                $this->UserWx->addWxInfo($data);
            }
            header('Location:' . $url);
        }
    }

    public function addOpenid()
    {
        $appid = APPID;
        $secret = SECRET;
        $code = $_GET['code'];//获取code
        $invite_code = $_GET['invite_code'];//获取invite_code
        $weixin =  file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code");//通过code换取网页授权access_token
        $jsondecode = json_decode($weixin); //对JSON格式的字符串进行编码
        $array = get_object_vars($jsondecode);//转换成数组
        $openid = $array['openid'];//输出openid
        //输出openid
        if (!empty($openid)) {
            $res = $this->UserWx->getWxInfoByOpId($openid);
            set_cookie('openId', $res['open_id']);
            if(empty($invite_code)) {
                $url = site_url('Index', 'index');
            } else {
                $url = site_url('Invite', 'index', array('invite_code' => $invite_code));
            }
            if (empty($res)) {
                $data = [
                    'open_id'    => $openid,
                    'created_at' => NOW_DATE_TIME
                ];
                $this->UserWx->addWxInfo($data);
            }
            header('Location:' . $url);
        }
    }

    //获取上传图片信息
    public function getImageInfo()
    {
        $info = $this->input->request();
        $type = $info['type'] ? $info['type'] : 1; //1身份证2行驶证
        $url = $this->imageUpload();
        $client = new AipOcr('14897920', '7eDaRmySnE4mFHvys8B9H48E', 'LniOpofpOHOyWVYG7mmRuxGiT7oo2dL9');
        $image = file_get_contents($url);
        $status = 0;
        if ($type == 1) {
            $options = array();
            $options["detect_direction"] = "true";
            $info = $client->idcard($image, 'front', $options);
            if($info['image_status'] == 'normal') {
                $status = 1;
            }
        } else {
            // 如果有可选参数
            $options = array();
            $options["detect_direction"] = "true";
            // 带参数调用行驶证识别
            $info = $client->vehicleLicense($image, $options);
            if($info['msg'] == 'success') {
                $status = 1;
            }
        }
        $info = json_encode($info);
        $uploadModel = (new \Xy\Application\Models\UploadLogModel());
        $data = [
            'open_id'   => get_cookie('openId') ? get_cookie('openId') : '',
            'type'      => $type,
            'image'     => $url,
            'content'   => $info,
            'status'    => $status,
            'create_dt' => NOW_DATE_TIME
        ];
        $uploadModel->addUploadInfo($data);

        echo $info;
    }

    public function imageUpload()
    {
        //不存在当前上传文件则上传
        if (!file_exists($_FILES['upload_file']['name'])) move_uploaded_file($_FILES['upload_file']['tmp_name'], iconv('utf-8', 'gb2312', $_FILES['upload_file']['name']));
        //输出图片文件<img>标签
        //echo "<textarea><img src='{$_FILES['upload_file']['name']}'/></textarea>";
        if ($_FILES["file"]["size"] > 10485760) {
            echo 1;
            exit;
            //$this->ajaxReturn(self::AJ_RET_FAIL, '');
        }
        $config['allowed_types'] = '*';
        $config['overwrite'] = 'true';
        //文件名
        $config['file_name'] = $_FILES["file"]["name"];
        //文件路径
        $config['show_path'] = UPLOAD_FILE;
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

            $result['status'] = '1';
            $result['mes'] = '上传成功~';
            $result['file'] = $file;
            return $file;
        }
    }

    public function button(){
        $info = $this->input->request(null, true);
        $url =  $info['url'];
        $time = NOW_DATE_TIME;
        $info = $this->isLogin();
        $phone = $info ? $info['phone'] : '';
        $openId = get_cookie('openId') ? get_cookie('openId') : 0;
        $source = get_cookie('source') ? get_cookie('source') : 0;
        $sql = "insert into ownerreferral_201812_button (url, phone, source, openId, create_dt) values ('{$url}', '{$phone}', '{$source}', '{$openId}', '{$time}');";
        $res = $this->Users->execute($sql);
        if($res) {
            $this->AjaxReturn('200','成功');
        } else {
            $this->AjaxReturn('400','失败');
        }
        exit;
    }


}
