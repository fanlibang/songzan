<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $site_title; ?></title>
    <link href="<?php echo $dwz_path; ?>themes/css/login.css" rel="stylesheet" type="text/css" />
    <link type="image/vnd.microsoft.icon" href="<?php echo $assets_path; ?>favicon.ico" rel="shortcut icon" />
    <script src="<?php echo $dwz_path; ?>js/jquery-1.7.2.min.js" type="text/javascript"></script>
</head>

<body>
<div id="login">
    <div id="login_header">
        <h1 class="login_logo">
        </h1>
        <div class="login_headerContent">
            <div class="navList">
                <ul>
                    <li><a href="javascript:;" class="_set_index">设为首页</a></li>
                    <li><a href="javascript:;">反馈</a></li>
                    <li><a href="javascript:;">帮助</a></li>
                    <li style="display: none"><a href="<?php echo site_url('Login', 'register'); ?>" >立即注册</a></li>
                </ul>
            </div>
            <h2 class="login_title"><img src="<?php echo $dwz_path; ?>themes/default/images/login_title.png" /></h2>
        </div>
    </div>
    <div id="login_content">
        <div class="loginForm">
            <script type="text/javascript">
                function checkAgent(){
                    //强制推荐使用火狐或者chrom浏览器
                    var explorer = window.navigator.userAgent ;
                    var _is_alert_explorer = true;
                    if(explorer.indexOf("Firefox") >= 0 || explorer.indexOf("firefox") >= 0){
                        _is_alert_explorer = false;
                    }

                    if(explorer.indexOf("Chrome") >= 0 || explorer.indexOf("chrome") >= 0){
                        _is_alert_explorer = false;
                    }

                    if(explorer.indexOf("Safari") >= 0 || explorer.indexOf("safari") >= 0){
                        _is_alert_explorer = false;
                    }

                    if(_is_alert_explorer){
                        alert('请使用 火狐,Chrom 浏览器访问后台！感谢您的配合！');
                        return false;
                    }
                }
            </script>
            <form action="<?php echo site_url('Login', 'login'); ?>" method="post" id="_login_form" onsubmit="return checkAgent();">
<!--                <p style="display: --><?php //echo $more_login ? 'block' : 'none'; ?><!--">-->
<!--                    <label style="width: 60px">渠道：</label>-->
<!--                    <select class="combox" name="login_channel" id="login_channel" style="width: 100px">-->
<!--                        <option value="xyzs">XYZS账号</option>-->
<!--                        <option value="kingnet" selected>Kingnet账号</option>-->
<!--                    </select>-->
<!--                </p>-->
                <p></p>
                <p>
                    <input type="hidden" name="login_channel" value="xyzs" />
                    <label style="width: 60px">账号：</label>
                    <input type="text" name="user_name" class="login_input" style="width: 140px"/>
                </p>
                <p>
                    <label style="width: 60px">密码：</label>
                    <input type="password" name="password" class="login_input"  style="width: 140px"/>
                </p>
                <div class="login_bar"  style="padding-left: 70px;padding-top: 10px">
                    <input type="hidden" name="check_login" value="1"/>
                    <input class="sub" type="submit" name="submit" value=" " />
                </div>
            </form>
        </div>
        <div class="login_banner"><img src="<?php echo $dwz_path; ?>themes/default/images/login_banner.jpg" /></div>
    </div>
    <div id="login_footer">
    </div>
</div>
<script type="text/javascript" src="<?php echo $assets_path; ?>admin/js/admin.js"></script>
<script type="text/javascript ">
    $(function(){
        $('select[name=login_channel]').change(function(){
            var _self = $(this);
            var _val = _self.val();

            if(_val == 'xyzs'){
                $('#_login_form').attr('action','<?php echo site_url('Login', 'login'); ?>');
            }else{
                $('#_login_form').attr('action','<?php echo site_url('Api', 'kingnetLogin'); ?>');
            }
        });
    });
</script>
</body>
</html>