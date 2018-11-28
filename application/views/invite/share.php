<div class="wrapper">
    <div class="logo" style="pointer-events:none;">
        <img src="<?= STATIC_ASSETS ?>images/logo.png" alt="">
    </div>
    <div class="content bg-2 flex center jc" style="pointer-events:none;">
        <div>
            <div class="gift-tit ta-c">
                <div><img src="<?= STATIC_ASSETS ?>images/gift-tit.png" alt=""></div>
                <div class="ta-c ma"><?=$invite_code?></div>
            </div>
            <div class="code">
                <div class="auto"><img width="144px" height="144px" src="<?= $qr_code_img ?>" alt=""></div>
            </div>
        </div>
    </div>
</div>

<div style="position: absolute;top: 0;width: 100%;height: 100%;">
    <img style="width: 100%;height: 100%;opacity: 0;" src="<?=$img_url?>" alt="">
</div>

<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        wx.config({
            debug: false,
            appId: "<?= $wx['appId']; ?>",
            timestamp: "<?= $wx['timestamp']; ?>",
            nonceStr: "<?= $wx['nonceStr']; ?>",
            signature: "<?= $wx['signature']; ?>",
            jsApiList: [
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
                    "onMenuShareQZone"
                ],
                success: function (res) {
                    if (res.checkResult.getLocation == false) {
                        alert('你的微信版本太低，不支持微信JS接口，请升级到最新的微信版本！');
                        return;
                    }
                }
            });



            var data = {
                title: '荐入佳境 共揽胜景', // 分享标题
                link: "<?php echo isset($wx_url) ? $wx_url : site_url('Invite', 'share') . '?invite_code=' . $invite_code; ?>", // 分享链接
                desc:'您的好友正在邀请您参与路虎推荐购活动。',
                imgUrl: "<?= HTTP_HOST ?>/2018/crm/ownerreferral/assets/images/123.jpg", // 分享图标
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