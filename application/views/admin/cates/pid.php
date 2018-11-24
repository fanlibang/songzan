<div class="pageContent">
    <div class="pageFormContent" layoutH="60">
        <ul class="tree treeFolder expand" id="_select_cate_pid"><!--expand or collapse-->
            <li><a tname="cate_ids" tvalue="0">管理中心</a>
                <?php echo cate_pid($cate_arr);?>
            </li>
        </ul>
    </div>
    <div class="formBar">
        <ul>
            <li><a class="button"  href="javascript:void(0);" onclick="cateTreeCallBack();"><span>确认</span></a></li>
            <li><div class="button"><div class="buttonContent"><button class="close" type="button">关闭</button></div></div></li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    var olda = '';

    (function($){
        $('#_select_cate_pid').find('a').click(function(){
            if(olda){
                olda.text(olda.text().replace('(√)',''));
            }

            $(this).text($(this).text()+'(√)');
            olda = $(this);
        });

        var pdialog = $("body").data('add_cate');
        var sids = $('input[name="pid"]', pdialog).val();

        setTimeout(function(){//这里代码有延迟事件，所以用setTimeout调整执行顺序
            var dialog = $("body").data('cate_pid');
            var el = dialog.find("a[tvalue='"+sids+"']");

            el.text(el.text()+'(√)');
            olda = el;
        },0);

    })(jQuery);

    function cateTreeCallBack(){
        if(olda){

            var pdialog = $("body").data('add_cate');
            $('input[name="pid"]', pdialog).val(olda.attr('tvalue'));
            $('input[name="parent_cate_name"]', pdialog).val(olda.text().replace('(√)',''));
            $.pdialog.closeCurrent();
        }else{
            alertMsg.error('必须选择一个父级菜单！');
        }
    }
</script>