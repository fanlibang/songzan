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
        $data = $this->isLogin();
        if (!empty($data)) {
            if ($data['master_uid'] > 0) {
                echo 11;exit;
                $url = site_url('Invite', 'info');
                header('Location:' . $url);
            }
            echo 222;exit;
            $url = site_url('User', 'center');
            header('Location:' . $url);
        }
        $this->displayMain();
	}
}
