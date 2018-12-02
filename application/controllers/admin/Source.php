<?php
/**
 * Created by PhpStorm.
 * User: xj
 * Date: 2018/12/2
 * Time: 下午3:53
 */
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Source extends Base
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->User     = new \Xy\Application\Models\UserModel();
        $this->CarInfo  = new \Xy\Application\Models\CarInfoModel();
        $this->Source   = new \Xy\Application\Models\SourceModel();
    }

    /**
     * 被推荐人列表
     */
    public function index()
    {

        $export     = $this->input->get_post('export', '');
        $view = array('KV页' => 'Index/index', '推荐人填写信息页' => 'User/referee', '完善推荐人填写信息页' => 'User/updateInfo', '推荐人主页' => 'User/updateInfo', '推荐人海报页' => 'Invite/share', '被推荐人填写信息页' => 'Invite/index', '被推荐人主页' => 'Invite/info');
        $info = $this->Source->getAllSource();
        $arr = [];
        foreach($info as $k => $v) {
            $source = $v['source'];
            foreach ($view as $ke => $va) {
                $url = '/dev/'.$va;
                $sql = "select count(*) as pv from ownerreferral_201812_view_logs where url = '{$url}' and source = '{$source}'";
                $res = $this->Source->execute($sql);
                $arr[$k]['view'][$ke]['pv'] = $res ? $res[0]['pv'] : 0;
                if($ke == 'KV页' || $ke == '推荐人填写信息页' || $ke == '被推荐人填写信息页') {
                    $sql = "select count(distinct openId) as uv from ownerreferral_201812_view_logs where url = '{$v}' and source = '{$source}'";
                    $res = $this->Source->execute($sql);
                    $arr[$k][$ke]['uv'] = $res ? $res[0]['uv'] : 0;
                } else {
                    $sql = "select count(distinct phone) as uv from ownerreferral_201812_view_logs where url = '{$v}' and source = '{$source}'";
                    $res = $this->Source->execute($sql);
                    $arr[$k]['view'][$ke]['uv'] = $res ? $res[0]['uv'] : 0;
                }
            }
            $sql = "select count(*) as user_num from ownerreferral_201812_user where source = '{$source}' and master_uid = 0";
            $res = $this->Source->execute($sql);
            $arr[$k]['user_num'] = $res ? $res[0]['user_num'] : 0;
            $sql = "select count(*) as user_num from ownerreferral_201812_user where source = '{$source}' and master_uid = 0";
            $res = $this->Source->execute($sql);
            $arr[$k]['invite_num'] = $res ? $res[0]['invite_num'] : 0;
        }

        var_dump($arr);exit;

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
