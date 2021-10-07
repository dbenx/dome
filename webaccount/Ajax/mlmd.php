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


#$date1=strtotime($date1."-01 00:00:00");###月第一天0时
#$date2=strtotime(date('Y-m-01 23:59:59',strtotime($date2)) . ' +1 month -1 day');###月最后一天23日

#$date1=returndatetime($date1);
#$date2=returndatetime($date2,"max");
@setcookie("vd1", $date1, time() + 3600, "/");
@setcookie("vd2", $date2, time() + 3600, "/");

$mt1 = '#_@indata';
$mt2 = '#_@indata2';
#$mt3='#_@datalist';


#echo $date1.$date2;
$ListSRes = $YumDamSql->selectsql("SELECT $mt2.`Id`,$mt2.`fclass`,FROM_UNIXTIME($mt2.`fdate`,'%Y-%m-%d') as `MyDay`,sum($mt2.`fmoney`) as `fmoney`,sum($mt2.`wapmoney`) as `wapmoney`,sum($mt2.`fclick`) as `fclick`,sum($mt2.`fshow`) as `fshow` FROM  $mt2 where $mt2.`fdate`" . YumDamDay($date1, $date2) . " group by `MyDay` WITH ROLLUP");
#print_r($ListSRes);exit;
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <th height="35" colspan="9">基本情况</th>
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
    foreach ($ListSRes["select"] as $dk => $dv) {
        ?>

        <?
        if (!empty($dv["MyDay"])) {
            ?>
            <tr onmouseout="this.style.backgroundColor='#FFFFFF'" onmouseover="this.style.backgroundColor='#eeeeee'">
                <td><?= $dv["MyDay"] ?></td>
                <td>全账户</td>
                <td><?= $dv["fmoney"] ?></td>
                <td><?= $dv["wapmoney"] ?></td>
                <td><?= $dv["fmoney"] - $dv["wapmoney"] ?></td>
                <td><?= $dv["fshow"] ?></td>
                <td><?= $dv["fclick"] ?></td>
                <td><?= round($dv["fmoney"] / $dv["fclick"], 2) ?></td>
                <td><?= round($dv["fclick"] / $dv["fshow"] * 100, 2) ?>%</td>
            </tr>
            <?
        } else {
            ?>
            <tr>
                <td>合计</td>
                <td>&nbsp;</td>
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
</table>