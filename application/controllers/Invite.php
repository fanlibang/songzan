<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 2018/11/24
 * Time: 下午3:46
 */
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Base.php';
class Invite extends Base {

    /**
     * 初始化
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 首页
     */
    public function index()
    {
        $info = $this->input->request(null, true);
        $data['invite_code'] = $info['invite_code'];
        $this->displayMain($data);
    }
}
