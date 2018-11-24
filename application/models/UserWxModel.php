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

    public function getWxInfoByOpId($openId)
    {
        $where['openId'] = $openId;
        $ret = $this->getOne($where);
        return $ret;
    }

    public function addWxInfo($data)
    {
        $ret = $this->add($data);
        return $ret;
    }

    public function editWxInfo($openId, $data)
    {
        $where['openId'] = $openId;
        $ret = $this->edit($data, $where);
        return $ret;
    }
}
