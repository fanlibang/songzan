<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2016/6/11
 * Time: 15:43
 */
namespace Xy\Application\Models\DB;

use Pimple;

require_once BASEPATH . '/core/Model.php';

class BaseDB extends \CI_Model
{
    public $_table_obj;

    public $_filed;

    # 初始化 container 容器
    protected $container;

    public $_read_db_obj;
    public $_write_db_obj;

    public $_last_sql;

    public $_open_log = false;

    /**
     * 初始化
     *
     */
    public function __construct()
    {
        parent::__construct();

        if (empty(self::$container)) $this->instanceServer();
        $this->_read_db_obj     = $this->container['default_read'];
        $this->_write_db_obj    = $this->container['default_write'];

    }

    /**
     * 设置容器
     *
     * @param $property
     * @param $callable
     */
    private function setProperty($property, $callable) {
        $this->container[$property] = $this->container->factory($callable);
        unset($this->$property);
    }

    /**
     * 初始化容器
     */
    public function instanceServer(){
        $this->container = new Pimple\Container();

        $self = $this;

        $this->setProperty('default_read' ,function() use($self){
            return $self->getDBServer('default_read');
        });

        $this->setProperty('default_write' ,function() use($self){
            return $self->getDBServer('default_write');
        });
    }

    /**
     * 实例 db 服务
     *
     * @param string $name
     */
    public function getDBServer($name = 'default_read') {
        return $this->load->database($name, true);
    }

    /**
     * 执行说起来语句方法
     *
     * @param null $sql
     * @return bool
     */
    public function execute($sql = null)
    {
        //判断sql语句类型
        $sql_type = strtolower(substr($sql, 0, 6));

        switch ($sql_type) {
            case 'select':
                $this->_read_db_obj->limit(1);

                $query = $this->_read_db_obj->query($sql);

                $ret = $query->result_array();

                //设置最后执行sql
                $this->_last_sql = $this->_read_db_obj->last_query();

                //记录数据库操作日志
                $this->sqlLog();

                return $ret;


                break;
            case 'insert':
                $this->_write_db_obj->query($sql);
                $insert_id = $this->_write_db_obj->insert_id();
                if ($insert_id == 0) {
                    $affect = $this->_write_db_obj->affected_rows();
                    if ($affect > 0) {
                        return true;
                    } else {
                        return false;
                    }
                }

                //设置最后执行sql
                $this->_last_sql = $this->_write_db_obj->last_query();

                //记录数据库操作日志
                $this->sqlLog();

                return $insert_id;
                break;
            case 'update':
            case 'delete':
                $this->_write_db_obj->query($sql);

                $ret = $this->_write_db_obj->affected_rows();

                //设置最后执行sql
                $this->_last_sql = $this->_write_db_obj->last_query();

                //记录数据库操作日志
                $this->sqlLog();

                return $ret;
                break;
        }

        return false;
    }

    /**
     * 查看表字段
     *
     * @return mixed
     */
    public function descTable()
    {
        $sql = 'desc ' . $this->_table_obj . ';';
        $query = $this->_read_db_obj->query($sql);

        $ret = $query->result_array();

        //设置最后执行sql
        $this->_last_sql = $this->_read_db_obj->last_query();

        //记录数据库操作日志
        $this->sqlLog();

        return $ret;
    }

    /**
     * 添加数据
     *
     * @param array $data
     * @return array|bool|string
     */
    public function add($data = array())
    {
        if (empty($this->_table_obj) || empty($data)) {
            return false;
        }

        $this->_write_db_obj->insert($this->_table_obj, $data);

        $insert_id = $this->_write_db_obj->insert_id();

        if ($insert_id == 0) {
            $affect = $this->_write_db_obj->affected_rows();
            if ($affect > 0) {
                return true;
            } else {
                return false;
            }
        }

        //设置最后执行sql
        $this->_last_sql = $this->_write_db_obj->last_query();

        //记录数据库操作日志
        $this->sqlLog();
        return $insert_id;
    }

    /**
     * 批量添加数据
     *
     * @param array $data
     * @return bool
     */
    public function addBatch($data = array())
    {
        if (empty($this->_table_obj) || empty($data)) {
            return false;
        }

        $this->_write_db_obj->insert_batch($this->_table_obj, $data);

        $insert_id = $this->_write_db_obj->insert_id();

        if ($insert_id == 0) {
            $affect = $this->_write_db_obj->affected_rows();
            if ($affect > 0) {
                return true;
            } else {
                return false;
            }
        }

        //设置最后执行sql
        $this->_last_sql = $this->_write_db_obj->last_query();

        //记录数据库操作日志
        $this->sqlLog();

        return $insert_id;
    }

    /**
     * 单表检查后插入数据
     *
     * @param array $data
     * @param array $where
     * @return array|bool|string 1 已存在 2 添加成功 false 添加失败
     */
    public function checkAdd($data = array(), $where = array(), $is_update = false){
        if(empty($data)){
            return false;
        }

        $search_where = $where;

        if(empty($search_where)){
            $search_where = $data;
        }

        $check = $this->getOne($search_where);

        if(empty($check)){
            $all_data = array_merge($data, $where);

            $ret = $this->add($all_data);

            return $ret ? 2 : false;
        }else{
            if($is_update){
                $is_edit = false;
                $all_data = array_merge($data, $where);

                foreach((array)$all_data as $k => $v){
                    if($v != $check[$k]){
                        $is_edit = true;
                    }
                }

                if($is_edit){
                    $ret = $this->edit($data, $where);

                    return $ret ? 1 : false;
                }
            }

            return 1;
        }
    }

    /**
     * 删除数据
     *
     * @param array $where
     * @return bool|int
     */
    public function del($where = array())
    {
        if (empty($this->_table_obj) || empty($where)) {
            return false;
        }

        $this->sqlWhere($where, 'write');

        $this->_write_db_obj->delete($this->_table_obj);

        $ret = $this->_write_db_obj->affected_rows();

        //设置最后执行sql
        $this->_last_sql = $this->_write_db_obj->last_query();

        //记录数据库操作日志
        $this->sqlLog();

        return $ret;
    }

    /**
     * 修改数据
     *
     * @param array $data
     * @param array $where
     * @return bool|int
     */
    public function edit($data = array(), $where = array())
    {
        if (empty($this->_table_obj) || empty($where) || empty($data)) {
            return false;
        }

        //设置修改字段条件组成
        $this->sqlSet($data, 'write');
        //查询条件组成
        $this->sqlWhere($where, 'write');

        $this->_write_db_obj->update($this->_table_obj, $data);

        $ret = $this->_write_db_obj->affected_rows();

        //设置最后执行sql
        $this->_last_sql = $this->_write_db_obj->last_query();

        //记录数据库操作日志
        $this->sqlLog();

        return $ret;
    }

    /**
     * 计数
     *
     * @param array $where
     * @return mixed
     */
    public function counts($where = array())
    {
        if (empty($this->_table_obj)) {
            return false;
        }

        if ($where) {
            //查询条件组成
            $this->sqlWhere($where);
        }

        $ret = $this->_read_db_obj->count_all_results($this->_table_obj);

        //设置最后执行sql
        $this->_last_sql = $this->_read_db_obj->last_query();

        //记录数据库操作日志
        $this->sqlLog();

        return $ret;
    }

    /**
     * 求和
     *
     * @param array $where
     * @param string $filed
     * @return sum
     */
    public function sum($filed = "", $where = array())
    {
        if (empty($this->_table_obj)) {
            return false;
        }

        if ($where) {
            //查询条件组成
            $this->sqlWhere($where);
        }

        $this->_read_db_obj->select_sum($filed, 'counts');
        $query = $this->_read_db_obj->get($this->_table_obj);

        //var_dump($query->result_array());

        //设置最后执行sql
        $this->_last_sql = $this->_read_db_obj->last_query();

        //记录数据库操作日志
        $this->sqlLog();
        $ret = $query->result_array();
        return isset($ret[0]['counts']) ? $ret[0]['counts'] : 0;
    }

    /**
     * 查询单个数据
     *
     * @param array $where
     * @param array $order_by
     * @return bool
     */
    public function getOne($where = array(), $order_by = array())
    {
        if (empty($this->_table_obj)) {
            return false;
        }

        $this->sqlFiled($this->_read_db_obj);

        $this->_read_db_obj->from($this->_table_obj);

        if ($where) {
            //查询条件组成
            $this->sqlWhere($where);
        }
        if ($order_by) {
            //排序条件组成
            $this->sqlOrder($order_by);
        }

        $this->_read_db_obj->limit(1);

        $query = $this->_read_db_obj->get();

        $ret = $query->row_array();

        //设置最后执行sql
        $this->_last_sql = $this->_read_db_obj->last_query();

        //记录数据库操作日志
        $this->sqlLog();

        return $ret;
    }

    /**
     * 查询全部列表数据
     *
     * @param array $where
     * @param array $order_by
     * @param null $num
     * @return bool
     */
    public function getAll($where = array(), $order_by = array(), $num = null)
    {
        if (empty($this->_table_obj)) {
            return false;
        }

        $this->sqlFiled($this->_read_db_obj);

        $this->_read_db_obj->from($this->_table_obj);

        if ($where) {
            //查询条件组成
            $this->sqlWhere($where);
        }
        if ($order_by) {
            //排序条件组成
            $this->sqlOrder($order_by);
        }

        if ($num > 0) {
            $this->_read_db_obj->limit($num);
        }

        $query = $this->_read_db_obj->get();

        //echo $this->_read_db_obj->last_query();

        $ret = $query->result_array();

        //设置最后执行sql
        $this->_last_sql = $this->_read_db_obj->last_query();

        //记录数据库操作日志
        $this->sqlLog();

        return $ret;
    }

    /**
     * 列表读取
     *
     * @param array $where
     * @param array $order_by
     * @param array $group_by
     * @param int $page
     * @param int $page_list
     * @return mixed
     */
    public function getList($page = 1, $page_list = 10, $where = array(), $order_by = array(), $group_by = array())
    {
        if (empty($this->_table_obj)) {
            return false;
        }

        $this->sqlFiled($this->_read_db_obj);

        $this->_read_db_obj->from($this->_table_obj);

        if ($where) {
            //查询条件组成
            $this->sqlWhere($where);
        }
        if ($order_by) {
            //排序条件组成
            $this->sqlOrder($order_by);
        }
        if ($group_by) {
            //分组条件组成
            $this->sqlGroup($group_by);
        }

        $page               = $page > 0 ? (int)$page : 1;
        $page_list          = $page_list ? (int)$page_list : 10;
        $limit              = ($page - 1) * $page_list;

        $this->_read_db_obj->limit($page_list, $limit);

        $query = $this->_read_db_obj->get();

        $ret = $query->result_array();

        //设置最后执行sql
        $this->_last_sql = $this->_read_db_obj->last_query();

        //记录数据库操作日志
        $this->sqlLog();

        $this->_read_db_obj->close();

        return $ret;
    }

    /**
     * 分页读取
     *
     * @param array $where
     * @param array $order_by
     * @param array $group_by
     * @param int $page
     * @param int $page_list
     * @return array
     */
    public function getPage($page = 1, $page_list = 10, $where = array(), $order_by = array(), $group_by = array())
    {
        $data = array();

        $data['count']      = (int)$this->counts($where);

        $total_page = $data['count'] > 0 ? ceil($data['count']/$page_list) : 0;

        if($total_page < $page){
            $page = $total_page;
        }

        $data['list']       = $this->getList($page, $page_list, $where, $order_by, $group_by);
        $data['total_page'] = (int)$total_page;
        $data['page']       = (int)$page;
        $data['page_list']  = (int)$page_list;

        return $data;
    }

    /**
     * 查询条件组成
     *
     * @param array $where
     *               face is null
     *               array (
     *                     'where'  array('id' => 1, 'status' => 2)
     *                      ...
     *                     'like'   array('title' => 'xy苹果助手')
     *               )
     * @param string $obj_db
     * @return bool
     */
    public function sqlWhere($where = null, $obj_db = 'read')
    {
        if ($where == null) {
            return false;
        }

        $db = $obj_db == 'read' ? $this->_read_db_obj : $this->_write_db_obj;

        if (is_array($where)) {
            foreach ((array)$where as $k => $v) {
                $case_k = strtolower($k);
                switch ($case_k) {
                    case 'where':
                    case 'or_where':
                    case 'where_in':
                    case 'or_where_in':
                    case 'where_not_in':
                    case 'or_where_not_in':
                    case 'like':
                    case 'not_like':
                    case 'or_like':
                    case 'or_not_like':
                        foreach ((array)$v as $vk => $vv) {
                            $db->{$case_k}($vk, $vv);
                        }
                        break;
                    default://一维数组形式直接组成sql查询条件 && group 查询条件组成
                        if(strpos($case_k, 'group') === false){
                            $db->where($k, $v);
                        }else{
                            $this->sqlGroupWhere($v, $obj_db, $case_k);
                        }
                        break;
                }
            }
        } else {
            // where filed is null
            $db->where($where);
        }
    }

    /**
     * group查询条件组成
     *
     * @param array $where
     *               face is null
     *               array (
     *                     'group' => array('where' => array('id' => 1, 'status' => 2))
     *                      ...
     *                     'or_group' => array('like' => array('title' => 'xy苹果助手'))
     *               )
     * @param string $obj_db
     * @param string $group_type
     * @return bool
     */
    public function sqlGroupWhere($where = null, $obj_db = 'read', $group_type = 'group')
    {
        if ($where == null) {
            return false;
        }

        $db = $obj_db == 'read' ? $this->_read_db_obj : $this->_write_db_obj;

        switch ($group_type) {
            case 'group':
                $db->group_start();

                $this->sqlWhere($where, $obj_db);

                $db->group_end();
                break;
            case 'or_group':// or
                $db->or_group_start();

                $this->sqlWhere($where, $obj_db);

                $db->group_end();
                break;
            case 'not_group_start':// not
                $db->not_group_start();

                $this->sqlWhere($where, $obj_db);

                $db->group_end();
                break;
            case 'or_not_group_start':// or not
                $db->or_not_group_start();

                $this->sqlWhere($where, $obj_db);

                $db->group_end();
                break;
            default:
                $db->group_start();

                $this->sqlWhere($where, $obj_db);

                $db->group_end();
                break;
        }
    }

    /**
     * 排序条件组成
     *
     * @param null $order
     *              id
     *              array(
     *                  'id' => 'desc',
     *                  'title' => 'asc'
     *                  'add_time'  => 'asc'
     *              )
     * @param string $obj_db
     * @return bool
     */
    public function sqlOrder($order = null, $obj_db = 'read')
    {
        if ($order == null) {
            return false;
        }

        $db = $obj_db == 'read' ? $this->_read_db_obj : $this->_write_db_obj;

        if (is_array($order)) {
            foreach ((array)$order as $k => $v) {
                $db->order_by($k, $v);
            }
        } else {
            $db->order_by($order);
        }
    }

    /**
     * 分组条件组成
     *
     * @param null $group
     *              id
     *              array(
     *                  'id',
     *                  'title',
     *                  'add_time',
     *              )
     * @param string $obj_db
     * @return bool
     */
    public function sqlGroup($group = null, $obj_db = 'read')
    {
        if ($group == null) {
            return false;
        }
        $db = $obj_db == 'read' ? $this->_read_db_obj : $this->_write_db_obj;

        $db->group_by($group);
    }

    /**
     * 习惯设置字段内容条件组成
     *
     * @param array $set
     *              array('title' => 'xx')
     *              array(1 => array('field' => 'num','type' =>'+', 'val' => 1 )) num = num+1
     * @param string $obj_db
     * @return bool
     */
    public function sqlSet($set = array(), $obj_db = 'read')
    {
        if (!is_array($set) || empty($set)) {
            return false;
        }

        $db = $obj_db == 'read' ? $this->_read_db_obj : $this->_write_db_obj;

        foreach (($set) as $k => $v) {
            if (is_array($v)) {
                if ($v['type']) {
                    $db->set($v['field'], $v['field'] . $v['type'] . $v['val']);
                } else {
                    $db->set($v['field'], $v['val']);
                }
            } else {
                $db->set($k, $v);
            }
        }
    }

    /**
     * 复制查询字段
     *
     * @param string $field
     */
    public function setSqlFiled($field = '*'){
        if($field != '*'){
            $field = explode(',' , $field);
            foreach((array)$field as $k => $v){
                $field[$k] = trim($v);
            }
            $field = '`'.implode('`,`', $field).'`';
        }

        $this->_filed = $field;
    }

    /**
     * 设置查询字段
     *
     * @param string $obj_db
     * @return bool
     */
    public function sqlFiled($obj_db = null){
        $field = $this->_filed;

        if (empty($field) || empty($obj_db)) {
            return false;
        }


        if($field == '*'){
            return true;
        }

        if(is_array($field)){
            $field = explode(',', $field);
        }

        $obj_db->select($field, false);
    }

    public function setOpenSqlLog($status = true){
        $this->_open_log = $status;

        return true;
    }

    public function getOpenSqlLog(){
        return $this->_open_log;
    }

    /**
     * 数据库操作记录
     */
    public function sqlLog()
    {
        if($this->_open_log){
            $content = ($this->_table_obj ? $this->_table_obj . ':' : null).$this->_last_sql;
            return log_db($content);
        }
    }

    /**
     * 设置 sql
     *
     * @param $sql
     */
    public function setLastSql($sql)
    {
        $this->_last_sql = $sql;
    }

    /**
     * 获取 sql
     *
     * @return mixed
     */
    public function getLastSql()
    {
        return $this->_last_sql;
    }
}
