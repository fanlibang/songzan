<?php

defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Article extends Base
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
        $info = $this->input->request(null, true);
	    if(!$this->_data['openId'])
        {
            $url = site_url('Publics', 'jump', array('type'=> $info['id']));
            $this->get_openid($url);exit;
        }
        $id = $info['id'];
        $data = $this->userDiary->getDiaryInfoById($id);
		if(!$data) {
            redirect(site_url('User', 'center'));
        }
        $num = $data['num'];
        if($num == 2) {
            $view = 'people';
        } elseif($num == 3) {
            $view = 'animal';
        }elseif($num == 4) {
            $view = 'food';
        }elseif($num == 5) {
            $view = 'view';
        } else {
            $view = 'initial';
        }

        $pink = $this->option->getUserOption($this->_data['openId'], $id);
        $data['pink'] = $pink ? 1 : 2;

        $data['view'] = $view;
		$content = json_decode($data['content'],true);
        if($content) {
            foreach($content as $k => $v) {
                $new_content = [];
                foreach($v as $ke => $vl) {
                    if($ke == 'content') {
                        $new_content[2] = $vl;
                    } else {
                        $new_content[1] = $vl;
                    }
                }
                asort($new_content);
                $content[$k] = $new_content;
            }
        }

        $data['content'] = $content;


        $res = $this->Users->getUserInfoByUid($data['uid']);
        $data['wx_info'] = json_decode($res['wx_info'],true);
        $data['nickname'] = $data['wx_info']['nickname'];
        $data['avatar'] = $res['avatar'];
	    $data['wx_url'] = site_url('Article', 'index', array('id' => $id));
        $this->displayMain($data);
    }
}

