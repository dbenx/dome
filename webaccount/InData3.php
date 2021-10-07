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


$mt4 = '#_@classitem';
$mt5 = '#_@itemcont';
$mt3 = '#_@datalist';

$sqlwhere1 = " `fdate` " . YumDamDay($YesToday1);
$IsExsit1 = $YumDamSql->selectdb(" `mId`,`sendid` ", $mt3, $sqlwhere1);
if (!empty($IsExsit1["select"][0]["mId"]) && !empty($IsExsit1["select"][0]["sendid"])) {
    @header("Location:./Item.php?at=L");
    exit;
} else {
    $IsOk = true;
}

if ($_POST) {
    $itime = dcode($itime);
    #$itime=strtotime($itime." 08:00:00");
    if ($itime != $YesToday1) {
        echo "数据出现错误-D1";
        exit;
    }
    $ii = dcode($ii);
    $field1 = "`fdate`,`IId`,`ITk`,`IIs`,`IIf`,`IIo`,`IIm`,`InDate`,`uip`,`inuser`";
    $field2 = "'$YesToday3','$ii','$it','$is','$tisf','$tiso','$ism'," . time() . ",'" . getip() . "','" . $YumDamSId . "'";
    $IRes = $YumDamSql->insertdb($mt5, $field1, $field2);
    if ($IRes["affect"] == "1") {
        @header("Location:./InData3.php?at=I");
    }
    exit;
}

###############################################################################################

$itemsqlwhere = " $mt5.`fdate` " . YumDamDay($YesToday1);
$OkItem = $YumDamSql->selectdb(" `IId` ", "$mt5", $itemsqlwhere);
if (!is_array($OkItem["select"])) {
    $OkItem["select"] = array();
}
$OkItemShow = array();
foreach ($OkItem["select"] as $ok => $ov) {
    $OkItemShow[] = $ov["IId"];
}

####################################################
$ItemSRes = $YumDamSql->selectsql("SELECT * FROM  $mt4 where `isshow`='1' and `TId`='0' and `isshow`='1'");
if (!is_array($ItemSRes["select"])) {
    $ItemSRes["select"] = array();
}
$ItemClass = $ItemSRes["select"];
#print_r($ItemClass);


$ItemClassShow = "";
foreach ($ItemClass as $k => $cv) {
    $ItemClassShowC = array();
    $ItemClassShowC = $cv;
    $ItemClassShow .= "<optgroup label=\"" . $cv["iname"] . "\">\n";
    $where = " `TId`=" . $cv["Id"] . " and `isshow`=1";
    $ItemClass2 = $YumDamSql->selectdb("Id,iname", $mt4, $where);
    $ItemClass2 = $ItemClass2["select"];
    foreach ($ItemClass2 as $ks => $sv) {
        if (!in_array($sv["Id"], $OkItemShow)) {
            $ItemClassShow .= "<option value=\"" . (ecode($sv["Id"])) . "\">--" . $sv["iname"] . "</option>\n";
        }
    }
    $ItemClassShow .= "</optgroup>\n";
}


###############################################################################################

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>美莱医疗美容医院</title>
    <link href="../CSS/Style.2016.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body>
<div class="Cont">
    <div class="DivTitle">「项目数据填写」</div>
    <form action="" name="myform" id="myform" method="post" onsubmit="return toclass()">
        <div class="Content">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="right" width="200">数据日期</td>
                    <td><input type="hidden" name="itime" value="<?= ecode($YesToday1) ?>"/><strong><font
                                    color="#FF0000"><?= $YesToday2 ?></font></strong></td>
                </tr>
                <tr>
                    <td align="right">咨询项目</td>
                    <td>
                        <select name="ii" id="ii">
                            <option value="">--请选择咨询项目--</option>
                            <?= $ItemClassShow ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right">咨询数量</td>
                    <td><input name="it" type="text" id="it" class="InPutTxt" style="width:180px" autocomplete="off"
                               value=""/></td>
                </tr>
                <tr>
                    <td align="right">下单数量</td>
                    <td><input name="is" type="text" id="is" class="InPutTxt" autocomplete="off" style="width:180px"
                               value=""/></td>
                </tr>
                <tr>
                    <td align="right">到诊数量</td>
                    <td><input name="tisf" type="text" id="tisf" class="InPutTxt" autocomplete="off" style="width:180px"
                               value=""/></td>
                </tr>
                <tr>
                    <td align="right">成交数量</td>
                    <td><input name="tiso" type="text" id="tiso" class="InPutTxt" autocomplete="off" style="width:180px"
                               value=""/></td>
                </tr>
                <tr>
                    <td align="right">投入消费</td>
                    <td><input name="ism" type="text" id="ism" class="InPutTxt" autocomplete="off" style="width:180px"
                               value="0"/></td>
                </tr>
                <tr>
                    <td align="right">&nbsp;</td>
                    <td>&nbsp;</td>
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
    function toclass() {
        var myvar = document.getElementById("mysubmit");
        myvar.disabled = true;
        myvar.value = '正在提交，请稍等……';
        return true;
    }


    function MyToS() {
        if (!confirm('确定要结算吗?')) {
            return false;
        }
        var d1 = '<?=ecode($YesToday)?>';
        if (d1 == "" || d1 == "0") {
            return false;
        }
        var url = "./Ajax/IsSend.php?action=<?=encode("s")?>&ate=" + d1 + "&r=" + Math.random();
        request.open("GET", url, true);
        document.getElementById("ToS").innerHTML = "处理中……";
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                if (response == "Y") {
                    alert("恭喜！结算成功！");
                }
                window.location.href = "./Item.php?at=L";
            }
        }
        request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        request.send(null);
    }

    document.getElementById("ToS").onclick = MyToS;
</script>
</body>
</html>