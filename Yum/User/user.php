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

$myaction = $_GET["action"];

$mu = "#_@users";


$uid = dcode($_GET["i"]);
if (decode($myaction) == "delete") {
    $InNewTable = $YumDamSql->updatedb($mu, "`IsDisplay`='2' ", "`Id`='$uid'");
}
if (decode($myaction) == "lock") {
    $InNewTable = $YumDamSql->updatedb($mu, "`IsDisplay`='3' ", "`Id`='$uid'");
}
if (decode($myaction) == "reset") {
    $uname = $_GET["i2"];
    $uname = decode($uname);
    $passarray = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "b", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "P", "Q", "R", "d", "T", "y", "f", "e", "g", "Y", "Z", "a", "h", "i", "j", "k", "m", "n", "p", "q", "r", "t", "z");
    for ($i = 0; $i < 10; $i++) {
        $upass = rand(0, count($passarray));
        $upasscont = $upasscont . $passarray[$upass];
    }
    $upasscontecho = $upasscont;
    $upasscont = passmd5($upasscont);
    $InNewTable = $YumDamSql->updatedb($mu, "`upass`='" . $upasscont . "' ", "`Id`='$uid'");
    echo "用户：" . $uname . "密码已重置成功！密码为：" . $upasscontecho;
    exit;
}
if ($_POST) {
    $where = " `username`='$uu'";
    $SRes = $YumDamSql->selectdb(" `Id` ", "$mu", "$where");
    if ($SRes["row"] >= "1") {
        echo "系统中存在该用户名！";
        exit;
    }

    $up = passmd5($up);
    $field1 = "`username`,`ucname`,`userpass`,`usergroup`,`InDate`,`InId`,`InIP`";
    $field2 = "'$uu','$un','$up','$ug','" . time() . "','$YumDamSId','" . getip() . "'";
    $InUser = $YumDamSql->insertdb($mu, $field1, $field2);
    if ($InUser["affect"] == "1") {
        YumDamUpDateAdminInfoCache();
        echo '添加成功<a href="' . $_SERVER['PHP_SELF'] . '">继续添加</a>';
        exit;
    }
}
$UserList = $YumDamSql->selectdb(" * ", $mu, " `IsDisplay`='1'");
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
        <form action="" name="myform" id="myform" method="post">
            <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                    <td width="200" align="right">用户名：</td>
                    <td><input type="text" name="uu" id="uu" class="InPutTxt" style="width:200px;"/> 用户系统登录的用户名</td>
                </tr>
                <tr>
                    <td align="right">姓名：</td>
                    <td><input type="text" name="un" id="un" class="InPutTxt" style="width:200px;"/> 识别用户的真实姓名</td>
                </tr>
                <tr>
                    <td align="right">角色：</td>
                    <td>
                        <select name="ug">
                            <?
                            foreach ($UserGroup as $k => $v) {
                                ?>
                                <option value="<?= $k ?>"><?= $v ?></option>
                                <?
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right">密码：</td>
                    <td><input type="text" name="up" id="up" class="InPutTxt" style="width:200px;"/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><font color="#FF0000">以上信息均要填写</font></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="新增"/></td>
                </tr>
            </table>
        </form>


        <table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr>
                <td>编号</td>
                <td>用户ID</td>
                <td>用户名</td>
                <td>名称</td>
                <td>角色</td>
                <td>状态</td>
                <td>&nbsp;</td>
            </tr>
            <?
            foreach ($UserListC as $ck => $cv) {
                $i++;
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $cv["Id"] ?></td>
                    <td><?= $cv["username"] ?></td>
                    <td><?= $cv["ucname"] ?></td>
                    <td><?= $UserGroup[$cv["usergroup"]] ?></td>
                    <td><?= $cv["IsDisplay"] == "1" ? "正常" : "<font color=\"#FF0000\">异常</font>" ?></td>
                    <td><a href="<?= $_SERVER['PHP_SELF'] . "?action=" . encode("delete") . "&i=" . ecode($cv["Id"]) ?>"
                           onClick="return confirm('确定要删除用户（<?= $cv["username"] . "-" . $cv["ucname"] ?>）吗？')">删除</a>|<a
                                href="<?= $_SERVER['PHP_SELF'] . "?action=" . encode("lock") . "&i=" . ecode($cv["Id"]) ?>"
                                onClick="return confirm('确定要锁定用户（<?= $cv["username"] . "-" . $cv["ucname"] ?>）吗？')">锁定</a>|<a
                                href="<?= $_SERVER['PHP_SELF'] . "?action=" . encode("reset") . "&i=" . ecode($cv["Id"]) . "&i2=" . encode($cv["ucname"]) ?>"
                                onClick="return confirm('确定要重置用户（<?= $cv["username"] . "-" . $cv["ucname"] ?>）的密码吗？')">重设密码</a>
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