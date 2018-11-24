<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2016/6/2
 * Time: 15:43
 */
namespace Xy\Application\Models;

class UserOptionModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\UserOptionDB();
    }

    public function addUserOption($openId, $id, $type=1)
    {
        $status = false;
        $where['openId'] = $openId;
        $where['item_id'] = $id;
        $where['type'] = $type;
        $res = $this->getOne($where);
        if(!$res) {
            $data = [
                'openId'    => $openId,
                'item_id'   => $id,
                'type'      => $type,
                'create_dt' =>NOW_DATE_TIME
            ];
            $this->add($data);
            $status = true;
        }
        return $status;
    }

    public function getUserOption($openId, $id, $type=2)
    {
        $where['openId'] = $openId;
        $where['type'] = $type;
        $where['item_id'] = $id;
        $res = $this->getOne($where);
        return $res;
    }

    public function delUserOption($openId, $id, $type=2)
    {
        $where['openId'] = $openId;
        $where['type'] = $type;
        $where['item_id'] = $id;
        $res = $this->del($where);
        return $res;
    }
}
