<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: Date: 2016/5/31
 * Time: 15:43
 */
namespace Xy\Application\Models\Redis;

use Pimple;

require_once BASEPATH . '/core/Model.php';

class BaseRedis extends \CI_Model
{
    # 初始化 container 容器
    protected $container;

    public $_redis_obj;

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();

        if (empty(self::$container)) $this->instanceServer();

        $this->_redis_obj     = $this->container['default'];
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
        $this->setProperty('default' ,function() use($self){
            return $self->getRedisServer('default');
        });

        $this->setProperty('mj' ,function() use($self){
            return $self->getRedisServer('mj');
        });

        $this->setProperty('view' ,function() use($self){
            return $self->getRedisServer('view');
        });
    }

    /**
     * 实例 redis 服务
     *
     * @param string $name
     */
    public function getRedisServer($name = 'default') {

        if ($this->config->load('redis', true, true)) {
            $config = $this->config->item('redis');

            if($config[$name]){
                $this->load->driver('cache', array('adapter' => 'redis'));
                $this->cache->redis->is_supported($config[$name]);

                return $this->cache->redis;
            }else{
                log_message('debug', 'Cache: Redis connection refused. No such name for Redis Server . Check the config.');
            }
        }
    }

    /**
     * 设置值
     *
     * @param $key
     * @param $val
     * @param $ttl
     * @return mixed
     */
    public function save($key, $val, $ttl = 0)
    {
        $ret = $this->_redis_obj->save($key, $val, $ttl);

        return $ret;
    }

    /**
     * 获取值
     *
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->_redis_obj->get($key);
    }

    /**
     * 删除值
     *
     * @param $key
     * @return mixed
     */
    public function delete($key)
    {
        return $this->_redis_obj->delete($key);
    }

    /**
     *设置队列列表
     *
     * @param $id
     * @param $value
     * @return bool
     */
    public function lPush($id, $value){
        $ret = $this->_redis_obj->lPush($id, $value);

        return $ret;
    }

    /**
     * 获取队列列表长度
     *
     * @param $id
     * @return int
     */
    public function lLen($id){
        $ret = $this->_redis_obj->lLen($id);

        return $ret;
    }

    /**
     * 自增
     *
     * @param $id
     * @param int $offset
     * @return mixed
     */
    public function increment($id, $offset = 1){
        return $this->_redis_obj->increment($id, $offset);
    }

    /**
     * 自减
     *
     * @param $id
     * @param int $offset
     * @return mixed
     */
    public function decrement($id, $offset = 1){
        return $this->_redis_obj->decrement($id, $offset);
    }

    /**
     * 验证key是否存在
     *
     * @param $key
     * @return mixed
     */
    public function exists($key){
        return $this->_redis_obj->exists($key);
    }

    /**
     * hMset 方法
     *
     * @param $key
     * @param $val
     * @return mixed
     */
    public function hMset($key, $val){
        return $this->_redis_obj->hMset($key, $val);
    }


    /**
     * hGetAll
     *
     * @param $key
     * @return bool
     */
    public function hGetAll($key){
        return $this->_redis_obj->hGetAll($key);
    }

    /**
     * hDel
     *
     * @param $key
     * @param $keys
     * @return bool
     */
    public function hDel($key, $keys){
        return $this->_redis_obj->hDel($key, $keys);
    }

    /**
     * sAdd 方法
     *
     * @param $params
     * @return mixed
     */
    public function sAdd($params){
        return $this->_redis_obj->sAdd($params);
    }

    /**
     * 检查key信息
     *
     * @param $key
     * @return mixed
     */
    public function get_metadata($key){
        return $this->_redis_obj->get_metadata($key);
    }

    /**
     * 检查key信息field是否存在
     *
     * @param $key
     * @param $arr
     */
    public function hExists($key, $arr){
        return $this->_redis_obj->hExists($key, $arr);
    }

    /**
     * 发布数据
     *
     * @param null $key
     * @param null $val
     * @return bool
     */
    public function publish($key = null, $val = null){
        return $ret = $this->_redis_obj->publish($key, $val);
    }
}
