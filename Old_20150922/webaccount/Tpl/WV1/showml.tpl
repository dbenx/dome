<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>贵阳美莱网络日报表·<?=$today2?>数据情况</title>
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
        <td colspan="3"><h3>贵阳美莱医学美容医院 · 网络日报表</h3></td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td><strong>项目名称</strong></td>
        <td><strong><?=$today2?></strong></td>
        <td><strong>本月截止<?=$today2?></strong></td>
    </tr>
    <tr>
        <td>消费</td>
        <td><?=$ListItemShowC["fmoney"]?>元</td>
        <td><?=$ListItemShowMonthC["fmoney"]?>元</td>
    </tr>
    <tr>
        <td>点击</td>
        <td><?=$ListItemShowC["fclick"]?>次</td>
        <td><?=$ListItemShowMonthC["fclick"]?>次</td>
    </tr>
    <tr>
        <td>点击成本</td>
        <td><?=round($ListItemShowC["fmoney"]/$ListItemShowC["fclick"],2)?>元/次</td>
        <td><?=round($ListItemShowMonthC["fmoney"]/$ListItemShowMonthC["fclick"],2)?>元/次</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>对话量</td>
        <td><?=$ListItemShowC["talkall"]+$ListItemShowC["bqq"]?>人</td>
        <td><?=$ListItemShowMonthC["talkall"]+$ListItemShowMonthC["bqq"]?>人</td>
    </tr>
    <tr>
        <td>有效对话</td>
        <td><?=$ListItemShowC["talkall"]+$ListItemShowC["bqq"]-$ListItemShowC["notalk"]?>人</td>
        <td><?=$ListItemShowMonthC["talkall"]+$ListItemShowMonthC["bqq"]-$ListItemShowMonthC["notalk"]?>人</td>
    </tr>
    <tr>
        <td>对话成本</td>
        <td><?=TalkDataColor(round($ListItemShowC["fmoney"]/($ListItemShowC["talkall"]+$ListItemShowC["bqq"]-$ListItemShowC["notalk"]),2),200)?>
            元/人
        </td>
        <td><?=TalkDataColor(round(($ListItemShowMonthC["fmoney"]/($ListItemShowMonthC["talkall"]+$ListItemShowMonthC["bqq"]-$ListItemShowMonthC["notalk"])),2),200)?>
            元/人
        </td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>下单量</td>
        <td><?=$ListItemShowC["issys"]?>人</td>
        <td><?=$ListItemShowMonthC["issys"]?>人</td>
    </tr>
    <tr>
        <td>下单率</td>
        <td><?=PercentDataColor(round(($ListItemShowC["issys"]/($ListItemShowC["talkall"]+$ListItemShowC["bqq"]-$ListItemShowC["notalk"]))*100,2),45.17)?></td>
        <td><?=PercentDataColor(round(($ListItemShowMonthC["issys"]/($ListItemShowMonthC["talkall"]+$ListItemShowMonthC["bqq"]-$ListItemShowMonthC["notalk"])*100),2),45.17)?></td>
    </tr>
    <tr>
        <td>下单成本</td>
        <td><?=round($ListItemShowC["fmoney"]/$ListItemShowC["issys"],2)?>元/人</td>
        <td><?=round($ListItemShowMonthC["fmoney"]/$ListItemShowMonthC["issys"],2)?>元/人</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>到诊量</td>
        <td><?=$ListItemShowC["isfrom"]?>人</td>
        <td><?=$ListItemShowMonthC["isfrom"]?>人</td>
    </tr>
    <tr>
        <td>到诊率</td>
        <td><?=PercentDataColor(round(($ListItemShowC["isfrom"]/($ListItemShowC["talkall"]+$ListItemShowC["bqq"]-$ListItemShowC["notalk"]))*100,2),12)?></td>
        <td><?=PercentDataColor(round(($ListItemShowMonthC["isfrom"]/($ListItemShowMonthC["talkall"]+$ListItemShowMonthC["bqq"]-$ListItemShowMonthC["notalk"])*100),2),12)?></td>
    </tr>
    <tr>
        <td>到诊成本</td>
        <td><?=TalkDataColor(round($ListItemShowC["fmoney"]/$ListItemShowC["isfrom"],2),1620)?>元/人</td>
        <td><?=TalkDataColor(round(($ListItemShowMonthC["fmoney"]/$ListItemShowMonthC["isfrom"]),2),1620)?>元/人</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>成交量</td>
        <td><?=$ListItemShowC["isok"]?>人</td>
        <td><?=$ListItemShowMonthC["isok"]?>人</td>
    </tr>
    <tr>
        <td>成交率</td>
        <td><?=PercentDataColor(round(($ListItemShowC["isok"]/$ListItemShowC["isfrom"])*100,2),63)?></td>
        <td><?=PercentDataColor(round(($ListItemShowMonthC["isok"]/$ListItemShowMonthC["isfrom"]*100),2),63)?></td>
    </tr>
    <tr>
        <td>成交成本</td>
        <td><?=round($ListItemShowC["fmoney"]/$ListItemShowC["isok"],2)?>元/人</td>
        <td><?=round($ListItemShowMonthC["fmoney"]/$ListItemShowMonthC["isok"],2)?>元/人</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td>行政无效类</td>
        <td><?=$ListItemShowC["notalk"]?>人</td>
        <td><?=$ListItemShowMonthC["notalk"]?>人</td>
    </tr>
    <tr>
        <td>已到院重复</td>
        <td><?=$ListItemShowC["retalk1"]?>人</td>
        <td><?=$ListItemShowMonthC["retalk1"]?>人</td>
    </tr>
    <tr>
        <td>未到院重复</td>
        <td><?=$ListItemShowC["retalk2"]?>人</td>
        <td><?=$ListItemShowMonthC["retalk2"]?>人</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <?
  foreach($OneListItemGroup as $kk=>$vv)
    {

    $ComeFrom=$vv["data2"][3];
    if(date("Ymd",time())<20150430)
    {
    if($vv["Id"]==1)
    {
    $ComeFrom=$ComeFrom+30;
    }
    if($vv["Id"]==2)
    {
    $ComeFrom=$ComeFrom+43;
    }
    if($vv["Id"]==3)
    {
    $ComeFrom=$ComeFrom+14;
    }
    if($vv["Id"]==4)
    {
    $ComeFrom=$ComeFrom+13;
    }
    }

    ?>
    <tr>
        <td align="center" colspan="3"><strong><?=$vv["aname"]?>（科室情况）</strong></td>
    </tr>
    <tr>
        <td><strong>项目</strong></td>
        <td><strong><?=$today2?></strong></td>
        <td><strong>本月截止<?=$today2?></strong></td>
    </tr>
    <tr>
        <td>咨询量</td>
        <td><?=$vv["data"][1]?>人</td>
        <td><?=$vv["data2"][1]?>人</td>
    </tr>
    <tr>
        <td>咨询成本</td>
        <td><?=round($vv["data"][2]/$vv["data"][1],2)?>元/人</td>
        <td><?=round($vv["data2"][2]/$vv["data2"][1],2)?>元/人</td>
    </tr>
    <tr>
        <td>下单量</td>
        <td><?=$vv["data"][0]?>人</td>
        <td><?=$vv["data2"][0]?>人</td>
    </tr>
    <tr>
        <td>下单成本</td>
        <td><?=round($vv["data"][2]/$vv["data"][0],2)?>元/人</td>
        <td><?=round($vv["data2"][2]/$vv["data2"][0],2)?>元/人</td>
    </tr>
    <tr>
        <td>到诊量</td>
        <td><?=$vv["data"][3]?>人</td>
        <td><?=$ComeFrom?>人</td>
    </tr>
    <tr>
        <td>到诊成本</td>
        <td><?=round($vv["data"][2]/$vv["data"][3],2)?>元/人</td>
        <td><?=round($vv["data2"][2]/$ComeFrom,2)?>元/人</td>
    </tr>
    <tr>
        <td>消费</td>
        <td><?=$vv["data"][2]?>元</td>
        <td><?=$vv["data2"][2]?>元</td>
    </tr>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <?
  }
  if($ComeFromShow["row"]=="1")
  {
  ?>
    <tr>
        <td align="center" colspan="3"><strong>信息来源</strong></td>
    </tr>
    <tr>
        <td><strong>来源</strong></td>
        <td><strong><?=$today2?></strong></td>
        <td><strong>本月截止<?=$today2?></strong></td>
    </tr>
    <?
  foreach($OneListComeFrom as $k=>$v)
    {
    ?>
    <tr>
        <td><?=$YumDamComeFrom[$k]?></td>
        <td><?=$v["data1"]?></td>
        <td><?=$v["data2"]?></td>
    </tr>
    <?
  }
  }
  ?>
    <tr class="line">
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3"><strong>您不想说点什么吗？</strong><font color="#CCCCCC">在下框里输入您想说的！</font></td>
    </tr>
    <tr>
        <td colspan="3" style="height:80px;"><textarea id="mct"
                                                       style="width:90%; height:70px; font-weight:bold; line-height:22px; border:solid 1px #eeeeee; padding:5px; margin:5px 0px;"></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="3" id="sda"><input type="button" value="保存" id="mytb"/></td>
    </tr>
    <script type="text/javascript">
        function tomybook() {
            var c1 = document.getElementById("mct").value;
            var c2 = "<?=encode(ecode($ItemListNowId))?>";
            if (c1 == "" || c1 == "0" || c1.length < 2 || c2 == "" || c2 == "0") {
                return false;
            }
            var url = "./Ajax/ToBook?m=<?=encode("
            tbk
            ")?>&c1=" + encodeURI(c1) + "&c2=" + encodeURI(c2) + "&r=" + Math.random();
            request.open("GET", url, true);
            document.getElementById("sda").innerHTML = "保存中……";
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var response = request.responseText;
                    document.getElementById("sda").innerHTML = "<font color=green>我们很重视您的反馈，谢谢！</font>";
                }
            }
            request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            request.send(null);
        }

        document.getElementById("mytb").onclick = tomybook;
    </script>
</table>
</body>
</html>
