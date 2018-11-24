<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/11/24
 * Time: 下午5:29
 */
namespace Xy\Application\Models;

class CarInfoModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\CarInfoDB();
    }

    public function getAllCarInfo()
    {
        $ret = $this->getAll();
        return $ret;
    }

    public function getCarInfoByid($id)
    {
        $where['id'] = $id;
        $ret = $this->getOne($where);
        return $ret;
    }
}
