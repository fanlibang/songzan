<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/11/29
 * Time: 下午10:46
 */
namespace Xy\Application\Models;

class StepModel extends BaseModel
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_db_obj          = new \Xy\Application\Models\DB\StepDB();
    }

    public function genId($step)
    {
        $sql = "update ownerreferral_201812_step set id_value = id_value + 1 where stun = '{$step}'";
        $res = $this->_db_obj->execute($sql);
        if ($res) {
            $where['stun'] = $step;
            $ret = $this->getOne($where);
            return $ret['id_value'];
        }
    }
}
