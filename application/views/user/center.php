<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content bg-3 info-page">
        <div>
            <div class="form-tit ta-c">我的主页<div class="actrule">活动规则</div></div>
            <div class="form auto">
                <div class="referee-tit flex center justify">
                    <span>个人信息</span>
                    <?php if(empty($card_number) || empty($card_number))  { ?>
                        <div class="perfect"><i><img src="<?= STATIC_ASSETS ?>images/icon-5.png" alt=""></i>完善信息</div>
                    <?php }?>
                </div>
                <div class="form-list flex center">
                    <label>姓名：</label>
                    <div class="form-box">
                        <div class="input-text" ><?= $name ?></div>
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>手机号：</label>
                    <div class="form-box">
                        <div class="input-text" ><?= $phone ?></div>
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>身份证：</label>
                    <div class="form-box">
                        <div class="input-text" ><?= $card_number ?></div>
                    </div>
                </div>
                <div class="form-list flex center no-border">
                    <label>行驶证：</label>
                    <div class="form-box">
                        <div class="input-text" ><?= $driver_number ?></div>
                    </div>
                </div>
                <div class="referee-tit flex center justify">
                    <span>活动信息</span>
                </div>
                <div class="form-list flex center opt state rotate">
                    <label>被推荐人状态：</label>
                    <div class="form-box">
                        <span>已注册</span>
                    </div>
                </div>
                <div class="form-list flex center opt rotate">
                    <label>邀请码：</label>
                    <div class="form-box">
                        <span><a href="<?=site_url('Invite', 'info')?>"><?= $invite_code ?></a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>