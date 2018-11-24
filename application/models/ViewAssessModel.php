<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2016/6/2
 * Time: 15:43
 */
namespace Xy\Application\Models;

class ViewAssessModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\ViewAssessDB();
    }

    public function addUserWxInfo($data)
    {
        $ret = $this->add($data);
        return $ret;
    }

    public function getUserWxInfo($openId)
    {
        $where['openId'] = $openId;
        $ret = $this->getOne($where);
        return $ret;
    }
}
