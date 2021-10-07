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


$date1 = strtotime($date1 . "-01 00:00:00");###月第一天0时
$date2 = strtotime(date('Y-m-01 23:59:59', strtotime($date2)) . ' +1 month -1 day');###月最后一天23日


@setcookie("mvd1", $date1, time() + 3600, "/");
@setcookie("mvd2", $date2, time() + 3600, "/");


$mt1 = '#_@formclass';
$mt2 = '#_@formdata';
$mt3 = '#_@formdata3';
$mt4 = '#_@dataclass';
$mt5 = '#_@itemclass';
$mt6 = '#_@formdata2';

###################################################################################################################################
$ListItemShowMonthSql2 = " select $mt4.`Id`,FROM_UNIXTIME($mt4.`selecttime`,'%Y%m') as `MyMonth`,$mt4.`selecttime`,$mt4.`indate`,sum($mt2.`fmoney`) as `fmoney`,sum($mt2.`wapmoney`) as `wapmoney`,sum($mt2.`fclick`) as `fclick`,sum($mt2.`fshow`) as `fshow`,$mt1.`cname`,count($mt4.`selecttime`) as `c` FROM  $mt4,$mt2,$mt1 where $mt4.`Id`=$mt2.`fdate` and $mt2.`fclass`=$mt1.`Id` and $mt4.`selecttime` between " . $date1 . " and " . $date2 . " group by `MyMonth`,$mt2.`fclass` WITH ROLLUP limit 0,100";
$ListItemShowMonthMoney = $YumDamSql->selectsql($ListItemShowMonthSql2);
#print_r($ListItemShowMonthMoney);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <th height="35">&nbsp;</th>
        <th>月份</th>
        <th>账户类型</th>
        <th>总投入</th>
        <th>PC投入</th>
        <th>移动消费</th>
        <th>点击次数</th>
        <th>点击价格</th>
        <th>展现量</th>
    </tr>
    <?
    foreach ($ListItemShowMonthMoney["select"] as $k => $v) {
        $i++;
        ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= date("Y年m月", $v["selecttime"]) ?></td>
            <td><?= $v["cname"] ?></td>
            <td><?= $v["fmoney"] ?>元</td>
            <td><?= $v["fmoney"] - $v["wapmoney"] ?>元</td>
            <td><?= $v["wapmoney"] ?>元</td>
            <td><?= $v["fclick"]; ?>次</td>
            <td><?= round($v["fmoney"] / $v["fclick"], 2) ?>元/次</td>
            <td><?= $v["fshow"] ?>次</td>
        </tr>
        <?
    }
    ?>
</table>