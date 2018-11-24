<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'Base.php';
class Index extends Base {

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

        //if($a) {
            //redirect(site_url('User', 'Center')); exit;
        //}
        $this->displayMain();
	}
}
