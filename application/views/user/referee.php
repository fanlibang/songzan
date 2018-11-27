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
                    <input type="button" value="获取验证码" id="code" name="code" class="sendbtn _sms_verify">
                </div>
                <div class="form-list flex center file">
                    <label>行驶证：</label>
                    <div class="form-box">
                        <input type="text" id="driver_number" value="" class="input-text">
                        <input type="hidden" id="driver_json" value="" class="input-text">
                    </div>
                    <i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt="">
                        <form id="driver_form" method="post" action="<?php echo site_url('Publics', 'getImageInfo', array('type' => 2)); ?>" target="driver_target" enctype="multipart/form-data">
                            <input type="file" name="file" id="driver_file" >
                        </form>
                    </i>
                </div>
                <div class="form-list flex center file">
                    <label>身份证：</label>
                    <div class="form-box">
                        <input type="text" id="card_number" value="" class="input-text">
                        <input type="hidden" id="card_json" value="" class="input-text">
                    </div>
                    <i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt="">
                        <form id="card_form" method="post" action="<?php echo site_url('Publics', 'getImageInfo', array('type' => 1)); ?>" target="card_target" enctype="multipart/form-data">
                            <input type="file" name="file" id="card_file" >
                        </form>
                    </i>
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
<div class="bomb-wrapper flex center jc hide" id="hint">
    <div class="bomb-content">
        <div class="hint auto">
            <div class="hint-word" id="title">
                活动礼遇将根据您所提交的信息进行审核派发。确认提交前，请确保信息的准确性。
            </div>
            <div class="form-push">
                <input type="button" value="我 要 推 荐" class="btn auto" id="tj" >
            </div>
        </div>
        <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
    </div>
</div>
<script src="<?= STATIC_ASSETS ?>js/sendSMS.js" type="text/javascript"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript"></script>
<script type="text/javascript">
    document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        // 通过下面这个API隐藏右上角按钮
        WeixinJSBridge.call('hideOptionMenu');
    });
$(document).ready(function(){
    $("#card_target").load(function(){
        var data = $(window.frames['card_target'].document.body).html();
        console.log(data);
        if(data != null){
            var dataObj=eval("("+data+")");//转换为json对象
            if(dataObj.image_status == 'normal') {
                $("#card_number").val(dataObj.words_result['公民身份号码'].words);
                $("#card_json").val(data);
            } else if (dataObj.image_status != 'normal'){
                alert('上传出错:'+dataObj.image_status);
            } else {
                alert('上传出错:'+dataObj['error_code']);
            }
        }
    });

    $("#driver_target").load(function(){
        var data = $(window.frames['driver_target'].document.body).html();
        if(data != null){
            var dataObj=eval("("+data+")");//转换为json对象
            if(dataObj.msg == 'success') {
                $("#driver_number").val(dataObj.words_result['发动机号码'].words);
                $("#driver_json").val(data);
            } else {
                alert('上传出错:'+dataObj['error_code']);
            }
        }
    });

    $("#card_file").change(function(){
        if($("#card_file").val() != '') $("#card_form").submit();
    });
    $("#driver_file").change(function(){
        if($("#driver_file").val() != '') $("#driver_form").submit();
    });

});
    $(function(){
        $('#sub').click(function(){
            var name = $('#name').val();
            var phone = $('#phone').val();
            var code = $('#verify').val();
            var driver_number = $('#driver_number').val();
            var driver_json = $('#driver_json').val();
            var card_number = $('#card_number').val();
            var card_json = $('#card_json').val();
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
                data:{name:name, phone: phone, code:code, driver_number:driver_number, driver_json:driver_json, card_number:card_number, card_json:card_json },
                dataType:'json',
                success:function(json){
                    if(json.code == 200){
                        $('#title').html(json.msg);
                        $('#tj').val('确认提交');
                        $('#tj').attr('url', json.forward);
                        $('#hint').removeClass('hide');
                        //window.location.href=json.forward;
                    } else if(json.code == 201) {
                        $('#title').html(json.msg);
                        $('#tj').val('个人主页');
                        $('#tj').attr('url', json.forward);
                        $('#hint').removeClass('hide');
                        //window.location.href=json.forward;
                    } else {
                        alert(json.msg);
                    }
                },
                error:function(){}
            });
        });

        $('#tj').click(function(){
            var url = $(this).attr('url');
            window.location.href=url;
        });
    });
</script>

<iframe id="driver_target" name="driver_target"></iframe>
<iframe id="card_target" name="card_target"></iframe>
