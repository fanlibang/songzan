<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    public function __construct($type = NULL){
        parent::__construct();
//        switch ($type) {
//            case 'api' :
//                $this->load->library('api_helper', NULL, 'helper');
//                break;
//            case 'admin' :
//                $this->load->library('admin_helper', NULL, 'helper');
//                break;
//            default :
//                $this->load->library('app_helper', NULL, 'helper');
//                break;
//        }
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */