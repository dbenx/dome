<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳美莱医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body oncontextmenu="return false;">
<?
#@include_once("Inc/head.php");
?>
<div class="Cont">
    <?
	$today2=date("Y年m月d日",$ItemListNowDate);
	$today3=date("d",$ItemListNowDate);
	if($myaction!="emailshow")
	{
	?>
    <div class="Tinfo">
        <div style="float:left; margin:0px 10px 0px 0px;"><strong>您现在的位置：</strong>查看<?=$today2?>详细报表 | <a
                    href="./list.php">查看报表</a> | <a href="./item.php?at=list">查看项目表</a></div>
        <div style="float:left; position:relative;">
            <div><a href="javascript:;" target="_self" style="color:#F00; font-weight:bold;"
                    onclick="ShowNote()">获取简报</a></div>
            <div style="position:absolute; top:30px; left:0px; border:solid 1px #CCC; background:#eeeeee; padding:10px 5px; line-height:22px; width:300px; display:none;"
                 id="MiniRe" onmouseover="ShowNote()" onmouseout="HiddenNote()">
                <strong><a href="javascript:;" target="_self" onclick="MyCopy()">点击复制以下内容</a> | <a href="javascript:;"
                                                                                                   target="_self"
                                                                                                   style="color:#F00; font-weight:bold;"
                                                                                                   onclick="HiddenNote()">关闭简报</a></strong><br/>
                -----------------------------------------------<br/>
                <span id="MiniReCont">
        		<?=$today2?>（9：00-23：59）网络数据<br/>
                -------------------综合部分-------------------<br/>
                总 咨 询：<?=$ListItemShowC["talkall"]+$ListItemShowC["bqq"]?>个（商务通<?=$ListItemShowC["talkall"]?>
                    个，企业QQ<?=$ListItemShowC["bqq"]?>个）<br/>
                有效对话：<?=$ListItemShowC["talkall"]+$ListItemShowC["bqq"]-$ListItemShowC["notalk"]?>
                    个（商务通<?=$ListItemShowC["talkall"]-$ListItemShowC["notalk"]?>个，企业QQ<?=$ListItemShowC["bqq"]?>个）<br/>
                下单：<?=$ListItemShowC["issys"]?>个<br/>
                下单率：<?=round(($ListItemShowC["issys"]/($ListItemShowC["talkall"]+$ListItemShowC["bqq"]-$ListItemShowC["notalk"]))*100,2)?>
                    %<br/>
                到诊：<?=$ListItemShowC["isfrom"]?>个<br/>
                到诊率：<?=round(($ListItemShowC["isfrom"]/($ListItemShowC["talkall"]+$ListItemShowC["bqq"]-$ListItemShowC["notalk"]))*100,2)?>
                    %<br/>
                成交：<?=$ListItemShowC["isok"]?>个<br/>
                成交率：<?=round(($ListItemShowC["isok"]/$ListItemShowC["isfrom"])*100,2)?>%<br/>
                行政无效类：<?=$ListItemShowC["notalk"]?>个<br/>
                已到院重复：<?=$ListItemShowC["retalk1"]?>个<br/>
                未到院重复：<?=$ListItemShowC["retalk2"]?>个<br/>
                -------------------咨询情况-------------------<br/>
                    <?
                foreach($itemlist as $ik=>$iv)
				{
				$ik1=dcode($ik);
				$ikshow=$ItemShowC2[$ik1];
				if($iv[1]>0)
				{
				?>
                    <?=$ikshow."：".$iv[1]?>个，留电：<?=$iv[0]?>个<br/>
                    <?
				}
				}
				?>
                    -------------------消费情况-------------------<br/>
                消费：<?=$ListItemShowC["fmoney"]?>元<br/>
                咨询成本：<?=round($ListItemShowC["fmoney"]/($ListItemShowC["talkall"]+$ListItemShowC["bqq"]-$ListItemShowC["notalk"]),2)?>
                    元/个<br/></span>
            </div>
            <!--
        	<div style="position:absolute; top:30px; left:0px; border:solid 1px #CCC; background:#eeeeee; padding:10px 5px; line-height:22px; width:500px; display:none;" id="MiniRe" onmouseover="ShowNote()" onmouseout="HiddenNote()">
            <strong><a href="javascript:;" target="_self" onclick="MyCopy()">点击复制以下内容</a> | <a href="javascript:;" target="_self" style="color:#F00; font-weight:bold;" onclick="HiddenNote()">关闭简报</a></strong><br />
            	-----------------------------------------------<br />
            <span id="MiniReCont">
        		以下是<?=$today2?>（9：00-23：59）网络数据<br />
                -------------------综合部分-------------------<br />
                总 消 费：<?=$ListItemShowC["fmoney"]?>元<br />
                总 点 击：<?=$ListItemShowC["fclick"]?>次<br />
                点击成本：<?=round($ListItemShowC["fmoney"]/$ListItemShowC["fclick"],2)?>元/次<br />
                <br />
                总 咨 询：<?=$ListItemShowC["talkall"]+$ListItemShowC["bqq"]?>人（商务通<?=$ListItemShowC["talkall"]?>人，企业QQ<?=$ListItemShowC["bqq"]?>人）<br />
                有效对话：<?=$ListItemShowC["talkall"]+$ListItemShowC["bqq"]-$ListItemShowC["notalk"]?>人（商务通<?=$ListItemShowC["talkall"]-$ListItemShowC["notalk"]?>人，企业QQ<?=$ListItemShowC["bqq"]?>人）<br />
                咨询成本：<?=round($ListItemShowC["fmoney"]/($ListItemShowC["talkall"]+$ListItemShowC["bqq"]-$ListItemShowC["notalk"]),2)?>元/人<br />
                <br />
                下单：<?=$ListItemShowC["issys"]?>人<br />
                下单率：<?=round(($ListItemShowC["issys"]/($ListItemShowC["talkall"]+$ListItemShowC["bqq"]-$ListItemShowC["notalk"]))*100,2)?>%<br />
                下单成本：<?=round($ListItemShowC["fmoney"]/$ListItemShowC["issys"],2)?>元/人<br />
                <br />
                到诊：<?=$ListItemShowC["isfrom"]?>人<br />
                到诊率：<?=round(($ListItemShowC["isfrom"]/($ListItemShowC["talkall"]+$ListItemShowC["bqq"]-$ListItemShowC["notalk"]))*100,2)?>%<br />
                到诊成本：<?=round($ListItemShowC["fmoney"]/$ListItemShowC["isfrom"],2)?>元/人<br />
                <br />
                成交：<?=$ListItemShowC["isok"]?>人<br />
                成交率：<?=round(($ListItemShowC["isok"]/$ListItemShowC["isfrom"])*100,2)?>%<br />
                成交成本：<?=round($ListItemShowC["fmoney"]/$ListItemShowC["isok"],2)?>元/人<br />
                <br />
                行政无效类：<?=$ListItemShowC["notalk"]?>人<br />
                已到院重复：<?=$ListItemShowC["retalk1"]?>人<br />
                未到院重复：<?=$ListItemShowC["retalk2"]?>人<br />
                -------------------咨询情况-------------------<br />
                <?
                foreach($itemlist as $ik=>$iv)
				{
				$ik1=dcode($ik);
				$ikshow=$ItemShowC2[$ik1];
				if($iv[1]>0)
				{
				?>
                <?=$ikshow."：".$iv[1]?>人，留电：<?=$iv[0]?>人<br />
                <?
				}
				}
				?>
                -------------------科室情况-------------------<br />
                <?
				foreach($ListItemGroup as $kk=>$vv)
				{
					echo $vv["aname"]."<br />咨询量：".$vv["data"][1]."人<br />咨询成本：".round($vv["data"][2]/$vv["data"][1],2)."元/人<br />下单量：".$vv["data"][0]."人<br />下单成本：".round($vv["data"][2]/$vv["data"][0],2)."元/人<br />到诊量：".$vv["data"][3]."人<br />到诊成本：".round($vv["data"][2]/$vv["data"][3],2)."元/人<br />消费：".$vv["data"][2]."元 <br /><br />";
					}
				?>
                <br />
                ----------------------------------------------------------------<br />
                以下是本月截止<?=$today2?>网络部分数据<br />
                ----------------------------------------------------------------<br />
                总消费：<?=$ListItemShowMonthC["fmoney"]?>元<br />
                总点击：<?=$ListItemShowMonthC["fclick"]?>次<br />
                点击成本：<?=round($ListItemShowMonthC["fmoney"]/$ListItemShowMonthC["fclick"],2)?>元/次<br />
                <br />
                总对话：<?=$ListItemShowMonthC["talkall"]+$ListItemShowMonthC["bqq"]?>人<br />
                咨询单体：<?=round(($ListItemShowMonthC["fmoney"]/($ListItemShowMonthC["talkall"]+$ListItemShowMonthC["bqq"])),2)?>元/人<br />
                <br />
                总下单：<?=$ListItemShowMonthC["issys"]?>人<br />
                下单成本：<?=round($ListItemShowMonthC["fmoney"]/$ListItemShowMonthC["issys"],2)?>元/人<br />
                下单率：<?=round(($ListItemShowMonthC["issys"]/($ListItemShowMonthC["talkall"]+$ListItemShowMonthC["bqq"]-$ListItemShowMonthC["notalk"])*100),2)?>%<br />
                <br />
                总到诊：<?=$ListItemShowMonthC["isfrom"]?>人<br />
                到诊成本：<?=round(($ListItemShowMonthC["fmoney"]/$ListItemShowMonthC["isfrom"]),2)?>元/人<br />
                到诊率：<?=round(($ListItemShowMonthC["isfrom"]/($ListItemShowMonthC["talkall"]+$ListItemShowMonthC["bqq"]-$ListItemShowMonthC["notalk"])*100),2)?>%<br />
                <br />
                总成交：<?=$ListItemShowMonthC["isok"]?>人<br />
                成交成本：<?=round($ListItemShowMonthC["fmoney"]/$ListItemShowMonthC["isok"],2)?>元/人<br />
                成交率：<?=round(($ListItemShowMonthC["isok"]/$ListItemShowMonthC["isfrom"]*100),2)?>%<br />
                <br />
                <?
				foreach($ListItemGroupMonth as $kk=>$vv)
				{
					
				  $isfrom=$vv["data"][3];
				  if(date("Ymd",time())<20150430)
				  {
				  if($vv["Id"]==1)
				  {
					  $isfrom=$isfrom+30;
					  }
				  if($vv["Id"]==2)
				  {
					  $isfrom=$isfrom+43;
					  }
				  if($vv["Id"]==3)
				  {
					  $isfrom=$isfrom+14;
					  }
				  if($vv["Id"]==4)
				  {
					  $isfrom=$isfrom+13;
					  }
				  }
					echo $vv["aname"]."<br />咨询量：".$vv["data"][1]."人<br />咨询成本：".round($vv["data"][2]/$vv["data"][1],2)."元/人<br />下单量：".$vv["data"][0]."人<br />下单成本：".round($vv["data"][2]/$vv["data"][0],2)."元/人<br />到诊量：".$isfrom."人<br />到诊成本：".round($vv["data"][2]/$isfrom,2)."元/人<br />消费：".$vv["data"][2]."元 <br /><br />";
					
					#echo $vv["aname"]." ( 咨询量：".$vv["data"][1]."人&nbsp;|&nbsp;咨询成本：".round($vv["data"][2]/$vv["data"][1],2)."元/人&nbsp;|&nbsp;下单量：".$vv["data"][0]."人&nbsp;|&nbsp;下单成本：".round($vv["data"][2]/$vv["data"][0],2)."元/人&nbsp;|&nbsp;到诊量：".$vv["data"][3]."人&nbsp;|&nbsp;到诊成本：".round($vv["data"][2]/$vv["data"][3],2)."元/人&nbsp;|&nbsp;消费：".$vv["data"][2]."元 )<br>";
					}
				?>
            </span>
        	</div>
            
            -->
        </div>
        <?
        if($ismail=="1")
		{
		?>
        <div style="float:left; position:relative; padding:0px 0px 0px 15px;">
            <a href="#Email" target="_self" style=" color:#00F; font-weight:bold;">您还没有发送邮件报表！</a>
        </div>
        <?
		}
		?>
    </div>
    <?
	}
	?>
    <div class="Tinfo" style="text-align:center; border-bottom:solid 1px #cccccc;">
        <font color="green" size="+1"><strong>&gt;&gt; 以下是<?=$today2?>数据 &lt;&lt;</strong>&nbsp;</font>
    </div>
    <div class="Tinfo" style="text-align:center; border-bottom:solid 1px #cccccc;">
        <strong><font color="#008000">参考标准数据： 留电率45.17% &nbsp; 上门率12% &nbsp; 成交率63% &nbsp; 咨询成本200元 &nbsp;
                初诊成本：1620元</font></strong>
    </div>
    <?
    if($myaction!="emailshow")
	{
	?>
    <div class="Tinfo" style="text-align:center; border-bottom:solid 1px #cccccc;"><?=$ThisMonthTaskShow?></div>
    <?
	}
	?>
    <div class="Content">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#cdd1d1">
                <th height="35" width="100">&nbsp;</th>
                <th>资金投入</th>
                <th bgcolor="#cdd1d1">手机投入</th>
                <th>PC投入</th>
                <th>点击次数</th>
                <th>展现量</th>
                <th>商务通对话</th>
                <th>手机对话</th>
                <th>PC对话</th>
                <th>到院重复对话</th>
                <th>未到院重复对话</th>
                <th>行政无效对话</th>
            </tr>
            <tr>
                <th bgcolor="#e3e3e3">当日</th>
                <td><?=$ListItemShowC["fmoney"]?>元</td>
                <td><?=$ListItemShowC["wapmoney"]?>元</td>
                <td><?=$ListItemShowC["fmoney"]-$ListItemShowC["wapmoney"]?>元</td>
                <td><?=$ListItemShowC["fclick"]?>次</td>
                <td><?=$ListItemShowC["fshow"]?>次</td>
                <td><?=$ListItemShowC["talkall"]?>人</td>
                <td><?=$ListItemShowC["talkwap"]?>人</td>
                <td><?=$ListItemShowC["talkall"]-$ListItemShowC["talkwap"]?>人</td>
                <td><?=$ListItemShowC["retalk1"]?>人</td>
                <td><?=$ListItemShowC["retalk2"]?>人</td>
                <td><?=$ListItemShowC["notalk"]?>人</td>
            </tr>
            <tr>
                <th bgcolor="#e3e3e3">昨日</th>
                <td><?=$ListItemShowYesterdayC["fmoney"]?>元</td>
                <td><?=$ListItemShowYesterdayC["wapmoney"]?>元</td>
                <td><?=$ListItemShowYesterdayC["fmoney"]-$ListItemShowYesterdayC["wapmoney"]?>元</td>
                <td><?=$ListItemShowYesterdayC["fclick"]?>次</td>
                <td><?=$ListItemShowYesterdayC["fshow"]?>次</td>
                <td><?=$ListItemShowYesterdayC["talkall"]?>人</td>
                <td><?=$ListItemShowYesterdayC["talkwap"]?>人</td>
                <td><?=$ListItemShowYesterdayC["talkall"]-$ListItemShowYesterdayC["talkwap"]?>人</td>
                <td><?=$ListItemShowYesterdayC["retalk1"]?>人</td>
                <td><?=$ListItemShowYesterdayC["retalk2"]?>人</td>
                <td><?=$ListItemShowYesterdayC["notalk"]?>人</td>
            </tr>
            <tr>
                <th bgcolor="#e3e3e3">截止</th>
                <td><?=$ListItemShowMonthC["fmoney"]?>元</td>
                <td><?=$ListItemShowMonthC["wapmoney"]?>元</td>
                <td><?=$ListItemShowMonthC["fmoney"]-$ListItemShowMonthC["wapmoney"]?>元</td>
                <td><?=$ListItemShowMonthC["fclick"]?>次</td>
                <td><?=$ListItemShowMonthC["fshow"]?>次</td>
                <td><?=$ListItemShowMonthC["talkall"]?>人</td>
                <td><?=$ListItemShowMonthC["talkwap"]?>人</td>
                <td><?=$ListItemShowMonthC["talkall"]-$ListItemShowMonthC["talkwap"]?>人</td>
                <td><?=$ListItemShowMonthC["retalk1"]?>人</td>
                <td><?=$ListItemShowMonthC["retalk2"]?>人</td>
                <td><?=$ListItemShowMonthC["notalk"]?>人</td>
            </tr>
            <tr>
                <th bgcolor="#e3e3e3">平均</th>
                <td><?=round($ListItemShowMonthC["fmoney"]/$today3,2)?>元/日</td>
                <td><?=round($ListItemShowMonthC["wapmoney"]/$today3,2)?>元/日</td>
                <td><?=round(($ListItemShowMonthC["fmoney"]-$ListItemShowMonthC["wapmoney"])/$today3,2)?>元/日</td>
                <td><?=round($ListItemShowMonthC["fclick"]/$today3,2)?>次/日</td>
                <td><?=round($ListItemShowMonthC["fshow"]/$today3,2)?>次/日</td>
                <td><?=round($ListItemShowMonthC["talkall"]/$today3,2)?>人/日</td>
                <td><?=round($ListItemShowMonthC["talkwap"]/$today3,2)?>人/日</td>
                <td><?=round(($ListItemShowMonthC["talkall"]-$ListItemShowMonthC["talkwap"])/$today3,2)?>人/日</td>
                <td><?=round($ListItemShowMonthC["retalk1"]/$today3,2)?>人/日</td>
                <td><?=round($ListItemShowMonthC["retalk2"]/$today3,2)?>人</td>
                <td><?=round($ListItemShowMonthC["notalk"]/$today3,2)?>人</td>
            </tr>
            <tr>
                <th colspan="12" height="20">&nbsp;</th>
            </tr>
            <tr bgcolor="#cdd1d1">
                <th height="35">&nbsp;</th>
                <th bgcolor="#cdd1d1">有效对话</th>
                <th bgcolor="#cdd1d1">下单人数</th>
                <th bgcolor="#cdd1d1">下单率</th>
                <th bgcolor="#cdd1d1">对话成本</th>
                <th bgcolor="#cdd1d1">到诊人数</th>
                <th bgcolor="#cdd1d1">到诊率</th>
                <th bgcolor="#cdd1d1">到诊成本</th>
                <th bgcolor="#cdd1d1">成交人数</th>
                <th bgcolor="#cdd1d1">成交率</th>
                <th bgcolor="#cdd1d1">成交成本</th>
                <th bgcolor="#cdd1d1">网站访问量</th>
            </tr>
            <tr>
                <th bgcolor="#e3e3e3">当日</th>
                <td><?=$ListItemShowC["talkall"]+$ListItemShowC["bqq"]-$ListItemShowC["notalk"]?>人</td>
                <td><?=$ListItemShowC["issys"]?>人</td>
                <td><?=PercentDataColor(round(($ListItemShowC["issys"]/($ListItemShowC["talkall"]-$ListItemShowC["notalk"])*100),2),45.17)?></td>
                <td><?=TalkDataColor(round(($ListItemShowC["fmoney"]/($ListItemShowC["talkall"]+$ListItemShowC["bqq"])),2),200)?>
                    元/人
                </td>
                <td><?=$ListItemShowC["isfrom"]?>人</td>
                <td><?=PercentDataColor(round(($ListItemShowC["isfrom"]/($ListItemShowC["talkall"]-$ListItemShowC["notalk"])*100),2),12)?></td>
                <td><?=TalkDataColor(round(($ListItemShowC["fmoney"]/$ListItemShowC["isfrom"]),2),1620)?>元/人</td>
                <td><?=$ListItemShowC["isok"]?>人</td>
                <td><?=PercentDataColor(round(($ListItemShowC["isok"]/$ListItemShowC["isfrom"]*100),2),63)?></td>
                <td><?=round($ListItemShowC["fmoney"]/$ListItemShowC["isok"],2)?>元/人</td>
                <td><?=$ListItemShowC["webip"]?>次</td>
            </tr>
            <tr>
                <th bgcolor="#e3e3e3">昨日</th>
                <td><?=$ListItemShowYesterdayC["talkall"]+$ListItemShowYesterdayC["bqq"]-$ListItemShowYesterdayC["notalk"]?>
                    人
                </td>
                <td><?=$ListItemShowYesterdayC["issys"]?>人</td>
                <td><?=PercentDataColor(round(($ListItemShowYesterdayC["issys"]/($ListItemShowYesterdayC["talkall"]-$ListItemShowYesterdayC["notalk"])*100),2),45.17)?></td>
                <td><?=TalkDataColor(round(($ListItemShowYesterdayC["fmoney"]/($ListItemShowYesterdayC["talkall"]+$ListItemShowYesterdayC["bqq"])),2),200)?>
                    元/人
                </td>
                <td><?=$ListItemShowYesterdayC["isfrom"]?>人</td>
                <td><?=PercentDataColor(round(($ListItemShowYesterdayC["isfrom"]/($ListItemShowYesterdayC["talkall"]+$ListItemShowYesterdayC["bqq"]-$ListItemShowYesterdayC["notalk"])*100),2),12)?></td>
                <td><?=TalkDataColor(round(($ListItemShowYesterdayC["fmoney"]/$ListItemShowYesterdayC["isfrom"]),2),1620)?>
                    元/人
                </td>
                <td><?=$ListItemShowYesterdayC["isok"]?>人</td>
                <td><?=PercentDataColor(round(($ListItemShowYesterdayC["isok"]/$ListItemShowYesterdayC["isfrom"]*100),2),63)?></td>
                <td><?=round($ListItemShowYesterdayC["fmoney"]/$ListItemShowYesterdayC["isok"],2)?>元/人</td>
                <td><?=$ListItemShowYesterdayC["webip"]?>次</td>
            </tr>
            <tr>
                <th bgcolor="#e3e3e3">截止</th>
                <td><?=$ListItemShowMonthC["talkall"]+$ListItemShowMonthC["bqq"]-$ListItemShowMonthC["notalk"]?>人</td>
                <td><?=$ListItemShowMonthC["issys"]?>人</td>
                <td><?=PercentDataColor(round(($ListItemShowMonthC["issys"]/($ListItemShowMonthC["talkall"]-$ListItemShowMonthC["notalk"])*100),2),45.17)?></td>
                <td><?=TalkDataColor(round(($ListItemShowMonthC["fmoney"]/($ListItemShowMonthC["talkall"]+$ListItemShowMonthC["bqq"]-$ListItemShowMonthC["notalk"])),2),200)?>
                    元/人
                </td>
                <td><?=$ListItemShowMonthC["isfrom"]?>人</td>
                <td><?=PercentDataColor(round(($ListItemShowMonthC["isfrom"]/($ListItemShowMonthC["talkall"]+$ListItemShowMonthC["bqq"]-$ListItemShowMonthC["notalk"])*100),2),12)?></td>
                <td><?=TalkDataColor(round(($ListItemShowMonthC["fmoney"]/$ListItemShowMonthC["isfrom"]),2),1620)?>元/人
                </td>
                <td><?=$ListItemShowMonthC["isok"]?>人</td>
                <td><?=PercentDataColor(round(($ListItemShowMonthC["isok"]/$ListItemShowMonthC["isfrom"]*100),2),63)?></td>
                <td><?=round($ListItemShowMonthC["fmoney"]/$ListItemShowMonthC["isok"],2)?>元/人</td>
                <td><?=$ListItemShowMonthC["webip"]?>次</td>
            </tr>
            <tr>
                <th bgcolor="#e3e3e3">平均</th>
                <td><?=round(($ListItemShowMonthC["talkall"]+$ListItemShowMonthC["bqq"]-$ListItemShowMonthC["notalk"])/$today3,2)?>
                    人
                </td>
                <td><?=round($ListItemShowMonthC["issys"]/$today3,2)?>人</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?=round($ListItemShowMonthC["isfrom"]/$today3,2)?>人</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?=round($ListItemShowMonthC["isok"]/$today3,2)?>人</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?=round($ListItemShowMonthC["webip"]/$today3,2)?>次</td>
            </tr>
        </table>

        <div class="clearit"></div>
    </div>
    <div class="Content" style="border-top:solid 1px #999999; margin:20px 0px 0px 0px; padding:20px 0px 0px 0px;">

        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr bgcolor="#cdd1d1">
                <th height="35" width="100">编号</th>
                <th>日期</th>
                <th>账户类型</th>
                <th>资金投入</th>
                <th>对话成本</th>
                <th>手机投入</th>
                <th>PC投入</th>
                <th>点击次数</th>
                <th>点击价格</th>
                <th>展现量</th>
            </tr>

            <?
		$ListSRes=$YumDamSql->selectsql("SELECT
            $mt4.`selecttime`,$mt4.`indate`,$mt2.`fmoney`,$mt2.`wapmoney`,$mt2.`fclick`,$mt2.`fshow`,$mt1.`cname` FROM
            $mt4,$mt2,$mt1 where $mt4.`Id`=$mt2.`fdate` and $mt2.`fclass`=$mt1.`Id` and $mt4.`Id`=$id order by $mt4.`Id`
            desc,$mt4.`selecttime` desc");
            if(!is_array($ListSRes["select"]))
            {
            $ListSRes["select"]=array();
            }
            $List=$ListSRes["select"];
            foreach($List as $lk=>$lv)
            {
            $i++;
            ?>
            <tr>
                <td align="center" bgcolor="#e3e3e3"><?=$i?></td>
                <td align="center"><?=timetodate($lv["selecttime"],true)?></td>
                <td align="center"><?=$lv["cname"]?></td>
                <td align="center"><?=$lv["fmoney"]?>元</td>
                <td align="center">&nbsp;</td>
                <td align="center"><?=$lv["wapmoney"]?>元</td>
                <td align="center"><?=$lv["fmoney"]-$lv["wapmoney"]?>元</td>
                <td align="center"><?=$lv["fclick"]?>次</td>
                <td align="center"><?=round($lv["fmoney"]/$lv["fclick"],2)?>元/次</td>
                <td align="center"><?=$lv["fshow"]?>次</td>
            </tr>

            <?
			}
	  ?>
            <tr>
                <td colspan="2" align="center">&nbsp;</td>
                <td align="center"><strong>当日全账户</strong></td>
                <td align="center"><?=$ListItemShowC["fmoney"]?>元</td>
                <td align="center">&nbsp;</td>
                <td align="center"><?=$ListItemShowC["wapmoney"]?>元</td>
                <td align="center"><?=$ListItemShowC["fmoney"]-$ListItemShowC["wapmoney"]?>元</td>
                <td align="center"><?=$ListItemShowC["fclick"]?>次</td>
                <td align="center"><?=round($ListItemShowC["fmoney"]/$ListItemShowC["fclick"],2)?>元/次</td>
                <td align="center"><?=$ListItemShowC["fshow"]?>次</td>
            </tr>
        </table>
    </div>
    <div class="Content" style="border-top:solid 1px #999999; margin:20px 0px 0px 0px; padding:20px 0px 0px 0px;">
        <div class="ItemL">
            <div class="Item"><strong>项目：<br/>咨询量：<br/>下单量：<br/>到诊量：<br/>消费：<br/>咨询单体：</strong></div>
            <div class="clearit"></div>
        </div>
        <div class="ItemR">
            <?
		#print_r($itemlist);
        foreach($itemlist as $ik=>$iv)
            {
            $ss++;
            ?>
            <div class="Item<? if($ss%2==1){echo " Item2";}?>">
                <?
                $ik1=dcode($ik);
                $ikshow=$ItemShowC2[$ik1];
                $onetalkprice=round(($iv[2]/$iv[1]),2);
                if($onetalkprice>200)
                {
                $onetalkprice="<font color=\"#FF0000\"><strong>".$onetalkprice."</strong></font>";
                }
                if($onetalkprice<150&&$onetalkprice>0)
                {
                $onetalkprice="<font color=\"#008000\"><strong>".$onetalkprice."</strong></font>";
                }
                if($iv[1]>0)
                {
                echo $ikshow."<br/>".$iv[1]."人<br/>".$iv[0]."人<br/>".$iv[3]."<br/>".$iv[2]."元<br/>".$onetalkprice."元";
                }
                ?>
            </div>
            <?
            }
            ?>
            <div class="clearit"></div>
        </div>
        <div class="clearit"></div>
    </div>
    <div class="Content" style="margin:15px 0px 0px 0px; line-height:30px; background:#CCCCCC;">
        <?
	foreach($ListItemGroup as $kk=>$vv)
        {
        echo $vv["aname"]." ( 咨询量：".$vv["data"][1]."人&nbsp;|&nbsp;咨询成本：".round($vv["data"][2]/$vv["data"][1],2)."元/人&nbsp;|&nbsp;下单量：".$vv["data"][0]."人&nbsp;|&nbsp;下单成本：".round($vv["data"][2]/$vv["data"][0],2)."元/人&nbsp;|&nbsp;到诊量：".$vv["data"][3]."人&nbsp;|&nbsp;到诊成本：".round($vv["data"][2]/$vv["data"][3],2)."元/人&nbsp;|&nbsp;消费：".$vv["data"][2]."元
        )<br>";
        }
        ?>
    </div>
    <div class="Content" style="margin:15px 0px 0px 0px; line-height:35px; background:#CCCCCC;">
        <strong>今日信息来源：</strong><br/>
        <?
	foreach($OneListComeFrom as $k=>$v)
        {
        echo $YumDamComeFrom[$k]." : ".$v["data1"]."&nbsp;&nbsp;";
        }
        ?>
    </div>
    <div class="Tinfo" style="text-align:center; margin:15px 0px 0px 0px;">
        <font color="green" size="+1"><strong>&gt;&gt; 以下是本月截止<?=$today2?>项目数据 &lt;&lt;</strong>&nbsp;</font>
    </div>
    <div class="Content" style="border-top:solid 1px #999999; margin:20px 0px 0px 0px; padding:20px 0px 0px 0px;">
        <div class="ItemL">
            <div class="Item"><strong>项目：<br/>咨询量：<br/>下单量：<br/>到诊量：<br/>消费：<br/>咨询单体：</strong></div>
            <div class="clearit"></div>
        </div>
        <div class="ItemR">
            <?
            #print_r($MonthAllItemContShowDataCont);
            foreach($MonthAllItemContShowDataCont as $ik=>$iv)
            {
            $ss++;
            ?>
            <div class="Item<? if($ss%2==1){echo " Item2";}?>">
                <?
                $ik1=dcode($ik);
                $ikshow=$ItemShowC2[$ik1];
                $onetalkprice=round(($iv[2]/$iv[1]),2);
                if($onetalkprice>200)
                {
                $onetalkprice="<font color=\"#FF0000\"><strong>".$onetalkprice."</strong></font>";
                }
                if($onetalkprice<150&&$onetalkprice>0)
                {
                $onetalkprice="<font color=\"#008000\"><strong>".$onetalkprice."</strong></font>";
                }
                if($iv[1]>0)
                {
                echo $ikshow."|日"."<br/>".$iv[1]."|".round($iv[1]/$today3,2)."人<br/>".$iv[0]."|".round($iv[0]/$today3,2)."人<br/>".$iv[3]."
                | ".round($iv[3]/$today3,2)."<br/>".$iv[2]."|".round($iv[2]/$today3,2)."元<br/>".$onetalkprice."元";
                }
                ?>
            </div>
            <?
            }
            ?>
            <div class="clearit"></div>
        </div>
        <div class="clearit"></div>
    </div>
    <div class="Content" style="margin:15px 0px 0px 0px; line-height:30px; background:#CCCCCC;">
        <?
	foreach($ListItemGroupMonth as $kk=>$vv)
        {
        echo $vv["aname"]." ( 咨询量：".$vv["data"][1]."人&nbsp;|&nbsp;咨询成本：".round($vv["data"][2]/$vv["data"][1],2)."元/人&nbsp;|&nbsp;下单量：".$vv["data"][0]."人&nbsp;|&nbsp;下单成本：".round($vv["data"][2]/$vv["data"][0],2)."元/人&nbsp;|&nbsp;到诊量：".$vv["data"][3]."人&nbsp;|&nbsp;到诊成本：".round($vv["data"][2]/$vv["data"][3],2)."元/人&nbsp;|&nbsp;消费：".$vv["data"][2]."元
        )<br>";
        }
        ?>
    </div>
    <div class="Content" style="margin:15px 0px 0px 0px; line-height:35px; background:#CCCCCC;">
        <strong>本月信息来源：</strong><br/>
        <?
	foreach($OneListComeFrom as $k=>$v)
        {
        echo $YumDamComeFrom[$k]." : ".$v["data2"]."&nbsp;&nbsp;";
        }
        ?>
    </div>
    <?
    if($ismail=="1")
	{
	?>
    <div class="ContBtn" id="ToEmail">
        <a href="javascript:;" name="Email" class="inputbtn" onclick="ToEmail('<?=ecode($ShowItemC[0]["
           Id"])?>','<?=encode("http://i.dangdai.cc/webaccount/m.php?at=".encode("emailshow")."&d=".ecode($ShowItemC[0]["Id"])."&d2=".ecode($ShowItemC[0]["indate"]))?>
        ','<?=ecode($ShowItemC[0]["indate"])?>')">发送报表</a>
    </div>
    <?
	}
		?>
    <div class="clearit"></div>
</div>
<script type="text/javascript">
    <?
if ($ismail == "1") {
        ?
>

    function ToEmail(a, b, c) {
        if (!confirm('确定要发送邮件吗?')) {
            return false;
        }
        var a = a;
        var b = b;
        if (a == "" || b == "") {
            return false;
        }
        var url = "m.php?at=<?=encode("
        email
        ")?>&a=" + a + "&b=" + b + "&c=" + c + "&r=" + Math.random();
        //alert(url);
        document.getElementById("ToEmail").innerHTML = "系统正在处理中……";
        request.open("GET", url, true);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                document.getElementById("ToEmail").innerHTML = response;
            } else {
                document.getElementById("ToEmail").innerHTML = "系统正在处理中……";
            }
        }
        request.send(null);
    }

    <?
}
        ?
    >

    function ShowNote() {
        document.getElementById("MiniRe").style.display = "block";
    }

    function HiddenNote() {
        document.getElementById("MiniRe").style.display = "none";
    }

    function MyCopy() {
        var copy = document.getElementById("MiniReCont").innerText;
        if (window.clipboardData) {
            window.clipboardData.setData("Text", copy);
        } else if (window.netscape) {
            netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');
            var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
            //if (!clip) return;
            var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
            //if (!trans) return;
            trans.addDataFlavor('text/unicode');
            var str = new Object();
            var len = new Object();
            var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
            var copytext = copy;
            str.data = copytext;
            trans.setTransferData("text/unicode", str, copytext.length * 2);
            var clipid = Components.interfaces.nsIClipboard;
            clip.setData(trans, null, clipid.kGlobalClipboard);
        }
    }
</script>
</body>
</html>