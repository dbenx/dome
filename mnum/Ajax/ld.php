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


#$MySql="$mt2.`myvdate` between ".$date1." and ".$date2.$showalldata.$ismy."  group by `mytelcode` order by $mt2.`isstate` desc, myvdate asc";
$MySql = " $mt2.`msgcont`='0' group by `mytelcode` order by myvdate desc limit 0,150";

#$ItemListRow=$YumDamSql->selectsql("SELECT `Id` FROM  $mt2 where ".$MySql);


$ItemList = $YumDamSql->selectsql("SELECT *,count(`mytelcode`) as tc FROM  $mt2 where " . $MySql . $limit);


function emptydata($data)
{
    if (empty($data) || $data == "NULL" || $data == "undefined") {
        $data = "未知";
    }
    return $data;
}


?>
<?
if ($ItemList["row"] == 0) {
    echo "未有记录";
    exit;
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <th height="40" colspan="8">未处理的号码列表（可能仅显示部分）</th>
    </tr>
    <tr bgcolor="#A2E4EE">
        <th>&nbsp;</th>
        <th height="40">编号</th>
        <th width="240">号码</th>
        <th>搜索词</th>
        <th width="100">设备</th>
        <th>访问日期</th>
        <th>导入日期</th>
        <th>操作</th>
    </tr>
    <?
    foreach ($ItemList["select"] as $k => $v) {
        $i++;
        if (($YumDamGId == "3" || $YumDamGId == "1") && $v["mdate"] == 0) {
            $ismsg = " | <a href=\"javascript:;\" onclick=\"_GoToLink('Ajax/ms.php?action=" . encode("s") . "&d=" . ecode($v["Id"]) . "&t=" . encode($v["mytelcode"]) . "&d1=" . ecode($v["myvdate"]) . "&s=" . $v["isstate"] . "')\" target=\"_self\">&lt;&lt;点击发信息&gt;&gt;</a>";
        }
        ?>
        <tr onmouseout="this.style.backgroundColor='#FFFFFF'" onmouseover="this.style.backgroundColor='#eeeeee'">
            <td align="center"><input type="checkbox" name="tbox" value="<?= encode($v["mytelcode"]) ?>"
                                      id="tbox<?= $i ?>" style="width:20px; height:20px;"/></td>
            <td align="center"><?= $i ?></td>
            <td width="240" align="center"><a href="javascript:;"
                                              onclick="_GoToLink('Ajax/sd.php?<?= $_SERVER["QUERY_STRING"] . "&d=" . ecode($v["Id"]) ?>')"
                                              target="_self"><?= MobleNum($v["mytelcode"]) ?></a> [<?= $v["tc"] ?>
                ]-<strong>[<?= YumDamMStatus($v["isstate"], $v["mdate"]) ?>]</strong></td>
            <td>
                <?
                $myshowkey = mbsubstr(emptydata($v["seachkey"]));
                ?>
                <a href="<?= emptydata($v["nowurl"]) ?>" target="_blank"
                   title="<?= emptydata($v["seachkey"]) ?>"><strong><?= emptydata($v["fromsource"]) . " : " . $myshowkey ?></strong>[
                    查看访问页面]</a>
            </td>
            <td><?= emptydata($v["hardm"]) ?></td>
            <td align="center"><?= timetodate($v["myvdate"]) ?></td>
            <td align="center"><?= timetodate($v["indatadate"], true) ?></td>
            <td>
                <a href="javascript:;"
                   onclick="_GoToLink('Ajax/sd.php?<?= $_SERVER["QUERY_STRING"] . "&d=" . ecode($v["Id"]) ?>')"
                   target="_self">查看详细..</a>
                <strong><?= $ismsg ?></strong>
            </td>
        </tr>
        <?
    }
    ?>
    <tr>
        <th colspan="8" height="45">&nbsp;</th>
    </tr>
    <tr>
        <td colspan="8" height="45"><input type="button" onclick="_SendMoreMsg()" class="TdBtn" value="批量发送短信"/></td>
    </tr>
    <tr>
        <th colspan="8" height="45"><font color="#FF0000">目前显示了 <strong><?= $ItemList["row"] ?></strong> 条记录！</font>
        </th>
    </tr>
    <tr>
        <th colspan="8" height="45"><font color="#DAA520">发</font>：表示已经发送了手机短信！<em>号码后面[数字]</em>：表示当前时间内获取到手机号码次数！</th>
    </tr>
</table>