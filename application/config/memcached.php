<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Memcached settings
| -------------------------------------------------------------------------
| Your Memcached servers can be specified below.
|
|	See: http://codeigniter.com/user_guide/libraries/caching.html#memcached
|
*/
$config = array();

switch(XY_ENVIRONMENT){
	case 'production':
		$config['default'] = array(
			'host'       => '192.168.11.6',
			'port'       => 11211,
			'weight'     => '1',
		);
		break;
	case 'develop':
	case 'testing':
		$config['default'] = array(
			'host'       => '192.168.78.26',
			'port'       => 11211,
			'weight'     => '1',
		);
		break;

	case 'local':
		$config['default'] = array(
			'host'       => '127.0.0.1',
			'port'       => 11211,
			'weight'     => '1',
		);
		break;
}

/**
 * key 名字以 _MEM_KEY 开头 便于理解查找
 */
define('_MEM_KEY_SIGN_LOCK_', 'sign_lock:');//签名请求接口锁 key