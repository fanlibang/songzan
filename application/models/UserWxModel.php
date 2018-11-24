<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2018/11/24
 * Time: 15:43
 */
namespace Xy\Application\Models;

class UserWxModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\UserWxDB();
    }

    public function getUserInfoByOpId($openId)
    {
        $where['openId'] = $openId;
        $ret = $this->getOne($where);
        return $ret;
    }

    public function getUserInfoByUid($uId)
    {
        $where['uid'] = $uId;
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

    public function editUserUid($uid, $data)
    {
        $where['uid'] = $uid;
        $ret = $this->edit($data, $where);
        return $ret;
    }

    public function getUserInfoByPhone($phone)
    {
        $where['iphone'] = $phone;
        $ret = $this->getOne($where);
        return $ret;
    }
}
