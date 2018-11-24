<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2016/6/2
 * Time: 15:43
 */
namespace Xy\Application\Models\DB;

class UserDiaryDB extends BaseDB
{
    public $_table_obj = 'L462_18songzan_user_diary';
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }
}
