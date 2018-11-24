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
        $where['openId'] = $openId;
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
        $where['openId'] = $openId;
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
}
