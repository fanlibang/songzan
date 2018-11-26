<?php

defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class User extends Base
{

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $info = $this->input->request(null, true);
        $data['type'] = $info['type'];
        $this->displayMain($data);
    }

    public function referee()
    {
        $url = site_url('User', 'center');
        $info = $this->input->request(null, true);
        if (is_ajax_post()) {
            if ($info['code'] != get_cookie($info['phone'])) {
                $this->AjaxReturn('202', '验证码不正确');
                exit;
            }
            if (!preg_match("/^1[34578]{1}[0-9]{1}[0-9]{8}$/", $info['phone'])) {
                $this->AjaxReturn('403', '电话号码格式不正确');
                exit;
            }
            if(!validateIDCard($info['card_number'])) {
                $this->AjaxReturn('202', '请填写正确身份证信息');
                exit;
            }
            $res = $this->Users->getUserInfoByPhone($info['phone']);
            $token = rand_str(32);
            $openid = get_cookie('openId');
            $open_id = isset($openid) ? $openid : '';
            if ($res) {
                if (is_weixin() && empty($res['open_id'])) {
                    $this->Users->editUserId($res['id'], ['open_id' => $open_id]);
                }
                set_cookie('token', $token);
                $this->AjaxReturn('200', '用户已注册跳转主页', $url);exit;
            }
            $data['name'] = $info['name'];
            $data['phone'] = $info['phone'];
            $data['open_id'] = $open_id;
            $data['driver_number'] = $info['driver_number'];
            $data['driver_json'] = $info['driver_json'];
            $data['card_number'] = $info['card_number'];
            $data['card_json'] = $info['card_json'];
            $data['token'] = $token;
            $data['created_at'] = NOW_DATE_TIME;
            $uid = $this->Users->addUserOpenId($data);
            $inviteCode = paserInviteCode($uid);
            $invite_url = site_url('Invite', 'index', array('invite_code' => $inviteCode));
            $update['invite_code'] = $inviteCode;
            $update['qr_code_img'] = "http://api.qrserver.com/v1/create-qr-code/?size=144x144&data=$invite_url";
            $this->Users->editUserUid($uid, $update);
            set_cookie('token', $token);
            $this->AjaxReturn('200', '成功', $url);exit;
        } else {
            if ($this->isLogin()) {
                $url = site_url('User', 'center');
                header('Location:' . $url);
            }
            $this->displayMain();
        }
    }

    public function updateInfo()
    {
        $url = site_url('User', 'center');
        $info = $this->input->request(null, true);
        $id = $info['id'];
        if (is_ajax_post()) {
            if(!validateIDCard($info['card_number'])) {
                $this->AjaxReturn('202', '请填写正确身份证信息');
                exit;
            }
            $res = $this->Users->getUserInfoByid($id);
            $openid = get_cookie('openId');
            $open_id = isset($openid) ? $openid : '';
            if ($res) {
                if (is_weixin() && empty($res['open_id'])) {
                    $this->Users->editUserId($res['id'], ['open_id' => $open_id]);
                }
            }
            $data['driver_number'] = $info['driver_number'];
            $data['driver_json'] = $info['driver_json'];
            $data['card_number'] = $info['card_number'];
            $data['card_json'] = $info['card_json'];
            $this->Users->editUserUid($id, $data);
            $this->AjaxReturn('200', '完善资料成功', $url);exit;
        } else {
            $data = $this->Users->getUserInfoByid($id);
            $this->displayMain($data);
        }
    }

    public function center()
    {
        if (!$this->isLogin()) {
            $url = site_url('User', 'referee');
            header('Location:' . $url);
        }
        $data = $this->isLogin();
        if(!empty($res['from_invite_code'])) {
            $url = site_url('Invite', 'index');
            header('Location:' . $url);
        }
        $this->displayMain($data);
    }

    public function login()
    {
        $info = $this->input->request(null, true);
        if (is_ajax_post()) {
            if ($info['code'] != get_cookie($info['phone'])) {
                $this->AjaxReturn('202', '验证码不正确');
                exit;
            }
            $res = $this->Users->getUserInfoByPhone($info['phone']);
            if ($res) {
                $token = rand_str(32);
                $openid = get_cookie('openId');
                $open_id = isset($openid) ? $openid : '';
                if (is_weixin() && empty($res['open_id'])) {
                    $this->Users->editUserId($res['id'], ['open_id' => $open_id]);
                }
                set_cookie('token', $token);
                if(empty($res['from_invite_code'])) {
                    $url = site_url('User', 'center');
                } else {
                    $url = site_url('Invite', 'index');
                }
                $this->Users->editUserUid($res['id'], ['token' => $token]);
            } else {
                $url = site_url('User', 'referee');
            }
            $this->AjaxReturn('200', '成功', $url);exit;
        }
    }
}

