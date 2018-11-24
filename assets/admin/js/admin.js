/**
 * 短信码倒计时
 *
 * @returns {{f: number, v: number}}
 */
var _is_sms = false;
var _times = 60;

function sms_times(){
    _times--;
    if(_times > 0){
        if(_is_sms == true){
            $('._sms_verify,._sms_verify1,._sms_register_verify').find('font').show();
            $('._sms_verify,._sms_verify1,._sms_register_verify').find('font').text('('+_times+')');
            setTimeout("sms_times()", 1000);
        }
    }else{
        $('._sms_verify,._sms_verify1,._sms_register_verify').find('font').hide();
        _is_sms = false;
        _times = 60;
    }
}

$(document).ready(function(){
    $('._sms_verify').live('click', function(){
        if(_is_sms == false && _times == 60){
            var _sms_tel = $.trim($('._sms_tel').val());

            var _old_sms_tel = $.trim($('._old_sms_tel').val());

            if((_sms_tel == null || _sms_tel == '' || _sms_tel == undefined) && !_old_sms_tel){
                alertMsg.error('手机号码不能为空');
                return;
            }

            _is_sms = true;
            sms_times();

            $.getJSON("/admin/Users/phoneSmsSend", {tel:_sms_tel,_t: (new Date()).valueOf() }, function(json){
                if(json.statusCode == 200){
                    alertMsg.info(json.message);
                }else{
                    _times = 1;
                    alertMsg.error(json.message);
                }
            });
        }else{
            alertMsg.info('验证码正在路上走，请耐心等一下~');
        }
    });

    $('._sms_verify1').live('click', function(){
        if(_is_sms == false && _times == 60){
            var _user_name      = $.trim($('input[name=user_name]').val());
            var _password       = $.trim($('input[name=password]').val());
            var _validate_code  = $.trim($('input[name=validate_code]').val());

            if((_user_name == null || _user_name == '' || _user_name == undefined)){
                alert('账号不能为空');
                return;
            }

            if((_password == null || _password == '' || _password == undefined)){
                alert('密码不能为空');
                return;
            }

            if($('input[name=validate_code]').length > 0){
                if((_validate_code == null || _validate_code == '' || _validate_code == undefined)){
                    alert('验证码不能为空');
                    return;
                }
            }

            _is_sms = true;
            sms_times();

            var _data = {};
                _data['user_name']      = _user_name;
                _data['password']       = _password;
                _data['validate_code']  = _validate_code;

            $.getJSON("/admin/Users/phoneSmsSendByLogin", _data, function(json){
                if(json.statusCode == 200){
                    alert(json.message);
                }else{
                    _times = 1;
                    alert(json.message);
                }
            });
        }else{
            alert('验证码正在路上走，请耐心等一下~');
        }
    });

    $('._sms_register_verify').live('click', function(){
        if(_is_sms == false && _times == 60){
            var _user_name      = $.trim($('input[name=user_name]').val());
            var _validate_code  = $.trim($('input[name=validate_code]').val());

            if((_user_name == null || _user_name == '' || _user_name == undefined)){
                alert('账号不能为空');
                return;
            }

            if($('input[name=validate_code]').length > 0) {
                if ((_validate_code == null || _validate_code == '' || _validate_code == undefined)) {
                    alert('验证码不能为空');
                    return;
                }
            }

            _is_sms = true;
            sms_times();

            var _data = {};
            _data['user_name']      = _user_name;
            _data['validate_code']  = _validate_code;

            $.getJSON("/admin/Users/phoneSmsSendByRegister", _data, function(json){
                if(json.statusCode == 200){
                    alert(json.message);
                }else{
                    _times = 1;
                    alert(json.message);
                }
            });
        }else{
            alert('验证码正在路上走，请耐心等一下~');
        }
    });
});