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
#####################################################################################
if ($_SESSION["YumDamGroup"] != "1") {
    YumDamShowMsgExit("抱歉,您未获得此权限！", "./");
    exit;
}

$myaction = $_GET["action"];

$mu = "#_@wxlogin";


$uid = dcode($_GET["i"]);

if (!empty($myaction)) {
    if (decode($myaction) == "yes") {
        $yes = "1";
        $mywxid = $_GET["wi"];
        $mywxid = decode($mywxid);
        #echo $mywxid;exit;
############################################发送微信报表#########################################################
        $WxTk = GetWXToken($wxappid, $wxsecret);
        $urlcont = "http://i.gyml.cc/webaccount/GetShow.php?at=VFM=&f=SH";
        YumDamToWxMsg($WxTk, $mywxid, $YesToday2, $urlcont, "恭喜您", "报表查看权限已通过");###发送微信
############################################发送微信报表########################################################
    } else {
        $yes = "3";
    }
    $InNewTable = $YumDamSql->updatedb($mu, "`allow`='" . $yes . "' ", "`Id`='$uid'");
}


$UserList = $YumDamSql->selectdb(" * ", $mu, " 1=1 order by `allow` asc");
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
    <title>贵阳美莱医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body oncontextmenu="return false;">
<div class="Cont">
    <div class="Content">

        <table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr>
                <th>编号</th>
                <th>用户名</th>
                <th>微信Id</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <?
            foreach ($UserListC as $ck => $cv) {
                $i++;
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $cv["ucname"] ?>(<?= $cv["wxname"] ?>)</td>
                    <td><?= $cv["wxid"] ?></td>
                    <td>
                        <?
                        if ($cv["allow"] == "1") {
                            echo "<font color=\"green\">查看</font>";
                        } elseif ($cv["allow"] == "2") {
                            echo "<font color=\"red\">未通过</font>";
                        } else {
                            echo "<font color=\"#F60\">删除</font>";
                        }
                        ?>
                    </td>
                    <td>
                        <?
                        if ($cv["allow"] == "1") {
                            ?>
                            <a href="<?= $_SERVER['PHP_SELF'] . "?action=" . encode("no") . "&i=" . ecode($cv["Id"]) ?>"
                               onClick="return confirm('确定要禁止查看权限（<?= $cv["username"] . "-" . $cv["ucname"] ?>）吗？')">禁止查看</a>
                            <?
                        } elseif ($cv["allow"] == "2") {
                            ?>
                            <a href="<?= $_SERVER['PHP_SELF'] . "?action=" . encode("yes") . "&i=" . ecode($cv["Id"]) . "&wi=" . encode($cv["wxid"]) ?>"
                               onClick="return confirm('确定要通过审核查看权限（<?= $cv["username"] . "-" . $cv["ucname"] ?>）吗？')">通过审核</a>
                            <?
                        } else {
                            ?>
                            <a href="<?= $_SERVER['PHP_SELF'] . "?action=" . encode("yes") . "&i=" . ecode($cv["Id"]) . "&wi=" . encode($cv["wxid"]) ?>"
                               onClick="return confirm('确定要恢复查看权限（<?= $cv["username"] . "-" . $cv["ucname"] ?>）吗？')">恢复查看</a>
                            <?
                        }
                        ?>
                    </td>
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