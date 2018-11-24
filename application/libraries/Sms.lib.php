<?php
class Sms {
    private $_host     = ''; // 服务器IP
    private $_port     = ''; // 服务器端口
    private $_userid   = ''; // 用户名
    private $_password = ''; // 密码

    private $_error    = '';

    private static $_conf = array(
        'xy'=>array('host'=>'61.145.229.29','port'=>7791,'userid'=>'H10832', 'password'=>'591652'),
    );

    /**
     * 发送短信
     *
     * @param mixed  $phones  手机号码，支持单个号码和数组
     * @param string $pszMsg  发送内容
     * @param string $channel 发送渠道
     * @return bool
     */
    public function send($phones, $pszMsg = '',$channel = 'xy') {
        if(empty($phones) || empty($pszMsg)) {
           return false;
        }

        include_once('Nusoap.lib.php');

        $this->_host     = isset(self::$_conf[$channel]['host']) ? self::$_conf[$channel]['host'] : '';
        $this->_port     = isset(self::$_conf[$channel]['port']) ? self::$_conf[$channel]['port'] : '';
        $this->_userid   = isset(self::$_conf[$channel]['userid']) ? self::$_conf[$channel]['userid'] : '';
        $this->_password = isset(self::$_conf[$channel]['password']) ? self::$_conf[$channel]['password'] : '';

        if(is_array($phones)) {
            $pszMobis   = join(',', $phones);
            $iMobiCount = count($phones);
        } else {
            $pszMobis   = $phones;
            $iMobiCount = 1;
        }

        $pszSubPort = '*';

        // 将对应参数值赋到下面数组以供调用
        $parameters = array(
            'userId'    => $this->_userid,
            'password'  => $this->_password,
            'pszMobis'  => $pszMobis,
            'pszMsg'    => $pszMsg,
            'iMobiCount'=> $iMobiCount,
            'pszSubPort'=> $pszSubPort
        );

        // 创建一个soapclient对象，参数是server的WSDL
        $client = new soapclient2("http://{$this->_host}:{$this->_port}/MWGate/wmgw.asmx?wsdl");
        $client->soap_defencoding = 'gb2312';
        $client->decode_utf8      = true;
        $this->returnContents     = $client->call('MongateCsSpSendSmsNew', $parameters);

        return true;
    }

    /**
     * 返回发送结果
     * @return mixed
     */
    public function getReturnContents() {
        return $this->_returnContents;
    }

    /**
     * 返回错误内容
     * @return string
     */
    public function getError() {
        return $this->_error;
    }
}