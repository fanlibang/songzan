<div class="wrapper">
    <div class="layout mould-box initial-mould">
        <div class="logo flex center">
            <i><img src="<?= STATIC_ASSETS ?>images/logo1.png" alt=""></i>
            <i><img src="<?= STATIC_ASSETS ?>images/logo2.png" alt=""></i>
        </div>
        <div class="header auto">
            <div class="flex justify center">
                <div class="star">
                	<div class="quyu flex center jc" id="location"><span id="province">111111</span><i></i></div>
                   	<div class="cun" id="district">222222</div>
		</div>
                <div class="middle">
                    <div class="header-pic auto"><img src="<?= $avatar ?>" alt=""></div>
                </div>
                <div class="after">
                    <div class="weather flex center jc"><i><img src="<?= STATIC_ASSETS ?>images/icon-36.png" alt=""></i><span>晴转多云</span></div>
                    <div class="data ta-c">2018年10月15日</div>
                </div>
            </div>
            <div class="name ta-c"><?= $nickname ?></div>
        </div>
        <div class="mould-cont" id="feedback">
            <div class="write-box auto">
                <textarea  autoHeight="true" autofocus="autofocus" placeholder="分享今天的发现吧！11111111111" class="text-cont content"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="footer initial">
    <div>
        <div class="mould-item flex justify flow hide">
            <div class="mould-list" id="2"><a href="javascript:;"><img src="<?= STATIC_ASSETS ?>images/people.png" alt=""></a></div>
            <div class="mould-list" id="3"><a href="javascript:;"><img src="<?= STATIC_ASSETS ?>images/animal.png" alt=""></a></div>
            <div class="mould-list" id="4"><a href="javascript:;"><img src="<?= STATIC_ASSETS ?>images/food.png" alt=""></a></div>
            <div class="mould-list" id="5"><a href="javascript:;"><img src="<?= STATIC_ASSETS ?>images/view.png" alt=""></a></div>
            <div class="mould-tip ta-c">再次点击可取消模版</div>
        </div>
        <div class="flex center justify foot-end">
            <a href="javascript:history.back(-1);">
                <div class="close flex center jc">
                    <div class="icon"></div>
                </div>
            </a>
            <div class="txt flex center justify more-mould">
                <div class="pic">
                    <form id="submit_form" method="post" action="<?php echo site_url('Publics', 'imageUpload'); ?>" target="exec_target" enctype="multipart/form-data">
                        <input type="file" name="file" id="file" class="file-btn">
                    </form>

                </div>
                <div class="mouldicon"></div>
            </div>
            <div class="save flex center jc">
                <input type="hidden" name="num" value="1" id="num">
                <input type="hidden" name="uid" value="<?= $uid; ?>" id="uid">
                <div class="icon"></div>
            </div>
        </div>
    </div>
</div>
<style>
    #exec_target{display:none;width:0;height:0;}
</style>
<script>
	 $('.save').click(function(){
        var data = {};
        var i=0;
        var j=1;
        $(".content").each(function(a){
            var content = ($(this).val());
            if(content != '') {
                if(data[a]){
                    data[a]['content'] = content;
                }else{
                    data[a] = {};
                    data[a]['content'] = content;
                }
                i++;
            }
        });
        $(".photo").each(function(a,b){
            var img = $(b).find('.photo_img');
            var image = img.attr('src');
            if(image != '') {
                if(data[j]){
                    data[j]['img'] = image;
                }else{
                    data[j] = {};
                    data[j]['img'] = image;
                }
                j++;
            }
        });
        console.log(data);

        if(jQuery.isEmptyObject(data)) {
            alert('请填写内容'); return false;
        } else {
            data = JSON.stringify(data)
        }
        console.log(data);
        var uid = $('#uid').val();
        var num = $('#num').val();
        var province = $('#province').text();
        var district = $('#district').text();
        $.ajax({
            type:'post',
            url:'<?php echo site_url('Diary', 'message'); ?>',
            data:{uid: uid, content:data, num:num, province:province, district:district},
            cache:false,
            dataType:'json',
            success:function(json){
                if(json.code == 200){
                    window.location.href=json.forward;
                } else {
                    alert(json.msg);
                }
            },
            error:function(){}
        });
    });
</script>
