<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/2
 * Time: 下午4:33
 */
namespace Xy\Application\Models;

class SourceModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\SourceDB();
    }

    public function getAllSource()
    {
        $ret = $this->getAll();
        return $ret;
    }

    public function getSourceInfoByid($id)
    {
        $where['title'] = $id;
        $ret = $this->getOne($where);
        return $ret;
    }
}
