<div class="wrapper">
    <div class="layout bg-myself-notecenter">
        <div class="logo flex center">
            <i><img src="<?= STATIC_ASSETS ?>images/logo1.png" alt=""></i>
            <i><img src="<?= STATIC_ASSETS ?>images/logo2.png" alt=""></i>
        </div>
        <div class="ad">
            <img src="<?= STATIC_ASSETS ?>images/note-ad.jpg" alt="">
            <div class="header">
                <div class="left">
                    <div class="header-pic auto"><img src="<?= $avatar ?>" alt=""></div>
                    <div class="name ta-c"><?= $nickname ?></div>
                </div>
            </div>
        </div>
        <div class="note-box auto note-center">
            <div class="note-cont">
                <div class="note-item ">
                    <?php if (!empty($info)): ?>
                        <?php foreach ($info as $key => $v): ?>
                            <div  class="note-list">
                                <a href="<?php echo site_url('Article', 'index', array('id' => $v['id'])); ?>">
                                <div class="txt two-ell"><pre><?= $v['title'] ?></pre></div>
                                <div class="pic"><img src="<?= $v['img'] ?>" alt=""></div>
                                </a>
                                <div class="note-eg flex center justify">
                                    <div class="area flex center"><i><img src="<?= STATIC_ASSETS ?>images/icon-15.png" alt=""></i><?= $v['link'] ?></div>
                                    <div class="operation flex center">
                                        <div class="pink flex center <?php if($v['pink'] == 1) { echo 'active';}?>" item_id="<?= $v['id'] ?>" pink="<?= $v['pink'] ?>"><i></i><span><?= $v['like_count'] ?></span></div>
                                        <div class="turn flex center"><i><img src="<?= STATIC_ASSETS ?>images/icon-16.png" alt=""></i><?= $v['play_count'] ?></div>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="12">没有您要查询的数据~</td></tr>
                    <?php endif; ?>
                </div>
            </div>
            <div class="click-more ta-c"><p>点击加载更多</p><div class="icon auto"><img src="<?= STATIC_ASSETS ?>images/icon-30.png" alt=""></div></div>
            <div class=" others-btn">
                <a onclick="cc('diary/tm')" href="<?php echo site_url('Diary', 'message'); ?>">
                    <div class="btn flex center jc">我也要探秘<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                </a>
            </div>
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