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
                <div class="ibox-title">
                    <h5>配置列表</h5>
                </div>
                <div class="ibox-content">
                    <div class="col-sm-1 m-b-xs">
                        <div class="text-center">
                            <a href="<?php echo site_url($controller, 'filterInfo', array('cid' => $cid)); ?>" class="btn btn-primary">添加过滤配置</a>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="table1">
                        <thead>
                        <tr bgcolor="#2f4050">
                            <th >编号</th>
                            <th >过滤组</th>
                            <th >类型</th>
                            <th >data</th>
                            <th >名称</th>
                            <th >标题</th>
                            <th >开始</th>
                            <th >结束</th>
                            <th >value</th>
                            <th >format</th>
                            <th >操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($list) <= 0){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="center">没有获取到数据</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php }else{ foreach($list as $v){ ?>
                            <tr class="gradeX">
                                <td class="id"><?php echo $v['id'] ?></td>
                                <td><?php echo $v['group']; ?></td>
                                <td><?php echo $v['title']; ?></td>
                                <td><?php echo $v['type']; ?></td>
                                <td><?php echo $v['data']; ?></td>
                                <td><?php echo $v['name']; ?></td>
                                <td><?php echo $v['title']; ?></td>
                                <td><?php echo $v['begin']; ?></td>
                                <td><?php echo $v['end']; ?></td>
                                <td><?php echo $v['value']; ?></td>
                                <td><?php echo $v['format']; ?></td>
                                <td>
                                    <a class="btn btn-primary" href="<?php echo site_url($controller, 'addLists', array('id' => $v['id']) ); ?>">编辑</a>
                                    <a href="javascript:;"  class="btn btn-primary send" status="0" data-toggle="modal">删除</a>
                                </td>
                            </tr>
                        <?php } } ?>
                        </tbody>
                    </table>

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
<script src="/assets/tj/js/demo/freezeheader.js"></script>
<script>
    $(document).ready(function(){
        $("#table1").freezeHeader();
        $('.send').click(function(){
            var status = $(this).attr('status');
            var id = $(this).parent().siblings(".id").text();
            if(status == 0) {
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
                        url: "status",
                        data: {id:id, status:status},
                        dataType: "json",
                        success: function(ret){
                            if(ret.code == 1){
                                if(ret.forward){
                                    window.location.href = ret.forward;
                                }else{
                                    prompt(ret.code, ret.msg);
                                    setTimeout(function(){
                                        location.replace(location.href);
                                    },2000)
                                }

                            }else{
                                prompt(ret.code, ret.msg)
                            }
                        }
                    });
                })
            } else {
                $.ajax({
                    type: "POST",
                    url: "status",
                    data: {id:id, status:status},
                    dataType: "json",
                    success: function(ret){
                        if(ret.code == 1){
                            if(ret.forward){
                                window.location.href = ret.forward;
                            }else{
                                prompt(ret.code, ret.msg);
                                setTimeout(function(){
                                    location.replace(location.href);
                                },2000)
                            }

                        }else{
                            prompt(ret.code, ret.msg)
                        }
                    }
                });
            }
        });
    })
</script>

</body>
</html>
<script type="text/javascript">
    window.parent.fullHide()
</script>
