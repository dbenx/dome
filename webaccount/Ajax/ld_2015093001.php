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
#exit;
}


$date1 = $_GET["d1"];
$date2 = $_GET["d2"];
$myaction = decode($_GET["action"]);

if ($myaction != "list") {
    echo time() . "<br>出错!";
    exit;
}


#$date1=returndatetime($date1);
#$date2=returndatetime($date2,"max");
@setcookie("vd1", $date1, time() + 3600, "/");
@setcookie("vd2", $date2, time() + 3600, "/");

$mt1 = '#_@indata';
$mt2 = '#_@indata2';
#$mt3='#_@datalist';


$ListSRes = $YumDamSql->selectsql("SELECT $mt1.`Id`,$mt1.`fdate`,$mt1.`talkall`,$mt1.`talkwap`,$mt1.`retalk1`,$mt1.`retalk2`,$mt1.`notalk`,$mt1.`issys`,$mt1.`isfrom`,$mt1.`isok`,$mt1.`webip`,$mt1.`bqq` FROM  $mt1 where $mt1.`fdate` " . YumDamDay($date1, $date2) . "");

$DataShowList = array();
foreach ($ListSRes["select"] as $Sk => $Sv) {
    $DataShowList[$Sk] = $Sv;
    $ListSRes2 = $YumDamSql->selectsql("SELECT $mt2.`Id`,$mt2.`fclass`,FROM_UNIXTIME($mt2.`fdate`,'%Y%m%d') as `MyDay`,sum($mt2.`fmoney`) as `fmoney`,sum($mt2.`wapmoney`) as `wapmoney`,sum($mt2.`fclick`) as `fclick`,sum($mt2.`fshow`) as `fshow` FROM  $mt2 where $mt2.`fdate` " . YumDamDay($date1, $date2) . " and $mt2.`fdate`=" . $Sv["fdate"] . " group by `MyDay`,$mt2.`fclass` WITH ROLLUP");
    $DataShowList[$Sk]["DataList"] = $ListSRes2;
    $ListSRes3 = $YumDamSql->selectsql("SELECT sum($mt2.`fmoney`) as `allfmoney`,sum($mt2.`wapmoney`) as `allwapmoney` FROM  $mt2 where $mt2.`fdate` " . YumDamDay($date1, $date2) . " and $mt2.`fdate`=" . $Sv["fdate"] . "");
    $DataShowList[$Sk]["DataCount"] = $ListSRes3["select"][0];

}


#print_r($DataShowList);

#$DataShowList[]["DataList"]=$ListSRes2;
#print_r($DataShowList);

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <?
    foreach ($DataShowList as $lk => $lv) {
        ?>

        <tr>
            <td rowspan="5"><?= timetodate($lv["fdate"], true) ?></td>
            <th height="35" colspan="8">基本情况</th>
        </tr>
        <tr>
            <td bgcolor="#eeeeee">总投入</td>
            <td><?= $lv["DataCount"]["allfmoney"] ?>元</td>
            <td bgcolor="#eeeeee">总对话</td>
            <td><?= $lv["talkall"] ?>人</td>
            <td bgcolor="#eeeeee">对话成本</td>
            <td><?= round($lv["DataCount"]["allfmoney"] / $lv["talkall"], 2) ?>元/人</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td bgcolor="#eeeeee">下单量</td>
            <td><?= $lv["issys"] ?></td>
            <td bgcolor="#eeeeee">下单率</td>
            <td><?= round($lv["issys"] / $lv["talkall"] * 100) ?>%</td>
            <td bgcolor="#eeeeee">下单成本</td>
            <td><?= round($lv["DataCount"]["allfmoney"] / $lv["issys"], 2) ?>元/人</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td bgcolor="#eeeeee">到诊量</td>
            <td><?= $lv["isfrom"] ?></td>
            <td bgcolor="#eeeeee">到诊率</td>
            <td><?= round($lv["isfrom"] / $lv["talkall"] * 100, 2) ?>%</td>
            <td bgcolor="#eeeeee">到诊成本</td>
            <td><?= round($lv["DataCount"]["allfmoney"] / $lv["isfrom"], 2) ?>元/人</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td bgcolor="#eeeeee">成交量</td>
            <td><?= $lv["isok"] ?></td>
            <td bgcolor="#eeeeee">成交率</td>
            <td><?= round($lv["isok"] / $lv["isfrom"] * 100, 2) ?>%</td>
            <td bgcolor="#eeeeee">成交成本</td>
            <td><?= round($lv["DataCount"]["allfmoney"] / $lv["isok"], 2) ?>元/人</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th height="35">日期</th>
            <th>渠道类型</th>
            <th>资金投入</th>
            <th>手机投入</th>
            <th>PC投入</th>
            <th>展现量</th>
            <th>点击次数</th>
            <th>点击价格</th>
            <th>点击率</th>
        </tr>
        <?
        foreach ($lv["DataList"]["select"] as $dk => $dv) {
            if (!empty($dv["fclass"])) {
                ?>
                <tr>
                    <td style="height:32px; padding-bottom:0px; padding-top:0px;"><?= timetodate($lv["fdate"], true) ?></td>
                    <td><?= $YumDamDataClass[$dv["fclass"]] ?></td>
                    <td><?= $dv["fmoney"] ?></td>
                    <td><?= $dv["wapmoney"] ?></td>
                    <td><?= $dv["fmoney"] - $dv["wapmoney"] ?></td>
                    <td><?= $dv["fshow"] ?></td>
                    <td><?= $dv["fclick"] ?></td>
                    <td><?= round($dv["fmoney"] / $dv["fclick"], 2) ?></td>
                    <td><?= round($dv["fclick"] / $dv["fshow"] * 100, 2) ?>%</td>
                </tr>
                <?
            } else if (!empty($dv["MyDay"])) {
                ?>
                <tr>
                    <td>小计</td>
                    <td><?= $YumDamDataClass[$dv["fclass"]] ?></td>
                    <td><?= $dv["fmoney"] ?></td>
                    <td><?= $dv["wapmoney"] ?></td>
                    <td><?= $dv["fmoney"] - $dv["wapmoney"] ?></td>
                    <td><?= $dv["fshow"] ?></td>
                    <td><?= $dv["fclick"] ?></td>
                    <td><?= round($dv["fmoney"] / $dv["fclick"], 2) ?></td>
                    <td><?= round($dv["fclick"] / $dv["fshow"] * 100, 2) ?>%</td>
                </tr>
                <tr>
                    <td colspan="9" style="height:2px; padding:0px; font-size:0px;" bgcolor="#791d77">&nbsp;</td>
                </tr>
                <?
            }
        }
        ?>
        <?
    }
    ?>
</table>