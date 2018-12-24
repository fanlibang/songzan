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
        $view = array('KV页' => 'Index/index', '推荐人填写信息页' => 'User/referee', '完善推荐人填写信息页' => 'User/updateInfo', '推荐人主页' => 'User/updateInfo', '推荐人进度页' => 'User/state', '推荐人海报页' => 'Invite/share', '推荐人选择奖励页' => 'User/reward', '推荐人延保条款页' => 'User/mgs', '推荐人物流信息页' => 'User/mgs', '被推荐人填写信息页' => 'User/site', '被推荐人主页' => 'Invite/info', '被推荐人进度页' => 'Invite/state', '上传购车图片页' => 'Invite/state', '被推荐人选择奖励页' => 'User/reward', '被推荐人延保条款页' => 'User/mgs', '被推荐人物流信息页' => 'Invite/site');
        $info = $this->Source->getAllSource();
        $arr = [];
        foreach($info as $k => $v) {
            $source = $v['title'];
            $arr[$k]['id'] = $v['id'];
            $arr[$k]['name'] = $v['name'];
            $arr[$k]['type'] = $v['type'];
            foreach ($view as $ke => $va) {
                $url = '/dev/'.$va;
                $sql = "select count(*) as pv from ownerreferral_201812_view_logs where url = '{$url}' and source = '{$source}'";
                $res = $this->Source->execute($sql);
                $arr[$k]['view'][$ke]['pv'] = $res ? $res[0]['pv'] : 0;
                if($ke == 'KV页' || $ke == '推荐人填写信息页' || $ke == '被推荐人填写信息页') {
                    $sql = "select count(distinct openId) as uv from ownerreferral_201812_view_logs where url = '{$url}' and source = '{$source}'";
                    $res = $this->Source->execute($sql);
                    $arr[$k]['view'][$ke]['uv'] = $res ? $res[0]['uv'] : 0;
                } else {
                    $sql = "select count(distinct phone) as uv from ownerreferral_201812_view_logs where url = '{$url}' and source = '{$source}'";
                    $res = $this->Source->execute($sql);
                    $arr[$k]['view'][$ke]['uv'] = $res ? $res[0]['uv'] : 0;
                }
                if($ke == '被推荐人填写信息页') {
                    $arr[$k]['share_num'] = $arr[$k]['view'][$ke]['pv'];
                }
            }
            $sql = "select count(*) as user_num from ownerreferral_201812_user where source = '{$source}' and master_uid = 0";
            $res = $this->Source->execute($sql);
            $arr[$k]['user_num'] = $res ? $res[0]['user_num'] : 0;
            $sql = "select count(*) as invite_num from ownerreferral_201812_user where source = '{$source}' and master_uid > 0";
            $res = $this->Source->execute($sql);
            $arr[$k]['invite_num'] = $res ? $res[0]['invite_num'] : 0;
        }

        if ($export) {
            $newLists = array('序号', '渠道名称', '点击方式', 'KVpv', 'KVuv', '推荐人填写信息页pv', '推荐人填写信息页uv', '完善推荐人填写信息页pv', '完善推荐人填写信息页uv', '推荐人主页pv', '推荐人主页pv', '推荐人主页uv', '推荐人海报页pv', '推荐人海报页uv', '被推荐人填写信息页pv', '被推荐人填写信息页uv', '被推荐人主页pv', '被推荐人主页uv', '推荐人数', '推荐人海报被扫描次数', '被推荐人人数');
            $newList[] = $newLists;
            foreach ($arr as $ke => $va) {
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

        $data['list'] = $arr;
        $this->display($data);
    }
}
