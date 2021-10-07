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


$at = decode($_GET["at"]);
$d1 = dcode($_GET["d"]);
$d2 = $_GET["d2"];
$wxcode = $_GET["code"];

######################################################权限验证#######################################################################################
$selfurl = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];###本页面完整链接
#echo $selfurl;
#print_r($_SERVER);exit;
$selfurlgo = urlencode($selfurl);

if (!isset($wxcode)) {
    $wxoauthurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $wxappid . "&redirect_uri=" . $selfurlgo . "&response_type=code&scope=snsapi_base&state=YumDamSt#wechat_redirect";
    header("HTTP/1.1 301 Moved Permanently");
    header("Location:" . $wxoauthurl);
    exit;
}

$GoUrl = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $wxappid . "&secret=" . $wxsecret . "&code=" . $wxcode . "&grant_type=authorization_code";
$Cont = GetCont($GoUrl, true);
$openid = $Cont['openid'];//输出openid
####################################################################################################################################################
$wxus = '#_@wxlogin';
$ListAllowUSRes = $YumDamSql->selectsql("SELECT `Id` FROM  $wxus where `wxid`='" . $openid . "' and `allow`='1' and `MyGroup` in (2,3)");

if ($ListAllowUSRes["row"] != "1") {
    echo "<script type=\"text/javascript\" src=\"/Scripts/yumdam.my.js\"></script>\n";
    echo "<script type=\"text/javascript\">\nfunction mytw(){\nvar md1='" . encode($openid) . "||" . $openid . "';if(md1==\"\"||md1==\"0\"){return false}\nvar url=\"./Ajax/GetAllow.php?" . $_SERVER["QUERY_STRING"] . "&md1=\"+md1+\"&r=" . rand(1, 99999) . "\";\nrequest.open(\"GET\",url,true);\ndocument.getElementById(\"myt\").innerHTML=\"提交中……\";\nrequest.onreadystatechange=function(){if(request.readyState==4&&request.status==200){var response=request.responseText;\ndocument.getElementById(\"myt\").innerHTML=response}}\nrequest.setRequestHeader(\"X-Requested-With\",\"XMLHttpRequest\");\nrequest.send(null)}\n</script>\n";
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, user-scalable=0\"><div style=\"line-height:40px; color:#791d77;\">美莱(MYLIKE)很抱歉<br />您暂未获得此授权，请与我们联系！<br /><strong><span id=\"myt\"><a href=\"javascript:;\" onclick=\"mytw()\">点击申请获取权限</a></span></strong></div>";
    exit;
}

######################################################权限验证#######################################################################################

$mt7 = '#_@datalogs';
$hdinfo = $_SERVER["HTTP_USER_AGENT"] . "||" . $_SERVER["REQUEST_URI"];
$field1 = "`showpass`,`userinfo`,`showtime`,`showip`";
$field2 = "'" . $openid . "','" . $hdinfo . "','" . time() . "','" . getip() . "'";
$YumDamSql->insertdb($mt7, $field1, $field2);
#########################################################


if ($at != "TS" || empty($d1) || empty($d2)) {
    exit("对不起，您尚未获得此权限！");
}

$OkTime = time() - 3600 * 24 * 30;

#echo ecode(1442894400);
if ($OkTime > $d1) {
    exit("抱歉，您的链接已过期或失效，请联系电子商务部！^_^");
}
$ToDay = date("Y年m月d日", $d1);

function ShowData($date1, $date2 = 0)
{
    global $YumDamSql;
    $mt1 = '#_@indata';
    $mt2 = '#_@indata2';
    if (empty($date2)) {
        $date2 = $date1;
    }
    $ShowData = array();
    $ListSRes = $YumDamSql->selectsql("SELECT $mt1.`Id`,FROM_UNIXTIME($mt1.`fdate`,'%Y%m') as `MyMonth`,$mt1.`fdate`,sum($mt1.`talkall`) as `talkall`,sum($mt1.`talkwap`) as `talkwap`,sum($mt1.`yestalk`) as `yestalk`,sum($mt1.`retalk1`) as `retalk1`,sum($mt1.`retalk2`) as `retalk2`,sum($mt1.`notalk`) as `notalk`,sum($mt1.`issys`) as `issys`,sum($mt1.`isfrom`) as `isfrom`,sum($mt1.`isok`) as `isok`,sum($mt1.`webip`) as `webip`,sum($mt1.`bqq`) as `bqq` FROM  $mt1 where $mt1.`fdate` " . YumDamDay($date1, $date2) . " group by `MyMonth`");
    $ListSRes2 = $YumDamSql->selectsql("SELECT FROM_UNIXTIME($mt2.`fdate`,'%Y%m') as `MyMonth2`,sum($mt2.`fmoney`) as `fmoney`,sum($mt2.`wapmoney`) as `wapmoney`,sum($mt2.`fclick`) as `fclick`,sum($mt2.`fshow`) as `fshow` FROM  $mt2 where $mt2.`fdate` " . YumDamDay($date1, $date2) . " group by `MyMonth2`");
    $ShowData = array_merge($ListSRes["select"][0], $ListSRes2["select"][0]);
    return $ShowData;
}


#########################################################手机报表显示的项目#####################################################################
$mt4 = '#_@classitem';
$mt5 = '#_@itemcont';
$ListAllowIRes = $YumDamSql->selectsql("SELECT $mt4.`Id`,$mt4.`iname` FROM  $mt4 where $mt4.`isshow`='1' and $mt4.`ism`='2' order by $mt4.`TId` asc,$mt4.`Id`");

foreach ($ListAllowIRes["select"] as $IK => $IV) {
    $ListAllowSRes .= "'" . $IV["Id"] . "',";
}
$ListAllowSRes = substr($ListAllowSRes, 0, -1);
#########################################################手机报表显示的项目#####################################################################
function ShowItem($date1, $date2 = 0)
{
    global $YumDamSql, $ListAllowSRes;
    $mt4 = '#_@classitem';
    $mt5 = '#_@itemcont';
    if (empty($date2)) {
        $date2 = $date1;
    }
    $ListSRes = $YumDamSql->selectsql("SELECT $mt5.`fdate`,sum($mt5.`ITk`) as `ITk`,sum($mt5.`IIs`) as `IIs`,sum($mt5.`IIf`) as `IIf`,sum($mt5.`IIo`) as `IIo`,sum($mt5.`IIm`) as `IIm`,$mt4.`Id` as `cId`,$mt4.`iname` FROM  $mt5 left join $mt4 on $mt5.`IId`=$mt4.`Id` where $mt5.`fdate` " . YumDamDay($date1, $date2) . " and $mt5.`IId` in(" . $ListAllowSRes . ") group by $mt5.`IId` order by $mt4.`TId` asc,$mt4.`Id`");
    $ShowItemArray = array();
    foreach ($ListSRes["select"] as $sk => $sv) {
        $ShowItemArray[$sv["cId"]] = $sv;
    }
    return $ShowItemArray;
}


#echo $d1;
$DayShowData = ShowData(date("Y-m-d", $d1));
$DayShowDataMonth = ShowData(date("Y-m-01", $d1), date("Y-m-d", $d1));

$DayShowItem = ShowItem(date("Y-m-d", $d1));
$DayShowItemMonth = ShowItem(date("Y-m-01", $d1), date("Y-m-d", $d1));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>贵阳美莱电子商务部日报表<?= $ToDay ?>数据情况</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
    <style type="text/css">
        .Tb {
            background: #cdb583;
        }

        .Tb tr {
            background: #FFF;
        }

        .Tb td {
            height: 25px;
            line-height: 25px;
            padding: 2px 5px;
        }

        .line td {
            height: 10px;
            font-size: 0px;
            line-height: 10px;
        }
    </style>
</head>

<body oncontextmenu="return false;">
<div style="margin:0 auto;display:none;"><img src="/Images/wxico.jpg"/></div>
<table border="0" width="100%" cellpadding="2" cellspacing="1" class="Tb">
    <tr>
        <td colspan="3"><h3>贵阳美莱医疗美容医院 · 电子商务部日报表</h3></td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td><strong>项目名称</strong></td>
        <td><strong><?= $ToDay ?></strong></td>
        <td><strong>本月截止<?= $ToDay ?></strong></td>
    </tr>
    <tr>
        <td>消费</td>
        <td><?= $DayShowData["fmoney"] ?>元</td>
        <td><?= $DayShowDataMonth["fmoney"] ?>元</td>
    </tr>
    <tr>
        <td>展现</td>
        <td><?= $DayShowData["fshow"] ?>次</td>
        <td><?= $DayShowDataMonth["fshow"] ?>次</td>
    </tr>
    <tr>
        <td>点击</td>
        <td><?= $DayShowData["fclick"] ?>次</td>
        <td><?= $DayShowDataMonth["fclick"] ?>次</td>
    </tr>
    <tr>
        <td>点击率</td>
        <td><?= round($DayShowData["fclick"] / $DayShowData["fshow"] * 100, 2) ?>%</td>
        <td><?= round($DayShowDataMonth["fclick"] / $DayShowDataMonth["fshow"] * 100, 2) ?>%</td>
    </tr>
    <tr>
        <td>点击成本</td>
        <td><?= round($DayShowData["fmoney"] / $DayShowData["fclick"], 2) ?>元/次</td>
        <td><?= round($DayShowDataMonth["fmoney"] / $DayShowDataMonth["fclick"], 2) ?>元/次</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>总对话量</td>
        <td><?= $DayShowData["talkall"] + $DayShowData["bqq"] ?>人</td>
        <td><?= $DayShowDataMonth["talkall"] + $DayShowDataMonth["bqq"] ?>人</td>
    </tr>
    <tr>
        <td><font color="#009900">有效咨询</font></td>
        <td><?= $DayShowData["talkall"] + $DayShowData["bqq"] - $DayShowData["notalk"] ?>人</td>
        <td><?= $DayShowDataMonth["talkall"] + $DayShowDataMonth["bqq"] - $DayShowDataMonth["notalk"] ?>人</td>
    </tr>
    <tr>
        <td bgcolor="#CCCCCC"><strong>网咨有效</strong></td>
        <td bgcolor="#CCCCCC"><?= $DayShowData["yestalk"] ?>人</td>
        <td bgcolor="#CCCCCC"><?= $DayShowDataMonth["yestalk"] ?>人</td>
    </tr>
    <tr>
        <td bgcolor="#CCCCCC">(网)有效率</td>
        <td bgcolor="#CCCCCC"><?= round($DayShowData["yestalk"] / ($DayShowData["talkall"] + $DayShowData["bqq"]) * 100, 2) ?>
            %
        </td>
        <td bgcolor="#CCCCCC"><?= round($DayShowDataMonth["yestalk"] / ($DayShowDataMonth["talkall"] + $DayShowDataMonth["bqq"]) * 100, 2) ?>
            %
        </td>
    </tr>
    <tr>
        <td>对话成本</td>
        <td><?= TalkDataColor(round($DayShowData["fmoney"] / ($DayShowData["talkall"] + $DayShowData["bqq"]), 2), 200) ?>
            元/人
        </td>
        <td><?= TalkDataColor(round(($DayShowDataMonth["fmoney"] / ($DayShowDataMonth["talkall"] + $DayShowDataMonth["bqq"])), 2), 200) ?>
            元/人
        </td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>下单量</td>
        <td><?= $DayShowData["issys"] ?>人</td>
        <td><?= $DayShowDataMonth["issys"] ?>人</td>
    </tr>
    <tr>
        <td>下单率</td>
        <td><?= PercentDataColor(round(($DayShowData["issys"] / ($DayShowData["talkall"] + $DayShowData["bqq"] - $DayShowData["notalk"])) * 100, 2), 45.17) ?></td>
        <td><?= PercentDataColor(round(($DayShowDataMonth["issys"] / ($DayShowDataMonth["talkall"] + $DayShowDataMonth["bqq"] - $DayShowDataMonth["notalk"]) * 100), 2), 45.17) ?></td>
    </tr>
    <tr>
        <td>下单成本</td>
        <td><?= round($DayShowData["fmoney"] / $DayShowData["issys"], 2) ?>元/人</td>
        <td><?= round($DayShowDataMonth["fmoney"] / $DayShowDataMonth["issys"], 2) ?>元/人</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>到诊量</td>
        <td><?= $DayShowData["isfrom"] ?>人</td>
        <td><?= $DayShowDataMonth["isfrom"] ?>人</td>
    </tr>
    <tr>
        <td>到诊率</td>
        <td><?= PercentDataColor(round(($DayShowData["isfrom"] / ($DayShowData["talkall"] + $DayShowData["bqq"] - $DayShowData["notalk"])) * 100, 2), 12) ?></td>
        <td><?= PercentDataColor(round(($DayShowDataMonth["isfrom"] / ($DayShowDataMonth["talkall"] + $DayShowDataMonth["bqq"] - $DayShowDataMonth["notalk"]) * 100), 2), 12) ?></td>
    </tr>
    <tr>
        <td>到诊成本</td>
        <td><?= TalkDataColor(round($DayShowData["fmoney"] / $DayShowData["isfrom"], 2), 1620) ?>元/人</td>
        <td><?= TalkDataColor(round(($DayShowDataMonth["fmoney"] / $DayShowDataMonth["isfrom"]), 2), 1620) ?>元/人</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>成交量</td>
        <td><?= $DayShowData["isok"] ?>人</td>
        <td><?= $DayShowDataMonth["isok"] ?>人</td>
    </tr>
    <tr>
        <td>成交率</td>
        <td><?= PercentDataColor(round(($DayShowData["isok"] / $DayShowData["isfrom"]) * 100, 2), 63) ?></td>
        <td><?= PercentDataColor(round(($DayShowDataMonth["isok"] / $DayShowDataMonth["isfrom"] * 100), 2), 63) ?></td>
    </tr>
    <tr>
        <td>成交成本</td>
        <td><?= round($DayShowData["fmoney"] / $DayShowData["isok"], 2) ?>元/人</td>
        <td><?= round($DayShowDataMonth["fmoney"] / $DayShowDataMonth["isok"], 2) ?>元/人</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>行政类(无效)</td>
        <td><?= $DayShowData["notalk"] ?>人</td>
        <td><?= $DayShowDataMonth["notalk"] ?>人</td>
    </tr>
    <tr>
        <td>已到院重复</td>
        <td><?= $DayShowData["retalk1"] ?>人</td>
        <td><?= $DayShowDataMonth["retalk1"] ?>人</td>
    </tr>
    <tr>
        <td>未到院重复</td>
        <td><?= $DayShowData["retalk2"] ?>人</td>
        <td><?= $DayShowDataMonth["retalk2"] ?>人</td>
    </tr>
    <?
    foreach ($ListAllowIRes["select"] as $ik => $iv) {
        ?>
        <tr class="line">
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" colspan="3"><strong><?= $iv["iname"] ?> 项目情况</strong></td>
        </tr>
        <tr>
            <td><strong>项目</strong></td>
            <td><strong><?= $ToDay ?></strong></td>
            <td><strong>本月截止<?= $ToDay ?></strong></td>
        </tr>
        <tr>
            <td>消费情况</td>
            <td><?= $DayShowItem[$iv["Id"]]["IIm"] ?>元</td>
            <td><?= $DayShowItemMonth[$iv["Id"]]["IIm"] ?>元</td>
        </tr>
        <tr>
            <td>咨询量</td>
            <td><?= $DayShowItem[$iv["Id"]]["ITk"] ?>人</td>
            <td><?= $DayShowItemMonth[$iv["Id"]]["ITk"] ?>人</td>
        </tr>
        <tr>
            <td>对话成本</td>
            <td><?= round($DayShowItem[$iv["Id"]]["IIm"] / $DayShowItem[$iv["Id"]]["ITk"]) ?>元/人</td>
            <td><?= round($DayShowItemMonth[$iv["Id"]]["IIm"] / $DayShowItemMonth[$iv["Id"]]["ITk"]) ?>元/人</td>
        </tr>
        <tr>
            <td>下单量</td>
            <td><?= $DayShowItem[$iv["Id"]]["IIs"] ?>人</td>
            <td><?= $DayShowItemMonth[$iv["Id"]]["IIs"] ?>人</td>
        </tr>
        <tr>
            <td>下单率</td>
            <td><?= round($DayShowItem[$iv["Id"]]["IIs"] / $DayShowItem[$iv["Id"]]["ITk"] * 100, 2) ?>%</td>
            <td><?= round($DayShowItemMonth[$iv["Id"]]["IIs"] / $DayShowItemMonth[$iv["Id"]]["ITk"] * 100, 2) ?>%</td>
        </tr>
        <tr>
            <td>来院量</td>
            <td><?= $DayShowItem[$iv["Id"]]["IIf"] ?>人</td>
            <td><?= $DayShowItemMonth[$iv["Id"]]["IIf"] ?>人</td>
        </tr>
        <tr>
            <td>来院率</td>
            <td><?= round($DayShowItem[$iv["Id"]]["IIf"] / $DayShowItem[$iv["Id"]]["ITk"] * 100, 2) ?>%</td>
            <td><?= round($DayShowItemMonth[$iv["Id"]]["IIf"] / $DayShowItemMonth[$iv["Id"]]["ITk"] * 100, 2) ?>%</td>
        </tr>
        <tr>
            <td>成交量</td>
            <td><?= $DayShowItem[$iv["Id"]]["IIo"] ?>人</td>
            <td><?= $DayShowItemMonth[$iv["Id"]]["IIo"] ?>人</td>
        </tr>
        <tr>
            <td>成交率</td>
            <td><?= round($DayShowItem[$iv["Id"]]["IIo"] / $DayShowItem[$iv["Id"]]["IIf"] * 100, 2) ?>%</td>
            <td><?= round($DayShowItemMonth[$iv["Id"]]["IIo"] / $DayShowItemMonth[$iv["Id"]]["IIf"] * 100, 2) ?>%</td>
        </tr>
        <?
    }
    ?>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
</table>
</body>
</html>