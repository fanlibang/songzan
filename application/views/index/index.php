<script src="<?= STATIC_ASSETS ?>js/sendSMS.js" type="text/javascript"></script>
<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content bg-1">
        <div class="index-tit ta-c">
            成功推荐好友购买路虎揽胜、路虎揽胜运动版<br>
            您和您的好友均可赢取至臻礼包
        </div>
        <div class="index-btn auto"><a href="<?php echo site_url('User', 'referee'); ?>" onclick="cc('index/tyg')" ><img src="<?= STATIC_ASSETS ?>images/btn-1.png" alt=""></a> </div>
        <div class="index-btn auto progress"><a href="javascript:;" onclick="cc('index/tyg')"><img src="<?= STATIC_ASSETS ?>images/btn-2.png" alt=""></a> </div>
        <div class="rule-box ta-c">
            <a href="javascript:;" class="rule gz">
                查看活动规则
            </a>
        </div>
    </div>
</div>
<!--弹框-->
<div class="bomb-wrapper flex center jc hide" id="login">
    <div class="bomb-content">
        <div class="pop-tit ta-c">验 证 登 录</div>
        <div class="form auto">
            <div class="form-list flex center">
                <label>手机号：</label>
                <div class="form-box">
                    <input type="tel" class="input-text">
                </div>
            </div>
            <div class="form-list flex center">
                <label>验证码：</label>
                <div class="form-box">
                    <input type="tel" class="input-text">
                </div>
                <input type="button" value="发送验证码" class="sendbtn">
            </div>
            <div class="form-push">
                <input type="button" value="提     交" class="btn auto" onclick="cc('index/tyg')" >
            </div>
        </div>
        <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
    </div>
</div>
<div class="bomb-wrapper flex center jc hide" id="hint">
    <div class="bomb-content">
        <div class="hint auto">
            <div class="hint-word">
                您还未成为路虎推荐购活动推荐人，请点击“我要推荐”报名参与活动。
            </div>
            <div class="form-push">
                <input type="button" value="我 要 推 荐" class="btn auto">
            </div>
        </div>
        <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
    </div>
</div>
<div class="bomb-wrapper flex center jc hide" id="rule">
    <div class="bomb-content">
        <div class="pop-tit ta-c">活 动 规 则</div>
        <div class="rule-inner">
            <dl class="rule-word">
                <dt>活动介绍：</dt>
                <dd>活动期间，路虎车主可通过活动链接推荐其亲友购车，若亲友成功购买路虎揽胜、路虎揽胜运动版，双方均可赢取丰厚大礼。</dd>
                <dt>活动时间： </dt>
                <dd>即日起至2019年2月28日</dd>
                <dt>活动对象：</dt>
                <dd>活动前通过路虎官方授权经销商购买一辆及以上路虎车辆，且目前仍然拥有该车辆的路虎车主。</dd>
            </dl>
            <div class="form-push">
                <input type="button" value="我 已 阅 读" class="btn auto" id="agree">
            </div>
        </div>
        <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
    </div>
</div>
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