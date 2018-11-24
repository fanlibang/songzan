<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提示信息</title>
<style type="text/css">
*{margin:0;padding:0px}
body{background:#fff;color:#333;font:12px Verdana, Tahoma, sans-serif;text-align:center;margin:0 auto;}
a{text-decoration:none;color:#29458C}
a:hover{text-decoration:underline;color:#f90}
#msg{border:1px solid #c5d7ef;text-align:left;margin:10% auto; width:50%}
#msgtitle{padding:5px 10px;background:#f0f6fb;border-bottom:1px #c5d7ef solid}
#msgtitle h1{font-size:14px;font-weight:bold;padding-left:10px;border-left:3px solid #acb4be;color:#1f3a87}
#msgcontent {padding:20px 50px;}
#msgcontent li{display:block;padding:5px;list-style:none;}
#msgcontent p{text-align:center;margin-top:10px;padding:0}
</style>
</head>
<body>
<div id="msg">
	<div id="msgtitle">
		<h1>提示信息</h1>
	</div>
	<div id="msgcontent">
		<p><?php echo $message;?></p>
	</div>
	<div id="msgcontent">
		<p><a href="<?php echo $url;?>" target="_parent">点击跳转</a> </p>
	</div>
</div>
<?php if($url){?>
<script type="text/javascript">
//setTimeout(function(){window.location.href = '<?php echo $url;?>';},2000);
</script>
<?php }?>
</body>
</html>