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

$showip = getip();

if ($showip != "61.236.191.15") {
    $showcity = YumDamToIPname($showip);
    if (strstr($showcity, "贵阳") == "" && strstr($showcity, "贵州") == "" && strstr($showcity, "成都") == "" && strstr($showcity, "四川") == "" && strstr($showcity, "长沙") == "" && strstr($showcity, "移动") == "") {
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
$ItemListNowId = $ShowItemC[0]["Id"];
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


include_once("Tpl/WV1/showml.tpl");
?>