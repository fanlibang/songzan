<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/2
 * Time: 下午4:33
 */
namespace Xy\Application\Models\DB;

class SourceDB extends BaseDB
{
    public $_table_obj = 'ownerreferral_201812_source';
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }
}