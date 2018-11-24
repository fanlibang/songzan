<div class="wrapper">
    <div class="layout bg-opinion">
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
                        <input type="text" placeholder="手机号码" class="input-text" id="iphone" value="">
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
                    <a href="javascript:;">
                        <input type="hidden" id="uid" name="uid" value="<?= $uid; ?>">
                        <div class="btn flex center jc">提交<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i><input type="" class="input-sub input-ps" id="sub"></div>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= STATIC_ASSETS ?>js/dealer.js"></script>
<script src="https://cdn.bootcss.com/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link href="https://cdn.bootcss.com/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet">
<script type="text/javascript">
    $(function() {
        //三级级联：指定select的name即可
        dealer.dealerLinkage('province', 'city', 'dealer')

        //时间选择：只能选今天或以后

        $("#date").datepicker({
            minDate: 0,
            dateFormat: "yy-mm-dd"
        });
        // $('#date').attr('min', new Date().toLocaleDateString().replace(/\//g, '-'))

        //获取选项的文本和值
        $('#submit').click(function() {
            var pro = $('select[name=province]').val()
            var city = $('select[name=city]').val()
            var code = $('select[name=dealer] option:selected').val()
            var name = $('select[name=dealer] option:selected').text()

            alert('省份:' + pro + '，城市:' + city + '，名称:' + name + '，代码:' + code)
        })
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