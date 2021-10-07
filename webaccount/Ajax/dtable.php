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
include("../../Config/Config.Inc.php");####加载配置文件

if (!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) || strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) != "xmlhttprequest") {
    echo "Er:005";
    exit;
}

#####################################################################################

$date2 = $date1 = $_GET["d1"];
#$date2=$_GET["d2"];
$myaction = decode($_GET["action"]);

if ($myaction != "list") {
    echo time() . "<br>出错!";
    exit;
}


$date1 = strtotime($date1 . "-01 00:00:00");###月第一天0时
$date2 = strtotime(date('Y-m-01 23:59:59', strtotime($date2)) . ' +1 month -1 day');###月最后一天23日


$mt1 = '#_@indata';
$mt2 = '#_@indata2';


$where = " where $mt1.`fdate` between " . $date1 . " and " . $date2 . " order by $mt1.`fdate` desc";
#echo $date1.$date2;
$ListSRes1 = $YumDamSql->selectsql("SELECT $mt1.`fdate`,$mt1.`talkall`,$mt1.`issys`,$mt1.`isfrom`,$mt1.`isok` FROM  $mt1 where $mt1.`fdate` between " . $date1 . " and " . $date2 . " order by $mt1.`fdate` desc");

##########################################################################################
$ListSRes2 = $YumDamSql->selectsql("SELECT $mt2.`fdate`,sum($mt2.`fmoney`) as `fmoney`,sum($mt2.`wapmoney`) as `allwapmoney` FROM  $mt2  where $mt2.`fdate` between " . $date1 . " and " . $date2 . " group by $mt2.`fdate` order by $mt2.`fdate` desc");


$DataListCont1 = array();
foreach ($ListSRes1["select"] as $lk => $lv) {
    $DataListCont1[timetodate($lv["fdate"], true)] = $lv;
}


$DataListCont = array();
foreach ($ListSRes2["select"] as $mk => $mv) {
    $DataListCont[] = array_merge($DataListCont1[timetodate($mv["fdate"], true)], $mv);
    #$DataListCont2[timetodate($mv["fdate"],true)]=$mv;
}

#print_r($DataListCont2);
#$DataListCont=array_merge($DataListCont1,$DataListCont2);	
$DataListCont = $DataListCont;
#print_r($DataListCont);exit;
?>
<div>
    <div style="width:80px; margin:0px 8px 15px 0px; padding:0px 5px; float:left; line-height:25px; background:#eeeeee;">
        <div>日期：<br/>星期：</div>
        <div style=" height:4px; font-size:0px; background:#791d77"></div>
        <div>
            投 入：<br/>
            咨询量：<br/>
            咨询成本：<br/>
            下单量：<br/>
            来院量：<br/>
            成交量：
        </div>
    </div>
    <?
    foreach ($DataListCont as $k => $v) {
        ?>
        <div style="width:80px; margin:0px 8px 15px 0px; padding:0px 5px; float:left; line-height:25px; background:#eeeeee;">
            <div><?= timetodate($v["fdate"], true) ?><br/><?= DateToWeek($v["fdate"]) ?></div>
            <div style=" height:4px; font-size:0px; background:#791d77"></div>
            <div><?= $v["fmoney"] ?>元<br/><?= $v["talkall"] ?>人<br/><?= round($v["fmoney"] / $v["talkall"], 2) ?>
                元/人<br/><?= $v["issys"] ?>人<br/><?= $v["isfrom"] ?>人<br/><?= $v["isok"] ?>人
            </div>
        </div>
        <?
    }
    ?>
</div>