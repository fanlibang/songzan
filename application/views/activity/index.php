<link href="<?php echo $assets_path; ?>admin/css/admin_common.css" rel="stylesheet" type="text/css" media="screen"/>

<div class="pageHeader">
    <form onsubmit="return navTabSearch(this);" action="<?php echo site_url($controller, $method); ?>" method="post">
        <div class="searchBar">

        </div>
    </form>
</div>
<div class="pageContent">
    <div class="panelBar">

    </div>
    <table class="table" width="100%" layoutH="110">
        <thead>
        <tr>
            <th>开放截止日期</th>
            <th>编辑</th>
        </tr>
        </thead>
        <tbody>
        <td><?php echo $time; ?></td>
        <td><a class="btnEdit" href="<?php echo site_url($controller, 'edit') ?>" target="dialog" mask="true" height="380" width="650" rel="edit_cate" title="日期修改">日期修改</a></td>
        </tbody>
    </table>
</div>
<!--通用处理js-->
<script type="text/javascript" src="<?php echo $assets_path; ?>admin/js/admin_common.js"></script>