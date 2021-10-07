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

$myaction = decode($_GET["at"]);


$mt1 = '#_@formclass';
$mt2 = '#_@formdata';
$mt3 = '#_@formdata3';
$mt4 = '#_@dataclass';
$mt5 = '#_@itemclass';
$mt6 = '#_@formdata2';

if ($myaction == "email") {
    $aid = $_GET["a"];
    $cont = $_GET["b"];
    $date = $_GET["c"];
    if ($aid == "" || $cont == "" || $date == "") {
        exit("数据出错！005");
    }
    $date = dcode($date);
    $date = date("Y年m月d日", $date);
    $aid = dcode($aid);
    $cont = decode($cont);
    $body = "<p style=\"font-weight:bold;\">您好！</p><p style=\"text-indent:40px; height:60px; line-height:60px;\"><a href=\"" . $cont . "\" target=\"_blank\">&gt;&gt;点击查看" . $date . "网络部数据报表&lt;&lt;</a><br />本链接7日内有效，请尽快查看，谢谢！</p><p style=\"text-align:right; color:#cccccc; height:40px; line-height:40px; margin:50px 0px 0px 0px; border-top:dashed 1px #666666;\">当代医疗美容医院·网络部<br />" . date("Y年m月d日 H时i分", time()) . "</p>";
    @include_once("Config/YumDam.Email.php");####加载配置文件

    #$body=file_get_contents("http://www.dangdai.cc/");

    ##########################################
    $smtpserver = "smtp.exmail.qq.com";//SMTP服务器
    $smtpserverport = 25;//SMTP服务器端口
    $smtpusermail = "dangdai@dangdai.cc";//SMTP服务器的用户邮箱
    $smtpemailto = "139169129@qq.com";//发送给谁
    $smtpuser = "dangdai@dangdai.cc";//SMTP服务器的用户帐号
    $smtppass = "?asfasfxi1003";//SMTP服务器的用户密码
    $mailsubject = "网络部" . date("Y年m月d日", time()) . "数据报表";//邮件主题
    $mailbody = $body;//邮件内容
    $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
    $smtpemailto2 = "380222560@qq.com,341613846@qq.com,383631211@qq.com,29233635@qq.com,61917291@qq.com";
    ##########################################罗洪强380222560，杨莉341613846，陈清元383631211，李家元29233635，黄天运61917291
    $smtp = new YumDamEmail($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $smtp->debug = false;//是否显示发送的调试信息
    $smtp->SendMail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype, $smtpemailto2);
    $IsEmail = $YumDamSql->updatedb($mt4, "`ismail`='2'", "`Id`='$aid'");
    echo "<font color=\"green\"><strong>恭喜您！发送成功！</strong></font>";
}
if ($myaction != "show" && $myaction != "emailshow") {
    exit;
}
$id = dcode($_GET["d"]);###类型ID
$indate = dcode($_GET["d2"]);
$indate2 = time() - 3600 * 24 * 7;
if ($indate2 - $indate > 0 && $myaction == "emailshow") {
    exit("抱歉，您的链接已过期或失效，请联系网络部！^_^");
}
if ($myaction == "emailshow") {
    $fromurl = $_SERVER['HTTP_REFERER'];
    $fromurlhost = parse_url($fromurl);
    $fromurlhost2 = $fromurlhost["host"];
    $fromurlhost3 = stristr($fromurlhost2, "qq.com");
    #echo "<div style=\"display:none\">".print_r($_SERVER)."</div>";
    /*
    if(getip()!="61.236.191.15")
    {
        exit("抱歉，您的链接已过期或失效，请联系网络部！02^_^");
        }
        */
}
if (getip() != "61.236.191.15" && $myaction != "emailshow") {
    exit("抱歉，您的链接已过期或失效，请联系网络部！03^_^");
}
##echo $indate2."--".$indate;exit;
#$formname=decode($_GET["c"]);###类型名称

######################################################################################################
$ItemShow = $YumDamSql->selectdb(" `Id`,`iname` ", $mt5, "`isshow`='1'");
#print_r($ItemShow);
if (!is_array($ItemShow["select"])) {
    $ItemShow["select"] = array();
}
$ItemShowC = $ItemShow["select"];
$ItemShowC2 = array();
foreach ($ItemShowC as $ck => $cv) {
    $ItemShowC2[$cv["Id"]] = $cv["iname"];
}
#print_r($ItemShowC2);
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

######################################################################################################
######################################################################################################
$SelectDateMinDate = date('Ym01', strtotime(date("Ymd", $ItemListNowDate)));
$SelectDateMin = strtotime($SelectDateMinDate . "00:00:00");
$SelectDateMaxDate = date('Ymd', $ItemListNowDate);
$SelectDateMax = strtotime($SelectDateMaxDate . "23:59:59");
$ListItemShowMonthC = ListItemShowCont($SelectDateMin, $SelectDateMax);
######################################################################################################
######################################################################################################
$SelectDateMinDate2 = date('Ymd', $ItemListNowDate - 3600 * 24);
$SelectDateMin2 = strtotime($SelectDateMinDate2 . "00:00:00");
$SelectDateMax2 = strtotime($SelectDateMinDate2 . "23:59:59");
$ListItemShowYesterdayC = ListItemShowCont($SelectDateMin2, $SelectDateMax2);
######################################################################################################
######################################################################################################
$SelectDateMinDate3 = date('Ymd', $ItemListNowDate);
$SelectDateMin3 = strtotime($SelectDateMinDate3 . "00:00:00");
$SelectDateMax3 = strtotime($SelectDateMinDate3 . "23:59:59");
$ListItemShowC = ListItemShowCont($SelectDateMin3, $SelectDateMax3);
######################################################################################################
######################################################################################################
$MonthAllItem = $YumDamSql->selectdb(" $mt6.`fitem` ", "$mt6,$mt4", "$mt6.`fdate`=$mt4.`Id` and $mt4.selecttime between " . $SelectDateMin . " and " . $SelectDateMax);
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
        } else {
            $MonthAllItemContShowData[$k][0] = $v[0];
            $MonthAllItemContShowData[$k][1] = $v[1];
            $MonthAllItemContShowData[$k][2] = $v[2];
        }
    }
    $MonthAllItemContShowDataCont = $MonthAllItemContShowData;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳当代医疗美容医院</title>
    <link href="CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="Scripts/yumdam.my.js"></script>
</head>

<body>
<?
@include_once("Inc/head.php");
?>
<div class="Cont">
    <?
    $today2 = date("Y年m月d日", $ItemListNowDate);
    $today3 = date("d", $ItemListNowDate);
    if ($myaction != "emailshow") {
        ?>
        <div class="Tinfo">
            <div style="float:left; margin:0px 10px 0px 0px;"><strong>您现在的位置：</strong>查看<?= $today2 ?>详细报表 | <a
                        href="./list.php">查看报表</a> | <a href="./item.php?at=list">查看项目表</a></div>
            <div style="float:left; position:relative;">
                <div><a href="javascript:;" target="_self" style="color:#F00; font-weight:bold;" onclick="ShowNote()">获取简报</a>
                </div>
                <div style="position:absolute; top:30px; left:0px; border:solid 1px #CCC; background:#eeeeee; padding:10px 5px; line-height:22px; width:300px; display:none;"
                     id="MiniRe" onmouseover="ShowNote()" onmouseout="HiddenNote()">
                    <strong><a href="javascript:;" target="_self" onclick="MyCopy()">点击复制以下内容</a> | <a
                                href="javascript:;" target="_self" style="color:#F00; font-weight:bold;"
                                onclick="HiddenNote()">关闭简报</a></strong><br/>
                    -----------------------------------------------<br/>
                    <span id="MiniReCont">
        		<?= $today2 ?>（9：00-23：59）网络数据<br/>
                -------------------综合部分-------------------<br/>
                总 咨 询：<?= $ListItemShowC["talkall"] + $ListItemShowC["bqq"] ?>个（商务通<?= $ListItemShowC["talkall"] ?>个，企业QQ<?= $ListItemShowC["bqq"] ?>个）<br/>
                有效对话：<?= $ListItemShowC["talkall"] + $ListItemShowC["bqq"] - $ListItemShowC["notalk"] ?>个（商务通<?= $ListItemShowC["talkall"] - $ListItemShowC["notalk"] ?>个，企业QQ<?= $ListItemShowC["bqq"] ?>个）<br/>
                下单：<?= $ListItemShowC["issys"] ?>个<br/>
                下单率：<?= round(($ListItemShowC["issys"] / ($ListItemShowC["talkall"] + $ListItemShowC["bqq"] - $ListItemShowC["notalk"])) * 100, 2) ?>%<br/>
                到诊：<?= $ListItemShowC["isfrom"] ?>个<br/>
                到诊率：<?= round(($ListItemShowC["isfrom"] / ($ListItemShowC["talkall"] + $ListItemShowC["bqq"] - $ListItemShowC["notalk"])) * 100, 2) ?>%<br/>
                成交：<?= $ListItemShowC["isok"] ?>个<br/>
                成交率：<?= round(($ListItemShowC["isok"] / $ListItemShowC["isfrom"]) * 100, 2) ?>%<br/>
                行政无效类：<?= $ListItemShowC["notalk"] ?>个<br/>
                已到院重复：<?= $ListItemShowC["retalk1"] ?>个<br/>
                未到院重复：<?= $ListItemShowC["retalk2"] ?>个<br/>
                -------------------咨询情况-------------------<br/>
                <?
                foreach ($itemlist as $ik => $iv) {
                    $ik1 = dcode($ik);
                    $ikshow = $ItemShowC2[$ik1];
                    if ($iv[1] > 0) {
                        ?>
                        <?= $ikshow . "：" . $iv[1] ?>个，留电：<?= $iv[0] ?>个<br/>
                        <?
                    }
                }
                ?>
                -------------------消费情况-------------------<br/>
                消费：<?= $ListItemShowC["fmoney"] ?>元<br/>
                咨询成本：<?= round($ListItemShowC["fmoney"] / ($ListItemShowC["talkall"] + $ListItemShowC["bqq"] - $ListItemShowC["notalk"]), 2) ?>元/个<br/></span>
                </div>
            </div>
            <?
            if ($ismail == "1") {
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
        <font color="green" size="+1"><strong>&gt;&gt; 以下是<?= $today2 ?>数据 &lt;&lt;</strong>&nbsp;</font>
    </div>
    <div class="Tinfo" style="text-align:center; border-bottom:solid 1px #cccccc;">
        <strong><font color="#008000">参考标准数据： 留电率45.17% &nbsp; 上门率12% &nbsp; 成交率63% &nbsp; 咨询成本200元 &nbsp;
                初诊成本：1620元</font></strong>
    </div>
    <div class="Tinfo" style="text-align:center; border-bottom:solid 1px #cccccc;"><strong>本月各指标情况</strong> - >
        业绩指标（万元）：175 [ 日：5.6 ] &nbsp; 初诊指标（人）：397 [ 日：12.8 ] &nbsp; 咨询指标（人）：3122 [ 日：100.7 ]
    </div>
    <div class="Content">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th height="30" width="8%">&nbsp;</th>
                <th width="7%">当日</th>
                <th width="7%">昨日</th>
                <th width="7%">截止当日</th>
                <th width="7%">平均</th>
                <th width="8%">&nbsp;</th>
                <th width="7%">当日</th>
                <th width="7%">昨日</th>
                <th width="7%">截止当日</th>
                <th width="3%">&nbsp;</th>
                <th width="8%">&nbsp;</th>
                <th width="7%">当日</th>
                <th width="7%">昨日</th>
                <th width="7%">截止当日</th>
                <th width="3%">&nbsp;</th>
            </tr>
            <tr>
                <td width="200" align="right" bgcolor="#CCE9F0">资金投入：</td>
                <td><?= $ListItemShowC["fmoney"] ?>元</td>
                <td><?= $ListItemShowYesterdayC["fmoney"] ?>
                    元
                </td>
                <td><?= $ListItemShowMonthC["fmoney"] ?>元</td>
                <td><?= round($ListItemShowMonthC["fmoney"] / $today3, 2) ?>元/日</td>
                <td align="right" bgcolor="#CCE9F0">手机投入：</td>
                <td><?= $ListItemShowC["wapmoney"] ?>元</td>
                <td><?= $ListItemShowYesterdayC["wapmoney"] ?>
                    元
                </td>
                <td><?= $ListItemShowMonthC["wapmoney"] ?>元</td>
                <td>&nbsp;</td>
                <td align="right" bgcolor="#CCE9F0">PC投入：</td>
                <td><?= $ListItemShowC["fmoney"] - $ListItemShowC["wapmoney"] ?>元</td>
                <td><?= $ListItemShowYesterdayC["fmoney"] - $ListItemShowYesterdayC["wapmoney"] ?>
                    元
                </td>
                <td><?= $ListItemShowMonthC["fmoney"] - $ListItemShowMonthC["wapmoney"] ?>元</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" bgcolor="#CCE9F0">点击次数：</td>
                <td><?= $ListItemShowC["fclick"] ?>次</td>
                <td><?= $ListItemShowYesterdayC["fclick"] ?>
                    次
                </td>
                <td><?= $ListItemShowMonthC["fclick"] ?>次</td>
                <td><?= round($ListItemShowMonthC["fclick"] / $today3, 2) ?>次/日</td>
                <td align="right" bgcolor="#CCE9F0">展现量：</td>
                <td><?= $ListItemShowC["fshow"] ?>次</td>
                <td><?= $ListItemShowYesterdayC["fshow"] ?>
                    次
                </td>
                <td><?= $ListItemShowMonthC["fshow"] ?>次</td>
                <td>&nbsp;</td>
                <td align="right" bgcolor="#CCE9F0">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" bgcolor="#CCE9F0">商务通对话：</td>
                <td><?= $ListItemShowC["talkall"] ?>人</td>
                <td><?= $ListItemShowYesterdayC["talkall"] ?>
                    人
                </td>
                <td><?= $ListItemShowMonthC["talkall"] ?>人</td>
                <td><?= round($ListItemShowMonthC["talkall"] / $today3, 2) ?>人/日</td>
                <td align="right" bgcolor="#CCE9F0">手机对话：</td>
                <td><?= $ListItemShowC["talkwap"] ?>人</td>
                <td><?= $ListItemShowYesterdayC["talkwap"] ?>人</td>
                <td><?= $ListItemShowMonthC["talkwap"] ?>人</td>
                <td>&nbsp;</td>
                <td align="right" bgcolor="#CCE9F0">PC对话：</td>
                <td><?= $ListItemShowC["talkall"] - $ListItemShowC["talkwap"] ?>人</td>
                <td><?= $ListItemShowYesterdayC["talkall"] - $ListItemShowYesterdayC["talkwap"] ?>
                    人
                </td>
                <td><?= $ListItemShowMonthC["talkall"] - $ListItemShowMonthC["talkwap"] ?>人</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" bgcolor="#CCE9F0">到院重复对话：</td>
                <td><?= $ListItemShowC["retalk1"] ?>人</td>
                <td><?= $ListItemShowYesterdayC["retalk1"] ?>
                    人
                </td>
                <td><?= $ListItemShowMonthC["retalk1"] ?>人</td>
                <td><?= round($ListItemShowMonthC["retalk1"] / $today3, 2) ?>人/日</td>
                <td align="right" bgcolor="#CCE9F0">未到院重复对话：</td>
                <td><?= $ListItemShowC["retalk2"] ?>人</td>
                <td><?= $ListItemShowYesterdayC["retalk2"] ?>
                    人
                </td>
                <td><?= $ListItemShowMonthC["retalk2"] ?>人</td>
                <td>&nbsp;</td>
                <td align="right" bgcolor="#CCE9F0">行政无效对话：</td>
                <td><?= $ListItemShowC["notalk"] ?>人</td>
                <td><?= $ListItemShowYesterdayC["notalk"] ?>
                    人
                </td>
                <td><?= $ListItemShowMonthC["notalk"] ?>人</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" bgcolor="#CCE9F0">下单人数：</td>
                <td><?= $ListItemShowC["issys"] ?>人</td>
                <td><?= $ListItemShowYesterdayC["issys"] ?>
                    人
                </td>
                <td><?= $ListItemShowMonthC["issys"] ?>人</td>
                <td><?= round($ListItemShowMonthC["issys"] / $today3, 2) ?>人/日</td>
                <td align="right" bgcolor="#CCE9F0">到诊人数：</td>
                <td><?= $ListItemShowC["isfrom"] ?>人</td>
                <td><?= $ListItemShowYesterdayC["isfrom"] ?>
                    人
                </td>
                <td><?= $ListItemShowMonthC["isfrom"] ?>人</td>
                <td>&nbsp;</td>
                <td align="right" bgcolor="#CCE9F0">成交人数：</td>
                <td><?= $ListItemShowC["isok"] ?>人</td>
                <td><?= $ListItemShowYesterdayC["isok"] ?>
                    人
                </td>
                <td><?= $ListItemShowMonthC["isok"] ?>人</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" bgcolor="#CCE9F0">网站访问量：</td>
                <td><?= $ListItemShowC["webip"] ?>次</td>
                <td><?= $ListItemShowYesterdayC["webip"] ?>
                    次
                </td>
                <td><?= $ListItemShowMonthC["webip"] ?>次</td>
                <td><?= round($ListItemShowMonthC["webip"] / $today3, 2) ?>次/日</td>
                <td align="right" bgcolor="#CCE9F0">企业QQ对话：</td>
                <td><?= $ListItemShowC["bqq"] ?>人</td>
                <td><?= $ListItemShowYesterdayC["bqq"] ?>
                    人
                </td>
                <td><?= $ListItemShowMonthC["bqq"] ?>人</td>
                <td>&nbsp;</td>
                <td bgcolor="#CCE9F0">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="15">&nbsp;</td>
            </tr>
            <tr>
                <td align="right" bgcolor="#CCE9F0">有效对话：</td>
                <td><?= $ListItemShowC["talkall"] + $ListItemShowC["bqq"] - $ListItemShowC["notalk"] ?>人<br/>
                    (企业QQ<?= $ListItemShowC["bqq"] ?>人)
                </td>
                <td><?= $ListItemShowYesterdayC["talkall"] + $ListItemShowYesterdayC["bqq"] - $ListItemShowYesterdayC["notalk"] ?>
                    人<br/>
                    (企业QQ
                    <?= $ListItemShowYesterdayC["bqq"] ?>
                    人)
                </td>
                <td><?= $ListItemShowMonthC["talkall"] + $ListItemShowMonthC["bqq"] - $ListItemShowMonthC["notalk"] ?>
                    人<br/>
                    (企业QQ<?= $ListItemShowMonthC["bqq"] ?>人)
                </td>
                <td><?= round(($ListItemShowMonthC["talkall"] + $ListItemShowMonthC["bqq"] - $ListItemShowMonthC["notalk"]) / $today3, 2) ?>
                    人/日
                </td>
                <td align="right" bgcolor="#CCE9F0">对话成本：</td>
                <td><?= round(($ListItemShowC["fmoney"] / $ListItemShowC["talkall"]), 2) ?>元</td>
                <td><?= round(($ListItemShowYesterdayC["fmoney"] / $ListItemShowYesterdayC["talkall"]), 2) ?>元</td>
                <td><?= round(($ListItemShowMonthC["fmoney"] / $ListItemShowMonthC["talkall"]), 2) ?>元</td>
                <td>&nbsp;</td>
                <td align="right" bgcolor="#CCE9F0">初诊成本：</td>
                <td><?= round(($ListItemShowC["fmoney"] / $ListItemShowC["isfrom"]), 2) ?>元</td>
                <td><?= round(($ListItemShowYesterdayC["fmoney"] / $ListItemShowYesterdayC["isfrom"]), 2) ?>元</td>
                <td><?= round(($ListItemShowMonthC["fmoney"] / $ListItemShowMonthC["isfrom"]), 2) ?>元</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" bgcolor="#CCE9F0">下单率：</td>
                <td><?= PercentDataColor(round(($ListItemShowC["issys"] / ($ListItemShowC["talkall"] - $ListItemShowC["notalk"]) * 100), 2), 45.17) ?></td>
                <td><?= PercentDataColor(round(($ListItemShowYesterdayC["issys"] / ($ListItemShowYesterdayC["talkall"] - $ListItemShowYesterdayC["notalk"]) * 100), 2), 45.17) ?></td>
                <td><?= PercentDataColor(round(($ListItemShowMonthC["issys"] / ($ListItemShowMonthC["talkall"] - $ListItemShowMonthC["notalk"]) * 100), 2), 45.17) ?>
                </td>
                <td>&nbsp;</td>
                <td align="right" bgcolor="#CCE9F0">到诊率：</td>
                <td><?= PercentDataColor(round(($ListItemShowC["isfrom"] / ($ListItemShowC["talkall"] - $ListItemShowC["notalk"]) * 100), 2), 12) ?></td>
                <td><?= PercentDataColor(round(($ListItemShowYesterdayC["isfrom"] / ($ListItemShowYesterdayC["talkall"] - $ListItemShowYesterdayC["notalk"]) * 100), 2), 12) ?></td>
                <td><?= PercentDataColor(round(($ListItemShowMonthC["isfrom"] / ($ListItemShowMonthC["talkall"] - $ListItemShowMonthC["notalk"]) * 100), 2), 12) ?></td>
                <td>&nbsp;</td>
                <td align="right" bgcolor="#CCE9F0">成交率：</td>
                <td><?= PercentDataColor(round(($ListItemShowC["isok"] / $ListItemShowC["isfrom"] * 100), 2), 63) ?></td>
                <td><?= PercentDataColor(round(($ListItemShowYesterdayC["isok"] / $ListItemShowYesterdayC["isfrom"] * 100), 2), 63) ?></td>
                <td><?= PercentDataColor(round(($ListItemShowMonthC["isok"] / $ListItemShowMonthC["isfrom"] * 100), 2), 63) ?></td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <div class="clearit"></div>
    </div>
    <div class="Content" style="border-top:solid 1px #999999; margin:20px 0px 0px 0px; padding:20px 0px 0px 0px;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th height="30">编号</th>
                <th>日期</th>
                <th>账户类型</th>
                <th>资金投入</th>
                <th>手机投入</th>
                <th>PC投入</th>
                <th>点击次数</th>
                <th>展现量</th>
                <th>点击价格</th>
            </tr>
            <?
            $ListSRes = $YumDamSql->selectsql("SELECT $mt4.`selecttime`,$mt4.`indate`,$mt2.`fmoney`,$mt2.`wapmoney`,$mt2.`fclick`,$mt2.`fshow`,$mt1.`cname` FROM  $mt4,$mt2,$mt1 where $mt4.`Id`=$mt2.`fdate` and $mt2.`fclass`=$mt1.`Id` and $mt4.`Id`=$id order by $mt4.`Id` desc,$mt4.`selecttime` desc");
            if (!is_array($ListSRes["select"])) {
                $ListSRes["select"] = array();
            }
            $List = $ListSRes["select"];
            foreach ($List as $lk => $lv) {
                $i++;
                ?>
                <tr>
                    <td align="center"><?= $i ?></td>
                    <td align="center" bgcolor="#CAE8F2"><?= timetodate($lv["selecttime"], true) ?></td>
                    <td align="center"><?= $lv["cname"] ?></td>
                    <td align="center" bgcolor="#CAE8F2"><?= $lv["fmoney"] ?>元</td>
                    <td align="center"><?= $lv["wapmoney"] ?>元</td>
                    <td align="center" bgcolor="#CAE8F2"><?= $lv["fmoney"] - $lv["wapmoney"] ?>元</td>
                    <td align="center"><?= $lv["fclick"] ?>次</td>
                    <td align="center" bgcolor="#CAE8F2"><?= $lv["fshow"] ?>次</td>
                    <td align="center"><?= round($lv["fmoney"] / $lv["fclick"], 2) ?>元</td>
                </tr>
                <?
            }
            ?>
            <tr>
                <td colspan="2" align="center">&nbsp;</td>
                <td align="center"><strong>当日全账户</strong></td>
                <td align="center" bgcolor="#CAE8F2"><?= $ListItemShowC["fmoney"] ?>元</td>
                <td align="center"><?= $ListItemShowC["wapmoney"] ?>元</td>
                <td align="center" bgcolor="#CAE8F2"><?= $ListItemShowC["fmoney"] - $ListItemShowC["wapmoney"] ?>元</td>
                <td align="center"><?= $ListItemShowC["fclick"] ?>次</td>
                <td align="center" bgcolor="#CAE8F2"><?= $ListItemShowC["fshow"] ?>次</td>
                <td align="center"><?= round($ListItemShowC["fmoney"] / $ListItemShowC["fclick"], 2) ?>元</td>
            </tr>
        </table>
    </div>
    <div class="Content" style="border-top:solid 1px #999999; margin:20px 0px 0px 0px; padding:20px 0px 0px 0px;">
        <div class="Item"><strong>项目：<br/>咨询量：<br/>下单量：<br/>消费：<br/>咨询单体：</strong></div>
        <?
        #print_r($ItemShowC);
        foreach ($itemlist as $ik => $iv) {
            $ss++;
            ?>
            <div class="Item<? if ($ss % 2 == 1) {
                echo " Item2";
            } ?>">
                <?
                $ik1 = dcode($ik);
                $ikshow = $ItemShowC2[$ik1];
                $onetalkprice = round(($iv[2] / $iv[1]), 2);
                if ($onetalkprice > 200) {
                    $onetalkprice = "<font color=\"#FF0000\"><strong>" . $onetalkprice . "</strong></font>";
                }
                if ($onetalkprice < 150 && $onetalkprice > 0) {
                    $onetalkprice = "<font color=\"#008000\"><strong>" . $onetalkprice . "</strong></font>";
                }
                if ($iv[1] > 0) {
                    echo $ikshow . "<br />" . $iv[1] . "人<br />" . $iv[0] . "人<br />" . $iv[2] . "元<br />" . $onetalkprice . "元";
                }
                ?>
            </div>
            <?
        }
        ?>
        <div class="clearit"></div>
    </div>
    <div class="Tinfo" style="text-align:center; margin:15px 0px 0px 0px;">
        <font color="green" size="+1"><strong>&gt;&gt; 以下是截止<?= $today2 ?>项目数据 &lt;&lt;</strong>&nbsp;</font>
    </div>
    <div class="Content" style="border-top:solid 1px #999999; margin:20px 0px 0px 0px; padding:20px 0px 0px 0px;">
        <div class="Item"><strong>项目：<br/>咨询量：<br/>下单量：<br/>消费：<br/>咨询单体：</strong></div>
        <?
        #print_r($ItemShowC);
        foreach ($MonthAllItemContShowDataCont as $ik => $iv) {
            $ss++;
            ?>
            <div class="Item<? if ($ss % 2 == 1) {
                echo " Item2";
            } ?>">
                <?
                $ik1 = dcode($ik);
                $ikshow = $ItemShowC2[$ik1];
                $onetalkprice = round(($iv[2] / $iv[1]), 2);
                if ($onetalkprice > 200) {
                    $onetalkprice = "<font color=\"#FF0000\"><strong>" . $onetalkprice . "</strong></font>";
                }
                if ($onetalkprice < 150 && $onetalkprice > 0) {
                    $onetalkprice = "<font color=\"#008000\"><strong>" . $onetalkprice . "</strong></font>";
                }
                if ($iv[1] > 0) {
                    echo $ikshow . "<br />" . $iv[1] . "人<br />" . $iv[0] . "人<br />" . $iv[2] . "元<br />" . $onetalkprice . "元";
                }
                ?>
            </div>
            <?
        }
        ?>
        <div class="clearit"></div>
    </div>
    <?
    if ($ismail == "1") {
        ?>
        <div class="ContBtn" id="ToEmail">
            <a href="javascript:;" name="Email" class="inputbtn"
               onclick="ToEmail('<?= ecode($ShowItemC[0]["Id"]) ?>','<?= encode("http://i.dangdai.cc/webaccount/m.php?at=" . encode("emailshow") . "&d=" . ecode($ShowItemC[0]["Id"]) . "&d2=" . ecode($ShowItemC[0]["indate"])) ?>','<?= ecode($ShowItemC[0]["indate"]) ?>')">发送报表</a>
        </div>
        <?
    }
    ?>
    <div class="clearit"></div>
</div>
<script type="text/javascript">
    <?
    if($ismail == "1")
    {
    ?>
    function ToEmail(a, b, c) {
        if (!confirm('确定要发送邮件吗?')) {
            return false;
        }
        var a = a;
        var b = b;
        if (a == "" || b == "") {
            return false;
        }
        var url = "m.php?at=<?=encode("email")?>&a=" + a + "&b=" + b + "&c=" + c + "&r=" + Math.random();
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
    ?>
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