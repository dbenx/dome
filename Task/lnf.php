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

if ($_SESSION["YumDamGroup"] != "1" && $_SESSION["YumDamGroup"] != "3") {
    YumDamShowMsgExit("抱歉,您未获得此权限！", "./");
    exit;
}


$mt1 = '#_@himlist';
###################################################################################################################################
###################################################################################################################################
$MinDate = date("Ymd", $YesToday - 3600 * 24 * 60);
$MaxDate = date("Ymd", $YesToday + 3600 * 24);
$ItemListRow = $YumDamSql->selectsql("SELECT * FROM  $mt1 where $mt1.`InDate` " . YumDamDay($MinDate, $MaxDate) . " order by $mt1.`InDate` desc");


#$ItemListRow7=LogsShow($date1,$date2);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳当代医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body oncontextmenu="return false;">
<div class="Cont">
    <div class="Content">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th height="35" colspan="5">以下是 最近30天 的数据信息情况</th>
            </tr>
            <tr>
                <td align="right">编号</td>
                <td>文件标题</td>
                <td>上传时间</td>
                <td>操作</td>
            </tr>
            <?
            foreach ($ItemListRow["select"] as $k => $v) {
                $i++;
                ?>
                <tr onmouseout="this.style.backgroundColor='#FFFFFF'"
                    onmouseover="this.style.backgroundColor='#eeeeee'">
                    <td align="right"><?= $i ?></td>
                    <td><a href="/Uploads/him/<?= date("Ym", $v["InDate"]) . "/" . $v["fname"] ?>"
                           target="_blank"><?= $v["title"] ?></a></td>
                    <td><?= timetodate($v["InDate"]) ?></td>
                    <td><a href="/Uploads/him/<?= date("Ym", $v["InDate"]) . "/" . $v["fname"] ?>"
                           target="_blank">下载</a></td>
                </tr>
                <?
            }
            ?>
        </table>
        <div class="clearit"></div>
    </div>
    <div class="clearit"></div>
</div>
</body>
</html>