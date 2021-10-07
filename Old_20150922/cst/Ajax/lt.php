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
if (!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) || strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) != "xmlhttprequest") {
    echo "Er:005";
    exit;
}

include("../../Config/Config.Inc.php");####加载配置文件


$myat = decode($_GET["action"]);


$date1 = $_GET["d1"];
$date2 = $_GET["d2"];


$date1 = returndatetime($date1);
$date2 = returndatetime($date2, "max");
@setcookie("vd1", $date1, time() + 3600, "/");
@setcookie("vd2", $date2, time() + 3600, "/");


$mu = "#_@mobilelogin";
$d2 = "#_@cstdata";
##########################################以上为各种需要的表的名称#########################################################
if ($myat == "list") {

    $data3 = dcode($_GET["d3"]);
    $date4 = $_GET["d4"];
    $IsUser = "";
    if (!empty($data3)) {
        $IsUser = " $d2.`uid`='" . $data3 . "' and ";
    }
    $DataList = $YumDamSql->selectsql("select $d2.`Id`,$d2.`selecttime`,$d2.`itemdata`,$d2.`indate`,$mu.`ucname`,count($d2.`uid`) as `re` from $d2 left join $mu on $d2.`uid`=$mu.`Id` where " . $IsUser . " $d2.`selecttime` between " . $date1 . " and " . $date2 . " group by $mu.`Id`,$d2.`selecttime` WITH ROLLUP");
    if (!is_array($DataList["select"])) {
        $DataList["select"] = array();
    }
    $DataListC = $DataList["select"];
    $iscount = $date4 == "1" ? false : true;###统计使用，目前功能尚未实现

#print_r($DataUserListC);echo "\n\n<br><br>";
    include_once(SiteTpl . "/lt.tpl");
    exit;
} else {
    echo "未知错误";
    exit;
}
##########################################以上为指定日期正式用户数据############################################################
?>