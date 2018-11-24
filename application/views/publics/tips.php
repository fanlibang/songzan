<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $page_title; ?></title>
    <meta content="<?php echo $page_keywords; ?>" name="keywords">
    <meta content="<?php echo $page_description; ?>" name="description">
    <link rel="shortcut icon" href="<?php echo STATIC_DOMAIN; ?>/www/img/favicon.ico" type="image/x-icon" />


    <link href="/assets/tj/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/assets/tj/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <link href="/assets/tj/css/animate.min.css" rel="stylesheet">
    <link href="/assets/tj/css/style.min.css?v=4.0.0" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="middle-box text-center animated fadeInRightBig">
                <h3 class="font-bold"><?php echo $message; ?></h3>
                <!--
                <div class="error-desc">
                    <input class="btn btn-primary" type="button" value="前往" onclick="window.location.href='<?php echo $url; ?>'"/><br />
                    如没有跳转，请点击 <a class="text-muted text-center" id="href" href="<?php echo $url; ?>">>>前往<<</a> 等待时间： <b id="wait">5</b>
                </div>
                -->
            </div>
        </div>
    </div>
</div>
<script src="/assets/tj/js/jquery.min.js?v=2.1.4"></script>
<script src="/assets/tj/js/bootstrap.min.js?v=3.3.5"></script>
</body>
<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();

</script>
<script type="text/javascript">
    window.parent.fullHide()
</script>
</html>