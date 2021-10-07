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

if ($_SESSION["YumDamGroup"] != "1") {
    YumDamShowMsgExit("抱歉,您未获得此权限！", "./");
    exit;
}


$date1 = date("Y-m-d", time() - 3600 * 24 * 30);
$date2 = date("Y-m-d", time());


$myaction = decode($_GET["action"]);


$date1 = returndatetime($date1);
$date2 = returndatetime($date2, "max");
if ($date1 > $date2) {
    echo "日期选择错误，请重新选择！";
    exit;
}
@setcookie("vd1", $date1, time() + 3600, "/");
@setcookie("vd2", $date2, time() + 3600, "/");


$mt3 = '#_@mobilelogs';

$mt4 = '#_@mobilelogin';
###################################################################################################################################
###################################################################################################################################

function LogsShow($d1, $d2)
{
    global $YumDamSql, $mt3, $mt4;
    $ItemListRow = $YumDamSql->selectsql("SELECT * FROM  (SELECT $mt3.`Id`,$mt3.`UId`,$mt3.`InDate`,$mt3.`InIp`,$mt4.`ucname`,$mt3.`ucont` FROM  $mt3,$mt4 where $mt4.`Id`=$mt3.`UId` and $mt3.`InDate` between " . $d1 . " and " . $d2 . " order by $mt3.`Id` desc) as lt group by `UId` order by InDate desc");
    return $ItemListRow;
}

$ItemListRow7 = LogsShow($date1, $date2);

$ItemListRow8 = $YumDamSql->selectsql("SELECT * FROM  $mt3 order by InDate desc limit 0,50");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳美莱医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body oncontextmenu="return false;">
<div class="Cont">
    <div class="Content">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th height="35" colspan="2">以下是 <strong><?= timetodate($date1, true) ?>
                        - <?= timetodate($date2, true) ?></strong> 的数据信息情况
                </th>
            </tr>
            <tr>
                <td align="right"><strong>最后操作情况：</strong></td>
                <td style="line-height:25px;">
                    <?
                    foreach ($ItemListRow7["select"] as $k => $v) {
                        $ucont = preg_replace("/\([0-9]+\)/i", "", $v["ucont"]);
                        echo timetodate($v["InDate"]) . " - " . $v["ucname"] . " - " . YumDamToIPname($v["InIp"]) . " || " . $v["InIp"] . " - " . $ucont . "<br>\n";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td align="right"><strong>最近操作情况：</strong></td>
                <td style="line-height:25px;">
                    <?
                    foreach ($ItemListRow8["select"] as $k => $v) {
                        $ucont = preg_replace("/\([0-9]+\)/i", "", $v["ucont"]);
                        preg_match("/FromIFile_([0-9]+).xls/", $ucont, $match);
                        $DlCont = "";
                        if (!empty($match[0])) {
                            $DlCont = "&nbsp; | <a href=\"/UDL/" . $match[0] . "\" target=\"_blank\"><strong>点击下载</strong></a>";
                        }
                        echo timetodate($v["InDate"]) . " - " . YumDamToIPname($v["InIp"]) . " || " . $v["InIp"] . " - " . $ucont . $DlCont . "<br>\n";
                    }
                    ?>
                </td>
            </tr>
        </table>
        <div class="clearit"></div>
    </div>
    <div class="clearit"></div>
</div>
</body>
</html>