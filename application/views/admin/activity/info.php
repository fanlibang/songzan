<h2 class="contentTitle">重置添加菜单</h2>
<form action="<?php echo site_url($controller, $method); ?>" method="post" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
<div class="pageContent">
	<div class="pageFormContent" layoutH="97">
        <div class="unit">
            <label>结束时间：</label>
            <input type="text" name="time" class="date" dateFmt="yyyy-MM-dd HH:mm:ss" class="required"
                   value="<?= isset($time) ? $time : NOW_DATE_TIME?>" readonly="true"/><a
                class="inputDateButton" href="javascript:;">选择</a>
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