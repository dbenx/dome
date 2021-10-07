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

if ($YumDamGId != "1" && $YumDamGId != "3") {
    YumDamShowMsgExit("抱歉,您未获得此权限！", "./");
    exit;
}


$aid = $_GET["c"];
$updatetime = $_GET["d"];


$yestoday = time() - 3600 * 24;
$yestoday1 = ecode(date("Ymd", $yestoday));
$yestoday2 = date("Y年m月d日", $yestoday);
$yestoday3 = date('Ymd', $yestoday);
$yestodaymin = strtotime($yestoday3 . "00:00:00");
$yestodaymax = strtotime($yestoday3 . "23:59:59");
##########################################以上处理各种需要的时间############################################################
$mu = "#_@mobilelogin";
$d1 = "#_@csttempdata";
$d3 = "#_@cstdate";
##########################################以上为各种需要的表的名称#########################################################
if ($_POST) {
    $izw["tk"] = $zwtk;
    $izw["sy"] = $zwsy;
    $izw["fr"] = $zwfr;

    $iwc["tk"] = $wctk;
    $iwc["sy"] = $wcsy;
    $iwc["fr"] = $wcfr;

    $isk["tk"] = $sktk;
    $isk["sy"] = $sksy;
    $isk["fr"] = $skfr;

    $itk["tk"] = $tktk;
    $itk["sy"] = $tksy;
    $itk["fr"] = $tkfr;

    $inl["tk"] = $nltk;
    $inl["sy"] = $nlsy;
    $inl["fr"] = $nlfr;

    if (isset($m) && isset($m2) && isset($mc)) {
        $YumDamSql->updatedb($d1, "`izw`='" . serialize($izw) . "',`iwc`='" . serialize($iwc) . "',`isk`='" . serialize($isk) . "',`itk`='" . serialize($itk) . "',`notnl`='" . serialize($inl) . "',`lastdate`='" . time() . "'", "`Id`='" . dcode($m) . "' and `selecttime`='" . dcode($m2) . "'");
        echo '更新数据成功<a href="./">返回列表</a>';
        exit;
    }
    if (empty($uc)) {
        echo "数据可能已添加完成，<a href=\"./\">点击查看今日数据</a>！";
        exit;
    }
    $itime = dcode($itime);
    $thisuid = dcode($uc);
    $myintime = strtotime($itime . " 12:00:00");
    $myintimemin = strtotime($itime . " 0:0:0");
    $myintimemax = strtotime($itime . " 23:59:59");
    $sqlwhere = " `uid`='" . $thisuid . "' and `selecttime` between $myintimemin and $myintimemax";
    $IsExsit = $YumDamSql->selectdb(" `Id` ", $d1, $sqlwhere);
    if ($IsExsit["row"] == "0") {

        $field1 = "`uid`,`selecttime`,`izw`,`iwc`,`isk`,`itk`,`notnl`,`indate`,`lastdate`,`uip`";
        $field2 = "'$thisuid','$myintime','" . serialize($izw) . "','" . serialize($iwc) . "','" . serialize($isk) . "','" . serialize($itk) . "','" . serialize($inl) . "','" . time() . "','" . time() . "','" . getip() . "'";
        $IRes = $YumDamSql->insertdb($d1, $field1, $field2);
        if ($IRes["affect"] == "1") {
            echo '添加成功<a href="./indata.php">继续添加</a>';
            exit;
        } else {
            echo "添加失败";
            exit;
        }
    } else {
        echo "数据出错或系统可能已经存在该记录0011！";
        exit;
    }

}
##########################################以上为数据写入#########################################################
if (isset($aid) && isset($updatetime)) {
    $aid = dcode($aid);
    $updatetime = dcode($updatetime);
    $UpDateData = $YumDamSql->selectsql("select $d1.*,$mu.`ucname` from $d1 left join $mu on $d1.`uid`=$mu.`Id` where $d1.`Id`='$aid' and $d1.`selecttime`='$updatetime'");
    if (!is_array($UpDateData["select"])) {
        $UpDateData["select"] = array();
    }
    $UpDateDataC = $UpDateData["select"][0];
    $UpDateDataCzw = unserialize($UpDateDataC["izw"]);
    $UpDateDataCwc = unserialize($UpDateDataC["iwc"]);
    $UpDateDataCsk = unserialize($UpDateDataC["isk"]);
    $UpDateDataCtk = unserialize($UpDateDataC["itk"]);
    $UpDateDataCnl = unserialize($UpDateDataC["notnl"]);
} else {
    ##########################################以上为修改查看需要的数据#########################################################
    $IsInData = $YumDamSql->selectdb(" Id ", $d3, " $d3.`selecttime` between " . $yestodaymin . " and " . $yestodaymax);
    if ($IsInData["row"] > 0) {
        $YumDamSql->deletedb($d3, " $d3.`selecttime`<'" . ($myintimemin - 3600 * 24 * 30) . "'");##删除计时器30天以前的数据
        echo $yestoday2 . "数据已结算，请勿重复操作！<a href=\"./\">点击查看今日数据</a>！";
        exit;
    }
    #$IsInDataC=$IsInData["select"];
    #print_r($UserListC);echo "\n\n<br><br>";
    ##########################################查找记录表里是否有数据，如果有就不执行############################################################
    $UserList = $YumDamSql->selectdb(" Id,ucname ", $mu, " `usergroup`='2' and `IsDisplay`='1'");
    if (!is_array($UserList["select"])) {
        $UserList["select"] = array();
    }
    $UserListC = $UserList["select"];
    #print_r($UserListC);echo "\n\n<br><br>";
    ##########################################以上为用户数据############################################################
    $DataUserList = $YumDamSql->selectsql("select $d1.`uid` as `Id`,$mu.`ucname` from $d1 left join $mu on $d1.`uid`=$mu.`Id` where $d1.`selecttime` between " . $yestodaymin . " and " . $yestodaymax);
    if (!is_array($DataUserList["select"])) {
        $DataUserList["select"] = array();
    }
    $DataUserListC = $DataUserList["select"];
    #print_r($DataUserListC);echo "\n\n<br><br>";
    ##########################################以上为指定日期用户数据############################################################
    $DataUserListShow = array();
    foreach ($UserListC as $key => $value) {
        if (!in_array($value, $DataUserListC)) {
            $DataUserListShow[] = $value;
        }
    }
    if (count($DataUserListShow) == "0") {
        echo "数据可能已添加完成，<a href=\"./\">点击查看今日数据</a>！";
        exit;
    }
    #print_r($DataUserListShow);echo "\n\n<br><br>";
    ##########################################以上为筛选排除已存在用户数据############################################################
    $CanDateList = $YumDamSql->selectsql("select $d3.`Id`,$d3.`selecttime`,FROM_UNIXTIME($d3.`selecttime`,'%Y%m%d') as `myday` from $d3");
    if (!is_array($CanDateList["select"])) {
        $CanDateList["select"] = array();
    }
    $CanDateListC = $CanDateList["select"];
    #print_r($CanDateListC);echo "\n\n<br><br>";
    foreach ($CanDateListC as $ck => $cv) {
        $SystemDateListArray[] = $cv["myday"];
    }
    for ($i = 1; $i <= 5; $i++) {
        $ii++;
        $CanDateListArrayDay = time() - 3600 * 24 * $ii;
        $CanDateListArray[] = date("Ymd", $CanDateListArrayDay);
    }
    $CanDateListArrayShow = array_diff($CanDateListArray, $SystemDateListArray);###排除存在得记录
    #print_r($SystemDateListArray);
    #echo "\n\n<br><br>";
    #print_r($CanDateListArray);
    #echo "\n\n<br><br>";
    #print_r($CanDateListArrayShow);
    ##########################################以上为筛选可以添加数据日期############################################################

}


include_once(SiteTpl . "/indata.tpl");
?>