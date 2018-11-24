<?php
/**
 * Created by PhpStorm.
 * User: zhouyang
 * Date: 2015/8/11
 * Time: 15:43
 */
namespace Xy\Application\Models\DB;

class AdminUsersDB extends BaseDB
{
    public $_table_obj = 'admin_users';

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }
}
