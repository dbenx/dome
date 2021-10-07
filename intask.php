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
include("Config/Config.Inc.php");####加载配置文件
#header( "Location:./login.php");
$ma = $_GET["at"];
$ma2 = $_GET["action"];
$mt = "#_@mytask";
#$mt2='#_@indata2';
$uid = dcode($_GET["i"]);
if (decode($ma2) == "delete") {
    $InNewTable = $YumDamSql->updatedb($mt, "`IsDisplay`='3' ", "`Id`='$uid'");
    @header("Location:./" . $_SERVER['PHP_SELF'] . "?at=L");
}


if ($_POST) {
    $TaskDate = strtotime($d1 . " 12:00:00");
    $tt = dcode($tt);
    $field1 = "`TaskDate`,`Title`,`MyCont`,`TaskType`,`InDate`,`uip`,`inid`";
    $field2 = "'$TaskDate','$mtl','$md','$tt'," . time() . ",'" . getip() . "','" . $YumDamSId . "'";
    $IRes = $YumDamSql->insertdb($mt, $field1, $field2);
    if ($IRes["affect"] == "1") {
        @header("Location:./" . $_SERVER['PHP_SELF'] . "?at=L");
    }
    exit;
}


$mt = "#_@mytask";
$ListTaskRes = $YumDamSql->selectsql("SELECT * FROM  $mt where `inid`='" . $YumDamSId . "' and `IsDisplay` in('1','2') order by `TaskType` desc");
$ListTaskResSelect = $ListTaskRes["select"];


function TaskSte($st)
{
    $outstr = "";
    if ($st == "1") {
        $outstr = "<font color=\"green\">显示</font>";
    } else {
        $outstr = "已过期";
    }
    return $outstr;
}

function TaskDate($tp, $dt)
{
    global $YumDamMyTaskClass;
    $otstr = $YumDamMyTaskClass[$tp];
    $otstr .= "(";
    if ($tp == "1") {
        $otstr .= "每天";
    }
    if ($tp == "2") {
        $otstr .= date("w", $dt);
    }
    if ($tp == "3") {
        $otstr .= date("d日", $dt);
    }
    if ($tp == "4") {
        $otstr .= date("Y年m月d日", $dt);
    }
    return $otstr . ")";
}


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
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <?
            if ($ma == "L")
            {
            ?>
            <tr>
                <th width="150" align="right">编号</th>
                <th>创建时间</th>
                <th>任务标题</th>
                <th>任务描述</th>
                <th>模式</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <?
            foreach ($ListTaskResSelect as $k => $v) {
                $i++;
                ?>
                <tr>
                    <td align="center"><?= $i ?></td>
                    <td><?= timetodate($v["TaskDate"], true) ?></td>
                    <td><?= $v["Title"] ?></td>
                    <td><?= $v["MyCont"] ?></td>
                    <td><strong><?= TaskDate($v["TaskType"], $v["TaskDate"]) ?></strong></td>
                    <td><?= TaskSte($v["IsDisplay"]) ?></td>
                    <td><a href="<?= $_SERVER['PHP_SELF'] . "?action=" . encode("delete") . "&i=" . ecode($v["Id"]) ?>"
                           onClick="return confirm('确定要删除（<?= $v["Title"] ?>）吗？')">删除</a></td>
                </tr>
                <?
            }
            ?>
        </table>
        <?
        }
        else {
            ?>
            <tr>
                <td>&nbsp;</td>
                <td align="right">
                    <a href="intask.php?at=L" target="mainframe">返回管理计划</a>
                </td>
            </tr>
            <form action="" name="myform" id="myform" method="post">
                <tr>
                    <td align="right">提醒模式：</td>
                    <td>
                        <select name="tt">
                            <?
                            foreach ($YumDamMyTaskClass as $k => $v) {
                                ?>
                                <option value="<?= ecode($k) ?>"><?= $v ?></option>
                                <?
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right">开始日期：</td>
                    <td><input type="text" name="d1" value="<?= $CookieDate1 ?>" id="d1" class="InPutTxt"
                               style="width:120px; cursor:pointer; _cursor:hand;" readonly="readonly"
                               onclick="choose_date_czw('d1')"/> &nbsp;每周选择日期所在周数
                    </td>
                </tr>
                <tr>
                    <td width="150" align="right">任务说明：</td>
                    <td>
                        <input type="text" name="mtl" id="mtl" class="InPutTxt" value=""/>
                    </td>
                </tr>
                <tr>
                    <td width="150" align="right">任务描述：</td>
                    <td>
                        <textarea name="md" id="md"
                                  style="width:360px; height:80px; line-height:25px; padding:5px; font-weight:bold;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td align="right">&nbsp;</td>
                    <td><input type="submit" value="保存" class="B"/> &nbsp; <input type="button" value="清空" class="B"/>
                    </td>
                </tr>
            </form>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
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