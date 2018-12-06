<?php
header("Content-type:text/html; charset=UTF-8");
defined('BASEPATH') OR exit('No direct script access allowed');
/* *
 * 功能：创蓝发送信息DEMO
 * 版本：1.3
 * 日期：2017-04-12
 * 说明：
 * 以下代码只是为了方便客户测试而提供的样例代码，客户可以根据自己网站的需要，按照技术文档自行编写,并非一定要使用该代码。
 * 该代码仅供学习和研究创蓝接口使用，只是提供一个参考。
 */

require_once 'ChuanglanSmsApi.php';

class SendSms {
    /**
     * 新版短信通知接口
     *
     * @param null $tels
     * @param null $msg
     * @param int $type
     * @return array
     */
    public function send($tels = null, $msg = null, $type = 1){
        if (empty($tels)) {
            return array('code' => 202, 'msg' => '电话号码不能为空');
        }

        $tel_arr = explode(',', $tels);
        foreach ((array)$tel_arr as $k => $v) {
            if (!preg_match("/^1[3-9]\d{9}$/", $v)) {
                return array('code' => 202, 'msg' => '电话号码格式不正确');
            }
        }

        if (empty($msg)) {
            return array('code' => 202, 'msg' => '短信内容不能为空');
        }

        //设置您要发送的内容：其中“【】”中括号为运营商签名符号，多签名内容前置添加提交
        if($type == 1){
            $mes = '【路虎中国】尊敬的用户，您正在进行路虎活动的身份认证，验证码是：'.$msg.'。5分钟内有效，请勿将此验证码泄漏给他人。';
            $clapi  = new ChuanglanSmsApi();
        } else {
            //$mes = '【路虎中国】亲爱的车主，您已成功参与路虎推荐购活动！分享您的专属链接'.$msg.' ，邀请好友，共揽胜景，共赢好礼！退订回T';
            $mes = '【路虎中国】亲爱的车主，您已成功参与路虎推荐购活动！分享您的专属链接'.$msg.'，邀请好友，共揽胜景，共赢好礼！退订回T';
            $clapi  = new ChuanglanUrlApi();
        }

        $result = $clapi->sendSMS($tels, $mes);
        if(!is_null(json_decode($result))){
            $output=json_decode($result,true);

            if(isset($output['code'])  && $output['code']=='0'){
                return array('code' => 200, 'msg' => '成功', 'data' => $output);
            }else{
                return array('code' => 201, 'msg' => '失败', 'data' => $output['errorMsg']);
            }
        }else{
            echo $result;
        }
    }
}





