<?
/*
 *2011-1-14
 *
 *From :YumDam
 *
 *E-mail:yumdam@yumdam.com
 *
 *QQ:992360020
 *
 *http://www.yumdam.com/
 *
 */

###修改信息来源错误


$a = 'a:8:{i:1;s:1:"4";i:2;s:2:"30";i:3;s:1:"8";i:4;s:1:"0";i:5;s:1:"6";i:6;s:1:"0";i:7;s:1:"6";i:8;s:1:"4";}';
$b = unserialize($a);
$cc = array();
foreach ($b as $k => $v) {
    if ($k == '6') {
        $v = "6";
    }
    if ($k == "7") {
        $v = "0";
    }
    $cc[$k] = $v;
}
echo serialize($cc);
print_r($b);
print_r($cc);
?>