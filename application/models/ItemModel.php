<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/17
 * Time: 下午2:42
 */
namespace Xy\Application\Models;

class ItemModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\ItemDB();
    }

    public function getItemInfoById($id)
    {
        $where['id'] = $id;
        $ret = $this->getOne($where);
        return $ret;
    }

    public function editNum($id, $data)
    {
        $where['id'] = $id;
        $ret = $this->edit($data, $where);
        return $ret;
    }
}
