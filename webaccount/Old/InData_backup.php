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


$mt1 = '#_@indata';


if ($_POST) {
    if ($italk < $iwtalk) {
        echo '有数有误，请返回！<a href="javascript:history.go(-1);">返回</a>';
        exit;
    }

    $itime = dcode($itime);
#$itime=strtotime($itime." 08:00:00");
    if ($itime != $YesToday1) {
        echo "数据出现错误-D1";
        exit;
    }
    $field1 = "`fdate`,`talkall`,`talkwap`,`retalk1`,`retalk2`,`notalk`,`issys`,`isfrom`,`isok`,`webip`,`bqq`,`indate`,`uip`,`inuser`";
    $field2 = "'$YesToday3','$italk','$iwtalk','$isre','$isre2','$isre3','$iss','$isf','$iso','$wi','$bq'," . time() . ",'" . getip() . "','" . $YumDamSId . "'";
    $IRes = $YumDamSql->insertdb($mt1, $field1, $field2);
    if ($IRes["affect"] == "1") {
        echo '添加成功<a href="./InData2.php?at=I">继续添加消费数据</a>';
        exit;
    }
    exit;
}

$sqlwhere = " `fdate` " . YumDamDay($YesToday1);
$IsExsit = $YumDamSql->selectdb(" `Id` ", $mt1, $sqlwhere);
if ($IsExsit["row"] >= "1") {
    @header("Location:./InData2.php?at=I");
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
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body>
<?
#@include_once("Inc/head.php");
?>
<div class="Cont">
    <div class="Tinfo">
        <strong>您现在的位置：</strong>新增报表
    </div>
    <form action="" name="myform" id="myform" method="post" onsubmit="return mysubmit<?= $form ?>()">
        <div class="Tinfo" style="text-align:center; border-bottom:solid 1px #cccccc;">
            <font color="green"><strong>&gt;&gt; 以下为综合信息数据 &lt;&lt;</strong>&nbsp;</font>
        </div>
        <div class="Content">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="right">数据日期</td>
                    <td colspan="5"><input type="hidden" name="itime" value="<?= ecode($YesToday1) ?>"/><strong><font
                                    color="#FF0000"><?= $YesToday2 ?></font></strong></td>
                </tr>
                <tr>
                    <td align="right">商务通对话</td>
                    <td><input name="italk" type="text" id="italk" onmouseout="PCTK()" onblur="PCTK()"
                               autocomplete="off" class="InPutTxt" style="width:180px" value=""/></td>
                    <td align="right">手机对话</td>
                    <td><input name="iwtalk" type="text" id="iwtalk" onmouseout="PCTK()" onblur="PCTK()"
                               autocomplete="off" class="InPutTxt" style="width:180px" value=""/></td>
                    <td align="right">PC对话</td>
                    <td><span id="pctk">0</span></td>
                </tr>
                <tr>
                    <td align="right">到院重复对话</td>
                    <td><input name="isre" type="text" id="isre" class="InPutTxt" style="width:180px" autocomplete="off"
                               value=""/></td>
                    <td align="right">未到院重复对话</td>
                    <td><input name="isre2" type="text" id="isre2" class="InPutTxt" style="width:180px"
                               autocomplete="off" value=""/></td>
                    <td align="right">行政无效对话</td>
                    <td><input name="isre3" type="text" id="isre3" class="InPutTxt" style="width:180px"
                               autocomplete="off" value=""/></td>
                </tr>
                <tr>
                    <td align="right">下单人数</td>
                    <td><input name="iss" type="text" id="iss" class="InPutTxt" style="width:180px" autocomplete="off"
                               value=""/></td>
                    <td align="right">到诊人数</td>
                    <td><input name="isf" type="text" id="isf" class="InPutTxt" style="width:180px" autocomplete="off"
                               value=""/></td>
                    <td align="right">成交人数</td>
                    <td><input name="iso" type="text" id="iso" class="InPutTxt" style="width:180px" autocomplete="off"
                               value=""/></td>
                </tr>
                <tr>
                    <td align="right">网站访问量(UV)</td>
                    <td><input name="wi" type="text" id="wi" class="InPutTxt" style="width:180px" autocomplete="off"
                               value=""/></td>
                    <td align="right">企业QQ对话</td>
                    <td><input name="bq" type="text" id="bq" class="InPutTxt" style="width:180px" autocomplete="off"
                               value=""/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <div class="clearit"></div>
        </div>
        <div class="ContBtn">
            <input type="submit" class="B" id="mysubmit" value="保存"/>&nbsp;<input type="reset" class="B" value="清空"/>
        </div>
    </form>
    <div class="clearit"></div>
</div>
</body>
</html>