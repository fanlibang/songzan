<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 3.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Redis Caching Class
 *
 * @package	   CodeIgniter
 * @subpackage Libraries
 * @category   Core
 * @author	   Anton Lindqvist <anton@qvister.se>
 * @link
 */
class CI_Cache_redis extends CI_Driver
{
	/**
	 * Default config
	 *
	 * @static
	 * @var	array
	 */
	protected static $_default_config = array(
		'socket_type' => 'tcp',
		'host' => '127.0.0.1',
		'password' => NULL,
		'port' => 6379,
		'timeout' => 0
	);

	/**
	 * Redis connection
	 *
	 * @var	Redis
	 */
	protected $_redis;

	/**
	 * An internal cache for storing keys of serialized values.
	 *
	 * @var	array
	 */
	protected $_serialized = array();

	// ------------------------------------------------------------------------

	/**
	 * Get cache
	 *
	 * @param	string	Cache ID
	 * @return	mixed
	 */
	public function get($key)
	{
		$value = $this->_redis->get($key);

		if ($value !== FALSE && isset($this->_serialized[$key]))
		{
			return unserialize($value);
		}

		return $value;
	}

	// ------------------------------------------------------------------------

	/**
	 * Save cache
	 *
	 * @param	string	$id	Cache ID
	 * @param	mixed	$data	Data to save
	 * @param	int	$ttl	Time to live in seconds
	 * @param	bool	$raw	Whether to store the raw value (unused)
	 * @return	bool	TRUE on success, FALSE on failure
	 */
	public function save($id, $data, $ttl = 60, $raw = FALSE)
	{
		if (is_array($data) OR is_object($data))
		{
			if ( ! $this->_redis->sIsMember('_ci_redis_serialized', $id) && ! $this->_redis->sAdd('_ci_redis_serialized', $id))
			{
				return FALSE;
			}

			isset($this->_serialized[$id]) OR $this->_serialized[$id] = TRUE;
			$data = serialize($data);
		}
		elseif (isset($this->_serialized[$id]))
		{
			$this->_serialized[$id] = NULL;
			$this->_redis->sRemove('_ci_redis_serialized', $id);
		}

		return ($ttl)
			? $this->_redis->setex($id, $ttl, $data)
			: $this->_redis->set($id, $data);
	}

	// ------------------------------------------------------------------------

	/**
	 * Delete from cache
	 *
	 * @param	string	Cache key
	 * @return	bool
	 */
	public function delete($key)
	{
		if ($this->_redis->delete($key) !== 1)
		{
			return FALSE;
		}

		if (isset($this->_serialized[$key]))
		{
			$this->_serialized[$key] = NULL;
			$this->_redis->sRemove('_ci_redis_serialized', $key);
		}

		return TRUE;
	}

    // ------------------------------------------------------------------------

    /**
     * 设置队列列表
     *
     * @param $id
     * @param $value
     * @return int
     */
    public function lPush($id, $value)
    {
        return $this->_redis->lPush($id, $value);
    }

    // ------------------------------------------------------------------------

    /**
     * 发布
     *
     * @param $id
     * @param $value
     * @return int
     */
    public function publish($id, $value)
    {
        return $this->_redis->publish($id, $value);
    }

    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------

    /**
     * 获取队列列表
     *
     * @param $id
     * @return int
     */
    public function lPop($id)
    {
        return $this->_redis->lPop($id);
    }

    // ------------------------------------------------------------------------

    /**
     * 获取队列列表长度
     *
     * @param $id
     * @return int
     */
    public function lLen($id)
    {
        return $this->_redis->lLen($id);
    }

	// ------------------------------------------------------------------------

	/**
	 * hMset
	 *
	 * @param $key
	 * @param $val
	 * @return bool
	 */
	public function hMset($key, $val){
		return $this->_redis->hMset($key, $val);
	}

	// ------------------------------------------------------------------------

	/**
	 * hMget
	 *
	 * @param $key
	 * @param $keys
	 * @return bool
	 */
	public function hMget($key, $keys){
		return $this->_redis->hMGet($key, $keys);
	}
	
	
	
	/**
	 * hGetAll
	 *
	 * @param $key
	 * @return bool
	 */
	public function hGetAll($key){
		return $this->_redis->hGetAll($key);
	}
	
	/**
	 * hGetAll
	 *
	 * @param $key
	 * @param $arr
	 * @return bool
	 */
	public function hExists($key, $arr){
		return $this->_redis->hExists($key, $arr);
	}
	
	
	/**
	 * hDel
	 *
	 * @param $key
	 * @param $keys
	 * @return bool
	 */
	public function hDel($key, $keys){
		return $this->_redis->hDel($key, $keys);
	}
	
	// ------------------------------------------------------------------------

	/**
	 * Increment a raw value
	 *
	 * @param	string	$id	Cache ID
	 * @param	int	$offset	Step/value to add
	 * @return	mixed	New value on success or FALSE on failure
	 */
	public function increment($id, $offset = 1)
	{
		return $this->_redis->incr($id, $offset);
	}

	public function sAdd($params)
	{
		return call_user_func_array([$this->_redis, 'sAdd'], $params);
	}

	// ------------------------------------------------------------------------

	/**
	 * Decrement a raw value
	 *
	 * @param	string	$id	Cache ID
	 * @param	int	$offset	Step/value to reduce by
	 * @return	mixed	New value on success or FALSE on failure
	 */
	public function decrement($id, $offset = 1)
	{
		return $this->_redis->decr($id, $offset);
	}

	// ------------------------------------------------------------------------

	/**
	 * Clean cache
	 *
	 * @return	bool
	 * @see		Redis::flushDB()
	 */
	public function clean()
	{
		return $this->_redis->flushDB();
	}

	// ------------------------------------------------------------------------

	/**
	 * Get cache driver info
	 *
	 * @param	string	Not supported in Redis.
	 *			Only included in order to offer a
	 *			consistent cache API.
	 * @return	array
	 * @see		Redis::info()
	 */
	public function cache_info($type = NULL)
	{
		return $this->_redis->info();
	}

	// ------------------------------------------------------------------------

	/**
	 * Get cache metadata
	 *
	 * @param	string	Cache key
	 * @return	array
	 */
	public function get_metadata($key)
	{
		$value = $this->get($key);

		if ($value)
		{
			return array(
				'expire' => time() + $this->_redis->ttl($key),
				'data' => $value
			);
		}

		return FALSE;
	}

	/**
	 * 检查key是否存在
	 *
	 * @param $key
	 * @return bool
	 */
	public function exists($key){
		return $this->_redis->exists($key);
	}

	// ------------------------------------------------------------------------

	/**
	 * Check if Redis driver is supported
	 *
	 * @return	bool
	 */
	public function is_supported($config = null)
	{
		if ( ! extension_loaded('redis'))
		{
			log_message('debug', 'The Redis extension must be loaded to use Redis cache.');
			return FALSE;
		}

		if($config){
			return $this->setup_redis($config);
		}else{
			return $this->_setup_redis();
		}

	}

	// ------------------------------------------------------------------------

	/**
	 * Setup Redis config and connection
	 *
	 * Loads Redis config file if present. Will halt execution
	 * if a Redis connection can't be established.
	 *
	 * @return	bool
	 * @see		Redis::connect()
	 */
	protected function _setup_redis()
	{
		$config = array();
		$CI =& get_instance();

		if ($CI->config->load('redis', TRUE, TRUE))
		{
			$config += $CI->config->item('redis');
		}

		$config = array_merge(self::$_default_config, $config);

		$this->_redis = new Redis();

		try
		{
			if ($config['socket_type'] === 'unix')
			{
				$success = $this->_redis->connect($config['socket']);
			}
			else // tcp socket
			{
				$success = $this->_redis->connect($config['host'], $config['port'], $config['timeout']);
			}

			if ( ! $success)
			{
				log_message('debug', 'Cache: Redis connection refused. Check the config.');
				return FALSE;
			}
		}
		catch (RedisException $e)
		{
			log_message('debug', 'Cache: Redis connection refused ('.$e->getMessage().')');
			return FALSE;
		}

		if (isset($config['password']))
		{
			$this->_redis->auth($config['password']);
		}

		// Initialize the index of serialized values.
		$serialized = $this->_redis->sMembers('_ci_redis_serialized');
		if ( ! empty($serialized))
		{
			$this->_serialized = array_flip($serialized);
		}

		return TRUE;
	}

	 protected function setup_redis($config = null)
	{
		$this->_redis = new Redis();

		try
		{
			if (isset($config['socket_type']) && $config['socket_type'] === 'unix')
			{
				$success = $this->_redis->connect($config['socket']);
			}
			else // tcp socket
			{
				$success = $this->_redis->connect($config['host'], $config['port'], $config['timeout']);
			}

			if ( ! $success)
			{
				log_message('debug', 'Cache: Redis connection refused. Check the config.');
				return FALSE;
			}
		}
		catch (RedisException $e)
		{
			log_message('debug', 'Cache: Redis connection refused ('.$e->getMessage().')');
			return FALSE;
		}

		if (isset($config['password']))
		{
			$this->_redis->auth($config['password']);
		}

		// Initialize the index of serialized values.
		$serialized = $this->_redis->sMembers('_ci_redis_serialized');
		if ( ! empty($serialized))
		{
			$this->_serialized = array_flip($serialized);
		}

		return $this;
	}


	// ------------------------------------------------------------------------

	/**
	 * Class destructor
	 *
	 * Closes the connection to Redis if present.
	 *
	 * @return	void
	 */
	public function __destruct()
	{
		if ($this->_redis)
		{
			$this->_redis->close();
		}
	}

}
