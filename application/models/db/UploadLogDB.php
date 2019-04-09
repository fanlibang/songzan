<?php
/**
 * Created by PhpStorm.
 * User: xujian
 * Date: 2018/12/5
 * Time: 11:28
 */
namespace Xy\Application\Models\DB;

class UploadLogDB extends BaseDB
{
    public $_table_obj = 'ownerreferral_201812_upload_log';
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }
}
