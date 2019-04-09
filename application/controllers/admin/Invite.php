<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/2
 * Time: 下午3:53
 */
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Invite extends Base
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
        $fromInviteCode = $this->input->get_post('from_invite_code', true);
        $fromInviteCode = $fromInviteCode ? $fromInviteCode : null;
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

        if ($fromInviteCode) {
            $where['from_invite_code ='] = $fromInviteCode;
        }

        if ($end_dt) {
            $where['created_at <='] = $end_dt;
        }
        $where['master_uid >'] = 0;
        $data = $this->User->getPage($page, $page_list, $where, 'id asc');

        foreach ($data['list'] as $key => $value) {
            $carInfo = $this->CarInfo->getCarInfoByid($value['car_id']);
            $masterUidInfo = $this->User->getUserInfoByid($value['master_uid']);
            $sourceInfo = $this->Source->getSourceInfoByid($value['source']);
            $row = [
                'id'               => $value['id'],
                'name'             => $value['name'],
                'phone'            => $value['phone'],
                'car_name'         => $carInfo['name'],
                'from_invite_code' => $value['from_invite_code'],
                'master_uid'       => $value['master_uid'],
                'master_name'      => $masterUidInfo['name'],
                'master_phone'     => $masterUidInfo['phone'],
                'source_name'      => $sourceInfo['name'],
                'submit_num'       => $value['submit_num'],
                'created_at'       => $value['created_at'],
            ];

            $data['list'][$key] = $row;
        }
        if ($export) {
            $newLists = array('序号', '姓名', '手机号', '意向车型', '推荐码', '推荐人姓名', '推荐人手机号', '来源', '提交次数', '创建时间');
            $newList[] = $newLists;
            foreach ($data['list'] as $ke => $va) {
                $newList[] = [
                    'id'               => $va['id'],
                    'name'             => $va['name'],
                    'phone'            => $va['phone'],
                    'car_name'         => $va['car_name'],
                    'from_invite_code' => $va['from_invite_code'],
                    'master_name'      => $va['master_name'],
                    'master_phone'     => $va['master_phone'],
                    'source_name'      => $va['source_name'],
                    'submit_num'       => $va['submit_num'],
                    'created_at'       => $va['created_at'],
                ];
            }
            $this->getExport('被推荐人数据' . time(), $newList);
            exit;
        }

        $data['iphone'] = $iphone;
        $data['str_dt'] = $str_dt;
        $data['end_dt'] = $end_dt;
        $data['from_invite_code'] = $fromInviteCode;
        $this->display($data);
    }
}
