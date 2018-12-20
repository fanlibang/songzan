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
        $this->Upload = new \Xy\Application\Models\UploadLogModel();
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

    /**
     * 被推荐人列表
     */
    public function uploadInfo()
    {
        $page = $this->input->get_post('pageNum', true);
        $page = $page ? (int)$page : 1;
        $page_list = $this->input->get_post('numPerPage', true);
        $page_list = $page_list ? (int)$page_list : self::DEFAULT_PAGE_LIST;

        $where['uid !='] = 0;
        $data = $this->Upload->getPage($page, $page_list, $where, 'id asc');
        foreach ($data['list'] as $key => $value) {
            if($value['type'] == 1) {
                $data['list'][$key]['title'] = '身份证';
            } else {
                $data['list'][$key]['title'] = '行驶证';
            }
            $data['list'][$key]['mgs'] = json_decode($value['content'],true);
        }

        $this->display($data);
    }

    /**
     * 按钮点击统计
     */
    public function button()
    {
        $sql = "select url, COUNT(id) as pv, COUNT(DISTINCT openId) as openid_uv, COUNT(DISTINCT phone) as phone_uv from `ownerreferral_201812_button` GROUP BY url";
        $record = $this->User->execute($sql);
        $data = ['list' => []];
        foreach ($record as $k => $v) {
            $row = [
                'page'      => $this->getUrlPageName($v['url']),
                'pv'        => $v['pv'],
                'openid_uv' => $v['openid_uv'],
                'phone_uv'  => $v['phone_uv'],
            ];
            $data['list'][] = $row;
        }
        $this->display($data);
    }

    private function getUrlPageName($url)
    {
        switch ($url) {
            case 'index/tj':
                $name = '首页我要推荐';
                break;
            case 'index/jd':
                $name = '首页推荐进度';
                break;
            case 'index/gz':
                $name = '首页活动规则';
                break;
            case 'index/tyg':
                $name = '首页登录提交';
                break;
            case 'user/zcys':
                $name = '推荐人页面隐私条款';
                break;
            case 'user/zctj':
                $name = '推荐人页面提交';
                break;
            case 'user/zygz':
                $name = '推荐人个人中心活动规则';
                break;
            case 'center/wszl':
                $name = '推荐人个人中心完善信息';
                break;
            case 'center/yqm':
                $name = '推荐人个人中心已注册';
                break;
            case 'user/btjr':
                $name = '推荐人个人中心被推荐人状态';
                break;
            case 'user/share':
                $name = '推荐人个人中心邀请码';
                break;
            case 'user/wsys':
                $name = '推荐人完善信息隐私条款';
                break;
            case 'user/wstj':
                $name = '推荐人完善信息提交';
                break;
            case 'invite/index_tk':
                $name = '被推荐人首页隐私条款';
                break;
            case 'invite/index_tj':
                $name = '被推荐人首页提交';
                break;
            case 'invite/info_gz':
                $name = '被推荐人个人中心活动规则';
                break;
            case 'invite/info_ws':
                $name = '被推荐人个人中心完善信息';
                break;
            case 'invite/yzc':
                $name = '被推荐人个人中心被推荐人状态';
                break;
            case 'invite/info_tk':
                $name = '被推荐人完善信息隐私条款';
                break;
            case 'invite/info_tj':
                $name = '被推荐人完善信息提交';
                break;
            case 'info/yzc':
                $name = '被推荐人个人中心已注册';
                break;
            case 'state/hdgz':
                $name = '推荐状态活动规则';
                break;
            case 'state/lhdj':
                $name = '推荐人礼盒点击';
                break;
            case 'reward/tj':
                $name = '礼盒页提交';
                break;
            case 'mgs/tj':
                $name = '礼盒页提交';
                break;
            case 'site/tj':
                $name = '礼盒页提交';
                break;
            case 'state/sczl':
                $name = '上传购车凭证按钮';
                break;
            case 'state/xzlp':
                $name = '选择礼遇';
                break;
            case 'image/yszc':
                $name = '上传购车页隐私';
                break;
            case 'image/tj':
                $name = '上传购车页提交';
                break;
            default:
                $name = '';
        }
        return $name;
    }
}
