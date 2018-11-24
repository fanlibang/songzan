<div class="wrapper">
    <div class="layout mould-box send-mould <?=$view?>-mould">
        <div class="logo flex center">
            <i><img src="<?= STATIC_ASSETS ?>images/logo1.png" alt=""></i>
            <i><img src="<?= STATIC_ASSETS ?>images/logo2.png" alt=""></i>
        </div>
        <div class="header auto">
            <div class="flex justify center">
                <div class="star">
                    <div class="quyu flex center jc"><?= $province; ?><i></i></div>
                    <div class="cun"><?= $district; ?></div>
                </div>
                <div class="middle">
                    <div class="header-pic auto"><img src="<?= $avatar; ?>" alt=""></div>
                </div>
                <div class="after">
                    <div class="weather flex center jc"><i></i><span><?= $weather; ?></span></div>
                    <div class="data ta-c"><?= $nickname; ?></div>
                </div>
            </div>
            <div class="name ta-c"><?= $nickname; ?></div>
        </div>
        <div class="mould-cont">
            <?php if (!empty($content)): ?>
                <?php foreach ($content as $key => $val): ?>
                        <?php foreach ($val as $k => $v): ?>
                            <?php if($k == 2) { ?>
                            <div class="write-box auto">
                                <pre><?= $v; ?></pre>
                            </div>
                            <?php } else { ?>
                            <div class="picture auto flex jc">
                                <div class="photo"><img src="<?= $v; ?>" alt=""></div>
                            </div>
                            <?php } ?>
                        <?php endforeach; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="12">没有您要查询的数据~</td></tr>
            <?php endif; ?>
        </div>
        <div class=" others-btn">
            <a onclick="cc('article/tm')" href="<?php echo site_url('Index', 'index'); ?>">
                <div class="btn flex center jc auto">我也要探秘<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
            </a>
        </div>
        <div class="operation flex center jc">
            <div class="pink flex center column <?php if($pink == 1) { echo 'active';}?>" item_id="<?= $id ?>" pink="<?= $pink ?>"><i></i><span><?= $like_count ?></span></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $('.pink').click(function(){
            var _this = $(this);
            var item_id = $(this).attr('item_id');
            var pink = $(this).attr('pink');
            var num = $(this).find("span").text();
            var span = $(this).find("span");
            $.ajax({
                type:'post',
                url:'<?php echo site_url('Publics', 'pink'); ?>',
                data:{item_id:item_id, pink: pink},
                cache:false,
                dataType:'json',
                success:function(json){
                    if(pink == 2) {
                        _this.attr('pink', 1);
                        num = parseInt(num) + 1;
                    } else {
                        _this.attr('pink', 2);
                        if(num > 0) {
                            num = parseInt(num) - 1 ;
                        }
                    }
                    span.text(num);
                    alert(json.msg);
                },
                error:function(){}
            });
        });
    });
</script>
