$(document).ready(function(){
    $('input[name=app_id]').die().live('blur', function(){
        var _id = $(this).val();
        var _url = $(this).attr('search-url');
        _url = (_url == undefined || _url == null || _url == '') ? 'getAppInfoByAppId' : _url;
        var _type = $(this).attr('search-type');
        _type = (_type == undefined || _type == null || _type == '') ? null : _type;


        var  _is_search = $(this).attr('is-search');

        if(_is_search == undefined || _is_search == null || _is_search == ''){
            return false;
        }

        alertMsg.confirm("点击确定更新表单，取消则不更新！", {
            okCall: function () {
                if (_id != undefined && _id != null && _id != '') {
                    $.ajaxSettings.global = false;

                    $.getJSON(CONF.http_host + "/api/App/" + _url + "/", {
                        app_id: _id,
                        type: _type,
                        _t: (new Date()).valueOf()
                    }, function (json) {
                        if (json.statusCode == 200) {
                            var app_info = json.data;
                            $('.pageFormContent').find('input[name=app_title]').val(app_info['title']);
                            $('.pageFormContent').find('input[name=bundleid]').val(app_info['bundleid']);

                            if($('.pageFormContent').find('select[name=type_id]').length && app_info['type_arr']['id']){
                                $('.pageFormContent').find('select[name=type_id]').val(app_info['type_arr']['id']);
                                alert(app_info['type_arr']['id']);
                                $('.pageFormContent').find('select[name=type_id]').find("option[value="+app_info['type_arr']['id']+"]").attr("selected",true);

                                $('.pageFormContent').find('select[name=type_id]').prev().attr('value', app_info['type_arr']['id']);
                                $('.pageFormContent').find('select[name=type_id]').prev().text(app_info['type_arr']['title']);
                            }

                            if($('.pageFormContent').find('input[name=unit_price]')){
                                var _cooperation_type = $('.pageFormContent').find('select[name=cooperation_type]').val();

                                selectPrice(app_info['price_arr'], _cooperation_type)
                            }

                            if($('.pageFormContent').find('input[name=uid]') && app_info['user_arr']){
                                var user_info = app_info['user_arr']

                                $('.pageFormContent').find('input[name=uid]').val(user_info['uid']);
                                $('.pageFormContent').find('input[name=merchants]').val(user_info['company_name']);
                                $('.pageFormContent').find('input[name=email]').val(user_info['email']);
                                $('.pageFormContent').find('input[name=account]').val(user_info['account']);

                                $('select[name=contact]').val(user_info['contact']);
                                $('select[name=contact]').prev().attr('value', user_info['contact']);
                                $('select[name=contact]').prev().text(user_info['contact']);
                            }

                        } else {
                            $('.pageFormContent').find('input[name=app_title]').val('');
                            $('.pageFormContent').find('input[name=app_bundleid]').val('');
                        }
                    });

                    $.ajaxSettings.global = true;
                }
            },
            cancelCall: function () {}
        });
    });

    $('input[name=uid]').die().live('blur', function(){

        var _id     = $(this).val();

        var  _is_search = $(this).attr('is-search');

        if(_is_search == undefined || _is_search == null || _is_search == ''){
            return false;
        }

        alertMsg.confirm("点击确定更新表单，取消则不更新！", {
            okCall: function () {
                if(_id != undefined && _id != null && _id != ''){
                    $.ajaxSettings.global=false;

                    $.getJSON(CONF.http_host+"/api/Financial/getDevUserFinancialInfoById/", {uid: _id,_t: (new Date()).valueOf() }, function(json){
                        if(json.statusCode == 200){
                            var user_info = json.data;
                            $('.pageFormContent').find('input[name=merchants]').val(user_info['company_name']);
                            $('.pageFormContent').find('input[name=email]').val(user_info['email']);
                            $('.pageFormContent').find('input[name=account]').val(user_info['account']);

                            $('select[name=contact]').val(user_info['contact']);
                            $('select[name=contact]').prev().attr('value', user_info['contact']);
                            $('select[name=contact]').prev().text(user_info['contact']);
                        }else{
                            $('.pageFormContent').find('input[name=merchants]').val('');
                            $('.pageFormContent').find('input[name=email]').val('');
                            $('.pageFormContent').find('input[name=account]').val('');
                        }
                    });

                    $.ajaxSettings.global=true;
                }
            },
            cancelCall: function () {}
        });
    });

    $('input[name=account]').die().live('blur', function(){

        var _account     = $(this).val();

        var  _is_search = $(this).attr('is-search');

        if(_is_search == undefined || _is_search == null || _is_search == ''){
            return false;
        }

        alertMsg.confirm("点击确定更新表单，取消则不更新！", {
            okCall: function () {
                if(_is_search != undefined && _account != null && _account != ''){
                    $.ajaxSettings.global=false;

                    $.getJSON(CONF.http_host+"/api/Financial/getDevUserFinancialInfoByAccount/", {account: _account,_t: (new Date()).valueOf() }, function(json){
                        if(json.statusCode == 200){
                            var user_info = json.data;
                            $('.pageFormContent').find('input[name=merchants]').val(user_info['company_name']);
                            $('.pageFormContent').find('input[name=email]').val(user_info['email']);
                            $('.pageFormContent').find('input[name=uid]').val(user_info['uid']);

                            $('select[name=contact]').val(user_info['contact']);
                            $('select[name=contact]').prev().attr('value', user_info['contact']);
                            $('select[name=contact]').prev().text(user_info['contact']);
                        }else{
                            $('.pageFormContent').find('input[name=merchants]').val('');
                            $('.pageFormContent').find('input[name=email]').val('');
                            $('.pageFormContent').find('input[name=uid]').val('');
                        }
                    });

                    $.ajaxSettings.global=true;
                }
            },
            cancelCall: function () {}
        });
    });

    var cooperation_price = {};

    $('select[name=cooperation_type]').change(function(){
        var _cooperation_type   = $(this).children('option:selected').val();

        var _type_id            = $('.pageFormContent').find('select[name=type_id]').val();

        var  _is_search = $(this).attr('is-search');

        if(_is_search == undefined || _is_search == null || _is_search == ''){
            return false;
        }

        var _is_new = _type_id >=1000000 ? 1 : 0;

        alertMsg.confirm("点击确定更新表单，取消则不更新！", {
            okCall: function () {
                if(cooperation_price[_type_id]){
                    selectPrice(cooperation_price[_type_id], _cooperation_type);
                }else{
                    if(_type_id != undefined && _type_id != null && _type_id != ''){
                        $.ajaxSettings.global=false;

                        $.getJSON(CONF.http_host+"/api/Category/getFirstTypePrice/", {type_id: _type_id, is_new : _is_new,_t: (new Date()).valueOf() }, function(json){
                            if(json.statusCode == 200){
                                cooperation_price[_type_id]    = json.data;

                                selectPrice(json.data, _cooperation_type);
                            }else{
                                cooperation_price[_type_id]    = [];
                                selectPrice(json.data, _cooperation_type);
                            }
                        });

                        $.ajaxSettings.global=true;
                    }
                }
            },
            cancelCall: function () {}
        });
    });

    $('select[name=type_id]').change(function(){
        var _type_id            = $(this).children('option:selected').val();

        var _cooperation_type   = $('.pageFormContent').find('select[name=cooperation_type]').val();

        var  _is_search = $(this).attr('is-search');

        if(_is_search == undefined || _is_search == null || _is_search == ''){
            return false;
        }

        var _is_new = _type_id >=1000000 ? 1 : 0;

        alertMsg.confirm("点击确定更新表单，取消则不更新！", {
            okCall: function () {
                if(cooperation_price[_type_id]){
                    selectPrice(cooperation_price[_type_id], _cooperation_type);
                }else{
                    if(_type_id != undefined && _type_id != null && _type_id != ''){
                        $.ajaxSettings.global=false;

                        $.getJSON(CONF.http_host+"/api/Category/getFirstTypePrice/", {type_id: _type_id, is_new : _is_new, _t: (new Date()).valueOf() }, function(json){
                            if(json.statusCode == 200){
                                cooperation_price[_type_id]    = json.data;

                                selectPrice(json.data, _cooperation_type);
                            }else{
                                cooperation_price[_type_id]    = [];
                                selectPrice(json.data, _cooperation_type);
                            }
                        });

                        $.ajaxSettings.global=true;
                    }
                }
            },
            cancelCall: function () {}
        });
    });

    function selectPrice(price_arr, type){
        $('.pageFormContent').find('input[name=unit_price]').val(0);
        $.each( price_arr, function(i, n){
            if(type == i){
                $('.pageFormContent').find('input[name=unit_price]').val(n);
            }
        });
    }
});