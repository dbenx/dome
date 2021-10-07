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

if ($YumDamGId != "1") {
    YumDamShowMsgExit("抱歉,您未获得此权限！", "./");
    exit;
}

$date1 = $_GET["d1"];
$date2 = $_GET["d2"];
$myaction = decode($_GET["action"]);

if ($myaction != "list") {
    echo time() . "<br>出错!";
    exit;
}

$date1 = returndatetime($date1);
$date2 = returndatetime($date2, "max");
if ($date1 > $date2) {
    echo "日期选择错误，请重新选择！";
    exit;
}
@setcookie("vd1", $date1, time() + 3600, "/");
@setcookie("vd2", $date2, time() + 3600, "/");


$mt1 = '#_@tempmobilenumber';


###################################################################################################################################
###################################################################################################################################
$ItemList = $YumDamSql->selectsql("SELECT * FROM  $mt1 order by $mt1.`myvdate` desc");

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" height="40">以下共有 <strong><?= $ItemList["row"] ?></strong> 条数据！确认无误后导入正式数据！<a
                    href="<?= "indata.php?mi=" . ecode($date1) . "&me=" . ecode($date2) . "&at=" . encode("ts") ?>"><strong>点此导入</strong></a>
            |
            <a href="<?= "indata.php?mi=" . ecode($date1) . "&me=" . ecode($date2) . "&at=" . encode("tr") ?>"><strong>清空临时数据</strong></a>
        </td>
    </tr>
</table>
<?
if ($ItemList["row"] == 0) {
    exit;
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr bgcolor="#A2E4EE">
        <th height="40">编号</th>
        <th>号码</th>
        <th>搜索词</th>
        <th>设备</th>
        <th>访问日期</th>
        <th>导入日期</th>
    </tr>
    <?
    foreach ($ItemList["select"] as $k => $v) {
        $i++;
        ?>
        <tr>
            <td align="center"><?= $i ?></td>
            <td align="center"><?= $v["mytelcode"] ?></td>
            <td><strong><a href="<?= $v["nowurl"] ?>" target="_blank"><?= $v["seachkey"] ?>[<?= $v["fromsource"] ?>]</a></strong>
            </td>
            <td><?= $v["hardm"] ?></td>
            <td align="center"><?= timetodate($v["myvdate"]) ?></td>
            <td align="center"><?= timetodate($v["indatadate"], true) ?></td>
        </tr>
        <?
    }
    ?>
</table>