<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2016/5/31
 * Time: 15:43
 */
namespace Xy\Application\Models;

class BaseModel
{
    public $_db_obj;
    public $_redis_obj;
    public $_memcached_obj;

    public $cache_type = 'memcached';

    /**
     * 初始化
     */
    public function __construct()
    {

    }

    /********************db 公共操作 start********************/
    /**
     *  * 执行说起来语句方法
     * @param null $sql
     * @param null $address
     * @return mixed
     */
    public function execute($sql = null, $address = null)
    {
        if(empty($address)) {
            $info = $this->_db_obj->execute($sql);
            return $info;
        } else {
            if($address < 10) {
                $url = CONNECT_ZS_URL;
            } elseif($address < 20) {
                $url = CONNECT_BJ_URL;
            } elseif($address < 30) {
                $url = CONNECT_TX46_URL;
            } elseif($address < 40) {
                $url = CONNECT_TX45_URL;
            }
            $postString = array(
                'sql' => $sql,
                'id' => $address
            );

            $data = json_decode(curl_request($url, $postString, 'post', 0, 30, 30),true);
            
            if($data['code'] == 200) {
                $info = $data['data'];
            } else {
                $info = array();
            }
            return $info;
        }

    }

    /**
     * 执行sql语句方法添加缓存
     *
     * @param null $sql
     * @param $key
     * @return bool
     */
    public function ViewExecute($sql = null, $key)
    {
        //页面缓存操作
        $this->_redis_obj = new \Xy\Application\Models\Redis\ViewRedis();
        $key = _KEY_REDIS_PDC_VIEW.$key;
        $res =  $this->_redis_obj->ExistPdcView($key, $sql);
        if($res) {
            $arr=array($sql);
            $info =  $this->_redis_obj->getPdcView($key, $arr);
            $info = json_decode($info[$sql], true);
        } else {
            $info = $this->_db_obj->execute($sql);
            $data = json_encode($info);
            $arr=array($sql => $data);
            $this->_redis_obj->addPdcView($key, $arr);
        }
        return $info;
    }

    public function descTable()
    {
        return $this->_db_obj->descTable();
    }

    /**
     * 添加数据
     *
     * @param array $data
     * @return array|bool|string
     */
    public function add($data = array())
    {
        return $this->_db_obj->add($data);
    }

    /**
     * 批量添加数据
     *
     * @param array $data
     * @return bool
     */
    public function addBatch($data = array())
    {
        return $this->_db_obj->addBatch($data);
    }

    /**
     * 单表检查后插入数据
     *
     * @param array $data
     * @param array $where
     * @return array|bool|string
     */
    public function checkAdd($data = array(), $where = array(), $is_update = false){
        return $this->_db_obj->checkAdd($data, $where, $is_update);
    }
    /**
     * 删除数据
     *
     * @param array $where
     * @return bool|int
     */
    public function del($where = array())
    {
        return $this->_db_obj->del($where);
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
        return $this->_db_obj->edit($data, $where);
    }

    /**
     * 计数
     *
     * @param array $where
     * @return mixed
     */
    public function counts($where = array())
    {
        return $this->_db_obj->counts($where);
    }

    /**
     * 求和
     *
     * @param array  $where
     * @param string $filed
     * @return mixed
     */
    public function sum($filed = "" ,$where = array())
    {
        return $this->_db_obj->sum($filed,$where);
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
        return $this->_db_obj->getOne($where, $order_by);
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
        return $this->_db_obj->getAll($where, $order_by, $num);
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
        return $this->_db_obj->getList($page, $page_list, $where, $order_by, $group_by);
    }

    /**
     * 分页读取
     *
     * @param array $where
     * @param array $order_by
     * @param array $group_by
     * @param int $page
     * @param int $page_list
     * @return mixed
     */
    public function getPage($page = 1, $page_list = 10, $where = array(), $order_by = array(), $group_by = array())
    {
        return $this->_db_obj->getPage($page, $page_list, $where, $order_by, $group_by);
    }

    /**
     * 设置查询字段
     *
     * @param string $field
     * @return mixed
     */
    public function setSqlFiled($field = '*'){
        return $this->_db_obj->setSqlFiled($field);
    }

    /**
     * 设置是否开启日志
     *
     * @param bool|true $status
     * @return mixed
     */
    public function setOpenSqlLog($status = true){
        return $this->_db_obj->setOpenSqlLog($status);
    }
    /********************db 公共操作 end********************/

    /********************memcached && redis 公共操作 start********************/
    /**
     * 设置查询 cache 的类型
     *
     * @param string $type
     */
    public function setCacheType($type = 'memcached'){
        $this->cache_type = $type;
    }

    /**
     * 缓存数据
     *
     * @param null $key
     * @param null $val
     * @param int $ttl
     * @return bool
     */
    public function save($key = null, $val = null, $ttl= 0){
        if(empty($key) || empty($val)){
            return false;
        }

        $flag = is_array($val) ? true : false;
        if($this->cache_type == 'memcached'){
            $val = is_array($val) ? serialize($val) : $val;

            $ret = $this->_memcached_obj->set($key, $val, $ttl);

            if($ret){
                return $flag ? unserialize($val) : $val;
            }else{
                return false;
            }
        }else{
            $val = is_array($val) ? json_encode($val) : $val;

            $ret = $this->_redis_obj->save($key, $val, $ttl);

            if($ret){
                return $flag ? json_decode($val, true) : $val;
            }else{
                return false;
            }
        }

        return false;
    }

    /**
     * 设置缓存 （加锁常用） redis 不适用该方法
     *
     * @param null $key
     * @param int $val
     * @param int $ttl
     * @return bool
     */
    public function set($key = null, $val = 1, $ttl = 3){
        if(empty($key)){
            return false;
        }

        $flag = is_array($val) ? true : false;

        if($this->cache_type == 'memcached'){
            $val = is_array($val) ? serialize($val) : $val;

            $ret = $this->_memcached_obj->set($key, $val, $ttl);

            if($ret){
                return $flag ? unserialize($val) : $val;
            }else{
                return false;
            }
        }

        return false;
    }

    /**
     * 获取缓存数据
     *
     * @param $key
     * @return mixed
     */
    public function get($key){
        if($this->cache_type == 'memcached'){
            $ret = $this->_memcached_obj->get($key);

            return $ret;
        }else{
            $ret = $this->_redis_obj->get($key);

            return $ret;
        }

        return false;
    }

    /**
     * 删除 key
     *
     * @param $key
     * @return bool
     */
    public function delete($key){
        if($this->cache_type == 'memcached'){
            $ret = $this->_memcached_obj->delete($key);

            return $ret;
        }else{
            $ret = $this->_redis_obj->delete($key);

            return $ret;
        }

        return false;
    }

    /**
     * 检查key信息
     *
     * @param $key
     * @return mixed
     */
    public function get_metadata($key){
        if($this->cache_type == 'memcached'){
            $ret = $this->_memcached_obj->get_metadata($key);

            return $ret;
        }else{
            $ret = $this->_redis_obj->get_metadata($key);

            return $ret;
        }

        return false;
    }

    /**
     *设置队列列表
     *
     * @param $id
     * @param $value
     * @return bool
     */
    public function lPush($id, $value){
        if($this->cache_type == 'memcached'){

        }else{
            $ret = $this->_redis_obj->lPush($id, $value);

            return $ret;
        }

        return false;
    }

    /**
     *设置队列列表
     *
     * @param $id
     * @param $value
     * @return bool
     */
    public function publish($id, $value){
        if($this->cache_type == 'memcached'){

        }else{
            $ret = $this->_redis_obj->publish($id, $value);
            return $ret;
        }

        return false;
    }

    /**
     * 获取队列列表长度
     *
     * @param $id
     * @return int
     */
    public function lLen($id){
        if($this->cache_type == 'memcached'){

        }else{
            $ret = $this->_redis_obj->lLen($id);

            return $ret;
        }

        return false;
    }

    /**
     * 自增长
     *
     * @param $id
     * @param int $offset
     * @return bool
     */
    public function increment($id, $offset = 1)
    {
        if($this->cache_type == 'memcached'){

        }else{
            $ret = $this->_redis_obj->increment($id, $offset);

            return $ret;
        }

        return false;
    }

    /**
     * 自减
     *
     * @param $id
     * @param int $offset
     * @return bool
     */
    public function decrement($id, $offset = 1)
    {
        if($this->cache_type == 'memcached'){

        }else{
            $ret = $this->_redis_obj->decrement($id, $offset);

            return $ret;
        }

        return false;
    }

    /**
     * 检查key是否存在  redis 常用  memcached 不适用该方法
     *
     * @param $key
     * @return mixed
     */
    public function exists($key){
        if($this->cache_type == 'redis'){
            $ret = $this->_redis_obj->exists($key);

            return $ret;
        }

        return false;
    }
    /********************memcached 公共操作 end********************/
}
