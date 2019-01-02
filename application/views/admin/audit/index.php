<link href="<?php echo $assets_path; ?>admin/css/admin_common.css" rel="stylesheet" type="text/css" media="screen"/>
<form id="pagerForm" method="post" action="<?php echo site_url($controller, $method); ?>">
    <input type="hidden" name="pageNum" value="<?php echo $page;?>" />
    <input type="hidden" name="numPerPage" value="<?php echo $page_list;?>" />
    <input type="hidden" name="str_dt" value="<?php echo $str_dt; ?>" />
    <input type="hidden" name="iphone" value="<?php echo $iphone; ?>" />
    <input type="hidden" name="end_dt" value="<?php echo $end_dt; ?>" />
    <input type="hidden" name="state" value="<?php echo $state; ?>" />
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
                    <td>
                        <select class="combox" name="state">
                            <option value="">状态</option>
                            <option value="1" <?= isset($state) && $state == 1 ? 'selected' : ''; ?> >审核中</option>
                            <option value="2" <?= isset($state) && $state == 2 ? 'selected' : ''; ?> >审核失败</option>
                            <option value="3" <?= isset($state) && $state == 3 ? 'selected' : ''; ?> >审核通过</option>
                        </select>
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
            <li><a target="_blank" href="<?php echo site_url($controller, $method, array('str_dt'=> $str_dt, 'end_dt'=> $end_dt, 'iphone'=> $iphone, 'state'=> $state, 'page' => $page, 'numPerPage' => $page_list, 'export' => true)); ?>" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
            <!--<li><a class="delete" href="<?php echo site_url($controller, 'del', array('id' => '{sid}')); ?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>-->
        </ul>
    </div>
    <table class="table" width="100%" layoutH="110">
        <thead>
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>手机号</th>
            <th>推荐人id</th>
            <th>推荐人姓名</th>
            <th>推荐人手机号</th>
            <th>状态</th>
            <th>创建时间</th>
            <th style="width: 120px">操作</th>
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
                    <td><?php echo $v['id']; ?></td>
                    <td><?php echo $v['name']; ?></td>
                    <td><?php echo $v['phone']; ?></td>
                    <td><?php echo $v['invite_id']; ?></td>
                    <td><?php echo $v['invite_name']; ?></td>
                    <td><?php echo $v['invite_phone']; ?></td>
                    <td><?php echo $v['state_name']; ?></td>
                    <td><?php echo $v['create_dt']; ?></td>
                    <td><a class="btnView" href="<?php echo site_url($controller, 'carInfo', array('uid' => $v['uid'])); ?>" target="dialog" mask="true"  height="800" width="960" rel="car_info" title="查看">查看</a></td>
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