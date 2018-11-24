<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2018/11/24
 * Time: 15:43
 */
namespace Xy\Application\Models\DB;

class UserWxDB extends BaseDB
{
    public $_table_obj = 'ownerreferral_201812_user_weixin';
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }
}
