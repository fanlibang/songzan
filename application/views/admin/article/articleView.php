<h2 class="contentTitle">文章查看</h2>
<form action="<?php echo site_url($controller, $method); ?>" method="post" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
    <div class="pageContent">
        <div class="pageFormContent" layoutH="97">
            <h2 class="contentTitle">基本信息</h2>
            <div class="unit">
                <label>文章id：</label>
                <span class="inputInfo"><?php echo $id; ?></span>
            </div>
            <div class="unit">
                <label>用户uid：</label>
                <span class="inputInfo"><?php echo $uid; ?></span>
            </div>

            <div class="unit" style="width:80%;">
                <div class="unit">
                    <label>内容：</label>
                </div>
            </div>
            <div class="unit" style="width:80%;">
                <div class="unit"     style="text-align: center;height: auto;">
                    <?php echo isset($html) ? $html : ''; ?>
                </div>
            </div>

        </div>
        <div class="formBar">
            <ul>
                <li><div class="button"><div class="buttonContent"><button class="close" type="button">关闭</button></div></div></li>
            </ul>
        </div>
    </div>
</form>

