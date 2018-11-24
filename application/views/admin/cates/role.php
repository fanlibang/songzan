<div class="pageContent">
    <div class="pageFormContent" layoutH="60">
        <ul class="tree treeFolder treeCheck expand" id="_select_cate">
            <li><a tname="cate_ids" tvalue="0">管理中心</a>
                <?php echo $user_id ? cate_user($cate_arr,$user_cate_ids) : cate_role($cate_arr,$cate_ids);?>
            </li>
        </ul>
    </div>
    <div class="formBar">
        <ul>
            <li><a class="button"  href="javascript:void(0);" onclick="roleTreeCallBack();"><span>确认</span></a></li>
            <li><div class="button"><div class="buttonContent"><button class="close" type="button">关闭</button></div></div></li>
        </ul>
    </div>
</div>
<script type="text/javascript">

    function roleTreeCallBack(){
        var dialog = $("body").data('<?php echo $dialog_rel; ?>');
        var el = dialog.find("div.ckbox.checked,div.ckbox.indeterminate");

        var ids = [];
        el.each(function(){
            ids.push($(this).children(':checkbox').val());
        });
        $.post('<?php echo site_url($controller, $method); ?>',{cate_ids:ids,role_id:<?php echo $role_id; ?>,user_id:<?php echo $user_id; ?>},function(data){
            if(data.statusCode == 200){
                alertMsg.correct(data.message);
                $.pdialog.closeCurrent();
            }else{
                alertMsg.error(data.message);
            }
        });
    }
</script>