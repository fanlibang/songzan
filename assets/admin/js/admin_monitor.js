/**
 * 统计
 *
 */
$(function(){
    $('select[name=operator]').change(function(){
        var _self = $(this);
        var _val = _self.val();
        if(_val > 0) {
            $("#list_names").show();
            $("#operator_type").show();
        } else {
            $("#list_names").hide();
            $("#operator_type").hide();
        }
    });
});


/**
 * 统计
 *
 */
$(function(){
    $('select[name=eid]').change(function(){
        var _self = $(this);
        var _val = _self.val();
        if(_val == 2 || _val == 8) {
            $(".cz").show();
            $(".title_name").html('注册时间：');
            $(".channel").hide();
        } else if(_val == 3) {
            $(".cz").hide();
            $(".title_name").html('统计时间：');
            $(".channel").show();
        } else {
            $(".cz").hide();
            $(".title_name").html('统计时间：');
            $(".channel").hide();
        }
    });
});