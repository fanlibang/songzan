$(document).ready(function(){//刷新页面关闭所有dialog窗口
    var dialog_data = $("body").data();//当前打开dialog信息
    $.each(dialog_data, function(i, n){
        $.pdialog.close(i);
    });
});

function uploadImageFlagNum(){
    var _index = 0;

    $('.appImg img').each(function(i){
        if ($(this).hasClass("imgSelect") ){
            _index = i;
        }
    });

    return _index;
}