<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: Date: 2016/5/31
 * Time: 15:43
 */
namespace Xy\Application\Models\Memcached;

use Pimple;

require_once BASEPATH . '/core/Model.php';

class BaseMemcache extends \CI_Model
{
    # 初始化 container 容器
    protected $container;

    public $_memcached_obj;

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();

        if (empty(self::$container)) $this->instanceServer();

        $this->_memcached_obj     = $this->container['default'];
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
        $this->setProperty('default' ,function()use ($self){
            return $self->getMemcachedServer('default');
        });
    }

    /**
     * 实例 memcached 服务
     *
     * @param string $name
     */
    public function getMemcachedServer($name = 'default') {

        if ($this->config->load('memcached', true, true)) {
            $config = $this->config->item('memcached');

            if($config[$name]){
                $this->load->driver('cache',  array('adapter' => 'memcached'));
                $this->cache->memcached->is_supported($config[$name]);

                return $this->cache->memcached;
            }else{
                log_message('debug', 'Cache: Memcached connection refused. No such name for Memcached Server . Check the config.');
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
        $ret = $this->_memcached_obj->save($key, $val, $ttl);

        return $ret;
    }

    /**
     * 设置值 去重设置(常用于加锁设置/检测)
     *
     * @param $key
     * @param $val
     * @param $ttl
     * @return mixed
     */
    public function set($key, $val, $ttl = 5)
    {
        $ret = $this->_memcached_obj->add($key, $val, $ttl);

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
        return $this->_memcached_obj->get($key);
    }

    /**
     * 删除值
     *
     * @param $key
     * @return mixed
     */
    public function delete($key)
    {
        return $this->_memcached_obj->delete($key);
    }

    /**
     * 自增
     *
     * @param $id
     * @param int $offset
     * @return mixed
     */
    public function increment($id, $offset = 1){
        return $this->_memcached_obj->increment($id, $offset);
    }

    /**
     * 自减
     *
     * @param $id
     * @param int $offset
     * @return mixed
     */
    public function decrement($id, $offset = 1){
        return $this->_memcached_obj->decrement($id, $offset);
    }

    /**
     * 检查key信息
     *
     * @param $key
     * @return mixed
     */
    public function get_metadata($key){
        return $this->_memcached_obj->get_metadata($key);
    }

}
