<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2016/6/2
 * Time: 15:43
 */
namespace Xy\Application\Models;

class UserPushModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\UserPushDB();
    }

    public function addUserDiaryInfo($data)
    {
        $ret = $this->add($data);
        return $ret;
    }

    public function geDiaryInfo($uid = '')
    {
        $order = "create_dt desc";
        if(empty($uid)) {
            $ret = $this->getAll('',$order);
        } else {
            $where['uid'] = $uid;
            $ret = $this->getAll($where, $order);
        }
        foreach($ret as $k => $v) {
            $data[$k] = $v;
            $view_content = json_decode($v['content'], true);
            foreach($view_content as $ke => $val) {
                if(isset($val['img']) && !$data[$k]['img']) {
                    $data[$k]['img'] = $val['img'];
                }
                if(isset($val['content']) && !$data[$k]['title']) {
                    $data[$k]['title'] = $val['content'];
                }
            }

        }
        return $data;
    }

    public function getDiaryInfoById($id)
    {
        $where['id'] = $id;
        $ret = $this->getOne($where);
        return $ret ? $ret : [];
    }

    public function updateLike($id, $status=2)
    {
        $where['id'] = $id;
        $info = $this->getOne($where);
        if($status == 2) {
            $num = $info['like_count'] + 1;
        } else {
            $num = $info['like_count'] > 0  ? $info['like_count'] - 1 : 0 ;
        }
        $data = [
            'like_count' =>$num
        ];
        $this->edit($data, $where);
        return $num;
    }

    public function updatePlay($id, $status=2)
    {
        $where['id'] = $id;
        $info = $this->getOne($where);
        if($status == 2) {
            $num = $info['play_count'] + 1;
        } else {
            $num = $info['play_count'] > 0  ? $info['play_count'] - 1 : 0 ;
        }
        $data = [
            'play_count' =>$num
        ];
        $this->edit($data, $where);
        return $num;
    }
}
