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

$date1 = $_GET["d1"];
$date2 = $_GET["d2"];
$myaction = decode($_GET["action"]);

if ($myaction != "list") {
    echo time() . "<br>出错!";
    exit;
}

$date1 = returndatetime($date1);
$date2 = returndatetime($date2, "max");
@setcookie("vd1", $date1, time() + 3600, "/");
@setcookie("vd2", $date2, time() + 3600, "/");


$mt3 = '#_@formdata3';
$mt4 = '#_@dataclass';
$mt5 = '#_@itemclass';
$mt6 = '#_@formdata2';

###################################################################################################################################
$ItemList = $YumDamSql->selectsql("SELECT $mt3.`talkall`,$mt3.`talkwap`,$mt3.`retalk1`,$mt3.`retalk2`,$mt3.`notalk`,$mt3.`issys`,$mt3.`isfrom`,$mt3.`isok`,$mt4.`selecttime` FROM  $mt3,$mt4 where $mt3.`fdate`=$mt4.`Id` and $mt4.`selecttime` between " . $date1 . " and " . $date2 . " order by $mt4.`selecttime` desc");

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>&nbsp;</td>
        <td>日期</td>
        <td>商务通对话</td>
        <td>手机对话</td>
        <td>PC对话</td>
        <td>到院重复</td>
        <td>未到院重复</td>
        <td>无效对话</td>
        <td>下单人数</td>
        <td>下单率</td>
        <td>到院人数</td>
        <td>到院率</td>
        <td>成交人数</td>
        <td>成交率</td>
    </tr>
    <?
    foreach ($ItemList["select"] as $k => $v) {
        $rowi++;
        $talk = $talk + $v["talkall"];
        $talkm = $talkm + $v["talkwap"];
        $talkr1 = $talkr1 + $v["retalk1"];
        $talkr2 = $talkr2 + $v["retalk2"];
        $talkr3 = $talkr3 + $v["notalk"];
        $iss = $iss + $v["issys"];
        $isf = $isf + $v["isfrom"];
        $iso = $iso + $v["isok"];
        ?>
        <tr<? if ($rowi % 2 == 0) {
            echo " bgcolor=\"#CAE8F2\"";
        } ?>>
            <td><?= $rowi ?></td>
            <td><?= timetodate($v["selecttime"], true) ?></td>
            <td><?= $v["talkall"] ?></td>
            <td><?= $v["talkwap"] ?></td>
            <td><?= $v["talkall"] - $v["talkwap"] ?></td>
            <td><?= $v["retalk1"] ?></td>
            <td><?= $v["retalk2"] ?></td>
            <td><?= $v["notalk"] ?></td>
            <td><?= $v["issys"] ?></td>
            <td><?= PercentDataColor(round(($v["issys"] / ($v["talkall"] - $v["notalk"]) * 100), 2), 45.17) ?></td>
            <td><?= $v["isfrom"] ?></td>
            <td><?= PercentDataColor(round(($v["isfrom"] / ($v["talkall"] - $v["notalk"]) * 100), 2), 12) ?></td>
            <td><?= $v["isok"] ?></td>
            <td><?= PercentDataColor(round(($v["isok"] / $v["isfrom"] * 100), 2), 63) ?></td>
        </tr>
        <?
    }
    ?>
    <tr bgcolor="#CCCCCC">
        <td>&nbsp;</td>
        <td><strong>小计 | 平均</strong></td>
        <td><strong><?= $talk . " | " . round($talk / $rowi, 2) ?></strong></td>
        <td><strong><?= $talkm . " | " . round($talkm / $rowi, 2) ?></strong></td>
        <td><strong><?= $talk - $talkm . " | " . round(($talk - $talkm) / $rowi, 2) ?></strong></td>
        <td><strong><?= $talkr1 . " | " . round($talkr1 / $rowi, 2) ?></strong></td>
        <td><strong><?= $talkr2 . " | " . round($talkr2 / $rowi, 2) ?></strong></td>
        <td><strong><?= $talkr3 . " | " . round($talkr3 / $rowi, 2) ?></strong></td>
        <td><strong><?= $iss . " | " . round($iss / $rowi, 2) ?></strong></td>
        <td><strong><?= PercentDataColor(round(($iss / ($talk - $talkr3) * 100), 2), 45.17) ?></strong></td>
        <td><strong><?= $isf . " | " . round($isf / $rowi, 2) ?></strong></td>
        <td><strong><?= PercentDataColor(round(($isf / ($talk - $talkr3) * 100), 2), 12) ?></strong></td>
        <td><strong><?= $iso . " | " . round($iso / $rowi, 2) ?></strong></td>
        <td><strong><?= PercentDataColor(round(($iso / $isf * 100), 2), 63) ?></strong></td>
    </tr>
</table>