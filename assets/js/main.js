$(function () {
    updateOrientation();
    var supportOrientation = (typeof window.orientation === 'number' &&
    typeof window.onorientationchange === 'object');
    if (supportOrientation) {
        window.addEventListener('orientationchange', updateOrientation, false);
    } else {
        window.addEventListener('resize', updateOrientation, false);
    }
    function updateOrientation() {
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    }

    //选择性别
    $('.form-radio ul li').on('click', function () {
        $(this).addClass('active').siblings().removeClass('active');
    });
    //条款
    $('.form-checkbox').on('click', function () {
        $(this).toggleClass('active')
    });
    $('.question-list.radio .form-checkbox').on('click', function () {
        $(this).addClass('active').siblings().removeClass('active');
    });
    $('.item').on('click', function (e) {
        e.stopPropagation();
        $('#item').removeClass('hide');
    });
    //数据保护
    $('.bomb-close').on('click', function () {
        $('.bomb-wrapper').addClass('hide');
    });
    //下拉框
    $('.opt select').on('change', function () {
        var value = $(this).find('option:selected').text();
        $(this).siblings('span').html(value);
    });
//    我的日记
    $('.note-cont .note-item:not(:first-child)').hide();
    $('.note-menu li').on('click',function () {
        $(this).addClass('active').siblings().removeClass('active');
        var index = $(this).index();
        $('.note-cont .note-item').eq(index).show().siblings().hide();
    })
    //点赞
    $('.operation .pink').on('click',function () {
        $(this).toggleClass('active');
    })
    //补零
    var addZero=function (num) {
        if(num<10){
            return "0"+num;
        }
        else {
            return num;
        }
    };
    //时间
    time();
    function time(){
        var vWeek,vWeek_s;
        vWeek = ["星期天","星期一","星期二","星期三","星期四","星期五","星期六"];
        var date =  new Date();
        year = date.getFullYear();
        month = date.getMonth() + 1;
        day = date.getDate();
        vWeek_s = date.getDay();
        $('.week').html(vWeek[vWeek_s]);
        $('.day').html(addZero(month)+'/'+addZero(day));
        $('.header .data').html(year+'年'+addZero(month)+'月'+addZero(day)+'日');
    };
    /*$(".text-cont").height($(".text-cont")[0].scrollHeight);
     $(".text-cont").on("keyup keydown", function(){
     $(this).height(this.scrollHeight);
     });*/
    //    更多模板
    $('.mouldicon').on('click',function () {
        $('.mould-item').toggleClass('hide');
    })
    $('.mould-list').on('click',function () {
        $(this).toggleClass('active').siblings().removeClass('active');
        var index = $('.mould-list.active').index() + 1;
        if(index == 1){
            //    人文模版
            $('.footer').removeClass('initial');
            $('.mould-box').removeClass('initial-mould')
                .removeClass('view-mould')
                .removeClass('food-mould')
                .removeClass('animal-mould')
                .addClass('people-mould');
        }else if (index == 2){
            //    动物模版
            $('.footer').removeClass('initial');
            $('.mould-box').removeClass('initial-mould')
                .removeClass('view-mould')
                .removeClass('food-mould')
                .removeClass('people-mould')
                .addClass('animal-mould');

        } else if (index ==3){
            //    美食模版
            $('.footer').removeClass('initial');
            $('.mould-box').removeClass('initial-mould')
                .removeClass('view-mould')
                .removeClass('animal-mould')
                .removeClass('people-mould')
                .addClass('food-mould');

        } else if (index ==4){
            //风景模版
            $('.footer').removeClass('initial');
            $('.mould-box').removeClass('initial-mould')
                .removeClass('food-mould')
                .removeClass('animal-mould')
                .removeClass('people-mould')
                .addClass('view-mould');
        }else if($('.mould-list').hasClass('active')==false){
            //    普通模版
            $('.footer').addClass('initial');
            $('.mould-box').removeClass('view-mould')
                .removeClass('food-mould')
                .removeClass('animal-mould')
                .removeClass('people-mould')
                .addClass('initial-mould');
        }
    })
//    textarea
    $.fn.autoHeight = function(){
        function autoHeight(elem){
            elem.style.height = 'auto';
            elem.scrollTop = 0; //防抖动
            elem.style.height = elem.scrollHeight + 'px';
        }
        this.each(function(){
            autoHeight(this);
            $(this).on('keyup', function(){
                autoHeight(this);
            });
        });
    }
    $('textarea[autoHeight]').autoHeight();
    $('.close-img').on('click',function () {
        console.log(1);
        $(this).parent('.photo').remove();
    })
//    获取opinion页面信息

    $('#submit').on('click',function () {
        var usename = $('#username').val();
        var phone = $('#phone').val();
        var sex = $('#sex').find('li.active').text();
        var city = $('.form-box.opt').find('span').text();
        var opinion = $('.form-checkbox.active').text();
        var others = $('#others').val();
        var textare = $('.input-textarea').val();
        console.log(usename,sex,phone,opinion,city,others,textare);
        return false;
    });
    function c(v)
    {
        var reader = new FileReader();
        reader.onload = function (evt) {
            $(v).after('<img src="' + evt.target.result + '" />');
        }
        reader.readAsDataURL(v.files[0]);
    }
    //删除我的日记
    $('.del').on('click',function () {
        $(this).parents('.note-list').remove();
    });

    //试驾车型
    $('.cause-dis').on('click',function () {
        if($(this).hasClass('active')==false){
            $(this).siblings('.prohibit').addClass('disable');
            $(this).siblings('.prohibit').find('select,input').attr("disabled","disabled");
        }else{
            $(this).siblings('.prohibit').removeClass('disable');
            $(this).siblings('.prohibit').find('select,input').removeAttr("disabled","disabled");
        }
    });

    function c(v)
    {
        var reader = new FileReader();
        reader.onload = function (evt) {
            $(v).after('<img src="' + evt.target.result + '" />');
        }
        reader.readAsDataURL(v.files[0]);
    }

    window.alert = function(name){
        var iframe = document.createElement("IFRAME");
        iframe.style.display="none";
        iframe.setAttribute("src", 'data:text/plain,');
        document.documentElement.appendChild(iframe);
        window.frames[0].window.alert(name);
        iframe.parentNode.removeChild(iframe);
    };

	/*重置*/
    $('.input-reset').on('click', function(){
        $('.form-box span').eq(0).html('省');
        $('.form-box span').eq(1).html('市');
        $('.form-box span').eq(2).html('选择经销商？');
        $('.form-box span').eq(3).html('您感兴趣的路虎车型？');
        $('.form-box span').eq(4).html('倾向的路线');
    });

     function orient() {
        //;
        if (window.orientation == 0 || window.orientation == 180) {
            $("body").attr("class", "portrait");  //当竖屏的时候为body增加一个class
            orientation = 'portrait';
            return false;
        }
        else if (window.orientation == 90 || window.orientation == -90) {
            $("body").attr("class", "landscape"); //当横屏的时候为body移除这个class
            orientation = 'landscape';
   
            return false;
        }
    }
   
   
    $(function(){
        orient();
    });
   
   
    $(window).bind( 'orientationchange', function(e){
        orient();
    });

});
