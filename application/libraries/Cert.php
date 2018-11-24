<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cert {
    private $gen_key = '@k#y$admin%';

    /**
     * 证书信息查询
     *
     * @param $cert_ids
     * @return array
     */
    public function search($cert_ids){
        if ($cert_ids == null) {
            return array('code' => 202, 'msg' => '缺少参数');
        }

        $post_data = array(
            'cert_ids'    =>    $cert_ids
        );

        $post_data['sign'] = gen_safe_sign($post_data, $this->gen_key);

        $ret_str = curl_request('http://admin.xyzs.com/v2/remind/certsInfo', $post_data, 'post', 0, 2, 5);

        $ret = json_decode($ret_str, true);

        if($ret['statusCode'] == 200){
            return array('code' => 200, 'msg' => '成功', 'data' => $ret);
        }else{
            return array('code' => 201, 'msg' => '失败', 'data' => $ret_str);
        }
    }
}