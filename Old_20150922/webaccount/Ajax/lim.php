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

#exit("敬请期待！");
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


$mt1 = '#_@formclass';
$mt2 = '#_@formdata';
$mt4 = '#_@dataclass';

$where = " $mt4.`Id`=$mt2.`fdate` and $mt2.`fclass`=$mt1.`Id` and $mt4.`selecttime` between " . $date1 . " and " . $date2;
#$order=" order by $mt4.`Id` desc,$mt4.`selecttime` desc";
$ListSRes = $YumDamSql->selectsql("SELECT $mt4.`Id`,$mt4.`selecttime`,$mt1.`cname`,count($mt2.`fdate`) as `scount`,$mt2.`fdate`,sum($mt2.`fmoney`) as `fmoney`,sum($mt2.`wapmoney`) as `wapmoney`,sum($mt2.`fclick`) as `fclick`,sum($mt2.`fshow`) as `fshow` FROM  $mt4,$mt2,$mt1 where " . $where . " group by $mt2.`fdate` WITH ROLLUP");
if (!is_array($ListSRes["select"])) {
    $ListSRes["select"] = array();
}
$DataList = $ListSRes["select"];
#print_r($DataList);

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <th height="30">编号</th>
        <th>日期</th>
        <th>账户类型</th>
        <th>资金投入</th>
        <th>手机投入</th>
        <th>PC投入</th>
        <th>点击次数</th>
        <th>点击价格</th>
        <th>展现量</th>
    </tr>
    <?
    foreach ($DataList as $k => $v) {
        $i++;
        $bcolor = ($i % 2) == 1 ? " bgcolor=\"#CAE8F2\"" : "";
        if (empty($v["fdate"])) {
            ?>
            <tr<?= $bcolor ?>>
                <td colspan="2" align="center"><strong>总计</strong></td>
                <td align="center">当日投入</td>
                <td align="center"><?= $v["fmoney"] ?>元</td>
                <td align="center"><?= $v["wapmoney"] ?>元</td>
                <td align="center"><?= $v["fmoney"] - $v["wapmoney"] ?>元</td>
                <td align="center"><?= $v["fclick"] ?>次</td>
                <td align="center"><?= round($v["fmoney"] / $v["fclick"], 2) ?>元/次</td>
                <td align="center"><?= $v["fshow"] ?>次</td>
            </tr>
            <?
        } else {

            ?>

            <tr<?= $bcolor ?>>
                <td align="center"><?= $i ?></td>
                <td align="center"><?= timetodate($v["selecttime"], true) ?></td>
                <td align="center">当日投入</td>
                <td align="center"><?= $v["fmoney"] ?>元</td>
                <td align="center"><?= $v["wapmoney"] ?>元</td>
                <td align="center"><?= $v["fmoney"] - $v["wapmoney"] ?>元</td>
                <td align="center"><?= $v["fclick"] ?>次</td>
                <td align="center"><?= round($v["fmoney"] / $v["fclick"], 2) ?>元/次</td>
                <td align="center"><?= $v["fshow"] ?>次</td>
            </tr>
            <?
        }
    }
    ?>
</table>