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
                    <h5><?= $view_title; ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="col-sm-1 m-b-xs">
                        <div class="text-center">
                            <a href="<?php echo site_url($controller, 'dataConfigInfo', array('type' => 'add')); ?>" class="btn btn-primary">添加</a>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="table1">
                        <thead>
                        <tr bgcolor="#2f4050">
                            <th >报表id</th>
                            <th >报表名称</th>
                            <th >标题</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($list) <= 0){ ?>
                            <tr>
                                <td></td>
                                <td class="center">没有获取到数据</td>
                                <td></td>
                            </tr>
                        <?php }else{ foreach($list as $v){ ?>
                            <tr class="gradeX">
                                <td class="id"><?php echo $v['id'] ?></td>
                                <td class="project"><?php echo $v['name']; ?></td>
                                <td class="template"><?php echo $v['title'] ?></td>
                                <td>
                                    <a class="btn btn-primary" href="<?php echo site_url($controller, 'dataConfigInfo', array('type' =>'edit', 'id' => $v['id']) ); ?>">编辑</a>
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

</body>
</html>
<script type="text/javascript">
    window.parent.fullHide()
</script>
