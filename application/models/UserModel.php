<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2016/6/2
 * Time: 15:43
 */
namespace Xy\Application\Models;

class UserModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\UserDB();
    }

    public function getUserInfoByOpId($openId)
    {
        $where['open_id'] = $openId;
        $ret = $this->getOne($where);
        return $ret;
    }

    public function getUserInfoByid($id)
    {
        $where['id'] = $id;
        $ret = $this->getOne($where);
        return $ret;
    }

    public function addUserOpenId($data)
    {
        $ret = $this->add($data);
        return $ret;
    }

    public function editUserOpenId($openId, $data)
    {
        $where['open_id'] = $openId;
        $ret = $this->edit($data, $where);
        return $ret;
    }

    public function editUserId($id, $data)
    {
        $where['id'] = $id;
        $ret = $this->edit($data, $where);
        return $ret;
    }

    public function editUserUid($id, $data)
    {
        $where['id'] = $id;
        $ret = $this->edit($data, $where);
        return $ret;
    }

    public function getUserInfoByPhone($phone)
    {
        $where['phone'] = $phone;
        $ret = $this->getOne($where);
        return $ret;
    }

    public function getUserInviteCode($inviteCode)
    {
        $where['invite_code'] = $inviteCode;
        $ret = $this->getOne($where);
        return $ret;
    }

    public function getUserToken($token)
    {
        $where['token'] = $token;
        $ret = $this->getOne($where);
        return $ret;
    }

    public function incrementSubmitNum($id)
    {
        $sql = "update ownerreferral_201812_user set submit_num = submit_num + 1 where id = '{$id}'";
        $res = $this->_db_obj->execute($sql);
        return $res;
    }

    public function getUserInfoByDriver($number)
    {
        $where['driver_number'] = $number;
        $ret = $this->getOne($where);
        return $ret ? $ret : false;
    }

    public function getInviteInfoByUid($uid)
    {
        $where['master_uid'] = $uid;
        $ret = $this->getAll($where, 'created_at', 10);
        return $ret;
    }

    public function getInviteSuccByUid($uid)
    {
        $where['master_uid'] = $uid;
        $where['status'] = 3;
        $ret = $this->getAll($where, 'created_at', 2);
        return $ret;
    }

    public function getUserInviteCounts($code)
    {
        $where['from_invite_code'] = $code;
        $ret = $this->counts($where);
        return $ret;
    }
}
