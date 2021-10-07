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
##define('SiteTpl', SiteInc."/../cst/Tpl/v1");###咨询师系统模板路径


include(SiteInc . "/Common.Inc.php");####加载配置文件

include(SiteInc . "/YumDam.Connet.php");####加载配置文件

include(SiteInc . "/Config.Function.php");####加载配置文件


$YumDamSql = new YumDam_DB_Connet();

session_save_path(SiteRoot . "/MySid/");
session_start();
session_name("YumDamSessionId");


$YumDamNotSelfCont = str_replace(".", "A", getip()) . "A" . date("m\Ad", time());
$YumDamNotSelf = $_SESSION["YumDamNotId"];


$TipsCont = '欢迎您 <strong style="color:#008000;">' . $_SESSION["YumDamCname"] . '</strong> ！ <a href="./?ma=' . encode("list") . '">查看列表</a>-<a href="./?ma=list">临时数据</a> &nbsp; | &nbsp; <a href="./indata.php?at=d">数据录入</a> &nbsp; | &nbsp; <a href="./login.php?m=exit" target="_self">退出登录</a>';

$YumDamSId = $_SESSION["YumDamSid"];
$YumDamGId = $_SESSION["YumDamGroup"];

$nowurl = stristr($_SERVER['PHP_SELF'], "login/index");
$nowurl2 = stristr($_SERVER['QUERY_STRING'], "at=VFM=");###排除对外邮件及微信链接
if (empty($nowurl) && empty($nowurl2)) {
    if (empty($YumDamSId)) {
        YumDamShowMsgExit("您不能进行此操作，未登录！", "/Login/?gourl=" . urlencode($_SERVER['REQUEST_URI']));
    }
}

if ($_POST) {
    foreach ($_POST as $v => $k) {
#$k=str_replace(",","",$k);
        ${$v} = $k;
#${$v}=str_replace(",","",$k);
        /*
        if((${$v})=="")
        {
            echo "有数据为空！";
            exit;
            }状态1联系成功2停机3关机4空号5无法接通
            */
    }
}


$YesToday = time() - 3600 * 24;####昨日日期
$YesToday1 = date("Ymd", $YesToday);###昨日加密日期
$YesToday2 = date("Y年m月d日", $YesToday);###昨日中文日期
$YesToday3 = strtotime($YesToday1 . " 08:00:00");###昨日中文日期

/*
$nowurl=stristr($_SERVER['PHP_SELF'],"login");
if(empty($nowurl))
{
if(empty($YumDamSId))
{
YumDamShowMsgExit("您不能进行此操作，未登录！","./login.php?gourl=".urlencode($_SERVER['REQUEST_URI']));
	}
}*/

$UserGroup = array(
    "1" => "超级管理员",
    "2" => "网电咨询",
    "3" => "信息发送员",
    "4" => "网电主管",
    "5" => "仅发送短信",
);


$YumDamComeFrom = array(
    "21" => "百度竞价",
    "22" => "百度健康",
    "23" => "百度网盟",
    "24" => "360搜索",
    "25" => "Sogou搜索",
    "26" => "微信",
    "27" => "门户",
    "28" => "未知来源",
);


$YumDamDataClass = array(
    "1" => "百度推广(美莱)",
    "2" => "百度推广(当代)",
    "3" => "百度健康(gy-gyml)",
    "4" => "百度网盟(gy-gyml)",
    "5" => "360推广(Mylike)",
    "6" => "Sogou推广(Mylike)",
    "7" => "360推广(dangdai)",
    "8" => "Sogou推广(dangdai)",
    "9" => "百度推广(小户-销)",
    "10" => "陌陌推广",
    "11" => "百度推广(口腔)",
    "12" => "百度问医生",
);


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

/**
 *  更新会员缓存(仅用于用户添加和修改页面)
 *
 * @access    public
 * @return    void
 */
function YumDamUpDateAdminInfoCache()
{
    global $YumDamSql;
    $mu = "#_@mobilelogin";
    $UserList = $YumDamSql->selectdb(" `Id`,`ucname` ", $mu, " `IsDisplay`='1'");
    #$aa=$dsql->Execute("dd","SELECT id,uname FROM `#@__admin` ORDER BY id DESC");
    $uinfo = "\n";
    foreach ($UserList["select"] as $k => $v) {
        $uinfo .= "'" . $v["Id"] . "'=>'" . $v["ucname"] . "',\n";
    }
    $aufile = SiteInc . '/YumDamUser.Info';
    $usercont = "<" . "?\r\n//Administrator Name\n###############Name###############\n" . '$AdminList=' . "array(" . $uinfo . ");" . "\n\n\n?" . ">";
    $fp = fopen($aufile, 'w+');
    flock($fp, 3);
    fwrite($fp, $usercont);
    fclose($fp);
}

/**
 *  会员读取
 *
 * @access    public
 * @return    void
 */
function YumDamReadAdmin($ui)
{
    $aufile = SiteInc . '/YumDamUser.Info';
    if (!is_file($aufile)) {
        return $ui;
    }
    @include($aufile);###因为是循环，所以此处不能加once
    if (empty($AdminList[$ui])) {
        $AdminListOut = $ui;
    } else {

        $AdminListOut = $AdminList[$ui];
    }
    return $AdminList[$ui];
}

/**
 *  时间区间
 *
 */

function YumDamDay($mydaymin = 0, $mydaymax = 0)
{
    if (empty($mydaymin)) {
        $mydaymin = date("Ymd ", time());
    }
    if (empty($mydaymax)) {
        $mydaymax = $mydaymin;
    }
    $mydaymin = strtotime($mydaymin . "00:00:00");
    $mydaymax = strtotime($mydaymax . "23:59:59");
    return "between $mydaymin and $mydaymax";
}


?>