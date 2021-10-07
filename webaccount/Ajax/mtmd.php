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
#$mt3='#_@datalist';


#echo $date1.$date2;
$ListSRes = $YumDamSql->selectsql("SELECT $mt1.`Id`,$mt1.`fdate`,sum($mt1.`talkall`) as `talkall`,sum($mt1.`yestalk`) as `yestalk`,sum($mt1.`talkwap`) as `talkwap`,sum($mt1.`retalk1`) as `retalk1`,sum($mt1.`notalk`) as `notalk`,sum($mt1.`issys`) as `issys`,sum($mt1.`isfrom`) as `isfrom`,sum($mt1.`isok`) as `isok` FROM  $mt1 where $mt1.`fdate`" . YumDamDay($date1, $date2) . " group by $mt1.`Id` WITH ROLLUP");
#print_r($ListSRes);exit;
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <th height="35" colspan="8">基本情况</th>
    </tr>
    <tr>
        <th height="35">日期</th>
        <th>总对话|手机</th>
        <th>有效对话</th>
        <th>网电有效</th>
        <th>到院重复</th>
        <th>下单</th>
        <th>到院</th>
        <th>成交</th>
    </tr>
    <?
    foreach ($ListSRes["select"] as $dk => $dv) {
        ?>

        <?
        if (!empty($dv["Id"])) {
            ?>
            <tr onmouseout="this.style.backgroundColor='#FFFFFF'" onmouseover="this.style.backgroundColor='#eeeeee'">
                <td><?= timetodate($dv["fdate"], true) ?></td>
                <td><?= $dv["talkall"] ?>|<?= $dv["talkwap"] ?></td>
                <td><?= $dv["talkall"] - $dv["notalk"] ?></td>
                <td><?= $dv["yestalk"] ?></td>
                <td><?= $dv["retalk1"] ?></td>
                <td><?= $dv["issys"] ?></td>
                <td><?= $dv["isfrom"] ?></td>
                <td><?= $dv["isok"] ?></td>
            </tr>
            <?
        } else {
            ?>
            <tr>
                <td>合计</td>
                <td><?= $dv["talkall"] ?>|<?= $dv["talkwap"] ?></td>
                <td><?= $dv["talkall"] - $dv["notalk"] ?></td>
                <td><?= $dv["yestalk"] ?></td>
                <td><?= $dv["retalk1"] ?></td>
                <td><?= $dv["issys"] ?></td>
                <td><?= $dv["isfrom"] ?></td>
                <td><?= $dv["isok"] ?></td>
            </tr>
            <tr>
                <td colspan="8" style="height:2px; padding:0px; font-size:0px;" bgcolor="#791d77">&nbsp;</td>
            </tr>
            <?
        }
    }
    ?>
</table>