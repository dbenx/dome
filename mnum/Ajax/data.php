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


$mt2 = '#_@mobilenumber';

###################################################################################################################################
###################################################################################################################################
$MySql = " $mt2.`msgcont`='0'";

$ItemListRow1 = $YumDamSql->selectsql("SELECT count(`Id`) as `mnum` FROM  $mt2 where " . $MySql);

$ItemListRow2 = $YumDamSql->selectsql("SELECT distinct `mytelcode` FROM  $mt2 where " . $MySql);

$ItemListRow3 = $YumDamSql->selectsql("SELECT count(`Id`) as `mnum` FROM  $mt2");

$ItemListRow4 = $YumDamSql->selectsql("SELECT distinct `mytelcode` FROM  $mt2");


$ItemListRow["mnum"] = $ItemListRow1["select"][0]["mnum"];

$ItemListRow["onemnum"] = $ItemListRow2["row"];

$ItemListRow["allmnum"] = $ItemListRow3["select"][0]["mnum"];

$ItemListRow["allonemnum"] = $ItemListRow4["row"];


?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <th height="35" colspan="3">数据信息情况</th>
    </tr>
    <tr>
        <td width="25%" align="right"><strong>未处理总记录：</strong></td>
        <td><? echo $ItemListRow["mnum"] . "条（不重复" . $ItemListRow["onemnum"] . "条）"; ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right"><strong>系统总记录：</strong></td>
        <td><? echo $ItemListRow["allmnum"] . "条（不重复" . $ItemListRow["allonemnum"] . "条）"; ?></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">未知记录：</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">眼部：</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">鼻部：</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">胸部：</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">吸脂：</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">斑类：</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">脱毛：</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">除皱：</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">玻尿酸：</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">瘦脸：</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">正畸：</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="right">美容冠：</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>

</table>