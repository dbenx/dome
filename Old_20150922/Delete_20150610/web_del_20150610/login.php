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
    unset($_SESSION["YumDamSid"]);
    unset($_SESSION["YumDamSname"]);
    unset($_SESSION["YumDamGroup"]);
    header("Location:./list.php");
    exit;
}

if ($_POST) {

    $mlogin = '#_@anlogin';
    foreach ($_POST as $v => $k) {
        ${$v} = $k;
    }


    include("Config/Common.Inc.php");####加载配置文件
    if ($suser == "" || $spass == "") {
        exit("数据为空！");
    }


    $where = " `username`='$suser' and `userpass`='" . passmd5($spass) . "' and `IsDisplay`=1";
    $sql = " * ";
    $SRes = $YumDamSql->selectdb($sql, "$mlogin", "$where");

    if ($SRes["row"] == "1") {

        $_SESSION["YumDamSid"] = $SRes["select"][0]["Id"];

        $_SESSION["YumDamSname"] = $suser;

        $_SESSION["YumDamGroup"] = $SRes["select"][0]["usergroup"];

#print_r($_SESSION);

        header("Location:./list.php");

#echo "getSname:".$_SESSION["sname"];
    } else {
        header("Location:./index.php?action=Login");

    }
    exit;
}


header("Location:./index.php?action=Login");

?>