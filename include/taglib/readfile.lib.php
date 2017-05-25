<?php 
if(!defined('DEDEINC')) 
{ 
exit("Request Error!"); 
} 
function lib_readfile(&$ctag,&$refObj) 
{ 
global $dsql,$envs; 
//属性处理 
$attlist="url|"; 
FillAttsDefault($ctag->CAttribute->Items,$attlist); 
extract($ctag->CAttribute->Items, EXTR_SKIP); 
if($url != '') 
{ 
$contents = file_get_contents($url); 
//如果出现中文乱码使用下面代码 
//$contents = iconv(”gb2312″, “utf-8″,file_get_contents($url)); 
} 
else{ 
$contents = '远程地址不能为空'; 
} 
$revalue = $contents; 
return $revalue; 
} 
?>