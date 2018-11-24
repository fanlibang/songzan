<?php
defined('BASEPATH') or exit('No direct script access allowed');

function curls($url, $data_string) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-AjaxPro-Method:ShowList',
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($data_string))
    );
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function curl_put_request($url,$data,$method='post', $connectTimeout = 10, $readTimeout = 20){
    $timeout = $connectTimeout + $readTimeout;
    $ch = curl_init(); //初始化CURL句柄
    curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connectTimeout);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); //设置请求方式

    curl_setopt($ch,CURLOPT_HTTPHEADER,array(
        'X-HTTP-Method-Override: $method',
        'Content-Type: application/json; charset=utf-8',
        'Content-Length: ' . strlen($data)
    ));//设置HTTP头信息
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//设置提交的字符串
    $document = curl_exec($ch);//执行预定义的CURL
    /**
    if(!curl_errno($ch)){
        $info = curl_getinfo($ch);
        echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
    } else {
        echo 'Curl error: ' . curl_error($ch);
    }
     */
    curl_close($ch);

    return $document;
}

function Http($url,$params,$method = 'GET', $header = array(), $multi = false) {
    $ch = curl_init($url);
    curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 60);

    switch(strtoupper($method)) {
        case 'GET' :
            if(is_array($params)){
                $url_str = '';
                foreach((array)$params as $k => $v){
                    $url_str .= ($url_str ? '&' : '').$k .'='.$v;
                }
                $curl_opt = $url . "?" . $url_str;
            }else{
                $curl_opt = $url . (!empty($params) ? "?" . $params : '');
            }
            //$curl_opt = $url . '&' . http_build_query($params);
            curl_setopt ($ch, CURLOPT_URL, $curl_opt);
            break;
        case 'POST' :
            //判断是否传输文件
            if($params) {
                $params = $multi ? $params : http_build_query($params);
            }
            curl_setopt ($ch, CURLOPT_URL, $url);
            curl_setopt ($ch, CURLOPT_POST, 1);
            curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);
            break;
        case 'DELETE':
            curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            break;
        default :
            throw new Exception('不支持的请求方式！');
    }

    $data = curl_exec($ch);
    $error = curl_error($ch);
    if ($error)
        throw new Exception('请求发生错误：' . $error);
    return $data;
}


if (! function_exists('curl_request')) {
    /**
     * @param $url
     * @param $post_string
     * @param string $method
     * @param int $port
     * @param int $connectTimeout
     * @param int $readTimeout
     * @param null $errmsg
     * @return bool|mixed|string
     */
    function curl_request($url, $post_string = null, $method = "post", $port = 0, $connectTimeout = 1, $readTimeout = 2, &$errmsg = null)
    {
        $method = strtolower($method);

        if ($method == "get") {
            if(is_array($post_string)){
                $url_str = '';
                foreach((array)$post_string as $k => $v){
                    $url_str .= ($url_str ? '&' : '').$k .'='.$v;
                }
                $url = $url . "?" . $url_str;
            }else{
                $url = $url . (!empty($post_string) ? "?" . $post_string : '');
            }
        }

//        echo $url;

        $result = "";
        if (function_exists('curl_init')) {
            $timeout = $connectTimeout + $readTimeout;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            if ($port) {
                curl_setopt($ch, CURLOPT_PORT, $port);
            }

            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connectTimeout);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            //curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

            if ($method == "post") {
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
            }
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'API PHP5 Client (curl) ' . phpversion());
            $result = curl_exec($ch);
            if (!$result) {
                echo $errmsg = curl_error($ch);
            }
            curl_close($ch);
        } else {
            $result = false;
            $errmsg = "can not find function curl_init";
        }
        return $result;
    }
}

if (! function_exists('re_curl_request')) {
    /**
     * 请求重试
     *
     * @param $url
     * @param null $post_string
     * @param string $method
     * @param int $re_nums
     * @param int $port
     * @param int $connectTimeout
     * @param int $readTimeout
     * @param null $errmsg
     * @return array|string
     */
    function re_curl_request($url, $post_string = null, $method = "post", $re_nums = 3 , $port = 0, $connectTimeout = 1, $readTimeout = 2, &$errmsg = null)
    {
        $i = 0;

        $ret_arr    = array();

        while(1){

            if($i >= $re_nums){
                break;
            }

            $ret        = curl_request($url, $post_string, $method, $port, $connectTimeout, $readTimeout, $errmsg);
            $ret_arr    = json_encode($ret);

            if(empty($ret_arr) || !is_array($ret_arr)){
                $i++;
            }

        }

        return $ret_arr;
    }
}


if (! function_exists('mkdirs')) {
    /**
     * 创建文件夹
     *
     * @param $dir
     * @param int $mode
     * @return bool
     */
    function mkdirs($dir, $mode = 0777)
    {
        if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;

        if (!mkdirs(dirname($dir), $mode)) return FALSE;

        return @mkdir($dir, $mode);
    }
}

if (! function_exists('dir_files')) {
    /**
     * 取得输入目录所包含的所有文件
     *
     * @param $dir
     * @return array
     */
    function dir_files($dir)
    {
        if (is_file($dir)) {
            return array($dir);
        }
        $files = array();
        if (is_dir($dir) && ($dir_p = opendir($dir))) {
            $ds = DIRECTORY_SEPARATOR;
            while (($filename = readdir($dir_p)) !== false) {
                if ($filename == '.' || $filename == '..') {
                    continue;
                }
                $filetype = filetype($dir . $ds . $filename);
                if ($filetype == 'dir') {
                    $files = array_merge($files, get_dir_files($dir . $ds . $filename));
                } elseif ($filetype == 'file') {
                    $files[] = $dir . $ds . $filename;
                }
            }
            closedir($dir_p);
        }
        return $files;
    }
}
if (! function_exists('delete_config')) {
    /**
     * 删除配置信息方法
     *
     * @param null $file_name
     * @return mixed|string
     */
    function delete_config($file_name = null)
    {
        if ($file_name) {
            $file_name = 'config.' . $file_name;
        } else {
            return false;
        }

        if (file_exists(CONFIG_FILE_PATH . $file_name . '.php')) {
            return @unlink(CONFIG_FILE_PATH . $file_name . '.php');
        }
        return true;
    }
}

if (! function_exists('read_config')) {
    /**
     * 获取配置信息方法
     *
     * @param null $file_name
     * @return mixed|string
     */
    function read_config($file_name = null)
    {
        if ($file_name) {
            $file_name = 'config.' . $file_name;
        } else {
            return array();
        }

        if (file_exists(CONFIG_FILE_PATH . $file_name . '.php')) {
            $config = include CONFIG_FILE_PATH . $file_name . '.php';

            $config = ($config && is_array($config)) ? $config : array();

            return $config;
        }
        return array();
    }
}

if (! function_exists('write_config')) {
    /**
     * 设置配置信息方法
     *
     * @param null $file_name
     * @param null $content
     * @return bool
     */
    function write_config($file_name = null, $content = null)
    {
        if ($file_name == null) {
            return false;
        }

        $file_name = 'config.' . $file_name;

        $content = "<?php\ndefined('BASEPATH') OR exit('No direct script access allowed');\n\n return ".var_export($content, true).";\n";

        try {
            file_put_contents(CONFIG_FILE_PATH . $file_name . '.php', $content);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
if (! function_exists('make_config')) {
    /**
     * 合并配置信息
     *
     * @param $list
     * @param $index_arr
     * @param null $val
     * @return array|mixed
     */
    function merge_config($list, $index_arr, $val = null)
    {
        $config1 = make_config($index_arr, $val);

        $config = array_merge_multi($list, $config1);

        if ($val == null) {
            return array_remove_empty($config);
        }

        return $config;
    }
}

if (! function_exists('make_config')) {
    /**
     * 生成配置项
     *
     * @param $index_arr
     * @param null $val
     * @return array
     */
    function make_config($index_arr, $val = null)
    {
        $index_arr = array_reverse($index_arr);
        $new_arr = array();
        foreach ((array)$index_arr as $k => $v) {
            $temp = $new_arr;

            $new_arr = array();

            if ($temp) {
                $new_arr[$v] = $temp;
            } else {
                $new_arr = array($v => $val);
            }
        }

        return $new_arr;
    }
}

if (! function_exists('array_merge_multi')) {
    /**
     * 多维数组合并（支持多数组）
     * @return array
     */
    function array_merge_multi()
    {
        $args = func_get_args();
        $array = array();
        foreach ($args as $arg) {
            if (is_array($arg)) {
                foreach ($arg as $k => $v) {
                    if (is_array($v)) {
                        $array[$k] = isset($array[$k]) ? $array[$k] : array();
                        $array[$k] = array_merge_multi($array[$k], $v);
                    } else {
                        $array[$k] = $v;
                    }
                }
            }
        }
        return $array;
    }
}

if (! function_exists('array_remove_empty')) {
    /**
     * 去除数组中的空值
     *
     * @param $arr
     * @param bool|true $trim
     * @return mixed
     */
    function array_remove_empty(&$arr, $trim = true)
    {
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                array_remove_empty($arr[$key]);
            } else {
                $value = trim($value);
                if ($value == '') {
                    unset($arr[$key]);
                } elseif ($trim) {
                    $arr[$key] = $value;
                }
            }
        }

        return $arr;
    }
}


if (! function_exists('array_index_value')) {
    /**
     * 重组数组的结构(二维数组)
     *
     * @param $arr
     * @param null $find_index
     * @param null $value_index
     * @param null $operation
     * @return mixed|null|number
     */
    function array_index_value($arr, $find_index = null, $value_index = null, $operation = null)
    {
        $ret = null;
        $names = array_reduce($arr, create_function('$v,$w', '$v['.($find_index ? '$w['.$find_index.']' : '').']='.($value_index ? '$w['.$value_index.']' : '$w').';return $v;'));

        switch($operation){
            case 'sum':
                $ret = array_sum($names);
                break;
            default:
                $ret = $names;
                break;
        }
        return $ret;
    }
}

if (! function_exists('array_multi2single')) {
    /**
     * 多维数组转一维数组
     *
     * @param $array
     * @param null $flag_key
     * @param bool|false $is_unique
     * @param string $tree_flag
     * @return array|bool
     */
    function array_multi2single($array, $flag_key = null, $is_unique = false, $tree_flag = '└')
    {
        if (!isset($array)||!is_array($array)||empty($array)) {
            return false;
        }

        if (!in_array($is_unique, array('true', 'false', ''))) {
            return false;
        }

        static $result_array=array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result_array[$flag_key.($flag_key ? ':' : '').$key]='-';
                array_multi2single($value, $tree_flag.$flag_key.($flag_key ? ':' : '').$key);
            } else {
                $result_array[$flag_key.($flag_key ? ':' : '').$key]=$value;
            }
        }
        if ($is_unique) {
            $result_array=array_unique($result_array);
        }
        return $result_array;
    }
}

if (! function_exists('format_app_content')) {
    /**
     * 格式 应用 内容
     *
     * @param $content
     * @return string
     */
    function format_app_content($content)
    {
        $content = str_replace("</p>", "</br>", $content);
        $content = str_replace("<p>", "</br>", $content);
        $content = str_replace("</br>", "\n", $content);
        $content = str_replace("<br />", "\n", $content);
        return strip_tags($content);
    }
}

if (! function_exists('format_num_time')) {
    /**
     * 格式时间 - 数字格式化成日期
     *
     * @param $times
     * @param int $format
     * @return bool|string
     */
    function format_num_time($times, $format = 1){
        if(empty($times)){
            return '';
        }
        switch($format){
            case 1:
                $format = 'Y-m-d H:i:s';
                break;
            case 2:
                $format = 'Y-m-d';
                break;
            case 3:
                $format = 'H:i:s';
                break;
            default:
                $format = $format;
        }
        return date($format, $times);
    }
}

if (! function_exists('format_date_week')) {
    /**
     * 格式时间 为新的 周 （按照周五为周末技术）
     *
     * @param null $date
     * @param null $old_date
     * @return array
     */
    function format_date_week($date = null, $old_date = null)
    {
        $date = $date ? date('Ymd', strtotime($date)) : date('Ymd');

        $old_date = $old_date == null ? $date : $old_date;

        $first_week_num = date('w', strtotime(date('Y', strtotime($date)) . '0101'));

        $curr_day_nums = date('z', strtotime($date)) + 1;

        if ($first_week_num < 6) {
            if (($curr_day_nums - (6 - $first_week_num)) <= 0) {
                return formatDateWeek(date('Y', strtotime($date . ' -1 year')) . '1231', $date);
            } else {
                return array(
                    'old_date' => $old_date,
                    'year' => date('Y', strtotime($date)),
                    'week' => ceil(($curr_day_nums - 6 + $first_week_num) / 7)
                );
            }
        } else {
            return array(
                'old_date' => $old_date,
                'year' => date('Y', strtotime($date)),
                'week' => ceil($curr_day_nums / 7)
            );
        }
    }
}


if (! function_exists('filter_html')) {
    /**
     * 过虑HTML
     * @param  string $var
     * @return string
     */
    function filter_html($var)
    {
        $search = array(
            "'<script[^>]*?>.*?<\/script>'si",
            "'<html[^>]*?>.*?<body[^>]*?>'si",
            "'<\/body>.*?<\/html>'si",
            "'<style[^>]*?>.*?<\/style>'si",
            "'<link[^>]*?\s*[\/]?>'si",
            "'<iframe[^>]*?>.*?<\/iframe>'si",
            "'<form[^>]*?>(.*?)<\/form>'si",
            "'<textarea[^>]*?>.*?<\/textarea>'si",
            //"'\s*id\s*=\s*[\"|\'].*?[\"|\']'si",
            //"'\s* clas\s*s\s*=\s*[\"|\'].*?[\"|\']'si",
            //"'<!--.*?-->'si",
        );
        $replace = array('', '', '', '', '', '', '', '', '', '', '');
        $var = preg_replace($search, $replace, $var);
        $trans = array(
            '?' => '&#63;',
            '\\' => '&#92;',
            '`' => '',
        );
        return strtr($var, $trans);
    }
}

if (! function_exists('ip_filter')) {
    /**
     * ip/ip段验证过滤
     *
     * @param $ip
     * @param $ip_arr
     *                 array('123.12.*.*','22.18.10.*', '192.168.8.821')
     * @return int
     */
    function ip_filter($ip, $ip_arr)
    {
        $ipregexp = implode('|', str_replace(array('*', '.'), array('\d+', '\.'), $ip_arr));
        return preg_match("/^(" . $ipregexp . ")$/", $ip);
    }
}

if (! function_exists('log_info')) {
    /**
     * 获取iP信息   (用户客户端请求的真实ip)
     *
     * @param bool $is_ip2long
     * @param bool $is_server
     * @return int|string
     */
    function return_ip($is_ip2long = false, $is_server = false)
    {
        //返回服务端ip
        if ($is_server) {
            $ip = $_SERVER['SERVER_ADDR'];
            return $is_ip2long ? ip2long($ip) : $ip;
        }

        //返回客户端ip
        if (getenv('HTTP_CLIENT_IP'))
        {
            $ip = getenv('HTTP_CLIENT_IP');
        }
        else if (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        }
        else if (getenv('REMOTE_ADDR'))
        {
            $ip = getenv('REMOTE_ADDR');
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        if(!preg_match("#^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}#",$ip)){
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $ipArr = explode(',', $ip);

        return $is_ip2long ? ip2long($ipArr[0]) : $ipArr[0];
    }
}

if (! function_exists('log_info')) {
    /**
     * 日志信息
     *
     * @return array
     */
    function log_info()
    {
        $debug = debug_backtrace();

        $over_time = microtime(true);

        if (count($debug) > 1) {
            $debug = $debug[1];
        } else {
            $debug = $debug[0];
        }

        $user_id = '';
        $account = '';

        switch (strtolower(PROJECT_NAME)) {
            case 'admin':
                $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
                $account = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
                break;
            case 'dev':
                $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
                $account = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
                break;
        }

        $data = array(
            'project_name'  =>  PROJECT_NAME,
            'server_ip'     =>  return_ip(true, true),
            'ip'            =>  return_ip(true),
            'url'           =>  $_SERVER['REQUEST_URI'],
            'file'          =>  $debug['file'],
            'line'          =>  $debug['line'],
            'function'      =>  $debug['function'],
            'start_time'    =>  START_TIME_MICROS,
            'end_time'      =>  $over_time,
            'exec_time'     =>  $over_time - START_TIME_MICROS,
            'flag_id'       =>  $user_id,
            'flag_account'  =>  $account,
            'add_time'      =>  time()
        );

        return $data;
    }
}

if (! function_exists('assess_info')) {
    /**
     * 日志信息
     * @param $url
     * @return array|bool
     */
    function assess_info($url, $openId)
    {
        if($_SERVER['REQUEST_URI'] == '/dev/') {
            return false;
        } else {
            $data = array(
                'server_ip'     =>  return_ip(true, true),
                'ip'            =>  return_ip(true),
                'url'           =>  $url,
                'path'          =>  $_SERVER['REQUEST_URI'],
                'openId'       =>   $openId,
                'log_time'      =>  time()
            );
            return $data;
        }
    }
}

if (! function_exists('log_file')) {
    /**
     * 文件日志
     *
     * @param null $file
     * @param null $content
     * @return bool
     */
    function log_file($file = null, $content = null)
    {
        if (empty($file) || empty($content)) {
            return false;
        }
        $log_str = '';

        $log_arr = log_info();

        foreach ((array)$log_arr as $k => $v) {
            $log_str .= $k .':' . $v .',';
        }

        $content = is_string($content) ? $content : var_export($content, true);

        $log_str .= "content:".$content."\n";

        try {
            file_put_contents(LOG_PATH . $file . '.logs', $log_str, FILE_APPEND);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

if (! function_exists('log_db')) {
    /**
     * db  日志
     *
     * @param null $content
     * @return mixed
     */
    function log_db($content = null)
    {

    }
}


if (! function_exists('log_redis')) {
    /**
     * redis  日志
     *
     * @param null $content
     * @return mixed
     */
    function log_redis($content = null)
    {
        if (empty($content)) {
            return false;
        }

        $CI = &get_instance();

        $CI->load->model('OperationLogsModel', 'OperationLogs');

        $log_arr = log_info();

        $content = is_string($content) ? $content : var_export($content, true);

        $log_arr['content'] = $content;

        $log_arr = serialize($log_arr);

        return $CI->OperationLogs->addRedis($log_arr);
    }
}
if (! function_exists('code_run_time')) {
    /**
     * 代码执行时间
     *
     * @return array
     */
    function code_run_time()
    {
        $time = time();

        $microtime = microtime(true);

        return array(
            'stime' => START_TIME_TIMES,
            'etime' => $time,
            'rtime' => $time - START_TIME_TIMES,
            'smtime' => START_TIME_MICROS,
            'emtime' => $microtime,
            'rmtime' => $microtime - START_TIME_MICROS,
        );
    }
}

if (! function_exists('curr_domain')) {
    /**
     * 获取当前系统domain
     *
     * @return string
     */
    function curr_domain()
    {
        $host_str = (isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ''));

        $host_arr =  array_reverse(explode('.', $host_str));

        return $host_arr[1].'.'.$host_arr[0];
    }
}

if (! function_exists('site_url')) {
    /**
     * 拼接链接地址
     *
     * @param $controller
     * @param $action
     * @param $params
     * @return string
     */
    function site_url($controller = null, $action = null, $params = array())
    {
        $url_str = '';
        if(PROJECT_NAME == 'admin'){
            $url_str = '?v='.time();
        }

        $controller = $controller ? $controller : 'Index';
        $action     = $action ? $action : 'index';

        foreach ((array)$params as $k => $v) {
            $url_str .= ($url_str ? '&' : '?').$k.'='.$v;
        }
	 return 'http://'.$_SERVER['HTTP_HOST'] . '/2018/l462/ownerreferral/index.php/'.PROJECT_NAME.$controller.'/'.$action.$url_str;
    }
}

if (! function_exists('path_site_url')) {
    /**
     * 拼接链接地址
     *
     * @param $path
     * @param $params
     * @return string
     */
    function path_site_url($path = null, $params = array())
    {
        if ($path == null) {
            $path = 'Index/index';
        }

        $path_arr = explode('/', $path);

        $url_str = '';

        $controller = $path_arr[0] ? $path_arr[0] : 'Index';
        $action     = $path_arr[1] ? $path_arr[1] : 'index';

        foreach ((array)$params as $k => $v) {
            $url_str .= ($url_str ? '&' : '?').$k.'='.$v;
        }
	
	return 'http://'.$_SERVER['HTTP_HOST'] . '/2018/l462/songzan/index.php/'.PROJECT_NAME.$controller.'/'.$action.$url_str;
        //return 'http://'.$_SERVER['HTTP_HOST'] . '/'.PROJECT_NAME.'/'.$controller.'/'.$action.$url_str;
    }
}

if (! function_exists('is_ajax')) {
    /**
     * 判读是否是 Ajax 请求
     *
     * @param null $method
     * @return bool|string
     */
    function is_ajax($method = null)
    {
        if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')) {
            $request_method = strtolower($_SERVER['REQUEST_METHOD']);

            if ($method) {
                return $request_method == $method ? true : false;
            } else {
                return $request_method == 'post' ? 'post' : ($request_method == 'get' ? 'get' : false);
            }
        } else {
            return false;
        }
    }
}

if (! function_exists('is_ajax_post')) {
    /**
     * 判读是否是 Ajax 请求
     *
     * @return bool|string
     */
    function is_ajax_post()
    {
       return is_ajax('post');
    }
}

if (! function_exists('is_ajax_get')) {
    /**
     * 判读是否是 Ajax 请求
     *
     * @return bool|string
     */
    function is_ajax_get()
    {
        return is_ajax('get');
    }
}

if (! function_exists('redirect')) {
    /**
     * 跳转页面--重定向
     *
     * @param string $uri
     * @param string $method
     * @param int $http_response_code 301 永久跳转 302 暂时跳转
     */
    function redirect($uri = '/', $http_response_code = 302, $method = 'location')
    {
        switch ($method) {
            case 'refresh'    :
                header("Refresh:0;url=" . $uri);
                break;
            default            :
                header("Location: " . $uri, true, $http_response_code);
                break;
        }
        exit;
    }
}

if (! function_exists('is_url')) {
    /**
     * 验证url方法
     *
     * @param $url
     * @return int
     */
    function is_url($url)
    {
        $url = trim($url);

        if(filter_var ($url, FILTER_VALIDATE_URL )){
            return true;
        }else{
            return false;
        }

//        return preg_match('/^http[s]?:\/\/'.
//            '(([0-9]{1,3}\.){3}[0-9]{1,3}'. // IP形式的URL- 199.194.52.184
//            '|'. // 允许IP和DOMAIN（域名）
//            '([0-9a-z_!~*\'()-]+\.)*'. // 域名- www.
//            '([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.'. // 二级域名
//            '[a-z]{2,6})'.  // first level domain- .com or .museum
//            '(:[0-9]{1,4})?'.  // 端口- :80
//            '((\/\?)|'.  // a slash isn't required if there is no file name
//            '(\/[0-9a-zA-Z_!~\'\(\)\[\]\.;\?:@&=\+\$,%#-\/^\*\|]*)?)$/',
//            $url) == 1;

        //return preg_match('/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)/i', $url);
    }
}

if (! function_exists('dwz_rel')) {
    /**
     * admin dwz 后台rel 标识生成
     *
     * @param null $controller
     * @param string $method
     * @return bool|string
     */
    function dwz_rel($controller = null, $method = 'index')
    {
        if (empty($controller)) {
            return false;
        } else {
            return $controller.'/'. $method;
        }
    }
}

if (! function_exists('array_sort')) {
    /**
     * 对二维数组,按第二维数组中的某个键值对进行排序
     *
     * @param array $arr 二维数组如 array('0'=> array('v_title' => 'title2','v_image'=>'image2','v_sort'=>'sort2'),'1'=>array('v_title' => 'title1','v_image'=>'image1','v_sort'=>'sort1'))
     * @param string 二维数组中的某个键值对 如（v_sort）
     * @param int $sort_flags 排序方式 0:升序，1:降序
     * @return array 排序后的数二维数组
     * @date 2011-09-22
     * @ + 增加一个排序方式，
     */
    function array_sort($arr, $field, $sort_flags =0)
    {

        $sort_tmp =array();
        $arr_tmp  =array();
        foreach ($arr as $key=>$value) {
            if(is_array($value)) {
                $sort_tmp[$key]=$value[$field];//取出排列顺序字段
            }

        }
        asort($sort_tmp);//按值排序，保留键的对应,可校正排序相同的情况
        foreach ($sort_tmp as $k=>$v) {
            $arr_tmp[] = $arr[$k] ;
        }
        return $sort_flags ? array_reverse($arr_tmp): $arr_tmp ;
    }
}

if (! function_exists('array_depth')) {
    /**
     * 查询数组深度
     *
     * @param $array
     * @return int
     */
    function array_depth($array)
    {
        $max_depth = 1;


        foreach ($array as $value) {
            if (is_array($value)) {
                $depth = array_depth($value) + 1;


                if ($depth > $max_depth) {
                    $max_depth = $depth;
                }
            }
        }
        return $max_depth;
    }
}

if (! function_exists('cate_pid')) {
    /**
     * 格式话成多选菜单列表
     *
     * @param $data
     * @return string
     */
    function cate_pid($data)
    {
        $data = array_sort($data, 'left_value');
        $html = '';
        foreach ($data as $k => $v) {
            $title_tips = '';
            if (isset($v['son'])) {   //父亲找到儿子
                $html .= '<li><a tname="cate_ids" tvalue="' . $v['id'] . '">' . $v['title'] . $title_tips . '</a>';
                $html .= cate_pid($v['son']);
                $html .= '</li>';
            } else {
                $html .= '<li><a tname="cate_ids" tvalue="' . $v['id'] . '">' . $v['title'] . $title_tips . '</a></li>';
            }
        }
        if (!empty($html)) {
            return '<ul>' . $html . '</ul>';
        }
        return '';
    }
}

if (! function_exists('cate_role')) {
    /**
     * 格式化成菜单树
     *
     * @param $data
     * @param $cate_ids
     * @return string
     */
    function cate_role($data, $cate_ids)
    {
        $data = array_sort($data, 'rank');
        $html = '';
        foreach ($data as $k => $v) {
            if (isset($v['son'])) {   //父亲找到儿子
                $checked = in_array($v['id'], $cate_ids) ? 'checked="true"' : '';
                $html .= '<li><a tname="cate_ids" tvalue="' . $v['id'] . '" ' . $checked . '>' . $v['title'] . '</a>';
                $html .= cate_role($v['son'], $cate_ids);
                $html .= '</li>';
            } else {
                $checked = in_array($v['id'], $cate_ids) ? 'checked="true"' : '';
                $html .= '<li><a tname="cate_ids" tvalue="' . $v['id'] . '" ' . $checked . '>' . $v['title'] . '</a></li>';
            }
        }
        return '<ul>' . $html . '</ul>';
    }
}

if (! function_exists('cate_user')) {
    /**
     * 格式化成菜单树
     *
     * @param $data
     * @param $user_cate_ids
     * @return string
     */
    function cate_user($data, $user_cate_ids)
    {
        $data = array_sort($data, 'rank');
        $html = '';
        foreach ($data as $k => $v) {
            if (isset($v['son'])) {   //父亲找到儿子
                $checked = in_array($v['id'], $user_cate_ids) ? 'checked="true"' : '';
                $html .= '<li><a tname="cate_ids" tvalue="' . $v['id'] . '" ' . $checked . '>' . $v['title'] . '</a>';
                $html .= cate_user($v['son'], $user_cate_ids);
                $html .= '</li>';
            } else {
                $checked = in_array($v['id'], $user_cate_ids) ? 'checked="true"' : '';
                $html .= '<li><a tname="cate_ids" tvalue="' . $v['id'] . '" ' . $checked . '>' . $v['title'] . '</a></li>';
            }
        }
        return '<ul>' . $html . '</ul>';
    }
}

if (! function_exists('cate_sidebar')) {
    /**
     * 格式化成菜单树
     *
     * @param $data
     * @return string
     */
    function cate_sidebar($data)
    {
        $data = array_sort($data, 'rank');
        $html = '';
        foreach ($data as $k => $v) {
            if ($v['status'] == 2) {
                if (isset($v['son'])) {   //父亲找到儿子
                    if($v['url']){
                        $html .= '<li><a href="' . (is_url($v['url']) ? $v['url'] : path_site_url($v['url'])) . '" target="navTab" rel="' . $v['rel'] . '">' . $v['title'] . '</a></li>';
                    }else{
                        $html .= '<li><a>' . $v['title'] . '</a>';
                        $html .= cate_sidebar($v['son']);
                        $html .= '</li>';
                    }
                } else {
                    $html .= '<li><a href="' . (is_url($v['url']) ? $v['url'] : path_site_url($v['url'])) . '" target="navTab" rel="' . $v['rel'] . '">' . $v['title'] . '</a></li>';
                }
            }
        }
        return '<ul>' . $html . '</ul>';
    }
}

if (! function_exists('cate_sidebars')) {
    /**
     * 格式化成菜单树
     *
     * @param $data
     * @return string
     */
    function cate_sidebars($data)
    {
        $data = array_sort($data, 'rank');
        $html = '';
        foreach ($data as $k => $v) {
            if ($v['status'] == 2) {
                if (isset($v['son'])) {   //父亲找到儿子
                    if($v['url']){
                        $html .= '<li><a href="' . (is_url($v['url']) ? $v['url'] : path_site_url($v['url'])) . '" target="navTab" rel="' . $v['rel'] . '">' . $v['title'] . '</a></li>';
                    }else{
                        $html .= '<li><a>' . $v['title'] . '</a>';
                        $html .= cate_sidebars($v['son']);
                        $html .= '</li>';
                    }
                } else {
                    $html .= '<li><a href="' . (is_url($v['url']) ? $v['url'] : path_site_url($v['url'])) . '" target="navTab" rel="' . $v['rel'] . '">' . $v['title'] . '</a></li>';
                }
            }
        }
        return '<ul>' . $html . '</ul>';
    }
}

if (! function_exists('cate_sidebar_show')) {
    /**
     * 显示左侧菜单
     *
     * @param $cates
     * @return string
     */
    function cate_sidebar_show($cates)
    {
        $html = '<div class="accordion" fillSpace="sidebar">';
        if (isset($cates['son'])) {
            $cates['son'] = array_sort($cates['son'], 'rank');

            foreach ((array)$cates['son'] as $value) {
                if ($value['status']) {
                    $html .= '<div class="accordionHeader">';
                    $html .= '<h2><span>Folder</span>' . $value['title'] . '</h2>';
                    $html .= '</div>';
                    $html .= '<div class="accordionContent">';
                    $html .= '<ul class="tree treeFolder expand">';
                    if (isset($value['son'])) {
                        $html .= substr(substr(cate_sidebar($value['son']), 4), 0, -5);
                    }
                    $html .= '</ul>';
                    $html .= '</div>';
                }
            }
        }
        $html .= '</div>';

        return $html;
    }
}

if (! function_exists('cate_sidebar_shows')) {
    /**
     * 显示左侧菜单
     *
     * @param $cates
     * @return string
     */
    function cate_sidebar_shows($cates)
    {
        $html = '<div class="accordion" fillSpace="sidebar">';
        if (isset($cates['son'])) {
            $cates['son'] = array_sort($cates['son'], 'rank');

            foreach ((array)$cates['son'] as $value) {
                if ($value['status']) {
                    $html .= '<div class="accordionHeader">';
                    $html .= '<h2><span>Folder</span>' . $value['title'] . '</h2>';
                    $html .= '</div>';
                    $html .= '<div class="accordionContent">';
                    $html .= '<ul class="tree treeFolder expand">';
                    if (isset($value['son'])) {
                        $html .= substr(substr(cate_sidebars($value['son']), 4), 0, -5);
                    }
                    $html .= '</ul>';
                    $html .= '</div>';
                }
            }
        }
        $html .= '</div>';

        return $html;
    }
}

if (! function_exists('curr_site_address')) {
    /**
     *当前站点环境
     *
     * @return string
     */
    function curr_site_address()
    {
        $ip = $_SERVER['SERVER_ADDR'];

        $ip_arr = array(
            '127.0.0.1'         => '本机开发环境',
            '192.168.78.22'     => '【开发】测试环境',
            '192.168.78.28'     => '【测试】测试环境',
            '192.168.11.161 '   => '预发布环境',
            '192.168.11.133 '   => '线上环境'
        );

        return isset($ip_arr[$ip]) ? $ip_arr[$ip] : $ip.'环境';
    }
}

if (! function_exists('alert')) {
    /**
     * php 弹窗方法 跳转方法
     *
     * @param $msg
     * @param null $url
     */
    function alert($msg, $url = null)
    {
        $str = '<script type="text/javascript">alert("' . $msg . '");  ' . ($url ? 'window.location.href ="' . $url . '"' : '') . '</script>';

        echo $str;
    }
}

if (! function_exists('confirm')) {
    /**
     * php 确认弹窗方法 跳转方法
     * 注: 可扩展确认后操作方法
     *
     * @param $msg
     * @param null $url
     */
    function confirm($msg, $url = null)
    {
        $str = '<script type="text/javascript">var r=confirm("' . $msg . '");  if (r==true) {' . ($url ? 'window.open("' . $url . '");' : '') . '}else{}</script>';

        echo $str;
    }
}

if (! function_exists('rand_str')) {
    /**
     * 随机字符串
     *
     * @param int $len
     * @param string $format
     * @return string
     */
    function rand_str($len = 6, $format = 'number')
    {
        $is_abc = $is_numer = 0;
        $str = $tmp = '';

        $format = strtolower($format);

        switch ($format) {
            case 'char':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                break;
            case 'number':
                $chars = '0123456789';
                break;
            default :
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                break;
        }
        mt_srand((double)microtime() * 1000000 * getmypid());
        while (strlen($str) < $len) {
            $tmp = substr($chars, (mt_rand() % strlen($chars)), 1);
            if (($is_numer <> 1 && is_numeric($tmp) && $tmp > 0) || $format == 'char') {
                $is_numer = 1;
            }
            if (($is_abc <> 1 && preg_match('/[a-zA-Z]/', $tmp)) || $format == 'number') {
                $is_abc = 1;
            }
            $str .= $tmp;
        }
        if ($is_numer <> 1 || $is_abc <> 1 || empty($str)) {
            $str = rand_str($len, $format);
        }
        return $str;
    }
}

if (! function_exists('format_page_style')) {
    /**
     * 格式分页样式
     *
     * @param null $page
     * @param null $type
     * @param int $curr_page
     * @return null|string
     */
    function format_page_style($page = null, $type = null, $curr_page = 1)
    {
        $curr_style = '';
        switch($type){
            case 'software_list':
                if($page == $curr_page){
                    $curr_style = 'spanCurrent';
                }

                break;
        }
        return !empty($type) ? '<span class="'.$curr_style.'">'.$page.'</span>' : $page;
    }
}

if (! function_exists('format_echo')) {
    /**
     * 格式输出内容
     *
     * @param $var
     * @param null $default
     * @return null
     */
    function format_echo($var, $default = null)
    {
        return isset($var) ? $var : $default;
    }
}

if (! function_exists('format_dev_andorid_content')) {
    /**
     * 格式化 dev android 文本内容
     *
     * @param $content
     * @return string
     */
    function format_dev_andorid_content($content)
    {
        $content = str_replace("</p>", "</br>", $content);
        $content = str_replace("<p>", "</br>", $content);
        $content = str_replace("</br>", "\n", $content);
        $content = str_replace("<br />", "\n", $content);
        return strip_tags($content);
    }
}

if (! function_exists('format_app_size')) {
    /**
     * 格式应用大小
     *
     * @param int $size
     * @param int $dec
     * @return string
     */
    function format_app_size($size = 0, $dec = 2) {
        $unit = array("MB", "GB", "TB", "PB");
        $pos = 0;
        while ($size >= 1024) {
            $size /= 1024;
            $pos++;
        }
        $result['size'] = round($size, $dec);
        $result['unit'] = $unit[$pos];
        return $result['size'].$result['unit'];
    }
}

/****************************php 常用验证方法**********************************/

if (! function_exists('verify_phone')) {
    /**
     * 验证手机号码
     *
     * @param $phone
     * @return bool
     */
    function verify_phone($phone)
    {
        if (!preg_match("/^1[34578]{1}[0-9]{1}[0-9]{8}$/", $phone)) {
            return false;
        } else {
            return true;
        }
    }
}

if (! function_exists('verify_date')) {
    /**
     * 验证日期是否合法
     *
     * @param $date
     * @param string $format
     * @return bool
     */
    function verify_date($date, $format = 'Y-m-d H:i:s')
    {
        if ($date == date($format, strtotime($date))) {
            return $date;
        } else {
            return false;
        }

    }
}

if (! function_exists('verify_domain')) {
    /**
     * 验证域名
     *
     * @param $domain
     * @param string $check_domain
     * @return bool
     */
    function verify_domain($domain, $check_domain = 'xyzs.com')
    {
        $domain_arr = array_reverse(explode('.', $domain));

        if ($check_domain === ($domain_arr[1] . '.' . $domain_arr[0])) {
            return true;
        }

        return false;
    }
}

if (! function_exists('verify_count')) {
    /**
     * 长度验证
     *
     * @param $str
     * @param $count int
     * @return bool
     */
    function verify_count($str, $count = 5)
    {
        $len = iconv_strlen($str);
        if($len > $count) {
            return false;
        } else {
            return true;
        }
    }
}




/****** cookies cookie 处理 ******/
if (! function_exists('set_cookie')) {
    /**
     * 设置cookie值
     *
     * @param $key
     * @param $value
     * @param null $time
     */
    function set_cookie($key, $value, $time = null)
    {
        if ($time == null) {
            $time = time() + 60*60*24*7;
        } else {
            $time = time() + $time;
        }
        setcookie($key, $value, $time, '/', curr_domain(), false, true);
    }
}

if (! function_exists('get_cookie')) {
    /**
     * 获取cookie值
     *
     * @param $keys
     * @return mixed]
     */
    function get_cookie($keys)
    {
        if (is_array($keys)) {
            $ret = array();

            foreach ((array)$keys as $v) {
                $ret[$v] = isset($_COOKIE[$v]) ? $_COOKIE[$v] : null;
            }
        } else {
            $ret = isset($_COOKIE[$keys]) ? $_COOKIE[$keys] : null;
        }

        return $ret;
    }
}
if (! function_exists('delete_cookie')) {
    /**
     * 删除cookies方法
     *
     * @param $keys
     */
    function delete_cookie($keys)
    {
        if (is_array($keys)) {
            foreach ((array)$keys as $v) {
                setcookie($v, "", time() - 60 * 60 * 24 * 60, '/', curr_domain(), false, true);
            }
        } else {
            setcookie($keys, "", time() - 60 * 60 * 24 * 60, '/', curr_domain(), false, true);
        }
    }
}

if (! function_exists('cnSubStr')) {
    function cnSubStr($string, $sublen, $tip=''){
        $str=' ';
        if(strlen($string)>$sublen){
            for($i=0;$i<$sublen;$i++){
                if(ord(substr($string,$i,1))>0xa0){//0xa0代表中文字符的开始
                    if($i+2<strlen($string)){
                        $str.=substr($string,$i,3);
                        $i+=2;
                    }
                }else{
                    $str.=substr($string,$i,1);
                }
            }
            return $str.$tip;
        }else{
            $str=$string;
            return $str;
        }
    }
}

/**
 * 两个日期相差月份
 */

if (! function_exists('getMonthNum')) {
    function getMonthNum($date1,$date2){
        $date1_stamp=strtotime($date1);
        $date2_stamp=strtotime($date2);
        list($date_1['y'],$date_1['m'])=explode("-",date('Y-m',$date1_stamp));
        list($date_2['y'],$date_2['m'])=explode("-",date('Y-m',$date2_stamp));
        return abs(($date_2['y']-$date_1['y'])*12 +$date_2['m']-$date_1['m']);
    }
}

/**
 * 获取月初月末
 */

if (! function_exists('getMonthDate')) {
    function getMonthDate($strDate){
        $mom = date('m', strtotime($strDate));
        $year = date('Y', strtotime($strDate));
        $startDay = $year . '-' . $mom . '-01';
        $endDay = $year . '-' . $mom . '-' . date('t', strtotime($startDay));
        $data['str_date']  = strtotime($startDay);//当前月的月初时间戳
        $data['end_date']  = strtotime($endDay);//当前月的月末时间戳
        return $data;
    }
}

/**
 * 获取月初月末
 */

if (! function_exists('changeTimeType')) {
    function changeTimeType($seconds){
        if ($seconds>3600){
            $hours = intval($seconds/3600);
            $minutes = $seconds/600;
            $time = $hours.":".gmstrftime('%M:%S', $minutes);
        }else{
            $time = gmstrftime('%H:%M:%S', $seconds);
        }
        return $time;
    }
}
if (! function_exists('getXmlContent')) {
    function getXmlContent($node) {
        $array = false;

        if ($node->hasAttributes()) {
            foreach ($node->attributes as $attr) {
                $array[$attr->nodeName] = $attr->nodeValue;
            }
        }

        if ($node->hasChildNodes()) {
            if ($node->childNodes->length == 1) {
                $array[$node->firstChild->nodeName] = getXmlContent($node->firstChild);
            } else {
                foreach ($node->childNodes as $childNode) {
                    if ($childNode->nodeType != XML_TEXT_NODE) {
                        $array[$childNode->nodeName][] = getXmlContent($childNode);
                    }
                }
            }
        } else {
            return $node->nodeValue;
        }
        return $array;
    }
}
/**
 * 检测地址是否有效
 */

if (! function_exists('urlDetection ')) {
    function urlDetection($url){
        $array = get_headers($url,1);
        if(preg_match('/200/',$array[0])){
            return true;
        }else{
            return false;
        }
    }
}

/**
* 获取csv的内容转换
*/

if (! function_exists('input_csv')) {
    function input_csv($handle){
        $n = 0;
        while ($data = fgetcsv($handle, 10000)) {
            $num = count($data);
            for ($i = 0; $i < $num; $i++) {
                $out[$n][$i] = $data[$i];
            }
            $n++;
        }
        return $out;
    }
}

function getJson($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output, true);
}

function is_weixin(){
    if ( strpos($_SERVER['HTTP_USER_AGENT'],
            'MicroMessenger') !== false ) {
        return true;
    }
    return false;
}


