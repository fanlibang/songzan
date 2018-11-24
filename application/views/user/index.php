<div class="wrapper">
    <div class="layout">
        <div class="logo flex center">
            <i><img src="<?= STATIC_ASSETS ?>images/logo1.png" alt=""></i>
            <i><img src="<?= STATIC_ASSETS ?>images/logo2.png" alt=""></i>
        </div>
        <div class="activity3 act-img-box">
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/3-act-02.jpg" alt=""></div>
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/3-act-03.jpg" alt=""></div>
            <div class="img-list"><img src="<?= STATIC_ASSETS ?>images/3-act-04.jpg" alt=""></div>
        </div>
        <?php if($type == 1) { ?>
        <div class="act-link-box">
            <div class="activity3-btn auto find-btn">
                <a href="<?php echo site_url('Diary', 'index', ['type' => $type]); ?>">
                    <div class="btn flex center jc">藏地体验官-发现日记<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                </a>
            </div>
            <div class="slide-txt ta-c">
                <p>下滑发现更多</p>
                <div class="auto"><img src="<?= STATIC_ASSETS ?>images/icon-2.png" alt=""></div>
            </div>
            <div class="flex justify group-btnsm2 auto">
                <a href="<?php echo site_url('User', 'travel', ['type' => $type]); ?>">
                    <div class="btn btnsm flex center jc">发现隐秘旅程<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                </a>
                <a href="<?php echo site_url('User', 'travel', ['type' => $type]); ?>">
                    <div class="btn btnsm flex center jc">开启探索之旅<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                </a>
            </div>
        </div>
        <?php } elseif($type == 2) { ?>
        <div class="act-link-box">
            <div class="slide-txt ta-c">
                <p>下滑发现更多</p>
                <div class="auto"><img src="<?= STATIC_ASSETS ?>images/icon-2.png" alt=""></div>
            </div>
        </div>
        <?php } elseif($type == 3) { ?>
            <div class="act-link-box">
                <div class="others-btn">
                    <a href="<?php echo site_url('User', 'activity', ['type' => 3]); ?>">
                        <div class="btn flex center jc auto">发现大礼<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                    </a>
                </div>
            </div>
            <div class="act-new-find find-end">
                <div class="tit">
                    革命性设计，巧妙多功能性，<br/>
                    以及与生俱来的路虎全地形能力
                </div>
                <div class="link">
                    <a href="https://www.landrover.com.cn/vehicles/discovery/index.html">了解路虎新款发现</a>
                </div>
                <div class="link">
                    <a href="http://www.songtsam.com/">了解松赞文旅</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script>
    $(function () {
        var startx, starty;//获得角度
        function getAngle(angx, angy) {
            return Math.atan2(angy, angx) * 180 / Math.PI;
        };//根据起点终点返回方向 1向上 2向下 3向左 4向右 0未滑动
        function getDirection(startx, starty, endx, endy) {
            var angx = endx - startx;
            var angy = endy - starty;
            var result = 0;
            if (Math.abs(angx) < 2 && Math.abs(angy) < 2) {
                return result;
            }
            var angle = getAngle(angx, angy);
            if (angle >= -100 && angle <= -45) {
                result = 1;
            }
            return result;
        }
        $(window).scroll(function(){
            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                //手指接触屏幕
                document.addEventListener("touchstart", function(e) {
                    startx = e.touches[0].pageX;
                    starty = e.touches[0].pageY;
                }, false);
                //手指离开屏幕
                document.addEventListener("touchend", function(e) {
                    var endx, endy;
                    endx = e.changedTouches[0].pageX;
                    endy = e.changedTouches[0].pageY;
                    var direction = getDirection(startx, starty, endx, endy);
                    if(direction == 1){
                        window.location.href = "<?php echo site_url('User', 'activity', ['type' => $type]); ?>";
                    }
                }, false);
            }
        });
    })
</script>