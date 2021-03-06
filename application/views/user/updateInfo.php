<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content bg-3 ">
        <div>
            <div class="form-tit ta-c"><img src="<?= STATIC_ASSETS ?>images/tit-1.png" alt=""></div>
            <div class="form auto">
                <div class="form-list flex center">
                    <label>*姓名：</label>
                    <div class="form-box">
                        <div class="input-text" ><?= $name ?></div>
                    </div>
                </div>
                <div class="form-list flex center">
                    <label>*手机号：</label>
                    <div class="form-box">
                        <div class="input-text" ><?= $phone ?></div>
                    </div>
                </div>

                <div class="form-list flex center file">
                    <label>行驶证：</label>
                    <div class="form-box">
                        <input type="text" id="driver_number" disabled="true" placeholder="仅限路虎品牌" value="<?= $driver_number ?>" class="input-text">
                        <input type="hidden" id="driver_json" value="<?= $driver_json ?>" class="input-text">
                    </div>
                    <i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt="">
                        <form id="driver_form" method="post" action="<?php echo site_url('Publics', 'getImageInfo', array('type' => 2)); ?>" target="driver_target" enctype="multipart/form-data">
                            <input type="file" name="file" id="driver_file" >
                        </form>
                    </i>
                </div>
                <div class="form-list flex center file">
                    <label>身份证：</label>
                    <div class="form-box">
                        <input type="text" id="card_number" disabled="true" placeholder="请先上传图片" value="<?= $card_number ?>" class="input-text">
                        <input type="hidden" id="card_json" value="<?= $card_json ?>" class="input-text">
                    </div>
                    <i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt="">
                        <form id="card_form" method="post" action="<?php echo site_url('Publics', 'getImageInfo', array('type' => 1)); ?>" target="card_target" enctype="multipart/form-data">
                            <input type="file" name="file" id="card_file" >
                        </form>
                    </i>
                </div>
                <div class="flex justify">
                    <div class="form-checkbox">
                        我已阅读并同意相关<a href="https://www.landrover.com.cn/cookie-and-privacy-policy.html" onclick="cc('user/wsys')" class="item">隐私条款</a>
                    </div>
                    <div class="form-tip">标*为必填</div>
                </div>
                <div class="form-push">
                    <input type="hidden" id="id" value="<?= $id ?>" class="input-text">
                    <input type="hidden" id="status" value="<?= $status ?>" class="input-text">
                    <input type="button" value="提     交" class="btn auto" id="sub" onclick="cc('user/wstj')">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bomb-wrapper flex center jc hide" id="upload">
    <div class="bomb-content">
        <div class="hint auto">
            <div class="hint-word" id="title">
                上传出错：上传的图片不正确
            </div>
            <div class="form-push">

            </div>
        </div>
        <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
    </div>
</div>


<div class="bomb-wrapper flex center jc hide" id="upload">
    <div class="bomb-content">
        <div class="hint auto">
            <div class="hint-word" id="title">
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
            <div class="hint-word" id="titles">
                活动礼遇将在信息审核通过后进行寄送。确认提交前，请确保信息的准确性。
            </div>
            <div class="form-push">
                <input type="button" value=" 确 定 " class="btn auto " id="tj" >
            </div>
        </div>
        <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>
    </div>
</div>

<script src="<?= STATIC_ASSETS ?>js/sendSMS.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#card_target").load(function(){
        var data = $(window.frames['card_target'].document.body).html();
        if(data != null){
            $('#card_number').attr('disabled',false);
            var dataObj=eval("("+data+")");//转换为json对象
            if(dataObj.image_status == 'normal') {
                $("#card_number").val(dataObj.words_result['公民身份号码'].words);
                $("#card_json").val(data);
            } else if (dataObj.image_status != 'normal'){
                $('#upload').removeClass('hide');
                //alert('上传出错:上传文图片不正确');
                //alert('上传出错:'+dataObj.image_status);
            } else {
                $('#upload').removeClass('hide');
                //alert('上传出错:上传文图片不正确');
                //alert('上传出错:'+dataObj['error_code']);
                return false;
            }
        }
    });

    $("#driver_target").load(function(){
        var data = $(window.frames['driver_target'].document.body).html();
        if(data != null){
            var dataObj=eval("("+data+")");//转换为json对象
            $('#driver_number').attr('disabled',false);
            if(dataObj.words_result) {
                $("#driver_number").val(dataObj.words_result['车辆识别代号'].words);
                $("#driver_json").val(data);
            } else {
                $('#upload').removeClass('hide');
                //alert('上传出错:上传文图片不正确');
                //alert('上传出错:'+dataObj['error_code']);
                return false;
            }
        }
    });

    $("#card_file").change(function(){
        if($("#card_file").val() != '') $("#card_form").submit();
    });
    $("#driver_file").change(function(){
        if($("#driver_file").val() != '') $("#driver_form").submit();
    });

});
    $(function(){
        $('#sub').click(function(){
            var id = $('#id').val();
            var driver_number = $('#driver_number').val();
            var driver_json = $('#driver_json').val();
            var card_number = $('#card_number').val();
            var card_json = $('#card_json').val();
            var status = $('#status').val();
            var succ = $('.form-checkbox.active').text();
            if(succ == '') {
                window.alert = function(name){
                    var iframe = document.createElement("IFRAME");
                    iframe.style.display="none";
                    iframe.setAttribute("src", 'data:text/plain,');
                    document.documentElement.appendChild(iframe);
                    window.frames[0].window.alert(name);
                    iframe.parentNode.removeChild(iframe);
                };
                alert('请选择隐私条款'); return false;
            }
            $.ajax({
                type:'post',
                url:'/2018/crm/ownerreferral/index.php?c=User&m=updateInfo',
                data:{id:id, driver_number:driver_number, driver_json:driver_json, card_number:card_number, card_json:card_json, status:status},
                dataType:'json',
                success:function(json){
                    if(json.code == 200){
                        //alert(json.msg);
                        $('#titles').html('提交提示：完善资料成功');
                        $('#tj').attr('url', json.forward);
                        $('#hint').removeClass('hide');
                        //window.location.href=json.forward;
                    } else {
                        alert(json.msg);
                    }
                },
                error:function(){}
            });
        });
    });

    $('#tj').click(function(){
        var url = $(this).attr('url');
        window.location.href=url;
    });
</script>

<iframe id="driver_target" name="driver_target"></iframe>
<iframe id="card_target" name="card_target"></iframe>
