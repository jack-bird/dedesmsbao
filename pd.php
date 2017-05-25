<?php
date_default_timezone_set("PRC");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta  http-equiv="X-UA-Compatible"  content="IE=edge,chrome=1">
<title>产品信息_短信宝</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link  rel="stylesheet"  href="special/css/common.css">
<link  rel="stylesheet"  href="special/css/product.css">
<script type="text/javascript" src="special/js/jquery.min.js"></script>

<script>

    $(function(){
        $.ajax({
            "url" : "/special/setting.php",
            "type" : "post",
            "data" : null,
            "success" : function(){}
        });
    });
</script>


    <script type="text/javascript">
        var countdown = 5;
        var res = null;
        var flg = true;

        function settime(val) {
            if (countdown == 0) {
                val.removeAttribute("disabled");
                $(val).text("发送测试");
                clearTimeout(res);

                return;
            } else {
                val.setAttribute("disabled", true);
                $(val).text("重新发送(" + countdown + ")");
                countdown--;
            }

            res = setTimeout(function() {
                settime(val)
            },1000)
        }

        function getVal(val) {
            flg = false; // 防止重复提交

            $.ajax({
                "url" : "/special/ajax/test_ajax.php",
                "data" : val,
                "dataType" : "json",
                "type" : "post",
                "success" : function(obj) {
                    //conslog.log(obj);
                    if (true == obj.flg && null == obj.error) {
                        countdown = 60;
                        settime($("#sub")[0]);
                        editCode($("#code")[0]);
                        $(".error").html("发送成功。感觉不错？<a href='/reg' class='reg'>立即注册</a>, 即送体验短信。").css({"color":"green", "text-align":"center"});
                    } else {
                        $(".error").text("发送失败。原因：" + obj.error).css({"color":"red", "text-align":"center"});
                    }

                    flg = true;
                }
            });
        }

        function editCode(that) {
            that.src = "special/plugin/verify_code.php?" + Math.random();
        }

        $(function(){
            var val = null;

            $("#test_form").on("submit", function() {
                if (true === flg) {
                    val = $(this).serialize();
                    getVal(val);
                }

                return false;
            });

            $("#code").on("click", function() {
                editCode(this);
            });
        });

    </script>

    <script type="text/javascript">
        /**
         * placeholder标签兼容方案
         */
        $(function(){
            if(!placeholderSupport()){   // 判断浏览器是否支持 placeholder
	        $("[placeholder]").css("color", "#989898");
                $('[placeholder]').focus(function() {
                    var input = $(this);
                    if (input.val() == input.attr('placeholder')) {
                        input.val('');
                        input.removeClass('placeholder');
                    }
                }).blur(function() {
                    var input = $(this);
                    if (input.val() == '' || input.val() == input.attr('placeholder')) {
                        input.addClass('placeholder');
                        input.val(input.attr('placeholder'));
                    }
                }).blur();
            };
        })
        function placeholderSupport() {
            return 'placeholder' in document.createElement('input');
        }
    </script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?2df8035c98586ed226d55efb41b29e34";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</head>
<body  class="index">
<div  class="wrapper">
<div  class="top-bar ">
<div  class="webContainer">
    <div  class="top-box">
        <ul  class="contact-bar">
            <li  class="tel last">400-009-0465</li>
        </ul>
        <ul id="current_member" class="user-bar" style="float:right">
            <li  class="active first"><a  href="/login">登录</a></li>
            <li  class="last"><a  href="/reg">注册</a></li>
        </ul>
    </div>
</div>
</div>

<script>
    $(function() {
        $(".user-bar li").hover(function() {
            $(this).find('ul').show();
        }, function() {
            $(this).find('ul').hide();
        });
        $(".language-bar li").hover(function() {
            $(this).find('div').show();
        }, function() {
            $(this).find('div').hide();
        });
    });
</script>
<script type="text/javascript">
/*
$().ready(function() {
var $current_member = $("#current_member");

					$.ajax({
						url: "http://beta.smsbao.com/common/current_member.jhtml",
						type: "GET",
						dataType: "json",
						cache: false,
						success: function(message) {
							if (message.isLogin == "true") {

                                                           $current_member.html("<li class='active first'><a  href='/member/index.jhtml'>"+message.username+"</a></li><li class='last'><a  href='/logout.jhtml'>退出</a></li>");
							}
                                                }
					});
				
});*/
</script>
<div  class="navbar">
    <div  class="webContainer">
        <div  class="logo">
            <a  href="/"><img  src="special/images/logo.png"></a>
        </div>
        <ul  class="navbar-nav">
            <li class="nav-menu"><a id="menu0" href="/" class="menu">首页</a></li>
            <li class="nav-menu"><a id="menu2" href="/buzz/" class="menu">谁在用？</a></li>
            <li class="nav-menu"><a id="menu41" href="/help/" class="menu">使用指南</a></li>
            <li class="nav-menu"><a id="menu34" href="/openapi/" class="menu">接口API</a></li>
            <li class="nav-menu"><a id="menu35" href="/plugin/" class="menu">开源插件</a></li>
            <li class="nav-menu"><a id="menu38" href="/joinin/" class="menu">合作联盟</a></li>
            <li class="nav-menu"><a id="menu37" href="/fee/" class="menu">资费标准</a></li>
        </ul>
    </div>
</div>
<script>
    var pageIdentify = 'menu45';
    if (pageIdentify) {
        $("#"+pageIdentify).addClass('cur');
    }
</script>
<!--主体内容开始-->
<div  class="main-box">
    <div  class="share-box">
        <div  class="container">
            <div  class="content">
                <div class="webBuzzCon">
        <div class="subject1">
            <div class="adv">

                <div class="test">
                    <div class="test_con">
                        <ul>
                            <li><span class="test_con_tit">最低4.9分 /</span> 每条 (包月套餐)</li>
                            <li class="test_con_text">还在观望？短信宝质量可保证！</li>
                            <li class="test_con_text">5秒即可送达，不信？来试一下！！</li>
                        </ul>
                    </div>
                    <form method="post" action="./test.php" id="test_form">
                        <label><input id="phone_input" type="text" value="" placeholder="请输入手机号 以便于您测试我们的验证短信" name="test"/></label>
                        <input type="text" value="" name="verify_code" id="code_input" placeholder="请输入验证码" />
                        <img id="code" src="special/plugin/verify_code.php" />
                        <button id="sub" type="submit">发送测试</button>
                        <p>(系统已做部分限制，如无法收到短信，请更换号码或稍后再试。)</p>
                        <p class="error"></p>
                    </form>

                </div>
            </div>
        </div>
        
<div class="subject2">
                            <div class="subjict2_con">
                                <ul class="subjict2_list">
                                    <li class="l1" style="height:60px;">
                                        用短信宝发短信
                                        <span style="color:#ff8510;">只需简单3步</span>
                                        ，完全自助
                                    </li>
        <p align="center" style="padding-bottom: 10px;">
            <a href="/reg" class="btn btn-large btn-solid" style="font-weight:normal;  background:#f58b3c; color:#ffffff;">开始注册，即送体验短信</a>
        </p>
                                </ul>
                                <ul class="tools">
                                    <li>
                                        <img src="special/images/shipper-step-one.png">
                                        <h4>
                                            <a href="/reg">在线注册</a>
                                        </h4>
                                    </li>
                                    <li>
                                        <img src="special/images/shipper-step-two.png">
                                        <h4>
                                            <a href="/fee">在线充值</a>
                                        </h4>
                                    </li>
                                    <li>
                                        <img src="special/images/shipper-step-three.png">
                                        <h4>
                                            <a href="/openapi">API接口调用</a>
                                        </h4>
                                    </li>
                                </ul>
                                <div class="clear"></div>
                            </div>
</div>
  
<div  class="clear"></div>
 </div>     
</div>
</div>
</div> <!-- sharebox -->

<section class="home-row-3">
        <h2>
            为什么选择
            <span style="color:#ff8510">短信宝</span>
            发短信
        </h2>
        <p align="center" style="line-height:40px;">
            我们就是短信行业里的专家，解决您面对良莠不齐供应商的苦恼
            <br>
            <a href="/reg" class="btn btn-large btn-solid" style="font-weight:normal;        				             background:#f58b3c; color:#ffffff;">开始注册，即送体验短信</a>
        </p>
        <ul class="advantage">
            <li style="padding-top:30px;">
                <div class="pi-col-xs-3 pi-padding-bottom-40">
                    <div class="pi-icon-box-vertical pi-icon-box-vertical-icon-bigger pi-text-center">
                        <div class="pi-icon-box-icon pi-icon-box-icon-circle pi-icon-box-icon-base" style="background: #bbea76;">
                            <img src="special/images/pig-lined-white.png" alt=""></div>
                        <h5 class="pi-weight-700 pi-uppercase pi-letter-spacing">三网合一</h5>
                        <p class="pi-margin-bottom-10">工信部审批专属码号，打通三大运营商</p>
                    </div>
                </div>
            </li>
            <li style="padding-top:30px;">
                <div class="pi-col-xs-3 pi-padding-bottom-40">
                    <div class="pi-icon-box-vertical pi-icon-box-vertical-icon-bigger pi-text-center">
                        <div class="pi-icon-box-icon pi-icon-box-icon-circle pi-icon-box-icon-base" style="background: #77DD77;">
                            <img src="special/images/lightning.png" alt=""></div>
                        <h5 class="pi-weight-700 pi-uppercase pi-letter-spacing">快速便捷</h5>
                        <p class="pi-margin-bottom-10">响应速度快，3~5秒可到达</p>
                    </div>
                </div>
            </li>
            <li style="padding-top:30px;">
                <div class="pi-col-xs-3 pi-padding-bottom-40">
                    <div class="pi-icon-box-vertical pi-icon-box-vertical-icon-bigger pi-text-center">
                        <div class="pi-icon-box-icon pi-icon-box-icon-circle pi-icon-box-icon-base" style="background: #5ED5A4;">
                            <img src="special/images/Success ratio.png" alt=""></div>
                        <h5 class="pi-weight-700 pi-uppercase pi-letter-spacing">到达率高</h5>
                        <p class="pi-margin-bottom-10">短信行业运营十年经验，到达率高达99.99%</p>
                    </div>
                </div>
            </li>
            <li style="padding-top:30px;">
                <div class="pi-col-xs-3 pi-padding-bottom-40">
                    <div class="pi-icon-box-vertical pi-icon-box-vertical-icon-bigger pi-text-center">
                        <div class="pi-icon-box-icon pi-icon-box-icon-circle pi-icon-box-icon-base" style="background: #49C0C0;">
                            <img src="special/images/contacts.png" alt=""></div>
                        <h5 class="pi-weight-700 pi-uppercase pi-letter-spacing">联系人分组</h5>
                        <p class="pi-margin-bottom-10">对联系人建组并设置信息，提高发送效率</p>
                    </div>
                </div>
            </li>

        </ul>
        <ul class="advantage"> 

            <li style=" margin-top:50px;">
                <div class="pi-col-xs-3 pi-padding-bottom-40"> 
                    <div class="pi-icon-box-vertical pi-icon-box-vertical-icon-bigger pi-text-center">
                        <div class="pi-icon-box-icon pi-icon-box-icon-circle pi-icon-box-icon-base" style="background: #bbea76;">
                            <img src="special/images/information.png" alt=""></div>
                        <h5 class="pi-weight-700 pi-uppercase pi-letter-spacing">短信提醒</h5>
                        <p class="pi-margin-bottom-10">自定义短信余额提醒</p>
                    </div>
                </div>
            </li>
            <li style=" margin-top:50px;">
                <div class="pi-col-xs-3 pi-padding-bottom-40">
                    <div class="pi-icon-box-vertical pi-icon-box-vertical-icon-bigger pi-text-center">
                        <div class="pi-icon-box-icon pi-icon-box-icon-circle pi-icon-box-icon-base" style="background: #77DD77;">
                            <img src="special/images/coin-lined-white.png" alt=""></div>
                        <h5 class="pi-weight-700 pi-uppercase pi-letter-spacing">降低成本</h5>
                        <p class="pi-margin-bottom-10">一手短信通道，保证价格最低</p>
                    </div>
                </div>
            </li>
            <li style=" margin-top:50px;">
                <div class="pi-col-xs-3 pi-padding-bottom-40">
                    <div class="pi-icon-box-vertical pi-icon-box-vertical-icon-bigger pi-text-center">
                        <div class="pi-icon-box-icon pi-icon-box-icon-circle pi-icon-box-icon-base" style="background: #5ED5A4;">
                            <img src="special/images/Perfect interface.png" alt=""></div>
                        <h5 class="pi-weight-700 pi-uppercase pi-letter-spacing">完美接口</h5>
                        <p class="pi-margin-bottom-10">完美的接口程序，接入非常简单，支持所有程序</p>
                    </div>
                </div>
            </li>
            <li style=" margin-top:50px;">
                <div class="pi-col-xs-3 pi-padding-bottom-40">
                    <div class="pi-icon-box-vertical pi-icon-box-vertical-icon-bigger pi-text-center">
                        <div class="pi-icon-box-icon pi-icon-box-icon-circle pi-icon-box-icon-base" style="background: #49C0C0;">
                            <img src="special/images/trophy.png" alt=""></div>
                        <h5 class="pi-weight-700 pi-uppercase pi-letter-spacing">口碑服务</h5>
                        <p class="pi-margin-bottom-10">一周7天在线客服，响应空闲期不超过5分钟</p>
                    </div>
                </div>
            </li>
				</ul>
    </section>
    <section class="home-row-3 home-row-3-1">
        <h2>
            短信宝的
            <span style="color:#ff8510">服务能力</span>
            有多强
        </h2>
        <p align="center" style="line-height:40px;">上百根短信通道，上千家企业每天不断在刷新着短信发送的数字记录</p>
        <p align="center" style="padding-bottom: 10px;">
            <a href="/reg" class="btn btn-large btn-solid" style="font-weight:normal;  background:#f58b3c; color:#ffffff;">开始注册，即送体验短信</a>
        </p>
        <ul class="advantage" style="padding-top:30px">
            <li> <i class="advantage-1"></i>
                <h4>
                    <div class="pi-counter pi-counter-simple" data-count-from="0" data-count-to="5000" data-easing="easeInCirc"                     data-duration="500" data-frames-per-second="0">
                        <span class="pi-counter-number">5000+</span>
                        
                    </div>
                </h4>
                <p>企业/开发者的认可</p>
            </li>
            <li> <i class="advantage-6"></i>
                <h4>
                    <div class="pi-counter pi-counter-simple" data-count-from="0" data-count-to="80" data-easing="easeInCirc" data-duration="800" data-frames-per-second="10">
                        <span class="pi-counter-number">80w</span>
                    </div>
                </h4>
                <p>每天接口调用次数</p>
            </li>
            <li>
                <i class="advantage-7"></i>
                <h4>
                    <div class="pi-counter pi-counter-simple" data-count-from="0" data-count-to="100" data-easing="easeInCirc" data-duration="1000" data-frames-per-second="10">
                        <span class="pi-counter-number">100w</span>
                   </div>
                </h4>
                <p>每天接收短信终端用户数</p>
            </li>
            <li>
                <i class="advantage-8"></i>
                <h4>
                    <div class="pi-counter pi-counter-simple" data-count-from="0" data-count-to="150" data-easing="easeInCirc" data-duration="800" data-frames-per-second="10">
                        <span class="pi-counter-number">150w</span>
                    </div>
                </h4>
                <p>每天发送的短信数量</p>
            </li>
        </ul>
    </section>
    <div class="better">
        <div class="better1">
        	<h1>马上使用更好的短信服务商</h1>
                <div class="better2">
                    <a href="/openapi" class="api">查看开发文档</a>
                    <a href="/reg" class="register-btn">免费注册 即送试用短信</a>
                </div>
        </div>
    </div>
    <div class="advantage2">
        <h2> 我们的客户</h2>
        <p align="center">
           <img src="special/images/kh-logo.gif" width="893" height="185" alt="短信宝 客户案例" />
        </p>
    </div>
</div>
<!--主体内容结束-->
<div  class="footer ">
    <div  class="webContainer">
        <div  class="footer-nav-box service">
          
        </div>
        <div  class="footer-nav-box support">
            <div  class="footer-title">
                <h2>联系我们</h2>
                <span  class="ft-bg"></span>
            </div>
            <div  class="footer-box">
                <p>
                    客服邮箱：<br>
                    support@smsbao.com
                    <a target="_blank" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&key=XzkzODA0NjAyMV8yNTU0MzFfNDAwMDA5MDQ2NV8yXw">
				<img border="0" src="http://wpa.qq.com/pa?p=2:123456:51" alt="短信宝客服" title="短信宝客服" /></a>


                </p>
                <p class="webQQgroup"><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=15766f40539827f7fb3d10bb9b9699b6a7ff3cfa7162341d46cb8f79e4f7dae3"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="点击这里加入此群" title="点击这里加入此群"></a></p>
            </div>
        </div>
        <div  class="footer-nav-box aboutus">
            <div  class="footer-title">
                <h2>使用指南</h2>
                <span  class="ft-bg"></span>
            </div>
            <div  class="footer-box">
                <ul>
                    
                    <li  class="first">
                        <a  href="/help/index.html">使用指南</a><br />
                    </li>
                    <li  class="first">
                        <a  href="/help/faq.html">常见问题</a>
                    </li>
                </ul>
            </div>
        </div>
        <div  class="footer-nav-box aboutus">
            <div  class="footer-title">
                <h2>关注我们</h2>
                <span  class="ft-bg"></span>
            </div>
            <div  class="footer-box">
                <ul>
                    <li  class="first">
                        <a  href="http://t.qq.com/smsbao" target="_blank">腾讯微博</a><br />
                    </li>
                </ul>
            </div>
        </div>
        <div  class="footer-qcode">
            <img  class="lazy"  src="special/images/qr-code.png"  height="141">
        </div>
    </div>
</div>

<script>
    $(function(){
        $('body').on('click', '.qq', function(e){
            $('.contact-qq').parent().find('iframe').contents().find('#launchBtn').click()
        });
    });
</script>
<div  class="clear"></div>
<div  class="page-bottom">
	<ul><li>友情链接：</li><li><a href='http://www.gap.cn/' target='_blank'>GAP</a> </li><li><a href='http://www.kaola100.com/' target='_blank'>考拉网</a> </li><li><a href='http://www.luzhou.com/' target='_blank'>大泸网</a> </li><li><a href='http://www.bbs-p2p.com' target='_blank'>P2P理财论坛</a> </li><li><a href='http://www.wforder.com/' target='_blank'>WFPHP在线订单管理系统</a> </li><li><a href='http://www.niucms.cn/' target='_blank'>Niucms智慧生活系统</a> </li><li><a href='http://www.yungoucms.com' target='_blank'>yungoucms</a> </li><li><a href='http://ddy.me/' target='_blank'>兜兜友</a> </li><li><a href='http://www.demohour.com/' target='_blank'>点名时间</a> </li><li><a href='http://hua.li' target='_blank'>花里花店</a> </li><li><a href='http://oldnavy.gap.cn/' target='_blank'>Old Navy</a> </li><li><a href='http://www.wqggg.com/' target='_blank'>万千购</a> </li></ul>
    <p>Copyright © 2010-2014 smsbao.com All Rights Reserved <br />上海彤伴信息科技有限公司 沪ICP备16002080号-1 上海市松江区广富林路658弄215号910室</p>
</div>
<link href="special/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="special/js/kefu.js"></script>
<!--在线客服Begin-->
<div id="floatTools" class="rides-cs">
	<div class="floatL">
		<a style="display: block" id="aFloatTools_Show" class="btnOpen" title="查看在线客服" onclick="javascript:$('#divFloatToolsView').animate({width: 'show', opacity: 'show'}, 'normal',function(){ $('#divFloatToolsView').show();kf_setCookie('RightFloatShown', 0, '', '/', 'www.smsbao.com'); });$('#aFloatTools_Show').attr('style','display:none');$('#aFloatTools_Hide').attr('style','display:block');" href="javascript:void(0);">
		展开</a>
		<a style="display: none" id="aFloatTools_Hide" class="btnCtn" title="关闭在线客服" onclick="javascript:$('#divFloatToolsView').animate({width: 'hide', opacity: 'hide'}, 'normal',function(){ $('#divFloatToolsView').hide();kf_setCookie('RightFloatShown', 1, '', '/', 'www.smsbao.com'); });$('#aFloatTools_Show').attr('style','display:block');$('#aFloatTools_Hide').attr('style','display:none');" href="javascript:void(0);">
		收缩</a> </div>
	<div id="divFloatToolsView" class="floatR" style="display: none">
		<div class="cn">
                                 <h3>工作时间</h3>
			<ul>
				<li><span>周一至周五</span></li>
                                           <li><span>9:00 - 18:00</span></li>
			</ul>

                                <h3>热线电话</h3>
			<ul>
				<li><span>400-009-0465</span></li>
			</ul>

			<h3>产品支持</h3>
			<ul>
				<li><span>客服</span>
				<a target="_blank" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&key=XzkzODA0NjAyMV8yNTU0MzFfNDAwMDA5MDQ2NV8yXw">
				<img border="0" src="http://wpa.qq.com/pa?p=2:123456:51" alt="短信宝客服" title="短信宝客服" /></a>
				</li>
			</ul>
			<h3>渠道合作</h3>
			<ul>
				<li><span>客服</span>
				<a target="_blank" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&key=XzkzODA0NjAyMV8yNTU0MzFfNDAwMDA5MDQ2NV8yXw">
				<img border="0" src="http://wpa.qq.com/pa?p=2:123456:51" alt="渠道合作" title="渠道合作" /></a></li>
			</ul>
		</div>
	</div>
</div>
<!--在线客服End-->

<div style="display:none">
	<!-- Baidu Button BEGIN --><script type="text/javascript" id="bdshare_js" data="type=slide&img=8&pos=left&uid=637966" ></script><script type="text/javascript" id="bdshell_js"></script><script type="text/javascript">
	document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
</script><!-- Baidu Button END -->
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254025928'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254025928' type='text/javascript'%3E%3C/script%3E"));</script>
<script type="text/javascript">
var _maq = _maq || [];
_maq.push(['apiKey', '100000'],['name', 'UV_<?php echo $sr?>']);

(function() {
    var ma = document.createElement('script'); ma.type = 'text/javascript'; ma.async = true;
    ma.src = ('https:' == document.location.protocol ? 'https://stats' : 'http://stats') + '.smsbao.com/webstats.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ma, s);
})();
</script>
</div>
</div>
</body></html>
