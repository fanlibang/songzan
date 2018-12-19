<link href="<?php echo $assets_path; ?>admin/css/admin_common.css" rel="stylesheet" type="text/css" media="screen"/>
<form id="pagerForm" method="post" action="<?php echo site_url($controller, $method); ?>">
    <input type="hidden" name="pageNum" value="<?php echo $page;?>" />
    <input type="hidden" name="numPerPage" value="<?php echo $page_list;?>" />
    <input type="hidden" name="str_dt" value="<?php echo $str_dt; ?>" />
    <input type="hidden" name="iphone" value="<?php echo $iphone; ?>" />
    <input type="hidden" name="end_dt" value="<?php echo $end_dt; ?>" />
    <input type="hidden" name="state" value="<?php echo $status; ?>" />
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
            <li><a target="_blank" href="<?php echo site_url($controller, $method, array('str_dt'=> $str_dt, 'end_dt'=> $end_dt, 'iphone'=> $iphone, 'status'=> $status, 'export' => true)); ?>" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
            <!--<li><a class="delete" href="<?php echo site_url($controller, 'del', array('id' => '{sid}')); ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>-->
        </ul>
    </div>
    <table class="table" width="100%" layoutH="110">
        <thead>
        <tr>
            <th>用户id</th>
            <th>姓名</th>
            <th>手机号</th>
            <th>收货人姓名</th>
            <th>收货人手机</th>
            <th>省份</th>
            <th>城市</th>
            <th>地址</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(count($list) <= 0) {
            ?>
            <td colspan="9">没有您要查询的数据~</td>
        <?php
        } else {

            foreach($list as $v){
                ?>
                <tr target="sid" rel="<?php echo $v['id']; ?>">
                    <td><?php echo $v['uid']; ?></td>
                    <td><?php echo $v['name']; ?></td>
                    <td><?php echo $v['phone']; ?></td>
                    <td><?php echo $v['site_name']; ?></td>
                    <td><?php echo $v['site_phone']; ?></td>
                    <td><?php echo $v['province']; ?></td>
                    <td><?php echo $v['city']; ?></td>
                    <td><?php echo $v['site']; ?></td>
                    <!--<td>
                        <a class="btnView" href="<?php echo site_url($controller, 'articleView', array('id' => $v['id'])); ?>" target="dialog" mask="true"  height="650" width="960" rel="article_view" title="查看">查看</a>
                        <a class="btnDel" href="<?php echo site_url($controller, 'del', array('id' => $v['id'])); ?>" target="ajaxTodo" title="确定要删除吗?">删除</a>
                    </td>-->
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
<script type="text/javascript">
    $(function(){
        $('.result').click(function(){
            var _state = $(this).attr('state');
            var _uid = $('#uid').val();
            $.ajax({
                type:'post',
                url:'<?php echo site_url($controller, 'carInfo'); ?>',
                data:{status: _state, uid:_uid},
                cache:false,
                dataType:'json',
                success:function(json){
                    if(json.statusCode == 200){
                        navTab.reload(json.forwardUrl, {}, json.navTabId);
                    }
                    alertMsg.error(json.message);
                },
                error:function(){}
            });
        });
    });
</script>