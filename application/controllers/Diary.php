<?php

defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Diary extends Base
{

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->userDiary           = new \Xy\Application\Models\UserDiaryModel();
        $this->option              = new \Xy\Application\Models\UserOptionModel();

    }

    public function index(){
        $res = $this->Users->getUserInfoByOpId($this->_data['openId']);
        $uid = $res['uid'];
        $data['self'] = $this->userDiary->geDiaryInfo($uid);
        if($data['self']) {
            foreach($data['self'] as $k => $v) {
                $pink = $this->option->getUserOption($this->_data['openId'], $v['id']);
                $data['self'][$k]['pink'] = $pink ? 1 : 2;
            }
        }
        $all  = $this->userDiary->geDiaryInfo();
        if($all) {
            foreach($all as $k => $v) {
                $res = $this->Users->getUserInfoByUid($v['uid']);
                $wx_info = json_decode($res['wx_info'],true);
                $all[$k]['nickname'] = $wx_info['nickname'];
                $all[$k]['avatar'] = $res['avatar'];
                $all[$k]['new_uid'] = $res['uid'];
                $pink = $this->option->getUserOption($this->_data['openId'], $v['id']);
                $all[$k]['pink'] = $pink ? 1 : 2;
            }
        }
        $data['all'] = $all;
        $this->displayMain($data);
    }

    public function message(){
        $info = $this->input->request(null, true);
        if (is_ajax_post()) {
            $data = [
                'uid'       => $info['uid'],
		        'province'  => $info['province'],
                'district'  => $info['district'],
		        'weather'   => $info['weather'],
                'content'   => json_encode($info['content']),
                'num'       => $info['num'],
                'create_dt' => NOW_DATE_TIME
            ];
            $res = $this->userDiary->addUserDiaryInfo($data);
            if($res) {
                set_cookie('url', 1);
                $this->AjaxReturn('200','成功',site_url('Diary', 'index'));
            } else {
                $this->AjaxReturn('400','失败');
            }
        } else {
            if(get_cookie('url') && !isset($info['check'])) {
                delete_cookie('url');
                redirect(site_url('User', 'center'));
            }
            $res = $this->Users->getUserInfoByOpId($this->_data['openId']);
            if(!$res) {
                redirect(site_url('Index', 'index'));
            }
            $data = $this->Users->getUserInfoByUid($res['uid']);
            $data['wx_info'] = json_decode($data['wx_info'],true);
            $data['nickname'] = $data['wx_info']['nickname'];
            $this->displayMain($data);
        }
    }

    public function userInfo(){
        $info = $this->input->request(null, true);
        $uid = $info['uid'];
        $data = $this->Users->getUserInfoByUid($uid);
        $data['wx_info'] = json_decode($data['wx_info'],true);
        $data['nickname'] = $data['wx_info']['nickname'];
        $pink = $this->option->getUserOption($this->_data['openId'], $data['id']);
        $data['pink'] = $pink ? 1 : 2;
        $data['info'] = $this->userDiary->geDiaryInfo($uid);
        foreach($data['info'] as $k => $v) {
            $pink = $this->option->getUserOption($this->_data['openId'], $v['id']);
            $data['info'][$k]['pink'] = $pink ? 1 : 2;
        }
        $this->displayMain($data);
    }
}

