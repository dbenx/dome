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
include("../Config/Config.Inc.php");####加载配置文件

if ($YumDamGId != "1" && $YumDamGId != "3") {
    YumDamShowMsgExit("抱歉,您未获得此权限！", "./");
    exit;
}


$yestoday = time() - 3600 * 24;
$yestoday1 = ecode(date("Ymd", $yestoday));
$yestoday2 = date("Y年m月d日", $yestoday);
$yestoday3 = date('Ymd', $yestoday);
$yestodaymin = strtotime($yestoday3 . "00:00:00");
$yestodaymax = strtotime($yestoday3 . "23:59:59");
##########################################以上处理各种需要的时间############################################################

$mt1 = '#_@formclass';
$mt2 = '#_@formdata';
$mt3 = '#_@formdata3';
$mt4 = '#_@dataclass';
$mt6 = '#_@formdata2';
##########################################以上为各种需要的表的名称#########################################################


include_once("Tpl/WV1/indata.tpl");


?>