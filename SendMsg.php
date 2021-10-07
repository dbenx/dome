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
include("./Config/Config.Inc.php");####加载配置文件


if ($YumDamGId != "1" && $YumDamGId != "5") {
    YumDamShowMsgExit("抱歉,您未获得此权限！", "./");
    exit;
}


$str = md5(time());


if ($_POST) {
    if (empty($mscont2) || empty($mscont)) {
        exit("数据有误！");
    }
    if ($mscont3 != decode($mscont4)) {
        exit("验证错误！");
    }
    $mt = "#_@sendlogs";
    $field1 = "`UId`,`ulist`,`ucont`,`InDate`,`InIp`";
    $field2 = "'" . $YumDamSId . "','$mscont2','$mscont'," . time() . ",'" . getip() . "'";
    $IRes = $YumDamSql->insertdb($mt, $field1, $field2);
    if ($IRes["affect"] == "1") {
        @include("./Config/YumDam.MSG.php");####加载配置文件
        $SendMsg = new YumDamMSG();
        $SendMsg->SetTel($mscont2);
        $SendMsgRe = $SendMsg->SendCont($mscont);
        # print_r($SendMsg->NumArray);
        #print_r($SendMsgRe);
        if ($SendMsgRe["result"] != "0") {
            echo "抱歉，发送失败，请返回重试！";
            exit;
        }
        echo "<script type=\"text/javascript\"> alert(\"恭喜，全部发送成功！\");window.location.href=\"/SendMsg.php?f=su\"; </script>";
    }


    exit;
}


###################################################################################################################################
###################################################################################################################################
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳美莱医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="./Scripts/yumdam.my.js"></script>
</head>

<body>
<div class="Cont">
    <div class="DivTitle" style="border-bottom:solid 1px #791d77;">短信发送<? if ($YumDamGId == "5") { ?> &nbsp; | &nbsp; <a
                href="./Login/pr.php" target="mainframe">密码修改</a><? } ?></div>
    <div class="Content">
        <form method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="250" align="right">电话号码：</td>
                    <td><textarea name="mscont2" id="mscont2"
                                  style="width:420px; height:200px; line-height:25px; padding:5px; font-weight:bold;"></textarea>&nbsp;号码用<strong>英文</strong>逗号隔开,去掉最后一个逗号
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right">&nbsp;</td>
                </tr>
                <tr>
                    <td height="60" align="right">短信内容：</td>
                    <td><textarea name="mscont" id="mscont"
                                  style="width:420px; height:200px; line-height:25px; padding:5px; font-weight:bold;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td height="60" align="right">验证码：</td>
                    <td><input type="text" name="mscont3" id="mscont3" class="InPutTxt"/><input type="hidden"
                                                                                                value="<?= encode($str) ?>"
                                                                                                name="mscont4"
                                                                                                id="mscont4"/>&nbsp;输入以下内容
                    </td>
                </tr>
                <tr>
                    <td height="60" align="right">&nbsp;</td>
                    <td><?= $str ?></td>
                </tr>
                <tr>
                    <td height="60" align="right">&nbsp;</td>
                    <td><input type="submit" class="B" value="发送"/></td>
                </tr>
            </table>
        </form>
    </div>
</div>
</body>
</html>