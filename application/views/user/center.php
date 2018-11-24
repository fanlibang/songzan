<div class="wrapper">
    <div class="layout bg-self page default-page">
        <div class="logo flex center">
            <i><img src="<?= STATIC_ASSETS ?>images/logo1.png" alt=""></i>
            <i><img src="<?= STATIC_ASSETS ?>images/logo2.png" alt=""></i>
        </div>
        <div class="header flex end justify">
            <div class="left">
                <div class="header-pic auto"><img src="<?= $avatar; ?>" alt=""></div>
                <div class="name ta-c"><?= $nickname; ?></div>
            </div>
            <div class="code">个人推荐码：<span><?= $code; ?></span></div>
        </div>
        <div class="content myselfinfo-cont">
            <ul>
                <li><a onclick="cc('center/rj')" href="<?php echo site_url('Diary', 'index'); ?>"><img src="<?= STATIC_ASSETS ?>images/note-1.png" alt=""></a></li>
                <li><a onclick="cc('center/zl')" href="javascript:;" class="page2"><img src="<?= STATIC_ASSETS ?>images/note-2.png" alt=""></a></li>
                <li><a onclick="cc('center/lb')" href="javascript:;" class="page3"><img src="<?= STATIC_ASSETS ?>images/note-3.png" alt=""></a></li>
                <?php if($white_type == 2) { ?>
                    <li><a onclick="cc('center/yj')" href="javascript:;" class="page4"><img src="<?= STATIC_ASSETS ?>images/lv.png" alt=""></a></li>
                <?php } else { ?>
                    <li><a onclick="cc('center/yj')" href="javascript:;"><img src="<?= STATIC_ASSETS ?>images/note-4.png" alt=""></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="find-end">
            <div class="tit">
                革命性设计，巧妙多功能性，<br/>
                以及与生俱来的路虎全地形能力
            </div>
            <div class="link">
                <a onclick="cc('center/fx')" href="https://www.landrover.com.cn/vehicles/discovery/index.html">了解路虎新款发现</a>
            </div>
            <div class="link">
                <a onclick="cc('center/wl')" href="http://www.songtsam.com/">了解松赞文旅</a>
            </div>
        </div>
    </div>
    <!--隐秘旅程-->
    <div class="route-page hide page">
        <div class="logo flex center">
            <i><img src="<?= STATIC_ASSETS ?>images/logo1.png" alt=""></i>
            <i><img src="<?= STATIC_ASSETS ?>images/logo2.png" alt=""></i>
        </div>
        <div class="act-img-box">
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/route-02.jpg" alt=""></div>
            <div class="img-list">
                <img src="<?= STATIC_ASSETS ?>images/route-03.jpg" alt="">
                <div class="details-btn first"><a onclick="cc('center/zl1')" href="https://mp.weixin.qq.com/s/Y-x9DX-O-z43buSvz5t1Hg"><img src="<?= STATIC_ASSETS ?>images/rote-btn1.png" alt=""></a></div>
            </div>
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/route-04.jpg" alt=""></div>
            <div class="img-list">
                <img src="<?= STATIC_ASSETS ?>images/route-05.jpg" alt="">
                <div class="details-btn second"><a onclick="cc('center/zl2')" href="https://mp.weixin.qq.com/s/3cTbRt1Bs8S1DEqKKLaiaA"><img src="<?= STATIC_ASSETS ?>images/rote-btn1.png" alt=""></a></div>
            </div>
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/route-06.jpg" alt=""></div>
            <div class="img-list">
                <img src="<?= STATIC_ASSETS ?>images/route-07.jpg" alt="">
                <div class="details-btn third"><a onclick="cc('center/zl3')" href="https://mp.weixin.qq.com/s/6v5ovAoOj2BQKH0R0zl4og"><img src="<?= STATIC_ASSETS ?>images/rote-btn1.png" alt=""></a></div>
                <div class="return others-btn">
                    <a href="javascript:history.back(-1);">
                        <div class="btn flex center jc">返回<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--发现大礼-->
    <div class="find-gift-page hide page">
        <div class="logo flex center">
            <i><img src="<?= STATIC_ASSETS ?>images/logo1.png" alt=""></i>
            <i><img src="<?= STATIC_ASSETS ?>images/logo2.png" alt=""></i>
        </div>
        <div class="activity3 act-img-box">
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/2-act-02.jpg" alt=""></div>
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/2-act-03.jpg" alt=""></div>
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/2-act-04.jpg" alt=""></div>
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/2-act-05.jpg" alt=""></div>
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/2-act-06.jpg" alt=""></div>
        </div>
        <div class="rule-box act-link-box">
            <div><img src="<?= STATIC_ASSETS ?>images/rule.jpg" alt=""></div>
            <div class="activity3-btn auto find-btn">
                <a href="<?php echo site_url('User', 'center'); ?>" onclick="cc('center/rj')">
                    <div class="btn flex center jc">藏地体验官-发现日记<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                </a>
            </div>
            <div class="flex justify group-btnsm2 auto hide">
                <a href="javascript:;" onclick="cc('center/lc')">
                    <div class="btn btnsm flex center jc">发现隐秘旅程<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                </a>
                <a onclick="cc('center/zl')" href="<?php echo site_url('User', 'center', ['type' => $type]); ?>">
                    <div class="btn btnsm flex center jc">开启探索之旅<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                </a>
            </div>
        </div>
    </div>
    <!--体验反馈-->
    <div class="feedback-page bg-opinion hide page">
        <div class="logo flex center">
            <i><img src="<?= STATIC_ASSETS ?>images/logo1.png" alt=""></i>
            <i><img src="<?= STATIC_ASSETS ?>images/logo2.png" alt=""></i>
        </div>
        <div class="form auto">
            <form>
                <p class="form-tit">我们诚邀您参与此次问卷调查，以便为您提供更优质的服务！</p>
                <div class="split flex justify center">
                    <div class="form-list flex center">
                        <div class="form-box">
                            <input type="text" placeholder="姓名" class="input-text" id="username">
                        </div>
                    </div>
                    <div class="form-radio">
                        <ul class="flex center justify" id="sex">
                            <li class="active flex center"><span></span>先生</li>
                            <li class="flex center"><span></span>女士</li>
                        </ul>
                    </div>
                </div>
                <div class="form-list flex center special">
                    <div class="form-box">
                        <input type="text" placeholder="手机号码" class="input-text" id="iphone">
                    </div>
                </div>
                <div class="question-list radio">
                    <p>您在旅行中对路虎驾驶体验的感受？</p>
                    <div class="option flex center justify flow">
                        <div class="form-checkbox">很满意</div>
                        <div class="form-checkbox">满意</div>
                        <div class="form-checkbox">一般</div>
                        <div class="form-checkbox">不满意</div>
                    </div>
                </div>
                <div class="question-list">
                    <p>若您有购买或置换新车的计划，您会对路虎的哪一款车型感兴趣？(多选)？</p>
                    <div class="option flex center justify flow">
                        <div class="form-checkbox">揽胜</div>
                        <div class="form-checkbox">揽胜运动版</div>
                        <div class="form-checkbox">揽胜星脉</div>
                        <div class="form-checkbox">揽胜极光</div>
                        <div class="form-checkbox">发现</div>
                        <div class="form-checkbox">发现神行</div>
                    </div>
                </div>
                <div class="question-list">
                    <p class="p-bottom">今后若路虎经销商希望继续与您保持联系，您的意向经销商是？</p>
                    <div class="split flex justify center">
                        <div class="form-list flex center prohibit">
                            <div class="form-box opt">
                                <span>省</span>
                                <select name="province">
                                </select>
                            </div>
                        </div>
                        <div class="form-list flex center prohibit">
                            <div class="form-box opt">
                                <span>市</span>
                                <select name="city">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-list flex center prohibit">
                        <div class="form-box opt">
                            <span>选择经销商</span>
                            <select name="dealer">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="question-list oneline radio">
                    <p>您是通过什么渠道了解到松赞？<span class="must">(必填)</span></p>
                    <div class="option flex center justify flow">
                        <div class="form-checkbox">松赞官方平台（微信、员工、网站）</div>
                        <div class="form-checkbox">通过朋友推荐</div>
                        <div class="form-checkbox">第三方线上平台<br/>
                            （携程、Agoda、Booking、飞猪等）</div>
                    </div>
                    <div class="form-list flex center special">
                        <div class="form-box">
                            <input type="text" placeholder="其他渠道" class="input-text" id="others">
                        </div>
                    </div>
                </div>
                <div class="question-list">
                    <p class="p-bottom">您觉得整个活动还有哪些地方可以改善？您对整个活动还有什么建议或意见吗？</p>
                    <div class="form-list flex center special">
                        <div class="form-box">
                            <textarea class="input-textarea"></textarea>
                        </div>
                    </div>
                </div>
                <div class="link-list">
                    <a onclick="cc('center/tj')" href="javascript:;">
                        <input type="hidden" id="uid" name="uid" value="<?= $uid; ?>">
                        <div class="btn flex center jc">提交<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i><input type="sub" class="input-sub input-ps" id="sub"></div>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <audio id="music" src="<?= STATIC_ASSETS ?>images/mg.mp3" loop="loop" autoplay="autoplay" class="hide"></audio>
    <div class="music-btn"><div class="music-icon flex center active"><i><img src="<?= STATIC_ASSETS ?>images/icon-45.png" alt=""></i></div></div>
</div>
<script src="<?= STATIC_ASSETS ?>js/dealer.js"></script>
<script>
    $(function () {
        //页面切换
        $('.page2').on('click',function () {
            $('.route-page').removeClass('hide').siblings('.page').addClass('hide');
            $('html,body').animate({scrollTop: 0}, 0);
        });
        $('.page3').on('click',function () {
            $('.find-gift-page').removeClass('hide').siblings('.page').addClass('hide');
            $('html,body').animate({scrollTop: 0}, 0);
        });
        $('.page4').on('click',function () {
            $('.feedback-page').removeClass('hide').siblings('.page').addClass('hide');
            $('html,body').animate({scrollTop: 0}, 0);
        });
        $('.route-page .return').on('click',function () {
            $('.default-page').removeClass('hide').siblings('.page').addClass('hide');
            $('html,body').animate({scrollTop: 0}, 0);
        });
    })
    $(function() {
        //三级级联：指定select的name即可
        dealer.dealerLinkage('province', 'city', 'dealer')
    });
    $(function(){
        $('#sub').click(function(){
            var username = $('#username').val();
            var iphone = $('#iphone').val();
            var sex = $('#sex').find('li.active').text();
            var city = $('.form-box.opt').find('span').text();
            var opinion = $('.form-checkbox.active').text();
            var others = $('#others').val();
            var textare = $('.input-textarea').val();
            var uid = $('#uid').val();
            console.log(username,sex,iphone,opinion,city,others,textare);
            if(username == '') {
                alert('用户名不能为空');
                return false;
            } else if(iphone == '') {
                alert('手机号不能为空');
                return false;
            } else if(opinion == '') {
                alert('必填项必须选择填写');
                return false;
            }
            $.ajax({
                type:'post',
                url:'<?php echo site_url('User', 'feedback'); ?>',
                data:{username:username, iphone: iphone, sex:sex, city:city, opinion:opinion, others:others, textare:textare, uid:uid},
                cache:false,
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
