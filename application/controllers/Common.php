<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Common extends MY_Controller
{
    // 返回值类型
    const JSON              = 'application/json';
    const HTML              = 'text/html';
    const JAVASCRIPT        = 'text/javascript';
    const JS                = 'text/javascript';
    const TEXT              = 'text/plain';
    const XML               = 'text/xml';

    //返回值状态
    const AJ_RET_SUCC       = 1;
    const AJ_RET_FAIL       = -1;
    const AJ_RET_FORB       = 300;
    const AJ_RET_NOLOGIN    = 301;

    //下拉框选择全部状态（避免有些地方定义状态为0）
    const STATUS_ALL        = 9999;

    const COOKIE_PREFIX     = 'cookie_xy_';
    //本地上传配置
    private $local_upload_config = array();

    public $_more_view_path = '';

    public $_data = array();

    public function __construct()
    {
        parent::__construct();

        $this->_data = array(
            'controller'  => $this->router->fetch_class(),
            'method'      => $this->router->fetch_method(),
            'assets_path' => STATIC_ASSETS,
            'page_url'    => self::parsePageUrl(),
            'view'        => $this->router->fetch_class().':'.$this->router->fetch_method()
        );
    }
    /**
     * 分页URL 处理函数
     *
     * @param array $param
     * @param bool|true $remove_page
     * @return string
     */
    public function parsePageUrl($param = array(), $remove_page = true)
    {

        //组合请求参数
        //$tmp_arr = $_GET + $_POST + $p;
//        $get_arr  = $this->input->get(null, true);
//        $post_arr = $this->input->get(null, true);
        $request_arr = $this->input->request(null, true);

        //$tmp_arr = array_merge($get_arr, $post_arr, $param);
        $tmp_arr = array_merge($request_arr, $param);
        //移除原有分页参数
        if ($remove_page) unset($tmp_arr['page']);

        $exec_url = $tmp_arr ? http_build_query($tmp_arr) : '';

        $full_url = "?" . $exec_url;

        return $full_url;
    }




    /**
     * 写文件日志
     *
     * @param $log_name
     * @param $info
     */
    public function logInfo($log_name, $info){
        //echo date('Y-m-d H:i:s') . '#' . $info . "\r\n";
        file_put_contents('/opt/wwwroot/script/logs/'.$log_name . '.logs', date('Y-m-d H:i:s') . '#' . $info . PHP_EOL . PHP_EOL, FILE_APPEND);
    }

    /********************公共方法 end********************/

    /*********************************模板显示方法***************************************/
    /**
     * 重写渲染模板方法
     *
     * @param array $data 模板需要的数据
     * @param null $view 模板路径
     * @param bool $return_content 是否返回模板内容
     */
    public function display($data = array(), $view = null, $return_content = false)
    {
        if ($view == null) {
            $view = $this->_more_view_path . strtolower($this->router->fetch_class()) . '/' . $this->router->fetch_method();
        } else {
            //strripos('/', $view);
            $array = explode('/', $view);
            if (count($array) <= 1) {
                $view = $this->_more_view_path  . strtolower($this->router->fetch_class()) . '/' . $view;
            } else {
                $view = 'dev/' . $view;
            }
        }
        //页面不存在调到首页
        if (!file_exists(VIEWPATH . $view . '.php')) {
            redirect(site_url('Publics', 'tips', array('message' => '您访问的页面不存在')));
        }

        $data = array_merge($this->_data, $data);
        if ($return_content) {
            $this->load->view($view, $data, true);
        } else {
            $this->load->view($view, $data);
        }
    }

    /**
     * 公共返回数据处理方法
     *
     * @param $code
     * @param null $msg
     * @param null $data
     * @param bool|true $more_data
     */
    public function ajaxReturn($code = self::AJ_RET_SUCC, $msg = null, $data = null, $more_data = false)
    {
        $new_ret = array(
            'code'       => $code,
            'msg'        => $msg
        );

        if (is_array($data)) {
            $new_ret = array_merge($new_ret, $data);
        } else {
            $new_ret['flag'] = $data;
        }

        if ($more_data) {
            $new_ret = array_merge($this->_data, $new_ret);
        } else {
            $new_ret["controller"] = $this->_data["controller"];
            $new_ret["method"]     = $this->_data["method"];
        }

        $this->output->set_content_type(self::JSON)->set_output(json_encode($new_ret))->_display();
        exit;
    }

    /**
     * 导出方法
     * @param string $title
     * @param array $newList
     */
    public function getExport($title, $newList){
        if($newList){
            header("Content-type:application/vnd.ms-excel");
            header("Content-Disposition:attachment;filename=".$title.".xls");
            foreach($newList as $val){
                foreach($val as $item){
                    echo iconv("UTF-8","GB2312//TRANSLIT",$item) ."\t";
                }
                echo "\n";
            }
        }
    }

    /**
     * 记录页面访问信息
     * @param $url
     * @param $info
     */
    public function view_assess($url, $info)
    {
        $assess_log = new \Xy\Application\Models\ViewAssessModel();
        $log_arr = assess_info($url, $info);
        $assess_log->add($log_arr);
    }
}
