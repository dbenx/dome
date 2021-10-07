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
#echo "Er:005";
#exit;不能添加，添加了不能自动跳转
}


$ate = $_GET["ate"];
$at = decode($_GET["action"]);

#echo $at;exit;
if ($at != "s" && $at != "ms") {
    echo "数据出现错误-D0";
    exit;
}
$itime = dcode($ate);
$itime = date("Ymd", $itime);
if ($itime != $YesToday1) {
    echo "数据出现错误-D1";
    exit;
}
$mt3 = '#_@datalist';
$sqlwhere1 = " `fdate` " . YumDamDay($itime);
$IsExsit1 = $YumDamSql->selectdb(" `Id`,`mId` ", $mt3, $sqlwhere1);
if ($at == "ms") {
    if (empty($IsExsit1["select"][0]["mId"]) && $IsExsit1["row"] <= 0) {
        $field1 = "`fdate`,`mId`,`mdate`";
        $field2 = "'$YesToday3','" . $YumDamSId . "','" . time() . "'";
        $YumDamSql->insertdb($mt3, $field1, $field2);
    }
    if ($IsExsit1["row"] >= "1") {
        echo "出现错误-D2";
        exit;
    }
#@header("Location:../InData3.php?at=I");
    echo "Y";
#exit;
} elseif ($at == "s") {
    $YumDamSql->updatedb($mt3, "`sendid`='" . $YumDamSId . "',`sendtime`='" . time() . "'", "`Id`='" . $IsExsit1["select"][0]["Id"] . "'");
#####################################################################################################
    $WxTk = GetWXToken($wxappid, $wxsecret);
    $urlcont = "http://i.gyml.cc/webaccount/m.php?at=" . encode("TS") . "&d=" . ecode($YesToday) . "&d2=" . rand(1, 999999);
    $SendListRes = $YumDamSql->selectsql("SELECT `wxid` FROM  `#_@wxlogin` where `allow`='1' and `MyGroup` in (2,3)");
    if ($SendListRes["row"] > "0") {
        foreach ($SendListRes["select"] as $Sk => $Sv) {
            YumDamToWxMsg($WxTk, $Sv["wxid"], $YesToday2, $urlcont);###发送微信
        }
    }
#####################################################################################################
}

#####################################################################################################
echo "Y";

?>