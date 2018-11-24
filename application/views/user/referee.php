<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content bg-3 ">
        <div>
            <div class="form-tit ta-c"><img src="<?= STATIC_ASSETS ?>images/tit-1.png" alt=""></div>
            <div class="form auto">
                <div class="form-list flex center">
                    <label>*姓名：</label>
                    <div class="form-box">
                        <input type="text" id="name" value="" class="input-text">
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>*手机号：</label>
                    <div class="form-box">
                        <input type="tel" name="phone" id="phone" value="" class="input-text">
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>*验证码：</label>
                    <div class="form-box">
                        <input type="text" value="" id="verify" class="input-text">
                    </div>
                    <input type="button" value="" id="code" name="code" class="sendbtn _sms_verify">
                </div>
                <div class="form-list flex center ">
                    <label>行驶证：</label>
                    <div class="form-box">
                        <span></span>
                        <input type="text" id="driver_number" value="" class="input-text">
                    </div>
                    <i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i>
                </div>
                <div class="form-list flex center ">
                    <label>身份证：</label>
                    <div class="form-box">
                        <span></span>
                        <input type="text" id="card_number" value="" class="input-text">
                    </div>
                    <i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt="<?php $invite_code;?>"></i>
                </div>
                <div class="flex justify">
                    <div class="form-checkbox active">
                        我已同意保密条款和<a href="javascript:;" class="item">隐私政策</a>
                    </div>
                    <div class="form-tip">标*为必填</div>
                </div>
                <div class="form-push">
                    <input type="button" value="提     交" class="btn auto" id="sub">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= STATIC_ASSETS ?>js/sendSMS.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('#sub').click(function(){
            var name = $('#name').val();
            var phone = $('#phone').val();
            var code = $('#verify').val();
            var driver_number = $('#driver_number').val();
            var card_number = $('#card_number').val();
            var succ = $('.form-checkbox.active').text();
            if(phone == '') {
                alert('手机号不能为空'); return false;
            } else if(code == '') {
                alert('验证码不能为空');
                return false;
            } else if(name == '') {
                alert('用户名不能为空');
                return false;
            } else if(succ == '') {
                alert('请选择隐私政策'); return false;
            }
            $.ajax({
                type:'post',
                url:'<?php echo site_url('User', 'referee'); ?>',
                data:{name:name, phone: phone, code:code, driver_number:driver_number, card_number:card_number},
                dataType:'json',
                success:function(json){
                    if(json.code == 200){
                        alert(json.msg);
                        window.location.href=json.forward;
                    } else {
                        alert(json.msg);
                    }
                },
                error:function(){}
            });
        });
    });
</script>
