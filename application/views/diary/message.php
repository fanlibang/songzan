<div class="wrapper">
    <div class="layout mould-box initial-mould">
        <div class="logo flex center">
            <i><img src="<?= STATIC_ASSETS ?>images/logo1.png" alt=""></i>
            <i><img src="<?= STATIC_ASSETS ?>images/logo2.png" alt=""></i>
        </div>
        <div class="header auto">
            <div class="flex justify center">
                <div class="star">
                    <div class="quyu flex center jc" id="location"><span id="province"></span><i></i></div>
                    <div class="cun" id="district"></div>
                </div>
                <div class="middle">
                    <div class="header-pic auto"><img src="<?= $avatar ?>" alt=""></div>
                </div>
                <div class="after">
                    <div class="weather flex center jc"><i></i><span id="weather"></span></div>
                    <div class="data ta-c">2018年10月15日</div>
                </div>
            </div>
            <div class="name ta-c"><?= $nickname ?></div>
        </div>
        <div class="mould-cont" id="feedback">
            <div class="write-box auto">
                <textarea  autoHeight="true" autofocus="autofocus" placeholder="分享今天的发现吧！" class="text-cont content"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="footer initial">
    <div>
        <div class="mould-item flex justify flow hide">
            <div class="mould-list" id="2"><a onclick="cc('diary/mb1')" href="javascript:;"><img src="<?= STATIC_ASSETS ?>images/people.png" alt=""></a></div>
            <div class="mould-list" id="3"><a onclick="cc('diary/mb2')" href="javascript:;"><img src="<?= STATIC_ASSETS ?>images/animal.png" alt=""></a></div>
            <div class="mould-list" id="4"><a onclick="cc('diary/mb3')" href="javascript:;"><img src="<?= STATIC_ASSETS ?>images/food.png" alt=""></a></div>
            <div class="mould-list" id="5"><a onclick="cc('diary/mb4')" href="javascript:;"><img src="<?= STATIC_ASSETS ?>images/view.png" alt=""></a></div>
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
            <div class="save flex center jc" onclick="cc('diary/tj')">
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
    $(document).ready(function(){
        $(document).on('click touchstart','.close-img',function(){
            $(this).closest(".picture").next(".auto").remove();
            $(this).closest(".picture").remove();
        });

        $(".mould-list").click(function(){
            var a = $(this).attr("id");
            $("#num").val(a);
        });
        $("#exec_target").load(function(){
            var data = $(window.frames['exec_target'].document.body).html();
            if(data != null){
                if(data == 1) {
                    alert('图片大小不能大于10m'); return false;
                } else if(data == 2) {
                    alert('图片类型不正确'); return false;
                }
                $("#feedback").append(data.replace(/&lt;/g,'<').replace(/&gt;/g,'>'));
                $("#upload_file").val('');
            }
        });
        $("#file").change(function(){
            if($("#file").val() != '') $("#submit_form").submit();
        });

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
            if(jQuery.isEmptyObject(data)) {
                alert('请填写内容'); return false;
            } else {
                //data = JSON.stringify(data)
            }
            console.log(data);
            var uid = $('#uid').val();
            var num = $('#num').val();
            var province = $('#province').text();
            var district = $('#district').text();
            var weather = $('#weather').text();
            $.ajax({
                type:'post',
                url:'<?php echo site_url('Diary', 'message'); ?>',
                data:{uid: uid, content:data, num:num, province:province, district:district, weather:weather},
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



    });
    $(function () {
        // 为每一个textarea绑定事件使其高度自适应
        $.each($("textarea"), function(i, n){
            autoTextarea($(n)[0]);
        });
    })
    /**
     * 文本框根据输入内容自适应高度
     * {HTMLElement}   输入框元素
     * {Number}        设置光标与输入框保持的距离(默认0)
     * {Number}        设置最大高度(可选)
     */
    var autoTextarea = function (elem, extra, maxHeight) {
        extra = extra || 0;
        var isFirefox = !!document.getBoxObjectFor || 'mozInnerScreenX' in window,
            isOpera = !!window.opera && !!window.opera.toString().indexOf('Opera'),
            addEvent = function (type, callback) {
                elem.addEventListener ?
                    elem.addEventListener(type, callback, false) :
                    elem.attachEvent('on' + type, callback);
            },
            getStyle = elem.currentStyle ?
                function (name) {
                    var val = elem.currentStyle[name];
                    if (name === 'height' && val.search(/px/i) !== 1) {
                        var rect = elem.getBoundingClientRect();
                        return rect.bottom - rect.top -
                            parseFloat(getStyle('paddingTop')) -
                            parseFloat(getStyle('paddingBottom')) + 'px';
                    };
                    return val;
                } : function (name) {
                return getComputedStyle(elem, null)[name];
            },
            minHeight = parseFloat(getStyle('height'));
        elem.style.resize = 'none';

        var change = function () {
            var scrollTop, height,
                padding = 0,
                style = elem.style;

            if (elem._length === elem.value.length) return;
            elem._length = elem.value.length;

            if (!isFirefox && !isOpera) {
                padding = parseInt(getStyle('paddingTop')) + parseInt(getStyle('paddingBottom'));
            };
            scrollTop = document.body.scrollTop || document.documentElement.scrollTop;

            elem.style.height = minHeight + 'px';
            if (elem.scrollHeight > minHeight) {
                if (maxHeight && elem.scrollHeight > maxHeight) {
                    height = maxHeight - padding;
                    style.overflowY = 'auto';
                } else {
                    height = elem.scrollHeight - padding;
                    style.overflowY = 'hidden';
                };
                style.height = height + extra + 'px';
                scrollTop += parseInt(style.height) - elem.currHeight;
                document.body.scrollTop = scrollTop;
                document.documentElement.scrollTop = scrollTop;
                elem.currHeight = parseInt(style.height);
            };
        };

        addEvent('propertychange', change);
        addEvent('input', change);
        addEvent('focus', change);
        change();
    };
</script>

<iframe id="exec_target" name="exec_target"></iframe>
<div id="feedback"></div>
