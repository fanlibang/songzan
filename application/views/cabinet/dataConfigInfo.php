<!DOCTYPE html>
<html>
<!-- Mirrored from www.zi-han.net/theme/hplus/table_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $page_title; ?></title>
    <meta content="<?php echo $page_keywords; ?>" name="keywords">
    <meta content="<?php echo $page_description; ?>" name="description">
    <link rel="shortcut icon" href="<?php echo STATIC_DOMAIN; ?>/www/img/favicon.ico" type="image/x-icon" />

    <link rel="shortcut icon" href="favicon.ico"> <link href="/assets/tj/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/assets/tj/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/assets/tj/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/assets/tj/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="/assets/tj/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/assets/tj/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <!-- 编辑器 -->
    <link rel="stylesheet" href="/assets/codemirror/lib/codemirror.css"/>
    <link rel="stylesheet" href="/assets/codemirror/addon/hint/show-hint.css"/>

    <style type="text/css">
        .CodeMirror{  height:500px; }
    </style>

    <!--
    <link href="/assets/tj/css/plugins/iCheck/custom.css" rel="stylesheet">
<script src="/assets/tj/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>
-->
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="min-height:60px;">
                    <div style="float:left" >
                        <a class="btn btn-primary" style="margin:0px;"  href="<?php echo site_url($controller, 'dataConfig'); ?>" >返回</a>
                    </div>
                    <label class="" style="padding-left:10px;float: left; font-size:24px;">编辑信息</label>
                </div>
                <form method="post" id="configList" class="form-horizontal" action="<?php echo site_url($controller, $method); ?>">
                <div class="ibox-content" >
                        <input type="hidden" name="mark" value="<?php echo $type; ?>" >
                        <div class="form-group">
                            <label class="col-sm-2 control-label">报表id</label>
                            <div class="col-sm-4">
                                <input type="text" id="cid" name="id" <?php if($type == 'edit') { echo 'readonly'; } ?> value="<?php echo $config['id']?>" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">报表名称</label>
                            <div class="col-sm-4">
                                <input type="text" name="name" value="<?php echo $config['name']?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">备注信息</label>
                            <div class="col-sm-10">
                                <textarea name="title" id="" cols="80" rows="4"><?php echo $config['title']?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">查询类型</label>

                            <div class="col-sm-3">
                                <select name="type" id="type" class="m-b form-control input-s-sm inline">
                                    <option value="mysql" <?php echo $query['type'] == 'mysql' ? 'selected' : '';?> >mysql</option>
                                    <option value="presto" <?php echo $query['type'] == 'presto' ? 'selected' : '';?>>presto</option>
                                    <option value="es" <?php echo $query['type'] == 'es' ? 'selected' : '';?> >es</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">vd数据源</label>
                            <div class="col-sm-3">
                                <!--
                                <select name="data_source" id="dataSource" class="m-b form-control input-s-sm inline">
                                    <option value="">请选择 </option>
                                    <option value="vdMysqlDataSource1" <?php echo $query['data_source'] == 'vdMysqlDataSource1' ? 'selected' : '';?> >mysql-192.168.78.26:3306</option>
                                    <option value="vdMysqlDataSource2" <?php echo $query['data_source'] == 'vdMysqlDataSource2' ? 'selected' : '';?>>mysql-192.168.78.26:3306</option>
                                    <option value="vdPrestoDataSource" <?php echo $query['data_source'] == 'vdPrestoDataSource' ? 'selected' : '';?> >公司hive库</option>
                                </select>
                                -->

                                    <select name="data_source" class="m-b form-control input-s-sm inline" id="dataSource">
                                    <option value="vdMysqlDataSource1" <?php echo $query['data_source'] == 'vdMysqlDataSource1' ? 'selected' : '';?> >mysql-172.17.2.46:3308</option>
                                    <option value="vdMysqlDataSource2" <?php echo $query['data_source'] == 'vdMysqlDataSource2' ? 'selected' : '';?>>mysql-192.168.11.6:3309</option>
                                    <option value="vdPrestoDataSource" <?php echo $query['data_source'] == 'vdPrestoDataSource' ? 'selected' : '';?> >公司hive库</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">查询超时时间</label>
                            <div class="col-sm-4">
                                <input type="text" name="timeout" value="<?php echo $query['timeout'] ? $query['timeout'] : 10?>" class="form-control">默认10秒
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">查询大小</label>
                            <div class="col-sm-4">
                                <select name="limit" class="m-b form-control input-s-sm inline">
                                    <option value="5" <?php echo $query['limit'] == '5' ? 'selected' : '';?> >5</option>
                                    <option value="20" <?php echo $query['limit'] == '20' ? 'selected' : '';?> >20</option>
                                    <option value="50" <?php echo $query['limit'] == '50' ? 'selected' : '';?> >50</option>
                                    <option value="100" <?php echo $query['limit'] == '100' ? 'selected' : '';?> >100</option>
                                </select>
                                默认20条
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-sm-2 control-label">查询内容</label>
                            <div class="col-sm-5">
                                <textarea name="content" id="content" ><?php echo $query['content']?></textarea>
                            </div>
                        </div>

                        <div class="form-group right">
                            <div class="col-sm-12 text-right">
                                <input type="hidden" name="filed" value="<?php echo $query['id']; ?>" >
                                <a class="btn btn-primary _submit" >完成</a>
                            </div>
                        </div>
                </div>

                <div class="ibox-content" id="column">
                    <div class="row">
                        <label class="col-sm-1"><a href="javascript:;"  class="btn btn-primary addConfig">添加配置</a></label>
                        <label class="col-sm-1"><a href="javascript:;"  class="btn btn-primary getConfig">自动获取配置</a></label>
                    </div>

                    <div class="row">
                        <div class="col-sm-1 text-center">
                            <p>数据名称</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>查询名称</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>表头名称</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>备注信息</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>是否显示</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>搜索字段</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>排序字段</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>字段类别</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>列宽</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>字段类型</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>操作</p>
                        </div>
                    </div>

                    <?php if(count($column) > 0){ foreach($column as $k => $v){ ?>
                        <div class="row column_num">
                            <p></p>
                            <input type="hidden" name="column[<?= $k; ?>][id]" value="<?php echo $v['id']; ?>" >
                        <div class="col-sm-1">
                            <input name="column[<?= $k; ?>][data]" value="<?= $v['data']; ?>" class="form-control" type="text">
                        </div>

                        <div class="col-sm-1">
                            <input name="column[<?= $k; ?>][name]" value="<?= $v['name']; ?>" class="form-control" type="text">
                        </div>

                        <div class="col-sm-1">
                            <input name="column[<?= $k; ?>][title]" value="<?= $v['title']; ?>" class="form-control" type="text">
                        </div>

                        <div class="col-sm-1">
                            <input name="column[<?= $k; ?>][remark]" value="<?= $v['remark']; ?>" class="form-control" type="text">
                        </div>

                        <div class="col-sm-1 text-center">
                            <input value="0"  class="realList" name="column[<?= $k; ?>][visible]" <?php if($v['visible'] != 1) { echo 'checked=checked'; } ?> type="radio">隐藏
                            <input value="1"  class="realList" name="column[<?= $k; ?>][visible]" <?php if($v['visible'] == 1) { echo 'checked=checked'; } ?> type="radio">显示
                        </div>

                        <div class="col-sm-1 text-center">
                            <input value="0"  class="realList" name="column[<?= $k; ?>][searchable]" <?php if($v['searchable'] != 1) { echo 'checked=checked'; } ?> type="radio">否
                            <input value="1"  class="realList" name="column[<?= $k; ?>][searchable]" <?php if($v['searchable'] == 1) { echo 'checked=checked'; } ?> type="radio">是
                        </div>

                        <div class="col-sm-1 text-center">
                            <input value="0"  class="realList" name="column[<?= $k; ?>][orderable]" <?php if($v['orderable'] != 1) { echo 'checked=checked'; } ?> type="radio">否
                            <input value="1"  class="realList" name="column[<?= $k; ?>][orderable]" <?php if($v['orderable'] == 1) { echo 'checked=checked'; } ?> type="radio">是
                        </div>

                        <div class="col-sm-1 text-center">
                            <input value="1"  class="realList" name="column[<?= $k; ?>][column_type]" <?php if($v['column_type'] != 2) { echo 'checked=checked'; } ?> type="radio">维度
                            <input value="2"  class="realList" name="column[<?= $k; ?>][column_type]" <?php if($v['column_type'] == 2) { echo 'checked=checked'; } ?> type="radio">指标
                        </div>

                        <div class="col-sm-1">
                            <input name="column[<?= $k; ?>][width]" value="<?= $v['width']; ?>" class="form-control" type="text">
                        </div>

                        <div class="col-sm-1">
                            <select name="column[<?= $k; ?>][data_type]" class="form-control m-b config">
                                <option value="date" <?php echo $v['data_type'] == 'date' ? 'selected' : '';?> >日期型</option>
                                <option value="string" <?php echo $v['data_type'] == 'string' ? 'selected' : '';?>>字符型</option>
                                <option value="int" <?php echo $v['data_type'] == 'int' ? 'selected' : '';?>>整形</option>
                                <option value="double" <?php echo $v['data_type'] == 'double' ? 'selected' : '';?>>浮点型</option>
                            </select>
                        </div>

                        <div class="col-sm-1 text-center">
                            <a class="btn btn-primary delColumn" id="<?= $v['id']; ?>" >删除</a>
                        </div>

                        <label class="control-label up" style="float: left">向上</label>
                        <label class="control-label down" style="float: left">向下</label>
                        <input name="" value="" class="form-control key" type="hidden">
                    </div>
                    <?php } } ?>
                    <input type="hidden" name="column_num" id="column_num" value="" >
                </div>

                <div class="ibox-content" id="filter">
                    <div class="row">
                        <label class="col-sm-1 "><a href="javascript:;"  class="btn btn-primary addFilter">添加过滤配置</a></label>
                    </div>

                    <div class="row">
                        <div class="col-sm-1 text-center">
                            <p>分组</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>元素类型</p>
                        </div>

                        <div class="col-sm-2 text-center">
                            <p>data</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>名称</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>标题</p>
                        </div>

                        <div class="col-sm-2 text-center">
                            <p>日期</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>value</p>
                        </div>

                        <div class="col-sm-1 text-center">
                            <p>format</p>
                        </div>

                        <div class="col-sm-2 text-center">
                            <p>操作</p>
                        </div>
                    </div>

                    <?php if(count($filter) > 0){ foreach($filter as $k => $v){ ?>
                        <div class="row filter_num">
                            <p></p>
                            <input type="hidden" name="filter[<?= $k; ?>][id]" value="<?php echo $v['id']; ?>" >
                            <div class="col-sm-1">
                                <select name="filter[<?= $k; ?>][group]" class="form-control m-b config">
                                    <option value="1" <?php echo $v['group'] == '1' ? 'selected' : '';?>>1</option>
                                    <option value="2" <?php echo $v['group'] == '2' ? 'selected' : '';?>>2</option>
                                    <option value="3" <?php echo $v['group'] == '3' ? 'selected' : '';?>>3</option>
                                </select>
                            </div>

                            <div class="col-sm-1">
                                <select name="filter[<?= $k; ?>][type]" class="form-control m-b config dic" key=<?= $k; ?> id="dic">
                                    <option value="text" <?php echo $v['type'] == 'text' ? 'selected' : '';?> >text</option>
                                    <option value="date" <?php echo $v['type'] == 'date' ? 'selected' : '';?>>date</option>
                                    <option value="dic" <?php echo $v['type'] == 'dic' ? 'selected' : '';?>>dic手写</option>
                                    <option value="dic" <?php echo $v['type'] == 'dic' ? 'selected' : '';?>>dic自动</option>
                                </select>
                            </div>

                            <div class="col-sm-2 type">
                                <input name="filter[<?= $k; ?>][data]" value="<?= $v['data']; ?>" class="form-control" type="text">
                            </div>

                            <div class="col-sm-1">
                                <input name="filter[<?= $k; ?>][name]" value="<?= $v['name']; ?>" class="form-control" type="text">
                            </div>

                            <div class="col-sm-1">
                                <input name="filter[<?= $k; ?>][title]" value="<?= $v['title']; ?>" class="form-control" type="text">
                            </div>

                            <div class="col-sm-2" id="data_5">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-b form-control" name="filter[<?= $k; ?>][begin]" value="<?php echo $str_date; ?>" />
                                    <span class="input-group-addon">到</span>
                                    <input type="text" class="input-b form-control" name="filter[<?= $k; ?>][end]" value="<?php echo $end_date; ?>" />
                                </div>
                            </div>

                            <div class="col-sm-1">
                                <input name="filter[<?= $k; ?>][value]" value="<?= $v['value']; ?>" class="form-control" type="text">
                            </div>

                            <div class="col-sm-1">
                                <input name="filter[<?= $k; ?>][format]" value="<?= $v['format']; ?>" class="form-control" type="text">
                            </div>

                            <div class="col-sm-2 text-center">
                                <a class="btn btn-primary delFilter" id="<?= $v['id']; ?>" >删除</a>
                            </div>
                        </div>
                    <?php } } ?>
                    <input type="hidden" name="filter_num" id="filter_num" value="" >
                </div>
                </form>
            </div>
        </div>
    </div>
</div>




<script src="/assets/tj/js/jquery.min.js?v=2.1.4"></script>
<script src="/assets/tj/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/assets/tj/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/assets/tj/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/assets/tj/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/assets/tj/js/content.min.js?v=1.0.0"></script>
<script src="/assets/tj/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="/assets/tj/js/common/base.js"></script>
<script src="/assets/tj/js/common/common.js"></script>
<script src="/assets/tj/js/common/mobile.js"></script>
<script src="/assets/tj/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="/assets/tj/js/demo/datepicker.js"></script>
<!-- 编辑器 -->
<script src="/assets/codemirror/lib/codemirror.js"></script>
<script src="/assets/codemirror/mode/sql/sql.js"></script>
<script src="/assets/codemirror/addon/hint/show-hint.js"></script>
<script src="/assets/codemirror/addon/hint/sql-hint.js"></script>
<script src="/assets/codemirror/addon/selection/active-line.js"></script>


</body>
</html>
<script type="text/javascript">
    $(document).on('click',".subColumn",function(){
        var form = $(this).parent().parent('form');
        var config_id = $("#cid").val();
        var id = $(this).next();
        $(this).prev().val(config_id);
        var data = form.serializeArray();
        $.ajax({
            type: "POST",
            url: "subColumn",
            data: data,
            dataType: "json",
            success: function(ret){
                if(ret.msg == '添加成功') {
                    var value = ret.data;
                    id.val(value);
                }
                prompt(ret.code, ret.msg);
            }
        });
    });

    $(document).on('click',".delColumn",function(){
        var id = $(this).attr('id');
        var div = $(this).parent().parent();
        swal({
            title: "您确定要删除这条吗",
            text: "删除后将无法恢复，请谨慎操作！",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "删除",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                type: "POST",
                url: "delColumn",
                data: {id:id},
                dataType: "json",
                success: function(ret){
                    if(ret.code == '1') {
                        swal.close();
                        div.remove();
                        //div.fadeOut(1000);
                    } else {
                        prompt(ret.code, ret.msg);
                    }
                }
            });
        })
    });

    $(document).on('click',".subFilter",function(){
        var form = $(this).parent().parent('form');
        var config_id = $("#cid").val();
        var id = $(this).next();
        $(this).prev().val(config_id);
        var data = form.serializeArray();
        $.ajax({
            type: "POST",
            url: "subFilter",
            data: data,
            dataType: "json",
            success: function(ret){
                if(ret.msg == '添加成功') {
                    var value = ret.data;
                    id.val(value);
                }
                prompt(ret.code, ret.msg);
            }
        });
    });

    $(document).on('click',".delFilter",function(){
        var id = $(this).attr('id');
        var div = $(this).parent().parent();
        swal({
            title: "您确定要删除这条吗",
            text: "删除后将无法恢复，请谨慎操作！",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "删除",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                type: "POST",
                url: "delFilter",
                data: {id:id},
                dataType: "json",
                success: function(ret){
                    if(ret.code == '1') {
                        swal.close();
                        div.remove();
                        //div.fadeOut(1000);
                    } else {
                        prompt(ret.code, ret.msg);
                    }
                }
            });
        })
    });

    $(document).on('change',".dic",function(){
        var type = $(this).find('option:selected').text();
        var content = $(this).parent().next();
        var key = $(this).attr('key');
        var html = '';
        if(type == 'dic自动') {
            $.ajax({
                type: "POST",
                url: "getConfig",
                data: {type: type,key:key},
                dataType: "json",
                success: function (ret) {
                    if(ret.code == 1) {
                        html += ret.msg;
                        content.empty();
                        content.append(html);
                    }
                }
            });
        } else {
            html += '<input type="text" name="filter['+key+'][data]" value="" class="form-control" >';
            content.empty();
            content.append(html);
        }
    });

    $(document).ready(function(){
        $(".addConfig").click(function(){
            var num = $("#column_num").val();
            if(!num) {
                num = $('.column_num').length;
            }
            var html = '';
            html += '<div class="row column_num">';
            html += '<p></p>';
            html += '<div class="col-sm-1">';
            html += '<input name="column['+num+'][data]" value="" class="form-control" type="text">';
            html += '</div>';
            html += '<div class="col-sm-1">';
            html += '<input name="column['+num+'][name]" value="" class="form-control" type="text">';
            html += '</div>';
            html += '<div class="col-sm-1">';
            html += '<input name="column['+num+'][title]" value="" class="form-control" type="text">';
            html += '</div>';
            html += '<div class="col-sm-1">';
            html += '<input name="column['+num+'][remark]" value="" class="form-control" type="text">';
            html += '</div>';
            html += '<div class="col-sm-1 text-center">';
            html += '<input value="0"  class="realList" name="column['+num+'][visible]" checked="checked" type="radio">隐藏';
            html += '<input value="1"  class="realList" name="column['+num+'][visible]" type="radio">显示';
            html += '</div>';
            html += '<div class="col-sm-1 text-center">';
            html += '<input value="0"  class="realList" name="column['+num+'][searchable]" checked="checked" type="radio">否';
            html += '<input value="1"  class="realList" name="column['+num+'][searchable]" type="radio">是';
            html += '</div>';
            html += '<div class="col-sm-1 text-center">';
            html += '<input value="0"  class="realList" name="column['+num+'][orderable]" checked="checked" type="radio">否';
            html += '<input value="1"  class="realList" name="column['+num+'][orderable]" type="radio">是';
            html += '</div>';
            html += '<div class="col-sm-1 text-center">';
            html += '<input value="1"  class="realList" name="column['+num+'][column_type]" checked="checked" type="radio">维度';
            html += '<input value="2"  class="realList" name="column['+num+'][column_type]" type="radio">指标';
            html += '</div>';
            html += '<div class="col-sm-1">';
            html += '<input name="column['+num+'][width]" value="" class="form-control" type="text">';
            html += '</div>';
            html += '<div class="col-sm-1">';
            html += '<select name="column['+num+'][data_type]" class="form-control m-b config">';
            html += '<option value="date"  >日期型</option>';
            html += '<option value="string" >字符型</option>';
            html += '<option value="int" >整形</option>';
            html += '<option value="double" >浮点型</option>';
            html += '</select>';
            html += '</div>';
            html += '<div class="col-sm-1 text-center">';
            html += '<a class="btn btn-primary delColumn" >删除</a>';
            html += '</div>';
            html += '<label class="control-label up" style="float: left">向上</label>';
            html += '<label class="control-label down" style="float: left">向下</label>';
            html += '<input name="" value="" class="form-control key" type="hidden">';
            html += '</div>';
            $.getScript("/assets/tj/js/common/mobile.js");
            $("#column").append(html);
            $("#column_num").val(num+1);
        });


        $(".addFilter").click(function(){
            var num = $("#filter_num").val();
            if(!num) {
                num = $('.filter_num').length;
            } else {
                num = 0;
            }
            var html = '';
            html += '<div class="row filter_num">';
            html += '<p></p>';
            html += '<div class="col-sm-1">';
            html += '<select name="filter['+num+'][group]" class="form-control m-b config">';
            html += '<option value="1">1</option>';
            html += '<option value="2">2</option>';
            html += '<option value="3">3</option>';
            html += '</select>';
            html += '</div>';
            html += '<div class="col-sm-1">';
            html += '<select name="filter['+num+'][type]" id="dic" key="'+num+'" class="form-control dic">';
            html += '<option value="text">text</option>';
            html += '<option value="date">date</option>';
            html += '<option value="dic">dic手写</option>';
            html += '<option value="dic">dic自动</option>';
            html += '</select>';
            html += '</div>';
            html += '<div class="col-sm-2 type">';
            html += '<input name="filter['+num+'][data]" value="" class="form-control" type="text">';
            html += '</div>';
            html += '<div class="col-sm-1">';
            html += '<input name="filter['+num+'][name]" value="" class="form-control" type="text">';
            html += '</div>';
            html += '<div class="col-sm-1">';
            html += '<input name="filter['+num+'][title]" value="" class="form-control" type="text">';
            html += '</div>';
            html += '<div class="col-sm-2" id="data_5">';
            html += '<div class="input-daterange input-group" id="datepicker">';
            html += '<input type="text" class="form-control" name="filter['+num+'][begin]" value="" />';
            html += '<span class="input-group-addon">到</span>';
            html += '<input type="text" class="form-control" name="filter['+num+'][end]" value="" />';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-sm-1">';
            html += '<input name="filter['+num+'][value]" value="" class="form-control" type="text">';
            html += '</div>';
            html += '<div class="col-sm-1">';
            html += '<input name="filter['+num+'][format]" value="YYYY-MM-DD" class="form-control" type="text">';
            html += '</div>';
            html += '<div class="col-sm-2 text-center">';
            html += '<a class="btn btn-primary delColumn" >删除</a>';
            html += '</div>';
            html += '</div>';
            $.getScript("/assets/tj/js/plugins/datapicker/bootstrap-datepicker.js");
            $.getScript("/assets/tj/js/demo/datepicker.js");
            $("#filter").append(html);
            $("#filter_num").val(num+1);
        });

        $(".dataTables-example").dataTable();
        $(".delConfig").click(function(){
            $(".option").remove();
        });


        $(".getConfig").click(function(){
            var configId = $("#cid").val();
            var type = $("#type").val();
            //var content = $("#content").val();
            var content = window['editor_0'].getValue();
            var dataSource = $("#dataSource").val();
            var data = {
                "configId": configId,
                "type": type,
                "content": content,
                "dataSource": dataSource
            };
            data = JSON.stringify(data);

            $.ajax({
                type: "post",
                url: "delConfig",
                data: {cid:configId},
                dataType: "json",
                success: function (ret) {

                }
            })
            $.ajax({
                type: "post",
                url: "http://rcmd-api.xyzs.com:7003/reporter-service-api/api/v1/schema",
                data: data,
                dataSrc: "data",
                dataType: "json",
                contentType: 'application/json',
                mimeType: 'application/json',
                success: function (ret) {
                    var column = '';
                    var filter = '';
                    var dims = ret.dims
                    var x = 0;
                    $(dims).each(function(i){
                        column += '<div class="row column_num">';
                        column += '<p></p>';
                        column += '<div class="col-sm-1">';
                        column += '<input name="column['+i+'][data]" value="'+dims[i].data+'" class="form-control" type="text">';
                        column += '</div>';
                        column += '<div class="col-sm-1">';
                        column += '<input name="column['+i+'][name]" value="'+dims[i].name+'" class="form-control" type="text">';
                        column += '</div>';
                        column += '<div class="col-sm-1">';
                        column += '<input name="column['+i+'][title]" value="'+dims[i].title+'" class="form-control" type="text">';
                        column += '</div>';
                        column += '<div class="col-sm-1">';
                        column += '<input name="column['+i+'][remark]" value="'+dims[i].remark+'" class="form-control" type="text">';
                        column += '</div>';
                        column += '<div class="col-sm-1 text-center">';
                        if(dims[i].visible == true) {
                            column += '<input value="0"  class="realList" name="column['+i+'][visible]" type="radio">隐藏';
                            column += '<input value="1"  class="realList" name="column['+i+'][visible]" checked="checked" type="radio">显示';
                        } else {
                            column += '<input value="0"  class="realList" name="column['+i+'][visible]" checked="checked" type="radio">隐藏';
                            column += '<input value="1"  class="realList" name="column['+i+'][visible]" type="radio">显示';
                        }
                        column += '</div>';
                        column += '<div class="col-sm-1 text-center">';
                        if(dims[i].searchable == true) {
                            column += '<input value="0"  class="realList" name="column['+i+'][searchable]" type="radio">否';
                            column += '<input value="1"  class="realList" name="column['+i+'][searchable]" checked="checked" type="radio">是';
                        } else {
                            column += '<input value="0"  class="realList" name="column['+i+'][searchable]" checked="checked" type="radio">否';
                            column += '<input value="1"  class="realList" name="column['+i+'][searchable]" type="radio">是';
                        }
                        column += '</div>';
                        column += '<div class="col-sm-1 text-center">';
                        if(dims[i].orderable == true) {
                            column += '<input value="0"  class="realList" name="column['+i+'][orderable]" type="radio">否';
                            column += '<input value="1"  class="realList" name="column['+i+'][orderable]" checked="checked" type="radio">是';
                        } else {
                            column += '<input value="0"  class="realList" name="column['+i+'][orderable]" checked="checked" type="radio">否';
                            column += '<input value="1"  class="realList" name="column['+i+'][orderable]" type="radio">是';
                        }
                        column += '</div>';
                        column += '<div class="col-sm-1 text-center">';
                        if(dims[i].columnType == '1') {
                            column += '<input value="1"  class="realList" name="column['+i+'][column_type]" checked="checked" type="radio">维度';
                            column += '<input value="2"  class="realList" name="column['+i+'][column_type]" type="radio">指标';
                        } else {
                            column += '<input value="1"  class="realList" name="column['+i+'][column_type]" type="radio">维度';
                            column += '<input value="2"  class="realList" name="column['+i+'][column_type]" checked="checked" type="radio">指标';
                        }
                        column += '</div>';

                        column += '<div class="col-sm-1">';
                        column += '<input name="column['+i+'][width]" value="" class="form-control" type="text">';
                        column += '</div>';
                        column += '<div class="col-sm-1">';
                        column += '<select name="column['+i+'][data_type]" class="form-control m-b config">';
                        column += '<option value="date" ';
                        if(dims[i].dataType == 'date'){ column +='selected'}
                        column += '>日期型</option>';
                        column += '<option value="string" ';
                        if(dims[i].dataType == 'string'){ column +='selected'}
                        column += '>字符型</option>';
                        column += '<option value="int" ';
                        if(dims[i].dataType == 'int'){ column +='selected'}
                        column += '>整形</option>';
                        column += '<option value="double" ';
                        if(dims[i].dataType == 'double'){ column +='selected'}
                        column += '>浮点型</option>';
                        column += '</select>';
                        column += '</div>';
                        column += '<div class="col-sm-1 text-center">';
                        column += '<a class="btn btn-primary delColumn" >删除</a>';
                        column += '</div>';
                        column += '<label class="control-label up" style="float: left">向上</label>';
                        column += '<label class="control-label down" style="float: left">向下</label>';
                        column += '<input name="" value="" class="form-control key" type="hidden">';
                        column += '</div>';


                        filter += '<div class="row filter_num">';
                        filter += '<p></p>';
                        filter += '<div class="col-sm-1">';
                        filter += '<select name="filter['+i+'][group]" class="form-control m-b config">';
                        filter += '<option value="1">1</option>';
                        filter += '<option value="2">2</option>';
                        filter += '<option value="3">3</option>';
                        filter += '</select>';
                        filter += '</div>';
                        filter += '<div class="col-sm-1">';
                        filter += '<select name="filter['+i+'][type]" key="'+i+'" id="dic" class="form-control dic">';
                        filter += '<option value="text">text</option>';
                        filter += '<option value="date" ';
                        if(dims[i].dataType == 'date'){ filter +='selected'}
                        filter += '>date</option>';
                        filter += '<option value="dic">dic手写</option>';
                        filter += '<option value="dic">dic自动</option>';
                        filter += '</select>';
                        filter += '</div>';
                        filter += '<div class="col-sm-2 type">';
                        filter += '<input name="filter['+i+'][data]" value="'+dims[i].data+'" class="form-control" type="text">';
                        filter += '</div>';
                        filter += '<div class="col-sm-1">';
                        filter += '<input name="filter['+i+'][name]" value="'+dims[i].name+'" class="form-control" type="text">';
                        filter += '</div>';
                        filter += '<div class="col-sm-1">';
                        filter += '<input name="filter['+i+'][title]" value="'+dims[i].title+'" class="form-control" type="text">';
                        filter += '</div>';
                        filter += '<div class="col-sm-2" id="data_5">';
                        filter += '<div class="input-daterange input-group" id="datepicker">';
                        filter += '<input type="text" class="form-control" name="filter['+i+'][begin]" value="" />';
                        filter += '<span class="input-group-addon">到</span>';
                        filter += '<input type="text" class="form-control" name="filter['+i+'][end]" value="" />';
                        filter += '</div>';
                        filter += '</div>';
                        filter += '<div class="col-sm-1">';
                        filter += '<input name="filter['+i+'][value]" value="" class="form-control" type="text">';
                        filter += '</div>';
                        filter += '<div class="col-sm-1">';
                        filter += '<input name="filter['+i+'][format]" value="YYYY-MM-DD" class="form-control" type="text">';
                        filter += '</div>';
                        filter += '<div class="col-sm-2 text-center">';
                        filter += '<a class="btn btn-primary delColumn" >删除</a>';
                        filter += '</div>';
                        filter += '</div>';
                        x = i;
                    });

                    $(".column_num").empty();
                    $(".filter_num").empty();
                    $("#column").append(column);

                    var column = '';
                    var metrics = ret.metrics;
                    $(metrics).each(function(i){
                        x = x + 1;
                        column += '<div class="row column_num">';
                        column += '<p></p>';
                        column += '<div class="col-sm-1">';
                        column += '<input name="column['+x+'][data]" value="'+metrics[i].data+'" class="form-control" type="text">';
                        column += '</div>';
                        column += '<div class="col-sm-1">';
                        column += '<input name="column['+x+'][name]" value="'+metrics[i].name+'" class="form-control" type="text">';
                        column += '</div>';
                        column += '<div class="col-sm-1">';
                        column += '<input name="column['+x+'][title]" value="'+metrics[i].title+'" class="form-control" type="text">';
                        column += '</div>';
                        column += '<div class="col-sm-1">';
                        column += '<input name="column['+x+'][remark]" value="'+metrics[i].remark+'" class="form-control" type="text">';
                        column += '</div>';
                        column += '<div class="col-sm-1 text-center">';
                        if(metrics[i].visible == true) {
                            column += '<input value="0"  class="realList" name="column['+x+'][visible]" type="radio">隐藏';
                            column += '<input value="1"  class="realList" name="column['+x+'][visible]" checked="checked" type="radio">显示';
                        } else {
                            column += '<input value="0"  class="realList" name="column['+x+'][visible]" checked="checked" type="radio">隐藏';
                            column += '<input value="1"  class="realList" name="column['+x+'][visible]" type="radio">显示';
                        }
                        column += '</div>';
                        column += '<div class="col-sm-1 text-center">';
                        if(metrics[i].searchable == true) {
                            column += '<input value="0"  class="realList" name="column['+x+'][searchable]" type="radio">否';
                            column += '<input value="1"  class="realList" name="column['+x+'][searchable]" checked="checked" type="radio">是';
                        } else {
                            column += '<input value="0"  class="realList" name="column['+x+'][searchable]" checked="checked" type="radio">否';
                            column += '<input value="1"  class="realList" name="column['+x+'][searchable]" type="radio">是';
                        }
                        column += '</div>';
                        column += '<div class="col-sm-1 text-center">';
                        if(metrics[i].orderable == true) {
                            column += '<input value="0"  class="realList" name="column['+x+'][orderable]" type="radio">否';
                            column += '<input value="1"  class="realList" name="column['+x+'][orderable]" checked="checked" type="radio">是';
                        } else {
                            column += '<input value="0"  class="realList" name="column['+x+'][orderable]" checked="checked" type="radio">否';
                            column += '<input value="1"  class="realList" name="column['+x+'][orderable]" type="radio">是';
                        }
                        column += '</div>';
                        column += '<div class="col-sm-1 text-center">';
                        if(metrics[i].columnType == '1') {
                            column += '<input value="1"  class="realList" name="column['+x+'][column_type]" checked="checked" type="radio">维度';
                            column += '<input value="2"  class="realList" name="column['+x+'][column_type]" type="radio">';
                        } else {
                            column += '<input value="1"  class="realList" name="column['+x+'][column_type]" type="radio">维度';
                            column += '<input value="2"  class="realList" name="column['+x+'][column_type]" checked="checked" type="radio">指标';
                        }
                        column += '</div>';
                        column += '<div class="col-sm-1">';
                        column += '<input name="column['+x+'][width]" value="" class="form-control" type="text">';
                        column += '</div>';
                        column += '<div class="col-sm-1">';
                        column += '<select name="column['+x+'][data_type]" class="form-control m-b config">';
                        column += '<option value="date" ';
                        if(metrics[i].dataType == 'date'){ column +='selected'}
                        column += '>日期型</option>';
                        column += '<option value="string" ';
                        if(metrics[i].dataType == 'string'){ column +='selected'}
                        column += '>字符型</option>';
                        column += '<option value="int" ';
                        if(metrics[i].dataType == 'int'){ column +='selected'}
                        column += '>整形</option>';
                        column += '<option value="double" ';
                        if(metrics[i].dataType == 'double'){ column +='selected'}
                        column += '>浮点型</option>';
                        column += '</select>';
                        column += '</div>';
                        column += '<div class="col-sm-1 text-center">';
                        column += '<a class="btn btn-primary delColumn" >删除</a>';
                        column += '</div>';
                        column += '<label class="control-label up" style="float: left">向上</label>';
                        column += '<label class="control-label down" style="float: left">向下</label>';
                        column += '<input name="" value="" class="form-control key" type="hidden">';
                        column += '</div>';
                    });
                    $.getScript("/assets/tj/js/plugins/datapicker/bootstrap-datepicker.js");
                    $.getScript("/assets/tj/js/demo/datepicker.js");
                    $.getScript("/assets/tj/js/common/mobile.js");
                    $("#column").append(column);
                    $("#filter").append(filter);


                }
            });
        });
    });

    $('._submit').click(function(){
        var val = window['editor_0'].getValue();
        document.getElementById('content').value = val;
    });

    window.parent.fullHide()
</script>

<script>
    //创建所有时间模板变量
    //返回一个数组，数组内容ajax后台获取，数组中元素格式:@表名_MAP字段名_MAPKEY
    function getMapTemplates() {
        var s = new Array();
        $.ajax({
            type: "POST",
            url: "../Manager/getMapHint",
            data: {},
            dataType: "json",
            success: function(ret){
                if(ret.code == 1){
                    var map = ret.data;
                    for (var i = 0; i < map.length; i++) {
                        s.push(map[i]);
                    }
                }
            }
        });
        return s;
    }
    var mapTemplate = getMapTemplates();
    window.onload = function () {
        var num = 0;
        $.getJSON("../Manager/getSchema", {}, function (result) {
            window['editor_' + num] = CodeMirror.fromTextArea(document.getElementById('content'), {
                mode: 'text/x-hive',
                indentWithTabs: true,
                smartIndent: true,
                styleActiveLine: true,
                lineNumbers: true,
                lineWrapping: true,
                matchBrackets: true,
                //autofocus: true,
                extraKeys: {"Ctrl-Space": "autocomplete"},
                hintOptions: {
                    tables: result.data,
                    mapTemplates: mapTemplate //从后台获取自定义Map Hint赋值给mapTemplates属性
                }
            });
            window['editor_' + num].on("keyup", function (cm, event) {
                //所有的字母和'$','{','.'在键按下之后都将触发自动完成
                if (!cm.state.completionActive &&
                    ((event.keyCode >= 65 && event.keyCode <= 90 ) || event.keyCode == 52 || event.keyCode == 219 || event.keyCode == 190 || event.keyCode == 50)) {
                    CodeMirror.commands.autocomplete(cm, null, {completeSingle: false});
                }
            });
        });
    };
</script>
