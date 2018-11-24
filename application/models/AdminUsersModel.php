<?php
/**
 * Created by PhpStorm.
 * User: zhouyang
 * Date: 2015/8/11
 * Time: 15:43
 */
namespace Xy\Application\Models;

class AdminUsersModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct($open_sql_log = false)
    {
        parent::__construct();

        $this->_db_obj          = new \Xy\Application\Models\DB\AdminUsersDB();


        $this->_db_obj->setOpenSqlLog($open_sql_log);
    }

}
