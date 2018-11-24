<div class="wrapper">
    <div class="layout">
        <div class="logo flex center">
            <i><img src="<?= STATIC_ASSETS ?>images/logo1.png" alt=""></i>
            <i><img src="<?= STATIC_ASSETS ?>images/logo2.png" alt=""></i>
        </div>
        <div class="act-img-box">
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/route-02.jpg" alt=""></div>
            <div class="img-list">
                <img src="<?= STATIC_ASSETS ?>images/route-03.jpg" alt="">
                <div class="details-btn first"><a href="https://mp.weixin.qq.com/s/Y-x9DX-O-z43buSvz5t1Hg"><img src="<?= STATIC_ASSETS ?>images/rote-btn1.png" alt=""></a></div>
            </div>
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/route-04.jpg" alt=""></div>
            <div class="img-list">
                <img src="<?= STATIC_ASSETS ?>images/route-05.jpg" alt="">
                <div class="details-btn second"><a href="https://mp.weixin.qq.com/s/3cTbRt1Bs8S1DEqKKLaiaA"><img src="<?= STATIC_ASSETS ?>images/rote-btn1.png" alt=""></a></div>
            </div>
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/route-06.jpg" alt=""></div>
            <div class="img-list">
                <img src="<?= STATIC_ASSETS ?>images/route-07.jpg" alt="">
                <div class="details-btn third"><a href="https://mp.weixin.qq.com/s/6v5ovAoOj2BQKH0R0zl4og"><img src="<?= STATIC_ASSETS ?>images/rote-btn1.png" alt=""></a></div>
                <div class="return others-btn">
                    <a href="javascript:history.back(-1);">
                        <div class="btn flex center jc">返回<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        wx.config({
            debug: false,
            appId: "<?= $wx['appId']; ?>",
            timestamp: "<?= $wx['timestamp']; ?>",
            nonceStr: "<?= $wx['nonceStr']; ?>",
            signature: "<?= $wx['signature']; ?>",
            jsApiList: [
                'getLocation',
                "onMenuShareTimeline",
                "onMenuShareAppMessage",
                "onMenuShareQQ",
                "onMenuShareWeibo",
                "onMenuShareQZone"
            ]
        });

        wx.ready(function () {
            <!--通过ready接口处理成功验证-->
            // 在这里调用 API
            <!--通过checkJsApi判断当前客户端版本是否支持指定获取地理位置-->
            wx.checkJsApi({
                jsApiList: [
                    "onMenuShareTimeline",
                    "onMenuShareAppMessage",
                    "onMenuShareQQ",
                    "onMenuShareWeibo",
                    "onMenuShareQZone",
                    'getLocation'
                ],
                success: function (res) {
                    if (res.checkResult.getLocation == false) {
                        alert('你的微信版本太低，不支持微信JS接口，请升级到最新的微信版本！');
                        return;
                    }
                }
            });

            <!--使用getLocation接口获取地理位置坐标-->
            wx.getLocation({
                success: function (res) {
                    var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                    var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                    var speed = res.speed; // 速度，以米/每秒计
                    var accuracy = res.accuracy; // 位置精度
                    //alert('纬度位置：'+latitude+'经度位置：'+longitude+'aaa'+accuracy);//弹出经纬度，就这样就获取到了用户的位置
                    $.ajax({
                        type:'post',
                        url:'<?php echo site_url('Publics', 'getLocation'); ?>',
                        data:{lat: latitude, lng:longitude},
                        cache:false,
                        dataType:'json',
                        success:function(json){
                            if(json.code == 200){
                                $("#province").text(json.msg.province);
                                $("#district").text(json.msg.district);
                                $("#weather").text(json.msg.type);
                            } else {
                                alert(json.msg);
                            }
                        },
                        error:function(){}
                    });
                },
                cancel: function (res) {
                    alert('用户拒绝授权获取地理位置');
                }
            });



            var data = {
                title: '发现隐秘之门', // 分享标题
                link: "<?php echo isset($wx_url) ? $wx_url : site_url('index', 'index'); ?>", // 分享链接
                desc:'路虎发现与松赞文旅邀您角逐最具号召力体验官，获取神秘大礼。',
                imgUrl: "<?= HTTP_HOST ?>/2018/l462/songzan/assets/images/123.jpg", // 分享图标
                success: function () {
                    //alert('操作成功');
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            };
            //分享Demo
            //获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
            wx.onMenuShareTimeline(data);
            //获取“分享给朋友”按钮点击状态及自定义分享内容接口
            wx.onMenuShareAppMessage(data);
            //获取“分享到QQ”按钮点击状态及自定义分享内容接口
            wx.onMenuShareQQ(data);
            //获取“分享到腾讯微博”按钮点击状态及自定义分享内容接口
            wx.onMenuShareWeibo(data);
            //获取“分享到QQ空间”按钮点击状态及自定义分享内容接口
            wx.onMenuShareQZone(data);
        });
    });
</script>
