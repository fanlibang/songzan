<link href="<?php echo $assets_path; ?>admin/css/admin_common.css" rel="stylesheet" type="text/css" media="screen"/>
<form id="pagerForm" method="post" action="<?php echo site_url($controller); ?>">
    <input type="hidden" name="pageNum" value="<?php echo $page;?>" />
    <input type="hidden" name="numPerPage" value="<?php echo $page_list;?>" />
    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>" />
</form>


<div class="pageHeader">
    <form onsubmit="return navTabSearch(this);" action="<?php echo site_url($controller); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        账号：<input type="text" name="user_name" value="<?php echo $user_name; ?>"/>
                    </td>
                    <td><div class="button"><div class="buttonContent"><button type="submit">搜索</button></div></div></td>
                </tr>
            </table>
        </div>
    </form>
</div>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo site_url($controller, 'add'); ?>" target="dialog" height="450" width="650" rel="add_user" mask="true"><span>添加</span></a></li>
            <li class="line">line</li>
            <li><a class="delete" href="<?php echo site_url($controller, 'del', array('id' => '{sid}')); ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
            <li class="line">line</li>
            <li><a class="edit" href="<?php echo site_url($controller, 'edit', array('id' => '{sid}')); ?>" target="dialog" rel="edit_user" mask="true" height="450" width="650"><span>修改</span></a></li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="112">
        <thead>
        <tr>
            <th>ID</th>
            <th>账号</th>
            <th>邮箱</th>
            <th>电话</th>
            <th>登录时间</th>
            <th>登录IP</th>
            <th>状态</th>
            <th>创建时间</th>
            <th style="width: 120px">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(count($list) <= 0){
        ?>
            <td colspan="9">没有您要查询的数据~</td>
        <?php
        }else{

            foreach($list as $v){
                ?>
                <tr target="sid" rel="<?php echo $v['id']; ?>">
                    <td><?php echo $v['id']; ?></td>
                    <td><?php echo $v['username']; ?></td>
                    <td><?php echo $v['email']; ?></td>
                    <td><?php echo $v['tel']; ?></td>
                    <td><?php echo !empty($v['last_time']) ? date('Y-m-d H:i:s', $v['last_time']) : '-'; ?></td>
                    <td><?php echo long2ip($v['last_ip']); ?></td>
                    <td style="color:<?php echo $v['status'] == 2 ? 'blue' : 'red'; ?>"><?php echo $v['status'] == 2 ? '启用' : '禁用'; ?></td>
                    <td><?php echo !empty($v['add_time']) ? date('Y-m-d H:i:s', $v['add_time']) : ''; ?></td>
                    <td>
                        <?php if(!in_array($v['id'], $super_admin_ids)){ ?>
                        <a class="btnEdit" href="<?php echo site_url($controller, 'edit', array('id' => $v['id'])); ?>" target="dialog" mask="true" height="450" width="650" rel="edit_user" title="编辑管理员信息">编辑</a>
                        <a class="btnDel" href="<?php echo site_url($controller, 'del', array('id' => $v['id'])); ?>" target="ajaxTodo" title="确定要删除吗?">删除</a>
                        <?php }else{ echo '——'; } ?>
                    </td>
                </tr>
            <?php
            }
        }
        ?>
        </tbody>
    </table>
    <?php include_once './application/views/admin/publics/page.php';?>
</div>
<!--通用处理js-->
<script type="text/javascript" src="<?php echo $assets_path; ?>admin/js/admin_common.js"></script>
