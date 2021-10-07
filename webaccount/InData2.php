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
    $fclass = dcode($FmDataC);
    if (empty($fclass)) {
        echo "请选择数据来源";
        exit;
    }
    $field1 = "`fdate`,`fclass`,`fmoney`,`wapmoney`,`fclick`,`fshow`,`selftalk`,`talkwap`,`hmoney`,`bmoney`,`indate`,`uip`,`inuser`";
    $field2 = "'$YesToday3','$fclass','$im','$mim','$ic','$is','$ist','$iswt','$_him','$_bim'," . time() . ",'" . getip() . "','" . $YumDamSId . "'";
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
    <link href="../CSS/Style.2016.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.2016.js"></script>
</head>

<body>
<div class="Cont">
    <div class="DivTitle">「渠道数据填写」</div>
    <form action="" name="myform" id="myform" method="post" onsubmit="return isselectfrom()">
        <div class="Content">
            <table width="100%" border="0" class="NoBorder" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="TdTitle" style="color:#000;">数据日期</td>
                    <td colspan="6"><input type="hidden" name="itime" value="<?= ecode($YesToday1) ?>"/><strong><font
                                    color="#FF0000"><?= $YesToday2 ?></font></strong></td>
                </tr>
                <tr bgcolor="#791d77">
                    <td class="TdTitle">数据渠道</td>
                    <td colspan="6" id="Slt">
                        <div class="Slt2" id="FmData" onclick="DisplayData('FromM')">-选择来源-</div>
                        <input type="hidden" name="FmDataC" id="FmDataC" value="0"/></td>
                </tr>
                <tr id="FromM">
                    <td>&nbsp;</td>
                    <td colspan="6">
                        <?
                        foreach ($YumDamDataClass as $k => $v) {
                            $i++;
                            ?>
                            <div class="Slt2" onclick="SltCont('FmData','FmD<?= $i ?>','FromM','Slt')"
                                 id="FmD<?= $i ?>"><?= $v ?></div><input type="hidden" id="FmD<?= $i ?>C"
                                                                         value="<?= ecode($k) ?>"/>
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
                    <td width="150" bgcolor="#791d77" class="TdTitle">资金投入</td>
                    <td width="150"><input name="im" type="text" id="im" onmouseout="PCIM()" onblur="PCIM()"
                                           class="InPutTxt" autocomplete="off" style="width:180px" value=""/></td>
                    <td width="200" bgcolor="#791d77" class="TdTitle">手机投入</td>
                    <td width="150"><input name="mim" type="text" id="mim" onmouseout="PCIM()" onblur="PCIM()"
                                           class="InPutTxt" autocomplete="off" style="width:180px" value=""/></td>
                    <td width="150" bgcolor="#791d77" class="TdTitle">PC投入</td>
                    <td width="150"><span id="pcim">0</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#791d77" class="TdTitle">点击次数</td>
                    <td><input name="ic" type="text" id="ic" class="InPutTxt" autocomplete="off" style="width:180px"
                               value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">展现量</td>
                    <td><input name="is" type="text" id="is" class="InPutTxt" autocomplete="off" style="width:180px"
                               value=""/></td>
                    <td align="right">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#791d77" class="TdTitle">总对话量</td>
                    <td><input name="ist" type="text" id="ist" onpaste="return false;" class="InPutTxt"
                               autocomplete="off" style="width:180px" value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">手机对话</td>
                    <td><input name="iswt" type="text" id="iswt" onpaste="return false;" class="InPutTxt"
                               autocomplete="off" style="width:180px" value=""/></td>
                    <td align="right">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#791d77" class="TdTitle">行业词消费</td>
                    <td><input name="_him" type="text" id="_him" class="InPutTxt" autocomplete="off" style="width:180px"
                               value=""/></td>
                    <td bgcolor="#791d77" class="TdTitle">品牌词消费</td>
                    <td><input name="_bim" type="text" id="_bim" class="InPutTxt" autocomplete="off" style="width:180px"
                               value=""/></td>
                    <td align="right">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="6">&nbsp;</td>
                </tr>
            </table>
            <div class="clearit"></div>
        </div>
        <div class="ContBtn">
            <input type="submit" class="TdBtn" id="mysubmit" value="保存"/>&nbsp;<input type="reset" class="TdBtn"
                                                                                      value="清空"/>&nbsp;<? if ($IsOk) { ?>
                <input type="button" class="TdBtn" id="ToS" value="结算"/><? } ?>
        </div>
    </form>
    <div class="clearit"></div>
</div>
<script type="text/javascript">
    function isselectfrom() {
        var fm = document.getElementById("FmDataC").value;
        if (fm == "0" || fm == "") {
            alert("请选择数据来源！");
            return false;
        }
        var d1 = document.getElementById("im").value;
        var d2 = document.getElementById("mim").value;

        if (d1 == "" || d1 == "0" || parseInt(d1) < parseInt(d2)) {
            alert("数据输入有误，请检查！");
            return false;
        }
        if (!confirm("确定要提交吗？")) {
            return false;
        } else {
            document.getElementById("mysubmit").disabled = true;
            return true;
        }
    }

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