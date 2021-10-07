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

$mt2 = '#_@indata2';
$mt3 = '#_@datalist';
$NextAjaxURL = "./Ajax/IsSend.php?action=" . encode("ms") . "&ate=" . ecode($YesToday) . "&r=" . rand(1, 999999);
$NextURL = "./InData3.php?at=I";


$sqlwhere1 = " `fdate` " . YumDamDay($YesToday1);
$IsExsit1 = $YumDamSql->selectdb(" `mId` ", $mt3, $sqlwhere1);
if (!empty($IsExsit1["select"][0]["mId"])) {
    @header("Location:" . $NextURL);
    exit;
}


if ($_POST) {
    $itime = dcode($itime);
    #$itime=strtotime($itime." 08:00:00");
    if ($itime != $YesToday1) {
        echo "数据出现错误-D1";
        exit;
    }
    $fclass = dcode($fc);
    $field1 = "`fdate`,`fclass`,`fmoney`,`wapmoney`,`fclick`,`fshow`,`selftalk`,`talkwap`,`indate`,`uip`,`inuser`";
    $field2 = "'$YesToday3','$fclass','$im','$mim','$ic','$is','$ist','$iswt'," . time() . ",'" . getip() . "','" . $YumDamSId . "'";
    $IRes = $YumDamSql->insertdb($mt2, $field1, $field2);
    if ($IRes["affect"] == "1") {
        @header("Location:./InData2.php?at=I");
    }
    exit;
}


$sqlwhere = " `fdate` " . YumDamDay($YesToday1);
$IsExsit = $YumDamSql->selectdb(" `fclass` ", $mt2, $sqlwhere);

if ($IsExsit["row"] >= count($YumDamDataClass)) {
    if ($IsExsit1["row"] <= "0") {
        @header("Location:" . $NextAjaxURL);
        exit;
    }
    @header("Location:" . $NextURL);
    exit;
}


if ($IsExsit["row"] > 0 && $IsExsit1["row"] <= 0) {
    $IsOk = true;
}


$InClassArray = array();
foreach ($IsExsit["select"] as $k => $v) {
    $InClassArray[$v["fclass"]] = $v["fclass"];
}


unset($YumDamDataClass['9']);###去掉销户的
foreach ($YumDamDataClass as $k => $v) {
    if (array_key_exists($k, $InClassArray)) {
        unset($YumDamDataClass[$k]);
    }
}
if (count($YumDamDataClass) <= 0) {
    @header("Location:" . $NextURL);
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
<div class="Cont">
    <div class="Tinfo">
        <strong>您现在的位置：</strong>新增报表
    </div>
    <form action="" name="myform" id="myform" method="post" onsubmit="return mysubmit<?= $form ?>()">
        <div class="Tinfo" style="text-align:center; border-bottom:solid 1px #cccccc;">
            <font color="green"><strong>&gt;&gt; 以下为账户消费信息数据 &lt;&lt;</strong>&nbsp;</font>
        </div>
        <div class="Content">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="right">数据日期</td>
                    <td colspan="6"><input type="hidden" name="itime" value="<?= ecode($YesToday1) ?>"/><strong><font
                                    color="#FF0000"><?= $YesToday2 ?></font></strong></td>
                </tr>
                <tr>
                    <td align="right">数据渠道：</td>
                    <td colspan="6">
                        <select name="fc">
                            <?
                            foreach ($YumDamDataClass as $k => $v) {
                                ?>
                                <option value="<?= ecode($k) ?>">--<?= $v ?>--</option>
                                <?
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right" width="150">资金投入：</td>
                    <td width="150"><input name="im" type="text" id="im" onmouseout="PCIM()" onblur="PCIM()"
                                           class="InPutTxt" autocomplete="off" style="width:180px" value=""/></td>
                    <td align="right" width="200">手机投入：</td>
                    <td width="150"><input name="mim" type="text" id="mim" onmouseout="PCIM()" onblur="PCIM()"
                                           class="InPutTxt" autocomplete="off" style="width:180px" value=""/></td>
                    <td align="right" width="150">PC投入：</td>
                    <td width="150"><span id="pcim">0</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">点击次数：</td>
                    <td><input name="ic" type="text" id="ic" class="InPutTxt" autocomplete="off" style="width:180px"
                               value=""/></td>
                    <td align="right">展现量：</td>
                    <td><input name="is" type="text" id="is" class="InPutTxt" autocomplete="off" style="width:180px"
                               value=""/></td>
                    <td align="right">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">总对话量：</td>
                    <td><input name="ist" type="text" id="ist" onpaste="return false;" class="InPutTxt"
                               autocomplete="off" style="width:180px" value=""/></td>
                    <td align="right">手机对话：</td>
                    <td><input name="iswt" type="text" id="iswt" onpaste="return false;" class="InPutTxt"
                               autocomplete="off" style="width:180px" value=""/></td>
                    <td align="right">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <div class="clearit"></div>
        </div>
        <div class="ContBtn">
            <input type="submit" class="B" id="mysubmit" value="保存"/>&nbsp;<input type="reset" class="B" value="清空"/>&nbsp;<? if ($IsOk) { ?>
                <input type="button" class="B" id="ToS" value="结算"/><? } ?>
        </div>
    </form>
    <div class="clearit"></div>
</div>
<script type="text/javascript">
    function MyToS() {
        if (!confirm('确定要结算吗?')) {
            return false;
        }
        var url = "<?=$NextAjaxURL?>"
        request.open("GET", url, true);
        document.getElementById("ToS").innerHTML = "处理中……";
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                if (response == "Y") {
                    alert("恭喜！结算成功！");
                }
                window.location.href = "./InData3.php?at=I";
            }
        }
        request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        request.send(null);
    }

    document.getElementById("ToS").onclick = MyToS;
</script>
</body>
</html>