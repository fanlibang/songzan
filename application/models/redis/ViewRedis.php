<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2017/03/08
 * Time: 15:00
 */
namespace Xy\Application\Models\Redis;

class ViewRedis extends BaseRedis
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_redis_obj     = $this->container['view'];
    }

    public function getPdcView($key, $arr) {
        $res = $this->_redis_obj->hMget($key, $arr);
        return $res;
    }

    public function addPdcView($key, $arr) {
        $ttl = 8 * 3600;
        $res = $this->_redis_obj->hMset($key, $arr, $ttl);
        return $res;
    }

    public function delPdcView($key) {
        $res = $this->_redis_obj->delete($key);
        return $res;
    }

    public function ExistPdcView($key, $arr) {
        $res = $this->_redis_obj->hExists($key, $arr);
        return $res;
    }

    public function ExistPdcKey($key) {
        $res = $this->_redis_obj->exists($key);
        return $res;
    }

    public function delAllHKeys($key) {
        $res = $this->_redis_obj->hDel($key);
        return $res;
    }
}
