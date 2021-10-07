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
#print_r($_SERVER);

$myaction = decode($_GET["at"]);


$mt1 = '#_@formclass';
$mt2 = '#_@formdata';
$mt3 = '#_@formdata3';
$mt4 = '#_@dataclass';
$mt5 = '#_@itemclass';
$mt6 = '#_@formdata2';
$mt7 = '#_@task';
$mt8 = '#_@comeform';

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
    $body = "<p style=\"font-weight:bold;\">您好！</p><p style=\"text-indent:40px; height:60px; line-height:60px;\"><a href=\"" . $cont . "\" target=\"_blank\">&gt;&gt;点击查看" . $date . "网络部数据报表&lt;&lt;</a><br />本链接7日内有效，请尽快查看，谢谢！</p><p style=\"text-align:right; color:#cccccc; height:40px; line-height:40px; margin:50px 0px 0px 0px; border-top:dashed 1px #666666;\">美莱医疗美容医院·网络部<br />" . date("Y年m月d日 H时i分", time()) . "</p>";
    @include_once("../Config/YumDam.Email.php");####加载配置文件

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
    $smtpemailto2 = "61917291@qq.com,15655989@qq.com";
    ##########################################罗洪强380222560，杨莉341613846，陈清元383631211，李家元29233635，黄天运61917291，黄高伟19899279,美莱卢总15655989
    $smtp = new YumDamEmail($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);//这里面的一人true是表示使用身份验证,否则不使用身份验证.
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
#if(getip()!="61.236.191.15"&&$myaction!="emailshow")
#{
#exit("抱歉，您的链接已过期或失效，请联系网络部！03^_^");
#}
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

#############################################################################################


$IsThisMonth = date("Ym", time());
$IsThisMinMonth = date("Ym", $SelectDateMin);
$IsThisMaxMonth = date("Ym", $SelectDateMax);
$ThisMonthTaskShow = "暂未获取到月指标相关数据！";
if ($IsThisMinMonth == $IsThisMonth && $IsThisMaxMonth == $IsThisMonth) {
    $ThisMonthTask = $YumDamSql->selectdb(" $mt7.`ymonth`,$mt7.`outm`*10000 as outm,$mt7.`inputm`*10000 as inputm,$mt7.`firstcome`,$mt7.`talkm` ", "$mt7", "$mt7.`ymonth` between " . $SelectDateMin . " and " . $SelectDateMax);
    if ($ThisMonthTask["row"] == 1) {
        $ThisMonthTaskSelect = $ThisMonthTask["select"][0];
        $ThisDays = date("t");
        $ThisMonthTaskShow = "<strong>本月（" . date("Y年m月", $ThisMonthTaskSelect["ymonth"]) . "）各指标情况</strong> - > 业绩指标（万元）：" . round($ThisMonthTaskSelect["outm"] / 10000, 2) . " [ 日：" . round($ThisMonthTaskSelect["outm"] / 10000 / $ThisDays, 2) . " ] &nbsp; 初诊指标（人）：" . $ThisMonthTaskSelect["firstcome"] . " [ 日：" . round($ThisMonthTaskSelect["firstcome"] / $ThisDays, 2) . " ] &nbsp; 咨询指标（人）：" . $ThisMonthTaskSelect["talkm"] . " [ 日：" . round($ThisMonthTaskSelect["talkm"] / $ThisDays, 2) . " ]";
    }
}
##########################################当月指标##########################################

#######################################################################################################################信息来源情况


$MonthComeFrom = $YumDamSql->selectdb(" $mt8.`cf` ", "$mt8,$mt4", "$mt8.`fdate`=$mt4.`Id` and $mt4.`selecttime` between " . $SelectDateMin . " and " . $SelectDateMax);
if (!is_array($MonthComeFrom["select"])) {
    $MonthComeFrom["select"] = array();
}
$MonthComeFromC = $MonthComeFrom["select"];
foreach ($MonthComeFromC as $kk => $vv) {
    $MonthComeFromContShow = unserialize($vv["cf"]);
    foreach ($YumDamComeFrom as $ck => $cv) {
        $MyCf[$ck] = $MyCf[$ck] + $MonthComeFromContShow[$ck];
    }
}


$ComeFromShow = $YumDamSql->selectdb(" $mt8.`cf` ", "$mt8,$mt4", "$mt8.`fdate`=$mt4.`Id` and $mt4.`selecttime` between " . $SelectDateMin3 . " and " . $SelectDateMax3);
if (!is_array($ComeFromShow["select"])) {
    $ComeFromShow["select"] = array();
}
$ComeFromShowC = unserialize($ComeFromShow["select"][0]["cf"]);
function OneListComeFrom($array, $array2)
{
    $OneListItemGroupC = array();
    foreach ($array as $k => $v) {
        $mv["data1"] = $array[$k];
        $mv["data2"] = $array2[$k];
        $OneListItemGroupC[$k] = $mv;
    }
    return $OneListItemGroupC;
}

$OneListComeFrom = OneListComeFrom($ComeFromShowC, $MyCf);
#######################################################################################################################信息来源情况


include_once("Tpl/WV1/showpc.tpl");
?>