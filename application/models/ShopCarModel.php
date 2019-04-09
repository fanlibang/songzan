<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/17
 * Time: 下午2:42
 */
namespace Xy\Application\Models;

class ShopCarModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\ShopCarDB();
    }

    public function addUserCar($data)
    {
        $ret = $this->add($data);
        return $ret;
    }

    public function editUserCar($id, $data)
    {
        $where['id'] = $id;
        $ret = $this->edit($data, $where);
        return $ret;
    }

    public function editUserCarUid($uid, $data)
    {
        $where['uid'] = $uid;
        $ret = $this->edit($data, $where);
        return $ret;
    }

<<<<<<< HEAD
=======

>>>>>>> 4a363b83ea601bc0cdf403428e8d6601904d353d
    public function getCarInfoByUid($uid)
    {
        $where['uid'] = $uid;
        $ret = $this->getOne($where);
        return $ret;
    }

    public function getAllCarInfo()
    {
        $ret = $this->getAll();
        return $ret;
    }


}
