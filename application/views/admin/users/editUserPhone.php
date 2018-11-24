<h2 class="contentTitle">手机验证</h2>
<form action="<?php echo site_url($controller, 'phoneSmsBind'); ?>" method="post" class="pageForm required-validate" onsubmit="return validateCallback(this, <?php echo $info['tel'] ? 'dialogAjaxDone' : 'dialogAjaxDoneRedirect'; ?>)">
<div class="pageContent">
	<div class="pageFormContent" layoutH="97">
        <div class="unit">
            <label>联系电话：</label>
            <input type="hidden" name="old_tel" class="_old_sms_tel" value="<?php echo $info['tel'];?>">
            <input type="text" name="tel" size="25" class="phone textInput valid required _sms_tel" value="<?php echo $info['tel'];?>">
            <span class="inputInfo">联系使用</span>
        </div>
        <div class="unit">
            <label>短信密码：</label>
            <input type="text" name="sms_code" size="25" class="textInput valid required" value="">
            <span class="inputInfo">验证使用</span>
        </div>
	</div>
	<div class="formBar">
		<ul>
            <li><div class="button"><div class="buttonContent"><button class="_sms_verify" type="button">请求验证短信<font></font></button></div></div></li>
			<li><div class="buttonActive"><div class="buttonContent"><button type="submit"><?php echo $info['tel'] ? '切换绑定' : '绑定手机'; ?></button></div></div></li>
		</ul>
	</div>
</div>
</form>
<script type="text/javascript">
    function dialogAjaxDoneRedirect(json){
        DWZ.ajaxDone(json);
        if (json.statusCode == DWZ.statusCode.ok){
            setTimeout(function(){
                window.location.href = '<?php echo site_url('Index', 'index') ?>';
            },3000);
        }
    }
</script>