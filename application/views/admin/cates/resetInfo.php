<h2 class="contentTitle">重置菜单信息</h2>
<form action="<?php echo site_url($controller, $method); ?>" method="post" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
<div class="pageContent">
	<div class="pageFormContent" layoutH="97">
        <div class="unit">
            <label>id：</label>
            <input type="text" name="id" size="25" class="textInput">
            <span class="inputInfo">菜单编号</span>
		</div>
        <div class="unit">
            <label>pid：</label>
            <input type="text" name="pid" size="25" class="textInput">
            <span class="inputInfo">菜单父级编号</span>
        </div>
        <div class="unit">
            <label>left：</label>
            <input type="text" name="left_value" size="25" class="textInput">
            <span class="inputInfo">菜单左值</span>
        </div>
        <div class="unit">
            <label>rigth：</label>
            <input type="text" name="right_value" size="25" class="textInput">
            <span class="inputInfo">菜单右值</span>
        </div>
	</div>
	<div class="formBar">
		<ul>
			<li><div class="buttonActive"><div class="buttonContent"><button type="submit">确认</button></div></div></li>
		</ul>
	</div>
</div>
</form>