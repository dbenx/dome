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

if ($YumDamGId != "1" && $YumDamGId != "3") {
    YumDamShowMsgExit("抱歉,您未获得此权限！", "./");
    exit;
}


$myaction = decode($_GET["action"]);

$mid = dcode($_GET["d"]);
$t = decode($_GET["t"]);
$s = dcode($_GET["s"]);
$d1 = dcode($_GET["d1"]);


if ($myaction == "is") {
    $mt2 = '#_@mobilenumber';
    $mscont = $_GET["yumdamc"];
    if (empty($mscont)) {
        echo time();
        exit;
    }
    $mscont = js_unescape($mscont);#echo $mscont;exit;

    if (empty($mscont)) {
        exit("内容异常，请返回重试！");
    }
    $IsSelectMySet = $YumDamSql->selectsql("SELECT `mytelcode` FROM  $mt2 where $mt2.`msgdate`=0 and $mt2.`Id`=" . $mid);
    $SendPhoneNum = $IsSelectMySet["select"][0]["mytelcode"];

    @include("../../Config/YumDam.MSG.php");####加载配置文件

    $SendMsg = new YumDamMSG();
    $SendMsg->SetTel($SendPhoneNum);
    $SendMsgRe = $SendMsg->SendCont($mscont);
    if ($SendMsgRe["result"] != "0") {
        echo "抱歉，发送失败，请返回重试！";
        exit;
    }


    if ($IsSelectMySet["row"] == 1) {
        $IsMySet = $YumDamSql->updatedb($mt2, "`msgcont`='" . $mscont . "',`msgdate`='" . time() . "'", "`mytelcode`='" . $SendPhoneNum . "' and `msgcont`='0'");
        echo "<input type=\"button\" value=\"发送成功！返回手机号码列表\" id=\"backlist\" onclick=\"mylistst()\" class=\"B\" \/>";
        exit;
    }
}

###################################################################################################################################
###################################################################################################################################
if ($myaction != "s") {
    echo time();
    exit;
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" height="40">
            <input type="button" value="返回手机号码列表" id="backlist" onclick="mylistst()" class="B"/>
        </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="250" align="right">电话号码：</td>
        <td><?= MobleNum($t) ?></td>
    </tr>
    <tr>
        <td align="right">访问日期：</td>
        <td><?= timetodate($d1) ?></td>
    </tr>
    <tr>
        <td align="right">上次状态：</td>
        <td><strong><?= YumDamMStatus($s) ?></strong></td>
    </tr>
    <tr>
        <td colspan="2" align="right">&nbsp;</td>
    </tr>
    <tr>
        <td height="60" align="right">短信内容：</td>
        <td>
            <textarea style="width:360px; height:80px; line-height:25px; padding:5px; font-weight:bold;"
                      id="mscont"></textarea>
        </td>
    </tr>
    <tr>
        <td height="60" align="right">&nbsp;</td>
        <td><input type="submit" class="B"
                   onclick="_GoToLink('Ajax/ms.php?<?= str_replace(encode("s"), encode("is"), $_SERVER["QUERY_STRING"]) . rand(1, 999) ?>','mscont')"
                   value="发送"/></td>
    </tr>
</table>