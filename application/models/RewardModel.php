<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/17
 * Time: 下午2:42
 */
namespace Xy\Application\Models;

class RewardModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\RewardDB();
    }

    public function addUserReward($data)
    {
        $ret = $this->add($data);
        return $ret;
    }

    public function editUserReward($id, $data)
    {
        $where['id'] = $id;
        $ret = $this->edit($data, $where);
        return $ret;
    }


    public function getRewardInfoByUid($uid)
    {
        $where['uid'] = $uid;
        $ret = $this->getOne($where);
        return $ret;
    }

    public function getAllUserRewardInfo($uid)
    {
        $where['uid'] = $uid;
        $ret = $this->getAll($where);
        return $ret ? $ret : [];
    }

    public function getAllRewardInfo()
    {
        $ret = $this->getAll();
        return $ret;
    }

    public function getRewardInfoCount($uid)
    {
        $where['uid'] = $uid;
        $ret = $this->counts($where);
        return $ret;
    }

    public function getCarInfoCount($uid)
    {
        $where['uid'] = $uid;
        $ret = $this->counts($where);
        return $ret;
    }

}
