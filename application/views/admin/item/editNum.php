<h2 class="contentTitle">资料查看</h2>
<form action="<?php echo site_url($controller, $method); ?>" method="post" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
    <div class="pageContent">
        <div class="pageFormContent" layoutH="97">
            <h2 class="contentTitle">基本信息</h2>
            <div class="unit">
                <label>名称：</label>
                <span class="inputInfo mgs" style=""><?= '礼品'.$item_id ?></span>
            </div>
            <div class="unit">
                <label>库存：</label>
                <input name="num" value="<?= isset($num) ? $num : '';?>" type="text"/>
            </div>
        </div>
        <div class="formBar">
            <ul>
                <input type="hidden" id="id" name="id" value="<?= $id; ?>" >
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button class="close" type="button">取消</button></div></div></li>
            </ul>
        </div>
    </div>
</form>
