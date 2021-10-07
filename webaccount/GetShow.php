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
 *微信获取权限
 *http://www.yumdam.com/
 *
 */

include("../Config/Config.Inc.php");####加载配置文件


$at = decode($_GET["at"]);
$d1 = dcode($_GET["d"]);
$d2 = $_GET["d2"];
$wxcode = $_GET["code"];

######################################################权限验证#######################################################################################
$selfurl = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];###本页面完整链接
#echo $selfurl;
#print_r($_SERVER);exit;
$selfurlgo = urlencode($selfurl);

if (!isset($wxcode)) {
    $wxoauthurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $wxappid . "&redirect_uri=" . $selfurlgo . "&response_type=code&scope=snsapi_base&state=YumDamSt#wechat_redirect";
    header("HTTP/1.1 301 Moved Permanently");
    header("Location:" . $wxoauthurl);
    exit;
}

$GoUrl = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $wxappid . "&secret=" . $wxsecret . "&code=" . $wxcode . "&grant_type=authorization_code";
$Cont = GetCont($GoUrl, true);
$openid = $Cont['openid'];//输出openid
####################################################################################################################################################
$wxus = '#_@wxlogin';
$ListAllowUSRes = $YumDamSql->selectsql("SELECT `Id` FROM  $wxus where `wxid`='" . $openid . "' and `allow`='1'");

if ($ListAllowUSRes["row"] != "1") {
    echo "<script type=\"text/javascript\" src=\"/Scripts/yumdam.my.js\"></script>\n";
    echo "<script type=\"text/javascript\">\nfunction mytw(){\nvar md1='" . encode($openid) . "||" . $openid . "';if(md1==\"\"||md1==\"0\"){return false}\nvar url=\"./Ajax/GetAllow.php?" . $_SERVER["QUERY_STRING"] . "&md1=\"+md1+\"&r=" . rand(1, 99999) . "\";\nrequest.open(\"GET\",url,true);\ndocument.getElementById(\"myt\").innerHTML=\"提交中……\";\nrequest.onreadystatechange=function(){if(request.readyState==4&&request.status==200){var response=request.responseText;\ndocument.getElementById(\"myt\").innerHTML=response}}\nrequest.setRequestHeader(\"X-Requested-With\",\"XMLHttpRequest\");\nrequest.send(null)}\n</script>\n";
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, user-scalable=0\"><div style=\"line-height:40px; color:#791d77;\">美莱(MYLIKE)很抱歉<br />您暂未获得此授权，请与我们联系！<br /><strong><span id=\"myt\"><a href=\"javascript:;\" onclick=\"mytw()\">点击申请获取权限</a></span></strong></div>";
    exit;
} else {
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, user-scalable=0\"><strong style=\"color:green;\">恭喜您，您已具备查看权限！</strong>";
    exit;
}
######################################################权限验证#######################################################################################
?>