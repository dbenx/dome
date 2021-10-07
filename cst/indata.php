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

if ($YumDamGId != "1" && $YumDamGId != "2" && $YumDamGId != "4") {
    YumDamShowMsgExit("抱歉,您未获得此权限！", "./");
    exit;
}

$mt = "#_@cstcont";


if ($_POST) {
#print_r($_POST);exit;

    $itime = dcode($itime);
    $itime = strtotime($itime . " 08:00:00");###昨日中文日期
    foreach ($itm as $k => $v) {
        if (array_sum($v) > 0) {
            $SqlStr .= "('$YumDamSId','$itime','" . dcode($k) . "','" . $v["tk"] . "','" . $v["ytk"] . "','" . $v["sy"] . "','" . $v["fr"] . "','" . $v["ok"] . "','" . $v["okm"] . "','" . time() . "','" . getip() . "'),";
        }
    }
    #echo $SqlStr;
    $SqlStr = substr($SqlStr, 0, -1);
    $SqlStr = " insert into `$mt`(`uid`,`fdate`,`itemid`,`itemtk`,`itemytk`,`itemsys`,`itemfr`,`itemok`,`itemokm`,`indate`,`uip`) values" . $SqlStr . ";";
#echo $SqlStr;
#exit;


    $IRes = $YumDamSql->selectsql($SqlStr);
    if ($IRes["affect"] == "1") {
        @header("Location:./index.php?at=I");
    }
##########################################以上处理各种需要的时间############################################################exit;
}
##########################################以上为各种需要的表的名称#########################################################
$DataDate = time() - 3600 * 10;
$DataDate1 = date("Ymd", $DataDate);###昨日加密日期
$DataDate2 = date("Y年m月d日", $DataDate);###昨日中文日期
##########################################以上为数据写入#########################################################

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳美莱医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body oncontextmenu="return false;">
<div class="Cont">
    <div class="Content">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <form action="" method="post">
                <tr>
                    <td width="25%" align="right"><strong>数据时间</strong></td>
                    <td colspan="7">
                        <strong style=" color:red;"><?= $DataDate2 ?></strong><input type="hidden" name="itime"
                                                                                     value="<?= ecode($DataDate1) ?>"/>&nbsp;&nbsp;|&nbsp;&nbsp;<strong>姓名：</strong><strong
                                style="color:green"><?= YumDamReadAdmin($YumDamSId); ?></strong>
                    </td>
                </tr>
                <tr>
                    <td align="right" height="45" style="border-bottom:none;"><strong>项目</strong></td>
                    <th width="100">咨询量</th>
                    <th width="100">有效量</th>
                    <th width="100">下单量</th>
                    <th width="100">到诊量</th>
                    <th width="100">成交量</th>
                    <th width="100">成交金额</th>
                    <th>&nbsp;</th>
                </tr>
                <?
                $mt4 = '#_@classitem';
                $mtcont = "#_@cstcont";
                $ListAllowIRes = $YumDamSql->selectsql("SELECT $mt4.`Id`,$mt4.`iname` FROM  $mt4 where $mt4.`isshow`='1' and $mt4.`wd`='2' order by $mt4.`TId` asc,$mt4.`Id`");
                $IsExsitRes = $YumDamSql->selectsql("SELECT $mtcont.`itemid` FROM  $mtcont where $mtcont.`uid`='" . $YumDamSId . "' and $mtcont.`fdate` " . YumDamDay($DataDate1));
                $IsExsitResArray = array();
                foreach ($IsExsitRes["select"] as $k => $v) {
                    $IsExsitResArray[] = $v["itemid"];
                }
                foreach ($ListAllowIRes["select"] as $k => $v) {
                    if (!in_array($v["Id"], $IsExsitResArray)) {
                        ?>
                        <tr>
                            <td align="right"><strong><?= $v["iname"] ?></strong></td>
                            <td><input type="text" name="itm[<?= ecode($v["Id"]) ?>][tk]" id="tk<?= $v["Id"] ?>"
                                       class="InPutTxt" style="width:80px;ime-mode:disabled;" onpaste="return false;"
                                       onkeypress="keyPress()" autocomplete="off"
                                       value="<?= count($UpDateDataCzw) > 0 ? $UpDateDataCzw["tk"] : "0" ?>"
                                       onmouseout="_total('tk')" onblur="_total('tk')"/></td>
                            <td><input type="text" name="itm[<?= ecode($v["Id"]) ?>][ytk]" id="ytk<?= $v["Id"] ?>"
                                       class="InPutTxt" style="width:80px;ime-mode:disabled;" onpaste="return false;"
                                       onkeypress="keyPress()" autocomplete="off"
                                       value="<?= count($UpDateDataCzw) > 0 ? $UpDateDataCzw["tk"] : "0" ?>"
                                       onmouseout="_total('tk')" onblur="_total('tk')"/></td>
                            <td><input type="text" name="itm[<?= ecode($v["Id"]) ?>][sy]" id="sy<?= $v["Id"] ?>"
                                       class="InPutTxt" style="width:80px;ime-mode:disabled;" onpaste="return false;"
                                       onkeypress="keyPress()" autocomplete="off"
                                       value="<?= count($UpDateDataCzw) > 0 ? $UpDateDataCzw["sy"] : "0" ?>"
                                       onmouseout="_total('sy')" onblur="_total('sy')"/></td>
                            <td><input type="text" name="itm[<?= ecode($v["Id"]) ?>][fr]" id="fr<?= $v["Id"] ?>"
                                       class="InPutTxt" style="width:80px;ime-mode:disabled;" onpaste="return false;"
                                       onkeypress="keyPress()" autocomplete="off"
                                       value="<?= count($UpDateDataCzw) > 0 ? $UpDateDataCzw["fr"] : "0" ?>"
                                       onmouseout="_total('fr')" onblur="_total('fr')"/></td>
                            <td><input type="text" name="itm[<?= ecode($v["Id"]) ?>][ok]" id="ok<?= $v["Id"] ?>"
                                       class="InPutTxt" style="width:80px;ime-mode:disabled;" onpaste="return false;"
                                       onkeypress="keyPress()" autocomplete="off"
                                       value="<?= count($UpDateDataCzw) > 0 ? $UpDateDataCzw["fr"] : "0" ?>"
                                       onmouseout="_total('fr')" onblur="_total('fr')"/></td>
                            <td><input type="text" name="itm[<?= ecode($v["Id"]) ?>][okm]" id="okm<?= $v["Id"] ?>"
                                       class="InPutTxt" style="width:80px;ime-mode:disabled;" onpaste="return false;"
                                       onkeypress="keyPress()" autocomplete="off"
                                       value="<?= count($UpDateDataCzw) > 0 ? $UpDateDataCzw["fr"] : "0" ?>"
                                       onmouseout="_total('fr')" onblur="_total('fr')"/></td>
                            <td>&nbsp;</td>
                        </tr>
                        <?
                    }
                }
                ?>
                <tr>
                    <td align="right"><strong>小计</strong></td>
                    <td id="tttk">&nbsp;</td>
                    <td id="ttsy">&nbsp;</td>
                    <td id="ttsy">&nbsp;</td>
                    <td id="ttfr">&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="7"><input type="submit" value="提交" disabled="disabled" class="B"/></td>
                </tr>
            </form>
        </table>
        <div class="clearit"></div>
    </div>
    <div class="clearit"></div>
</div>


<script type="text/javascript">

    function keyPress() {
        var keyCode = event.keyCode;
        //this.value=this.value.replace(/[\d]/g,'');
        if ((keyCode >= 48 && keyCode <= 57)) {
            //alert(a.replace(/\b(0+)/gi,""));
            //alert(event.returnValue);
            event.returnValue = true;
        } else {
            event.returnValue = false;
        }
    }


    function _total(cl) {
        return false;
        var _zw = document.getElementById("zw" + cl).value;
        var _wc = document.getElementById("wc" + cl).value;
        var _pf = document.getElementById("sk" + cl).value;
        var _kq = document.getElementById("tk" + cl).value;
        var _nt = document.getElementById("nl" + cl).value;
        document.getElementById("tt" + cl).innerHTML = "<strong style=\"color:red;\">" + (parseInt(_zw) + parseInt(_wc) + parseInt(_pf) + parseInt(_kq) + parseInt(_nt)) + "</strong>";
    }
</script>
</body>
</html>