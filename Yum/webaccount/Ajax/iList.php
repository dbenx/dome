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

$mt1 = '#_@indata';
#$mt3='#_@datalist';

$ListSRes = $YumDamSql->selectsql("SELECT $mt1.`Id`,sum($mt1.`talkall`) as `talkall`,sum($mt1.`talkwap`) as `talkwap`,sum($mt1.`yestalk`) as `yestalk`,sum($mt1.`retalk1`) as `retalk1`,sum($mt1.`retalk2`) as `retalk2`,sum($mt1.`notalk`) as `notalk`,sum($mt1.`issys`) as `issys`,sum($mt1.`isfrom`) as `isfrom`,sum($mt1.`isok`) as `isok`,sum($mt1.`webip`) as `webip`,sum($mt1.`bqq`) as `bqq` FROM  $mt1 where $mt1.`fdate` " . YumDamDay($date1, $date2) . " group by $mt1.`Id` WITH ROLLUP");


?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <th height="35">日期</th>
        <th>商务通对话</th>
        <th>手机对话</th>
        <th>PC对话</th>
        <th>网咨有效对话</th>
        <th>到院重复对话</th>
        <th>未到院重复对话</th>
        <th>行政无效对话</th>
        <th>下单人数</th>
        <th>到诊人数</th>
        <th>成交人数</th>
        <th>网站访问量（UV）</th>
        <th>企业QQ对话</th>
        <th>操作</th>
    </tr>
    <?
    foreach ($ListSRes["select"] as $k => $v) {
        if (!empty($v["Id"])) {
            ?>
            <tr>
                <td><?= timetodate($v["fdate"], true) ?></td>
                <td><?= $v["talkall"] ?></td>
                <td><?= $v["talkwap"] ?></td>
                <td><?= $v["talkall"] - $v["talkwap"] ?></td>
                <td><?= $v["yestalk"] ?></td>
                <td><?= $v["retalk1"] ?></td>
                <td><?= $v["retalk2"] ?></td>
                <td><?= $v["notalk"] ?></td>
                <td><?= $v["issys"] ?></td>
                <td><?= $v["isfrom"] ?></td>
                <td><?= $v["isok"] ?></td>
                <td><?= $v["webip"] ?></td>
                <td><?= $v["bqq"] ?></td>
                <td>修改|删除</td>
            </tr>
            <?
        } else {
            ?>
            <tr>
                <td>合计</td>
                <td><?= $v["talkall"] ?></td>
                <td><?= $v["talkwap"] ?></td>
                <td><?= $v["talkall"] - $v["talkwap"] ?></td>
                <td><?= $v["yestalk"] ?></td>
                <td><?= $v["retalk1"] ?></td>
                <td><?= $v["retalk2"] ?></td>
                <td><?= $v["notalk"] ?></td>
                <td><?= $v["issys"] ?></td>
                <td><?= $v["isfrom"] ?></td>
                <td><?= $v["isok"] ?></td>
                <td><?= $v["webip"] ?></td>
                <td><?= $v["bqq"] ?></td>
                <td>&nbsp;</td>
            </tr>
            <?
        }
    }
    ?>
</table>