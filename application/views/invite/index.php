<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content bg-3 ">
        <div>
            <div class="form-tit ta-c"><img src="<?= STATIC_ASSETS ?>images/tit-2.png" alt=""></div>
            <div class="form auto">
                <div class="form-list flex center">
                    <label>*姓名：</label>
                    <div class="form-box">
                        <input type="text" class="input-text">
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>*手机号：</label>
                    <div class="form-box">
                        <input type="tel" class="input-text">
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>*验证码：</label>
                    <div class="form-box">
                        <input type="text" class="input-text">
                    </div>
                    <input type="button" value="发送验证码" class="sendbtn">
                </div>
                <div class="form-list flex center opt">
                    <label>意向车型：</label>
                    <div class="form-box">
                        <span></span>
                        <select>
                            <option>意向车型</option>
                            <option>意向车型12</option>
                        </select>
                    </div>
                </div>
                <div class="form-list flex center disabled">
                    <label>*推荐码：</label>
                    <div class="form-box">
                        <input type="text" name="invite_code" class="input-text ta-r" value="<?php echo $invite_code; ?>" disabled="disabled">
                    </div>
                </div>
                <div class="flex justify">
                    <div class="form-checkbox active">
                        我已同意保密条款和<a href="javascript:;" class="item">隐私政策</a>
                    </div>
                    <div class="form-tip">标*为必填</div>
                </div>
                <div class="form-push">
                    <input type="button" value="提     交" class="btn auto">
                </div>
            </div>
        </div>
    </div>
</div>