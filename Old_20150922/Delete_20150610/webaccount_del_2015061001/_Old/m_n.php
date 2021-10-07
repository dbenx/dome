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
include("Config/Config.Inc.php");####加载配置文件
#print_r($_SERVER);

$myaction = decode($_GET["at"]);


$mt1 = '#_@formclass';
$mt2 = '#_@formdata';
$mt3 = '#_@formdata3';
$mt4 = '#_@dataclass';
$mt5 = '#_@itemclass';
$mt6 = '#_@formdata2';

if ($myaction == "email") {
    $aid = $_GET["a"];
    $cont = $_GET["b"];
    $date = $_GET["c"];
    if ($aid == "" || $cont == "" || $date == "") {
        exit("数据出错！005");
    }
    $date = dcode($date);
    $date = date("Y年m月d日", $date);
    $aid = dcode($aid);
    $cont = decode($cont);
    $body = "<p style=\"font-weight:bold;\">您好！</p><p style=\"text-indent:40px; height:60px; line-height:60px;\"><a href=\"" . $cont . "\" target=\"_blank\">&gt;&gt;点击查看" . $date . "网络部数据报表&lt;&lt;</a><br />本链接7日内有效，请尽快查看，谢谢！</p><p style=\"text-align:right; color:#cccccc; height:40px; line-height:40px; margin:50px 0px 0px 0px; border-top:dashed 1px #666666;\">当代医疗美容医院·网络部<br />" . date("Y年m月d日 H时i分", time()) . "</p>";
    @include_once("Config/YumDam.Email.php");####加载配置文件

    #$body=file_get_contents("http://www.dangdai.cc/");

    ##########################################
    $smtpserver = "smtp.exmail.qq.com";//SMTP服务器
    $smtpserverport = 25;//SMTP服务器端口
    $smtpusermail = "dangdai@dangdai.cc";//SMTP服务器的用户邮箱
    $smtpemailto = "139169129@qq.com";//发送给谁
    $smtpuser = "dangdai@dangdai.cc";//SMTP服务器的用户帐号
    $smtppass = "?asfasfxi1003";//SMTP服务器的用户密码
    $mailsubject = "网络部" . date("Y年m月d日", time()) . "数据报表";//邮件主题
    $mailbody = $body;//邮件内容
    $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
    $smtpemailto2 = "380222560@qq.com,341613846@qq.com,383631211@qq.com,29233635@qq.com,2234829882@qq.com,61917291@qq.com";
    ##########################################
    $smtp = new YumDamEmail($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $smtp->debug = false;//是否显示发送的调试信息
    $smtp->SendMail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype, $smtpemailto2);


    #echo decode($_GET["b"]);
    #print_r($_GET);
    $IsEmail = $YumDamSql->updatedb($mt4, "`ismail`='2'", "`Id`='$aid'");
    echo "<font color=\"green\"><strong>恭喜您！发送成功！</strong></font>";
}
if ($myaction != "show" && $myaction != "emailshow") {
    exit;
}
$id = dcode($_GET["d"]);###类型ID
$indate = dcode($_GET["d2"]);
$indate2 = time() - 3600 * 24 * 7;
if ($indate2 - $indate > 0 && $myaction == "emailshow") {
    exit("抱歉，您的链接已过期或失效，请联系网络部！^_^");
}
if ($myaction == "emailshow") {
    $fromurl = $_SERVER['HTTP_REFERER'];
    $fromurlhost = parse_url($fromurl);
    $fromurlhost2 = $fromurlhost["host"];
    $fromurlhost3 = stristr($fromurlhost2, "qq.com");
    #echo "<div style=\"display:none\">".print_r($_SERVER)."</div>";
    if (getip() != "61.236.191.15") {
        exit("抱歉，您的链接已过期或失效，请联系网络部！02^_^");
    }
}
if (getip() != "61.236.191.15" && $myaction != "emailshow") {
    exit("抱歉，您的链接已过期或失效，请联系网络部！03^_^");
}
##echo $indate2."--".$indate;exit;
#$formname=decode($_GET["c"]);###类型名称

######################################################################################################
$ItemShow = $YumDamSql->selectdb(" `Id`,`iname` ", $mt5, "`isshow`='1'");
#print_r($ItemShow);
if (!is_array($ItemShow["select"])) {
    $ItemShow["select"] = array();
}
$ItemShowC = $ItemShow["select"];
$ItemShowC2 = array();
foreach ($ItemShowC as $ck => $cv) {
    $ItemShowC2[$cv["Id"]] = $cv["iname"];
}
#print_r($ItemShowC2);
######################################################################################################
$ShowItem = $YumDamSql->selectdb(" $mt6.`fitem` ", "$mt6,$mt4", "$mt6.`fdate`=$mt4.`Id` and $mt4.Id=$id");
if (!is_array($ShowItem["select"])) {
    $ShowItem["select"] = array();
}
$ShowItemC = $ShowItem["select"];
######################################################################################################
$ListItemShow = $YumDamSql->selectsql(" select  $mt3.`talkall`,$mt3.`talkwap`,$mt3.`retalk1`,$mt3.`retalk2`,$mt3.`notalk`,$mt3.`issys`,$mt3.`isfrom`,$mt3.`isok`,$mt3.`webip`,$mt3.`bqq`,$mt4.`Id`,$mt4.`selecttime`,$mt4.`indate`,sum($mt2.`fmoney`) as `fmoney`,sum($mt2.`wapmoney`) as `wapmoney`,sum($mt2.`fclick`) as `fclick`,sum($mt2.`fshow`) as `fshow`,$mt4.`ismail` from $mt3,$mt4,$mt2 where $mt3.`fdate`=$mt4.`Id` and $mt2.`fdate`=$mt4.`Id` and $mt4.`Id`=$id group by $mt4.`Id`");
if (!is_array($ListItemShow["select"])) {
    $ListItemShow["select"] = array();
}
$ListItemShowC = $ListItemShow["select"][0];
$itemlist = unserialize($ShowItemC[0]["fitem"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳当代医疗美容医院</title>
    <link href="CSS/Style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="Cont">
    <div class="Tinfo">
        <h3>贵阳当代医疗美容医院网络部数据报表</h3>
    </div>
</div>
<div class="Cont">
    <?
    $today2 = date("Y年m月d日", $ListItemShowC["indate"] - 3600 * 24);
    if ($myaction != "emailshow") {
        ?>
        <div class="Tinfo">
            <div style="float:left;"><strong>您现在的位置：</strong>新增报表 <a href="./list.php">查看报表</a>&nbsp;&nbsp;</div>
            <div style="float:left; position:relative;">
                <div><a href="javascript:;" target="_self" style="color:#F00; font-weight:bold;" onclick="ShowNote()">获取简报</a>
                </div>
                <div style="position:absolute; top:30px; left:0px; border:solid 1px #CCC; background:#eeeeee; padding:10px 5px; line-height:22px; width:300px; display:none;"
                     id="MiniRe" onmouseover="ShowNote()" onmouseout="HiddenNote()">
            <span id="MiniReCont">
        		<?= $today2 ?>（9时-23时59分）网络数据<br/>
                --------------------------------------------------------<br/>
                总 咨 询：<?= $ListItemShowC["talkall"] + $ListItemShowC["bqq"] ?>个（商务通<?= $ListItemShowC["talkall"] ?>个，企业QQ<?= $ListItemShowC["bqq"] ?>个）<br/>
                有效对话：<?= $ListItemShowC["talkall"] + $ListItemShowC["bqq"] - $ListItemShowC["notalk"] ?>个（商务通<?= $ListItemShowC["talkall"] - $ListItemShowC["notalk"] ?>个，企业QQ<?= $ListItemShowC["bqq"] ?>个）<br/>
                下单：<?= $ListItemShowC["issys"] ?>个<br/>
                到诊：<?= $ListItemShowC["isfrom"] ?>个<br/>
                成交：<?= $ListItemShowC["isok"] ?>个<br/>
                行政无效类：<?= $ListItemShowC["notalk"] ?>个<br/>
                已到院重复：<?= $ListItemShowC["retalk1"] ?>个<br/>
                未到院重复：<?= $ListItemShowC["retalk2"] ?>个<br/>
                --------------------------------------------------------<br/>
                <?
                foreach ($itemlist as $ik => $iv) {
                    $ik1 = dcode($ik);
                    $ikshow = $ItemShowC2[$ik1];
                    if ($iv[1] > 0) {
                        ?>
                        <?= $ikshow . "：" . $iv[1] ?>个，留电：<?= $iv[0] ?>个<br/>
                        <?
                    }
                }
                ?>
                --------------------------------------------------------<br/>
                消费：<?= $ListItemShowC["fmoney"] ?>元<br/>
                咨询成本：<?= round($ListItemShowC["fmoney"] / ($ListItemShowC["talkall"] + $ListItemShowC["bqq"] - $ListItemShowC["notalk"]), 2) ?>元/个<br/></span>
                    <strong><a href="javascript:;" target="_self" onclick="MyCopy()">点击复制以内内容</a> | <a
                                href="javascript:;" target="_self" style="color:#F00; font-weight:bold;"
                                onclick="HiddenNote()">关闭简报</a></strong>
                </div>
            </div>
        </div>
        <?
    }
    ?>
    <div class="Tinfo" style="text-align:center; border-bottom:solid 1px #cccccc;">
        <font color="green"><strong>&gt;&gt; 以下是<?= $today2 ?>数据 &lt;&lt;</strong>&nbsp;</font>
    </div>
    <div class="Content">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td align="right" width="200">资金投入：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["fmoney"] ?>元</td>
                <td align="right">手机投入：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["wapmoney"] ?>元</td>
                <td align="right">PC投入：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["fmoney"] - $ListItemShowC["wapmoney"] ?>元</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right">点击次数：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["fclick"] ?>次</td>
                <td align="right">展现量：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["fshow"] ?>次</td>
                <td align="right">&nbsp;</td>
                <td bgcolor="#CCE9F0">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right">商务通对话：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["talkall"] ?>个</td>
                <td align="right">手机对话：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["talkwap"] ?>个</td>
                <td align="right">PC对话：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["talkall"] - $ListItemShowC["talkwap"] ?>个</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right">到院重复对话：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["retalk1"] ?>个</td>
                <td align="right">未到院重复对话：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["retalk2"] ?>个</td>
                <td align="right">行政无效对话：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["notalk"] ?>个</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right">下单人数：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["issys"] ?>人</td>
                <td align="right">到诊人数：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["isfrom"] ?>人</td>
                <td align="right">成交人数：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["isok"] ?>人</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right">网站访问量：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["webip"] ?>次</td>
                <td align="right">企业QQ对话：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["bqq"] ?>个</td>
                <td>&nbsp;</td>
                <td bgcolor="#CCE9F0">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
                <td align="right">有效对话(加企业QQ<?= $ListItemShowC["bqq"] ?>个)：</td>
                <td bgcolor="#CCE9F0"><?= $ListItemShowC["talkall"] + $ListItemShowC["bqq"] - $ListItemShowC["notalk"] ?>
                    个
                </td>
                <td align="right">对话成本：</td>
                <td bgcolor="#CCE9F0"><?= round(($ListItemShowC["fmoney"] / $ListItemShowC["talkall"]), 2) ?>元</td>
                <td>&nbsp;</td>
                <td bgcolor="#CCE9F0">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right">下单率：</td>
                <td bgcolor="#CCE9F0"><?= round(($ListItemShowC["issys"] / ($ListItemShowC["talkall"] - $ListItemShowC["notalk"]) * 100), 2) ?>
                    %
                </td>
                <td align="right">到诊率：</td>
                <td bgcolor="#CCE9F0"><?= round(($ListItemShowC["isfrom"] / ($ListItemShowC["talkall"] - $ListItemShowC["notalk"]) * 100), 2) ?>
                    %
                </td>
                <td align="right">成交率：</td>
                <td bgcolor="#CCE9F0"><?= round(($ListItemShowC["isok"] / $ListItemShowC["isfrom"] * 100), 2) ?>%</td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <div class="clearit"></div>
    </div>
    <div class="Content" style="border-top:solid 1px #999999; margin:20px 0px 0px 0px; padding:20px 0px 0px 0px;">
        <div class="Item"><strong>项目：<br/>咨询量：<br/>下单量：<br/>消费：<br/>咨询单体：</strong></div>
        <?
        #print_r($ItemShowC);
        foreach ($itemlist as $ik => $iv) {
            $ss++;
            ?>
            <div class="Item<? if ($ss % 2 == 1) {
                echo " Item2";
            } ?>">
                <?
                $ik1 = dcode($ik);
                $ikshow = $ItemShowC2[$ik1];
                $onetalkprice = round(($iv[2] / $iv[1]), 2);
                if ($onetalkprice > 200) {
                    $onetalkprice = "<font color=\"#FF0000\"><strong>" . $onetalkprice . "</strong></font>";
                }
                if ($onetalkprice < 150 && $onetalkprice > 0) {
                    $onetalkprice = "<font color=\"#008000\"><strong>" . $onetalkprice . "</strong></font>";
                }
                if ($iv[1] > 0) {
                    echo $ikshow . "<br />" . $iv[1] . "<br />" . $iv[0] . "<br />" . $iv[2] . "<br />" . $onetalkprice;
                }
                ?>
            </div>
            <?
        }
        ?>
        <div class="clearit"></div>
    </div>
    <div class="Content" style="border-top:solid 1px #999999; margin:20px 0px 0px 0px; padding:20px 0px 0px 0px;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th height="30">编号</th>
                <th>日期</th>
                <th>账户类型</th>
                <th>资金投入</th>
                <th>手机投入</th>
                <th>PC投入</th>
                <th>点击次数</th>
                <th>展现量</th>
                <th>点击价格</th>
            </tr>
            <?
            $ListSRes = $YumDamSql->selectsql("SELECT $mt4.`selecttime`,$mt4.`indate`,$mt2.`fmoney`,$mt2.`wapmoney`,$mt2.`fclick`,$mt2.`fshow`,$mt1.`cname` FROM  $mt4,$mt2,$mt1 where $mt4.`Id`=$mt2.`fdate` and $mt2.`fclass`=$mt1.`Id` and $mt4.`Id`=$id order by $mt4.`Id` desc,$mt4.`selecttime` desc");
            if (!is_array($ListSRes["select"])) {
                $ListSRes["select"] = array();
            }
            $List = $ListSRes["select"];
            foreach ($List as $lk => $lv) {
                $i++;
                ?>
                <tr>
                    <td align="center"><?= $i ?></td>
                    <td align="center" bgcolor="#CAE8F2"><?= timetodate($lv["selecttime"], true) ?></td>
                    <td align="center"><?= $lv["cname"] ?></td>
                    <td align="center" bgcolor="#CAE8F2"><?= $lv["fmoney"] ?></td>
                    <td align="center"><?= $lv["wapmoney"] ?></td>
                    <td align="center" bgcolor="#CAE8F2"><?= $lv["fmoney"] - $lv["wapmoney"] ?></td>
                    <td align="center"><?= $lv["fclick"] ?></td>
                    <td align="center" bgcolor="#CAE8F2"><?= $lv["fshow"] ?></td>
                    <td align="center"><?= round($lv["fmoney"] / $lv["fclick"], 2) ?></td>
                </tr>
                <?
            }
            ?>
            <tr>
                <td colspan="2" align="center">&nbsp;</td>
                <td align="center"><strong>当日全账户</strong></td>
                <td align="center" bgcolor="#CAE8F2"><?= $ListItemShowC["fmoney"] ?></td>
                <td align="center"><?= $ListItemShowC["wapmoney"] ?></td>
                <td align="center" bgcolor="#CAE8F2"><?= $ListItemShowC["fmoney"] - $ListItemShowC["wapmoney"] ?></td>
                <td align="center"><?= $ListItemShowC["fclick"] ?></td>
                <td align="center" bgcolor="#CAE8F2"><?= $ListItemShowC["fshow"] ?></td>
                <td align="center"><?= round($ListItemShowC["fmoney"] / $ListItemShowC["fclick"], 2) ?></td>
            </tr>
        </table>
    </div>
    <?
    if ($ListItemShowC["ismail"] == "1") {
        ?>
        <div class="ContBtn" id="ToEmail">
            <a href="javascript:;" class="inputbtn"
               onclick="ToEmail('<?= ecode($id) ?>','<?= encode("http://i.dangdai.cc/webaccount/m.php?at=" . encode("emailshow") . "&d=" . ecode($ListItemShowC["Id"]) . "&d2=" . ecode($ListItemShowC["indate"])) ?>','<?= ecode($ListItemShowC["indate"]) ?>')">发送报表</a>
        </div>
        <?
    }
    ?>
    <div class="clearit"></div>
</div>
<script type="text/javascript" src="Scripts/yumdam.my.js"></script>
<script type="text/javascript">
    function ToEmail(a, b, c) {
        if (!confirm('确定要发送邮件吗?')) {
            return false;
        }
        var a = a;
        var b = b;
        if (a == "" || b == "") {
            return false;
        }
        var url = "m.php?at=<?=encode("email")?>&a=" + a + "&b=" + b + "&c=" + c + "&r=" + Math.random();
        //alert(url);
        request.open("GET", url, true);
        document.getElementById("ToEmail").innerHTML = "系统正在处理中……";
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                document.getElementById("ToEmail").innerHTML = response;
            } else {
                document.getElementById("ToEmail").innerHTML = "系统正在处理中……";
            }
        }
        request.send(null);
    }


    function ShowNote() {
        document.getElementById("MiniRe").style.display = "block";
    }

    function HiddenNote() {
        document.getElementById("MiniRe").style.display = "none";
    }

    function MyCopy() {
        var copy = document.getElementById("MiniReCont").innerText;
        if (window.clipboardData) {
            window.clipboardData.setData("Text", copy);
        } else if (window.netscape) {
            netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');
            var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
            //if (!clip) return;
            var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
            //if (!trans) return;
            trans.addDataFlavor('text/unicode');
            var str = new Object();
            var len = new Object();
            var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
            var copytext = copy;
            str.data = copytext;
            trans.setTransferData("text/unicode", str, copytext.length * 2);
            var clipid = Components.interfaces.nsIClipboard;
            clip.setData(trans, null, clipid.kGlobalClipboard);
        }
    }
</script>
</body>
</html>