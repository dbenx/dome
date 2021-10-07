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
define('SiteTpl', SiteInc . "/../Tpl/v1");


include(SiteInc . "/Common.Inc.php");####加载配置文件

include(SiteInc . "/YumDam.Connet.php");####加载配置文件

include(SiteInc . "/Config.Function.php");####加载配置文件


$YumDamSql = new YumDam_DB_Connet();

session_save_path(SiteRoot . "/MySid");
session_start();
session_name("YumDamSessionId");


$YumDamNotSelfCont = str_replace(".", "A", getip()) . "A" . date("m\Ad", time());
$YumDamNotSelf = $_SESSION["YumDamNotId"];


$TipsCont = '欢迎您 <strong style="color:#008000;">' . $_SESSION["YumDamCname"] . '</strong> ！ <a href="./?ma=' . encode("list") . '">查看列表</a>-<a href="./?ma=list">临时数据</a> &nbsp; | &nbsp; <a href="./indata.php?at=d">数据录入</a> &nbsp; | &nbsp; <a href="./login.php?m=exit" target="_self">退出登录</a>';

$YumDamSId = $_SESSION["YumDamSid"];
$YumDamGId = $_SESSION["YumDamGroup"];

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
    "2" => "普通查看员",
    "3" => "信息发送员",
);


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

?>