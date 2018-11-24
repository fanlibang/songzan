<style type="text/css">
    .data-input .input-text{ position: absolute;top: 0;left: 0;width: 100%;height: 100%;opacity: 0;}
</style>
<audio id="music" src="<?= STATIC_ASSETS ?>images/mg.mp3" loop="loop" autoplay="autoplay" class="hide"></audio>
<div class="music-btn"><div class="music-icon flex center active"><i><img src="<?= STATIC_ASSETS ?>images/icon-45.png" alt=""></i></div></div>
<div class="wrapper">
    <div class="layout bg-haveinfo">
        <div class="logo flex center">
            <i><img src="<?= STATIC_ASSETS ?>images/logo1.png" alt=""></i>
            <i><img src="<?= STATIC_ASSETS ?>images/logo2.png" alt=""></i>
        </div>
        <div class="form flex jc auto">
            <form action="<?php echo site_url('User', 'login', ['type' => $type]); ?>">
                <div class="split flex justify center">
                    <div class="form-list flex center">
                        <i><img src="<?= STATIC_ASSETS ?>images/icon-5.png" alt=""></i>
                        <div class="form-box">
                            <input type="text" placeholder="姓名" id="name" name="name" value="" class="input-text">
                        </div>
                    </div>
                    <div class="form-radio">
                        <ul class="flex center justify " id="sex">
                            <li class="flex center active"><span></span>先生</li>
                            <li class="flex center"><span></span>女士</li>
                        </ul>
                    </div>
                </div>

                <div class="form-list flex center special">
                    <i><img src="<?= STATIC_ASSETS ?>images/icon-6.png" alt=""></i>
                    <div class="form-box">
                        <input type="text" placeholder="手机号码" id="iphone" name="iphone" class="input-text">
                    </div>
                </div>
                <div class="split flex justify center">
                    <div class="form-list flex center">
                        <i><img src="<?= STATIC_ASSETS ?>images/icon-7.png" alt=""></i>
                        <div class="form-box">
                            <input type="text" placeholder="验证码" id="code" name="code" class="input-text">
                        </div>
                    </div>
                    <div class="form-list flex center send-code">
                        <div class="form-box">
                            <input type="button" value="发送验证码" class="input-text _sms_verify">
                        </div>
                    </div>
                </div>

                <div class="dis-box">
                    <div class="check-tit">到当地经销商参与试乘试驾活动，获得神秘大礼</div>
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
                        <i><img src="<?= STATIC_ASSETS ?>images/icon-29.png" alt=""></i>
                        <div class="form-box opt">
                            <span>选择经销商?</span>
                            <select name="dealer" id="merchants">
                            </select>
                        </div>
                    </div>
                    <div class="form-list flex center prohibit">
                        <i><img src="<?= STATIC_ASSETS ?>images/icon-8.png" alt=""></i>
                        <div class="form-box opt">
                            <span>您感兴趣的路虎车型?</span>
                            <select name="car" id="car">
				                <option>感兴趣的路虎车型</option>
                                <option value="LRRR" data-id="14"   >揽胜</option>
                                <option value="LRRS" data-id="13"   >揽胜运动版</option>
                                <option value="L560" data-id="12"   >揽胜星脉</option>
                                <option value="LREVCN" data-id="11" >揽胜极光</option>
                                <option value="L462" data-id="15"   >发现</option>
                                <option value="LRDSCN" data-id="16" >发现神行</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="dis-box <?= isset($type) && $type == 1 ? 'hide' : ''; ?>">
                    <div class="form-checkbox active cause-dis">是否有意向参加自驾游？</div>
                    <div class="form-list flex center prohibit">
                        <i><img src="<?= STATIC_ASSETS ?>images/icon-12.png" alt=""></i>
                        <div class="form-box opt">
                            <span>倾向的路线</span>
                            <select name="line" id="line">
				                <option >倾向的路线</option>
                                <option value="自驾路线A：探索三江并流（9天8晚）">自驾路线A：探索三江并流（9天8晚）</option>
                                <option value="自驾路线B：寻访天人之际（6天5晚）">自驾路线B：寻访天人之际（6天5晚）</option>
                                <option value="自驾路线C：寻找珍贵的风物（6天5晚）">自驾路线C：寻找珍贵的风物（6天5晚）</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-list flex center prohibit data-input">
                        <i><img src="<?= STATIC_ASSETS ?>images/icon-13.png" alt=""></i>
                        <div class="form-box opt">
                            <span>出行时间</span>
                            <input type="date" id="date" class="input-text">
                        </div>
                    </div>
                    <div class="form-list flex center prohibit">
                        <i><img src="<?= STATIC_ASSETS ?>images/icon-14.png" alt=""></i>
                        <div class="form-box">
                            <input type="text" placeholder="推荐码" id="recommend" class="input-text">
                        </div>
                    </div>

                </div>

                <div class="form-checkbox active succ" id="succ">
                    <!--<p>我希望XXXXXXXXXXXXXXXXXXXX公司在将来提供其他的市场活动信息</p>-->
                    <p class="already-read">我已阅读并接受<a onclick="cc('register/ys')" href="https://www.landrover.com.cn/cookie-and-privacy-policy.html?_ga=2.132171144.708087012.1540618393-1239989606.1540618393" class="item">隐私政策</a></p>
                </div>
                <div class="form-push flex center jc" id="try">
                    <div class="flex justify group-btnsm2 auto">
                        <a href="javascript:;">
                            <div class="btn btnsm flex center jc" onclick="cc('register/cz')" >重置<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i><input type="reset" class="input-reset input-ps"></div>
                        </a>
                        <a href="javascript:;" id="sub">
                            <input type="hidden" id="uid" name="uid" value="<?= $uid; ?>">
                            <input type="hidden" id="type" name="type" value="<?= $type; ?>">
                            <div class="btn btnsm flex center jc">提交<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i><input onclick="cc('register/tj')" type="" class="input-sub input-ps"></div>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <audio id="music" src="<?= STATIC_ASSETS ?>images/mg.mp3" loop="loop" class="hide"></audio>
    <div class="music-btn"><div class="music-icon flex center active"><i><img src="<?= STATIC_ASSETS ?>images/icon-45.png" alt=""></i></div></div>
</div>
<script src="<?= STATIC_ASSETS ?>js/dealer.js"></script>
<script src="<?= STATIC_ASSETS ?>js/sendSMS.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('.input-reset').on('click', function () {
            $('html,body').animate({scrollTop: '0'}, 0);
        });
        //三级级联：指定select的name即可
        dealer.dealerLinkage('province', 'city', 'dealer')

        //时间选择：只能选今天或以后

        /*var date = new Date();
         var newyear = date.getFullYear();
         var newmonth = date.getMonth() + 1;
         var newday = date.getDate();
         newmonth = (newmonth<10 ? "0"+newmonth:newmonth);
         newday = (newday<10 ? "0"+newday:newday);
         var newdate = newyear+ "-" + newmonth + "-" + newday;

         $('#date').click(function(){
         $(this).attr("min",newdate)
         // })*/

        var now = new Date();
        $('.data-input').change(function () {
            var nowData = $(this).find('input').val();
            var nData = now.getFullYear()+"-" + (now.getMonth()+1) + "-" + now.getDate();
            if (nowData < nData){
                $(this).find('span').text(nData);
                alert("时间不能够小于今天");
            }else{
                $(this).find('span').html(nowData);
            }
        });



        //获取选项的文本和值
        $('#submit').click(function() {
            var pro = $('select[name=province]').val()
            var city = $('select[name=city]').val()
            var code = $('select[name=dealer] option:selected').val()
            var name = $('select[name=dealer] option:selected').text()

            alert('省份:' + pro + '，城市:' + city + '，名称:' + name + '，代码:' + _sms_verify)
        })
    });

    $(function(){
        $('#sub').click(function(){
            var sex = $('#sex').find('li.active').text();
            var iphone = $('#iphone').val();
            var name = $('#name').val();
            var code = $('#code').val();
            var pro = $('select[name=province]').val()
            var city = $('select[name=city]').val()
            //var merchants  = $('#merchants').val();
            var merchants  = $('#merchants option:selected').text();
            var car_code = $('#car option:selected').val();
            var car_id = $('#car option:selected').attr('data-id');
            var line = $('#line').val();
            var time = $('#date').val();
            var recommend = $('#recommend').val();
            var uid = $('#uid').val();
            var type = $('#type').val();
            var succ = $('.succ.active').text();
            console.log(car_id, car_code, merchants);
            if(iphone == '') {
                alert('手机号不能为空'); return false;
            } else if(code == '') {
                alert('验证码不能为空');
                return false;
            } else if(name == '') {
                alert('用户名不能为空');
                return false;
            } else if(succ == '') {
                alert('请选择隐私政策'); return false;
            } else if(merchants == '') {
                //alert(merchants);
                alert('请选择经销商');
                return false;
            } else if(car_code == '') {
                alert('请选择车型'); return false;
            }
            $.ajax({
                type:'post',
                url:'<?php echo site_url('User', 'login'); ?>',
                data:{sex:sex, iphone: iphone, name:name, code:code, province:pro, city:city, merchants:merchants, car_id:car_id, car_code:car_code, line:line, time:time, recommend:recommend, uid:uid, type:type},
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
