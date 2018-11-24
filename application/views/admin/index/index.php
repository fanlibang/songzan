<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <title><?php echo $site_title; ?></title>

    <link type="image/vnd.microsoft.icon" href="<?php echo $assets_path; ?>favicon.ico" rel="shortcut icon" />
    <link href="<?php echo $dwz_path; ?>themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="<?php echo $dwz_path; ?>themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="<?php echo $dwz_path; ?>themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
    <link href="<?php echo $dwz_path; ?>uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
    <!--[if IE]>
    <link href="<?php echo $dwz_path; ?>themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
    <![endif]-->
    <style type="text/css">
        #header{height:85px}
        #leftside, #container, #splitBar, #splitBarProxy{top:90px}
    </style>
    <link href="<?php echo $assets_path; ?>admin/css/admin_common.css" rel="stylesheet" type="text/css" media="screen"/>
    <script type="text/javascript">
        var CONF = CONF || {};
        CONF['http_host']       = "<?php echo HTTP_HOST; ?>";
        CONF['curr_domain']     = "<?php echo curr_domain(); ?>";
    </script>
    <!--[if lte IE 9]>
    <script src="<?php echo $dwz_path; ?>js/speedup.js" type="text/javascript"></script>
    <![endif]-->
    <script src="<?php echo $dwz_path; ?>js/jquery-1.7.2.min.js" type="text/javascript"></script>
    <script src="<?php echo $dwz_path; ?>js/jquery.cookie.js" type="text/javascript"></script>
    <script src="<?php echo $dwz_path; ?>js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo $dwz_path; ?>js/jquery.bgiframe.js" type="text/javascript"></script>
    <script src="<?php echo $dwz_path; ?>uploadify/scripts/jquery.uploadify.min.js" type="text/javascript"></script>

    <!-- svg图表  supports Firefox 3.0+, Safari 3.0+, Chrome 5.0+, Opera 9.5+ and Internet Explorer 6.0+ -->
    <script type="text/javascript" src="<?php echo $dwz_path; ?>chart/raphael.js"></script>
    <script type="text/javascript" src="<?php echo $dwz_path; ?>chart/g.raphael.js"></script>
    <script type="text/javascript" src="<?php echo $dwz_path; ?>chart/g.bar.js"></script>
    <script type="text/javascript" src="<?php echo $dwz_path; ?>chart/g.line.js"></script>
    <script type="text/javascript" src="<?php echo $dwz_path; ?>chart/g.pie.js"></script>
    <script type="text/javascript" src="<?php echo $dwz_path; ?>chart/g.dot.js"></script>

    <script type="text/javascript" charset="utf-8" src="<?php echo $assets_path; ?>/ueditor2/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="<?php echo $assets_path; ?>/ueditor2/news_ueditor.config.js"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="<?php echo $assets_path; ?>/ueditor2/lang/zh-cn/zh-cn.js"></script>

    <script src="<?php echo $dwz_path; ?>bin/dwz.min.js" type="text/javascript"></script>
    <script src="<?php echo $dwz_path; ?>js/dwz.regional.zh.js" type="text/javascript"></script>

    <script type="text/javascript">
        function closePhone(){
            alertMsg.info('请务必绑定手机号码，下次登录将要使用手机发送验证码验证登录~')
        }

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

        var _explorer_key = 0;
        var _explorer_tips = [
            '请选择点击确定下载火狐浏览器再登录后台使用，谢谢~',
            '亲，火狐浏览器真的不错哦~',
            'chrome 也是可以的哦~',
            '就选chrome吧，我将代表XY后台开发程序员感谢你~',
            '哎,就这么愉快的决定了，去下载火狐了~'
        ];

        var _explorer_key_len = _explorer_tips.length;
        function closeExplorer(){
            alertMsg.confirm(_explorer_tips[_explorer_key], {
                okCall: function(){
                    if(_explorer_key >= 2 ){
                        window.location.href = "http://www.google.cn/intl/zh-CN/chrome/";
                    }else{
                        window.location.href = "http://www.firefox.com.cn/download/";
                    }
                },
                cancelCall:function(){
                    _explorer_key++;

                    if(_explorer_key >= _explorer_key_len){
                        window.location.href = "http://www.firefox.com.cn/download/";
                    }

                    closeExplorer();
                }
            });
        }

        $(function(){
            DWZ.init("<?php echo $dwz_path; ?>dwz.frag.xml", {
//                loginUrl:"<?php //echo site_url('Login', 'loginDialog') ?>//", loginTitle:"登录",	// 弹出登录对话框
		        loginUrl:"<?php echo site_url('Login', 'login') ?>",	// 跳到登录页面
                statusCode:{ok:200, error:300, timeout:301}, //【可选】
                keys: {statusCode:"statusCode", message:"message"}, //【可选】
                pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
                debug:false,	// 调试模式 【true|false】
                callback:function(){
                    initEnv();
                    $("#themeList").theme({themeBase:"<?php echo $dwz_path; ?>themes"});
                    //setTimeout(function() {$("#sidebar .toggleCollapse div").trigger("click");}, 10);

                    <?php if(empty($admin_user_info['tel']) && $sms_login) { ?>//没有绑定手机提示绑定手机
                    $.pdialog.open("<?php echo site_url("Users", "editUserPhone"); ?>", "edit_user_phone", "管理员绑定手机", {close:closePhone,height: 210,mask:true});
                    <?php }else{ ?>
                    if(_is_alert_explorer){
                        setTimeout(function(){
                            $.pdialog.open("<?php echo site_url("Publics", "alertExplorer"); ?>", "alert_explorer", "推荐使用浏览器", {close:closeExplorer,width:320,height:200,mask:true,drawable:false,minable:false,fresh:true});
                        }, 3000);
                    }
                    <?php } ?>
                }
            });

            //输入框修改操作
            $('._edit_td').die().live('click',function(){
                var _self = $(this);
                var _input_val =  _self.find('input').val();
                _self.find('font').text('');
                _self.find('input').show();
                _self.find('input').val('').focus().val(_input_val);

                _self.find('input').die().live('blur',function(){
                    var _self1 = $(this);
                    //当前数值
                    var _old_val = _self1.attr('data-value');
                    var _val = _self1.val();

                    if(_old_val == _val){
                        _self1.siblings('font').text(_val);
                        _self1.hide();
                        return false;
                    }
                    var _action = _self1.attr('data-action') ? _self1.attr('data-action') : null;

                    if(_action){
                        alertMsg.confirm("您修改的资料未保存，请选择确定或取消！", {
                            okCall: function(){
                                //获取表单地址 便于统一提交操作
                                var ajax_url = _action + '&value=' + _val;
                                //插入指定input输入框 data-sort=xx 当前排序值（提交时比对）
                                $.getJSON(ajax_url, { _t: (new Date()).valueOf() }, function(json){
                                    if(json.statusCode == 200){
                                        _self1.siblings('font').text(_val);
                                        _self1.hide();
                                        _self1.attr('data-value', _val);
                                        alertMsg.correct('修改成功！');
                                    }else{
                                        _self1.siblings('font').text(_old_val);
                                        _self1.hide();
                                        alertMsg.error('修改失败！');
                                    }
                                });
                            },
                            cancelCall: function(){
                                _self1.siblings('font').text(_old_val);
                                _self1.hide();
                            }
                        });
                    }
                });
            });

            //示例
            //<td class="_edit_td">
            //   <font style="line-height: 21px">value</font>
            //   <input class="_edit_input" type="text" data-value="value" data-action="url" size="7" value="value" style="display: none">
            //</td>

            //点击链接修改
            $('._edit_td_change').die().live('click',function(){
                var _self = $(this);
                var _value = _self.attr('data-value');

                var _action = _self.attr('data-action') ? _self.attr('data-action') : null;

                if(_action){
                    alertMsg.confirm("您修改的资料未保存，请选择确定或取消！", {
                        okCall: function(){
                            //获取表单地址 便于统一提交操作
                            var ajax_url = _action + '&value=' + _value;
                            $.getJSON(ajax_url, {_t: (new Date()).valueOf() }, function(json){
                                if(json.statusCode == 200){
                                    var _values = _self.attr('data-value-arr');
                                    var _value_arr = _values.split('|');
                                    $.each( _value_arr, function(i, n){
                                        var _n_arr = n.split('#');

                                        if(_n_arr[0] == _value){
                                            _self.attr('data-value',_n_arr[1]);
                                            _self.text(_n_arr[2]);
                                            _self.css("color",_n_arr[3]);
                                        }
                                    });
                                    alertMsg.correct('修改成功！');
                                }else{
                                    alertMsg.error('修改失败！');
                                }
                            });
                        }
                    });
                }
            });

            //示例
            //<td class="_edit_td_change"  style="color:blue;cursor: pointer" data-action="url" data-value-arr="2#1#预估数据#red|1#2#真实数据#blue" data-value="value">value_name</td>

            //下拉框动态修改
            $('._select_td_change').die().live('change', function(){
                var _self = $(this);
                var _action = _self.attr('data-action');
                var _val = _self.val();

                if(_action){
                    alertMsg.confirm("您修改的资料未保存，请选择确定或取消！", {
                        okCall: function(){
                            //获取表单地址 便于统一提交操作
                            var ajax_url = _action + '&value=' + _val;
                            $.getJSON(ajax_url, {_t: (new Date()).valueOf() }, function(json){
                                if(json.statusCode == 200){
                                    alertMsg.correct('修改成功！');
                                }else{
                                    alertMsg.error('修改失败！');
                                }
                            });
                        }
                    });
                }
            });

        });
    </script>
    <style type="text/css" media="screen">
        /*上传样式*/
        .my-uploadify-button {
            background:none;
            border: none;
            text-shadow: none;
            border-radius:0;
        }

        .uploadify:hover .my-uploadify-button {
            background:none;
            border: none;
        }

        .fileQueue {
            width: 400px;
            height: 55px;
            overflow: auto;
            border: 1px solid #E5E5E5;
            margin-bottom: 10px;
        }
        /*审核样式*/
        ul.pub_status li{
            float: left;
            padding: 5px;
            text-align: center;
            background-color: #CECECE;
            margin: 1px;
            cursor: pointer;
        }
        ul.pub_status li.select{/*当前*/
            background-color:#50BE50;
        }
        ul.pub_status li.active{/*下一步*/
            background-color:#6FFFFF;
        }
        ul.pub_status li.disabled{
            background-color:#CECECE;
        }
        /*应用编辑页面样式*/
        .appImg{}
        .appImg li{
            clear: none;
            float: left;
            width: 120px;
        }
        .appImg img{
            height: 146px;width: 98px ;padding:6px;cursor: pointer;border: 1px solid #DEDEDE;
        }
        .appImg .imgSelect{
            background-color:#55A745;
        }

        .indexSiteDev{
            margin-top: 50px;
        }
        .indexSiteDev img{
            width: 25%;height: 25%;border: 1px solid #C0C0C0;margin-left: 50px
        }

        table.mytable {
            font-family: verdana,arial,sans-serif;
            font-size:11px;
            color:#333333;
            border-width: 1px;
            border-color: #B8D0D6;
            border-collapse: collapse;
        }
        table.mytable th {
            background-color:#EEF4F5;
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #B8D0D6;
        }
        table.mytable td {
            background-color:#FFFFFF;
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #B8D0D6;
        }

    </style>
    <script type="text/javascript" src="<?php echo $assets_path; ?>admin/js/admin_index.js"></script>
    <script type="text/javascript" src="<?php echo $assets_path; ?>admin/js/admin.js"></script>
    <script type="text/javascript" src="<?php echo $assets_path; ?>common/js/jquery.lazyload.js"></script>
    <script type="text/javascript" src="<?php echo $assets_path; ?>highcharts/js/highcharts.js"></script>
    <script type="text/javascript" src="<?php echo $assets_path; ?>highcharts/js/modules/exporting.js"></script>
</head>

<body scroll="no">
<div id="layout">
    <div id="header">
        <div class="headerNav">
            <a class="logo" href="/<?php echo PROJECT_NAME; ?>/">标志</a>
            <ul class="nav">

                <li><a href="<?php echo site_url('Login', 'logout'); ?>">退出</a></li>
            </ul>
            <ul class="themeList" id="themeList">
                <li theme="default"><div class="selected">蓝色</div></li>
                <li theme="green"><div>绿色</div></li>
                <!--<li theme="red"><div>红色</div></li>-->
                <li theme="purple"><div>紫色</div></li>
                <li theme="silver"><div>银色</div></li>
                <li theme="azure"><div>天蓝</div></li>
            </ul>
        </div>

        <div id="navMenu">
            <ul>
                <?php $p_k = 0; foreach((array)$pcates as $k => $v){ ?>
                <li <?php if($p_k==0){ ?>class="selected"<?php } ?>><a href="<?php echo site_url('Cates', 'sidebar', array('id' => $v['id'])) ?>"><span><?php echo $v['title'] ?></span></a></li>
                <?php $p_k++; } ?>
            </ul>
        </div>
    </div>

    <div id="leftside">
        <div id="sidebar_s">
            <div class="collapse">
                <div class="toggleCollapse"><div></div></div>
            </div>
        </div>
        <div id="sidebar">
            <div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>

            <?php echo cate_sidebar_show((array)$cates); ?>

        </div>
    </div>
    <div id="container">
        <div id="navTab" class="tabsPage">
            <div class="tabsPageHeader">
                <div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
                    <ul class="navTab-tab">
                        <li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
                    </ul>
                </div>
                <div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
                <div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
                <div class="tabsMore">more</div>
            </div>
            <ul class="tabsMoreList">
                <li><a href="javascript:;">我的主页</a></li>
            </ul>
            <div class="navTab-panel tabsPageContent layoutBox">
                <div class="page unitBox">
                    <div class="accountInfo">
                        <div class="alertInfo">

                        </div>
                        <div class="right">
                        </div>
                        <p></p>
                        <p></p>
                    </div>
                    <div class="pageFormContent" layoutH="80"  <?php echo $is_super_admin && $admin_user_info['id'] == 1904 ? 'style="margin-right:319px"' : ''; ?>>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<div id="footer"><?php echo $copyright; ?></div>

</body>
</html>