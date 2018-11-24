/*
html
<img src="替换图片路径(可不写src属性，但必须写placeholder:'图片地址')" original="图片地址">
使用方法:
$(selector).lazyload({
	placeholder		: 	"/static/images/load.gif",	//(缓存图片目前不可用)
	effect			:	"fadeIn",					//(效果:淡入)
	event        	: 	"scroll",					//(时间,点击还是滚动图片)
	maxwidth		:	500,						//图片加载完后的宽度尺寸
	maxheight		:	500,						//图片加载完后的高度尺寸
})
*/
var settings;
(function($) {

    $.fn.lazyload = function(options) {
        settings = {
            threshold    : 0,
            failurelimit : 0,
            event        : "scroll",
            effect       : "show",
            container    : window,
			maxwidth	 : "auto",
			maxheight    : "auto",
			fn_complete  : ""
        };
                
        if(options) {
            $.extend(settings, options);
        }

        /* Fire one scroll event per scroll. Not one scroll event per image. */
        var elements = this; var lazyload_img = null;
        if ("scroll" == settings.event) {
            $(settings.container).bind("scroll", function(event) {
                
                var counter = 0;
                elements.each(function() {
                    if ($.abovethetop(this, settings) ||
                        $.leftofbegin(this, settings)) {
                            /* Nothing. */
                    } else if (!$.belowthefold(this, settings) &&
                        !$.rightoffold(this, settings)) {
                            $(this).trigger("appear");
                    } else {
                        if (counter++ > settings.failurelimit) {
                            return false;
                        }
                    }
                });
                /* Remove image from array so it is not looped next time. */
                var temp = $.grep(elements, function(element) {
                    return !element.loaded;
                });
                elements = $(temp);
                return false;
            });
//            
        }
        this.each(function() {
            var self = this;
            
            /* Save original only if it is not defined in HTML. */
            /*if (undefined == $(self).attr("original")) {
               // $(self).attr("original", $(self).attr("src"));     
            }

            if ("scroll" != settings.event || 
                    undefined == $(self).attr("src") || 
                    settings.placeholder == $(self).attr("src") || 
                    ($.abovethetop(self, settings) ||
                     $.leftofbegin(self, settings) || 
                     $.belowthefold(self, settings) || 
                     $.rightoffold(self, settings) )) {
                        
                if (settings.placeholder) {
                    $(self).attr("src", settings.placeholder);      
                } else {
                    $(self).removeAttr("src");
                }
                self.loaded = false;
            } else {
				//$(self).attr("src", $(self).attr("original"));  
                self.loaded = true;
            }*/
            
            /* When appear is triggered load original image. */			
            $(self).one("appear", function() {
                //if (!this.loaded) {
					//alert($(this)[0].scrollHeight);
                    var img = $("<img />")
                        .bind("load", function() {
							if(!$(self).hasClass("loaded"))
							{
								if($(self).attr("original"))
								{
									$(self)
										.hide()
										.attr({"src":$(self).attr("original")})
										.removeAttr("original")
										.css({"max-width":settings.maxwidth,"max-height":settings.maxheight})
										.addClass("loaded")
										[settings.effect](settings.effectspeed);
										//alert($(self)[0].scrollWidth+'|'+settings.maxwidth);
									if($(self)[0].scrollWidth>settings.maxwidth)
									{
										$(self).css({"width":settings.maxwidth+'px'});
									}
									if($(self)[0].scrollHeight>settings.maxheight)
									{
										$(self).css({"height":settings.maxheight+'px'});
									}
									self.loaded = true;
								}
							}
                        })
                        .attr("src", $(self).attr("original"))
						
                        if(settings.fn_complete != '' && settings.fn_complete != null){
                        	img[0].onreadystatechange = settings.fn_complete;
                        }
						
                //}
				
            });

            /* When wanted event is triggered load original image */
            /* by triggering appear.                              */
            if ("scroll" != settings.event) {
                $(self).bind(settings.event, function(event) {
                    if (!self.loaded) {
                        $(self).trigger("appear");
                    }
                });
            }
        });
        
        /* Force initial check if images should appear. */
        
        $(settings.container).trigger(settings.event);
        
        return this;

    };

    /* Convenience methods in jQuery namespace.           */
    /* Use as  $.belowthefold(element, {threshold : 100, container : window}) */

    $.belowthefold = function(element, settings) {
        if (settings.container === undefined || settings.container === window) {
            var fold = $(window).height() + $(window).scrollTop();
        } else {
            var fold = $(settings.container).offset().top + $(settings.container).height();
        }
        return fold <= $(element).offset().top - settings.threshold;
    };
    
    $.rightoffold = function(element, settings) {
        if (settings.container === undefined || settings.container === window) {
            var fold = $(window).width() + $(window).scrollLeft();
        } else {
            var fold = $(settings.container).offset().left + $(settings.container).width();
        }
        return fold <= $(element).offset().left - settings.threshold;
    };
        
    $.abovethetop = function(element, settings) {
        if (settings.container === undefined || settings.container === window) {
            var fold = $(window).scrollTop();
        } else {
            var fold = $(settings.container).offset().top;
        }
        return fold >= $(element).offset().top + settings.threshold  + $(element).height();
    };
    
    $.leftofbegin = function(element, settings) {
        if (settings.container === undefined || settings.container === window) {
            var fold = $(window).scrollLeft();
        } else {
            var fold = $(settings.container).offset().left;
        }
        return fold >= $(element).offset().left + settings.threshold + $(element).width();
    };
    /* Custom selectors for your convenience.   */
    /* Use as $("img:below-the-fold").something() */

    $.extend($.expr[':'], {
        "below-the-fold" : "$.belowthefold(a, {threshold : 0, container: window})",
        "above-the-fold" : "!$.belowthefold(a, {threshold : 0, container: window})",
        "right-of-fold"  : "$.rightoffold(a, {threshold : 0, container: window})",
        "left-of-fold"   : "!$.rightoffold(a, {threshold : 0, container: window})"
    });
    
})(jQuery);