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

$myat = decode($_GET["ma"]);
$myte = dcode($_GET["ie"]);


$mu = "#_@mobilelogin";
$d1 = "#_@csttempdata";
$d2 = "#_@cstdata";
$d3 = "#_@cstdate";
##########################################以上为各种需要的表的名称#########################################################
if ($myat == "ins") {
    $mytimeday = date("Ymd", $myte);
    $myintimemin = strtotime($mytimeday . " 0:0:0");
    $myintimemax = strtotime($mytimeday . " 23:59:59");

    $InDataList = $YumDamSql->selectsql("select $d1.`uid`,$d1.`selecttime`,$d1.`izw`,$d1.`iwc`,$d1.`isk`,$d1.`itk`,$d1.`notnl`,$d1.`indate`,$d1.`lastdate`,$d1.`uip` from $d1 where $d1.`selecttime` between $myintimemin and $myintimemax");
    if (!is_array($InDataList["select"])) {
        $InDataList["select"] = array();
    }
    $InDataListC = $InDataList["select"];

    if ($InDataList["row"] <= 0) {
        echo "系统里未发现数据，<a href=\"./?ma=" . encode("list") . "\">查看数据</a>";
        exit;
    }

    foreach ($InDataListC as $ik => $iv) {
        $selecttime = date('Ymd', $iv["selecttime"]);
        $selecttimemin = strtotime($selecttime . "00:00:00");
        $selecttimemax = strtotime($selecttime . "23:59:59");
        $sqlwhere = " `uid`='" . $iv["uid"] . "' and `selecttime` between $selecttimemin and $selecttimemax";
        $IsExsit = $YumDamSql->selectdb(" `Id` ", $d2, $sqlwhere);
        if ($IsExsit["row"] == "0") {
            $itemdata = array();
            $itemdata["izw"] = unserialize($iv["izw"]);
            $itemdata["iwc"] = unserialize($iv["iwc"]);
            $itemdata["isk"] = unserialize($iv["isk"]);
            $itemdata["itk"] = unserialize($iv["itk"]);
            $itemdata["notnl"] = unserialize($iv["notnl"]);
            $field1 = "`uid`,`selecttime`,`itemdata`,`indate`,`lastdate`,`indatatime`,`uip`";
            $field2 = "'" . $iv["uid"] . "','" . $iv["selecttime"] . "','" . serialize($itemdata) . "','" . $iv["indate"] . "','" . $iv["lastdate"] . "','" . time() . "','" . getip() . "'";
            $InData = $YumDamSql->insertdb($d2, $field1, $field2);
        }
    }
    $YumDamSql->deletedb($d1, " $d1.`selecttime` between $myintimemin and $myintimemax");##删除临时数据
    $refield1 = "`uid`,`selecttime`,`indate`,`lastdate`,`uip`";
    $refield2 = "'0','" . $myte . "','" . time() . "','" . time() . "','" . getip() . "'";
    $ReInData = $YumDamSql->insertdb($d3, $refield1, $refield2);###记录操作
    echo "数据导入成功，<a href=\"./?ma=list\">查看临时数据</a>";
    exit;
}
##########################################以上为结算处理，将临时数据加入正式数据#########################################################
$UserList = $YumDamSql->selectdb(" Id,ucname ", $mu, " `usergroup`='2' and `IsDisplay`='1'");
if (!is_array($UserList["select"])) {
    $UserList["select"] = array();
}
$UserListC = $UserList["select"];
#print_r($UserListC);echo "\n\n<br><br>";
##########################################以上为用户数据############################################################
if ($myat == "list") {
    @header("Location:./item.php?" . $_SERVER["QUERY_STRING"]);
    /*
    $DataList=$YumDamSql->selectsql("select $d2.`Id`,$d2.`selecttime`,$d2.`itemdata`,$d2.`indate`,$mu.`ucname`,count($d2.`uid`) as `re` from $d2 left join $mu on $d2.`uid`=$mu.`Id` group by $mu.`Id`,$d2.`selecttime` WITH ROLLUP");
    if(!is_array($DataList["select"]))
    {
        $DataList["select"]=array();
    }
    $DataListC=$DataList["select"];
    #print_r($DataUserListC);echo "\n\n<br><br>";
    include_once(SiteTpl."/listdata.tpl");###此处模板没有效果
    */
    exit;
}
##########################################以上为指定日期正式用户数据############################################################
$TempDataList = $YumDamSql->selectsql("select $d1.`Id`,FROM_UNIXTIME($d1.`selecttime`,'%Y%m%d') as `myday`,$d1.`selecttime`,count($d1.`selecttime`) as `ts`,$d1.`izw`,$d1.`iwc`,$d1.`isk`,$d1.`itk`,$d1.`notnl`,$d1.`indate`,$mu.`ucname` from $d1 left join $mu on $d1.`uid`=$mu.`Id` group by $d1.`selecttime`,$d1.`Id` WITH ROLLUP");
if (!is_array($TempDataList["select"])) {
    $TempDataList["select"] = array();
}
$TempDataListC = $TempDataList["select"];
#print_r($DataUserListC);echo "\n\n<br><br>";
##########################################以上为指定日期临时用户数据############################################################
include_once(SiteTpl . "/listtempdata.tpl");
?>