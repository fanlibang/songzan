<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/17
 * Time: 下午4:40
 */
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Audit extends Base
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->User = new \Xy\Application\Models\UserModel();
        $this->Car  = new \Xy\Application\Models\ShopCarModel();
        $this->Source = new \Xy\Application\Models\SourceModel();
    }

    /**
     * 被推荐人列表
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
        $state = $this->input->get_post('state', true);
        $state = $state ? $state : '';
        $export = $this->input->get_post('export', '');

        $where = array();
        if (!empty($iphone)) {
            $user_info = $this->User->getUserInfoByPhone($iphone);
            $where['id'] = $user_info['id'];
        }

        if ($str_dt) {
            $where['created_at >='] = $str_dt;
        }

        if ($end_dt) {
            $where['created_at <='] = $end_dt;
        }

        if ($state) {
            $where['state ='] = $state;
        }
        $data = $this->Car->getPage($page, $page_list, $where, 'id desc');

        foreach ($data['list'] as &$value) {
            $masterUidInfo = $this->User->getUserInfoByid($value['uid']);
            $value['name'] = $masterUidInfo['name'];
            $value['phone'] = $masterUidInfo['phone'];
            if($value['state'] == 1) {
                $value['state_name'] = '审核中';
            }  elseif($value['state'] == 2) {
                $value['state_name'] = '审核失败';
            } elseif($value['state'] == 3) {
                $value['state_name'] = '邀请成功';
            }
        }

        if ($export) {
            $newLists = array('用户id', '姓名', '手机号', '身份证地址', '购车发票', '其他资料', '状态', '创建时间');
            $newList[] = $newLists;
            foreach ($data['list'] as $ke => $va) {
                $newList[] = [
                    'uid'              => $va['uid'],
                    'name'             => $va['name'],
                    'phone'            => $va['phone'],
                    'card_front'       => $va['card_front'],
                    'car_img'          => $va['car_img'],
                    'other'            => $va['other'],
                    'state_name'       => $va['state_name'],
                    'create_dt'        => $va['create_dt'],
                ];
            }
            $this->getExport('被推荐人购车资料数据' . time(), $newList);
            exit;
        }

        $data['iphone'] = $iphone;
        $data['str_dt'] = $str_dt;
        $data['end_dt'] = $end_dt;
        $data['state']  = $state;
        $this->display($data);
    }

    //查看用户资料
    public function carInfo()
    {
        $uid = $this->input->get_post('uid', true);

        if (is_ajax('post')) {
            $state  = $this->input->get_post('state', true);
            $id     = $this->input->get_post('id', true);
            $res = $this->Car->editUserCar($id, ['state' => $state]);
            if ($res) {
                $this->dwzAjaxReturn(200, '操作成功');
            } else {
                $this->dwzAjaxReturn(201, '操作失败');
            }
        } else {
            $data = $this->Car->getCarInfoByUid($uid);
            $this->display($data);
        }
    }
}
