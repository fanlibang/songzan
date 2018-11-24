<div class="wrapper">
    <div class="layout bg-note">
        <div class="logo flex center">
            <i><img src="<?= STATIC_ASSETS ?>images/logo1.png" alt=""></i>
            <i><img src="<?= STATIC_ASSETS ?>images/logo2.png" alt=""></i>
        </div>
        <div class="ad">
            <img src="<?= STATIC_ASSETS ?>images/note-ad.jpg" alt="">
        </div>
        <div class="note-box auto">
            <ul class="note-menu flex center justify">
                <li class="active">我的日记</li>
                <li>全部日记</li>
            </ul>
            <div class="note-cont note-show">
                <div class="note-item ">
                    <?php if (!empty($self)): ?>
                        <?php foreach ($self as $key => $v): ?>

                            <div  class="note-list" del<?= $v['id'] ?>">
                                <a onclick="cc('diary/xq')" href="<?php echo site_url('Article', 'index', array('id' => $v['id'])); ?>">
                                <div class="txt two-ell"><pre><?= $v['title'] ?></pre></div>
                                <div class="pic"><img src="<?= $v['img'] ?>" alt=""></div>
                                </a>
                                <div class="note-eg flex center justify">
                                    <div class="area flex center"><i><img src="<?= STATIC_ASSETS ?>images/icon-15.png" alt=""></i><?= $v['province'] ?><?= $v['district'] ?></div>
                                    <div class="operation flex center">
					<div class="pink flex center val<?= $v['id'] ?> <?php if($v['pink'] == 1) { echo 'active';}?>" item_id="<?= $v['id'] ?>" pink="<?= $v['pink'] ?>"><i></i><span class="num<?= $v['id'] ?>"><?= $v['like_count'] ?></span></div>
                                        <div class="turn flex center"><i><img src="<?= STATIC_ASSETS ?>images/icon-16.png" alt=""></i><span><?= $v['play_count'] ?></span></div>
                                    	<div class="del flex center"  item_id="<?= $v['id'] ?>"  ><i><img src="<?= STATIC_ASSETS ?>images/icon-43.png" alt=""></i>删除</div>
					</div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="12">没有您要查询的数据~</td></tr>
                    <?php endif; ?>
                </div>

                <div class="note-item myself">
                    <?php if (!empty($all)): ?>
                        <?php foreach ($all as $key => $v): ?>
                            <div  class="note-list flex justify del<?= $v['id'] ?>"">
                                <div class="left">
                                    <div class="user-pic"><a onclick="cc('diary/user')" href="<?php echo site_url('Diary', 'userInfo', array('uid'=> $v['new_uid'])); ?>"><img src="<?= $v['avatar'] ?>" alt=""></a></div>
                                    <div class="operation">
					                    <div class="pink flex column ta-c val<?= $v['id'] ?> <?php if($v['pink'] == 1) { echo 'active';}?>" item_id="<?= $v['id'] ?>" pink="<?= $v['pink'] ?>" ><i></i><span class="num<?= $v['id'] ?>"><?= $v['like_count'] ?></span></div>
                                        <div class="turn flex column ta-c"><i><img src="<?= STATIC_ASSETS ?>images/icon-16.png" alt=""></i><?= $v['play_count'] ?></div>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="name"><?= $v['nickname']?></div>
                                    <a onclick="cc('diary/xq2')" href="<?php echo site_url('Article', 'index', array('id' => $v['id'])); ?>">
                                    <div class="txt ell"><pre><?= $v['title'] ?></pre></div>
                                    <div class="pic"><img src="<?= $v['img']?>" alt=""></div>
                                    </a>
                                    <div class="note-eg flex center justify">
                                        <div class="area flex center"><i><img src="<?= STATIC_ASSETS ?>images/icon-15.png" alt=""></i><?= $v['province'] ?><?= $v['district'] ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="12">没有您要查询的数据~</td></tr>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="write-note">
            <div class="auto find-btn">
                <a onclick="cc('diary/xrj')" href="<?php echo site_url('Diary', 'message', array('check' => 1)); ?>">
                    <div class="btn flex center jc">写日记<i><img src="<?= STATIC_ASSETS ?>images/icon-1.png" alt=""></i></div>
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	//重写confirm 不显示ip地址
        var wConfirm = window.confirm;
        window.confirm = function (message) {
            try {
                var iframe = document.createElement("IFRAME");
                iframe.style.display = "none";
                iframe.setAttribute("src", 'data:text/plain,');
                document.documentElement.appendChild(iframe);
                var alertFrame = window.frames[0];
                var iwindow = alertFrame.window;
                if (iwindow == undefined) {
                    iwindow = alertFrame.contentWindow;
                }
                var result = iwindow.confirm(message);
                iframe.parentNode.removeChild(iframe);
                return result;
            }
            catch (exc) {
                return wConfirm(message);
            }
        };
    $(function(){
        $('.pink').click(function(){
            var _this = $(this);
            var item_id = $(this).attr('item_id');
            var pink = $(this).attr('pink');
            console.log(pink);
            var num = $(this).find("span").text();
            var span = $(this).find("span");
            var span = $(this).find("span");
            $.ajax({
                type:'post',
                url:'<?php echo site_url('Publics', 'pink'); ?>',
                data:{item_id:item_id, pink: pink},
                cache:false,
                dataType:'json',
		        success:function(json){
                    if(pink == 2) {
                        var pink_val = 1;
                        num = parseInt(num) + 1;
                    } else {
                        var pink_val = 2;
                        if(num > 0) {
                            num = parseInt(num) - 1 ;
                        }
                    }
                    var article = 'num'+item_id;
                    $("."+article).each(function(){
                        $(this).text(num);
                    });
                    var val = 'val'+item_id;
                    var ret = _this.attr("class").indexOf("active");
                    $("."+val).each(function(){
                        $(this).attr('pink', pink_val);
                        var res = $(this).attr("class").indexOf("active");
                        if(ret != res && res > 0) {
                            $(this).removeClass('active');
                        } else if(ret != res && res < 0) {
                            $(this).addClass('active');
                        }
                    });
                    alert(json.msg);
                },
                error:function(){}
            });
        });
	$('.del').click(function(){
            if(confirm("确认删除日记吗")){
                var item_id = $(this).attr('item_id');
                $.ajax({
                    type:'post',
                    url:'<?php echo site_url('Publics', 'del'); ?>',
                    data:{item_id:item_id},
                    cache:false,
                    dataType:'json',
                    success:function(json){
                        var del_article = 'del'+item_id;
                        console.log(del_article);
                        $("."+del_article).each(function(){
                            $(this).remove()
                        });
                        alert(json.msg);
			 window.location.href=json.forward;
                    },
                    error:function(){}
                });
            }
            return false;
        });
    });
</script>
