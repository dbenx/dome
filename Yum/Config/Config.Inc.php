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

// 报错级别设定,一般在开发环境中用E_ALL,这样能够看到所有错误提示
// 系统正常运行后,直接设定为E_ALL || ~E_NOTICE,取消错误显示
#error_reporting(E_ALL);
error_reporting(E_ALL || ~E_NOTICE);
#echo  dirname(__FILE__);##获取当前目录，服务器目录
@header('Content-Type:text/html; charset=utf-8');
define('SiteInc', str_replace("\\", '/', dirname(__FILE__)));
define('SiteRoot', str_replace("\\", '/', substr(SiteInc, 0, -7)));
define('SiteData', SiteRoot . "/Data");
$MySidDir = SiteRoot . "/MySid/";
##define('SiteTpl', SiteInc."/../cst/Tpl/v1");###咨询师系统模板路径


include(SiteInc . "/Common.Inc.php");####加载配置文件

include(SiteInc . "/YumDam.Connet.php");####加载配置文件

include(SiteInc . "/Config.Function.php");####加载配置文件


$YumDamSql = new YumDam_DB_Connet();

if (!is_dir($MySidDir)) {
    YumDamMkDir($MySidDir);
}
session_save_path($MySidDir);
session_start();
session_name("YumDamSessionId");


$YumDamSId = dcode($_SESSION[encode("YumDamSid")]);
$YumDamGId = dcode($_SESSION[encode("YumDamGroup")]);

$nowurl = stristr($_SERVER['PHP_SELF'], "User/index");
$nowurl2 = stristr($_SERVER['QUERY_STRING'], "at=VFM=");###排除对外邮件及微信链接
if (empty($nowurl) && empty($nowurl2)) {
    if (empty($YumDamSId)) {
        YumDamShowMsgExit("您不能进行此操作，未登录！", "/User/?gourl=" . urlencode($_SERVER['REQUEST_URI']));
    }
}


if ($_POST) {
    foreach ($_POST as $v => $k) {
        ${$v} = $k;
    }
}


$YesToday = time() - 3600 * 24;####昨日日期
$YesToday1 = date("Ymd", $YesToday);###昨日加密日期
$YesToday2 = date("Y年m月d日", $YesToday);###昨日中文日期
$YesToday3 = strtotime($YesToday1 . " 08:00:00");###昨日中文日期


$YumDamMyTaskClass = array(###日历任务提醒模式
    "1" => "每天",
    "2" => "每周",
    "3" => "每月",
    "4" => "当天",
);


###############################微信部分###################################################
$wxappid = "wxbf9c7b931ee95147";
$wxsecret = "485eed7187db44a071a40ed0f07e203f";


###############################微信部分###################################################


?>