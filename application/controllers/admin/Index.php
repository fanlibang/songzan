<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Base.php';

class Index extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 首页
     */
    public function index()
    {

        if (!$this->isLogin()) {
            redirect(site_url('Login', 'login'));
        }
        $cates      = $this->AdminCates->getAll();
        $pcates     = $this->genTree($cates);
        $show_cates = $pcates[1];
        $pcates     = array_sort($pcates, 'rank');

        $data = array(
            'pcates'                => $pcates,
            'cates'                 => $show_cates
        );
        $this->display($data);
    }
}
