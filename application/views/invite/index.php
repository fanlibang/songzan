<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content bg-3 ">
        <div>
            <div class="form-tit ta-c"><img src="<?= STATIC_ASSETS ?>images/tit-2.png" alt=""></div>
            <div class="form auto">
                <div class="form-list flex center">
                    <label>*姓名：</label>
                    <div class="form-box">
                        <input type="text" name="name" class="input-text">
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>*手机号：</label>
                    <div class="form-box">
                        <input type="tel" name="phone" class="input-text">
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>*验证码：</label>
                    <div class="form-box">
                        <input type="text" name="code" class="input-text">
                    </div>
                    <input type="button" value="发送验证码" class="sendbtn _sms_verify">
                </div>
                <div class="form-list flex center opt">
                    <label>意向车型：</label>
                    <div class="form-box">
                        <span>请选择车型</span>
                        <select name="car_id" id="car_id">
                            <option value="0" selected>请选择车型</option>
                            <?php foreach ($car_record as $value) { ?>
                                <option value="<?=$value['id'] ?>"><?=$value['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-list flex center disabled">
                    <label>*推荐码：</label>
                    <div class="form-box">
                        <input type="text" class="input-text ta-r" value="<?php echo $invite_code; ?>" disabled="disabled">
                    </div>
                </div>
                <div class="flex justify">
                    <div class="form-checkbox active">
                        我已同意保密条款和<a href="https://www.landrover.com.cn/cookie-and-privacy-policy.html" class="item">隐私政策</a>
                    </div>
                    <div class="form-tip">标*为必填</div>
                </div>
                <div class="form-push">
                    <input type="hidden" name="invite_code" value="<?= $invite_code; ?>">
                    <input type="button" id="sub" value="提     交" class="btn auto">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bomb-wrapper flex center jc" id="hint">
    <div class="bomb-content">
        <div class="hint auto">
            <div class="hint-word" id="title">
                感谢您的选择，此次活动需在成功购买路虎揽胜、路虎揽胜运动版后，方可赢取至瑧礼包。
            </div>
            <div class="form-push">
                <input type="button" value="我 知 道 了" class="btn auto tj" id="agree">
            </div>
        </div>
        <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
    </div>
</div>

<div class="bomb-wrapper flex center jc hide" id="hint">
    <div class="bomb-content">
        <div class="hint auto">
            <div class="hint-word" >
                您已参与过活动，请前往个人主页查看最新状态。
            </div>
            <div class="form-push">
                <input type="button" value="个人主页" class="btn auto" id="tj" >
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
                <dd>路虎全系车主均可报名参与活动，每人最多可推荐10位被推荐人。活动期间，若被推荐人成功购买路虎揽胜/揽胜运动版车型，则视为推荐成功，双方均可赢取丰厚大礼。</dd>
                <dt>活动时间： </dt>
                <dd>即日起至2019年3月31日</dd>
                <dt>…… </dt>
            </dl>
            <div class="form-push">
                <input type="button" value="我 已 阅 读" class="btn auto tj" id="agree">
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
    $(function(){
        $('#sub').click(function(){
            var code = $('input[name=code]').val();
            var phone = $('input[name=phone]').val();
            var name = $('input[name=name]').val();
            var invite_code = $('input[name=invite_code]').val();
            var car_id = $("#car_id option:selected").val();
            if(phone == '') {
                alert('手机号不能为空'); return false;
            } else if(code == '') {
                alert('验证码不能为空');
                return false;
            } else if(name == '') {
                alert('用户名不能为空');
                return false;
            }
            $.ajax({
                type:'post',
                url:'<?php echo site_url('Invite', 'index'); ?>',
                data:{code:code, phone: phone, name:name, invite_code:invite_code, car_id:car_id},
                cache:false,
                dataType:'json',
                success:function(json) {
                    if(json.code == 200) {
                        $('#title').html(json.msg);
                        $('.tj').val('确认提交');
                        $('.tj').attr('url', json.forward);
                        $('#hint').removeClass('hide');
                    } else if(json.code == 201) {
                        $('#title').html(json.msg);
                        $('.tj').val('个人主页');
                        $('.tj').attr('url', json.forward);
                        $('#hint').removeClass('hide');
                    } else if(json.code == 202) {
                        $('#title').html(json.msg);
                        $('.tj').val('推荐状态');
                        $('.tj').attr('url', json.forward);
                        $('#hint').removeClass('hide');
                    } else {
                        alert(json.msg);
                    }
                },
                error:function(){}
            });
        });
        $('.tj').click(function(){
            var url = $(this).attr('url');
            alert(url);
            if(url) {
                window.location.href=url;
            }
        });
    });
</script>