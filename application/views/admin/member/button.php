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
            <th>页面</th>
            <th>PV</th>
            <th>UV</th>
        </tr>
        </thead>
        <tbody>
        <?php
            if(count($list) <= 0) {
        ?>
            <td colspan="9">没有您要查询的数据~</td>
        <?php

            } else {
                foreach($list as $v) {
        ?>
                <tr>
                    <td><?php echo $v['page']; ?></td>
                    <td><?php echo $v['pv']; ?></td>
                    <td><?php if ($v['phone_uv'] <= 0) { echo $v['openid_uv']; } else { echo $v['phone_uv']; } ?></td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>
<!--通用处理js-->
<script type="text/javascript" src="<?php echo $assets_path; ?>admin/js/admin_common.js"></script>