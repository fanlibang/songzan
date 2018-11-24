</html>
</body>
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
    function cc(str){
        var url = "<?php echo site_url('Publics', 'button') ?>" + '?url='+str;
        $.get(url, function(result){
            console.log(result);
        });

    }

    //音乐播放
    if($('#music').length>0){
        audioAutoPlay('music');
    }
    $('.music-icon').on('click', function () {
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $('#music').trigger('play');
        } else {
            $('#music').trigger('pause');
        }
    });
    function audioAutoPlay(id) {
        var audio = document.getElementById(id);
        if (typeof WeixinJSBridge == "object" && typeof WeixinJSBridge.invoke == "function") {
            audio.play();
        } else {
            //監聽客户端抛出事件"WeixinJSBridgeReady"
            if (document.addEventListener) {
                document.addEventListener("WeixinJSBridgeReady", function(){audio.play(); }, false);
            } else if (document.attachEvent) {
                document.attachEvent("WeixinJSBridgeReady", function(){ audio.play(); });
                document.attachEvent("onWeixinJSBridgeReady", function(){ audio.play(); });
            }
        }

        var voiceStatu = true; //监听
        document.addEventListener("touchstart",function(e){
            if(voiceStatu) { audio.play(); voiceStatu = false; }
        }, false);
    }
</script>
