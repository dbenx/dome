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


$at = $_GET["at"];

$mt2 = '#_@mobilenumber';
$mt2_2 = '#_@mobilewd';
if ($at == "T") {
    $tid = dcode($_GET["m"]);
    $field1 = "`WeiXin`,`IsMine`,`InDate`";
    $field2 = "'$tid','" . $YumDamSId . "','" . time() . "'";
    $IsExits = $YumDamSql->selectsql("SELECT `Id` FROM  $mt2_2 where $mt2_2.`WeiXin`=" . $tid);
    if ($IsExits["row"] == 0) {
        $IRes = $YumDamSql->insertdb($mt2_2, $field1, $field2);
        echo "<font color=\"green\">处理成功</font>";
    } else {
        echo "<font color=\"red\">处理失败</font>";
    }
    exit;
}

if ($at != "L") {
    echo time() . "<br>出错!";
    exit;
}

/*
$TelDate1=date("Ymd",$YesToday-3600*24*7);
$TelDate2=date("Ymd",$YesToday);
$TelDateMin=strtotime($TelDate1." 00:00:00");###昨日中文日期
$TelDateMax=strtotime($TelDate2." 23:59:59");###昨日中文日期
*/
#echo $TelDateMin."||".$TelDateMax;exit;


###################################################################################################################################
###################################################################################################################################
#$MySql="$mt2.`myvdate` between ".$date1." and ".$date2.$showalldata.$ismy."  group by `mytelcode` order by $mt2.`isstate` desc, myvdate asc";


#$ItemListRow=$YumDamSql->selectsql("SELECT `Id` FROM  $mt2 where ".$MySql);

$ItemList = $YumDamSql->selectsql("SELECT $mt2.`Id`,$mt2.*,count($mt2.`mytelcode`) as tc FROM  $mt2 where $mt2.`mytelcode` not in( select $mt2_2.`WeiXin` from $mt2_2) group by `mytelcode` order by myvdate desc limit 0,150");

function emptydata($data)
{
    if (empty($data) || $data == "NULL" || $data == "undefined") {
        $data = "未知";
    }
    return $data;
}

function IsMsg($c)
{
    if (!empty($c)) {
        $ot = "<font color=\"green\" title=\"" . $c . "\">(已)</font>";
    } else {
        $ot = "<font color=\"red\">(未)</font>";
    }
    return $ot;
}


if ($ItemList["row"] == 0) {
    echo "未有记录";
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳当代医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body oncontextmenu="return false;">
<div class="Cont">
    <div class="Tinfo" style=" border-bottom:solid 1px #cccccc; height:50px; line-height:50px; display:none;">
        日期： <input type="text" value="" id="d1" class="InPutTxt" style="width:120px; cursor:pointer; _cursor:hand;"
                   readonly="readonly" onclick="choose_date_czw('d1')"/> - <input type="text" value="" id="d2"
                                                                                  class="InPutTxt"
                                                                                  style="width:120px; cursor:pointer; _cursor:hand;"
                                                                                  readonly="readonly"
                                                                                  onclick="choose_date_czw('d2')"/>
        &nbsp; <input type="button" value="查询" id="sbtn" class="B"/> &nbsp; <font color="#FF0000">温馨提示：为了系统正常运行，选择日期段不要太长！</font>
    </div>
    <div class="Content" id="sdata">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th height="40" colspan="6">以下可能是部分号码</th>
            </tr>
            <tr bgcolor="#A2E4EE">
                <th height="40">编号</th>
                <th>号码</th>
                <th>位置</th>
                <th>搜索词</th>
                <th width="100">设备</th>
                <th>访问日期</th>
                <th>操作</th>
            </tr>
            <?
            foreach ($ItemList["select"] as $k => $v) {
                $i++;
                if ($v["Id"] % 2 == 0) {
                    $whodo = "<font color=\"#FF0000\"><strong>刘</strong></font>";
                } else {
                    $whodo = "<font color=\"green\"><strong>余</strong></font>";
                }
                ?>
                <tr onmouseout="this.style.backgroundColor='#FFFFFF'"
                    onmouseover="this.style.backgroundColor='#eeeeee'">
                    <td align="center"><?= $i ?></td>
                    <td width="240" align="center"><?= $whodo; ?> --- <span id="whodo<?= ecode($i) ?>"><a
                                    href="javascript:;" onclick="showtel('<?= ecode($i) ?>','<?= $v["mytelcode"] ?>')"
                                    target="_self"><?= MobleNum($v["mytelcode"]) ?></a></span> [<?= $v["tc"] ?>
                        ]-<strong><?= IsMsg($v["msgcont"]) ?></strong></td>
                    <td><?= $v["mybigcity"] . "·" . $v["mycity"] ?></td>
                    <td>
                        <?
                        $myshowkey = mbsubstr(emptydata($v["seachkey"]));
                        ?>
                        <a href="<?= emptydata($v["nowurl"]) ?>" target="_blank"
                           title="<?= emptydata($v["seachkey"]) ?>"><strong><?= emptydata($v["fromsource"]) . " : " . $myshowkey ?></strong>[查看访问页面]</a>
                    </td>
                    <td><?= emptydata($v["hardm"]) ?></td>
                    <td align="center"><?= timetodate($v["myvdate"]) ?></td>
                    <td id="<?= ecode($v["mytelcode"]) ?>"><strong><a href="javascript:;"
                                                                      onclick="_GoToLink('<?= ecode($v["mytelcode"]) ?>','<?= $v["mytelcode"] ?>')"
                                                                      target="_self">点击处理</a></strong></td>
                </tr>
                <?
            }
            ?>
            <tr>
                <th colspan="7" height="45"><font color="#FF0000">目前显示了 <strong><?= $ItemList["row"] ?></strong>
                        条记录！</font></th>
            </tr>
            <tr>
                <th colspan="7" height="45"><font color="green">已</font>：表示已经发送了手机短信！<em>号码后面[数字]</em>：表示当前时间内获取到手机号码次数！
                </th>
            </tr>
        </table>
        <div class="clearit"></div>
    </div>
    <div class="clearit"></div>
</div>
<script type="text/javascript">
    function _GoToLink(cont, tel) {
        if (!confirm("确定处理该号码(" + tel + ")吗？")) {
            return false;
        }
        var url = "<?=$_SERVER["PHP_SELF"]?>?at=T&m=" + cont + "&r=" + Math.random();
        request.open("GET", url, true);
        document.getElementById(cont).innerHTML = "处理中……";
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                document.getElementById(cont).innerHTML = response;
            }
        }
        request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        request.send(null);
    }

    function showtel(d, c) {
        document.getElementById("whodo" + d).innerHTML = c;
    }
</script>
</body>
</html>