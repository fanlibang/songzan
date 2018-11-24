<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2016/6/2
 * Time: 15:43
 */
namespace Xy\Application\Models\DB;

class UserPushDB extends BaseDB
{
    public $_table_obj = 'l462_18songzan_push';
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }
}
