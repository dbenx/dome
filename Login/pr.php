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
include("../Config/Config.Inc.php");####加载配置文件
#####################################################################################
/*
if($_SESSION["YumDamGroup"]!="1")
{
	YumDamShowMsgExit("抱歉,您未获得此权限！","./");
	exit;
	}
*/

$myaction = $_GET["action"];


if ($_POST) {
    $mu = "#_@mobilelogin";
    if (empty($up) || strlen($up) < 6) {
        YumDamShowMsgExit("密码不符合规范！", "./pr.php");
        exit;
    }
    if ($up != $up2) {
        YumDamShowMsgExit("两次密码不匹配！", "./pr.php");
        exit;
    }
    $upasscont = passmd5($up);
    $InNewTable = $YumDamSql->updatedb($mu, "`userpass`='" . $upasscont . "' ", "`Id`='$YumDamSId'");
    YumDamShowMsgExit("恭喜您！密码修改成功，请重新登录！", "/Login/?m=exit");
    exit;
}
#####################################################################################

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳美莱医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body oncontextmenu="return false;">
<div class="Cont">
    <div class="Content">
        <form action="" name="myform" id="myform" method="post">
            <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                    <td width="200" align="right">登录名：</td>
                    <td><?= $_SESSION["YumDamUcn"] . "(" . $_SESSION["YumDamCname"] . ")" ?></td>
                </tr>
                <tr>
                    <td align="right">新密码：</td>
                    <td><input type="password" name="up" id="up" class="InPutTxt" style="width:200px;"/>&nbsp;密码至少6位
                    </td>
                </tr>
                <tr>
                    <td align="right">确认密码：</td>
                    <td><input type="password" name="up2" id="up2" class="InPutTxt" style="width:200px;"/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><font color="#FF0000">以上信息均要填写</font></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="保存"/></td>
                </tr>
            </table>
        </form>
        <div class="clearit"></div>
    </div>
    <div class="clearit"></div>
</div>
</body>
</html>