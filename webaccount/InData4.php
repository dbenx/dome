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


$mt6 = '#_@fw';
$sqlwhere = " `fdate` " . YumDamDay($YesToday1);
$IsExsit = $YumDamSql->selectdb(" `Id` ", $mt6, $sqlwhere);
if ($IsExsit["row"] >= "1") {
    @header("Location:./InData2.php?at=I");
    exit;
}

if ($_POST) {
    $itime = dcode($itime);
    #$itime=strtotime($itime." 08:00:00");
    if ($itime != $YesToday1) {
        echo "数据出现错误-D1";
        exit;
    }
    #print_r($_POST);exit;
    $ii = dcode($ii);
    $field1 = "`fdate`,`bdjj`,`bdjk`,`bdwm`,`hsjj`,`sgjj`,`wx`,`mh`,`nf`,`myor`,`InDate`,`uip`,`inuser`";
    $field2 = "'$YesToday3','" . $InCf["21"] . "','" . $InCf["22"] . "','" . $InCf["23"] . "','" . $InCf["24"] . "','" . $InCf["25"] . "','" . $InCf["26"] . "','" . $InCf["27"] . "','" . $InCf["28"] . "','0'," . time() . ",'" . getip() . "','" . $YumDamSId . "'";
    $IRes = $YumDamSql->insertdb($mt6, $field1, $field2);
    if ($IRes["affect"] == "1") {
        @header("Location:./InData2.php?at=I");
    }
    exit;
}

###############################################################################################
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
<div class="Cont">
    <div class="Tinfo">
        <strong>您现在的位置：</strong>新增报表
    </div>
    <form action="" name="myform" id="myform" method="post" onsubmit="return mysubmit<?= $form ?>()">
        <div class="Tinfo" style="text-align:center; border-bottom:solid 1px #cccccc;">
            <font color="green"><strong>&gt;&gt; 以下为信息来源数据 &lt;&lt;</strong>&nbsp;</font>
        </div>
        <div class="Content">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="right" width="200">数据日期</td>
                    <td><input type="hidden" name="itime" value="<?= ecode($YesToday1) ?>"/><strong><font
                                    color="#FF0000"><?= $YesToday2 ?></font></strong></td>
                </tr>
                <?
                foreach ($YumDamComeFrom as $k => $v) {
                    ?>
                    <tr>
                        <td align="right"><?= $v ?></td>
                        <td><input name="InCf[<?= $k ?>]" type="text" class="InPutTxt" style="width:150px"
                                   autocomplete="off" value="0"/></td>
                    </tr>
                    <?
                }
                ?>
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