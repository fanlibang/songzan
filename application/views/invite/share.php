<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content bg-2 flex center jc">
        <div style="background-image: <?=$img_url?>;">
            <div class="gift-tit ta-c">
                <div><img style="pointer-events:none;" src="<?= STATIC_ASSETS ?>images/gift-tit.png" alt=""></div>
                <div class="ta-c ma"><?=$invite_code?></div>
            </div>
            <div class="code">
                <div class="auto"><img style="pointer-events:none;" width="144px" height="144px" src="<?= $qr_code_img ?>" alt=""></div>
            </div>
        </div>
    </div>
</div>