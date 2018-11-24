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
        <ul class="toolBar">
            <li><a target="_blank" href="<?php echo site_url($controller, $method, array('str_dt'=> $str_dt, 'end_dt'=> $end_dt, 'iphone'=> $iphone, 'export' => true)); ?>" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="90">
        <thead>
        <tr>
            <th>uid</th>
            <th>类型</th>
            <th>推荐码</th>
            <th>手机号</th>
            <th>昵称</th>
            <th>openId</th>
            <th>状态</th>
            <th>是否白名单</th>
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
                    <td><?php echo $v['uid']; ?></td>
                    <td><?php echo $v['type'] == 1 ? '我是体验官' : '开启探索'; ?></td>
                    <td><?php echo $v['code']; ?></td>
                    <td><?php echo $v['phone']; ?></td>
                    <td><?php echo $v['nickname']; ?></td>
                    <td><?php echo $v['openId']; ?></td>
                    <td><?php echo $v['status'] == 1 ? '未注册' : '已注册'; ?></td>
                    <td style="color: <?php echo $v['white_type'] == 1 ? 'red' : 'blue'; ?>">
                        <a style="color: <?php echo $v['white_type'] == 1 ? 'red' : 'blue'; ?>" target="ajaxTodo"
                           href="<?php echo site_url($controller, 'whiteAdd', array('uid' => $v['uid'], 'white_type'=>($v['white_type'] == 1 ? '2' : '1'))); ?>"
                           title="确定要<?php echo $v['white_type'] == 1 ? '添加' : '取消'; ?>白名单吗?"><?php echo ($v['white_type']
                        == 1 ? '否' : '是'); ?></a>
                    </td>
                    <td><?php echo $v['create_dt']; ?></td>
                    <td>
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