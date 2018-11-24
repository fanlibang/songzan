<link href="<?php echo $assets_path; ?>admin/css/admin_common.css" rel="stylesheet" type="text/css" media="screen"/>
<form id="pagerForm" method="post" action="<?php echo site_url($controller, $method); ?>">
    <input type="hidden" name="pageNum" value="<?php echo $page;?>" />
    <input type="hidden" name="numPerPage" value="<?php echo $page_list;?>" />
    <input type="hidden" name="str_dt" value="<?php echo $str_dt; ?>" />
    <input type="hidden" name="iphone" value="<?php echo $iphone; ?>" />
    <input type="hidden" name="end_dt" value="<?php echo $end_dt; ?>" />
</form>


<div class="pageHeader">
    <form onsubmit="return navTabSearch(this);" action="<?php echo site_url($controller, $method); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>创建时间：
                        <input type="text" name="str_dt" class="date"  onchange="onchangeValue(this);" openChange="true" value="<?=isset($str_dt) ? $str_dt:''?>" dateFmt="yyyy-MM-dd HH:mm:ss"/>
                        -
                        <input type="text" name="end_dt" class="date"  onchange="onchangeValue(this);" openChange="true" value="<?=isset($end_dt) ? $end_dt:''?>" dateFmt="yyyy-MM-dd HH:mm:ss"/>
                    </td>
                    <td>
                        手机号：<input type="text" name="iphone" value="<?php echo $iphone; ?>"/>
                    </td>
                    <td><div class="button"><div class="buttonContent"><button type="submit">搜索</button></div></div></td>
                </tr>
            </table>
        </div>
    </form>
</div>
<div class="pageContent">
    <div class="panelBar">
        <div class="panelBar">
            <ul class="toolBar">
                <li><a target="_blank" href="<?php echo site_url($controller, $method, array('str_dt'=> $str_dt, 'end_dt'=> $end_dt, 'iphone'=> $iphone, 'export' => true)); ?>" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
            </ul>
        </div>
    </div>
    <table class="table" width="100%" layoutH="90">
        <thead>
        <tr>
            <th>ID</th>
            <th>uid</th>
            <th>姓名</th>
            <th>手机号</th>
            <th>性别</th>
            <th>城市经销商</th>
            <th>选项</th>
            <th>其他渠道</th>
            <th>意见</th>
            <th>创建时间</th>
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
                    <td><?php echo $v['uid']; ?></td>
                    <td><?php echo $v['username']; ?></td>
                    <td><?php echo $v['iphone']; ?></td>
                    <td><?php echo $v['sex']; ?></td>
                    <td><?php echo $v['city']; ?></td>
                    <td><?php echo $v['opinion']; ?></td>
                    <td><?php echo $v['others']; ?></td>
                    <td><?php echo $v['textare']; ?></td>
                    <td><?php echo $v['create_dt']; ?></td>
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