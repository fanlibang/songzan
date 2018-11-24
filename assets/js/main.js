$(function () {
    // 下拉框
    $('.opt select').on('change', function () {
        var value = $(this).find('option:selected').text();
        $(this).siblings('span').html(value);
    });
    // 条款
    $('.form-checkbox,.form-apply').on('click', function (e) {
        e.stopPropagation();
        $(this).toggleClass('active');
    });
    $('.item').on('click', function (e) {
        e.stopPropagation();
    });
    //完善信息
    $('.perfect').on('click',function () {
        $('.info-page input,.info-page select').removeAttr('disabled');
    });
    //进度
    $('.progress').on('click',function () {
        $('.bomb-wrapper').removeClass('hide');
    });
    //关闭弹窗
    $('.close').on('click',function () {
        $('.bomb-wrapper').addClass('hide');
    });
});