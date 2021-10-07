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

$date1 = returndatetime($date1);
$date2 = returndatetime($date2, "max");
@setcookie("vd1", $date1, time() + 3600, "/");
@setcookie("vd2", $date2, time() + 3600, "/");


$mt4 = '#_@dataclass';
$mt5 = '#_@itemclass';
$mt6 = '#_@formdata2';

###################################################################################################################################
$ItemSRes = $YumDamSql->selectsql("SELECT `Id`,`iname` as aname FROM  $mt5 where `isshow`='1' and TId=0");
if (!is_array($ItemSRes["select"])) {
    $ItemSRes["select"] = array();
}
$ItemClass = $ItemSRes["select"];
$ItemClassShow = array();
foreach ($ItemClass as $k => $cv) {
    $ItemClassShowC = array();
    $ItemClassShowC = $cv;
    $where = " `TId`=" . $cv["Id"] . " and `isshow`=1";
    $ItemClass2 = $YumDamSql->selectdb("Id,iname", $mt5, $where);
    $ItemClassShowC["row"] = $ItemClass2["row"];
    $ItemClassShowC["son"] = $ItemClass2["select"];
    $ItemClassShow[] = $ItemClassShowC;
}
###################################################################################################################################
$ItemList = $YumDamSql->selectsql("SELECT $mt6.`fitem`,$mt4.`selecttime` FROM  $mt6,$mt4 where $mt6.`fdate`=$mt4.`Id` and $mt4.`selecttime` between " . $date1 . " and " . $date2 . " order by $mt4.`selecttime` desc");

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <?
    foreach ($ItemClassShow as $ClassK => $ClassV) {
        ?>
        <tr>
            <th height="30" colspan="<?= $ClassV["row"] + 1 ?>"><?= $ClassV["aname"] ?></th>
        </tr>
        <tr>
            <td height="30">日期</td>
            <?
            foreach ($ClassV["son"] as $sk => $sv) {
                ?>
                <td><?= $sv["iname"] ?><br/>(咨询 | 留电 | 消费 | 成本)</td>
                <?
            }
            ?>
        </tr>
        <?
        foreach ($ItemList["select"] as $ssk => $ssv) {
            ?>
            <tr>
                <td height="30"><?= timetodate($ssv["selecttime"], true) ?></td>
                <?
                $itemcont = unserialize($ssv["fitem"]);
                foreach ($ClassV["son"] as $sk => $sv) {
                    $ItemId = ecode($sv["Id"]);
                    $ItemShowData = $itemcont[$ItemId];
                    $onetalkprice = round(($ItemShowData[2] / $ItemShowData[1]), 2);
                    if ($onetalkprice > 200) {
                        $onetalkprice = "<font color=\"#FF0000\"><strong>" . $onetalkprice . "</strong></font>";
                    }
                    if ($onetalkprice < 150 && $onetalkprice > 0) {
                        $onetalkprice = "<font color=\"#008000\"><strong>" . $onetalkprice . "</strong></font>";
                    }
                    ?>
                    <td><? echo isempty($ItemShowData[1]) . " | " . isempty($ItemShowData[0]) . " | " . isempty($ItemShowData[2]) . " | " . $onetalkprice; ?></td>
                    <?
                }
                ?>
            </tr>
            <?
        }
    }
    ?>
</table>