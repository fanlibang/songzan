<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content flex center jc">
        <div class="new-inner">
            <div class="new-title ta-c">
                我的推荐状态
                <div class="actrule gz" onclick="cc('state/hdgz')" >活动规则</div>
            </div>
            <div class="state">
                <div class="state-item">
                    <div class="state-bt">这些朋友接受了我的推荐</div>
                    <div class="state-list">
                        <ul class="flex flow">
                            <?php for($i = 0; $i < 10; $i++) { ?>
                                <?php if(isset($invite_info[$i]))  { ?>
                                    <li class="on info" state=<?= $invite_info[$i]['state']; ?> reward=<?= $invite_info[$i]['reward_count']; ?> >
                                        <p><?= $invite_info[$i]['name']; ?></p>
                                    </li>
                                <?php } else { ?>
                                    <li><p></p></li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="state-item">
                    <div class="state-bt">我的礼盒</div>
                    <div class="state-package">
                        <ul class="flex">
                            <?php if($reward_count >= 1) { ?>
                                <li>
                                    <div class="package-pic flex end jc">
                                        <img src="<?= STATIC_ASSETS ?>images/new-12.png" alt="">
                                    </div>
                                    <p><?= $reward_user[0]['name']; ?></p>
                                </li>
                            <?php } elseif($success_count >= 1) { ?>
                                <li>
                                    <div class="package-pic flex end jc twinkle">
                                        <a onclick="cc('state/lhdj')" href="<?=site_url('User', 'reward')?>"><img src="<?= STATIC_ASSETS ?>images/new-11.png" alt=""></a>
                                    </div>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <div class="package-pic flex end jc" >
                                        <a onclick="cc('state/lhdj')" href="javascript:;" class="reward"><img src="<?= STATIC_ASSETS ?>images/new-13.png" alt=""></a>
                                    </div>
                                </li>
                            <?php } ?>

                            <?php if($reward_count == 2) { ?>
                                <li>
                                    <div class="package-pic flex end jc ">
                                        <img src="<?= STATIC_ASSETS ?>images/new-12.png" alt="">
                                    </div>
                                    <p><?= $reward_user[1]['name']; ?></p>
                                </li>
                            <?php } elseif($success_count >= 2) { ?>
                                <li>
                                    <div class="package-pic flex end jc twinkle">
                                        <a onclick="cc('state/lhdj')" href="<?=site_url('User', 'reward')?>"><img src="<?= STATIC_ASSETS ?>images/new-11.png" alt=""></a>
                                    </div>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <div class="package-pic flex end jc reward" id="reward">
                                        <a onclick="cc('state/lhdj')" class="reward"><img src="<?= STATIC_ASSETS ?>images/new-13.png" alt=""></a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bomb-wrapper flex center jc hide" id="progress">
    <div class="bomb-content">
        <div class="pop-tit ta-c">活 动 进 度</div>
        <div class="plan auto">
            <ul>
                <li class="active">
                    <div class="flex center">
                        <i>01</i>
                        <span>已注册</span>
                    </div>
                </li>
                <li id="sh">
                    <div class="flex center">
                        <i>02</i>
                        <span>已上传购车凭证</span>
                    </div>
                </li>
                <li id="wc">
                    <div class="flex center">
                        <i>03</i>
                        <span>审核成功</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
    </div>
</div>

<div class="bomb-wrapper flex center jc hide" id="rule">
    <div class="bomb-content">
        <div class="pop-tit ta-c">活 动 规 则</div>
        <div class="rule-inner">
            <dl class="rule-word scroll-y">
                <dt>一、活动介绍</dt>
                <dd>活动期间，路虎车主可通过活动邀请海报或链接推荐亲友购车。若亲友成功购买路虎揽胜、路虎揽胜运动版，双方均可赢取至臻礼包。礼包数量有限，先到先得，赠完即止，敬请谅解。</dd>
                <dt>活动时间：</dt>
                <dd>即日起至2019年2月28日。</dd>
                <dt>活动对象：</dt>
                <dd>活动前通过路虎官方授权经销商购买一辆及以上路虎车辆，且目前仍然拥有该车辆的路虎车主。</dd>
                <dt>活动参与方式：</dt>
                <dd>推荐人：通过活动页面提交姓名、手机号及验证码等信息进行报名。成功报名后，即可将收到的邀请海报分享给朋友。本次活动不可推荐本人再购。</dd>
                <dd>被推荐人：仅可通过推荐人（路虎车主）分享的邀请海报或推荐链接参与活动。被推荐人需要在活动页面填写姓名、手机号及意向车型等信息。</dd>

                <dt >&nbsp;</dt>
                <dt >二、礼遇申领条件</dt>
                <dd>推荐人：2019年3月31日前需在活动页面上传身份证、行驶证等凭证，认证路虎车主身份。</dd>
                <dd>被推荐人：2019年3月31日前完成购车，且在活动页面提交购车发票、身份证、行驶证等相关购买凭证，认证路虎车主身份。</dd>
                <dd>推荐人和被推荐人均需接受信息真实性和完整性审核。如若双方信息均通过审核，可填写详细收货地址，礼品将在14个工作日内寄出；如若任何一方信息审核不通过，则不满足礼遇申领条件，双方均无法获得礼品。</dd>

                <dt >&nbsp;</dt>
                <dt>三、活动细则</dt>
                <dd>•推荐人及被推荐人身份及购车信息提交截止时间为2019年3月31日（含）；</dd>
                <dd>•被推荐人活动报名时间需早于购车时间 ，购车时间以购车发票时间为准；</dd>
                <dd>•被推荐人必须通过路虎官方授权经销商处购买路虎揽胜、路虎揽胜运动版车型；</dd>
                <dd>•每位被推荐人最多可获得1份礼包；</dd>
                <dd>•被推荐人购车发票信息（包括姓名、身份证、手机号）需与报名信息完全一致；若购车信息为被推荐人直系亲属（配偶、父母、子女）需额外提供亲属证明；</dd>
                <dd>•推荐人最多可推荐10人购车，累计叠加活动礼包，但最多不超过2份；</dd>
                <dd>•活动参与者需保证所提交的信息/材料真实有效，若路虎中国对参与者提交信息/材料存疑，有权要求参与者提供补充材料或取消活动资格；</dd>
                <dd>•整个活动中，活动参与者的身份有且只能有一个（推荐人或被推荐人），且必须以首次参与活动的身份为准；</dd>
                <dd>•活动参与者同意并勾选活动首页的<a href="https://www.landrover.com.cn/cookie-and-privacy-policy.html">隐私条款</a>，将视为允许用户信息在遵守适用的法律法规的基础上，被用于路虎中国相关产品销售、服务及调查统计中；</dd>
                <dd>•凡活动参与者所提交的信息及资料（包括身份证、行驶证等）均仅用于本次活动；</dd>
                <dd>•批售及其他特殊类型的销售不得参与此活动；</dd>
                <dd>•营运性质的车辆不得参与此活动；</dd>
                <dd>•捷豹路虎工作人员、捷豹路虎官方授权经销商处工作人员及工作人员直系亲属均不得参与此活动；</dd>
                <dd>•捷豹路虎中国在法律允许范围内保留对该活动的最终解释权；</dd>
                <dd>•若您对活动有任何疑问，可随时拨打路虎贵宾专线400-820-0187。</dd>

                <dt >&nbsp;</dt>
                <dt>四、礼品内容</dt>
                <dd>通过审核后，推荐人与被推荐人可分别获得一份至臻礼包，具体内容和使用范围详见礼品细则。</dd>
                <dd>以下礼遇可二选一，若车辆不符合使用整车尊护4年/13万公里延保服务条件，活动方有权更改礼包选项，敬请理解。礼包数量有限，先到先得（以提交完整资料的时间顺序为准）：</dd>
                <dd>1、Burberry礼盒；</dd>
                <dd>2、养车无忧服务（整车尊护4年/13万公里延保服务）。</dd>
            </dl>
        </div>
        <div class="form-push">
            <input type="button" value="我 已 了 解" class="btn auto" id="agree">
        </div>
        <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
    </div>
</div>

<div class="bomb-wrapper flex center jc <?php if($state != 2) echo  'hide'; ?>" id="hint">
    <div class="bomb-content">
        <div class="hint auto">
            <div class="hint-word" id="title">
                资料暂未审核通过，请您重新上传购车凭证哦！<?= $state ?>
            </div>
            <div class="form-push">
                <input type="button" value="重新上传" url="<?= site_url('Invite', 'shopCar', array('car_id'=> $car_id)) ?>" class="btn auto " id="tj" >
            </div>
        </div>
        <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
    </div>
</div>

<?php if($success_count < 1) { ?>
    <div class="bomb-wrapper flex center jc hide" id="hz" >
        <div class="bomb-content">
            <div class="hint auto">
                <div class="hint-word">
                    提醒您的好友尽快上传购车凭证，您现在还暂时没有推荐购成功。
                </div>
                <div class="form-push">
                    <input type="button" value="我 知 道 了" class="btn auto" id="agree">
                </div>
            </div>
            <!--<div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>-->
        </div>
    </div>
<?php } else if($success_count == 1){ ?>
    <div class="bomb-wrapper flex center jc hide" id="hz">
        <div class="bomb-content">
            <div class="hint auto">
                <div class="hint-word">
                    您已成功获得一个礼盒，还有一次获得礼盒的机会哦。快去提醒您的其他亲友来参加推荐购活动吧~
                </div>
                <div class="form-push">
                    <input type="button" value="我 知 道 了" class="btn auto" id="agree">
                </div>
            </div>
            <!--<div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>-->
        </div>
    </div>
<?php } ?>



<script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript"></script>
<script type="text/javascript">
    document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        // 通过下面这个API隐藏右上角按钮
        WeixinJSBridge.call('hideOptionMenu');
    });

    $(function () {
        $('.state-list li').on('click',function () {
            if($(this).hasClass('on')){
                var state        = $(this).attr('state');
                var reward        = $(this).attr('reward');
                if(state > 0) {
                    $("#sh").addClass('active');
                } else {
                    $("#sh").removeClass('active');
                }
                if(state == 3) {
                    $("#wc").addClass('active');
                } else {
                    $("#wc").removeClass('active');
                }
                $('#progress').removeClass('hide');
            }
        })
    });


    $('#tj').click(function(){
        var url = $(this).attr('url');
        window.location.href=url;
    });

    $('.reward').click(function(){
        $('#hz').removeClass('hide');
    });
</script>