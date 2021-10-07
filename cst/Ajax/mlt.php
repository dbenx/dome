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
$mt = "#_@cstcont";
$mt2 = '#_@classitem';

if ($YumDamGId != "1" && $YumDamGId != "4") {
    $where = " and $mt.`uid`='" . $YumDamSId . "'";
}


$ListSRes = $YumDamSql->selectsql("SELECT $mt.`Id`,$mt.`fdate`,$mt.`uid`,$mt.`itemid`,sum($mt.`itemtk`) as `itemtk`,sum($mt.`itemytk`) as `itemytk`,sum($mt.`itemsys`) as `itemsys`,sum($mt.`itemfr`) as `itemfr`,sum($mt.`itemok`) as `itemok`,sum($mt.`itemokm`) as `itemokm`,$mt2.`iname` FROM  $mt left join $mt2 on $mt.`itemid`=$mt2.`Id` where $mt.`fdate` " . YumDamDay($date1, $date2) . $where . " group by $mt.`itemid`,$mt.`fdate` WITH ROLLUP");
#exit;
$DataShowList = $ListSRes["select"];


##########################################以上为指定日期正式用户数据############################################################
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <th height="35">编号</th>
        <th>日期</th>
        <th>项目</th>
        <th>咨询量</th>
        <th>有效量</th>
        <th>有效率</th>
        <th>下单量</th>
        <th>下单率</th>
        <th>到诊量</th>
        <th>到诊率</th>
        <th>成交量</th>
        <th>成交率</th>
        <th>成交金额</th>
    </tr>
    <?
    foreach ($DataShowList as $k => $v) {
        if (!empty($v["fdate"]) && !empty($v["itemid"])) {
            $i++;
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= timetodate($v["fdate"], true) ?></td>
                <td><?= $v["iname"] ?></td>
                <td><?= $v["itemtk"] ?></td>
                <td><?= $v["itemytk"] ?></td>
                <td><?= round($v["itemytk"] / $v["itemtk"] * 100, 2) ?>%</td>
                <td><?= $v["itemsys"] ?></td>
                <td><?= round($v["itemsys"] / $v["itemtk"] * 100, 2) ?>%</td>
                <td><?= $v["itemfr"] ?></td>
                <td><?= round($v["itemfr"] / $v["itemtk"] * 100, 2) ?>%</td>
                <td><?= $v["itemok"] ?></td>
                <td><?= round($v["itemok"] / $v["itemfr"] * 100, 2) ?>%</td>
                <td><?= $v["itemokm"] ?></td>
            </tr>
            <?
        } elseif (!empty($v["itemid"]) && empty($v["fdate"])) {
            ?>
            <tr>
                <td colspan="3">小计</td>
                <td><?= $v["itemtk"] ?></td>
                <td><?= $v["itemytk"] ?></td>
                <td><?= round($v["itemytk"] / $v["itemtk"] * 100, 2) ?>%</td>
                <td><?= $v["itemsys"] ?></td>
                <td><?= round($v["itemsys"] / $v["itemtk"] * 100, 2) ?>%</td>
                <td><?= $v["itemfr"] ?></td>
                <td><?= round($v["itemfr"] / $v["itemtk"] * 100, 2) ?>%</td>
                <td><?= $v["itemok"] ?></td>
                <td><?= round($v["itemok"] / $v["itemfr"] * 100, 2) ?>%</td>
                <td><?= $v["itemokm"] ?></td>
            </tr>
            <?
        } else {
            ?>
            <tr>
                <td colspan="3">总计</td>
                <td><?= $v["itemtk"] ?></td>
                <td><?= $v["itemytk"] ?></td>
                <td><?= round($v["itemytk"] / $v["itemtk"] * 100, 2) ?>%</td>
                <td><?= $v["itemsys"] ?></td>
                <td><?= round($v["itemsys"] / $v["itemtk"] * 100, 2) ?>%</td>
                <td><?= $v["itemfr"] ?></td>
                <td><?= round($v["itemfr"] / $v["itemtk"] * 100, 2) ?>%</td>
                <td><?= $v["itemok"] ?></td>
                <td><?= round($v["itemok"] / $v["itemfr"] * 100, 2) ?>%</td>
                <td><?= $v["itemokm"] ?></td>
            </tr>
            <?
        }
    }
    ?>
</table>