<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/17
 * Time: 下午4:40
 */
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Item extends Base
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->Item = new \Xy\Application\Models\ItemModel();
    }

    /**
     *
     */
    public function index()
    {
        $page = $this->input->get_post('pageNum', true);
        $page = $page ? (int)$page : 1;
        $page_list = $this->input->get_post('numPerPage', true);
        $page_list = $page_list ? (int)$page_list : self::DEFAULT_PAGE_LIST;

        $where = array();
        $data = $this->Item->getPage($page, $page_list, $where, 'id');

        foreach ($data['list'] as &$value) {
            $value['name'] = '礼品'.$value['item_id'];
        }
        $this->display($data);
    }

    //查看用户资料
    public function editNum()
    {
        $id = $this->input->get_post('id', true);

        if (is_ajax('post')) {
            $num  = $this->input->get_post('num', true);
            $res = $this->Item->editNum($id, ['num' => $num]);
            if ($res) {
                $this->dwzAjaxReturn(200, '操作成功');
            } else {
                $this->dwzAjaxReturn(401, '操作失败');
            }
        } else {
            $data = $this->Item->getItemInfoById($id);
            $this->display($data);
        }
    }
}
