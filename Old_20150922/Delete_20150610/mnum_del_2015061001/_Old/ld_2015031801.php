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
include("../Config/Config.Inc.php");####加载配置文件

if (!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) || strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) != "xmlhttprequest") {
    echo "Er:005";
    exit;
}

$date1 = $_GET["d1"];
$date2 = $_GET["d2"];


$is = $_GET["is"];###是否独占用户


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


$mt2 = '#_@mobilenumber';


###################################################################################################################################
###################################################################################################################################
if (decode($is) == "true") {
    $ismy = "";
    $ismycont = "&gt;&gt;点击查看全部顾客&lt;&lt;";
    $ismyl = "false";
} else {
    $ismy = "$mt2.`ismyid`=0 or";
    $ismycont = "&gt;&gt;点击查看我独有顾客&lt;&lt;";
    $ismyl = "true";
}

$MySql = "$mt2.`myvdate` between " . $date1 . " and " . $date2 . " and $mt2.`isstate` not in(1,6) and (" . $ismy . " `ismyid`='" . $YumDamSId . "') order by $mt2.`isstate` desc, myvdate asc";

$ItemListRow = $YumDamSql->selectsql("SELECT `Id` FROM  $mt2 where " . $MySql);


if ($YumDamGId == "1" || $YumDamGId == "3") {
    $limit = "";
} else {
    $limit = " limit 0,80";
}

$ItemList = $YumDamSql->selectsql("SELECT * FROM  $mt2 where " . $MySql . $limit);


function emptydata($data)
{
    if (empty($data) || $data == "NULL" || $data == "undefined") {
        $data = "未知";
    }
    return $data;
}


?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" height="40">以下是 <strong><?= timetodate($date1, true) ?>
                - <?= timetodate($date2, true) ?></strong> 的数据共有 <strong><?= $ItemListRow["row"] ?></strong> 条！ | <a
                    href="javascript:;"
                    onclick="_GoToLink('Ajax/ld.php?<?= $_SERVER["QUERY_STRING"] . "&is=" . encode($ismyl) . "&d=" . ecode(time()) ?>')"
                    class="B" target="_self"><?= $ismycont ?></a></td>
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
        <th>操作</th>
    </tr>
    <?
    foreach ($ItemList["select"] as $k => $v) {
        $i++;
        $ismyc = $v["ismyid"] == $YumDamSId ? "<font color=\"#008000\"> (独) </font>" : "";
        if ($v["msgdate"] != "0") {
            $ismsg = "<font color=\"#DAA520\"> (发) </font>";
        } else {
            if ($YumDamGId == "3" || $YumDamGId == "1") {
                $ismsg = " | <a href=\"javascript:;\" onclick=\"_GoToLink('Ajax/ms.php?action=" . encode("s") . "&d=" . ecode($v["Id"]) . "&t=" . encode($v["mytelcode"]) . "&d1=" . ecode($v["myvdate"]) . "&s=" . $v["isstate"] . "')\" target=\"_self\">&lt;&lt;点击发信息&gt;&gt;</a>";
            } else {
                $ismsg = "";
            }
        }
        ?>
        <tr onmouseout="this.style.backgroundColor='#FFFFFF'" onmouseover="this.style.backgroundColor='#A2E4EE'">
            <td align="center"><?= $i ?></td>
            <td width="240" align="center"><a href="javascript:;"
                                              onclick="_GoToLink('Ajax/sd.php?<?= $_SERVER["QUERY_STRING"] . "&d=" . ecode($v["Id"]) ?>')"
                                              target="_self"><?= $v["mytelcode"] ?></a>-<strong>[<?= YumDamMStatus($v["isstate"], $v["mdate"]) ?>
                    ]<?= $ismyc . $ismsg ?></strong></td>
            <td><a href="<?= emptydata($v["nowurl"]) ?>" target="_blank"
                   title="<?= emptydata($v["seachkey"]) ?>"><strong><?= emptydata($v["fromsource"]) . " : " . mbsubstr(emptydata($v["seachkey"])) ?></strong>[
                    查看访问页面]</a></td>
            <td><?= emptydata($v["hardm"]) ?></td>
            <td align="center"><?= timetodate($v["myvdate"]) ?></td>
            <td align="center"><?= timetodate($v["indatadate"], true) ?></td>
            <td title="点击查看后，该顾客就会分配给您！"><a href="javascript:;"
                                            onclick="_GoToLink('Ajax/sd.php?<?= $_SERVER["QUERY_STRING"] . "&d=" . ecode($v["Id"]) ?>')"
                                            target="_self">查看详细..</a></td>
        </tr>
        <?
    }
    ?>
    <tr>
        <th colspan="7" height="45"><font color="#FF0000">目前显示了 <strong><?= $ItemList["row"] ?></strong> 条记录！</font>
        </th>
    </tr>
    <tr>
        <th colspan="7" height="45"><font color="#008000">独</font>：表示该顾客仅有您可以查看；完美处理：有意愿并登记系统或系统有记录；<font
                    color="#DAA520">发</font>：表示已经发送了手机短信！
        </th>
    </tr>
</table>
