<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Redis settings
| -------------------------------------------------------------------------
| Your Redis servers can be specified below.
|
|	See: https://codeigniter.com/user_guide/libraries/caching.html#redis-caching
|
*/
$config = array();

switch(XY_ENVIRONMENT){
	case 'production':
		$config['default'] = array(
			'socket_type' => 'tcp',
			'host'        => '192.168.11.111',
			'port'        => 6379,
			'timeout'     => 0,
		);
		break;
	case 'testing':
		$config['default'] = array(
			'socket_type' => 'tcp',
			'host'        => '192.168.78.26',
			'port'        => 6379,
			'timeout'     => 0,
		);
		break;
	case 'local':
		$config['default'] = array(
			'socket_type' => 'tcp',
			'host'        => '192.168.78.87',
			'port'        => 6379,
			'timeout'     => 0,
		);
		break;
}

/**
 * key 名字以 _REDIS_KEY 开头 便于理解查找
 */
define('_KEY_REDIS_PDC_VIEW' , 	    'pdc:view:');