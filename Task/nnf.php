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

if ($_POST) {
    if (decode($myset) == "mupload") {
        $mdir1 = "him/" . date("Ym", time()) . "/";
        $mdir = SiteRoot . "/Uploads/" . $mdir1;
        $fcont = $_POST["fd"];
        $ftitle = $_POST["ft"];
        $Re = YumDamUpload("mfile", $mdir);
        if ($Re != "false" && $Re != false) {
            $mt3 = '#_@himlist';
            $GoUrl = "lnf.php?f=" . rand(1, 999);
            $field1 = "`title`,`fname`,`fcont`,`InDate`,`uip`,`inid`";
            $field2 = "'" . $ftitle . "','$Re','" . $fcont . "','" . time() . "','" . getip() . "','" . $YumDamSId . "'";
            $YumDamSql->insertdb($mt3, $field1, $field2);
############################################发送微信报表#########################################################
            $WxTk = GetWXToken($wxappid, $wxsecret);
            $urlcont = "http://i.gyml.cc/Uploads/him/" . date("Ym", time()) . "/" . $Re . "?r=" . rand(1, 999999);
            #$urlcont="http://i.gyml.cc/webaccount/m.php?at=".encode("TS")."&d=".ecode($YesToday)."&d2=".rand(1,999999);
            $SendListRes = $YumDamSql->selectsql("SELECT `wxid` FROM  `#_@wxlogin` where `allow`='1' and `MyGroup` in (1,3)");

            if ($SendListRes["row"] > "0") {
                #print_r($SendListRes);exit;
                foreach ($SendListRes["select"] as $Sk => $Sv) {
                    #echo "1:".$Sv["wxid"]."||<br>\n".$WxTk."||<br>\n".$YesToday2."||<br>\n".$urlcont;
                    YumDamToWxMsg($WxTk, $Sv["wxid"], $YesToday2, $urlcont, "本期同行广告已生成！", $ftitle . "等");###发送微信
                }
            }
############################################发送微信报表#########################################################
            YumDamShowMsgExit("恭喜您,上传成功!", $GoUrl);
        } else {
            YumDamShowMsgExit("抱歉,上传失败！", $_SERVER["PHP_SELF"]);
        }
    }

    exit;

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳当代医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body oncontextmenu="return false;">
<div class="Cont">
    <div class="Content">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <form action="" name="myform" id="myform" enctype="multipart/form-data" method="post">
                <tr>
                    <td width="150" align="right">文件说明</td>
                    <td>
                        <input type="text" name="ft" id="ft" class="InPutTxt" value=""/>
                        <input type="hidden" name="myset" value="<?= encode("mupload") ?>"/>
                    </td>
                </tr>
                <tr>
                    <td width="150" align="right">敌情文件</td>
                    <td>
                        <input type="file" name="mfile" id="mfile" value="选择文件"/>
                    </td>
                </tr>
                <tr>
                    <td width="150" align="right">描述</td>
                    <td>
                        <textarea name="fd" id="fd"
                                  style="width:360px; height:80px; line-height:25px; padding:5px; font-weight:bold;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td align="right">&nbsp;</td>
                    <td><input type="submit" value="上传" class="B"/> &nbsp; <input type="button" value="清空" class="B"/>
                    </td>
                </tr>
            </form>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>1、上传文件格式为Doc,Docx,PPT,PPTX</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>2、描述敌情中亮点及大概内容，如：华美周年庆、华美明星来院等</td>
            </tr>
        </table>
        <div class="clearit"></div>
    </div>
    <div class="clearit"></div>
</div>
</body>
</html>