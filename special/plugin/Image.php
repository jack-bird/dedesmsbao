<?php
//defined('ACC')||exit('Access Denied');
class Image {
    protected $im;
    protected $img_width;
    protected $img_height;
    protected $img_type;
    protected static $codeType = 'radian';
    protected static $code;
    public static $sum;

    public function __construct()
    {

    }
    // 生成随机数
    static public function randStr($n = 4) {
        if($n <= 0) {
            return '';
        }

        $str = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789';
        $str = substr(str_shuffle($str),0,$n);

        return $str;
    }
    
    
    // 生成验证码
    static public function chkcode($w=100,$h=50) {
        // $w 宽, $h 高
        /*
        self::$code = self::randStr(4);
        if ('normal' == self::$codeType) {
            self::normalCode($w, $h);
        } else if ('radian' == self::$codeType) {
            self::radianCode($w, $h);
        } else if ('jisuan' == self::$codeType) {
            self::jisuan();
        }
        */
        //self::jisuan();
        
    }

    //水印
    static public function addsy($rurl, $surl) {
        $big = getinfo($rurl);
        $sm = self::getinfo($surl);

        $creatbig = imagecreatefrom . $big['func'];
        $creatsm = imagecreatefrom . $sm['func'];
        $rsa = $creatbig($rurl);
        $rsb = $creatsm($surl);

        imagecopymerge($rsa, $rsb, $big['width'] - $sm['width'], $big['height'] - $sm['height'], 0, 0, $sm['width'], $sm['height'], 50);

        $sc = image . $big['func'];
        $sc($rsa, $rurl);
        return $rurl;

    }


    public static function make_thumb($ori,$w=200,$h=200) {
        $info = self::getinfo($ori);
        // 判断原图大小,如果原图比缩略还小,不必处理.
        if ($info['width'] <= $w && $info['height'] <= $h ) {
            return str_replace(ROOT, '', $ori);
        }

        //判断原图类型，如果不是图片，也不必处理。
        if ($info['func'] === false) {
            return false;
        }
        
         //读出大图当画布，分析出读取大图所用的函数名.
        $createfunc = 'imagecreatefrom' . $info['func'];
        $src = $createfunc($ori);

        //创建小画布,并把缩略图背景做成白色
        $small = imagecreatetruecolor($w, $h);
        $white = imagecolorallocate($small, 255, 255, 255);
        imagefill($small, 0, 0, $white);

        // 复制大图到小图，以更小的缩小比例为准,才能装下
        $scale = min($w/$info['width'], $h/$info['height']);

        // 根据比例,算最终复制过去的块的大小.
        $realw = $info['width'] * $scale;
        $realh = $info['height'] * $scale;

        // 计算留白
        $lw = round(($w - $realw)/2); // 计算左侧留的宽度
        $lh = round(($h - $realh)/2); // 计算上部留的高度
        
        //生成缩略图
        imagecopyresampled($small, $src, $lw, $lh, 0, 0, $realw, $realh, $info['width'], $info['height']);

        /*
        header('content-type: image/jpeg');
        imagejpeg($small);
        */

        // 计算小图片的存储路径
        $thumburl = str_replace('.','_thumb.',$ori);
        $imagefunc = 'image' . $info['func'];
        
        //判断并尝试生成缩略图文件保存。
        if($imagefunc($small,$thumburl)) {

            //生成可调用的缩略文件路径，保存在数据库里。
            return str_replace(ROOT,'',$thumburl);
        } else {
            return false;
        }


    }
    
    //获取图片类型信息
    public static function getinfo($ori) {
        $arr = getimagesize($ori);

        // 如果原始图片分析不出来,直接false
        if($arr === false) {
            return false;
        }
        
        $info = array();
        
        $info['width'] = $arr[0];
        $info['height'] = $arr[1];
        
        switch($arr[2]) {
            case 1:
            $info['func'] = 'gif';
            break;

            case 2:
            $info['func'] = 'jpeg';
            break;

            case 3:
            $info['func'] = 'png';
            break;

            case 6:
            $info['func'] = 'wbmp';
            break;

            default:
            $info['func'] = false;
        
        }

        return $info;
    }

    /*
        普通验证码制作，带雪花和线条。radian
    */
    public static function normalCode($w, $h) {
        self::$code = self::randStr();

        //获取画布资源
        $im = imagecreatetruecolor($w, $h);

        //调个随机颜色做背景，颜色较淡。
        $rand_color = imagecolorallocate($im, mt_rand(200,255), mt_rand(200,255), mt_rand(200,255));

        //给背景填充颜色。
        imagefill($im, 0, 0, $rand_color);

        //做6个线条，颜色和位置随机。
        for ($i=0; $i<6; ++$i) {
            $linecolor = imagecolorallocate($im, mt_rand(150, 200), mt_rand(150, 200), mt_rand(150, 200));
            imageline($im, mt_rand(0, $w), mt_rand(0, $h), mt_rand(0, $w), mt_rand(0, $h), $linecolor);
        }

        //做80个雪花，颜色和位置随机。
        for ($i=0; $i<80; ++$i) {
            $snowcolor = imagecolorallocate($im, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
            imagestring($im, 3, mt_rand(0, $w), mt_rand(0, $h), '*', $snowcolor);
        }

        //把循环出来的4个随机字符按顺序排随机范围位置
        for ($i=0; $i<4; ++$i) {
            $strcolor = imagecolorallocate($im, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imagettftext($im, 18, mt_rand(-30, 30), $w/4*$i+2, $h/1.4, $strcolor, '../font/elephant.ttf', self::$code[$i]);
        }
        session_start();
        //保存总值
        $_SESSION['verify'] = self::$code;

        //向浏览器输出jpg图片，不做保存处理。
        header('content-type:image/jpeg');
        imagejpeg($im);

        //销毁画布。
        imagedestroy($im);
    }
        
    protected static function radianCode($w, $h) {
        $im = imagecreatetruecolor($w,$h);
        $bak = imagecreatetruecolor($w,$h);

        // 造颜色,背景和字体背景随机色

        $rdcolor = array();
        for ($i=0; $i<3; ++$i) {
            $rdcolor[] = mt_rand(156, 255);
        }
        //随机的背景色和随机的字符背景颜色，并且要一致。
        $bak_color = imagecolorallocate($bak, $rdcolor[0], $rdcolor[1], $rdcolor[2]);
        $font_color = imagecolorallocate($im, $rdcolor[0], $rdcolor[1], $rdcolor[2]);

        // 填充
        imagefill($im, 0, 0, $font_color);

        imagefill($bak, 0, 0, $bak_color);

        //随机线条
        for ($i=0; $i<6; ++$i) {
            $linecolor = imagecolorallocate($im, mt_rand(150, 200), mt_rand(150, 200), mt_rand(150, 200));
            imageline($im, mt_rand(0, $w), mt_rand(0, $h), mt_rand(0, $w), mt_rand(0, $h), $linecolor);
        }

        //随机雪花
        for ($i=0; $i<80; ++$i) {
            $snowcolor = imagecolorallocate($im, mt_rand(150, 200), mt_rand(150, 200), mt_rand(150, 200));
            imagestring($im, 3, mt_rand(0, $w), mt_rand(0, $h), '*', $snowcolor);
        }

        //把循环出来的4个随机字符按顺序排随机范围位置
        for ($i=0; $i<4; ++$i) {
            $strcolor = imagecolorallocate($im, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imagettftext($im, 18, 0, $w/4*$i, $h/1.4, $strcolor, '../font/elephant.ttf', self::$code[$i]);
        }

        $niu = 3;
        for($i=0;$i<100;$i++) {
            // 按正弦函数计算Y轴的波动
            $y = sin(deg2rad((720/$w) * $i)) * $niu;            
            imagecopy($bak,$im,$i,$y,$i,0,1,$h);
        }

        header('content-type: image/jpeg');
        imagejpeg($bak);

    }

//数学验证码
    public static function jisuan() {
	$num = array();//装随机数
	$sum = 0; //计算结果
	$show = array(); //装显示的值

	//获取2个随机数
	for ($i=0; $i<2; ++$i) {
		$num[$i] = mt_rand(1,9);
	} 

	//指定大的数字在前面显示，小的在后面
	$num[0] = max($num);
	$num[1] = min($num);

	//运算符号样式
	$petten = array('×', '—', '+');

	//随机取出运算符号中的1个
	$key = array_rand($petten,1);

	//给show赋值一个运算的过程，如：5+5= 这样。
	$show[0] = $num[0];
	$show[1] = $petten[$key];
	$show[2] = $num[1];
	$show[3] = '=';

	//加入除号运算符，必须满足一些条件，把显示的符号变成除号
	if ($num[0] % $num[1] == 0 && $num[0] - $num[1] != 0 && $num[1] != 1) {
		$sum = $num[0] / $num[1];

        //由于$petten[$key]在上面已经获取了符号，上面除法运算后，在下面$petten[$key]会根据上面取到的符号，再运算一次，把除法的sum覆盖掉。
        $petten[$key] = null;
		$show[1] = '÷';
	}

	//sum保存各项运算结果
	if ('+' === $petten[$key]) {
	    $sum = $num[0] + $num[1]; 
	} else if ('—' === $petten[$key]) {
		$sum = $num[0] - $num[1];
	} else if ('×' === $petten[$key]) {
		$sum = $num[0] * $num[1];
	} 

	//保存总值
	$_SESSION['code'] = $sum;

	//获取画布资源
	$im = imagecreatetruecolor(100,50);

	//调个随机颜色做背景，颜色较淡。
	$w = imagecolorallocate($im, mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));

	//给背景填充颜色。
	imagefill($im, 0, 0, $w);

	//做6个线条，颜色和位置随机。
	for ($i=0; $i<6; ++$i) {
	    $linecolor = imagecolorallocate($im, mt_rand(150, 200), mt_rand(150, 200), mt_rand(150, 200));
	    imageline($im, mt_rand(0, 100), mt_rand(0, 50), mt_rand(0, 100), mt_rand(0, 50), $linecolor);
	}

	//做80个雪花，颜色和位置随机。
	for ($i=0; $i<80; ++$i) {
	    $snowcolor = imagecolorallocate($im, mt_rand(150, 200), mt_rand(150, 200), mt_rand(150, 200));
	    imagestring($im, 3, mt_rand(0, 100), mt_rand(0, 50), '*', $snowcolor);
	}


	//把循环出来的4个随机字符按顺序排随机范围位置
	for ($i=0; $i<4; ++$i) {
	    $strcolor = imagecolorallocate($im, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
	    imagettftext($im, 18, mt_rand(-10, 10), 100/4*$i+2, 50/1.4, $strcolor, 'font/elephant.ttf', $show[$i]);
	}

	//向浏览器输出jpg图片，不做保存处理。
	header('content-type:image/jpeg');
	imagejpeg($im);

	//销毁画布。
	imagedestroy($im);
	
 } 


}


