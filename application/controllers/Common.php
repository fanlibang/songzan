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
     * 求两个日期之间相差的天数
     * (针对1970年1月1日之后，求之前可以采用泰勒公式)
     * @param string $day1
     * @param string $day2
     * @return number
     */
    public function diffBetweenTwoDays ($day1, $day2)
    {
        $second1 = strtotime($day1);
        $second2 = strtotime($day2);

        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
        }
        return ($second1 - $second2) / 86400;
    }

    /**
     * 记录页面访问信息
     * @param $url
     */
    public function view_assess($url)
    {
        $assess_log = new \Xy\Application\Models\ViewAssessModel();
        $log_arr = assess_info($url);
        $assess_log->add($log_arr);
    }

    /**
     * 记录页面访问信息
     * @param $openId
     * @param $id
     */
    public function view_play($openId, $id)
    {
        $option = new \Xy\Application\Models\UserOptionModel();
        $res = $option->addUserOption($openId, $id);
        if($res) {
            $userDiary           = new \Xy\Application\Models\UserDiaryModel();
            $userDiary->updatePlay($id);
        }
    }

    /**
     * 本地文件上传
     *
     * @return array
     */
    public function localUploadFile(){
        $data       = $this->input->request(null, true);
        $config     = array();
        if (isset($data['upload_flag'])) {
            $config = $this->local_upload_config[$data['upload_flag']];
        }
        $result = array();
        if (empty($config)) {
            $mes = '上传失败#没有对应配置信息~' . $data['upload_flag'] . return_ip(false, true);
            $this->ajaxReturn(self::AJ_RET_FAIL, $mes);
        }

        $num = count($_FILES["file"]['name']);
        $j=0;
        $info = $_FILES;
        $upload_path = $config['upload_path'];
        for($i=0; $i<$num; $i++) {
            $_FILES["file"]['name'] = $info["file"]['name'][$i];
            $_FILES["file"]['type'] = $info["file"]['type'][$i];
            $_FILES["file"]['tmp_name'] = $info["file"]['tmp_name'][$i];
            $_FILES["file"]['error'] = $info["file"]['error'][$i];
            $_FILES["file"]['size'] = $info["file"]['size'][$i];
            //文件名
            $file_name  = $_FILES["file"]["name"];
            //判断包的类型
            $flie_type = pathinfo($file_name, PATHINFO_EXTENSION);
            //文件名
            $config['file_name'] = $file_name;
            //$config['file_name']=iconv("UTF-8","gb2312", $config['file_name']);
            //文件路径
            $config['show_path']   = $upload_path;
            $config['upload_path'] = ROOTPATH . $config['show_path'];
            mkdirs($config['upload_path']);
            $config['file_ext_tolower'] = true;
            $this->load->library('upload', $config);
            $this->upload->set_allowed_types('*');
            $this->upload->initialize($config);
//        return $config;
            if (!$this->upload->do_upload('file')) {
                $error = $this->upload->display_errors();
                $result['status'] = -1;
                $result['mes'] = '上传失败~' . return_ip(false, true) . $error;
                $this->ajaxReturn(self::AJ_RET_FAIL, $result['mes']);
                //return $result;
            } else {
                $upload_data = $this->upload->data();
                //大小
                $size = round($_FILES["file"]["size"][$i]/(1024*1024), 2);
                //路径
                $file = HTTP_HOST . $config['show_path'] . $upload_data['file_name'];
                //安装包目录
                $appDir = $config['upload_path'] . $upload_data['file_name'];

                $result['status']   = '1';
                $result['mes']      =  '上传成功~';
                $result['data']     = array(
                    'app_id'        => $data['app_id'],
                    'size'          => $size,
                    'appDir'        => $appDir,
                    'file'          => $file,
                    'upload_flag'   => $data['upload_flag'],
                    'id'            => $data['id'],
                );
                //$this->ajaxReturn(self::AJ_RET_SUCC, '上传成功');
                $j++;
            }
        }
        if($num==$j){
            return true;
        } else {
            return false;
        }
    }

    /**
     * * 获取接口信息
     * @param $query
     * @param $path
     * @param $last_time
     * @param $new_time
     * @param int $size
     * @return array
     */
    public function getMonitorInfo($query, $path, $last_time, $new_time, $size = 20)
    {
        $query = sprintf($query, $last_time, $new_time, $size);
        $data = curl_request($path, $query, 'POST' , 0, 5, 5);
        if($data == false) {
            echo '没有获取到数据2'; exit;
        }
        $data = json_decode($data, true);

        if(isset($data['aggregations'])) {
            $res  = $data['aggregations']['monitor']['buckets'];
        } else {
            echo '数据错误'; exit;
        }
        $info = array();
        if(!empty($res)) {
            foreach($res as $k => $v) {
                $info[$v['key']]['key'] = $v['key'];
                $info[$v['key']]['val'] = $v['val']['value'];
                $info[$v['key']]['count'] = $v['doc_count'];
            }
        }
        return $info;
    }
}
