<h2 class="contentTitle"><?php echo $method == 'add' ? '添加' : '编辑'; ?>菜单</h2>
<form action="<?php echo site_url($controller, $method); ?>" method="post" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
<div class="pageContent">
	<div class="pageFormContent" layoutH="97">
        <div class="unit">
            <label>菜单名：</label>
            <input name="id" value="<?php echo $info['id']; ?>" type="hidden"/>
            <input type="text" name="title" value="<?php echo $info['title']; ?>" size="25" class="required textInput valid">
            <span class="inputInfo">填写菜单名称</span>
		</div>
        <div class="unit">
            <label>所属菜单：</label>
            <input name="old_pid" type="hidden" value="<?php echo $pinfo['id'] ? $pinfo['id'] : 0; ?>"/>
            <input name="pid" type="hidden" value="<?php echo $pinfo['id'] ? $pinfo['id'] : 0; ?>"/>
            <input type="text" name="parent_cate_name" value="<?php echo $pinfo['title'] ? $pinfo['title'] : '管理中心'; ?>" size="25" class="textInput" readonly="">
            <?php
                if($is_super_admin || $method == 'add'){
            ?>
			<a class="btnLook" target="dialog" width="450" height="500" href="<?php echo site_url($controller, 'pid'); ?>" rel="cate_pid" mask="true">选择父级菜单</a>
            <span class="inputInfo">点击选择父级菜单</span>
            <?php }else{ ?>
            <span class="inputInfo" style="color: #ff0000">暂不支持修改父级菜单</span>
            <?php } ?>
		</div>
        <div class="unit">
            <label>操作模块：</label>
            <input type="text" name="url" value="<?php echo $info['url']; ?>" size="25" class="textInput">
            <span class="inputInfo">父类留空,站外填写http地址</span>
		</div>
        <div class="unit">
            <label>是否显示：</label>
            <select class="combox" name="status">
                <option value="1" <?php echo $info['status'] == 1 ? 'selected' : ''; ?>>隐藏</option>
                <option value="2" <?php echo $info['status'] == 2 ? 'selected' : ''; ?>>显示</option>
                <option value="3" <?php echo $info['status'] == 3 ? 'selected' : ''; ?>>菜单列表不可见</option>
            </select>
            <span class="inputInfo">是否显示在左侧菜单栏</span>
		</div>
        <div class="unit">
            <label>排序值：</label>
            <input type="text" name="rank" value="<?php echo $info['rank'] ? $info['rank'] : 0; ?>" size="5" class="required textInput valid">
            <span class="inputInfo">注：值越大越靠后</span>
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