$(function() {



    // 主导航的子栏目菜单下滑，以纵向列表显�?
    if ($(".show_column").length > 0) {
        $(".show_column").subColumnShow({
            "pullDownBgColor":"#fff",
            "pullDownBorder":"1px solid #eee",
            "showSpeed":200
        });
    }

if ($("#nav").length > 0) {
 var pathName = window.location.pathname;
        var curIndex = 0;
        var navNode = $("#nav");

       // pathName = pathName.replace("/", "");

        if (-1 != pathName.indexOf("index") || pathName == "") {
            curIndex = 0;
        } else if (-1 != pathName.indexOf("buzz") || -1 != pathName.indexOf("application") || -1 != pathName.indexOf("tags")) {
            curIndex = 1;
        } else if (-1 != pathName.indexOf("help")) {
            curIndex = 2;
        } else if (-1 != pathName.indexOf("openapi")) {
            curIndex = 3;
        } else if (-1 != pathName.indexOf("plugin")) {
            curIndex = 4;
        } else if (-1 != pathName.indexOf("joinin")) {
            curIndex = 5;
        } else if (-1 != pathName.indexOf("fee")) {
            curIndex = 6;
        } else {
            curIndex = 0;
        }
//alert(curIndex);
        $(".nav_item").find("a").removeClass("navCur");
$(".nav_item").eq(curIndex).children("a").addClass("navCur");
      
}

    if ($(".banner").length > 0) {
        // 全屏带背景轮播，自动适应屏幕
        bigScroll();
    }

            if ($(".banner-text").length  > 0) {
                var left = $(".nav_main").offset().left;
                $(".banner-text").css("left", left);
            }

    if ($("#current_member").length > 0) {
            var node = $(".nav_main");
            var w = node.width();
            var w2 = $("#login_box").width();
            var loginLeft = node.offset().left + w - w2;
            $(".login-box").css("left", loginLeft);
       
    }
  if ($("#current_member").length > 0) {
        $(window).on("resize", function() {

            if ($(".banner-text").length  > 0) {
                var left = $(".nav_main").offset().left;
                $(".banner-text").css("left", left);
            }

            var node = $(".nav_main");
            var w = node.width();
            var w2 = $("#login_box").width();
            var loginLeft = node.offset().left + w - w2;
            $(".login-box").css("left", loginLeft);
        });
}

    var rightBox = $(".right_box");

    if (rightBox.length > 0) {

        var index = 0;
        var that = null;

        rightBox.find("li").each(function() {
            that = $(this);
            index = that.index();

            if (0 == index % 2) {
                
                that.css("float", "right");
            }
        });
    }

        
});
