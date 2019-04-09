<link href="<?= STATIC_ASSETS ?>css/swiper.min.css" rel="stylesheet" type="text/css">
<script src="<?= STATIC_ASSETS ?>js/sendSMS.js" type="text/javascript"></script>
<script src="<?= STATIC_ASSETS ?>js/swiper.min.js" type="text/javascript"></script>
<script src="<?= STATIC_ASSETS ?>js/vue.min.js" type="text/javascript"></script>
<script>
    $(function(){
        var dataSwiper = new Swiper('#roster', {
            scrollbar: '.roster-scrollbar',
            direction: 'vertical',
            slidesPerView: 'auto',
            observer: true,
            observeParents: true,
            scrollbarHide:false,
            mousewheelControl: true,
            freeMode: true
        })
    })
</script>
<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content bg-1">
        <div class="inner">
            <div class="index-tit ta-c">
                成功推荐好友购买路虎揽胜、路虎揽胜运动版<br>
                您和您的好友均可赢取至臻礼包
            </div>
            <div class="index-btn auto"><a href="<?php echo site_url('User', 'referee'); ?>" onclick="cc('index/tj')" ><img src="<?= STATIC_ASSETS ?>images/btn-1.png" alt=""></a> </div>
            <div class="index-btn auto progress"><a href="javascript:;" onclick="cc('index/jd')"><img src="<?= STATIC_ASSETS ?>images/btn-2.png" alt=""></a> </div>
            <div class="rule-box ta-c">
                <a href="javascript:;" class="rule gz" onclick="cc('index/gz')" >
                    查看活动规则
                </a>
            </div>
        </div>
    </div>
</div>

<!-- 弹框 -->
<!-- 弹框 -->
<div class="bomb-wrapper flex center">
    <div class="data-box">
        <div class="ta-c data-title">本次活动已结束</div>
        <div class="ta-c data-title2">获奖名单：</div>
        <div class="data-content">
            <div class="swiper-container" id="roster">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="data-container">
                            <div class="ta-c data-title3">受邀人：</div>
                            <ul class="data-list" id="data1">
                                <li v-for="service in services">
                                    <span>{{service.name}}</span>
                                    <span>{{service.phone}}</span>
                                </li>
                            </ul>
                            <div class="ta-c data-title3">推荐人：</div>
                            <ul class="data-list" id="data2">
                                <li v-for="info in infos">
                                    <span>{{info.name}}</span>
                                    <span>{{info.phone}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="swiper-scrollbar roster-scrollbar"></div>
            </div>
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
                    <input type="tel" name="phone" id="phone" value="" class="input-text">
                </div>
            </div>
            <div class="form-list flex center">
                <label>验证码：</label>
                <div class="form-box" style="padding:  5px 160px 5px 0;">
                    <input type="tel" id="verify" maxlength="6" value="" class="input-text">
                </div>
                <input type="button" value="发送验证码"  style="position:  absolute;right: 58px;" class="sendbtn _sms_verify">
            </div>
            <div class="form-push">
                <input type="button" value="提     交" class="btn auto" id="submit" onclick="cc('index/tyg')" >
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
                <input type="button" value="我 要 推 荐" class="btn auto" id="tj" >
            </div>
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
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript"></script>
<script type="text/javascript">
    document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        // 通过下面这个API隐藏右上角按钮
        WeixinJSBridge.call('hideOptionMenu');
    });
    $(function(){
        $('#submit').click(function(){
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
                url:'/2018/crm/ownerreferral/index.php?c=User&m=login',
                data:{phone: phone, code:code},
                dataType:'json',
                success:function(json){
                    if(json.code == 200){
                        window.location.href=json.forward;
                    } else if(json.code == 404) {
                        $('#hint').removeClass('hide');
                        $('#tj').attr('url', json.forward);
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

<script>
    var data1 = new Vue({
        el: '#data1',
        data: {
            services: [
                {name: '安*强',phone: '139****3939',},
                {name: '包*辉',phone: '182****2125',},
                {name: '蔡*军',phone: '171****6809',},
                {name: '蔡*可',phone: '178****8210',},
                {name: '曹*',phone: '139****1888',},
                {name: '曾*莲',phone: '138****0750',},
                {name: '曾*华',phone: '132****1021',},
                {name: '曾*荣',phone: '186****2369',},
                {name: '陈*文',phone: '139****8972',},
                {name: '陈*军',phone: '139****1886',},
                {name: '陈*良',phone: '138****2102',},
                {name: '陈*民',phone: '153****0012',},
                {name: '陈*',phone: '132****3339',},
                {name: '陈*灯',phone: '178****5637',},
                {name: '陈*新',phone: '133****7837',},
                {name: '陈*杰',phone: '130****7880',},
                {name: '陈*槟',phone: '137****9666',},
                {name: '陈*',phone: '132****0101',},
                {name: '陈*三',phone: '131****9141',},
                {name: '陈*文',phone: '137****6546',},
                {name: '大***染',phone: '136****5050',},
                {name: '董*双',phone: '130****0377',},
                {name: '董*冬',phone: '150****0383',},
                {name: '杜*',phone: '133****2888',},
                {name: '段*邓',phone: '178****9879',},
                {name: '范*民',phone: '139****6866',},
                {name: '方*成',phone: '186****0520',},
                {name: '冯*兰',phone: '183****8606',},
                {name: '冯*',phone: '158****9072',},
                {name: '冯*花',phone: '177****8888',},
                {name: '福**永',phone: '139****8725',},
                {name: '福**福',phone: '137****2215',},
                {name: '高*喜',phone: '185****0170',},
                {name: '郭*民',phone: '139****7618',},
                {name: '何*飞',phone: '150****0005',},
                {name: '洪*育',phone: '136****3060',},
                {name: '洪*婷',phone: '139****3928',},
                {name: '胡*均',phone: '185****0067',},
                {name: '胡*祥',phone: '150****3916',},
                {name: '胡*刚',phone: '155****2918',},
                {name: '胡*举',phone: '177****9192',},
                {name: '黄*海',phone: '135****4330',},
                {name: '黄*荣',phone: '186****5111',},
                {name: '黄*波',phone: '139****6849',},
                {name: '黄*成',phone: '138****0861',},
                {name: '黄*全',phone: '155****0539',},
                {name: '贾*怡',phone: '183****5399',},
                {name: '贾*',phone: '180****6032',},
                {name: '姜*帆',phone: '138****6789',},
                {name: '蒋*红',phone: '153****4600',},
                {name: '揭*',phone: '188****7799',},
                {name: '雷*林',phone: '180****2536',},
                {name: '李*',phone: '158****9643',},
                {name: '李*滨',phone: '130****4448',},
                {name: '李*全',phone: '159****1163',},
                {name: '李*',phone: '186****0091',},
                {name: '李*斌',phone: '136****3488',},
                {name: '李*峰',phone: '173****8117',},
                {name: '李*',phone: '130****7945',},
                {name: '李*刚',phone: '136****5227',},
                {name: '梁*',phone: '157****5789',},
                {name: '梁*群',phone: '188****8472',},
                {name: '廖*魁',phone: '135****3259',},
                {name: '林*礼',phone: '138****8955',},
                {name: '林*建',phone: '139****4810',},
                {name: '刘*',phone: '151****0828',},
                {name: '刘*萍',phone: '134****5564',},
                {name: '刘*',phone: '135****8490',},
                {name: '刘*',phone: '151****8008',},
                {name: '刘*然',phone: '150****5912',},
                {name: '柳*',phone: '159****5725',},
                {name: '卢*灵',phone: '158****7010',},
                {name: '卢*',phone: '187****8316',},
                {name: '吕*杰',phone: '138****7850',},
                {name: '马*',phone: '139****8961',},
                {name: '孟*',phone: '138****0892',},
                {name: '孟*光',phone: '173****8088',},
                {name: '莫*坤',phone: '139****7436',},
                {name: '木*盛',phone: '186****4138',},
                {name: '潘*良',phone: '186****4694',},
                {name: '彭*燕',phone: '135****2300',},
                {name: '彭*倩',phone: '152****3333',},
                {name: '平**和',phone: '137****5508',},
                {name: '钱*芳',phone: '137****9588',},
                {name: '权*',phone: '183****1793',},
                {name: '厦**航',phone: '189****8193',},
                {name: '厦**鑫',phone: '150****7727',},
                {name: '邵*发',phone: '130****0000',},
                {name: '舒*慧',phone: '184****0855',},
                {name: '苏*',phone: '186****9468',},
                {name: '孙*',phone: '137****1127',},
                {name: '孙*配',phone: '199****9887',},
                {name: '孙*',phone: '156****8345',},
                {name: '孙*良',phone: '159****1999',},
                {name: '唐*泽',phone: '153****8886',},
                {name: '陶*霁',phone: '138****0072',},
                {name: '汪*星',phone: '189****7311',},
                {name: '王*',phone: '138****7201',},
                {name: '王*连',phone: '139****8688',},
                {name: '王*丽',phone: '130****5080',},
                {name: '温*',phone: '131****9923',},
                {name: '温*河',phone: '177****3059',},
                {name: '邬*飞',phone: '186****8282',},
                {name: '巫*峰',phone: '150****7375',},
                {name: '吴*',phone: '176****9492',},
                {name: '谢*栋',phone: '133****6767',},
                {name: '徐*祥',phone: '153****1115',},
                {name: '徐*冬',phone: '150****8450',},
                {name: '许*东',phone: '130****6627',},
                {name: '许*',phone: '137****2630',},
                {name: '闫*',phone: '135****4217',},
                {name: '闫*风',phone: '182****9271',},
                {name: '严*强',phone: '186****7029',},
                {name: '杨*莲',phone: '158****7752',},
                {name: '杨*亭',phone: '139****7027',},
                {name: '杨*成',phone: '173****7892',},
                {name: '杨*鹏',phone: '153****0510',},
                {name: '杨*利',phone: '188****4385',},
                {name: '易*顺',phone: '186****3738',},
                {name: '易*',phone: '139****7016',},
                {name: '易*飞',phone: '151****7203',},
                {name: '易*生',phone: '180****6926',},
                {name: '游*飘',phone: '159****6802',},
                {name: '于*',phone: '134****3892',},
                {name: '于*',phone: '186****4444',},
                {name: '余*远',phone: '135****3025',},
                {name: '俞*飞',phone: '180****7961',},
                {name: '俞*辉',phone: '181****1818',},
                {name: '张*波',phone: '159****9046',},
                {name: '张*南',phone: '158****1111',},
                {name: '张*明',phone: '188****7164',},
                {name: '张*琴',phone: '187****4668',},
                {name: '张*芳',phone: '135****1000',},
                {name: '张*敬',phone: '133****3360',},
                {name: '张*德',phone: '139****1036',},
                {name: '张*曦',phone: '181****0564',},
                {name: '赵*雷',phone: '189****8233',},
                {name: '赵*波',phone: '137****5135',},
                {name: '郑*德',phone: '188****5525',},
                {name: '朱*良',phone: '150****0339',},
                {name: '朱*田',phone: '131****6266',},
                {name: '卓*花',phone: '131****0872',}
            ]
        }
    });
    var data2 = new Vue({
        el: '#data2',
        data: {
            infos: [
                {name: '蔡*',phone: '159****0827',},
                {name: '曹*全',phone: '133****7892',},
                {name: '陈*月',phone: '139****3859',},
                {name: '陈*鹏',phone: '183****3221',},
                {name: '陈*清',phone: '159****9868',},
                {name: '陈*响',phone: '137****2128',},
                {name: '陈*山',phone: '139****3707',},
                {name: '陈*辉',phone: '139****3888',},
                {name: '戴*杰',phone: '186****6936',},
                {name: '邓*君',phone: '135****9958',},
                {name: '丁*建',phone: '185****3755',},
                {name: '董*',phone: '151****0275',},
                {name: '杜*',phone: '186****3463',},
                {name: '樊*',phone: '159****8016',},
                {name: '方*成',phone: '186****5500',},
                {name: '冯*达',phone: '150****0272',},
                {name: '付*良',phone: '139****9562',},
                {name: '高*',phone: '185****9572',},
                {name: '高*',phone: '186****0843',},
                {name: '高*',phone: '180****7758',},
                {name: '高*荣',phone: '136****1003',},
                {name: '桂*萍',phone: '139****2759',},
                {name: '郭*',phone: '189****3567',},
                {name: '韩*阔',phone: '130****7854',},
                {name: '何*平',phone: '151****7888',},
                {name: '姜*清',phone: '177****6777',},
                {name: '景*',phone: '139****2336',},
                {name: '康*',phone: '138****1234',},
                {name: '孔*文',phone: '134****3613',},
                {name: '蓝*',phone: '199****0358',},
                {name: '李*菲',phone: '139****8030',},
                {name: '李*坚',phone: '188****1505',},
                {name: '李*月',phone: '175****7868',},
                {name: '李*',phone: '152****3330',},
                {name: '李*阳',phone: '138****9111',},
                {name: '梁*奉',phone: '187****8800',},
                {name: '林*芝',phone: '134****7086',},
                {name: '林*聪',phone: '138****4373',},
                {name: '林*飞',phone: '173****8555',},
                {name: '林*',phone: '139****9007',},
                {name: '刘*',phone: '185****1727',},
                {name: '刘*波',phone: '138****0059',},
                {name: '刘*桐',phone: '182****5269',},
                {name: '刘*',phone: '177****9273',},
                {name: '刘*芬',phone: '182****7202',},
                {name: '刘*',phone: '185****8668',},
                {name: '刘*康',phone: '180****5887',},
                {name: '刘*春',phone: '155****6756',},
                {name: '刘*轩',phone: '185****6767',},
                {name: '马*春',phone: '136****3656',},
                {name: '梅*',phone: '182****9622',},
                {name: '孟*',phone: '139****8332',},
                {name: '牟*志',phone: '158****5526',},
                {name: '潘*杰',phone: '186****0917',},
                {name: '秦*喜',phone: '135****1766',},
                {name: '丘*洪',phone: '159****1430',},
                {name: '屈*阳',phone: '180****3232',},
                {name: '邵*强',phone: '136****0058',},
                {name: '邵*武',phone: '136****1666',},
                {name: '孙*',phone: '199****1225',},
                {name: '孙*',phone: '139****9848',},
                {name: '汪*然',phone: '139****6217',},
                {name: '王*',phone: '139****5050',},
                {name: '王*华',phone: '177****4745',},
                {name: '王*',phone: '150****4840',},
                {name: '王*杰',phone: '138****2555',},
                {name: '王*东',phone: '137****6356',},
                {name: '王*凤',phone: '133****2599',},
                {name: '王*华',phone: '180****6351',},
                {name: '王*远',phone: '137****0999',},
                {name: '王*强',phone: '185****0577',},
                {name: '吴*伟',phone: '182****1200',},
                {name: '吴*雄',phone: '137****1818',},
                {name: '吴*红',phone: '152****7911',},
                {name: '伍*红',phone: '186****4577',},
                {name: '向*龙',phone: '151****2936',},
                {name: '邢*',phone: '152****6665',},
                {name: '许*聪',phone: '158****0310',},
                {name: '许*',phone: '153****5955',},
                {name: '玄*',phone: '137****1118',},
                {name: '严*',phone: '185****9321',},
                {name: '严*文',phone: '159****4997',},
                {name: '杨*霞',phone: '135****8377',},
                {name: '杨*俊',phone: '138****2898',},
                {name: '姚*祝',phone: '156****6600',},
                {name: '易*升',phone: '189****5276',},
                {name: '易*安',phone: '139****7301',},
                {name: '易*元',phone: '180****6350',},
                {name: '易*生',phone: '156****6866',},
                {name: '游*权',phone: '186****7588',},
                {name: '余*治',phone: '153****1710',},
                {name: '俞*',phone: '136****2030',},
                {name: '张*萍',phone: '135****8341',},
                {name: '张*东',phone: '138****2112',},
                {name: '张*林',phone: '175****0709',},
                {name: '张*峰',phone: '185****6699',},
                {name: '张*婷',phone: '186****9722',},
                {name: '张*诚',phone: '135****7688',},
                {name: '张*超',phone: '176****0226',},
                {name: '赵*香',phone: '135****7775',},
                {name: '赵*',phone: '139****0922',},
                {name: '赵*洋',phone: '183****5016',},
                {name: '赵*鑫',phone: '175****6623',},
                {name: '赵*鹏',phone: '136****1020',},
                {name: '郑*标',phone: '138****6733',},
                {name: '郑*斌',phone: '186****2997',},
                {name: '钟*平',phone: '180****1121',},
                {name: '朱*华',phone: '130****9002',},
                {name: '朱*',phone: '138****8112',},
                {name: '邹*宇',phone: '158****1819',}
            ]
        }
    });
</script>