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

if ($YumDamGId != "1" || $YumDamGId != "3") {
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


$mt2 = '#_@mobilenumber';
###################################################################################################################################
###################################################################################################################################
$MySql = "$mt2.`myvdate` between " . $date1 . " and " . $date2;

$ItemListRow1 = $YumDamSql->selectsql("SELECT count(`Id`) as `mnum` FROM  $mt2 where " . $MySql);

$ItemListRow2 = $YumDamSql->selectsql("SELECT distinct `mytelcode` FROM  $mt2 where " . $MySql);

$ItemListRow3 = $YumDamSql->selectsql("SELECT distinct `mytelcode` FROM  $mt2 where " . $MySql . " and `msgdate`!=0");

$ItemListRow4 = $YumDamSql->selectsql("SELECT distinct `isstate`,count(`Id`) as m FROM  $mt2 where " . $MySql . " group by `isstate`");

$ItemListRow5 = $YumDamSql->selectsql("SELECT distinct `ismyid`,count(`Id`) as m2 FROM  $mt2 where " . $MySql . " group by `ismyid`");

$ItemListRow["mnum"] = $ItemListRow1["select"][0]["mnum"];

$ItemListRow["onemnum"] = $ItemListRow2["row"];

$ItemListRow["msgmnum"] = $ItemListRow3["row"];

#$ItemList=$YumDamSql->selectsql("SELECT *,count(`mytelcode`) as tc FROM  $mt2 where ".$MySql.$limit);

$YumDamUpDateAdminInfoCache = array("1" => "11", "3" => "我们");

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="25%" align="right"><strong>总记录：</strong></td>
        <td><? echo $ItemListRow["mnum"] . "条（不重复" . $ItemListRow["onemnum"] . "条）"; ?></td>
    </tr>
    <tr>
        <td align="right"><strong>已发信息：</strong></td>
        <td><?= $ItemListRow["msgmnum"] ?>条</td>
    </tr>
    <tr>
        <td align="right"><strong>处理情况：</strong></td>
        <td>
            <?
            foreach ($ItemListRow4["select"] as $k => $v) {
                $state = $v["isstate"];
                if (empty($state)) {
                    $state = "待处理";
                } else {
                    $state = $YumDamMStatus[$state];
                }
                echo $state . "->" . $v["m"] . "&nbsp;&nbsp;";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td align="right"><strong>分配情况：</strong></td>
        <td>
            <?
            foreach ($ItemListRow5["select"] as $k => $v) {
                $ismyid = $v["ismyid"];
                if (empty($ismyid)) {
                    $ismyid = "未分配";
                } else {
                    $ismyid = YumDamReadAdmin($ismyid);
                }
                echo $ismyid . "->" . $v["m2"] . "条&nbsp;&nbsp;";
            }
            ?>
            <!--A：4条-->
        </td>
    </tr>
    <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>