<?php
/**
 * Created by PhpStorm.
 * User: zhouyang
 * Date: 2015/8/11
 * Time: 15:43
 */
namespace Xy\Application\Models;

class AdminCatesModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct($open_sql_log = true)
    {
        parent::__construct();

        $this->_db_obj      = new \Xy\Application\Models\DB\AdminCatesDB();

        $this->_db_obj->setOpenSqlLog($open_sql_log);
    }

    /**
     * 添加管理菜单
     *
     * @param array $data
     * @return array|bool|string
     */
    public function addCate($data = array())
    {
        return $this->_db_obj->addCate($data);
    }

    /**
     * 删除管理菜单
     *
     * @param $id
     * @return bool
     */
    public function delCate($id)
    {
        return $this->_db_obj->delCate($id);
    }

    /**
     * 获取最大排序
     *
     * @return string
     */
    public function getMaxRank()
    {
        return $this->_db_obj->getMaxRank();
    }

    /**
     * 移动菜单方法
     *
     * @param $id
     * @param $pid
     * @return bool
     */
    public function moveCate($id, $pid)
    {
        return $this->_db_obj->moveCate($id, $pid);
    }
}
