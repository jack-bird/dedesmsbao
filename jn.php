<?php
date_default_timezone_set("PRC");
$sr= !empty($_GET["s"]) ? $_GET["s"] : null; 
switch ($sr)
{
case "1":
  $sr = "A5";
  break;
case "2":
  $sr = "BAIDU";
  break;
default:
  $sr = "DEFAULT";
}
setcookie("source", $sr, time()+3600);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta  http-equiv="X-UA-Compatible"  content="IE=edge,chrome=1">
<title>合作联盟_短信宝</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link  rel="stylesheet"  href="/style_sb/css/common.css">
<script type="text/javascript" src="/style_sb/js/jquery.min.js"></script>
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
				
});
</script>
<div  class="navbar">
    <div  class="webContainer">
        <div  class="logo">
            <a  href="/"><img  src="/style_sb/images/logo.png"></a>
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
    var pageIdentify = 'menu38';
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
        <div class="webLmdiv1"></div>
        <div class="webLmdiv2">
	<div class="webLmdiv2_con">
    	<ul class="webLmdiv2_list">
            <li class="l1"><p>全能力接口<br>通讯功能全面</p></li>
            <li class="l2"><p>提供完整产品<br>或功能组件</p></li>
            <li class="l3"><p>低成本、零门槛<br>快速实现通讯功能</p></li>
        </ul>
        <p class="con_info">如果您有丰富的线上/线下推广资源/渠道客户资源。那么，无论您是想在工作/创业之余增加自己额外的收入来源，<br>还是想在互联网通讯行业做出一番事业，短信宝合作联盟都是您的不二选择。</p>
    </div>
   </div>
   <div class="webLmdiv3">
	<ul class="webLmdiv3_list">
    	<li class="l1">
            <h3><em></em><span>码盟推广</span></h3>
            <p>如果您是<br>子会员模式<br>URL链接推广<br>收益按比例返还</p>
        </li>
        <li class="l2">
        	<h3><em></em><span>代理商推广</span></h3>
            <p>可创建下级渠道<br>自主定价<br>提成比例高<br>成本按收入阶梯递减</p>
        </li>
    </ul>
    </div>
    
         <div  class="clear"></div>
            </div>
        </div>
    </div>
</div>
<div  class="clear"></div>
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
            <img  class="lazy"  src="/style_sb/images/qr-code.png"  height="141">
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
<link href="/kefu/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/kefu/js/kefu.js"></script>
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