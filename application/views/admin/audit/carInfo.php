<h2 class="contentTitle">资料查看</h2>
<form action="<?php echo site_url($controller, $method); ?>" method="post" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
    <div class="pageContent">
        <div class="pageFormContent" layoutH="97">
            <h2 class="contentTitle">基本信息</h2>
            <div class="unit">
                <label>身份证正面：</label>
                <a href="<?= $card_front ?>" target="_blank"><img class="_show_logo" width="173" height="173" src="<?php echo $card_front; ?>"></a>
            </div>
            <div class="unit">
                <label>购车发票：</label>
                <a href="<?= $car_img ?>" target="_blank"><img class="_show_logo" width="173" height="173" src="<?php echo $car_img; ?>"></a>
            </div>

            <div class="unit">
                <label>其他资料：</label>
                <a href="<?= $other ?>" target="_blank"><img class="_show_logo" width="173" height="173" src="<?php echo $other; ?>"></a>
            </div>


            <div class="unit">
                <label>审核操作：</label>
                <ul class="pub_status">
                    <?php if($state == 2) { ?>
                        <li style="background-color:red; "><a style="color:#ffffff;" href="javascript:;" class="result" state="3" >审核成功</a></li>
                    <?php } elseif($state == 1) { ?>
                        <li style="background-color:green; "><a style="color:#ffffff;" href="javascript:;" class="result" state="2" >审核失败</a></li>
                        <li style="background-color:red; "><a style="color:#ffffff;" href="javascript:;" class="result" state="3" >审核成功</a></li>
                    <?php }elseif($state == 3)  { ?>
                        <li style="background-color:green; "><a style="color:#ffffff;" href="javascript:;" class="result" state="2" >审核失败</a></li>
                    <?php } ?>
                </ul>
            </div>

        </div>
        <div class="formBar">
            <ul>
                <input type="hidden" id="id" name="id" value="<?= $id; ?>" >
                <input type="hidden" id="uid" name="uid" value="<?= $uid; ?>" >
                <li><div class="button"><div class="buttonContent"><button class="close" type="button">取消</button></div></div></li>
            </ul>
        </div>
    </div>
</form>


<script type="text/javascript">
    $(function(){
        $('.result').click(function(){
            var _state = $(this).attr('state');
            var _id = $('#id').val();
            var _uid = $('#uid').val();
            $.ajax({
                type:'post',
                url:'<?php echo site_url($controller, 'carInfo'); ?>',
                data:{state: _state, id:_id, uid:_uid},
                cache:false,
                dataType:'json',
                success:function(json){
                    if(json.statusCode == 200){
                        navTab.reload(json.forwardUrl, {}, json.navTabId);
//                        //$.pdialog.open("<?php //echo site_url($controller, 'testPublish', array('test_id' => $info['test_id'])); ?>//", "test_publish", "测评审核");
//                        alertMsg.info(json.message);
                          $.pdialog.closeCurrent();
//                        $.pdialog.reload("<?php //echo site_url($controller, 'testList'); ?>//", "", null);
                    }else{
                        alertMsg.error(json.message);
                    }
                },
                error:function(){}
            });
        });
    });
</script>
