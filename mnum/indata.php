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
        $mdir1 = "Uploads/" . date("Ym", time()) . "/";
        $mdir = SiteRoot . "/mnum/" . $mdir1;
        $Re = YumDamUpload("mfile", $mdir);
        if ($Re != "false" && $Re != false) {
            $GoUrl = $_SERVER["PHP_SELF"] . "?mi=" . encode($Re) . "&me=" . encode($mdir1) . "&at=" . encode("ins");
            YumDamShowMsgExit("恭喜您,上传成功,系统正在导入数据，请不要关闭窗口……", $GoUrl);
        } else {
            YumDamShowMsgExit("抱歉,上传失败！", $_SERVER["PHP_SELF"]);
        }
    }

    exit;

}
if (decode($_GET["at"]) == "ins") {
    $myfile = decode($_GET["mi"]);
    $mydir = decode($_GET["me"]);
    $ismyfile = $mydir . $myfile;
#echo $ismyfile;exit;
    $temp = file($ismyfile);//连接EXCEL文件,格式为了.csv
    for ($i = 0; $i < count($temp); $i++) {
        $string = explode(",", $temp[$i]);//通过循环得到EXCEL文件中每行记录的值
//将EXCEL文件中每行记录的值插入到数据库中 


        $d1 = $string[1];
        $d2 = YumDamToStr(toutf8($string[2]));
        $d3 = YumDamToStr(toutf8($string[5]));
        $d4 = YumDamToStr(toutf8($string[6]));
        $d5 = YumDamToStr(toutf8($string[7]));
        $d6 = YumDamToStr(toutf8($string[8]));
        $d7 = YumDamToStr(toutf8($string[9]));
        $d8 = YumDamToStr(toutf8($string[10]));
        $d9 = YumDamToStr(toutf8($string[11]));
        if (empty($d1)) {
            $d1 = 0;
        }
        if (empty($d2)) {
            $d2 = 0;
        }
        if (empty($d3)) {
            $d3 = 0;
        }
        if (empty($d4)) {
            $d4 = 0;
        }
        if (empty($d5)) {
            $d5 = 0;
        }
        if (empty($d6)) {
            $d6 = 0;
        }
        if (empty($d7)) {
            $d7 = 0;
        }
        if (empty($d8)) {
            $d8 = 0;
        }
        if (empty($d9)) {
            $d9 = 0;
        }

        $field1 = "`mytelcode`,`nowurl`,`seachkey`,`fromsource`,`hardm`,`mybigcity`,`mycity`,`myinip`,`myvdate`,`indatadate`,`inuser`";
        $field2 = "'" . $d1 . "',\"" . $d2 . "\",\"" . $d3 . "\",\"" . $d4 . "\",\"" . $d5 . "\",\"" . $d6 . "\",\"" . $d7 . "\",\"" . $d8 . "\",'" . strtotime($d9) . "','" . time() . "','" . $YumDamSId . "'";
        $IRes = $YumDamSql->insertdb("`yumdam_tempmobilenumber`", $field1, $field2);
        if ($IRes["affect"] != "1") {
            exit("出现错误！01");
        }
        unset($string);
    }
    YumDamShowMsgExit("恭喜您,数据导入成功！", "./?at=templist");
    exit;
}


if (decode($_GET["at"]) == "ts") {
    $mt1 = '#_@tempmobilenumber';
    $mt2 = '#_@mobilenumber';
    $date1 = dcode($_GET["mi"]);
    $date2 = dcode($_GET["me"]);
    $ItemList = $YumDamSql->selectsql("SELECT * FROM  $mt1");
    foreach ($ItemList["select"] as $k => $v) {
        $field1 = "`mytelcode`,`nowurl`,`seachkey`,`fromsource`,`hardm`,`mybigcity`,`mycity`,`myinip`,`myvdate`,`indatadate`,`inuser`";
        $field2 = "'" . $v["mytelcode"] . "',\"" . $v["nowurl"] . "\",\"" . $v["seachkey"] . "\",\"" . $v["fromsource"] . "\",\"" . $v["hardm"] . "\",\"" . $v["mybigcity"] . "\",\"" . $v["mycity"] . "\",\"" . $v["myinip"] . "\",'" . $v["myvdate"] . "','" . $v["indatadate"] . "','" . $v["inuser"] . "'";
        $IRes = $YumDamSql->insertdb("`$mt2`", $field1, $field2);
        if ($IRes["affect"] != "1") {
            exit("出现错误！01");
        }
    }
    $YumDamSql->selectsql("TRUNCATE $mt1");
    YumDamShowMsgExit("恭喜您,正式数据导入成功！", "./?at=list");
    exit;
}

if (decode($_GET["at"]) == "tr") {
    $mt1 = '#_@tempmobilenumber';
    $YumDamSql->selectsql("TRUNCATE $mt1");
    YumDamShowMsgExit("恭喜您,临时数据清空成功！", "./?at=templist");
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
                    <td width="150" align="right">咨询项目</td>
                    <td>
                        <input type="file" name="mfile" id="mfile" value="选择文件"/>
                        <input type="hidden" name="myset" value="<?= encode("mupload") ?>"/>
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
                <td>1、上传文件格式为csv</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>2、上传文件中数据不能含有逗号(,)</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>3、上传文件中数据尽量整理不规则数据，如：设备栏</td>
            </tr>
        </table>
        <div class="clearit"></div>
    </div>
    <div class="clearit"></div>
</div>
</body>
</html>