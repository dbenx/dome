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

if (empty($_GET["YumDam"])) {
    echo time();
    exit;
}
include("../Config/Config.Inc.php");####加载配置文件


if ($YumDamGId != "1") {
    YumDamShowMsgExit("抱歉,您未获得此权限！", "./");
    exit;
}


$mu = "#_@datalogs";

$UserList = $YumDamSql->selectdb(" * ", $mu, " 1=1 order by Id desc limit 0,60");
if (!is_array($UserList["select"])) {
    $UserList["select"] = array();
}
$UserListC = $UserList["select"];

#####################################################################################
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳当代医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
    <script type="text/javascript">
        if (window.top == window.self) {
            window.location.href = "/";
        }
    </script>
</head>

<body oncontextmenu="return false;">
<?
#@include_once("Inc/head.php");
?>
<div class="Cont">
    <div class="Content">
        <table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr>
                <th>编号</th>
                <th>通行密码</th>
                <th>设备信息</th>
                <th>查看日期</th>
                <th>IP地址</th>
            </tr>
            <?
            foreach ($UserListC as $ck => $cv) {
                $i++;
                $userinfo = explode("||", $cv["userinfo"]);
                if (empty($userinfo[1]) || stripos($userinfo[1], "NotSelf") > 0) {
                    $userinfoshow = "暂无";
                } else {
                    $userinfoshow = "<a href=\"" . $userinfo[1] . "\" target=\"_blank\">点击显示</a>";
                }
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $cv["showpass"] ?></td>
                    <td title="<?= $userinfo[0] ?>"><?= $userinfoshow ?></td>
                    <td><?= timetodate($cv["showtime"]) ?></td>
                    <td><?= YumDamToIPname($cv["showip"]) . " || " . $cv["showip"] ?></td>
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