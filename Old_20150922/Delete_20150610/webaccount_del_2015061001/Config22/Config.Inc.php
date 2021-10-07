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


include(SiteInc . "/Common.Inc.php");####加载配置文件

include(SiteInc . "/YumDam.Connet.php");####加载配置文件

include(SiteInc . "/Config.Function.php");####加载配置文件


$YumDamSql = new YumDam_DB_Connet();

session_save_path(SiteRoot . "/MySid");
session_start();
session_name("YumDamSessionId");


$YumDamNotSelfCont = str_replace(".", "A", getip()) . "A" . date("m\Ad", time());
$YumDamNotSelf = $_SESSION["YumDamNotId"];


$TipsCont = '<strong>报表导航：</strong><a href="./item.php?at=lstd">查看报表</a> | <a href="./">新增报表</a> |  <a href="./item.php?at=list">查看项目表</a> |  <a href="./item.php?at=listd">商务通数据</a> | <a href="./mitem.php?at=list">月报表</a>';


$YumDamComeFrom = array(
    "1" => "未知",
    "2" => "百度竞价",
    "3" => "百度健康",
    "4" => "百度网盟",
    "5" => "360搜索",
    "6" => "微信",
    "7" => "门户",
    "8" => "搜狗",
);

?>