<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Sms.lib.php';

class SmsNotice {
    private $gen_key = '@k#y$admin%';
    /**
     * 老版本短信通知接口
     *
     * @param $tels
     * @param $msg
     * @return mixed
     */
    public function oldAdminSend($tels, $msg){
        if ($msg == null || $tels == null) {
            return array('code' => 202, 'msg' => '缺少参数');
        }

        $post_data = array(
            'tel'    =>    $tels,
            'msg'    =>    $msg
        );

        $post_data['sign'] = gen_safe_sign($post_data, $this->gen_key);

        $ret = json_decode(curl_request('http://admin.xyzs.com/v2/remind/smsRemind', $post_data, 'post'), true);

        if($ret['statusCode'] == 200){
            return array('code' => 200, 'msg' => '成功', 'data' => $ret);
        }else{
            return array('code' => 201, 'msg' => '失败', 'data' => $ret);
        }
    }

    /**
     * 新版短信通知接口
     *
     * @param null $tels
     * @param null $msg
     * @return array
     */
    public function send($tels = null, $msg = null){
        if (empty($tels)) {
            return array('code' => 202, 'msg' => '电话号码不能为空');
        }

        $tel_arr = explode(',', $tels);
        foreach ((array)$tel_arr as $k => $v) {
            if (!preg_match("/^1[34578]{1}[0-9]{1}[0-9]{8}$/", $v)) {
                return array('code' => 202, 'msg' => '电话号码格式不正确');
            }
        }

        if (empty($msg)) {
            return array('code' => 202, 'msg' => '短信内容不能为空');
        }

        $sms = new Sms();

        $sms_ret = $sms->send($tel_arr, $msg);

        if($sms_ret){
            return array('code' => 200, 'msg' => '成功', 'data' => $sms_ret);
        }else{
            return array('code' => 201, 'msg' => '失败', 'data' => $sms_ret);
        }
    }
}