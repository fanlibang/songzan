<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/12/2
 * Time: 下午4:37
 */
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Activity extends Base
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->User = new \Xy\Application\Models\UserModel();
    }

    /**
     * 按钮点击统计
     */
    public function index()
    {
        $sql = "select * from `ownerreferral_201812_data`";
        $info = $this->User->execute($sql);
        $data = $info[0];
        $this->display($data);
    }

    /**
     * 修改
     */
    public function edit()
    {
        if (is_ajax('post')) {
            $time   = $this->input->post('time', true);
            $sql    = "update `ownerreferral_201812_data` set time = '{$time}'";
            $this->User->execute($sql);
            $this->dwzAjaxReturn(self::AJ_RET_SUCC, '修改成功', $this->_data['controller']);
        } else {
            $sql = "select * from `ownerreferral_201812_data`";
            $info = $this->User->execute($sql);
            $data = $info[0];
            $this->display($data, 'info');
        }
    }
}
