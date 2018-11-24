<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2017/02/13
 * Time: 14:34
 */
namespace Xy\Application\Models\Redis;

class MjChannelRedis1 extends BaseRedis
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_redis_obj     = $this->container['default_mj'];
    }
}
