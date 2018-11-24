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

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="min-height:60px;">
                    <div style="float:left" >
                        <a class="btn btn-primary" style="margin:0px;"  href="<?php echo site_url($controller, 'dictionaryData'); ?>" >返回</a>
                    </div>
                    <label class="" style="padding-left:10px;float: left; font-size:24px;">编辑信息</label>
                </div>
                <div class="ibox-content" >
                    <form method="post" id="configList" class="form-horizontal" action="<?php echo site_url($controller, $method); ?>">
                        <input type="hidden" name="type" id="id" value="<?php echo $type; ?>" >

                        <div class="form-group">
                            <label class="col-sm-2 control-label" >字典编码</label>
                            <div class="col-sm-4">
                                <input type="text" name="code" <?php if($type == 'edit') { echo 'readonly'; } ?> value="<?php echo $code ?>" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group right">
                            <div class="col-sm-12 text-right">
                                <a class="btn btn-primary _submit" >完成</a>
                            </div>
                        </div>

                        <div class="ibox-content" id="column">
                            <input type="hidden" name="count" id="count" value="<?php echo count($list) ? count($list) : 0; ?>">
                            <div class="row">
                                <label class="col-sm-1 control-label "><a href="javascript:;"  class="btn btn-primary addConfig">添加配置</a></label>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 text-center">
                                    <p title="字典子编码,对应的下拉列表的value" >value</p>
                                </div>

                                <div class="col-sm-4 text-center">
                                    <p title="值，对应的下拉列表的lable">lable</p>
                                </div>

                                <div class="col-sm-4 text-center">
                                    <p>操作</p>
                                </div>
                            </div>

                            <?php if(count($list) > 0){ foreach($list as $k => $v){ ?>
                                <div class="row">
                                    <p></p>
                                    <div class="col-sm-4">
                                        <input name="sub_code[<?= $k; ?>]" value="<?= $v['sub_code']; ?>" title="字典子编码,对应的下拉列表的value" class="form-control" type="text">
                                    </div>

                                    <div class="col-sm-4">
                                        <input name="value[<?= $k; ?>]" value="<?= $v['value']; ?>" title="值，对应的下拉列表的lable" class="form-control sub_code" type="text">
                                    </div>

                                    <div class="col-sm-4 text-center">
                                        <input type="hidden" id='code' name="id" value="<?= $code; ?>" />
                                        <a class="btn btn-primary delDic" value="<?= $v['sub_code']; ?>" >删除</a>
                                    </div>
                                </div>
                            <?php } } ?>
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
<script src="/assets/tj/js/common/mobile.js"></script>

</body>
</html>
<script type="text/javascript">

    $(document).on('click',".delDic",function(){
        var id = $(this).prev().val();
        var sub_code = $(this).attr('value');
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
                url: "delDic",
                data: {id:id,sub_code:sub_code},
                dataType: "json",
                success: function(ret){
                    if(ret.code == '1') {
                        swal.close();
                        div.fadeOut(1000);
                    } else {
                        prompt(ret.code, ret.msg);
                    }
                }
            });
        })
    });

    $(document).ready(function() {
        $(".addConfig").click(function () {
            var num = $("#count").val();
            var code = "<?= $code; ?>";
            num = parseInt(num) + 1;
            var html = '';
            html += '<div class="row">';
            html += '<p></p>';
            html += '<div class="col-sm-4">';
            html += '<input name="sub_code['+num+']" value="" class="form-control" title="字典子编码,对应的下拉列表的value" type="text">';
            html += '</div>';
            html += '<div class="col-sm-4">';
            html += '<input name="value['+num+']" value="" class="form-control" title="值，对应的下拉列表的lable" type="text">';
            html += '</div>';
            html += '<div class="col-sm-4 text-center">';
            html += '<input type="hidden" name="id" value="'+code+'" />';
            html += '<a class="btn btn-primary delDic" >删除</a>';
            html += '</div>';
            html += '</div>';
            $("#column").append(html);
            $("#count").val(num);
        });
    });
    window.parent.fullHide()
</script>
