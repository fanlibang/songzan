<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/17
 * Time: 下午2:43
 */
namespace Xy\Application\Models\DB;

class ShopCarDB extends BaseDB
{
    public $_table_obj = 'ownerreferral_201812_shop_car_info';
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }
}