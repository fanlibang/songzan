<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content bg-3 info-page">
        <div>
            <div class="form-tit ta-c">我的主页<div class="actrule gz">活动规则</div></div>
            <div class="form auto">
                <div class="referee-tit flex center justify">
                    <span>个人信息</span>
                    <?php if(empty($card_number) || empty($driver_number))  { ?>
                        <div class="perfect"><i><img src="<?= STATIC_ASSETS ?>images/icon-5.png" alt=""></i><a onclick="cc('center/wszl')" href="<?=site_url('User', 'updateInfo', array('id' => $id))?>">完善信息</a></div>
                    <?php }?>
                </div>
                <div class="form-list flex center">
                    <label>姓名：</label>
                    <div class="form-box">
                        <div class="input-text" ><?= $name ?></div>
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>手机号：</label>
                    <div class="form-box">
                        <div class="input-text" ><?= $phone ?></div>
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>身份证：</label>
                    <div class="form-box">
                        <div class="input-text" ><?= $card_number ?></div>
                    </div>
                </div>
                <div class="form-list flex center no-border">
                    <label>行驶证：</label>
                    <div class="form-box">
                        <div class="input-text" ><?= $driver_number ?></div>
                    </div>
                </div>
                <div class="referee-tit flex center justify">
                    <span>活动信息</span>
                </div>
                <div class="form-list flex center opt state rotate">
                    <label>被推荐人状态：</label>
                    <div class="form-box">
                        <span>已注册</span>
                    </div>
                </div>
                <div class="form-list flex center opt rotate">
                    <label>邀请码：</label>
                    <div class="form-box">
                        <?php if(empty($card_number) || empty($driver_number)) { ?>
                            <span><a id="ws" onclick="cc('center/yqm')" href="javascript:;"><?= $invite_code ?></a></span>
                        <?php } else { ?>
                            <span><a onclick="cc('center/yqm')" href="<?=site_url('Invite', 'share')?>"><?= $invite_code ?></a></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
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
                <input type="button" value="我 已 了 解" class="btn auto" id="agree">
            </div>
        </div>
        <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
    </div>
</div>
<?php if(empty($card_number) || empty($driver_number)) { ?>
    <div class="bomb-wrapper flex center jc" id="hint">
        <div class="bomb-content">
            <div class="hint auto">
                <div class="hint-word" id="title">
                    请尽快上传身份证和行驶证信息。推荐成功后，您和您的推荐好友均可赢取丰厚大礼！
                </div>
                <div class="form-push">
                    <input type="button" value="完 善 资 料" class="btn auto" id="tj" >
                </div>
            </div>
            <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
        </div>
    </div>
<?php } else { ?>
    <div class="bomb-wrapper flex center jc" id="hint">
        <div class="bomb-content">
            <div class="hint auto">
                <div class="hint-word" id="title">
                    您已成功填写个人基本信息，后续功能页面正在开发中，敬请期待哦！
                </div>
                <div class="form-push">
                    <input type="button" value="我 知 道 了" class="btn auto" id="tj" >
                </div>
            </div>
            <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
        </div>
    </div>
<?php } ?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript"></script>
<script type="text/javascript">
    document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        // 通过下面这个API隐藏右上角按钮
        WeixinJSBridge.call('hideOptionMenu');
    });
    $(function(){
        $('#tj').on('click',function () {
            $('#hint').addClass('hide');
        });
        $('#ws').on('click',function () {
            alert('请先完善资料');
        });
    });
</script>