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


$mt3 = '#_@dataclass';
$mt4 = '#_@itemcont';
$mt5 = '#_@itemclass';


if ($_POST) {
    $itime = dcode($FmDateC);
    foreach ($itm as $k => $v) {
        if (array_sum($v) > 0) {
            $SqlStr .= "('" . YumDamDataDay($itime) . "','" . dcode($FmDataC) . "','" . dcode($k) . "','" . $v["im"] . "','" . $v["isw"] . "','" . $v["ic"] . "','" . $v["it"] . "','" . $v["is"] . "','" . $v["if"] . "','" . $v["io"] . "','" . $v["iom"] . "','" . time() . "','" . getip() . "','" . $YumDamSId . "'),";
        }
    }
    #echo $SqlStr;
    $SqlStr = substr($SqlStr, 0, -1);
    $SqlStr = " insert into `$mt4`(`fdate`,`fclass`,`IId`,`IIm`,`IIsw`,`IIc`,`ITk`,`IIs`,`IIf`,`IIo`,`IIin`,`InDate`,`uip`,`inuser`) values" . $SqlStr . ";";
#echo $SqlStr;
#exit;


    $IRes = $YumDamSql->selectsql($SqlStr);
    YumDamShowMsgAlertExit("添加成功", "itemlist.php");
    exit;
}


##$IsExsit=$YumDamSql->selectSql(" select $mt3.`Id`,$mt3.`cname` from $mt3 where $mt3.`tId`!='0' and $mt3.`isshow`='1' and $mt3.`Id` not in(select `fclass` from $mt4 where $mt4.`fdate` ".YumDamDay($YesToday1).") order by $mt3.`tId`");

$IsExsit = $YumDamSql->selectSql(" select $mt3.`Id`,$mt3.`cname` from $mt3 where $mt3.`tId`!='0' and $mt3.`isshow`='1' order by $mt3.`tId`");


$iTem = $YumDamSql->selectSql(" select `Id`,`TId`,`iname` from $mt5 where $mt5.`re`=2 and `isshow`=1 order by $mt5.`TId`");


#print_r($iTem);
#exit;


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
    <div class="DivTitle">「项目数据填写」</div>
    <div class="Content">
        <form method="post" name="myform" id="myform" action="">
            <table width="100%" border="0" class="NoBorder" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="TdTitle" style="color:#000;">报表日期</td>
                    <td colspan="9">
                        <div class="TimeSlt" id="FmDate" onclick="DisplayData('DateM','false')"><?= $YesToday2 ?></div>
                        <input type="hidden" name="FmDateC" id="FmDateC" value="<?= ecode($YesToday1) ?>"/></td>
                </tr>
                <tr id="DateM" style="display:none;">
                    <td>&nbsp;</td>
                    <td colspan="9">
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
                    <td colspan="9">
                        <div class="Slt2" id="FmData" onclick="DisplayData('FromM')">-选择来源-</div>
                        <input type="hidden" name="FmDataC" id="FmDataC" value="0"/></td>
                </tr>
                <tr id="FromM" style="display:none;">
                    <td>&nbsp;</td>
                    <td colspan="9">
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
                <tr class="HdTitle">
                    <td class="TdTitle" style="color:#000;">项目</td>
                    <td width="80">投入</td>
                    <td width="80">展现量</td>
                    <td width="80">点击</td>
                    <td width="80">咨询量</td>
                    <td width="80">下单量</td>
                    <td width="80">到诊量</td>
                    <td width="80">成交量</td>
                    <td width="80">成交金额</td>
                    <td>&nbsp;</td>
                </tr>
                <?
                foreach ($iTem["select"] as $k => $v) {
                    ?>
                    <tr>
                        <td bgcolor="#791d77" class="TdTitle"><?= $v["iname"] ?></td>
                        <td bgcolor="#efefef"><input type="text" name="itm[<?= ecode($v["Id"]) ?>][im]"
                                                     id="im<?= ecode($v["Id"]) ?>" class="TdTxt TdTxt2" value="0"/></td>
                        <td bgcolor="#efefef"><input type="text" name="itm[<?= ecode($v["Id"]) ?>][isw]"
                                                     id="isw<?= ecode($v["Id"]) ?>" class="TdTxt TdTxt2" value="0"/>
                        </td>
                        <td bgcolor="#efefef"><input type="text" name="itm[<?= ecode($v["Id"]) ?>][ic]"
                                                     id="ic<?= ecode($v["Id"]) ?>" class="TdTxt TdTxt2" value="0"/></td>
                        <td bgcolor="#efefef"><input type="text" name="itm[<?= ecode($v["Id"]) ?>][it]"
                                                     id="it<?= ecode($v["Id"]) ?>" class="TdTxt TdTxt2" value="0"/></td>
                        <td bgcolor="#efefef"><input type="text" name="itm[<?= ecode($v["Id"]) ?>][is]"
                                                     id="is<?= ecode($v["Id"]) ?>" class="TdTxt TdTxt2" value="0"/></td>
                        <td bgcolor="#efefef"><input type="text" name="itm[<?= ecode($v["Id"]) ?>][if]"
                                                     id="if<?= ecode($v["Id"]) ?>" class="TdTxt TdTxt2" value="0"/></td>
                        <td bgcolor="#efefef"><input type="text" name="itm[<?= ecode($v["Id"]) ?>][io]"
                                                     id="io<?= ecode($v["Id"]) ?>" class="TdTxt TdTxt2" value="0"/></td>
                        <td bgcolor="#efefef"><input type="text" name="itm[<?= ecode($v["Id"]) ?>][iom]"
                                                     id="iom<?= ecode($v["Id"]) ?>" class="TdTxt TdTxt2" value="0"/>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <?
                }
                ?>
                <tr>
                    <td colspan="10">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="9"><input type="submit" class="TdBtn" value="保 存"/><input type="reset" class="TdBtn"
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