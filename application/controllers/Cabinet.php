<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Base.php';

class Cabinet extends Base {
    /**
     * 初始化
     */
    public function __construct() {
        parent::__construct();
		#载入 db_stat;
		//$this->XyMonitorData            = new \Xy\Application\Models\XyMonitorDataModel(true);
        $this->XyMonitorData            = new \Xy\Application\Models\XyMonitorDataModel();
        #载入 IosCpStat 操作类
        $this->IosCpStat                =   new \Xy\Application\Models\IosCpStatModel();
    }

    /**
     * 模板列表
     */
    public function dictionaryData()
    {
        $sql = "select * from db_stat.md_starviewer_config_dic group by code";
        $list = $this->XyMonitorData->execute($sql);
        $data['list']   = $list;

        $this->display($data);
    }

    /**
     * 添加字典
     */
    public function dictionaryInfo()
    {
        $info  = $this->input->request(null, false);
        $data  = array();

        if (is_ajax_post()) {
            $type = $info['type'];
            if(empty($info['code'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '字典编码不能为空');
            }
            if($type == 'add') {
                if(isset($info['sub_code'])) {
                    foreach($info['sub_code'] as $k => $v) {
                        $sub_code = $v;
                        $value = $info['value'][$k];
                        $sql = "select * from db_stat.md_starviewer_config_dic where code = '{$info['code']}' and sub_code = '{$sub_code}'";
                        $res = $this->XyMonitorData->execute($sql);
                        if($res) {
                            $this->ajaxReturn(self::AJ_RET_FAIL, '数据字典已存在');
                        }
                        $sql = "INSERT INTO db_stat.md_starviewer_config_dic (code, sub_code, value) VALUES ('{$info['code']}', '{$sub_code}', '{$value}') ON DUPLICATE KEY UPDATE value = '{$value}'";
                        $res = $this->XyMonitorData->execute($sql);
                        if(!$res) {
                            $this->ajaxReturn(self::AJ_RET_FAIL, '插入数据数据失败，请联系管理员');
                        }
                    }
                }
            } else {
                if(isset($info['sub_code'])) {
                    foreach($info['sub_code'] as $k => $v) {
                        $sub_code = $v;
                        $value = $info['value'][$k];
                        $sql = "INSERT INTO db_stat.md_starviewer_config_dic (code, sub_code, value) VALUES ('{$info['code']}', '{$sub_code}', '{$value}') ON DUPLICATE KEY UPDATE value = '{$value}'";
                        $this->XyMonitorData->execute($sql);
                    }
                }
            }
            $this->ajaxReturn(self::AJ_RET_SUCC, '编辑模板成功', site_url($this->_data['controller'], 'dictionaryData'));
        } else {
            $data['type'] = $info['type'];
            if($data['type'] == 'edit') {
                $data['code'] = $info['code'];
                $sql = "select * from db_stat.md_starviewer_config_dic where code = '{$info['code']}'";
                $info = $this->XyMonitorData->execute($sql);
                $data['list'] = $info;
            }

            $this->display($data);
        }
    }

    /**
     * 分组列表
     */
    public function dataConfig()
    {
        $sql = "select * from db_stat.md_starviewer_config";
        $list = $this->XyMonitorData->execute($sql);
        $data['list'] = $list;

        $this->display($data);
    }

    /**
     * 添加报表配置
     */
    public function dataConfigInfo()
    {
        $info  = $this->input->request(null, false);
        $data  = array();

        if (is_ajax_post()) {
            $mark = $info['mark'];
            if(empty($info['id'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '报表id不能为空');
            }

            if(empty($info['name'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '报表名称不能为空');
            }

            if(empty($info['title'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '备注信息不能为空');
            }

            $timeout = $info['timeout'] ? $info['timeout'] : 20;

            $limit = $info['limit'] ? $info['limit'] : 10;

            $content =  addslashes($info['content']);

            if($mark == 'add') {
                $sql = "select * from db_stat.md_starviewer_config where id = '{$info['id']}'";
                $res = $this->XyMonitorData->execute($sql);
                if($res) {
                    $this->ajaxReturn(self::AJ_RET_FAIL, '报表id不已存在');
                }
                $sql = "insert into db_stat.md_starviewer_config (id, name, title) values ('{$info['id']}', '{$info['name']}', '{$info['title']}')";
                $res1 = $this->XyMonitorData->execute($sql);

                $sql = "insert into db_stat.md_starviewer_config_query (config_id, type, data_source, content, timeout, `limit`) values ('{$info['id']}', '{$info['type']}', '{$info['data_source']}', '{$content}', '{$timeout}', '{$limit}')";
                $res2 = $this->XyMonitorData->execute($sql);

                if($res1 && $res2) {
                    if(isset($info['column'])) {
                        $this->subColumnData($info['column'], $info['id']);
                    }
                    if(isset($info['filter'])) {
                        $this->subFilterData($info['filter'], $info['id']);
                    }
                    $this->ajaxReturn(self::AJ_RET_SUCC, '添加模板成功', site_url($this->_data['controller'], 'dataConfig'));
                } else {
                    $this->ajaxReturn(self::AJ_RET_FAIL, '插入数据数据失败，请联系管理员1');
                }
            } else {
                $sql = "update db_stat.md_starviewer_config set name = '{$info['name']}', title = '{$info['title']}' where id = '{$info['id']}'";
                $res1 = $this->XyMonitorData->execute($sql);

                $sql = "update db_stat.md_starviewer_config_query set config_id = '{$info['id']}', type = '{$info['type']}', data_source = '{$info['data_source']}', timeout = '{$info['timeout']}', `limit` = '{$limit}', content = '{$content}' where id = '{$info['filed']}'";

                $res2 = $this->XyMonitorData->execute($sql);
                if($res1 >= 0 || $res2 >=0 ) {
                    if(isset($info['column'])) {
                        $this->subColumnData($info['column'], $info['id']);
                    }
                    if(isset($info['filter'])) {
                        $this->subFilterData($info['filter'], $info['id']);
                    }

                    $this->ajaxReturn(self::AJ_RET_SUCC, '编辑模板成功', site_url($this->_data['controller'], 'dataConfig'));
                } else {
                    $this->ajaxReturn(self::AJ_RET_FAIL, '插入数据数据失败，请联系管理员edit');
                }
            }
        } else {
            $data['type'] = $info['type'];
            if($data['type'] == 'edit') {
                $sql = "select * from db_stat.md_starviewer_config where id = '{$info['id']}'";
                $res = $this->XyMonitorData->execute($sql);
                $data['config'] = $res[0];
                $sql = "select * from db_stat.md_starviewer_config_query where config_id = '{$info['id']}'";
                $res = $this->XyMonitorData->execute($sql);
                $data['query'] = $res[0];
                $sql = "select * from db_stat.md_starviewer_config_column where config_id = '{$info['id']}'";
                $res = $this->XyMonitorData->execute($sql);
                $data['column'] = $res;
                $sql = "select * from db_stat.md_starviewer_config_filter where config_id = '{$info['id']}'";
                $res = $this->XyMonitorData->execute($sql);
                $data['filter'] = $res;
            }
            $this->display($data);
        }
    }

    /**
     * 添加报表配置
     */
    public function subColumn()
    {
        $info  = $this->input->request(null, false);

        if (is_ajax_post()) {
            if(empty($info['cid'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '报表配置id不能为空');
            }

            if(empty($info['data'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '数据名称不能为空');
            }

            if(empty($info['name'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '查询名称不能为空');
            }

            if(empty($info['title'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '表头名称不能为空');
            }

            if(empty($info['remark'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '备注信息不能为空');
            }

            if(empty($info['data_type'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '字段类型不能为空');
            }

            if(!$info['id']) {
                $sql = "insert into db_stat.md_starviewer_config_column (config_id, data, name, title, remark, visible, searchable, orderable, width, data_type)  values ('{$info['cid']}', '{$info['data']}', '{$info['name']}', '{$info['title']}', '{$info['remark']}', '{$info['visible']}', '{$info['searchable']}', '{$info['orderable']}', '{$info['width']}', '{$info['data_type']}')";
                $res = $this->XyMonitorData->execute($sql);
                $mes = "添加成功";
            } else {
                $sql = "update db_stat.md_starviewer_config_column set config_id = '{$info['cid']}', data = '{$info['data']}', name = '{$info['name']}',title = '{$info['title']}', remark = '{$info['remark']}', visible = '{$info['visible']}', searchable = '{$info['searchable']}', orderable = '{$info['orderable']}', width = '{$info['width']}', data_type = '{$info['data_type']}'  where id = '{$info['id']}'";
                $res = $this->XyMonitorData->execute($sql);
                $mes = "编辑成功";
            }
            if($res) {
                $this->ajaxReturn(self::AJ_RET_SUCC, $mes, '', $res);
            } else {
                $this->ajaxReturn(self::AJ_RET_FAIL, '插入数据数据失败，请联系管理员');
            }
        } else {
            $this->ajaxReturn(self::AJ_RET_FAIL, '请求不正确');
        }
    }


    /**
     *配置列表
     */
    public function filterLists()
    {
        $cid  = $this->input->request('cid', false);
        $sql = "select * from md_starviewer_config_filter where config_id = {$cid}";
        $list = $this->XyMonitorData->execute($sql);
        $data['list']   = $list;
        $data['cid']   = $cid;
        $this->display($data);
    }

    /**
     * 添加报表配置
     */
    public function subFilter()
    {
        $info  = $this->input->request(null, false);

        if (is_ajax_post()) {
            if(empty($info['cid'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '报表配置id不能为空');
            }

            if(empty($info['group'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '分组不能为空');
            }

            if(empty($info['type'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '元素类型不能为空');
            }

            if(empty($info['data'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, 'data不能为空');
            }

            if(empty($info['name'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '名称不能为空');
            }

            if(empty($info['title'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '标题不能为空');
            }

            $info['format'] = $info['format'] ? $info['format'] : 'YYYY-MM-DD';

            if(!$info['id']) {
                $sql = "insert into db_stat.md_starviewer_config_filter (config_id, `group`, type, data, name, title, begin, end, value, format)  values ('{$info['cid']}', '{$info['group']}', '{$info['type']}', '{$info['data']}', '{$info['name']}', '{$info['title']}', '{$info['begin']}', '{$info['end']}', '{$info['value']}', '{$info['format']}')";
                $res = $this->XyMonitorData->execute($sql);
                $mes = "添加成功";
            } else {
                $sql = "update db_stat.md_starviewer_config_filter set config_id = '{$info['cid']}', `group` = '{$info['group']}', type = '{$info['type']}',data = '{$info['data']}', name = '{$info['name']}', title = '{$info['title']}', begin = '{$info['begin']}', end = '{$info['end']}', value = '{$info['value']}', format = '{$info['format']}'  where id = '{$info['id']}'";
                $res = $this->XyMonitorData->execute($sql);
                $mes = "编辑成功";
            }
            if($res) {
                $this->ajaxReturn(self::AJ_RET_SUCC, $mes, '', $res);
            } else {
                $this->ajaxReturn(self::AJ_RET_FAIL, '插入数据数据失败，请联系管理员1');
            }
        } else {
            $this->ajaxReturn(self::AJ_RET_FAIL, '请求不正确');
        }
    }


    //插入配置数据
    function subColumnData($data, $configId) {
        foreach($data as $k => $v) {
            if(empty($v['data'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '数据名称不能为空');
            }

            if(empty($v['name'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '查询名称不能为空');
            }

            if(empty($v['title'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '表头名称不能为空');
            }

            if(empty($v['remark'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '备注信息不能为空');
            }

            if(empty($v['data_type'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '字段类型不能为空');
            }

            if(!$v['id']) {
                $sql = "insert into db_stat.md_starviewer_config_column (config_id, data, name, title, remark, visible, searchable, orderable, width, data_type, column_type)  values ('{$configId}', '{$v['data']}', '{$v['name']}', '{$v['title']}', '{$v['remark']}', '{$v['visible']}', '{$v['searchable']}', '{$v['orderable']}', '{$v['width']}', '{$v['data_type']}', '{$v['column_type']}')";
                $res = $this->XyMonitorData->execute($sql);
                $mes = "添加成功";
            } else {
                $sql = "update db_stat.md_starviewer_config_column set config_id = '{$configId}', data = '{$v['data']}', name = '{$v['name']}',title = '{$v['title']}', remark = '{$v['remark']}', visible = '{$v['visible']}', searchable = '{$v['searchable']}', orderable = '{$v['orderable']}', width = '{$v['width']}', data_type = '{$v['data_type']}', column_type = '{$v['column_type']}'  where id = '{$v['id']}'";
                $res = $this->XyMonitorData->execute($sql);
                $mes = "编辑成功";
            }
            if($res < 0) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '插入数据数据失败，请联系管理员');
            }
        }
    }

    //插入配置数据
    function subFilterData($data, $configId) {
        foreach($data as $k => $v) {
            if(empty($configId)) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '报表配置id不能为空');
            }

            if(empty($v['group'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '分组不能为空');
            }

            if(empty($v['type'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '元素类型不能为空');
            }

            if(empty($v['data'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, 'data不能为空');
            }

            if(empty($v['name'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '名称不能为空');
            }

            if(empty($v['title'])) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '标题不能为空');
            }

            $v['format'] = $v['format'] ? $v['format'] : 'YYYY-MM-DD';


            if(!$v['id']) {
                $sql = "insert into db_stat.md_starviewer_config_filter (config_id, `group`, type, data, name, title, begin, end, value, format)  values ('{$configId}', '{$v['group']}', '{$v['type']}', '{$v['data']}', '{$v['name']}', '{$v['title']}', '{$v['begin']}', '{$v['end']}', '{$v['value']}', '{$v['format']}')";
                $res = $this->XyMonitorData->execute($sql);
                $mes = "添加成功";
            } else {
                $sql = "update db_stat.md_starviewer_config_filter set config_id = '{$configId}', `group` = '{$v['group']}', type = '{$v['type']}',data = '{$v['data']}', name = '{$v['name']}', title = '{$v['title']}', begin = '{$v['begin']}', end = '{$v['end']}', value = '{$v['value']}', format = '{$v['format']}'  where id = '{$v['id']}'";
                $res = $this->XyMonitorData->execute($sql);
                $mes = "编辑成功";
            }

            if($res < 0) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '插入过滤配置数据失败，请联系管理员');
            }
        }

    }


    //修改状态
    public function delColumn()
    {
        $info  = $this->input->request(null, true, 'hsc_as');
        if (is_ajax_post()) {
            $id = $info['id'];
            if($id) {
                $sql = "delete from db_stat.md_starviewer_config_column where id = {$id}";
                $res = $this->XyMonitorData->execute($sql);
                if($res) {
                    $this->ajaxReturn(self::AJ_RET_SUCC, '删除成功');
                } else {
                    $this->ajaxReturn(self::AJ_RET_FAIL, '删除失败');
                }
            } else {
                $this->ajaxReturn(self::AJ_RET_SUCC, '删除成功');
            }
        } else {
            $this->ajaxReturn(self::AJ_RET_FAIL, '请求不正确');
        }
    }

    //删除配置
    public function delFilter()
    {
        $info  = $this->input->request(null, true, 'hsc_as');
        if (is_ajax_post()) {
            $id = $info['id'];
            if($id) {
                $sql = "delete from db_stat.md_starviewer_config_filter where id = {$id}";
                $res = $this->XyMonitorData->execute($sql);
                if($res) {
                    $this->ajaxReturn(self::AJ_RET_SUCC, '删除成功');
                } else {
                    $this->ajaxReturn(self::AJ_RET_FAIL, '删除失败');
                }
            } else {
                $this->ajaxReturn(self::AJ_RET_SUCC, '删除成功');
            }
        } else {
            $this->ajaxReturn(self::AJ_RET_FAIL, '请求不正确');
        }
    }

    //删除字段
    public function delDic()
    {
        $info  = $this->input->request(null, true, 'hsc_as');
        if (is_ajax_post()) {
            $code = $info['id'];
            $sub_code = $info['sub_code'];
            if($code && $sub_code) {
                $sql = "delete from db_stat.md_starviewer_config_dic where code = {$code} and sub_code = {$sub_code}";
                $res = $this->XyMonitorData->execute($sql);
                if($res) {
                    $this->ajaxReturn(self::AJ_RET_SUCC, '删除成功');
                } else {
                    $this->ajaxReturn(self::AJ_RET_FAIL, '删除失败');
                }
            } else {
                $this->ajaxReturn(self::AJ_RET_SUCC, '删除成功');
            }
        } else {
            $this->ajaxReturn(self::AJ_RET_FAIL, '请求不正确');
        }
    }

    //修改状态
    public function delConfig()
    {
        $info  = $this->input->request(null, true, 'hsc_as');
        if (is_ajax_post()) {
            $cid = $info['cid'];
            if($cid) {
                $sql = "delete from db_stat.md_starviewer_config_column where config_id = '{$cid}'";
                $this->XyMonitorData->execute($sql);
                $sql = "delete from db_stat.md_starviewer_config_filter where config_id = '{$cid}'";
                $this->XyMonitorData->execute($sql);
            } else {
                $this->ajaxReturn(self::AJ_RET_SUCC, '删除成功');
            }
        } else {
            $this->ajaxReturn(self::AJ_RET_FAIL, '请求不正确');
        }
    }

    //获取配置信息
    public function getConfig()
    {
        $info  = $this->input->request(null, true, 'hsc_as');

        if (is_ajax_post()) {
            $sql = "select * from db_stat.md_starviewer_config_dic group by code";
            $res = $this->XyMonitorData->execute($sql);
            $key = $info['key'];
            if($res) {
                $html = '';
                $html .= '<select name="filter['.$key.'][data]" class="form-control">';
                $html .= ' <option value="" >请选择</option>';
                foreach($res as $k => $v) {
                    $html .= '<option value="'.$v['code'].'">'.$v['code'].'</option>';
                }
                $html .= '</select>';
                $this->ajaxReturn(self::AJ_RET_SUCC, $html);
            } else {
                $this->ajaxReturn(self::AJ_RET_FAIL, '获取失败');
            }
        } else {
            $this->ajaxReturn(self::AJ_RET_FAIL, '请求出错');
        }
    }

    //获取配置信息
    public function getCodeConfig()
    {
        $info  = $this->input->request(null, true, 'hsc_as');

        if (is_ajax_post()) {
            $sql = "select * from db_stat.md_starviewer_config_dic where code = '{$info['id']}'";
            $res = $this->XyMonitorData->execute($sql);
            if($res) {
                $html = '';
                $html .= '<select name="data" class="form-control dic">';
                $html .= ' <option value="" >请选择</option>';
                foreach($res as $k => $v) {
                    $html .= '<option value="'.$v['code'].'">'.$v['code'].'</option>';
                }
                $html .= '</select>';
                $this->ajaxReturn(self::AJ_RET_SUCC, $html);
            } else {
                $this->ajaxReturn(self::AJ_RET_FAIL, '获取失败');
            }
        } else {
            $this->ajaxReturn(self::AJ_RET_FAIL, '请求出错');
        }
    }


    //修改状态
    public function status()
    {
        $info  = $this->input->request(null, true, 'hsc_as');
        $data= array();

        if (is_ajax_post()) {
            $id = $info['id'];
            if(empty($id)) {
                $this->ajaxReturn(self::AJ_RET_FAIL, '模板id丢失');
            }
            $status = $info['status'];

            if($status == 3) {
                $sql = "delete from db_stat.dms_md_template_config where id = {$info['id']}";
                $res = $this->XyMonitorData->execute($sql);
            } else {
                if($status == 1) {
                    $status = 2;
                } elseif($status == 2) {
                    $status = 1;
                }
                $sql = "update db_stat.dms_md_template_config set status = {$status} where id = {$info['id']}";
                $res = $this->XyMonitorData->execute($sql);
            }


            if($res) {
                $this->ajaxReturn(self::AJ_RET_SUCC, '修改状态成功');
            } else {
                $this->ajaxReturn(self::AJ_RET_FAIL, '修改状态失败');
            }
        } else {
            $this->display($data, 'configList');
        }
    }

    /**
     * 模板列表
     */
    public function view()
    {
        $view  = $this->input->request('view', true, 'hsc_as');
        $url = "http://rcmd-api.xyzs.com:7003/reporter-service-api/api/v1/reporter/config/".$view;
        $res = json_decode(curl_request($url, '', 'get', 0, 20), true);
        $data['info'] = $res;
        $info = json_decode(get_cookie($view),true);
        if($info) {
            foreach($info as $k=>$v) {
                $view_info[$k] = $v['visible'];
            }
        }
        foreach($res['columns'] as $k => $v) {
            if($view_info) {
                if(empty($view_info[$k])) {
                    $data['info']['columns'][$k]['visible'] = 'false';
                } else {
                    $data['info']['columns'][$k]['visible'] = true;
                }
            }
            if($v['dataType'] == 'date') {
                $data['dataType'] = $v['name'];
            }
            if($v['columnType'] == '2') {
                $columnType[$k]['name'] = $v['name'];
                $columnType[$k]['title'] = $v['title'];
            }
            if($k < 4) {
                $selected[$v['title']] = true;
            } else {
                $selected[$v['title']] = false;
            }
        }

        if($columnType) {
            $columnType = array_values($columnType);
        }
        //var_dump(localStorage.setItem(''));
        $data['columnTypes'] = $columnType;
        $data['columnType'] = json_encode($columnType);
        $data['selected'] = json_encode($selected);
        $this->display($data);
    }

    /**
     * 模板列表
     */
    public function filedView()
    {
        $info  = $this->input->request(null, true);
        $data= array();
    }

}
