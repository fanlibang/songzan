<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/11/24
 * Time: 下午5:29
 */
namespace Xy\Application\Models\DB;

class CarInfoDB extends BaseDB
{
    public $_table_obj = 'ownerreferral_201812_car_info';

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }
}
