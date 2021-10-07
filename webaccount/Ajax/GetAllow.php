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
    echo "Er:aw";
    exit;
}

$mwxid = decode($_GET["md1"]);
if (empty($mwxid)) {
    echo "出现未知错误！";
    exit;
}

######################################################权限验证#######################################################################################
$Globalaccess_token = GetWXToken($wxappid, $wxsecret);

########################################################################################################################################################
$UserUrl = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $Globalaccess_token . "&openid=" . $mwxid;
$UserCont = GetCont($UserUrl, true);
$UserNickname = $UserCont["nickname"];###昵称
$IsSelf = $UserCont["subscribe"];###是否关注
if ($IsSelf != "1") {
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, user-scalable=0\">您需要关注公众号：<strong>贵阳美萊电子商务部</strong> 后方可申请！谢谢！";
    exit;
}

#############################################################################################################################################################
$wxus = '#_@wxlogin';

$ListAllowUSRes = $YumDamSql->selectsql("SELECT `Id` FROM  $wxus where `wxid`='" . $mwxid . "'");

if ($ListAllowUSRes["row"] >= "1") {
    echo "您已经提交过申请，等待审核！谢谢！";
    exit;
}

$showip = getip();
$field1 = "`ucname`,`wxid`,`wxname`,`lastdate`,`lastlc`,`allow`";
$field2 = "'" . $UserNickname . "','" . $mwxid . "','" . $UserNickname . "','" . time() . "','" . getip() . "','2'";
$YumDamSql->insertdb($wxus, $field1, $field2);
echo "您的申请已提交，待审核通过后，方可获取此授权！";
exit;
echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, user-scalable=0\"><div style=\"line-height:35px; color:#791d77;\">美莱(MYLIKE)提示您：<br />您的申请已提交，待审核通过后，方可获取此授权！</div>";
exit;
?>