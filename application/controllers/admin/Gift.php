<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/17
 * Time: 下午4:40
 */
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Gift extends Base
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->Raware   = new \Xy\Application\Models\RewardModel();
        $this->User     = new \Xy\Application\Models\UserModel();
    }

    /**
     *
     */
    public function index()
    {
        $page = $this->input->get_post('pageNum', true);
        $page = $page ? (int)$page : 1;
        $page_list = $this->input->get_post('numPerPage', true);
        $page_list = $page_list ? (int)$page_list : self::DEFAULT_PAGE_LIST;
        $iphone = $this->input->get_post('iphone', true);
        $iphone = $iphone ? $iphone : null;
        $str_dt = $this->input->get_post('str_dt', true);
        $str_dt = $str_dt ? $str_dt : null;
        $end_dt = $this->input->get_post('end_dt', true);
        $end_dt = $end_dt ? $end_dt : null;
        $status = $this->input->get_post('status', true);
        $status = $status ? $status : '';
        $export = $this->input->get_post('export', '');

        $where = array();


        if (!empty($iphone)) {
            $user_info = $this->User->getUserInfoByPhone($iphone);
            $where['uid'] = $user_info['id'];
        }

        if ($str_dt) {
            $where['created_at >='] = $str_dt;
        }

        if ($end_dt) {
            $where['created_at <='] = $end_dt;
        }

        if ($status) {
            $where['state ='] = $status;
        }

        $data = $this->Raware->getPage($page, $page_list, $where, 'id');
        $Item           = new \Xy\Application\Models\ItemModel();
        foreach($data['list'] as &$val) {
            $userInfo = $this->User->getUserInfoByid($val['uid']);
            $val['name']    = $userInfo['name'];
            $val['phone']   = $userInfo['phone'];
            $ret            = $Item->getItemInfoByType($val['type']);
            $val['title']   = $ret['name'];
        }

        if ($export) {
            $newLists = array('用户id', '姓名', '手机号', '收货人姓名', '收货人手机', '省份', '城市', '地址');
            $newList[] = $newLists;
            foreach ($data['list'] as $ke => $va) {
                $newList[] = [
                    'uid'              => $va['uid'],
                    'name'             => $va['name'],
                    'phone'            => $va['phone'],
                    'site_name'        => $va['site_name'],
                    'site_phone'       => $va['site_phone'],
                    'province'         => $va['province'],
                    'city'             => $va['city'],
                    'site'             => $va['site'],
                ];
            }
            $this->getExport('被推荐人购车资料数据' . time(), $newList);
            exit;
        }

        $data['iphone'] = $iphone;
        $data['str_dt'] = $str_dt;
        $data['end_dt'] = $end_dt;
        $data['status'] = $status;
        $this->display($data);
    }

    //查看用户资料
    public function editNum()
    {
        $id = $this->input->get_post('id', true);

        if (is_ajax('post')) {
            $num  = $this->input->get_post('num', true);
            $res = $this->Item->editNum($id, ['num' => $num]);
            if ($res) {
                $this->dwzAjaxReturn(200, '操作成功');
            } else {
                $this->dwzAjaxReturn(401, '操作失败');
            }
        } else {
            $data = $this->Item->getItemInfoById($id);
            $this->display($data);
        }
    }
}
