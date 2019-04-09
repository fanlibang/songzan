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
            <th>序号</th>
            <th>渠道名称</th>
           <!--<th>点击方式</th>-->
            <th>KVpv</th>
            <th>KVuv</th>
            <th>推荐人填写信息页pv</th>
            <th>推荐人填写信息页uv</th>
            <th>完善推荐人填写信息页pv</th>
            <th>完善推荐人填写信息页uv</th>
            <th>推荐人主页pv</th>
            <th>推荐人主页uv</th>
            <th>推荐人进度页pv</th>
            <th>推荐人进度页uv</th>
            <th>推荐人海报页pv</th>
            <th>推荐人海报页uv</th>
            <th>推荐人选择奖励页pv</th>
            <th>推荐人选择奖励页uv</th>
            <th>推荐人延保条款页pv</th>
            <th>推荐人延保条款页uv</th>
            <th>推荐人物流信息页pv</th>
            <th>推荐人物流信息页uv</th>
            <th>被推荐人填写信息页pv</th>
            <th>被推荐人填写信息页uv</th>
            <th>被推荐人主页pv</th>
            <th>被推荐人主页uv</th>
            <th>被推荐人进度页pv</th>
            <th>被推荐人进度页uv</th>
            <th>上传购车图片页pv</th>
            <th>上传购车图片页uv</th>
            <th>被推荐人选择奖励页pv</th>
            <th>被推荐人选择奖励页uv</th>
            <th>被推荐人延保条款页pv</th>
            <th>被推荐人延保条款页uv</th>
            <th>被推荐人物流信息页pv</th>
            <th>被推荐人物流信息页uv</th>
            <th>推荐人数</th>
            <th>推荐人海报被扫描次数</th>
            <th>被推荐人人数</th>
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
                    <td><?php echo $v['id'] ?></td>
                    <td><?php echo $v['name'] ?></td>
                    <!--<td><?php echo $v['type'] ?></td>-->
                    <?php foreach ($v['view'] as $ke => $ve) { ?>
                        <td><?php echo $ve['pv']; ?></td>
                        <td><?php echo $ve['uv']; ?></td>
                    <?php } ?>
                    <td><?php echo $v['user_num']; ?></td>
                    <td><?php echo $v['share_num']; ?></td>
                    <td><?php echo $v['invite_num']; ?></td>
                </tr>
            <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>