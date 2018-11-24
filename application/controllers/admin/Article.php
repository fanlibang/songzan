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
        $this->userDiary            = new \Xy\Application\Models\UserDiaryModel();
        $this->userPush             = new \Xy\Application\Models\UserPushModel();
        $this->User                 = new \Xy\Application\Models\UserModel();
        $this->feedBack             = new \Xy\Application\Models\FeedBackModel();
        $this->view                  = new \Xy\Application\Models\ViewAssessModel();
    }

    /**
     * 文章列表
     */
    public function index()
    {
        $page           =   $this->input->get_post('pageNum', true);
        $page           =   $page ? (int)$page : 1;
        $page_list      =  $this->input->get_post('numPerPage', true);
        $page_list      =   $page_list ? (int)$page_list : self::DEFAULT_PAGE_LIST;
        $iphone         = $this->input->get_post('iphone', true);
        $iphone         = $iphone ? $iphone : null;
        $str_dt         = $this->input->get_post('str_dt', true);
        $str_dt         = $str_dt ? $str_dt : null;
        $end_dt         = $this->input->get_post('end_dt', true);
        $end_dt         = $end_dt ? $end_dt : null;
        $export     = $this->input->get_post('export', '');

        $where = array();
        if (!empty($iphone)) {
            $user_info = $this->User->getUserInfoByPhone($iphone);
            $where['uid'] = $user_info['uid'];
        }

        if ($str_dt) {
            $where['create_dt >='] = $str_dt;
        }

        if ($end_dt) {
            $where['create_dt <='] = $end_dt;
        }

        $data = $this->userDiary->getPage($page, $page_list, $where, 'id asc');

        $list = $data['list'];
        if($export) {
            $export_array = array();
            foreach($list as $k => $v) {
                $export_array[$k][] = $v['id'];
                $export_array[$k][] = $v['uid'];
                $export_array[$k][] = $v['province'].$v['district'];
                $export_array[$k][] = $v['weather'];
                $export_array[$k][] = $v['play_count'];
                $export_array[$k][] = $v['like_count'];
                $export_array[$k][] = $v['create_dt'];
            }

            $newLists = array('序号','用户uid','城市','天气','点赞数','阅读数', '创建时间');
            $newList[] = $newLists;
            foreach($export_array as $ke => $va) {
                $newList[] = $va;
            }
            $this->getExport('文章数据'.time(),$newList);exit;
        }

        $data['iphone']      = $iphone;
        $data['str_dt']      = $str_dt;
        $data['end_dt']      = $end_dt;
        $this->display($data);
    }

    //文章详情
    public function articleView()
    {
        $id = (int)$this->input->get_post('id', true);
        $data  = $this->userDiary->getDiaryInfoById($id);
        $content = json_decode($data['content'],true);
        foreach($content as $k => $v) {
            $new_content = [];
            foreach($v as $ke => $vl) {
                if($ke == 'content') {
                    $new_content[2] = '<p>'.$vl.'</p>';
                } else {
                    $new_content[1] = '<p style="height:auto"><img style="width:250px;height:250px;" class="photo_img" src="'.$vl.'" alt=""></p>';
                }
            }
            asort($new_content);
            $content[$k] = $new_content;
        }
        $html = '';
        foreach($content as $k => $v) {
            foreach($v as $key => $val) {
                $html .= $val;
            }
        }
        $data['html'] = $html;
        $this->display($data);
    }
    /**
     * 删除
     */
    public function del()
    {
        $id = (int)$this->input->get('id', true);

        $ret = $this->userDiary->del(array('id' => $id));

        if ($ret) {
            $this->dwzAjaxReturn(self::AJ_RET_SUCC, '删除成功', $this->_data['controller'], null, 'no');
        } else {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '删除失败');
        }
    }

    /**
     * 文章列表
     */
    public function info()
    {
        $page       =   $this->input->get_post('pageNum', true);
        $page       =   $page ? (int)$page : 1;
        $page_list  =  $this->input->get_post('numPerPage', true);
        $page_list  =   $page_list ? (int)$page_list : self::DEFAULT_PAGE_LIST;
        $iphone         = $this->input->get_post('iphone', true);
        $iphone         = $iphone ? $iphone : null;
        $str_dt         = $this->input->get_post('str_dt', true);
        $str_dt         = $str_dt ? $str_dt : null;
        $end_dt         = $this->input->get_post('end_dt', true);
        $end_dt         = $end_dt ? $end_dt : null;
        $export     = $this->input->get_post('export', '');


        $where = array();
        if (!empty($iphone)) {
            $user_info = $this->User->getUserInfoByPhone($iphone);
            $where['uid'] = $user_info['uid'];
        }

        if ($str_dt) {
            $where['create_dt >='] = $str_dt;
        }

        if ($end_dt) {
            $where['create_dt <='] = $end_dt;
        }

        $where['info <>'] = 'Array';

        $data = $this->userPush->getPage($page, $page_list, $where, 'id asc');
        $user_info = [];
        foreach($data['list'] as &$v) {
            $v['info'] = json_decode($v['info'], true);
            $user_info[] = $this->User->getUserInfoByUid($v['uid']);

        }
        $list = $data['list'];
        if($export) {
            $export_array = array();
            foreach($user_info as $k => $v) {
                $export_array[$k][] = $v['uid'];
                $export_array[$k][] = $v['type'] == 1 ? '我是体验官' : '开启探索';;
                $export_array[$k][] = $v['code'];
                $export_array[$k][] = $v['phone'];
                $export_array[$k][] = $v['nickname'];
                $export_array[$k][] = $v['openId'];
                $export_array[$k][] = $v['status'] == 1 ? '未注册' : '已注册';
                $export_array[$k][] = $v['white_type'] == 2 ? '白名单' : '非白名单';
                $export_array[$k][] = $v['create_dt'];
            }

            $newLists = array('用户id','类型','推荐码','手机','昵称','openid', '注册状态', '是否白名单', '创建时间');
            $newList[] = $newLists;
            foreach($export_array as $ke => $va) {
                $newList[] = $va;
            }
            $this->getExport('留资数据'.time(),$newList);exit;
        }

        $data['iphone']      = $iphone;
        $data['str_dt']      = $str_dt;
        $data['end_dt']      = $end_dt;

        $this->display($data);
    }

    /**
     * 用户列表
     */
    public function user()
    {
        $page       =   $this->input->get_post('pageNum', true);
        $page       =   $page ? (int)$page : 1;
        $page_list  =  $this->input->get_post('numPerPage', true);
        $page_list  =   $page_list ? (int)$page_list : self::DEFAULT_PAGE_LIST;
        $iphone         = $this->input->get_post('iphone', true);
        $iphone         = $iphone ? $iphone : null;
        $str_dt         = $this->input->get_post('str_dt', true);
        $str_dt         = $str_dt ? $str_dt : null;
        $end_dt         = $this->input->get_post('end_dt', true);
        $end_dt         = $end_dt ? $end_dt : null;
        $export     = $this->input->get_post('export', '');

        $where = array();
        if (!empty($iphone)) {
            $where['iphone'] = $iphone;
        }

        if ($str_dt) {
            $where['create_dt >='] = $str_dt;
        }

        if ($end_dt) {
            $where['create_dt <='] = $end_dt;
        }

        $data = $this->User->getPage($page, $page_list, $where, 'uid asc');
        foreach($data['list'] as &$v) {
            $info = json_decode($v['info'],true);
            $v['phone'] = $info['iphone'];
        }

        $list = $data['list'];
        if($export) {
            $export_array = array();
            foreach($list as $k => $v) {
                $export_array[$k][] = $v['uid'];
                $export_array[$k][] = $v['type'] == 1 ? '我是体验官' : '开启探索';;
                $export_array[$k][] = $v['code'];
                $export_array[$k][] = $v['phone'];
                $export_array[$k][] = $v['nickname'];
                $export_array[$k][] = $v['openId'];
                $export_array[$k][] = $v['status'] == 1 ? '未注册' : '已注册';
                $export_array[$k][] = $v['white_type'] == 2 ? '白名单' : '非白名单';
                $export_array[$k][] = $v['create_dt'];
            }

            $newLists = array('用户id','类型','推荐码','手机','昵称','openid', '注册状态', '是否白名单', '创建时间');
            $newList[] = $newLists;
            foreach($export_array as $ke => $va) {
                $newList[] = $va;
            }
            $this->getExport('用户数据'.time(),$newList);exit;
        }

        $data['iphone']      = $iphone;
        $data['str_dt']      = $str_dt;
        $data['end_dt']      = $end_dt;

        $this->display($data);
    }

    //添加自媒体白名单
    public function whiteAdd()
    {
        if (is_ajax('post')) {
            $uid            = $this->input->get_post('uid');
            $white_type     = $this->input->get_post('white_type');

            $data = [
                'white_type' => $white_type,
            ];

            $where['uid'] = $uid;

            $status = $this->User->edit($data, $where);
            if($status){
                $this->dwzAjaxReturn(self::AJ_RET_SUCC, '操作成功', $this->_data['controller'].'/user', null, 'no');
            }else{
                $this->dwzAjaxReturn(self::AJ_RET_FAIL, '操作失败');
            }
        }
    }

    /**
     * 用户访问量
     */
    public function view()
    {
        $page       =   $this->input->get_post('pageNum', true);
        $page       =   $page ? (int)$page : 1;
        $page_list  =  $this->input->get_post('numPerPage', true);
        $page_list  =   $page_list ? (int)$page_list : self::DEFAULT_PAGE_LIST;
        $uid        = $this->input->get_post('uid', true);
        $uid        = $uid ? $uid : null;

        $where = array();
        if (!empty($uid)) {
            $where['uid'] = $uid;
        }
        $view = array('首页' => '/dev/Index/index', '注册页' => '/dev/User/register', '用户中心' => '/dev/User/center', '日记列表' => '/dev/Diary/index', '写日记'=> '/dev/Diary/message', '用户日记列表'=>'/dev/Diary/userInfo', '日记详情' => '/dev/Article/index');
        foreach($view as $k => $v) {
            $sql = "select count(*) as pv from l462_18songzan_view_logs where url = '{$v}'";
            $res = $this->userDiary->execute($sql);
            $info['pv'] = $res ? $res[0]['pv'] : 0;
            $sql = "select count(distinct openId) as uv from l462_18songzan_view_logs where url = '{$v}'";
            $res = $this->userDiary->execute($sql);
            $info['uv'] = $res ? $res[0]['uv'] : 0;
            $arr[$k] = $info;
        }
        $data['list'] = $arr;

        $this->display($data);
    }

    /**
     * 用户访问量
     */
    public function feedback()
    {
        $page       =   $this->input->get_post('pageNum', true);
        $page       =   $page ? (int)$page : 1;
        $page_list  =  $this->input->get_post('numPerPage', true);
        $page_list  =   $page_list ? (int)$page_list : self::DEFAULT_PAGE_LIST;
        $iphone         = $this->input->get_post('iphone', true);
        $iphone         = $iphone ? $iphone : null;
        $str_dt         = $this->input->get_post('str_dt', true);
        $str_dt         = $str_dt ? $str_dt : null;
        $end_dt         = $this->input->get_post('end_dt', true);
        $end_dt         = $end_dt ? $end_dt : null;
        $export     = $this->input->get_post('export', '');

        $where = array();
        if (!empty($iphone)) {
            $user_info = $this->User->getUserInfoByPhone($iphone);
            $where['uid'] = $user_info['uid'];
        }

        if ($str_dt) {
            $where['create_dt >='] = $str_dt;
        }

        if ($end_dt) {
            $where['create_dt <='] = $end_dt;
        }


        $data = $this->feedBack->getPage($page, $page_list, $where, 'id asc');

        $list = $data['list'];
        if($export) {
            $export_array = array();
            foreach($list as $k => $v) {
                $export_array[$k][] = $v['id'];
                $export_array[$k][] = $v['uid'];
                $export_array[$k][] = $v['username'];
                $export_array[$k][] = $v['iphone'];
                $export_array[$k][] = $v['sex'];
                $export_array[$k][] = $v['city'];
                $export_array[$k][] = $v['opinion'];
                $export_array[$k][] = $v['others'];
                $export_array[$k][] = $v['textare'];
                $export_array[$k][] = $v['create_dt'];
            }

            $newLists = array('序号','uid','姓名','手机号','性别','城市经销商', '选项', '其他渠道', '意见', '创建时间');
            $newList[] = $newLists;
            foreach($export_array as $ke => $va) {
                $newList[] = $va;
            }
            $this->getExport('用户反馈'.time(),$newList);exit;
        }

        $data['iphone']      = $iphone;
        $data['str_dt']      = $str_dt;
        $data['end_dt']      = $end_dt;

        $this->display($data);
    }

    /**
     * 用户访问量
     */
    public function button()
    {
        $where = array();
        if (!empty($uid)) {
            $where['uid'] = $uid;
        }
        $view = array('我是体验官' => 'index/tyg', '开启探索' => 'index/ts', '首页日记' => 'index/rj', '首页大礼包' => 'index/dl', '首页发现' => 'index/fx', '首页文旅' => 'index/wl', '首页之旅' => 'index/zl', '首页之旅1' => 'index/zl1', '首页之旅2' => 'index/zl2', '首页之旅3' => 'index/zl3', '注册隐私' => 'register/rj', '注册重置' => 'register/cz', '注册提交' => 'register/tj', '中心日记' => 'center/rj', '中心之旅' => 'center/zl', '中心礼包' => 'center/lb', '中心反馈' => 'center/yj', '中心发现' => 'center/fx', '中心文旅' => 'center/wl', '中心之旅1' => 'center/zl1', '中心之旅2' => 'center/zl2', '中心之旅3' => 'center/zl3', '写日记' => 'diary/xrj', '日记探秘' => 'diary/tm', '文章探秘' => 'Article/tm' );
        foreach($view as $k => $v) {
            $sql = "select count(*) as pv from l462_18songzan_button where url = '{$v}'";
            $res = $this->userDiary->execute($sql);
            $info['pv'] = $res ? $res[0]['pv'] : 0;
            $sql = "select count(distinct openId) as uv from l462_18songzan_button where url = '{$v}'";
            $res = $this->userDiary->execute($sql);
            $info['uv'] = $res ? $res[0]['uv'] : 0;
            $arr[$k] = $info;
        }
        $data['list'] = $arr;
        $this->display($data);
    }
}
