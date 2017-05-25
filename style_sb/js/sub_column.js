/**
 * Created by king on 16/4/26.
 */
(function($) {
    $.fn.subColumnShow = function(o) {
        var opts = $.extend({}, $.fn.subColumnShow.defaults, o);
        var ele = this;
        var res = null;

        $(".columnShow-inline").hide();

        ele.each(function(){
            var nowEle = $(this);
            var box = nowEle.parent().find(".columnShow-inline");
            var sub = box.children();

            //这里的高度定位是根据主导航定的，不是根据整个页面定的
            box.width(nowEle.outerWidth()).css(
                {
                    "position":"absolute",
                    "top":nowEle.height() + 22,
                    "z-index":200,
                    "overflow":"hidden",
                    "backgroung":opts.pullDownBgColor,
                    "border":opts.pullDownBorder,
                    "border-top":"none"
                });


            nowEle.mouseenter(function(){

                res = setTimeout(function(){
                    nowEle.css('zIndex', 10);

                    if(box.is(':hidden')){
                        box.show();
                        sub.css('marginTop', -sub.outerHeight());
                    }

                    sub.stop().animate({"marginTop": 0}, opts.showSpeed);

                },200);
            }).mouseleave(function(){
                if(null != res) {
                    clearTimeout(res);
                }

                nowEle.css('zIndex', 5);

                if(sub.length > 0){
                    sub.stop().animate({"marginTop": -sub.outerHeight()}, opts.showSpeed, function(){
                        box.hide();
                        nowEle.css('zIndex', 1);
                    });
                }else{
                    //nowEle.removeClass(typeCls);
                }
            });

        });


        return $(this);

    };

    //默认样式css
    $.fn.subColumnShow.defaults = {
        "pullDownBgColor":"#fff",
        "pullDownBorder":"1px solid #eee",
        "showSpeed":200
    };

})(jQuery);
