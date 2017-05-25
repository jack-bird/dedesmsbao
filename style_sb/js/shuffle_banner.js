//大图轮播
function bigScroll(){
    if ($(".flashBox").length > 0) {
        var timer=null;

        $(".flashBox").each(function(){
            var i=0;
            var that = $(this);
            //var prev=that.find(".bannerBtn a.prev");
            //var next=that.find(".bannerBtn a.next");
            var pageI=that.find("ol li");
            var imgLi=that.find("ul li");

            function right() {
                i++;
                if (i == imgLi.length) {
                    i = 0
                }
            }
            function left() {
                i--;
                if (i < 0) {
                    i = imgLi.length - 1
                }
            }
            function run(){
                pageI.eq(i).addClass("active").siblings().removeClass("active");
                imgLi.eq(i).fadeIn(600).siblings().fadeOut(600).hide();
            }

            function runn(){
                right();
                run();
                timer = setTimeout(runn, 6000);
            }

            runn();
            // timer = setTimeout(runn, 0);

            if (pageI.length > 0) {
                pageI.each(function(index){
                    $(this).click(function(){
                        i=index;
                        run();
                    });
                }).eq(0).trigger("click");
            }


                $(".flashBox").hover(function(){
                    clearTimeout(timer);
                    if ($(".bannerBtn a").length > 0) {
                        $(".bannerBtn a").fadeIn(600);
                    }

                },function(){
                    timer = setTimeout(runn, 6000);
                    if ($(".bannerBtn a").length > 0) {
                        $(".bannerBtn a").fadeOut(600);
                    }

                });


            // if (prev.length > 0) {
            //     prev.click(function(){
            //         left();
            //         run();
            //     });
            // }
            //
            // if (next.length > 0) {
            //     next.click(function(){
            //         right();
            //         run();
            //     });
            // }

        })
    }

}







