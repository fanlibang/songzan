<?php
/**
 * Created by PhpStorm.
 * User: zhouyang
 * Date: 2015/8/11
 * Time: 15:43
 */
namespace Xy\Application\Models\DB;

class AdminCatesDB extends BaseDB
{
    public $_table_obj = 'ownerreferral_201812_admin_cates';

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 添加管理菜单
     *
     * @param array $data
     * @return array|bool|string
     */
    public function addCate($data = array())
    {
        if ($data['pid']) {
            $cate_info = $this->getOne(array('id' => $data['pid']));

            $left_value = $cate_info['right_value'];
            $right_value = $cate_info['right_value']+1;
            $this->refreshCateTree($cate_info['right_value']);
        } else {
            $max_value = $this->getMaxRightValue();

            $left_value = $max_value + 1;
            $right_value = $max_value + 2;
        }

        $data['left_value'] = $left_value;
        $data['right_value'] = $right_value;

        return $this->add($data);
    }

    /**
     * 删除管理菜单
     *
     * @param $id
     * @return bool
     */
    public function delCate($id)
    {
        $cate_info = $this->getOne(array('id' => $id));

        if ($cate_info) {
            $v_width = $cate_info['right_value'] - $cate_info['left_value'] + 1;

            $dsql = 'DELETE FROM admin_cates WHERE left_value BETWEEN '.$cate_info['left_value'].' AND '.$cate_info['right_value'];
            $lsql = 'UPDATE admin_cates SET left_value = left_value - '.$v_width.' WHERE left_value > '.$cate_info['right_value'];
            $rsql = 'UPDATE admin_cates SET right_value = right_value - '.$v_width.' WHERE right_value > '.$cate_info['right_value'];
            $this->execute($dsql);
            $this->execute($lsql);
            $this->execute($rsql);

            return true;
        } else {
            return false;
        }
    }

    /**
     * 由于树的顶部是虚拟的：left_value:0,right_value:max_value
     *
     * @return string
     */
    public function getMaxRightValue()
    {
        $sql = 'select max(right_value) as max_right_value from admin_cates';
        $ret = $this->execute($sql);

        return $ret[0]['max_right_value'] ? $ret[0]['max_right_value'] : 0;
    }

    /**
     * 刷新分类树的预排序
     *
     * @param $right_value
     * @param string $span
     * @return bool
     */
    public function refreshCateTree($right_value, $span = '+2')
    {
        $lsql = 'UPDATE admin_cates SET left_value=left_value'.$span.' WHERE left_value > '.$right_value;
        $rsql = 'UPDATE admin_cates SET right_value=right_value'.$span.' WHERE right_value >= '.$right_value;
        $this->execute($lsql);
        $this->execute($rsql);
        return true;
    }

    /**
     * 获取最大排序
     *
     * @return string
     */
    public function getMaxRank()
    {
        $sql = 'select max(rank) as max_rank from admin_cates';
        $ret = $this->execute($sql);

        return ($ret[0]['max_rank'] ? $ret[0]['max_rank'] : 0)+1;
    }

    /**
     * 获取移动菜单项信息
     *
     * @param $id
     * @param null $cate
     * @return bool
     */
    public function getMoveCates($id, $cate = null)
    {
        if ($cate == null) {
            $cate   =   $this->getOne(array('id' => $id));
        }

        $left_value     =   $cate['left_value'];
        $right_value    =   $cate['right_value'];

        return $this->getAll('`left_value`>='.$left_value.' AND `right_value`<=' . $right_value);
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
        $cate   =   $this->getOne(array('id' => $id));
        $pcate  =   $this->getOne(array('id' => $pid));

        if (empty($cate)) {
            return false;
        }

        $left_value     =   (int)$cate['left_value'];
        $right_value    =   (int)$cate['right_value'];
        $value          =   $right_value-$left_value;

        //取得所有分类的ID方便更新左右值
        $cate_ids = $this->getMoveCates($id, $cate);
        $ids = array();
        foreach ($cate_ids as $v) {
            $ids[]=$v['id'];
        }
        $in_ids = implode(",", $ids);

        $pleft_value    =   0;
        $pright_value   =   0;
        if ($pcate) {
            $pleft_value    = (int)$pcate['left_value'];
            $pright_value   = (int)$pcate['right_value'];
        }

        if ($pright_value > $right_value) {
            $this->execute('UPDATE admin_cates SET left_value = left_value - '.$value.' - 1 WHERE left_value > '.$right_value.' and right_value <= '.$pright_value);

            $this->execute('UPDATE admin_cates SET right_value = right_value - '.$value.' - 1 WHERE right_value >  '.$right_value.' and right_value < '.$pright_value);

            $tem_value  =   $pright_value-$right_value-1;
            $this->execute('UPDATE admin_cates SET left_value = left_value + '.$tem_value.', right_value = right_value + '.$tem_value.' WHERE id IN('.$in_ids.')');
        } else {
            $this->execute('UPDATE admin_cates SET left_value = left_value + '.$value.' + 1 WHERE left_value > '.$pright_value.' and left_value < '.$left_value);

            $this->execute('UPDATE admin_cates SET right_value = right_value + '.$value.' + 1 WHERE right_value >= '.$pright_value.' and right_value < '.$left_value);

            $tem_value  =   $left_value-$pright_value;
            $this->execute('UPDATE  admin_cates SET left_value = left_value - '.$tem_value.', right_value = right_value - '.$tem_value.' WHERE id IN('.$in_ids.')');
        }

        return true;
    }
}
