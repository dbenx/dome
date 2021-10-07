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


$mt1 = '#_@indata';


$sqlwhere = " `fdate` " . YumDamDay($YesToday1);
$IsExsit = $YumDamSql->selectdb(" `Id` ", $mt1, $sqlwhere);
if ($IsExsit["row"] >= "1") {
    @header("Location:./iList.php?at=");####如果自己数据有了，就进入下一数据表
    exit;
}


if ($_POST) {
    if ($italk < $iwtalk) {
        echo '有数有误，请返回！<a href="javascript:history.go(-1);">返回</a>';
        exit;
    }

    $itime = dcode($FmDateC);
#$itime=strtotime($itime." 08:00:00");

    $field1 = "`fdate`,`talkall`,`yestalk`,`talkwap`,`retalk1`,`retalk2`,`notalk`,`issys`,`isfrom`,`isok`,`webip`,`bqq`,`indate`,`uip`,`inuser`";
    $field2 = "'" . YumDamDataDay($itime) . "','$italk','$yt','$iwtalk','$isre','$isre2','$isre3','$iss','$isf','$iso','$wi','$bq'," . time() . ",'" . getip() . "','" . $YumDamSId . "'";
    $IRes = $YumDamSql->insertdb($mt1, $field1, $field2);
    if ($IRes["affect"] == "1") {
        echo '添加成功';
        exit;
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
    <div class="DivTitle">「基础（综合信息）数据填写」</div>
    <form action="" name="myform" id="myform" method="post">
        <div class="Content">
            <table width="100%" border="0" class="NoBorder" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="TdTitle" style="color:#000;">数据日期</td>
                    <td colspan="6">
                        <div class="TimeSlt" id="FmDate" onclick="DisplayData('DateM','false')"><?= $YesToday2 ?></div>
                        <input type="hidden" id="FmDateC" name="FmDateC" value="<?= ecode($YesToday1) ?>"/></td>
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
                <tr>
                    <td width="150" bgcolor="#791d77" class="TdTitle">商务通对话</td>
                    <td width="180" bgcolor="#efefef"><input name="italk" type="text" id="italk" onmouseout="PCTK()"
                                                             onblur="PCTK()" autocomplete="off" class="TdTxt"
                                                             style="width:180px" value=""/></td>
                    <td width="150" bgcolor="#791d77" class="TdTitle">手机对话</td>
                    <td width="180" bgcolor="#efefef"><input name="iwtalk" type="text" id="iwtalk" onmouseout="PCTK()"
                                                             onblur="PCTK()" autocomplete="off" class="TdTxt"
                                                             style="width:180px" value=""/></td>
                    <td width="150" bgcolor="#791d77" class="TdTitle">PC对话</td>
                    <td width="180" bgcolor="#efefef"><span id="pctk">0</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#791d77" class="TdTitle">到院重复对话</td>
                    <td bgcolor="#efefef"><input name="isre" type="text" id="isre" class="TdTxt" style="width:180px"
                                                 autocomplete="off" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">未到院重复对话</td>
                    <td bgcolor="#efefef"><input name="isre2" type="text" id="isre2" class="TdTxt" style="width:180px"
                                                 autocomplete="off" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">行政无效对话</td>
                    <td bgcolor="#efefef"><input name="isre3" type="text" id="isre3" class="TdTxt" style="width:180px"
                                                 autocomplete="off" value=""/></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#791d77" class="TdTitle">下单人数</td>
                    <td bgcolor="#efefef"><input name="iss" type="text" id="iss" class="TdTxt" style="width:180px"
                                                 autocomplete="off" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">到诊人数</td>
                    <td bgcolor="#efefef"><input name="isf" type="text" id="isf" class="TdTxt" style="width:180px"
                                                 autocomplete="off" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">成交人数</td>
                    <td bgcolor="#efefef"><input name="iso" type="text" id="iso" class="TdTxt" style="width:180px"
                                                 autocomplete="off" value=""/></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#791d77" class="TdTitle">网站访问量（UV）</td>
                    <td bgcolor="#efefef"><input name="wi" type="text" id="wi" class="TdTxt" style="width:180px"
                                                 autocomplete="off" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">企业QQ对话</td>
                    <td bgcolor="#efefef"><input name="bq" type="text" id="bq" class="TdTxt" style="width:180px"
                                                 autocomplete="off" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">有效对话</td>
                    <td bgcolor="#efefef"><input name="yt" type="text" id="yt" class="TdTxt" style="width:180px"
                                                 autocomplete="off" value=""/></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <div class="clearit"></div>
        </div>
        <div class="ContBtn">
            <input type="submit" class="TdBtn" id="mysubmit" value="保 存"/>&nbsp;<input type="reset" class="TdBtn"
                                                                                       value="清 空"/>
        </div>
    </form>
    <div class="clearit"></div>
</div>
</body>
</html>