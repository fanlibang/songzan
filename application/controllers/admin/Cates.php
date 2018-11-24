<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Cates extends Base
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 首页/列表页
     */
    public function index()
    {
        $page   =   $this->input->get_post('pageNum', true);
        $page   =   $page ? (int)$page : 1;
        $page_list  =  $this->input->get_post('numPerPage', true);
        $page_list  =   $page_list ? (int)$page_list : self::DEFAULT_PAGE_LIST;
        $title  = $this->input->get_post('title', true);
        $title  = $title ? $title : null;

        $where = array();

        if (!empty($title)) {
            $where['like']['title'] = $title;
        }

        $data = $this->AdminCates->getPage($page, $page_list, $where, array('left_value' => 'asc'));

        $data['title']      = $title;

        $this->display($data);
    }

    /**
     * 添加
     */
    public function add()
    {
        if (is_ajax('post')) {
            $title  = $this->input->post('title', true);
            $pid    = $this->input->post('pid', true);
            $url    = $this->input->post('url', true);
            $status = $this->input->post('status', true);
            $rank   = $this->input->post('rank', true);

            $info = array(
                'rel'           => $url,
                'title'         => $title,
                'url'           => $url,
                'status'        => $status,
                'pid'           => $pid,
                'rank'          => $rank
            );

            $ret = $this->AdminCates->addCate($info);

            if ($ret) {
                //设置对应菜单的所属角色
                $this->setRoles($ret);

                $this->dwzAjaxReturn(self::AJ_RET_SUCC, '添加成功', $this->_data['controller']);
            } else {
                $this->ajaxJsonReturn(self::AJ_RET_FAIL, '添加失败');
            }
        } else {
            $rank = $this->AdminCates->getMaxRank();

            $info = array(
                'id'            => '',
                'title'         => '',
                'url'           => '',
                'relation_url'  => '',
                'status'        => '',
                'pid'           => '',
                'rank'          => $rank
            );
            $pinfo = array(
                'id'    => '',
                'title' => ''
            );
            $this->display(array('info' => $info, 'pinfo' => $pinfo, 'role_ids' => '', 'role_names' => ''), 'info');
        }
    }

    /**
     * 修改
     */
    public function edit()
    {
        if (is_ajax('post')) {
            $id     = $this->input->post('id', true);

            $old_pid= $this->input->post('old_pid', true);
            $pid    = $this->input->post('pid', true);

            $title  = $this->input->post('title', true);
            $url    = $this->input->post('url', true);
            $status = $this->input->post('status', true);
            $rank   = $this->input->post('rank', true);

            $info = array(
                'rel'           => $url,
                'title'         => $title,
                'url'           => $url,
                'pid'           => $pid,
                'status'        => $status,
                'rank'          => $rank
            );

            $ret = $this->AdminCates->edit($info, array('id' => $id));

            if ($ret) {
                $this->dwzAjaxReturn(self::AJ_RET_SUCC, '修改成功', $this->_data['controller']);
            } else {
                $this->dwzAjaxReturn(self::AJ_RET_FAIL, '修改失败');
            }
        } else {
            $id = $this->input->get('id', true);

            $where = array('id' => $id);
            $info = $this->AdminCates->getOne($where);

            if ($info['pid'] > 0) {
                $p_where = array('id' => $info['pid']);
                $pinfo = $this->AdminCates->getOne($p_where);
            } else {
                $pinfo = array(
                    'id'=>0,
                    'title'=>'管理中心'
                );
            }


            $data = array(
                'info' => $info,
                'pinfo' => $pinfo,
            );

            $this->display($data, 'info');
        }
    }

    /**
     * 删除
     */
    public function del()
    {
        $id = (int)$this->input->get('id', true);

        $where = array('id' => $id);
        $info = $this->AdminCates->getOne($where);

        if ($info['right_value'] - $info['left_value'] > 1) {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '该菜单下有子菜单，不能删除！');
        }

        $ret = $this->AdminCates->delCate($id);

        if ($ret) {

            $this->dwzAjaxReturn(self::AJ_RET_SUCC, '删除成功', $this->_data['controller'], null, 'no');
        } else {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '删除失败');
        }
    }

    /**
     * 更新状态
     */
    public function status()
    {
        $id     = $this->input->get_post('id', true);
        $status  = $this->input->get_post('value', true);

        if (!$status || !$id) {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '参数错误');
        }

        $status = $status == 1 ? 2 : 1;

        $ret = $this->edit(array('status' => $status), array('id' => $id));

        if ($ret) {
            $this->dwzAjaxReturn(self::AJ_RET_SUCC, '修改'.($status == 1 ? '启用' : '禁用').'状态成功', $this->_data['controller']);
        } else {
            $this->dwzAjaxReturn(self::AJ_RET_FAIL, '修改'.($status == 1 ? '启用' : '禁用').'状态失败');
        }
    }

    /**
     * 设置对应菜单的所属角色
     *
     * @param $id
     * @return bool
     */
    public function setRoles($id)
    {

        $role_ids   = $this->input->post('role_ids', true);
        if ($role_ids) {
            $add_batch_arr = array();
            $role_ids = explode(',', $role_ids);
            $role_ids = array_unique($role_ids);
            foreach ((array)$role_ids as $v) {
                if ($v) {
                    $add_batch_arr[] = array(
                        'role_id' => $v,
                        'cate_id' => $id
                    );
                }
            }
        }

        return false;
    }

    /**
     * 菜单角色设置
     */
    public function role()
    {
        if (is_ajax('post')) {
            $cate_ids   = $this->input->get_post('cate_ids', true);
            $role_id    = $this->input->get_post('role_id', true);
            $user_id    = $this->input->get_post('user_id', true);

            if ($user_id) {

                $cate_user_arr = array();
                if ($cate_ids) {
                    $cate_ids = array_unique($cate_ids);
                    foreach ((array)$cate_ids as $v) {
                        if ($v) {
                            $cate_user_arr[] = array(
                                'cate_id'   => $v,
                                'user_id'   => $user_id
                            );
                        }
                    }
                }

                $ret = false;
            } else {
                $cate_role_arr = array();
                if ($cate_ids) {
                    $cate_ids = array_unique($cate_ids);
                    foreach ((array)$cate_ids as $v) {
                        if ($v) {
                            $cate_role_arr[] = array(
                                'cate_id'   => $v,
                                'role_id'   => $role_id
                            );
                        }
                    }
                }

                $ret = false;
            }

            if ($ret) {
                $this->dwzAjaxReturn(self::AJ_RET_SUCC, '权限设置成功', $this->_data['controller']);
            } else {
                $this->dwzAjaxReturn(self::AJ_RET_FAIL, '权限设置失败');
            }
        } else {
            $dialog_rel = $this->input->get('dialog_rel', true);

            $role_id    = (int)$this->input->get('role_id', true);

            $user_id    = (int)$this->input->get('user_id', true);

            $user_cate_ids = array();

            if ($user_id) {
                $user_cate_ids = $this->getCateIdsByUserId($user_id);
            }


            $cate_ids = array();

            $cate_arr = $this->cates();

            $data = array(
                'role_id'       => $role_id,
                'cate_arr'      => $cate_arr,
                'cate_ids'      => $cate_ids,
                'user_cate_ids' => $user_cate_ids,
                'user_id'       => $user_id,
                'dialog_rel'    => $dialog_rel
            );

            $this->display($data);
        }
    }

    /**
     * 菜单显示项
     */
    public function sidebar()
    {
        $id  = $this->input->get('id', true);

        $cates = $this->cates();

        $cate_arr = isset($cates[$id]) ? $cates[$id] : array();

        $data = array(
            'cate_arr'              => $cate_arr
        );

        $this->display($data);
    }

    /**
     * 菜单父id设置
     */
    public function pid()
    {
        $cate_arr = $this->cates();

        $this->display(array('cate_arr' => $cate_arr));
    }

    /**
     * 获取菜单并且格式化成菜单树
     *
     * @return array
     */
    private function cates()
    {
        $login_uid  = $this->admin_user_info['id'];

        $is_super   = in_array($login_uid, $this->super_admin_ids) ? true : false;

        $cates = array_sort($this->AdminCates->getAll(), 'pid');

        return $this->genTree($cates);
    }

    /**
     * 重置菜单项左右值关系
     */
    public function resetInfo(){
        if(is_ajax_post()){
            if($this->_data['is_super_admin'] == true){
                $request = $this->input->request(null, true);

                $id             = (int)$request['id'];
                $id             = isset($id) ? $id : null;

                $pid            = $request['pid'];
                $pid            = $pid === 0 && is_numeric($pid) ? (int)$pid : null;

                $right_value    = (int)$request['right_value'];
                $right_value    = isset($right_value) ? $right_value : null;
                $left_value     = (int)$request['left_value'];
                $left_value     = isset($left_value) ? $left_value : null;

                if($id && $left_value && $right_value){
                    $info = array(
                        'right_value'   => $right_value,
                        'left_value'    => $left_value
                    );

                    if($pid === 0 && is_numeric($pid)){
                        $info['pid']    = $pid;
                    }

                    $ret = $this->AdminCates->edit($info, array('id' => $id));

                    if ($ret) {
                        $this->dwzAjaxReturn(self::AJ_RET_SUCC, '重置成功', $this->_data['controller'], null, 'no');
                    } else {
                        $this->dwzAjaxReturn(self::AJ_RET_FAIL, '重置失败');
                    }
                }else{
                    $this->dwzAjaxReturn(self::AJ_RET_FAIL, '参数错误');
                }
            }else{
                $this->dwzAjaxReturn(self::AJ_RET_FAIL, '只有超级管理员才能重置菜单，如有疑问请联系超级管理重置');
            }
        }else{
            $data = array();

            $this->display($data);
        }
    }

    /**
     * 重置添加
     */
    public function addInfo(){
        if (is_ajax_post()) {
            if($this->_data['is_super_admin'] == true){
                $title  = $this->input->post('title', true);
                $pid    = $this->input->post('pid', true);
                $url    = $this->input->post('url', true);
                $status = $this->input->post('status', true);
                $rank   = $this->input->post('rank', true);

                $relation_url = $this->input->post('relation_url', true);

                $left_value   = $this->input->post('left_value', true);
                $right_value  = $this->input->post('right_value', true);

                $info = array(
                    'rel'           => $url,
                    'title'         => $title,
                    'url'           => $url,
                    'relation_url'  => $relation_url,
                    'status'        => $status,
                    'pid'           => $pid,
                    'left_value'    => $left_value,
                    'right_value'   => $right_value,
                    'rank'          => $rank
                );

                $ret = $this->AdminCates->add($info);

                if ($ret) {
                    $this->dwzAjaxReturn(self::AJ_RET_SUCC, '重置添加成功', $this->_data['controller']);
                } else {
                    $this->ajaxJsonReturn(self::AJ_RET_FAIL, '重置添加失败');
                }
            }else{
                $this->dwzAjaxReturn(self::AJ_RET_FAIL, '只有超级管理员才能添加菜单，如有疑问请联系超级管理重置');
            }
        } else {
            $rank = $this->AdminCates->getMaxRank();

            $info = array(
                'id'            => '',
                'title'         => '',
                'url'           => '',
                'relation_url'  => '',
                'left_value'    => '',
                'right_value'   => '',
                'status'        => '',
                'pid'           => '',
                'rank'          => $rank
            );
            $pinfo = array(
                'id'    => '',
                'title' => ''
            );
            $this->display(array('info' => $info, 'pinfo' => $pinfo, 'role_ids' => '', 'role_names' => ''), 'addInfo');
        }
    }
}
