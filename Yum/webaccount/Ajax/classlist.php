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

$mt2 = '#_@indata2';
$mt3 = '#_@dataclass';
#$mt3='#_@datalist';

$ListSRes2 = $YumDamSql->selectsql("SELECT $mt2.`Id`,$mt2.`fdate`,$mt3.`cname`,sum($mt2.`fmoney`) as `fmoney`,sum($mt2.`wapmoney`) as `wapmoney`,sum($mt2.`fshow`) as `fshow`,sum($mt2.`wapshow`) as `wapshow`,sum($mt2.`fclick`) as `fclick`,sum($mt2.`wapclick`) as `wapclick`,sum($mt2.`ftalk`) as `ftalk`,sum($mt2.`waptalk`) as `waptalk`,sum($mt2.`hmoney`) as `hmoney`,sum($mt2.`bmoney`) as `bmoney` FROM  $mt2 left join $mt3 on $mt2.`fclass`=$mt3.`Id` where $mt2.`fdate` " . YumDamDay($date1, $date2) . " group by $mt2.`fdate`,$mt2.`Id` WITH ROLLUP");

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>日期</td>
        <td>渠道</td>
        <td>投入</td>
        <td>手机投入</td>
        <td>PC投入</td>
        <td>展现量</td>
        <td>手机展现</td>
        <td>PC展现</td>
        <td>点击量</td>
        <td>手机点击</td>
        <td>PC点击</td>
        <td>对话量</td>
        <td>手机对话</td>
        <td>PC对话</td>
        <td>行业消费</td>
        <td>品牌消费</td>
    </tr>
    <?
    foreach ($ListSRes2["select"] as $k => $v) {
        if (!empty($v["Id"]) && !empty($v["fdate"])) {
            ?>
            <tr>
                <td><?= timetodate($v["fdate"], true) ?></td>
                <td><?= $v["cname"] ?></td>
                <td><?= $v["fmoney"] ?></td>
                <td><?= $v["wapmoney"] ?></td>
                <td><?= $v["fmoney"] - $v["wapmoney"] ?></td>
                <td><?= $v["fshow"] ?></td>
                <td><?= $v["wapshow"] ?></td>
                <td><?= $v["fshow"] - $v["wapshow"] ?></td>
                <td><?= $v["fclick"] ?></td>
                <td><?= $v["wapclick"] ?></td>
                <td><?= $v["fclick"] - $v["wapclick"] ?></td>
                <td><?= $v["ftalk"] ?></td>
                <td><?= $v["waptalk"] ?></td>
                <td><?= $v["ftalk"] - $v["waptalk"] ?></td>
                <td><?= $v["hmoney"] ?></td>
                <td><?= $v["bmoney"] ?></td>
            </tr>
            <?
        }
        if (empty($v["Id"]) && !empty($v["fdate"])) {
            ?>
            <tr>
                <td colspan="2">小计</td>
                <td><?= $v["fmoney"] ?></td>
                <td><?= $v["wapmoney"] ?></td>
                <td><?= $v["fmoney"] - $v["wapmoney"] ?></td>
                <td><?= $v["fshow"] ?></td>
                <td><?= $v["wapshow"] ?></td>
                <td><?= $v["fshow"] - $v["wapshow"] ?></td>
                <td><?= $v["fclick"] ?></td>
                <td><?= $v["wapclick"] ?></td>
                <td><?= $v["fclick"] - $v["wapclick"] ?></td>
                <td><?= $v["ftalk"] ?></td>
                <td><?= $v["waptalk"] ?></td>
                <td><?= $v["ftalk"] - $v["waptalk"] ?></td>
                <td><?= $v["hmoney"] ?></td>
                <td><?= $v["bmoney"] ?></td>
            </tr>
            <?
        }
        if (empty($v["Id"]) && empty($v["fdate"])) {
            ?>
            <tr>
                <td colspan="2">合计</td>
                <td><?= $v["fmoney"] ?></td>
                <td><?= $v["wapmoney"] ?></td>
                <td><?= $v["fmoney"] - $v["wapmoney"] ?></td>
                <td><?= $v["fshow"] ?></td>
                <td><?= $v["wapshow"] ?></td>
                <td><?= $v["fshow"] - $v["wapshow"] ?></td>
                <td><?= $v["fclick"] ?></td>
                <td><?= $v["wapclick"] ?></td>
                <td><?= $v["fclick"] - $v["wapclick"] ?></td>
                <td><?= $v["ftalk"] ?></td>
                <td><?= $v["waptalk"] ?></td>
                <td><?= $v["ftalk"] - $v["waptalk"] ?></td>
                <td><?= $v["hmoney"] ?></td>
                <td><?= $v["bmoney"] ?></td>
            </tr>
            <?
        }
    }
    ?>
</table>