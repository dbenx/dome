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

$mt2 = '#_@indata2';
$mt3 = '#_@dataclass';


$IsExsit = $YumDamSql->selectSql(" select $mt3.`Id`,$mt3.`cname` from $mt3 where $mt3.`tId`!='0' and $mt3.`isshow`='1' and $mt3.`Id` not in(select `fclass` from $mt2 where $mt2.`fdate` " . YumDamDay($YesToday1) . ") order by $mt3.`tId`");


if ($IsExsit["row"] <= 0) {
    @header("Location:./cLassList.php?at=btdatalist");####如果自己数据有了，就进入下一数据表
    exit;
}

if ($_POST) {
    $itime = dcode($FmDateC);
    #$itime=strtotime($itime." 08:00:00");
    if ($itime != $YesToday1) {
        echo "数据出现错误-D1";
        exit;
    }
    $field1 = "`fdate`,`fclass`,`fmoney`,`wapmoney`,`fshow`,`wapshow`,`fclick`,`wapclick`,`ftalk`,`waptalk`,`hmoney`,`bmoney`,`indate`,`uip`,`inuser`";
    $field2 = "'" . YumDamDataDay($itime) . "','" . dcode($FmDataC) . "','$im','$mim','$is','$isw','$ic','$icw','$ist','$iswt','$him','$bim'," . time() . ",'" . getip() . "','" . $YumDamSId . "'";
    $IRes = $YumDamSql->insertdb($mt2, $field1, $field2);
    if ($IRes["affect"] == "1") {
        @header("Location:" . $_SERVER["PHP_SELF"]);
    }
    exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>美莱医疗美容医院</title>
    <link href="../CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../Scripts/yumdam.my.js"></script>
</head>

<body oncontextmenu="return false;">
<div class="Cont">
    <div class="DivTitle">「渠道数据填写」</div>
    <div class="Content">
        <form method="post" name="myform" id="myform" action="">
            <table width="100%" border="0" class="NoBorder" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="TdTitle" style="color:#000;">报表日期</td>
                    <td colspan="6">
                        <div class="TimeSlt" id="FmDate" onclick="DisplayData('DateM','false')"><?= $YesToday2 ?></div>
                        <input type="hidden" name="FmDateC" id="FmDateC" value="<?= ecode($YesToday1) ?>"/></td>
                </tr>
                <tr id="DateM" style="display:none;">
                    <td>&nbsp;</td>
                    <td colspan="6">
                        <div class="TimeSlt2" onclick="SltCont('FmDate','FmE1','DateM')" id="FmE1">2015年12月21日</div>
                        <input type="hidden" id="FmE1C" value="121"/>
                        <div class="TimeSlt2" onclick="SltCont('FmDate','FmE2','DateM')" id="FmE2">2015年12月23日</div>
                        <input type="hidden" id="FmE2C" value="121"/>
                        <div class="TimeSlt2" onclick="SltCont('FmDate','FmE3','DateM')" id="FmE3">2015年12月25日</div>
                        <input type="hidden" id="FmE3C" value="121"/>
                    </td>
                </tr>
                <tr bgcolor="#791d77">
                    <td width="150" bgcolor="#791d77" class="TdTitle">渠道来源</td>
                    <td colspan="6" id="Slt">
                        <div class="Slt2" id="FmData" onclick="DisplayData('FromM')">-选择来源-</div>
                        <input type="hidden" name="FmDataC" id="FmDataC" value="0"/></td>
                </tr>
                <tr id="FromM" style="display:none;">
                    <td>&nbsp;</td>
                    <td colspan="6">
                        <?
                        foreach ($IsExsit["select"] as $k => $v) {
                            $i++;
                            ?>
                            <div class="Slt2" onclick="SltCont('FmData','FmD<?= $i ?>','FromM','Slt')"
                                 id="FmD<?= $i ?>"><?= $v["cname"] ?></div><input type="hidden" id="FmD<?= $i ?>C"
                                                                                  value="<?= ecode($v["Id"]) ?>"/>
                            <?
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#791d77" class="TdTitle">资金投入</td>
                    <td width="180" bgcolor="#efefef"><input type="text" name="im" id="im" class="TdTxt" value=""/></td>
                    <td width="150" bgcolor="#791d77" class="TdTitle">手机投入</td>
                    <td width="180" bgcolor="#efefef"><input type="text" class="TdTxt" name="mim" id="mim" value=""/>
                    </td>
                    <td width="150" bgcolor="#791d77" class="TdTitle">PC投入</td>
                    <td width="180" bgcolor="#efefef">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#791d77" class="TdTitle">展现量</td>
                    <td bgcolor="#efefef"><input type="text" name="is" id="is" class="TdTxt" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">手机展现</td>
                    <td bgcolor="#efefef"><input type="text" class="TdTxt" name="isw" id="isw" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">PC展现</td>
                    <td bgcolor="#efefef">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#791d77" class="TdTitle">点击次数</td>
                    <td bgcolor="#efefef"><input type="text" name="ic" id="ic" class="TdTxt" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">手机点击</td>
                    <td bgcolor="#efefef"><input type="text" name="icw" id="icw" class="TdTxt" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">PC点击</td>
                    <td bgcolor="#efefef">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#791d77" class="TdTitle">总对话量</td>
                    <td bgcolor="#efefef"><input type="text" name="ist" id="ist" class="TdTxt" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">手机对话</td>
                    <td bgcolor="#efefef"><input type="text" name="iswt" id="iswt" class="TdTxt" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">PC对话</td>
                    <td bgcolor="#efefef">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#791d77" class="TdTitle">行业消费</td>
                    <td bgcolor="#efefef"><input type="text" name="him" id="him" class="TdTxt" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">品牌消费</td>
                    <td bgcolor="#efefef"><input type="text" name="bim" id="bim" class="TdTxt" value=""/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="6"><input type="submit" class="TdBtn" value="提 交"/><input type="reset" class="TdBtn"
                                                                                           value="清 空"/></td>
                </tr>
            </table>
        </form>
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

</script>
</body>
</html>