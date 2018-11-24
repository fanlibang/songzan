<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2016/6/2
 * Time: 15:43
 */
namespace Xy\Application\Models;

class FeedBackModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\FeedBackDB();
    }

    public function addUserInfo($data)
    {
        $ret = $this->add($data);
        return $ret;
    }
}
