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

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="min-height:60px;">
                    <div style="float:left" >
                        <a class="btn btn-primary" style="margin:0px;"  href="<?php echo site_url($controller, 'filterLists', array('cid' => $cid)); ?>" >返回</a>
                    </div>
                    <label class="" style="padding-left:10px;float: left; font-size:24px;">编辑信息</label>
                </div>
                <div class="ibox-content" >
                    <form method="post" id="configList" class="form-horizontal" action="<?php echo site_url($controller, $method); ?>">
                        <input type="hidden" name="id" value="<?php echo $list['id']; ?>" >

                        <div class="form-group">
                            <label class="col-sm-2 control-label">名称</label>
                            <div class="col-sm-4">
                                <input type="text" name="group" value="<?php echo $list['group']?>" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">元素类型</label>
                            <div class="col-sm-3">
                                <select name="type" id="type" class="form-control">
                                    <option value="text" <?php echo $list['text'] == '1' ? 'selected' : '';?> >text</option>
                                    <option value="dic" <?php echo $list['dic'] == '2' ? 'selected' : '';?>>dic自动</option>
                                    <option value="dic" <?php echo $list['dic'] == '2' ? 'selected' : '';?>>dic手写</option>
                                    <option value="date" <?php echo $list['date'] == '2' ? 'selected' : '';?>>date</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">data</label>
                            <div class="col-sm-4 type">
                                <input type="text" name="data" value="<?php echo $list['data']?>" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">名称</label>
                            <div class="col-sm-4">
                                <input type="text" name="name" value="<?php echo $list['name']?>" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">标题</label>
                            <div class="col-sm-4">
                                <input type="text" name="title" value="<?php echo $list['title']?>" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group" id="data_5">
                            <label class="col-sm-2 control-label" >日期</label>
                            <div class="col-sm-1 input-daterange" id="datepicker">
                                <input type="text" class=" form-control" name="begin" value="<?php echo $begin; ?>" />
                                <span class="input-group-addon">到</span>
                                <input type="text" class=" form-control" name="end" value="<?php echo $end; ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">value</label>
                            <div class="col-sm-4">
                                <input type="text" name="value" value="<?php echo $list['value']?>" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">format</label>
                            <div class="col-sm-4">
                                <input type="text" name="format" value="<?php echo $list['format']?>" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group right">
                            <div class="col-sm-12 text-right">
                                <input type="hidden" name="id" value="<?= $list['id'] ?>">
                                <a class="btn btn-primary _submit" >完成</a>
                            </div>
                        </div>
                    </form>
                </div>
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
<script>
    $(document).ready(function(){$(".dataTables-example").dataTable();});
</script>

<script src="/assets/tj/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="/assets/tj/js/common/base.js"></script>
<script src="/assets/tj/js/common/common.js"></script>
<script src="/assets/tj/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="/assets/tj/js/demo/datepicker.js"></script>

</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        $("#type").change(function () {
            var type = $("#type").find('option:selected').text();
            var html = '';
            if(type == 'dic自动') {
                $.ajax({
                    type: "POST",
                    url: "getConfig",
                    data: {type: type},
                    dataType: "json",
                    success: function (ret) {
                        if(ret.code == 1) {
                            html += ret.msg;
                            $(".type").empty();
                            $(".type").append(html);
                        }
                    }
                });
            } else {
                html += '<input type="text" name="data" value="" class="form-control" >';
                $(".type").empty();
                $(".type").append(html);
            }
        });
    });

    $(document).on('change',".dic",function(){
        var id = $(this).val();
        var html = '';
        $.ajax({
            type: "POST",
            url: "getCodeConfig",
            data: {id: id},
            dataType: "json",
            success: function (ret) {
                if(ret.code == 1) {
                    html += ret.msg;
                    $(".type").empty();
                    $(".type").append(html);
                }
            }
        });
    });

    window.parent.fullHide()
</script>
