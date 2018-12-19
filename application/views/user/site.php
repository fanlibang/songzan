<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content bg-3 flex center jc">
        <div class="new-inner">
            <div class="new-title ta-c">
                收货信息填写
            </div>
            <div class="form auto">
                <div class="form-list flex center">
                    <label>姓名：</label>
                    <div class="form-box">
                        <input type="text" id="site_name" value="" class="input-text">
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>电话：</label>
                    <div class="form-box">
                        <input type="tel" id="site_phone" value="" class="input-text">
                    </div>
                </div>

                <div class="split flex center justify">
                    <div class="form-list flex center opt">
                        <label>省份：</label>
                        <div class="form-box">
                            <span></span>
                            <select name="province" id="province">
                                <option value="">请选择省份</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-list flex center opt">
                        <label>城市：</label>
                        <div class="form-box">
                            <span id="citys"></span>
                            <select name="city" id="city">
                                <option value="">请选择城市</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>地址：</label>
                    <div class="form-box">
                        <input type="text" id="site" value="" class="input-text">
                    </div>
                </div>
                <div class="form-push">
                    <input type="hidden" id="type" value="<?= $type; ?>" class="input-text">
                    <input type="button" value="提  交" class="btn auto" id="sub">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bomb-wrapper flex center jc hide" id="upload">
    <div class="bomb-content">
        <div class="hint auto">
            <div class="hint-word" id="mgs">
                上传出错：上传的图片不正确
            </div>
            <div class="form-push">

            </div>
        </div>
        <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
    </div>
</div>

<div class="bomb-wrapper flex center jc hide" id="hint">
    <div class="bomb-content">
        <div class="hint auto">
            <div class="hint-word" id="title">
                您的资料我们已收到，我们将在7个工作日内完成审核，及时关注【路虎中国】的短信，获取最新审核状态。
            </div>
            <div class="form-push">
                <input type="button" value="我 知 道 了" class="btn auto " id="tj" >
            </div>
        </div>
        <!--<div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>-->
    </div>
</div>

<div class="bomb-wrapper flex center jc">
    <div class="bomb-content">
        <div class="hint auto">
            <div class="hint-word">
                因礼品库存波动，请及时提交收货地址，提交成功后，才可视为礼品选择成功。
            </div>
            <div class="form-push">
                <input type="button" value="我 知 道 了" class="btn auto" id="agree">
            </div>
        </div>
        <!--<div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>-->
    </div>
</div>

<script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript"></script>
<script type="text/javascript">
    document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        // 通过下面这个API隐藏右上角按钮
        WeixinJSBridge.call('hideOptionMenu');
    });
    $(document).ready(function(){
        $(function(){
            //页面加载完毕后开始执行的事件
            var city_obj=<?= $city_arr; ?>;
            //var city_obj=eval('('+city_json+')');
            for (var key in city_obj)
            {
                $("#province").append("<option value='"+key+"'>"+key+"</option>");
            }
            $("#province").change(function(){
                var now_province=$(this).val();
                $("#city").html('');
                for(var k in city_obj[now_province])
                {
                    var now_city=city_obj[now_province][k];
                    if(k == 0) {
                        $("#citys").html(now_city);
                    }
                    $("#city").append('<option value="'+now_city+'">'+now_city+'</option>');
                }
            });
        });
        $('#sub').click(function(){
            var site_name   = $('#site_name').val();
            var site_phone  = $('#site_phone').val();
            var province    = $('#province').val();
            var city        = $('#city').val();
            var site        = $('#site').val();
            var type        = $('#type').val();
            if(site_name == '') {
                $('#mgs').html('提交提示：请填写收货人姓名');
                $('#upload').removeClass('hide'); return false;
            } else if(site_phone == '') {
                $('#mgs').html('提交提示：请填写收货人电话');
                $('#upload').removeClass('hide'); return false;
            } else if(province == '') {
                $('#mgs').html('提交提示：请选择收货人省份');
                $('#upload').removeClass('hide'); return false;
                //alert('您还未同意隐私条款'); return false;
            } else if(city == '') {
                $('#mgs').html('提交提示：请选择收货人城市');
                $('#upload').removeClass('hide'); return false;
                //alert('您还未同意隐私条款'); return false;
            } else if(site == '') {
                $('#mgs').html('提交提示：请填写收货人地址');
                $('#upload').removeClass('hide'); return false;
                //alert('您还未同意隐私条款'); return false;
            }
            $.ajax({
                type:'post',
                url:'/2018/crm/ownerreferral/index.php?c=User&m=site',
                data:{site_name:site_name, site_phone: site_phone, province:province, city:city, site:site, type:type},
                dataType:'json',
                success:function(json){
                    if(json.code == 200){
                        //window.location.href=json.forward;
                        $('#title').html(json.msg);
                        $('#tj').attr('url', json.forward);
                        $('#hint').removeClass('hide');
                    } else{
                        $('#mgs').html('提交提示：'+json.msg);
                        $('#upload').removeClass('hide'); return false;
                    }
                },
                error:function(){}
            });
        });
        $('#tj').click(function(){
            var url = $(this).attr('url');
            window.location.href=url;
        });
    });
</script>