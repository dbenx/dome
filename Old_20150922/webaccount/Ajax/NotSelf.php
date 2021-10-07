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
$MyCont = $_GET["c"];
if ($MyURL == "Self") {
    $MyYumDamNotSelfCont = str_replace("A", "1", $YumDamNotSelfCont);
    if ($MyCont == $MyYumDamNotSelfCont) {
        $_SESSION["YumDamNotId"] = encode("Y", 2);
        $mt7 = '#_@datalogs';
        $hdinfo = $_SERVER["HTTP_USER_AGENT"] . "||" . $_SERVER["REQUEST_URI"];
        $field1 = "`showpass`,`userinfo`,`showtime`,`showip`";
        $field2 = "'$MyCont','" . $hdinfo . "','" . time() . "','" . getip() . "'";
        if (!isset($YumDamNotSelf)) {
            $YumDamSql->insertdb($mt7, $field1, $field2);
        }
        echo "Y";
        exit;
    }
}
echo "N";
?>