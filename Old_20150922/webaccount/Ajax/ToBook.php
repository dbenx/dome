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
include("../../Config/Config.Inc.php");####加载配置文件


if (!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) || strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) != "xmlhttprequest") {
    echo "Er:005";
    exit;
}


$MyURL = $_GET["m"];
$MyURL = decode($MyURL);
$MyCont = js_unescape($_GET["c1"]);
$MyCont2 = $_GET["c2"];
$MyCont2 = dcode(decode($MyCont2));
#echo $MyCont2;
#exit;
#$MyCont2="110011";
#$MyCont2=dcode($MyCont2);
if ($MyURL == "tbk") {
    $mt9 = '#_@mybooks';
    $field1 = "`fdate`,`mycont`,`indate`,`uip`";
    $field2 = "'$MyCont2','$MyCont','" . time() . "','" . getip() . "'";
    $_InTable = $YumDamSql->insertdb($mt9, $field1, $field2);
    echo "Y";
}
echo "N";
?>