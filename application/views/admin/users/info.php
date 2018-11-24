<h2 class="contentTitle"><?php echo $method == 'add' ? '添加' : '编辑'; ?>管理员</h2>
<form action="<?php echo site_url($controller, $method); ?>" method="post" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
<div class="pageContent">
	<div class="pageFormContent" layoutH="97">
        <div class="unit">
            <label>状态：</label>
            <select class="combox" name="status">
                <option value="1" <?php echo $info['status'] == 1 ? 'selected' : ''; ?>>禁用</option>
                <option value="2" <?php echo $info['status'] == 2 ? 'selected' : ''; ?>>启用</option>
            </select>
            <span class="inputInfo">账号状态</span>
        </div>
        <div class="unit">
            <label>用户名：</label>
            <?php if($is_super_admin || $method == 'add'){?>
                <input type="text" name="user_name" size="25" value="<?php echo $info['username'];?>" class="required textInput valid"/>
                <span class="inputInfo">请填写登录账号</span>
            <?php }else{?>
                <?php echo $info['username'];?>
            <?php }?>
            <input type="hidden" name="id" value="<?php echo $info['id'];?>">
        </div>
        <?php if($method == 'edit'){?>
            <div class="unit">
                <label>新密码：</label>
                <input type="password" name="newpassword" size="25" class="textInput">
                <span class="inputInfo">要修改的密码</span>
            </div>
        <?php }else{ ?>
            <div class="unit">
                <label>密&nbsp;&nbsp;&nbsp;码：</label>
                <input type="password" name="password" size="25" class="textInput">
                <span class="inputInfo">登录密码</span>
            </div>
        <?php } ?>
        <div class="unit">
            <label>确认密码：</label>
            <input type="password" name="repassword" size="25" class="textInput">
            <span class="inputInfo">确认要修改的密码</span>
        </div>
        <div class="unit">
            <label>权限组：</label>
            <input name="role_ids" type="hidden" value="<?php echo $role_ids;?>"/>
            <textarea rows="4" cols="45" class="textInput" name="role_names"  readonly=""><?php echo $role_names;?></textarea>
            <a class="btnLook" target="dialog" href="<?php echo site_url('Roles', 'setRoles', array('dialog_rel' =>'set_roles', 'parent_rel' => 'add_user', 'set_type' => 'select')); ?>" rel="set_roles"  mask="true">选择所属权限组</a>
            <span class="inputInfo">请选择权限组</span>
        </div>
        <div class="unit">
            <label>邮箱：</label>
            <input type="text" name="email" size="25" class="email textInput valid required" value="<?php echo $info['email'];?>">
            <span class="inputInfo">联系使用</span>
        </div>
        <?php if($is_super_admin){ ?>
        <div class="unit">
            <label>联系电话：</label>
            <input type="text" name="tel" size="25" class="phone textInput valid" value="<?php echo $info['tel'];?>">
            <span class="inputInfo">联系使用</span>
        </div>
        <?php } ?>
	</div>
	<div class="formBar">
		<ul>
			<li><div class="buttonActive"><div class="buttonContent"><button type="submit">确认</button></div></div></li>
			<li><div class="button"><div class="buttonContent"><button class="close" type="button">关闭</button></div></div></li>
		</ul>
	</div>
</div>
</form>