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


$mt4 = '#_@classitem';
$mt5 = '#_@itemcont';

#$mt3='#_@datalist';


$ListSRes = $YumDamSql->selectsql("SELECT $mt5.`Id`,$mt5.`fdate`,sum($mt5.`ITk`) as `ITk`,sum($mt5.`IIs`) as `IIs`,sum($mt5.`IIf`) as `IIf`,sum($mt5.`IIo`) as `IIo`,sum($mt5.`IIm`) as `IIm`,$mt4.`iname` FROM  $mt5 left join $mt4 on $mt5.`IId`=$mt4.`Id` where $mt5.`fdate` " . YumDamDay($date1, $date2) . " group by $mt5.`fdate`,$mt5.`Id` WITH ROLLUP");


#print_r($ListSRes["select"]);
#$DataShowList[]["DataList"]=$ListSRes2;
#print_r($DataShowList);

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <th style="height:35px;">日期</th>
        <th>项目名称</th>
        <th>咨询量</th>
        <th>消费金额</th>
        <th>咨询成本</th>
        <th>下单量</th>
        <th>下单率</th>
        <th>下单成本</th>
        <th>到诊量</th>
        <th>到诊率</th>
        <th>到诊成本</th>
        <th>成交量</th>
        <th>成交率</th>
        <th>成交成本</th>
    </tr>
    <?
    foreach ($ListSRes["select"] as $lk => $lv) {
        if (!empty($lv["Id"])) {
            ?>
            <tr onmouseout="this.style.backgroundColor='#FFFFFF'" onmouseover="this.style.backgroundColor='#eeeeee'">
                <td><?= timetodate($lv["fdate"], true) ?></td>
                <td><?= $lv["iname"] ?></td>
                <td><?= $lv["ITk"] ?></td>
                <td><?= $lv["IIm"] ?></td>
                <td><?= round($lv["IIm"] / $lv["ITk"], 2) ?>元/人</td>
                <td><?= $lv["IIs"] ?></td>
                <td><?= round($lv["IIs"] / $lv["ITk"] * 100, 2) ?>%</td>
                <td><?= round($lv["IIm"] / $lv["IIs"], 2) ?>元/人</td>
                <td><?= $lv["IIf"] ?></td>
                <td><?= round($lv["IIf"] / $lv["ITk"] * 100, 2) ?>%</td>
                <td><?= round($lv["IIm"] / $lv["IIf"], 2) ?>元/人</td>
                <td><?= $lv["IIo"] ?></td>
                <td><?= round($lv["IIo"] / $lv["IIf"] * 100, 2) ?>%</td>
                <td><?= round($lv["IIm"] / $lv["IIo"], 2) ?>元/人</td>
            </tr>
            <?
        } elseif (empty($lv["Id"]) && !empty($lv["fdate"])) {
            ?>
            <tr>
                <td colspan="2"><strong>小计</strong></td>
                <td><?= $lv["ITk"] ?></td>
                <td><?= $lv["IIm"] ?></td>
                <td><?= round($lv["IIm"] / $lv["ITk"], 2) ?>元/人</td>
                <td><?= $lv["IIs"] ?></td>
                <td><?= round($lv["IIs"] / $lv["ITk"] * 100, 2) ?>%</td>
                <td><?= round($lv["IIm"] / $lv["IIs"], 2) ?>元/人</td>
                <td><?= $lv["IIf"] ?></td>
                <td><?= round($lv["IIf"] / $lv["ITk"] * 100, 2) ?>%</td>
                <td><?= round($lv["IIm"] / $lv["IIf"], 2) ?>元/人</td>
                <td><?= $lv["IIo"] ?></td>
                <td><?= round($lv["IIo"] / $lv["IIf"] * 100, 2) ?>%</td>
                <td><?= round($lv["IIm"] / $lv["IIo"], 2) ?>元/人</td>
            </tr>
            <?
        } else {
            ?>
            <tr>
                <td colspan="2"><strong>总计</strong></td>
                <td><?= $lv["ITk"] ?></td>
                <td><?= $lv["IIm"] ?></td>
                <td><?= round($lv["IIm"] / $lv["ITk"], 2) ?>元/人</td>
                <td><?= $lv["IIs"] ?></td>
                <td><?= round($lv["IIs"] / $lv["ITk"] * 100, 2) ?>%</td>
                <td><?= round($lv["IIm"] / $lv["IIs"], 2) ?>元/人</td>
                <td><?= $lv["IIf"] ?></td>
                <td><?= round($lv["IIf"] / $lv["ITk"] * 100, 2) ?>%</td>
                <td><?= round($lv["IIm"] / $lv["IIf"], 2) ?>元/人</td>
                <td><?= $lv["IIo"] ?></td>
                <td><?= round($lv["IIo"] / $lv["IIf"] * 100, 2) ?>%</td>
                <td><?= round($lv["IIm"] / $lv["IIo"], 2) ?>元/人</td>
            </tr>
            <?
        }
    }
    ?>
</table>