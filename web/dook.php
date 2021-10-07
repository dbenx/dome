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
include("Config/Config.Inc.php");####加载配置文件


if (empty($YumDamSid)) {
    exit("请先登录！");
}
$mtitle = '#_@anlist';
$lid = $_GET["LId"];
$gid = $_GET["GId"];
$mnocan = '#_@nocan';

if (!empty($lid)) {
    if (!CheckId($lid)) {
        exit("出错！");
    }
}
if (!empty($gid)) {
    if (!CheckId($gid)) {
        exit("出错！");
    }
}
if (!empty($YumDamSid)) {
    if (!CheckId($YumDamSid)) {
        exit("出错！");
    }
}

if ($action == "IsOK" && isset($lid)) {
    $field1 = " `OkDate`='" . time() . "',`OkUser`='" . $YumDamSid . "'";
    $field2 = " Id=" . $lid;
    $IRes = $YumDamSql->updatedb($mtitle, $field1, $field2);
    if ($IRes["affect"] == "1") {
        exit('<font color="green">处理成功！</font>');
    }
    exit;
}
if ($action == "NoCanOK" && isset($lid)) {

    $field1 = " `OkDate`='1',`OkUser`='" . $YumDamSid . "'";
    $field2 = " Id=" . $lid;
    $IRes = $YumDamSql->updatedb($mtitle, $field1, $field2);
    $cont = $_GET["NoCont"];
    $cont = js_unescape($cont);###URL转换
    $cont = is_utf8($cont);###

    $field1 = "`AnId`,`Cont`,`InDate`,`InputIP`,`InUser`";
    $field2 = "'$lid','" . addslashes($cont) . "'," . time() . ",'" . getip() . "','" . $YumDamSid . "'";
    $IRes = $YumDamSql->insertdb($mnocan, $field1, $field2);
    if ($IRes["affect"] == "1") {
        exit('<font color="#FF6600">(' . $cont . ')</font>');
    }
    exit;
}

if ($action == "NowGroup" && isset($lid) && isset($gid)) {
    $field1 = " `NowUser`='$gid'";
    $field2 = " Id=" . $lid;
    $IRes = $YumDamSql->updatedb($mtitle, $field1, $field2);
    if ($IRes["affect"] == "1") {
        exit('<font color="green">处理成功！</font>');
    }
    exit;
}


?>	