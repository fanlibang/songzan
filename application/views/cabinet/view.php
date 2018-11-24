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

    <link rel="shortcut icon" href="favicon.ico">
    <link href="/assets/tj/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/assets/tj/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/assets/tj/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/assets/tj/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/assets/tj/js/plugins/dataTables/colReorder.bootstrap.min.css" rel="stylesheet">
    <link href="/assets/tj/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/assets/tj/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="/assets/tj/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <style type="text/css">
        .dataTables_paginate li a{  color: #000; }
        table.dataTable thead th, table.dataTable thead td{  white-space: nowrap;  padding: 10px 18px;  }
        div.dataTables_scrollBody tbody tr:first-child td {white-space: nowrap; }
        div.dataTables_info {float: left;}
    </style>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= $info['title'];  ?></h5>
                </div>

                <div class="row">
                    <form role="form" id="queryForm" method="post" name="search_form">
                        <?php  foreach($info['filterGroups'] as $k => $v) { ?>
                            <?php  foreach($v as $key => $val) { ?>
                                <?php if($val['type'] == 'date')  { ?>
                                    <div class="col-sm-3 m-b-xs">
                                        <div class="form-group">
                                            <label style="padding-top: 8px; float: left;" ><?= $val['title']?>：</label>
                                            <div class="input-daterange input-group" id="format" date-format="<?php echo strtolower($val['format']); ?>">
                                                <input type="text" data-date-format="<?php echo strtolower($val['format']); ?>" class="input-mb form-control"  id="datepickerStart" name="ignore<?= $val['name']; ?>[0] ?>" value=""  />
                                                <span class="input-group-addon">到</span>
                                                <input type="text" data-date-format="<?php echo strtolower($val['format']); ?>" class="input-mb form-control" id="datepickerEnd" name="ignore<?= $val['name']; ?>[1]" value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="date" name="<?= $val['name']; ?>" value="2">
                                <?php } elseif($val['type'] == 'dic') { ?>
                                    <div class="col-sm-2 m-b-xs">
                                        <label style="padding-top: 8px; float: left;" ><?= $val['title']?>：</label>
                                        <div class="input-daterange input-group">
                                        <select name="<?= $val['name']; ?>" class="form-control">
                                            <?php foreach($val['options'] as $ke => $va) { ?>
                                                <option value="<?= $va['subCode']?>"  ><?= $va['value']?></option>
                                            <?php } ?>
                                        </select>
                                        </div>
                                    </div>
                                <?php } elseif($val['type'] == 'text') { ?>
                                    <div class="col-sm-2 m-b-xs">
                                        <label style="padding-top: 8px; float: left;" ><?= $val['title']?>：</label>
                                        <div class="input-daterange input-group">
                                            <input type="text" name="<?= $val['name']; ?>" value="<?php echo $list['data']?>" class="form-control" >
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                        <div class="input-group">
                            <a  href="javascript:;" id="search" class="btn btn-sm btn-primary" aria-hidden="true" data-dismiss="modal"> 查&nbsp;&nbsp;询</a>
                        </div>
                    </form>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <span>
                            <button type="submit" id="down" class="btn btn-mb btn-primary">下&nbsp;&nbsp;载</button> </span>
                        </span>
                        <span>
                            <button type="submit" id="clear" class="btn btn-mb btn-primary">清除缓存</button> </span>
                        </span>
                        <span>
                            <button type="submit" id="viewEchar" class="btn btn-mb btn-primary">显示图表</button> </span>
                            <button type="submit" id="viewTable" class="btn btn-mb btn-primary" style="display: none;">显示表格</button> </span>
                        </span>
                        <span>
                            <button data-target="#myModal" data-toggle="modal" id="fieldView" type="submit" class="btn btn-mb btn-primary">列名显示</button>
                            <input type="hidden" name="columns" id="columns" value=<?= json_encode($info['columns']); ?> >
                            <input type="hidden" id="displayMode" value="1">
                        </span>
                        <?php  if($is_super_admin) { ?>
                            <div style="float: right;">
                                <a class="btn btn-primary" target="_blank" style="margin:0px;"  href="<?php echo site_url($controller, 'dataConfigInfo', array('type' => 'edit', 'id' => $info['id'])); ?>" >编辑配置</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="ibox-content text-center" id="table">
                    <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    </table>
                </div>
                <div class="ibox-content"  id="echar" style="display:none">
                    <div class="row col-sm-12" id="main" style="height:670px; ">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
        <div class="modal-dialog" style="width:40%">
            <div class="modal-content" style="background-color: #2f4050;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">列名选择</h4>
                    </div>
                    <div class="table-responsive" style="margin:30px 30px;">
                        <ul class="list-group ">
                            <?php foreach($info['columns'] as $k => $v) { ?>
                                <li class="list-group-item col-sm-4 " >
                                    <label class="checkbox-inline i-checks" >
                                        <input type="checkbox" class="toggle-vis" name="fieldView" <?php if($v['visible'] == 'true') { echo 'checked="checked"'; } ?> data-column="<?= $k; ?>" value="<?php echo $v['name']; ?>"><?php echo $v['title']; ?>
                                    </label>
                                </li>
                            <?php } ?>
                        </ul>
                        <div class="input-group" style="padding-top: 10px;float:right;">
                            <a  href="javascript:;" id="check" class="btn btn-sm btn-primary" aria-hidden="true" data-dismiss="modal"> 确定</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<script src="/assets/tj/js/jquery.min.js?v=2.1.4"></script>
<script src="/assets/tj/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/assets/tj/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/assets/tj/js/plugins/dataTables/jquery.dataTables.min.js"></script>
<script src="/assets/tj/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/assets/tj/js/plugins/dataTables/dataTables.colReorder.js"></script>
<!--<script src="/assets/tj/js/plugins/dataTables/jquery.dataTables.js"></script>-->
<script src="/assets/tj/js/content.min.js?v=1.0.0"></script>
<script src="/assets/tj/js/demo/select.js"></script>
<script src="/assets/tj/js/echar/echarts.js"></script>
<script src="/assets/tj/js/echar/dark.js"></script>
<script src="/assets/tj/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="/assets/tj/js/plugins/datapicker/moment.min.js"></script>
<link href="/assets/tj/css/plugins/iCheck/custom.css" rel="stylesheet">
<script src="/assets/tj/js/plugins/iCheck/icheck.min.js"></script>


<script>
$(document).ready(function(){
    $(".i-checks").iCheck({checkboxClass:"icheckbox_square-green"})
});
</script>

<script>
    function dateFtt(date,fmt) {//author: meizz
        var o = {
            "m+" : date.getMonth()+1,                 //月份
            "d+" : date.getDate(),                    //日
            "h+" : date.getHours(),                   //小时
            "i+" : date.getMinutes(),                 //分
            "s+" : date.getSeconds(),                 //秒
            "q+" : Math.floor((date.getMonth()+3)/3), //季度
            "S"  : date.getMilliseconds()             //毫秒
        };
        if(/(y+)/.test(fmt))
            fmt=fmt.replace(RegExp.$1, (date.getFullYear()+"").substr(4 - RegExp.$1.length));
        for(var k in o)
            if(new RegExp("("+ k +")").test(fmt))
                fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
        return fmt;
    }


    $(document).ready(function(){
        $("#datepickerStart, #datepickerEnd").datepicker({
            keyboardNavigation:!1,
            forceParse:!1,
            autoclose:true,
            endDate:"-1d"
        }).on('changeDate',gotoDate);

        function gotoDate(){
            var strDate = $("#datepickerStart").val();
            var endDate = $("#datepickerEnd").val();
            $("#date").val(strDate+" - "+endDate);
            table.api().draw();
            var displayMode = $("#displayMode").val();
            if(displayMode == 2) {
                viewEchar();
            }
        }

        $(document).on('preInit.dt', function () {
            var api = new $.fn.dataTable.Api('#table1');
            var columns = $('#columns').val();
            columns = eval('(' + columns + ')');
            //为表头添加title,
            api.columns().flatten().each(function (i) {
                var title = api.column(i).header();
                $(title).attr("title", columns[i].remark);
                $(title).attr("data-toggle", 'tooltip');
                $(title).attr("data-placement", 'top');
            });
            $(".dataTable>thead>tr").attr('class', 'tooltip-demo');
        });

        var format = $("#format").attr('date-format');
        var str_Date = (moment().subtract(7, 'days'));
        var strDate = dateFtt(str_Date._d,format);
        var end_Date = (moment().subtract(1, 'days'));
        var endDate = dateFtt(end_Date._d,format);
        $("#datepickerStart").val(strDate);
        $("#datepickerEnd").val(endDate);
        $("#date").val(strDate+" - "+endDate);
        var path = 'http://rcmd-api.xyzs.com:7003/reporter-service-api/api/v1/reporter/query/'+"<?php echo $info['id']; ?>";

        var table = $('#table1').dataTable({
//            select: true,
            scrollX: true, //显示水平滚动条
            searching : false, //去除搜索
            pageLength: <?= $info['query']['limit'] ? $info['query']['limit'] : 20; ?>,
            //https://datatables.net/reference/option/dom
            serverSide: true,//分页，取数据等等的都放到服务端去
            processing: true,//载入数据的时候是否显示“载入中”
            colReorder: true,
            "stateSave": true,
            "order": [[ 0, "desc" ]],
            ajax: {
                type: "post",
                url: path,
                dataSrc: "data",
                dataType: "json",
                contentType: 'application/json',
                mimeType: 'application/json',
                data: function (d) {
                    //console.log(JSON.stringify(d));
                    var param = {};
                    var formData = $("#queryForm").serializeArray();//把form里面的数据序列化成数组
                    formData.forEach(function (e) {
                        if (e.name.indexOf('ignore') === -1 && e.value !== '') {
                            if($(this).attr('id') == 'date') {
                                param[e.name] = ignore
                            } else {
                                param[e.name] = e.value;
                            }
                        }
                    });
                    //自定义参数放在custom map中
                    d['custom'] = param;
                    return JSON.stringify(d);//自定义需要传递的参数。
                }
            },
            "columns": <?= json_encode($info['columns']); ?>
        });

        $("#search").click(function() {
            var displayMode = $("#displayMode").val();
            table.api().draw();
            if(displayMode == 2) {
                viewEchar();
            }
        });

        $("#down").click(function() {
            var url = "http://rcmd-api.xyzs.com:7003/reporter-service-api/reporter/export/"+"<?php echo $info['id']; ?>"+"?params=" + encodeURIComponent(table.api().ajax.params());
            window.open(url, "_blank");
        })

        $("#clear").click(function() {
            var url = 'http://rcmd-api.xyzs.com:7003/reporter-service-api/api/v1/reporter/cache/clean/'+"<?php echo $info['id']; ?>";
            $.ajax({
                url: url,
                type: 'DELETE'
            }).done(function (data, textStatus, jqXHR) {
                if (data === 'success') {
                    alert("清理成功");
                } else {
                    alert("清理失败");
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                alert("清理失败" + textStatus);
            });
        });

        // 填入数据
        $("#viewEchar").click(function() {
            viewEchar();
            $("#displayMode").val(2);
        })

        function viewEchar() {
            $("#table").hide();
            $("#echar").show();
            $("#viewEchar").hide();
            $("#viewTable").show();
            var info = table.api().ajax.json();
            var container = <?php echo $columnType; ?>;
            info = info.data;
            var datas = [];
            var filed = '';
            var categories = [];
            var legendData= [];
            var data = [];
            info.sort();
            //获取x轴的维度
            $(info).each(function(i){
                categories.push(info[i].<?php echo $dataType; ?>);
            });
            //arrSimple.sort();

            //生成data数据
            $(container).each(function(i){
                datas = [];
                legendData.push(container[i]['title']);
                filed = container[i]['name'];
                $(info).each(function(x){
                    datas.push(info[x][filed]);
                });
                data.push({name:container[i]['title'],type:'line', data:datas});
            });
            //图标初始化
            var myChart = echarts.init(document.getElementById('main'), 'dark');
            myChart.setOption({
                tooltip: {
                    trigger: 'item',
                    formatter: '{a} <br/>{b} : {c}'
                },

                legend: {
                    data:legendData,
                    selected:<?php echo $selected; ?>
                },

                xAxis: {
                    data: categories
                },
                yAxis: {
                    splitLine: {
                        show: true, //代表横向分隔线
                        lineStyle: {
                            // 使用深浅的间隔色
                            color: ['#4b5465']
                        }
                    }
                },
                series: data
            });
        }

        $("#viewTable").click(function() {
            //图标初始化
            table.api().draw();
            $("#table").show();
            $("#echar").hide();
            $("#viewEchar").show();
            $("#viewTable").hide();
            $("#displayMode").val(1);
        });


        $('#check').click(function () {
            $(".toggle-vis").each(function(){
                if($(this).is(":checked")) {
                    table.api().column($(this).attr('data-column')).visible(true);
                } else {
                    table.api().column($(this).attr('data-column')).visible(false);
                }
            });
            var table_info = localStorage.getItem("DataTables_table1_/dev/Cabinet/view");
            table_info = eval('(' + table_info + ')');
            table_info = JSON.stringify(table_info['columns']);
            document.cookie="<?php echo $info['id']; ?>="+table_info;
        });
        $.getScript("/assets/tj/js/content.min.js");
    });
</script>


</body>
</html>
<script type="text/javascript">
    window.parent.fullHide()
</script>
