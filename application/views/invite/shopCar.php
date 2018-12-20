<div class="wrapper">
    <div class="logo"><img src="<?= STATIC_ASSETS ?>images/logo.png" alt=""></div>
    <div class="content flex center jc">
        <div class="new-inner">
            <div class="new-title ta-c">
                上传购车凭证
            </div>
            <div class="upload flex justify flow">
                <div class="upload-item">
                    <div class="upload-bt">*购车人身份证</div>
                    <div class="upload-nr">
                        <img width="254px;" height="185px;" src="<?= STATIC_ASSETS ?>images/new-03.png" alt="" id="card_front">
                        <form id="cart_form" method="post" action="<?php echo site_url('Publics', 'uploadImage'); ?>" target="card_target" enctype="multipart/form-data">
                            <input type="file" name="file" id="card_file">
                        </form>
                    </div>
                </div>
                <div class="upload-item">
                    <div class="upload-bt">*购车发票</div>
                    <div class="upload-nr">
                        <img width="254px;" height="155px;" src="<?= STATIC_ASSETS ?>images/new-04.png" alt="" id="car_img">
                        <form id="car_form" method="post" action="<?php echo site_url('Publics', 'uploadImage'); ?>" target="car_target" enctype="multipart/form-data">
                            <input type="file" name="file" id="car_file">
                        </form>
                    </div>
                </div>
                <div class="upload-item special">
                    <div class="upload-bt">
                        其他补充材料
                        <p>（您可上传其他补充证明材料如户口本复印件等)</p>
                    </div>
                    <div class="upload-nr flex center jc">
                        <img width="275px;" height="198px;" src="<?= STATIC_ASSETS ?>images/new-05.png" alt="" id="other">
                        <form id="other_form" method="post" action="<?php echo site_url('Publics', 'uploadImage'); ?>" target="other_target" enctype="multipart/form-data">
                            <input type="file" name="file" id="other_file">
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex jc">
                <div class="form-checkbox">
                    我已阅读并同意相关<a href="https://www.landrover.com.cn/cookie-and-privacy-policy.html" class="item">隐私政策</a>
                </div>
            </div>
            <div class="form-push">
                <input type="hidden" name="car_id" id="car_id" value="<?= $car_id?>" >
                <input type="button" value="提  交" onclick="cc('image/tj')" class="btn auto" id="sub">
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
       <!-- <div class="close"><img src="<?= STATIC_ASSETS ?>images/icon-4.png" alt=""></div>-->
    </div>
</div>

<script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript"></script>
<script type="text/javascript">
    document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        // 通过下面这个API隐藏右上角按钮
        WeixinJSBridge.call('hideOptionMenu');
    });
    $(document).ready(function(){
        $("#card_target").load(function(){
            var data = $(window.frames['card_target'].document.body).html();
            if(data != null){
                $("#card_front").attr('src', data);
                $("#card_front").attr('height', '155px');
                return false;
            }
        });

        $("#car_target").load(function(){
            var data = $(window.frames['car_target'].document.body).html();
            if(data != null){
                if(data != null){
                    $("#car_img").attr('src', data);
                    return false;
                }
            }
        });

        $("#other_target").load(function(){
            var data = $(window.frames['other_target'].document.body).html();
            if(data != null){
                if(data != null){
                    $("#other").attr('src', data);
                    return false;
                }
            }
        });
        $("#card_file").change(function(){
            if($("#card_file").val() != '') $("#cart_form").submit();
        });

        $("#car_file").change(function(){
            if($("#car_file").val() != '') $("#car_form").submit();
        });

        $("#other_file").change(function(){
            if($("#other_file").val() != '') $("#other_form").submit();
        });

        $('#sub').click(function(){
            var card_front  = $('#card_front').attr('src');
            var car_img     = $('#car_img').attr('src');
            var other       = $('#other').attr('src');
            var car_id      = $('#car_id').val();
            var succ        = $('.form-checkbox.active').text();
            if(card_front == '/2018/crm/ownerreferral/assets/images/new-03.png') {
                $('#mgs').html('提交提示：请上传身份证图片');
                $('#upload').removeClass('hide'); return false;
            } else if(car_img == '/2018/crm/ownerreferral/assets/images/new-04.png') {
                $('#mgs').html('提交提示：请上购车发票图片');
                $('#upload').removeClass('hide'); return false;
            } else if(succ == '') {
                $('#mgs').html('提交提示：您还未同意隐私条款');
                $('#upload').removeClass('hide'); return false;
                //alert('您还未同意隐私条款'); return false;
            }
            $.ajax({
                type:'post',
                url:'/2018/crm/ownerreferral/index.php?c=Invite&m=shopCar',
                data:{card_front:card_front, car_img: car_img, other:other, car_id:car_id},
                dataType:'json',
                success:function(json){
                    if(json.code == 200){
                        //window.location.href=json.forward;
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
    });
    $('#tj').click(function(){
        var url = $(this).attr('url');
        window.location.href=url;
    });
</script>

<iframe id="card_target" name="card_target"></iframe>
<iframe id="car_target" name="car_target"></iframe>
<iframe id="other_target" name="other_target"></iframe>