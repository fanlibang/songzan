<div class="wrapper">
    <div class="layout">
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
            <?php if($type == 1) { ?>
                <div class="activity3-btn auto find-btn">
                    <a href="<?php echo site_url('User', 'register', ['type' => $type]); ?>">
                        <div class="btn flex center jc">藏地体验官-发现日记<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                    </a>
                </div>
            <?php } else { ?>
                <div class="flex justify group-btnsm2 auto">
                    <a href="<?php echo site_url('User', 'travel', ['type' => $type]); ?>">
                        <div class="btn btnsm flex center jc">发现隐秘旅程<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                    </a>
                    <a href="<?php echo site_url('User', 'center', ['type' => $type]); ?>">
                        <div class="btn btnsm flex center jc">开启探索之旅<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                    </a>
                </div>
            <?php }?>
        </div>
    </div>
</div>