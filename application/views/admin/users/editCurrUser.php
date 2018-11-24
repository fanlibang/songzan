<h2 class="contentTitle">修改信息</h2>
<form action="<?php echo site_url($controller, $method); ?>" method="post" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
<div class="pageContent">
	<div class="pageFormContent" layoutH="97">
        <div class="unit">
            <label>新密码：</label>
            <input type="password" name="newpassword" size="25" class="textInput">
            <span class="inputInfo">要修改的密码</span>
        </div>
        <div class="unit">
            <label>确认密码：</label>
            <input type="password" name="repassword" size="25" class="textInput">
            <span class="inputInfo">确认要修改的密码</span>
        </div>
        <div class="unit">
            <label>邮箱：</label>
            <input type="text" name="email" size="25" class="email textInput valid required" value="<?php echo $info['email'];?>">
            <span class="inputInfo">联系使用</span>
        </div>
        <div class="unit" style="display: none">
            <label>联系电话：</label>
            <input type="text" name="tel" size="25" class="phone textInput valid" value="<?php echo $info['tel'];?>">
            <span class="inputInfo">联系使用</span>
        </div>
	</div>
	<div class="formBar">
		<ul>
			<li><div class="buttonActive"><div class="buttonContent"><button type="submit">确认</button></div></div></li>
			<li><div class="button"><div class="buttonContent"><button class="close" type="button">关闭</button></div></div></li>
		</ul>
	</div>
</div>
</form>