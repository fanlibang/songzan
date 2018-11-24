<?php
//设置时区
date_default_timezone_set("Asia/Shanghai");
if(strpos($_SERVER['SERVER_NAME'], 'admin') !== false || strpos($_SERVER['REQUEST_URI'], 'admin') !== false){
    define('PROJECT_NAME', 'admin/');
}elseif(strpos($_SERVER['SERVER_NAME'], 'test') !== false){
    define('PROJECT_NAME', 'test');
}else{
    define('PROJECT_NAME', '');
}
/**
 * 自定义常量
 */
//程序运行开始时间
define('START_TIME_TIMES', time());
define('START_TIME_MICROS', microtime(true));
define('NOW_DATE_TIME',    date('Y-m-d H:i:s', time()));

// CACHE TIME CONSTANTs
define('CACHE_NO',          0);
define('CACHE_SECOND',      1);
define('CACHE_MINUTE',      60);
define('CACHE_TEN_MINUTE',  600);
define('CACHE_HOUR',        3600);
define('CACHE_DAY',         86400);
define('CACHE_WEEK',        604800);
define('CACHE_MONTH',       2592000);
define('CACHE_YEAR',        31536000);
define('CACHE_TODAY',       strtotime("+1 day") - time());

define('REQUEST_METHOD',    $_SERVER['REQUEST_METHOD']);
define('IS_GET',            REQUEST_METHOD =='GET' ? true : false);
define('IS_POST',           REQUEST_METHOD =='POST' ? true : false);

//host
define('HTTP_HOST',         'http://' . $_SERVER['HTTP_HOST']);

define('ENVIRONMENT',       isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
define('ROOTPATH',          dirname(__FILE__));
//自定义系统常量
define('IS_CLI',            (PHP_SAPI == 'cli') ? true : false);
define('IS_DEBUG',          (isset($_REQUEST['debug']) && $_REQUEST['debug'] == 1) ? true : false);

define('OPEN_XHPROF',       function_exists('xhprof_enable') ? true : false);
//静态文件地址
define('STATIC_ASSETS',     '/2018/l462/ownerreferral'. '/assets/');

//define('STATIC_DOMAIN',     'http://pic.xyzs.com/');

define('DS',                DIRECTORY_SEPARATOR);

define('SERVER_NAME',  $_SERVER['SERVER_NAME']);

//模板目录
define('VIEW_PATH', ROOTPATH.'/Views/');

//第三方框架路径
define('ASSETS_PATH',       ROOTPATH . '/assets/');
//定义环境变量
switch ($_SERVER['SERVER_ADDR']) {
    case '127.0.0.1':
        $enviroment = 'local';
        //第三方框架路径
        define('CONNECT_ZS_URL', 'http://47.104.165.92/dev/');
        break;
    default:
        $enviroment = 'production';
        $connectAddress = 'local';
        break;
}

if( !defined('XY_ENVIRONMENT') ) {
    define( 'XY_ENVIRONMENT' , $enviroment);
    //define( 'ZEPPELIN_URL' , $ZEPPELIN_URL);
    unset($enviroment);
}

$uid = $ret = isset($_COOKIE['admin_user_id']) ? $_COOKIE['admin_user_id'] : null;;
if(isset($uid)) {
    define( 'CHECK' , 0);
    unset($uid);
} else {
    define( 'CHECK' , 3);
}

if (IS_DEBUG && OPEN_XHPROF) {
    xhprof_enable();
}

//报错配置
$error_reporting = IS_DEBUG ?  false : true;

if (!$error_reporting && XY_ENVIRONMENT !='production') {
    $error_reporting = true;
}

if ($error_reporting === false) {
    ini_set("display_errors", "off");
    error_reporting(0);
} else {
    ini_set("display_errors", "on");
    error_reporting(E_ALL^E_NOTICE);
}

//系统原有配置
$system_path = 'system';

$application_folder = 'application';

$view_folder = '';

if (defined('STDIN')) {
    chdir(dirname(__FILE__));
}

if (($_temp = realpath($system_path)) !== false) {
    $system_path = $_temp.'/';
} else {
    // Ensure there's a trailing slash
    $system_path = rtrim($system_path, '/').'/';
}

// Is the system path correct?
if (! is_dir($system_path)) {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
    exit(3); // EXIT_CONFIG
}

// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// Path to the system folder
define('BASEPATH', str_replace('\\', '/', $system_path));

// Path to the front controller (this file)
define('FCPATH', dirname(__FILE__).'/');

// Name of the "system folder"
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

// The path to the "application" folder
if (is_dir($application_folder)) {
    if (($_temp = realpath($application_folder)) !== false) {
        $application_folder = $_temp;
    }

    define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);
} else {
    if (! is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR)) {
        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
        exit(3); // EXIT_CONFIG
    }

    define('APPPATH', BASEPATH.$application_folder.DIRECTORY_SEPARATOR);
}
// The path to the "views" folder
if (! is_dir($view_folder)) {
    if (! empty($view_folder) && is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR)) {
        $view_folder = APPPATH.$view_folder;
    } elseif (! is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR)) {
        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
        exit(3); // EXIT_CONFIG
    } else {
        $view_folder = APPPATH.'views';
    }
}
if (($_temp = realpath($view_folder)) !== false) {
    $view_folder = $_temp.DIRECTORY_SEPARATOR;
} else {
    $view_folder = rtrim($view_folder, '/\\').DIRECTORY_SEPARATOR;
}

define('VIEWPATH', $view_folder);

//记录文件日志目录
define('LOG_PATH',          APPPATH  . 'logs' . DIRECTORY_SEPARATOR);

//记录文件日志目录
define('CONFIG_FILE_PATH',  APPPATH . 'config' . DIRECTORY_SEPARATOR . 'file' . DIRECTORY_SEPARATOR);

//第三方框架路径
define('VENDORPATH', ROOTPATH . '/vendor/');
//加载插件 composer
$autoloader = require_once VENDORPATH . 'autoload.php';

$autoloader->addPsr4("Xy\\Application\\Models\\", APPPATH . 'models/');
$autoloader->addPsr4("Xy\\Application\\Models\\DB\\", APPPATH . 'models/db/');
$autoloader->addPsr4("Xy\\Application\\Models\\Memcached\\", APPPATH . 'models/memcached/');
$autoloader->addPsr4("Xy\\Application\\Models\\Redis\\", APPPATH . 'models/redis/');

$autoloader->addPsr4("", APPPATH . 'libraries/');
//系统异常处理
if (IS_CLI === false) {
    register_shutdown_function(function () {
        if (IS_DEBUG && OPEN_XHPROF) {
            include_once VENDORPATH . "xhprof/xhprof-0.9.2/xhprof_lib/utils/xhprof_lib.php";
            include_once VENDORPATH . "xhprof/xhprof-0.9.2/xhprof_lib/utils/xhprof_runs.php";

            $data        = xhprof_disable();

            $xhprof_runs = new XHprofRuns_Default();
            $xhprof_id = $xhprof_runs->save_run($data, 'xyzs');

            //记录当前 xhprof id 便于后面查询
            if(XY_ENVIRONMENT == 'local'){
                confirm('前往xhprof查看运行效率', HTTP_HOST . '/vendor/xhprof/xhprof-0.9.2/xhprof_html/index.php?run='.$xhprof_id.'&source=xyzs');
            }
        }
    });

    try {
        require_once BASEPATH.'core/CodeIgniter.php';
    } catch (Exception $e) {
        Exceptions::capture($e);

        header("Refresh:5;url=/");
        $data['code'] = $e->getCode();
        $data['msg']  = $e->getMessage();
        $out = json_encode($data);
        header("Content-Length:" . strlen($out));
        header("Content-type: application/json");
        echo $out;
    }
}
