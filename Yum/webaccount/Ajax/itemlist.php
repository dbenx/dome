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

$mt3 = '#_@dataclass';
$mt4 = '#_@itemcont';
$mt5 = '#_@itemclass';
#$mt3='#_@datalist';

$ListSRes3 = $YumDamSql->selectsql("SELECT $mt4.`Id`,$mt4.`fdate`,$mt3.`cname`,$mt5.`iname`,sum($mt4.`IId`) as `IId`,sum($mt4.`IIm`) as `IIm`,sum($mt4.`IIsw`) as `IIsw`,sum($mt4.`IIc`) as `IIc`,sum($mt4.`ITk`) as `ITk`,sum($mt4.`IIs`) as `IIs`,sum($mt4.`IIf`) as `IIf`,sum($mt4.`IIo`) as `IIo`,sum($mt4.`IIin`) as `IIin` FROM  $mt3,$mt4,$mt5 where $mt4.`IId`=$mt5.`Id` and $mt4.`fclass`=$mt3.`Id` and $mt4.`fdate` " . YumDamDay($date1, $date2) . " group by $mt4.`fdate`,$mt4.`Id` WITH ROLLUP");

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>日期</td>
        <td>渠道</td>
        <td>项目</td>
        <td>投入</td>
        <td>展现量</td>
        <td>点击</td>
        <td>咨询量</td>
        <td>下单量</td>
        <td>到诊量</td>
        <td>成交量</td>
        <td>成交金额</td>
    </tr>
    <?
    foreach ($ListSRes3["select"] as $k => $v) {
        if (!empty($v["Id"]) && !empty($v["fdate"])) {
            ?>
            <tr>
                <td><?= timetodate($v["fdate"], true) ?></td>
                <td><?= $v["cname"] ?></td>
                <td><?= $v["iname"] ?></td>
                <td><?= $v["IIm"] ?></td>
                <td><?= $v["IIsw"] ?></td>
                <td><?= $v["IIc"] ?></td>
                <td><?= $v["ITk"] ?></td>
                <td><?= $v["IIs"] ?></td>
                <td><?= $v["IIf"] ?></td>
                <td><?= $v["IIo"] ?></td>
                <td><?= $v["IIin"] ?></td>
            </tr>
            <?
        }
        if (empty($v["Id"]) && !empty($v["fdate"])) {
            ?>
            <tr>
                <td colspan="3">小计</td>
                <td><?= $v["IIm"] ?></td>
                <td><?= $v["IIsw"] ?></td>
                <td><?= $v["IIc"] ?></td>
                <td><?= $v["ITk"] ?></td>
                <td><?= $v["IIs"] ?></td>
                <td><?= $v["IIf"] ?></td>
                <td><?= $v["IIo"] ?></td>
                <td><?= $v["IIin"] ?></td>
            </tr>
            <?
        }
        if (empty($v["Id"]) && empty($v["fdate"])) {
            ?>
            <tr>
                <td colspan="3">合计</td>
                <td><?= $v["IIm"] ?></td>
                <td><?= $v["IIsw"] ?></td>
                <td><?= $v["IIc"] ?></td>
                <td><?= $v["ITk"] ?></td>
                <td><?= $v["IIs"] ?></td>
                <td><?= $v["IIf"] ?></td>
                <td><?= $v["IIo"] ?></td>
                <td><?= $v["IIin"] ?></td>
            </tr>
            <?
        }
    }
    ?>
</table>