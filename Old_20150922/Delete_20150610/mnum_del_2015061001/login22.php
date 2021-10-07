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
if ($_GET["m"] == "exit") {
    InLogs($_SESSION["YumDamCname"] . "(" . $YumDamSId . ")" . "注销系统");
    unset($_SESSION["YumDamSid"]);
    unset($_SESSION["YumDamUcn"]);
    unset($_SESSION["YumDamGroup"]);
    unset($_SESSION["YumDamCname"]);
    YumDamShowMsgExit("您已安全退出！", "./");
    exit;
}
#####################################################################################
if ($_POST) {
#####################################################################################	
    $mlogin = '#_@mobilelogin';
    $where = " `username`='$mysuser' and `userpass`='" . passmd5($spass) . "' and `IsDisplay`=1";
    $sql = " * ";
    $SRes = $YumDamSql->selectdb($sql, "$mlogin", "$where");
    if ($SRes["row"] == "1") {
        $_SESSION["YumDamSid"] = $SRes["select"][0]["Id"];
        $_SESSION["YumDamUcn"] = $mysuser;
        $_SESSION["YumDamGroup"] = $SRes["select"][0]["usergroup"];
        $_SESSION["YumDamCname"] = $SRes["select"][0]["ucname"];
        $GoUrl = urldecode($_GET["gourl"]);
        if (empty($GoUrl) || stristr($GoUrl, "Ajax") != "") {
            $GoUrl = "./?at=list";
        }
        #$GoUrl=empty($GoUrl)||$stristr($GoUrl,"Ajax")!=""?"?at=list":$GoUrl;
        #$gourl=$SRes["select"][0]["usergroup"]=="1"?"./u.php?action=u":"./list.php?action=list";
        InLogs($SRes["select"][0]["ucname"] . "(" . $SRes["select"][0]["Id"] . ")" . "登录系统", $SRes["select"][0]["Id"]);
        YumDamShowMsgExit("恭喜您,登录成功！", $GoUrl);
        exit;
    }
}
#####################################################################################
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳当代医疗美容医院</title>
    <link href="CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="Scripts/yumdam.my.js"></script>
</head>

<body oncontextmenu="return false;">
<?
@include_once("Inc/head.php");
?>
<div class="Cont">
    <div class="Content">
        <form action="" name="myform" id="myform" method="post" onsubmit="return login()">
            <div class="Tinfo2">
                用户名：<input type="text" class="InPutTxt" name="mysuser" id="mysuser" style="width:160px;"
                           autocomplete="off"/> 密码：<input type="password" name="spass" id="spass" class="InPutTxt"
                                                          style="width:160px;" autocomplete="off"/> <input type="submit"
                                                                                                           id="submitbtn"
                                                                                                           value="登录"/>
            </div>
        </form>
        <div class="clearit"></div>
    </div>
    <div class="clearit"></div>
</div>
</body>
</html>