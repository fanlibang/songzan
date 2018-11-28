<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content bg-3 ">
        <div>
            <div class="form-tit ta-c"><img src="<?= STATIC_ASSETS ?>images/tit-2.png" alt=""></div>
            <div class="form auto">
                <div class="form-list flex center">
                    <label>*姓名：</label>
                    <div class="form-box">
                        <input type="text" name="name" class="input-text" disabled="disabled" value="<?= $name; ?>">
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>*手机号：</label>
                    <div class="form-box">
                        <input type="tel" name="phone" class="input-text" disabled="disabled" value="<?= $phone; ?>">
                    </div>
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
                        <input type="text" class="input-text ta-r" value="<?php echo $from_invite_code; ?>" disabled="disabled">
                    </div>
                </div>
                <div class="flex justify">
                    <div class="form-checkbox active">
                        我已同意保密条款和<a href="javascript:;" class="item">隐私政策</a>
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

<script src="<?= STATIC_ASSETS ?>js/sendSMS.js" type="text/javascript"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript"></script>
<script type="text/javascript">
    document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        // 通过下面这个API隐藏右上角按钮
        WeixinJSBridge.call('hideOptionMenu');
    });
    $(function(){
        $('#sub').click(function(){
            var car_id = $("#car_id option:selected").val();
            if(car_id == '') {
                alert('请选择车型'); return false;
            }
            $.ajax({
                type:'post',
                url:'<?php echo site_url('Invite', 'editInfo'); ?>',
                data:{car_id:car_id},
                cache:false,
                dataType:'json',
                success:function(json) {
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
        $('#tj').click(function(){
            var url = $(this).attr('url');
            window.location.href=url;
        });
    });
</script>