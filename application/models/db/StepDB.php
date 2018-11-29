<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/11/29
 * Time: 下午10:45
 */
namespace Xy\Application\Models\DB;

class StepDB extends BaseDB
{
    public $_table_obj = 'ownerreferral_201812_step';
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }
}