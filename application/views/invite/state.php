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
                    <li class="<?php if($state > 0 ) echo 'active'; ?>">
                        <div class="flex center">
                            <i>02</i>
                            <?php if($state == 3 || $state == 1)  { ?>
                                <a style="text-decoration:none" href="javascript:;">上传购车凭证</a>
                            <?php } else { ?>
                                <a onclick="cc('state/sczl')" href="<?=site_url('Invite', 'shopCar', array('car_id'=> $car_id))?>" >上传购车凭证</a>
                            <?php } ?>

                        </div>
                    </li>
                    <li <?php if($state == 3 && $status == 3)  { echo 'class="active"'; } ?> >
                        <div class="flex center">
                            <i>03</i>
                            <a style="text-decoration:none<?php if($state != 3 || $status != 3) echo ';color:#666'; ?>"   href="javascript:;">审核成功</a>
                        </div>
                    </li>

                    <li <?php if($reward_count > 0)   echo 'class="active"'; ?> >
                        <div class="flex center">
                            <i>04</i>
                            <?php if($state == 3 && $status == 3 && $reward_count < 1)  { ?>
                                <a onclick="cc('state/xzlp')" href="<?=site_url('Invite', 'reward')?>" >选择专属礼遇</a>
                            <?php } else { ?>
                                <a <?php if($reward_count < 1) echo 'style="color:#666"'; ?> href="javascript:;">选择专属礼遇</a>
                            <?php } ?>
                        </div>
                    </li>
                    <li <?php if($reward_count > 0)  { echo 'class="active"'; } ?>>
                        <div class="flex center">
                            <i>05</i>
                            <a style="text-decoration:none<?php if($reward_count < 1) echo ';color:#666'; ?>" href="javascript:;">已选择礼遇</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="bomb-wrapper flex center jc <?php if($state != 2) echo  'hide'; ?>" id="hint">
    <div class="bomb-content">
        <div class="hint auto">
            <div class="hint-word" id="title">
                资料暂未审核通过，请您重新上传购车凭证哦
            </div>
            <div class="form-push">
                <input type="button" value="重新上传" url="<?= site_url('Invite', 'shopCar', array('car_id'=> $car_id)) ?>" class="btn auto " id="tj" >
            </div>
        </div>
        <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
    </div>
</div>

<script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript"></script>
<script type="text/javascript">
    document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        // 通过下面这个API隐藏右上角按钮
        WeixinJSBridge.call('hideOptionMenu');
    });
    $('#tj').click(function(){
        var url = $(this).attr('url');
        window.location.href=url;
    });
</script>