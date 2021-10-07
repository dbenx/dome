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
#echo "Er:005";
#exit;
}

$date1 = $_GET["d1"];
$date2 = $_GET["d2"];
$myaction = decode($_GET["action"]);


if ($myaction != "list") {
    echo time() . "<br>出错!";
    exit;
}


$date1 = strtotime($date1 . "-01 00:00:00");###月第一天0时
$date2 = strtotime(date('Y-m-01 23:59:59', strtotime($date2)) . ' +1 month -1 day');###月最后一天23日


@setcookie("mvd1", $date1, time() + 3600, "/");
@setcookie("mvd2", $date2, time() + 3600, "/");


$mt2 = '#_@formdata';
$mt3 = '#_@formdata3';
$mt4 = '#_@dataclass';
$mt5 = '#_@itemclass';
$mt6 = '#_@formdata2';

###################################################################################################################################
$ListItemShowMonthWhere = "  and $mt4.`selecttime` between " . $date1 . " and " . $date2 . " group by `MyMonth` order by `MyMonth` desc";
$ListItemShowMonthSql1 = " select FROM_UNIXTIME($mt4.`selecttime`,'%Y%m') as `MyMonth`,$mt4.`selecttime`,sum($mt3.`talkall`) as `talkall`,sum($mt3.`talkwap`) as `talkwap`,sum($mt3.`issys`) as `issys`,sum($mt3.`isfrom`) as `isfrom`,sum($mt3.`isok`) as `isok`,sum($mt3.`bqq`) as `bqq` from $mt3,$mt4 where $mt3.`fdate`=$mt4.`Id`" . $ListItemShowMonthWhere;
$ListItemShowMonth1 = $YumDamSql->selectsql($ListItemShowMonthSql1);
$ListItemShowMonthSql2 = " select FROM_UNIXTIME($mt4.`selecttime`,'%Y%m') as `MyMonth`,sum($mt2.`fmoney`) as `fmoney`,sum($mt2.`fclick`) as `fclick` from $mt4,$mt2 where $mt2.`fdate`=$mt4.`Id`" . $ListItemShowMonthWhere;
$ListItemShowMonth2 = $YumDamSql->selectsql($ListItemShowMonthSql2);

$ListItemShowMonthC = array();
foreach ($ListItemShowMonth1["select"] as $k => $v) {
    $v = array_merge($v, $ListItemShowMonth2["select"][$k]);
    $ListItemShowMonthC[] = $v;
}

$ListItemShowMonth = $ListItemShowMonthC;

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <th height="35">&nbsp;</th>
        <th>月份</th>
        <th>月消费</th>
        <th>月点击</th>
        <th>点击成本</th>
        <th>月对话 | 手机</th>
        <th>对话成本</th>
        <th>月下单</th>
        <th>下单成本</th>
        <th>下单率</th>
        <th>月到诊</th>
        <th>到诊成本</th>
        <th>到院率</th>
        <th>月成交</th>
        <th>成交成本</th>
        <th>成交率</th>
    </tr>
    <?
    foreach ($ListItemShowMonth as $k => $v) {
        $i++;
        ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= date("Y年m月", $v["selecttime"]) ?></td>
            <td><?= $v["fmoney"] ?>元</td>
            <td><?= $v["fclick"] ?>次</td>
            <td><?= round($v["fmoney"] / $v["fclick"], 2) ?>元/次</td>
            <td><?= ($v["talkall"] + $v["bqq"]) . "人 | " . $v["talkwap"] ?>人</td>
            <td><?= TalkDataColor(round($v["fmoney"] / ($v["talkall"] + $v["bqq"]), 2), 200) ?>元/人</td>
            <td><?= $v["issys"] ?>人</td>
            <td><?= round($v["fmoney"] / $v["issys"], 2) ?>人/元</td>
            <td><?= PercentDataColor(round($v["issys"] / ($v["talkall"] + $v["bqq"]) * 100, 2), 45.17) ?></td>
            <td><?= $v["isfrom"] ?>人</td>
            <td><?= round($v["fmoney"] / $v["isfrom"], 2) ?>人/元</td>
            <td><?= PercentDataColor(round($v["isfrom"] / ($v["talkall"] + $v["bqq"]) * 100, 2), 12) ?></td>
            <td><?= $v["isok"] ?>人</td>
            <td><?= round($v["fmoney"] / $v["isok"], 2) ?>元/人</td>
            <td><?= PercentDataColor(round($v["isok"] / $v["isfrom"] * 100, 2), 63) ?></td>
        </tr>
        <?
    }
    ?>
</table>