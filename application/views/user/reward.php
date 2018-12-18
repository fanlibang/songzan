<script type="text/javascript">
    $(function () {
        $('.courtesy-item').on('click',function () {
            $(this).addClass('active').siblings().removeClass('active');
        })
    })
</script>
<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content flex center jc">
        <div class="new-inner">
            <div class="new-title ta-c">
                选择专属礼遇
            </div>
            <div class="courtesy flex justify flow">
                <div class="courtesy-item active" url="<?= site_url('User', 'site', array('type'=> 1)); ?>">
                    <div class="courtesy-nr">
                        <img src="<?= STATIC_ASSETS ?>images/new-06.png" alt="">
                    </div>
                    <div class="courtesy-bt">英伦绅士尊享礼盒</div>
                </div>
                <div class="courtesy-item" url="<?= site_url('User', 'site', array('type'=> 2)) ?>">
                    <div class="courtesy-nr">
                        <img src="<?= STATIC_ASSETS ?>images/new-07.png" alt="">
                    </div>
                    <div class="courtesy-bt">英伦女士尊享礼盒</div>
                </div>
                <div class="courtesy-item special" url="<?= site_url('User', 'mgs') ?>">
                    <div class="courtesy-nr">
                        <img src="<?= STATIC_ASSETS ?>images/new-08.png" alt="">
                    </div>
                    <div class="courtesy-bt">
                        整车尊护4年/13万公里延保服务
                        <p>
                            *仅限车龄32个月内（含）且行驶里程<br>
                            低于9.5万公里路虎车辆
                        </p>
                    </div>
                </div>
            </div>
            <div class="ta-c">
                <input type="button" value="提  交" class="btn auto" id="sub">
            </div>
        </div>
    </div>
</div>

<script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript"></script>
<script type="text/javascript">
    document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        // 通过下面这个API隐藏右上角按钮
        WeixinJSBridge.call('hideOptionMenu');
    });

    //完善信息
    $('#sub').on('click',function () {
        var url        = $('.courtesy-item.active').attr('url');
        window.location.href=url;
    });
</script>