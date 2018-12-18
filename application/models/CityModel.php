<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/17
 * Time: 下午2:42
 */
namespace Xy\Application\Models;

class CityModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\CityDB();
    }


    public function getCityInfo($level)
    {
        $where['level'] = $level;
        $ret = $this->getAll($where);
        return $ret;
    }

    public function getCityInfoByCity($id)
    {
        $where['parent_id'] = $id;
        $where['level'] = 1;
        $this->setSqlFiled('city_name');
        $ret = $this->getAll($where);
        return $ret;
    }
}
