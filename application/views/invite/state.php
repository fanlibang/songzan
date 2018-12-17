<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content flex center jc">
        <div class="new-inner">
            <div class="new-title ta-c">
活动进度
            </div>
            <div class="plan">
                <ul>
                    <li class="active">
                        <div class="flex center">
                            <i>01</i>
                            <span>已注册</span>
                        </div>
                    </li>
                    <li class="active">
                        <div class="flex center">
                            <i>02</i>
                           <a onclick="cc('state/sczl')" href="<?=site_url('Invite', 'shopCar', array('car_id'=> $car_id))?>" >上传购车凭证</a>
                        </div>
                    </li>
                    <li <?php if($state == 3)  { echo 'class="active"'; } ?> >
                        <div class="flex center">
                            <i>03</i>
                            <span>审核成功</span>
                        </div>
                    </li>
                    <li <?php if($state == 3)  { echo 'class="active"'; } ?> >
                        <div class="flex center">
                            <i>04</i>
                            <a onclick="cc('state/xzlp')" href="#">选择礼遇</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex center">
                            <i>05</i>
                            <span>已完成</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript"></script>
<script type="text/javascript">
    document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        // 通过下面这个API隐藏右上角按钮
        WeixinJSBridge.call('hideOptionMenu');
    });
</script>