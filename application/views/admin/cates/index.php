<link href="<?php echo $assets_path; ?>admin/css/admin_common.css" rel="stylesheet" type="text/css" media="screen"/>
<form id="pagerForm" method="post" action="<?php echo site_url($controller); ?>">
    <input type="hidden" name="pageNum" value="<?php echo $page;?>" />
    <input type="hidden" name="numPerPage" value="<?php echo $page_list;?>" />
    <input type="hidden" name="title" value="<?php echo $title; ?>" />
</form>


<div class="pageHeader">
    <form onsubmit="return navTabSearch(this);" action="<?php echo site_url($controller); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        菜单名称：<input type="text" name="title" value="<?php echo $title; ?>"/>
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
            <li><a class="add" href="<?php echo site_url($controller, 'add'); ?>" target="dialog" height="380" width="650" rel="add_cate" mask="true"><span>添加</span></a></li>
            <li class="line">line</li>
            <li><a class="delete" href="<?php echo site_url($controller, 'del', array('id' => '{sid}')); ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
            <li class="line">line</li>
            <li><a class="edit" href="<?php echo site_url($controller, 'edit', array('id' => '{sid}')); ?>" target="dialog" rel="edit_cate" mask="true" height="380" width="650"><span>修改</span></a></li>
            <?php if($is_super_admin){ ?>
            <li class="line">line</li>
            <li><a class="edit" href="<?php echo site_url($controller, 'resetInfo'); ?>" target="dialog" rel="reset_cate" height="320" width="650"><span>菜单重置</span></a></li>
            <li class="line">line</li>
            <li><a class="add" href="<?php echo site_url($controller, 'addInfo'); ?>" target="dialog" rel="reset_add_cate" height="460" width="650"><span>菜单重置添加</span></a></li>
            <?php } ?>
        </ul>
    </div>
    <style type="text/css">
        .gridTbody td div{
            width: 100%;
        }
    </style>
    <table class="table" width="100%" layoutH="112">
        <thead>
        <tr>
            <th>ID</th>
            <th align="left">名称</th>
            <th>地址</th>
            <th>状态</th>
            <th>左值</th>
            <th>右值</th>
            <th>父类</th>
            <th>排序</th>
            <th style="width: 60px">操作</th>
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
                <tr target="sid" rel="<?php echo $v['id']; ?>" <?php echo $v['pid'] == 0 ? 'style="color:red"' : ($v['status'] == 3 ? 'style="color:green"' : (empty($v['url']) ? 'style="color:orange"' : 'style="color:blue"')); ?>>
                    <td><?php echo $v['id']; ?></td>
                    <td <?php echo $v['pid'] == 0 ? '' : ($v['status'] == 3 ? 'style="padding-left:40px"' : (empty($v['url']) ? 'style="padding-left:16px"' : 'style="padding-left:28px"')); ?>><?php echo $v['title']; ?></td>
                    <td><?php echo $v['url']; ?></td>
                    <td><?php echo $v['status'] > 1 ? ($v['status'] > 2 ? '列表不可见' : '显示') : '隐藏'; ?></td>
                    <td><?php echo $v['left_value']; ?></td>
                    <td><?php echo $v['right_value']; ?></td>
                    <td><?php echo $v['pid']; ?></td>
                    <td><?php echo $v['rank']; ?></td>
                    <td>
                        <a class="btnEdit" href="<?php echo site_url($controller, 'edit', array('id' => $v['id'])); ?>" target="dialog" mask="true" height="380" width="650" rel="edit_cate" title="编辑菜单">编辑</a>
                        <a class="btnDel" href="<?php echo site_url($controller, 'del', array('id' => $v['id'])); ?>" target="ajaxTodo" title="确定要删除吗?">删除</a>
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