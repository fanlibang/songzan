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
    $('._sms_verify').click(function () {
        var _iphone      = $.trim($('input[name=phone]').val());
        if(_is_sms == true || _times == 60){
            _is_sms = true;
            var _data = {};
            _data['iphone'] = _iphone;
            sms_times();
            $.getJSON("/2018/l462/ownerreferral/index.php/Publics/phoneSmsSendByLogin", _data, function(json){
                if(json.code == 1){
                    if(json.forward) {
                        window.location.href = json.rel;
                    }
                    alert(json.msg);
                }else{
                    _times = 1;
                    alert(json.msg);
                    if(json.forward) {
                        window.location.href = json.rel;
                    }
                }
            });
        }else{
            alert('验证码正在路上走，请耐心等一下~');
        }
    });
});