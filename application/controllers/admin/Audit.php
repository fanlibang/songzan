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
            $where['uid'] = $user_info['id'];
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
            $Info = $this->User->getUserInfoByid($value['uid']);
            $value['name'] = $Info['name'];
            $value['phone'] = $Info['phone'];
            $invite_id = $Info['master_uid'];
            $inviteInfo = $this->User->getUserInfoByid($invite_id);
            $value['invite_name'] = $inviteInfo['name'];
            $value['invite_phone'] = $inviteInfo['phone'];
            $value['invite_id'] = $invite_id;
            if($value['state'] == 1) {
                $value['state_name'] = '审核中';
            }  elseif($value['state'] == 2) {
                $value['state_name'] = '审核失败';
            } elseif($value['state'] == 3) {
                $value['state_name'] = '审核成功';
            }
        }

        if ($export) {
            $newLists = array('用户id', '姓名', '手机号', '推荐人id', '推荐人姓名', '推荐人手机号', '身份证地址', '购车发票', '其他资料', '状态', '创建时间');
            $newList[] = $newLists;
            foreach ($data['list'] as $ke => $va) {
                $newList[] = [
                    'uid'              => $va['uid'],
                    'name'             => $va['name'],
                    'phone'            => $va['phone'],
                    'invite_id'        => $va['invite_id'],
                    'invite_name'      => $va['invite_name'],
                    'invite_phone'     => $va['invite_phone'],
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
            if($state == 3) {
                $invite_info    = $this->User->getUserInfoByid($uid);
                $user_info      = $this->User->getUserInfoByid($invite_info['master_uid']);
                if($user_info['status'] != 3) {
                    $this->dwzAjaxReturn(201, '推荐人必须审核通过才能通过，请先审核推荐人'); exit;
                }
            }
            $res = $this->Car->editUserCar($id, ['state' => $state]);
            if ($res) {
                $this->User->editUserId($uid, ['status' => $state]);
                if($state == 3) {
                    //生成短连接
                    $invite_info    = $this->User->getUserInfoByid($uid);
                    $user_info      = $this->User->getUserInfoByid($invite_info['master_uid']);
                    //$long_url = site_url('User', 'center');
                    $long_url = 'http://'.$_SERVER['HTTP_HOST'] . '/2018/crm/ownerreferral/index.php?c=Invite&m=index&invite_code='.$invite_info['from_invite_code'];
                    $short_url = getSinaShortUrl('1555751977',$long_url);
                    $sms_notice_obj = new SendSms();
                    $mgs[0] = $user_info['name'];
                    $mgs[1] = $short_url;
                    $ret = $sms_notice_obj->send($invite_info['phone'], $mgs, 4);
                    $mes = json_encode($ret);

                    $count = $this->User->getInviteSuccNum($invite_info['master_uid']);
                    if($count < 2) {
                        $long_url = 'http://'.$_SERVER['HTTP_HOST'] . '/2018/crm/ownerreferral/index.php?c=User&m=center';
                        $short_url = getSinaShortUrl('1555751977',$long_url);
                        $sms_notice_obj = new SendSms();
                        $mgs[0] = $invite_info['name'];
                        $mgs[1] = $short_url;
                        $ret = $sms_notice_obj->send($user_info['phone'], $mgs, 4);
                        $update['content'] = $mes.json_encode($ret);
                    }
                    $update['content'] = $mes;
                    $this->Car->editUserCarUid($uid, $update);
                }
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
