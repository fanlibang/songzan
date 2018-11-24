<link href="<?php echo $assets_path; ?>admin/css/admin_common.css" rel="stylesheet" type="text/css" media="screen"/>
<form id="pagerForm" method="post" action="<?php echo site_url($controller); ?>">
</form>


<div class="pageHeader">
    <form onsubmit="return navTabSearch(this);" action="<?php echo site_url($controller); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <!--
                    <td>
                        账号：<input type="text" name="user_name" value="<?php echo $user_name; ?>"/>
                    </td>
                    <td><div class="button"><div class="buttonContent"><button type="submit">搜索</button></div></div></td>
                    -->
                </tr>
            </table>
        </div>
    </form>
</div>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <!--<li><a class="delete" href="<?php echo site_url($controller, 'del', array('id' => '{sid}')); ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>-->
        </ul>
    </div>
    <table class="table" width="100%" layoutH="90">
        <thead>
        <tr>
            <th>页面</th>
            <th>pv</th>
            <th>uv</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(count($list) <= 0){
        ?>
            <td colspan="9">没有您要查询的数据~</td>
        <?php
        }else{

            foreach($list as $k => $v){
                ?>
                <tr target="sid" rel="<?php echo $v['id']; ?>">
                    <td><?php echo $k ?></td>
                    <td><?php echo $v['pv'] ?></td>
                    <td><?php echo $v['uv']; ?></td>
                </tr>
            <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>