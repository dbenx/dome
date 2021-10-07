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

if (!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) || strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) != "xmlhttprequest") {
    echo "Er:005";
    exit;
}

$date1 = $_GET["d1"];
$date2 = $_GET["d2"];
$myaction = decode($_GET["action"]);

$mid = dcode($_GET["d"]);

if ($myaction != "list") {
    echo time() . "<br>出错!";
    exit;
}


$mt2 = '#_@mobilenumber';


if (decode($_GET["m2"]) == "inda") {
    $dt = dcode($_GET["dt"]);
    $di = dcode($_GET["di"]);
    $IsGoTo = $YumDamSql->updatedb($mt2, "`isstate`='$dt',`mdate`='" . time() . "'", "`Id`='$di'");


    $CookieDate1 = $_COOKIE["vd1"];
    $CookieDate2 = $_COOKIE["vd2"];
    if (empty($CookieDate1)) {
        $CookieDate1 = time() - 3600 * 24 * 2;
    }
    if (empty($CookieDate2)) {
        $CookieDate2 = time();
    }
    $CookieDate1 = date("Y-m-d", $CookieDate1);
    $CookieDate2 = date("Y-m-d", $CookieDate2);
    echo "<strong><a href=\"javascript:;\" onclick=\"_GoToLink('Ajax/ld.php?action=" . encode("list") . "&d1=" . $CookieDate1 . "&d2=" . $CookieDate2 . "&rd=" . rand(1, 9999) . "');\">恭喜您，处理成功，点击返回!</a></strong>";
    exit;
}


#######################################################抢占号码############################################################################
$IsSelectMySet = $YumDamSql->selectsql("SELECT `Id` FROM  $mt2 where $mt2.`ismyid`=0 and $mt2.`Id`=" . $mid);
if ($IsSelectMySet["row"] == 1) {
    $IsMySet = $YumDamSql->updatedb($mt2, "`ismyid`='" . $YumDamSId . "',`ismydate`='" . time() . "'", "`ismyid`='0' and `Id`='" . $mid . "'");
    if ($IsMySet["affect"] != "1") {
        echo "<strong><a href=\"javascript:;\" onclick=\"_GoToLink('Ajax/ld.php?action=" . encode("list") . "&d1=" . $CookieDate1 . "&d2=" . $CookieDate2 . "&rd=" . rand(1, 9999) . "');\">抢占失败，点击返回!</a></strong>";
        exit;
    }
}
#######################################################抢占号码############################################################################


###################################################################################################################################
$ItemShow = $YumDamSql->selectsql("SELECT * FROM  $mt2 where $mt2.`Id`=" . $mid);


$ItemShowCont = $ItemShow["select"][0];

function emptydata($data)
{
    if (empty($data) || $data == "NULL" || $data == "undefined") {
        $data = "未知";
    }
    return $data;
}

###################################################################################################################################
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" height="40"><a href="javascript:;"
                                          onclick="_GoToLink('Ajax/ld.php?<?= $_SERVER["QUERY_STRING"] . "&is=" . encode("false") . "&d=" . ecode(time()) ?>')"
                                          target="_self" class="B">返回手机号码列表</a> | <a href="javascript:;"
                                                                                     onclick="_GoToLink('Ajax/ld.php?<?= $_SERVER["QUERY_STRING"] . "&is=" . encode("true") . "&d=" . ecode(time()) ?>')"
                                                                                     target="_self"
                                                                                     class="B">点击查看我独有顾客！</a></td>
    </tr>
</table>
<?
if ($ItemShow["row"] == 0) {
    exit;
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="250" align="right">电话号码：</td>
        <td><?= $ItemShowCont["mytelcode"] ?></td>
    </tr>
    <tr>
        <td align="right">访问地址：</td>
        <td><a href="<?= $ItemShowCont["nowurl"] ?>" target="_blank"><?= $ItemShowCont["nowurl"] ?></a></td>
    </tr>
    <tr>
        <td align="right">搜索关键词：</td>
        <td><?= emptydata($ItemShowCont["seachkey"]) ?></td>
    </tr>
    <tr>
        <td align="right">来源：</td>
        <td><?= emptydata($ItemShowCont["fromsource"]) ?></td>
    </tr>
    <tr>
        <td align="right">设备型号：</td>
        <td><?= emptydata($ItemShowCont["hardm"]) ?></td>
    </tr>
    <tr>
        <td align="right">省份：</td>
        <td><?= $ItemShowCont["mybigcity"] ?></td>
    </tr>
    <tr>
        <td align="right">城市：</td>
        <td><?= $ItemShowCont["mycity"] ?></td>
    </tr>
    <tr>
        <td align="right">访问日期：</td>
        <td><?= timetodate($ItemShowCont["myvdate"]) ?></td>
    </tr>
    <tr>
        <td align="right">访问IP：</td>
        <td><?= $ItemShowCont["myinip"] ?></td>
    </tr>
    <tr>
        <td align="right">上次处理日期：</td>
        <td>
            <?
            if (!empty($ItemShowCont["mdate"])) {
                echo timetodate($ItemShowCont["mdate"]);
            } else {
                echo "&nbsp;";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td align="right">上次状态：</td>
        <td><strong><?= YumDamMStatus($ItemShowCont["isstate"]) ?></strong></td>
    </tr>
    <tr>
        <td colspan="2" align="right">&nbsp;</td>
    </tr>
    <tr>
        <td align="right">现在状态：</td>
        <td>
            <?
            foreach ($YumDamMStatus as $k => $cv) {
                ?>
                <a href="javascript:;" onclick="GoT('<?= ecode($k) ?>','<?= ecode($ItemShowCont["Id"]) ?>')"
                   target="_self" class="B"><em><strong><?= $cv ?></strong></em></a> &nbsp;
                <?
            }
            ?>
        </td>
    </tr>
</table>