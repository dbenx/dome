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


$mt6 = '#_@fw';
#$mt3='#_@datalist';


$ListSRes = $YumDamSql->selectsql("SELECT $mt6.`Id`,$mt6.`fdate`,sum($mt6.`bdjj`) as `bdjj`,sum($mt6.`bdjk`) as `bdjk`,sum($mt6.`bdwm`) as `bdwm`,sum($mt6.`hsjj`) as `hsjj`,sum($mt6.`sgjj`) as `sgjj`,sum($mt6.`wx`) as `wx`,sum($mt6.`mh`) as `mh`,sum($mt6.`nf`) as `nf` FROM  $mt6 where $mt6.`fdate` " . YumDamDay($date1, $date2) . " group by $mt6.`Id` WITH ROLLUP");


?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <th height="35" colspan="9">信息来源基本情况</th>
    </tr>
    <tr>
        <th height="35">日期</th>
        <th bgcolor="#eeeeee">百度竞价</th>
        <th>百度健康</th>
        <th bgcolor="#eeeeee">百度网盟</th>
        <th>360搜索</th>
        <th bgcolor="#eeeeee">Sogou搜索</th>
        <th>微信</th>
        <th bgcolor="#eeeeee">门户</th>
        <th>未知来源</th>
    </tr>
    <?
    foreach ($ListSRes["select"] as $dk => $dv) {
        ?>
        <?
        if (!empty($dv["Id"])) {
            ?>
            <tr>
                <td><?= timetodate($dv["fdate"], true) ?></td>
                <td bgcolor="#eeeeee"><?= $dv["bdjj"] ?></td>
                <td><?= $dv["bdjk"] ?></td>
                <td bgcolor="#eeeeee"><?= $dv["bdwm"] ?></td>
                <td><?= $dv["hsjj"] ?></td>
                <td bgcolor="#eeeeee"><?= $dv["sgjj"] ?></td>
                <td><?= $dv["wx"] ?></td>
                <td bgcolor="#eeeeee"><?= $dv["mh"] ?></td>
                <td><?= $dv["nf"] ?></td>
            </tr>
            <tr>
                <td colspan="9" style="height:1px; padding:0px; font-size:0px;" bgcolor="#791d77">&nbsp;</td>
            </tr>
            <?
        } else {
            ?>
            <tr>
                <td>合计</td>
                <td bgcolor="#eeeeee"><?= $dv["bdjj"] ?></td>
                <td><?= $dv["bdjk"] ?></td>
                <td bgcolor="#eeeeee"><?= $dv["bdwm"] ?></td>
                <td><?= $dv["hsjj"] ?></td>
                <td bgcolor="#eeeeee"><?= $dv["sgjj"] ?></td>
                <td><?= $dv["wx"] ?></td>
                <td bgcolor="#eeeeee"><?= $dv["mh"] ?></td>
                <td><?= $dv["nf"] ?></td>
            </tr>
            <?
        }
    }
    ?>
</table>