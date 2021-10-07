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
include("./Config/Config.Inc.php");####加载配置文件


if ($YumDamGId != "1" && $YumDamGId != "3") {
    YumDamShowMsgExit("抱歉,您未获得此权限！", "./");
    exit;
}


$fDir = "/Temp/" . substr(md5($YumDamSId), 8, 16) . "/";

if ($_GET["at"] == "Out") {
    $fne = $_GET["mf"];
    @header("HTTP/1.1 303 See Other");
    @header("Location:" . $fDir . $fne);
    exit;
}

$Cont = js_unescape($_POST["c"]);


$Fname = "FromIFile_" . date("YmdHis") . ".xls";
YumDamDeleteDirAndFile(SiteRoot . $fDir);
@mkdir(SiteRoot . $fDir, 0755);
$filec = fopen(SiteRoot . $fDir . $Fname, 'w');
$result = @fwrite($filec, $Cont);
@fclose($filec);

###建立备份
$uname = $_SESSION["YumDamUcn"];
if (!is_dir(SiteRoot . "/UDL/" . $uname . "/")) {
    @mkdir(SiteRoot . "/UDL/" . $uname . "/", 0755);
}
@copy(SiteRoot . $fDir . $Fname, SiteRoot . "/UDL/" . $uname . "/" . $Fname);
###建立备份
InLogs($_SESSION["YumDamCname"] . "(" . $YumDamSId . ")" . "导出数据" . $Fname);

echo $Fname;
#@header( "Location:".$Fname);


#header ( "Content-type:application/vnd.ms-excel" );
#header ( "Content-Disposition:filename=FromIFile_".date("YmdHi").".xls" );

#echo "<table>";
#   echo $Cont;
#echo "</table>";
?>