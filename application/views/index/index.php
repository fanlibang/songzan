<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content bg-1">
        <div class="index-tit ta-c">推荐好友购买路虎.揽胜、揽胜运动版<br/>
            您和您的好友均可尊享万元推荐礼包</div>
        <div class="index-btn auto"><a href="<?php echo site_url('User', 'referee'); ?>"><img src="<?= STATIC_ASSETS ?>images/btn-1.png" alt=""></a> </div>
        <div class="index-btn auto progress"><a href="javascript:;"><img src="<?= STATIC_ASSETS ?>images/btn-2.png" alt=""></a> </div>
        <div class="rule-box">
            <a href="javascript:;">
                <div class="rule auto ta-c">查看活动规则</div>
            </a>
        </div>
    </div>
</div>
<!--弹框-->
<div class="bomb-wrapper flex jc hide">
    <div>
        <div class="bomb-content">
            <div class="pop-tit ta-c">验 证 登 录</div>
            <div class="form auto">
                <div class="form-list flex center">
                    <label>手机号：</label>
                    <div class="form-box">
                        <input type="tel" name="phone" id="phone" value="" class="input-text">
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>验证码：</label>
                    <div class="form-box">
                        <input type="tel" id="verify" value="" class="input-text">
                    </div>
                    <input type="button" value="发送验证码" id="code" name="code" class="sendbtn _sms_verify">
                </div>
                <div class="form-push">
                    <input type="button" value="提     交" class="btn auto" id="sub">
                </div>
            </div>
            <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
        </div>
    </div>
</div>
<script src="<?= STATIC_ASSETS ?>js/sendSMS.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('#sub').click(function(){
            var phone = $('#phone').val();
            var code = $('#verify').val();
            if(phone == '') {
                alert('手机号不能为空'); return false;
            } else if(code == '') {
                alert('验证码不能为空');
                return false;
            }
            $.ajax({
                type:'post',
                url:'<?php echo site_url('User', 'login'); ?>',
                data:{phone: phone, code:code},
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