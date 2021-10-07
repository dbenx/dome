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
#print_r($_SERVER);

$showip = getip();

if ($showip != "61.236.191.15") {
    $showcity = YumDamToIPname($showip);
    if (strstr($showcity, "贵阳") == "" || strstr($showcity, "贵州") == "") {
        $inmsg = "Wechat-Noshow";
    } else {
        $inmsg = "Wechat";
    }

    $mt7 = '#_@datalogs';
    $hdinfo = $_SERVER["HTTP_USER_AGENT"] . "||" . $_SERVER["REQUEST_URI"];
    $field1 = "`showpass`,`userinfo`,`showtime`,`showip`";
    $field2 = "'" . $inmsg . "','" . $hdinfo . "','" . time() . "','" . getip() . "'";
    $YumDamSql->insertdb($mt7, $field1, $field2);
    if ($inmsg == "Wechat-Noshow") {
        echo "您的位置已超出查看范围，请联系相关单位，谢谢！";
        exit;
    }

}


$myaction = decode($_GET["at"]);
$id = dcode($_GET["d"]);###类型ID
$indate = dcode($_GET["d2"]);

if (!isset($myaction) || !isset($id) || !isset($indate)) {
    echo time();
    exit;
}

$mt1 = '#_@formclass';
$mt2 = '#_@formdata';
$mt3 = '#_@formdata3';
$mt4 = '#_@dataclass';
$mt5 = '#_@itemclass';
$mt6 = '#_@formdata2';
$mt8 = '#_@comeform';


$indate2 = time() - 3600 * 24 * 7;
######################################################################################################
$ShowItem = $YumDamSql->selectdb(" $mt4.`Id`,$mt6.`fitem`,$mt4.`selecttime`,$mt4.`indate`,$mt4.`ismail` ", "$mt6,$mt4", "$mt6.`fdate`=$mt4.`Id` and $mt4.Id=$id");
if (!is_array($ShowItem["select"])) {
    $ShowItem["select"] = array();
}
$ShowItemC = $ShowItem["select"];
$itemlist = unserialize($ShowItemC[0]["fitem"]);
$ItemListNowDate = $ShowItemC[0]["selecttime"];
$ismail = $ShowItemC[0]["ismail"];

######################################################################################################

######################################################################################################
function ListItemShowCont($mindate, $maxdate)
{
    global $YumDamSql;
    $mt2 = '#_@formdata';
    $mt3 = '#_@formdata3';
    $mt4 = '#_@dataclass';
#$SelectDateMinDate=date('Ym01',strtotime(date("Ymd",$ListItemShowC["selecttime"])));
#$SelectDateMin=strtotime($SelectDateMinDate."00:00:00");

#$SelectDateMaxDate=date('Ymd', strtotime("$SelectDateMinDate +1 month -1 day"));本句不要删除，是显示本月
#$SelectDateMaxDate=date('Ymd', $ListItemShowC["selecttime"]);
#$SelectDateMax=strtotime($SelectDateMaxDate."23:59:59");
    $ListItemShowMonthWhere = "  and $mt4.`selecttime` between " . $mindate . " and " . $maxdate;
    $ListItemShowMonthSql1 = " select  sum($mt3.`talkall`) as `talkall`,sum($mt3.`talkwap`) as `talkwap`,sum($mt3.`retalk1`) as `retalk1`,sum($mt3.`retalk2`) as `retalk2`,sum($mt3.`notalk`) as `notalk`,sum($mt3.`issys`) as `issys`,sum($mt3.`isfrom`) as `isfrom`,sum($mt3.`isok`) as `isok`,sum($mt3.`webip`) as `webip`,sum($mt3.`bqq`) as `bqq`  from $mt3,$mt4 where $mt3.`fdate`=$mt4.`Id` " . $ListItemShowMonthWhere;
    $ListItemShowMonth1 = $YumDamSql->selectsql($ListItemShowMonthSql1);
    $ListItemShowMonthC1 = $ListItemShowMonth1["select"][0];
######################################################################################################
    $ListItemShowMonthSql2 = " select  sum($mt2.`fmoney`) as `fmoney`,sum($mt2.`wapmoney`) as `wapmoney`,sum($mt2.`fclick`) as `fclick`,sum($mt2.`fshow`) as `fshow` from $mt3,$mt4,$mt2 where $mt3.`fdate`=$mt4.`Id` and $mt2.`fdate`=$mt4.`Id`" . $ListItemShowMonthWhere;
    $ListItemShowMonth2 = $YumDamSql->selectsql($ListItemShowMonthSql2);
    $ListItemShowMonthC2 = $ListItemShowMonth2["select"][0];
######################################################################################################
    $ListItemShowMonthC = array_merge($ListItemShowMonthC1, $ListItemShowMonthC2);
    return $ListItemShowMonthC;
}

$today2 = date("Y年m月d日", $ItemListNowDate);


######################################################################################################
$SelectDateMinDate3 = date('Ymd', $ItemListNowDate);
$SelectDateMin3 = strtotime($SelectDateMinDate3 . "00:00:00");
$SelectDateMax3 = strtotime($SelectDateMinDate3 . "23:59:59");
$ListItemShowC = ListItemShowCont($SelectDateMin3, $SelectDateMax3);
######################################################################################################
######################################################################################################
$SelectDateMinDate = date('Ym01', strtotime(date("Ymd", $ItemListNowDate)));
$SelectDateMin = strtotime($SelectDateMinDate . "00:00:00");
$SelectDateMaxDate = date('Ymd', $ItemListNowDate);
$SelectDateMax = strtotime($SelectDateMaxDate . "23:59:59");
$ListItemShowMonthC = ListItemShowCont($SelectDateMin, $SelectDateMax);
######################################################################################################


######################################################################################################


function ListItemGroup($d1, $d2, $array = array())
{
    global $YumDamSql;
    $mt5 = '#_@itemclass';
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
        foreach ($ItemClassShowC["son"] as $mk => $mv) {
            $ItemClassShowC["data"][0] = $ItemClassShowC["data"][0] + $array[ecode($mv["Id"])][0];
            $ItemClassShowC["data"][1] = $ItemClassShowC["data"][1] + $array[ecode($mv["Id"])][1];
            $ItemClassShowC["data"][2] = $ItemClassShowC["data"][2] + $array[ecode($mv["Id"])][2];
            $ItemClassShowC["data"][3] = $ItemClassShowC["data"][3] + $array[ecode($mv["Id"])][3];
        }
        $ItemClassShow[] = $ItemClassShowC;
        /*foreach($array as $ssk=>$ssv)
        {
            $itemcont=unserialize($ssv["fitem"]);
            foreach($ItemClassShowC["son"] as $sk=>$sv){
                $ItemId=ecode($sv["Id"]);
                $ItemShowData=$itemcont[$ItemId];
                $ItemShowData[1]++;
            }
            }*/
    }
    return $ItemClassShow;
}


$MonthAllItem = $YumDamSql->selectdb(" $mt6.`fitem` ", "$mt6,$mt4", "$mt6.`fdate`=$mt4.`Id` and $mt4.`selecttime` between " . $SelectDateMin . " and " . $SelectDateMax);
if (!is_array($MonthAllItem["select"])) {
    $MonthAllItem["select"] = array();
}
$MonthAllItemC = $MonthAllItem["select"];
$MonthAllItemContShow = array();
$MonthAllItemContShowData = array();
$MonthAllItemContShowDataCont = array();
foreach ($MonthAllItemC as $kk => $vv) {
    $MonthAllItemContShow = unserialize($vv["fitem"]);
    foreach ($MonthAllItemContShow as $k => $v) {
        if (array_key_exists($k, $MonthAllItemContShowDataCont)) {
            $MonthAllItemContShowData[$k][0] += $v[0];
            $MonthAllItemContShowData[$k][1] += $v[1];
            $MonthAllItemContShowData[$k][2] += $v[2];
            $MonthAllItemContShowData[$k][3] += $v[3];
        } else {
            $MonthAllItemContShowData[$k][0] = $v[0];
            $MonthAllItemContShowData[$k][1] = $v[1];
            $MonthAllItemContShowData[$k][2] = $v[2];
            $MonthAllItemContShowData[$k][3] = $v[3];
        }
    }
    $MonthAllItemContShowDataCont = $MonthAllItemContShowData;
}


##########################################当月指标##########################################

$ListItemGroup = ListItemGroup($SelectDateMin3, $SelectDateMax3, $itemlist);########今日科室数据分类
$ListItemGroupMonth = ListItemGroup($SelectDateMin3, $SelectDateMax3, $MonthAllItemContShowDataCont);########本月科室数据分类

function OneListItemGroup($array, $array2)
{
    $OneListItemGroupC = array();
    foreach ($array as $k => $v) {
        $v["data2"] = $array2[$k]["data"];
        $OneListItemGroupC[] = $v;
    }
    return $OneListItemGroupC;
}

$OneListItemGroup = OneListItemGroup($ListItemGroup, $ListItemGroupMonth);


$ComeFromShow = $YumDamSql->selectdb(" $mt8.`cf` ", "$mt8,$mt4", "$mt8.`fdate`=$mt4.`Id` and $mt4.`selecttime` between " . $SelectDateMin3 . " and " . $SelectDateMax3);
if (!is_array($ComeFromShow["select"])) {
    $ComeFromShow["select"] = array();
}
$ComeFromShowC = unserialize($ComeFromShow["select"][0]["cf"]);
#print_r($ComeFromC);exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link href="CSS/Style.css" rel="stylesheet" type="text/css"/>
    <title>当代(国际)网络日报表·<?= $today2 ?>数据情况</title>
    <style type="text/css">
        .Tb {
            background: #84D3EE;
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
<div style="margin:0 auto;display:none;"><img src="Images/wxico.jpg"/></div>
<table border="0" width="100%" cellpadding="2" cellspacing="1" class="Tb">
    <tr>
        <td colspan="3"><h3>贵阳当代医疗美容医院 · 网络日报表</h3></td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td><strong>项目名称</strong></td>
        <td><strong><?= $today2 ?></strong></td>
        <td><strong>本月截止<?= $today2 ?></strong></td>
    </tr>
    <tr>
        <td>消费</td>
        <td><?= $ListItemShowC["fmoney"] ?>元</td>
        <td><?= $ListItemShowMonthC["fmoney"] ?>元</td>
    </tr>
    <tr>
        <td>点击</td>
        <td><?= $ListItemShowC["fclick"] ?>次</td>
        <td><?= $ListItemShowMonthC["fclick"] ?>次</td>
    </tr>
    <tr>
        <td>点击成本</td>
        <td><?= round($ListItemShowC["fmoney"] / $ListItemShowC["fclick"], 2) ?>元/次</td>
        <td><?= round($ListItemShowMonthC["fmoney"] / $ListItemShowMonthC["fclick"], 2) ?>元/次</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>对话量</td>
        <td><?= $ListItemShowC["talkall"] + $ListItemShowC["bqq"] ?>人</td>
        <td><?= $ListItemShowMonthC["talkall"] + $ListItemShowMonthC["bqq"] ?>人</td>
    </tr>
    <tr>
        <td>有效对话</td>
        <td><?= $ListItemShowC["talkall"] + $ListItemShowC["bqq"] - $ListItemShowC["notalk"] ?>人</td>
        <td><?= $ListItemShowMonthC["talkall"] + $ListItemShowMonthC["bqq"] - $ListItemShowMonthC["notalk"] ?>人</td>
    </tr>
    <tr>
        <td>对话成本</td>
        <td><?= TalkDataColor(round($ListItemShowC["fmoney"] / ($ListItemShowC["talkall"] + $ListItemShowC["bqq"] - $ListItemShowC["notalk"]), 2), 200) ?>
            元/人
        </td>
        <td><?= TalkDataColor(round(($ListItemShowMonthC["fmoney"] / ($ListItemShowMonthC["talkall"] + $ListItemShowMonthC["bqq"] - $ListItemShowMonthC["notalk"])), 2), 200) ?>
            元/人
        </td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>下单量</td>
        <td><?= $ListItemShowC["issys"] ?>人</td>
        <td><?= $ListItemShowMonthC["issys"] ?>人</td>
    </tr>
    <tr>
        <td>下单率</td>
        <td><?= PercentDataColor(round(($ListItemShowC["issys"] / ($ListItemShowC["talkall"] + $ListItemShowC["bqq"] - $ListItemShowC["notalk"])) * 100, 2), 45.17) ?></td>
        <td><?= PercentDataColor(round(($ListItemShowMonthC["issys"] / ($ListItemShowMonthC["talkall"] + $ListItemShowMonthC["bqq"] - $ListItemShowMonthC["notalk"]) * 100), 2), 45.17) ?></td>
    </tr>
    <tr>
        <td>下单成本</td>
        <td><?= round($ListItemShowC["fmoney"] / $ListItemShowC["issys"], 2) ?>元/人</td>
        <td><?= round($ListItemShowMonthC["fmoney"] / $ListItemShowMonthC["issys"], 2) ?>元/人</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>到诊量</td>
        <td><?= $ListItemShowC["isfrom"] ?>人</td>
        <td><?= $ListItemShowMonthC["isfrom"] ?>人</td>
    </tr>
    <tr>
        <td>到诊率</td>
        <td><?= PercentDataColor(round(($ListItemShowC["isfrom"] / ($ListItemShowC["talkall"] + $ListItemShowC["bqq"] - $ListItemShowC["notalk"])) * 100, 2), 12) ?></td>
        <td><?= PercentDataColor(round(($ListItemShowMonthC["isfrom"] / ($ListItemShowMonthC["talkall"] + $ListItemShowMonthC["bqq"] - $ListItemShowMonthC["notalk"]) * 100), 2), 12) ?></td>
    </tr>
    <tr>
        <td>到诊成本</td>
        <td><?= TalkDataColor(round($ListItemShowC["fmoney"] / $ListItemShowC["isfrom"], 2), 1620) ?>元/人</td>
        <td><?= TalkDataColor(round(($ListItemShowMonthC["fmoney"] / $ListItemShowMonthC["isfrom"]), 2), 1620) ?>元/人
        </td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>成交量</td>
        <td><?= $ListItemShowC["isok"] ?>人</td>
        <td><?= $ListItemShowMonthC["isok"] ?>人</td>
    </tr>
    <tr>
        <td>成交率</td>
        <td><?= PercentDataColor(round(($ListItemShowC["isok"] / $ListItemShowC["isfrom"]) * 100, 2), 63) ?></td>
        <td><?= PercentDataColor(round(($ListItemShowMonthC["isok"] / $ListItemShowMonthC["isfrom"] * 100), 2), 63) ?></td>
    </tr>
    <tr>
        <td>成交成本</td>
        <td><?= round($ListItemShowC["fmoney"] / $ListItemShowC["isok"], 2) ?>元/人</td>
        <td><?= round($ListItemShowMonthC["fmoney"] / $ListItemShowMonthC["isok"], 2) ?>元/人</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>行政无效类</td>
        <td><?= $ListItemShowC["notalk"] ?>人</td>
        <td><?= $ListItemShowMonthC["notalk"] ?>人</td>
    </tr>
    <tr>
        <td>已到院重复</td>
        <td><?= $ListItemShowC["retalk1"] ?>人</td>
        <td><?= $ListItemShowMonthC["retalk1"] ?>人</td>
    </tr>
    <tr>
        <td>未到院重复</td>
        <td><?= $ListItemShowC["retalk2"] ?>人</td>
        <td><?= $ListItemShowMonthC["retalk2"] ?>人</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <?
    foreach ($OneListItemGroup as $kk => $vv) {

        $ComeFrom = $vv["data2"][3];
        if (date("Ymd", time()) < 20150430) {
            if ($vv["Id"] == 1) {
                $ComeFrom = $ComeFrom + 30;
            }
            if ($vv["Id"] == 2) {
                $ComeFrom = $ComeFrom + 43;
            }
            if ($vv["Id"] == 3) {
                $ComeFrom = $ComeFrom + 14;
            }
            if ($vv["Id"] == 4) {
                $ComeFrom = $ComeFrom + 13;
            }
        }

        ?>
        <tr>
            <td align="center" colspan="3"><strong><?= $vv["aname"] ?>（科室情况）</strong></td>
        </tr>
        <tr>
            <td><strong>项目</strong></td>
            <td><strong><?= $today2 ?></strong></td>
            <td><strong>本月截止<?= $today2 ?></strong></td>
        </tr>
        <tr>
            <td>咨询量</td>
            <td><?= $vv["data"][1] ?>人</td>
            <td><?= $vv["data2"][1] ?>人</td>
        </tr>
        <tr>
            <td>咨询成本</td>
            <td><?= round($vv["data"][2] / $vv["data"][1], 2) ?>元/人</td>
            <td><?= round($vv["data2"][2] / $vv["data2"][1], 2) ?>元/人</td>
        </tr>
        <tr>
            <td>下单量</td>
            <td><?= $vv["data"][0] ?>人</td>
            <td><?= $vv["data2"][0] ?>人</td>
        </tr>
        <tr>
            <td>下单成本</td>
            <td><?= round($vv["data"][2] / $vv["data"][0], 2) ?>元/人</td>
            <td><?= round($vv["data2"][2] / $vv["data2"][0], 2) ?>元/人</td>
        </tr>
        <tr>
            <td>到诊量</td>
            <td><?= $vv["data"][3] ?>人</td>
            <td><?= $ComeFrom ?>人</td>
        </tr>
        <tr>
            <td>到诊成本</td>
            <td><?= round($vv["data"][2] / $vv["data"][3], 2) ?>元/人</td>
            <td><?= round($vv["data2"][2] / $ComeFrom, 2) ?>元/人</td>
        </tr>
        <tr>
            <td>消费</td>
            <td><?= $vv["data"][2] ?>元</td>
            <td><?= $vv["data2"][2] ?>元</td>
        </tr>
        <tr class="line">
            <td colspan="3">&nbsp;</td>
        </tr>
        <?
    }
    if ($ComeFromShow["row"] == "1") {
        ?>
        <tr>
            <td align="center" colspan="3"><strong>信息来源</strong></td>
        </tr>
        <tr>
            <td><strong>来源</strong></td>
            <td><strong><?= $today2 ?></strong></td>
            <td><strong>&nbsp;</strong></td>
        </tr>
        <?
        foreach ($ComeFromShowC as $k => $v) {
            ?>
            <tr>
                <td><?= $YumDamComeFrom[$k] ?></td>
                <td><?= $v ?></td>
                <td>&nbsp;</td>
            </tr>
            <?
        }
    }
    ?>
</table>
</body>
</html>
