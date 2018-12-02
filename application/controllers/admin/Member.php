<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/2
 * Time: 下午4:37
 */
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Member extends Base
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->User = new \Xy\Application\Models\UserModel();
        $this->CarInfo = new \Xy\Application\Models\CarInfoModel();
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
        $where['master_uid ='] = 0;
        $data = $this->User->getPage($page, $page_list, $where, 'id asc');

        foreach ($data['list'] as $key => $value) {
            $sourceInfo = $this->Source->getSourceInfoByid($value['source']);
            $row = [
                'id'            => $value['id'],
                'name'          => $value['name'],
                'phone'         => $value['phone'],
                'driver_number' => $value['driver_number'],
                'card_number'   => $value['card_number'],
                'invite_code'   => $value['invite_code'],
                'qr_code_img'   => $value['qr_code_img'],
                'source_name'   => $sourceInfo['name'],
                'submit_num'    => $value['submit_num'],
                'created_at'    => $value['created_at'],
            ];

            $data['list'][$key] = $row;
        }
        if ($export) {
            $newLists = array('序号', '姓名', '手机号', '行驶证', '身份证', '推荐码', '二维码', '来源', '提交次数', '创建时间');
            $newList[] = $newLists;
            foreach ($data['list'] as $ke => $va) {
                $newList[] = [
                    'id'            => $va['id'],
                    'name'          => $va['name'],
                    'phone'         => $va['phone'],
                    'driver_number' => $va['driver_number'],
                    'card_number'   => $va['card_number'],
                    'invite_code'   => $va['invite_code'],
                    'qr_code_img'   => $va['qr_code_img'],
                    'source_name'   => $va['source_name'],
                    'submit_num'    => $va['submit_num'],
                    'created_at'    => $va['created_at'],
                ];
            }
            $this->getExport('推荐人数据' . time(), $newList);
            exit;
        }

        $data['iphone'] = $iphone;
        $data['str_dt'] = $str_dt;
        $data['end_dt'] = $end_dt;
        $this->display($data);
    }
}