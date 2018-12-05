<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2018/12/6
 * Time: 10:44
 */
namespace Xy\Application\Models;

class UploadLogModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\ViewAssessDB();
    }

    public function addUploadInfo($data)
    {
        $ret = $this->add($data);
        return $ret;
    }

    public function getUploadInfo($uid, $type)
    {
        $where['uid']   = $uid;
        $where['type']  = $type;
        $ret = $this->getOne($where);
        return $ret;
    }
}
