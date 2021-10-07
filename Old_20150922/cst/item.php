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

$myat = decode($_GET["ma"]);
$myaction = $_GET["at"];
#####################################################################################
$listtoday = time();
$listshowtody = date("Y年m月d日", $listtoday);
$listshowtime = $listtoday - 3600 * 24 * 10;
$listshowtime1 = $listtoday - 3600 * 24;
$listshowdate = date("Ymd", $listshowtime);
$listshowdate2 = date("Ymd", $listshowtime1);

$listshowmin = strtotime($listshowdate . "00:00:00");
$listshowmax = strtotime($listshowdate2 . "23:59:59");

$CookieDate1 = $_COOKIE["vd1"];
$CookieDate2 = $_COOKIE["vd2"];
if (empty($CookieDate1)) {
    $CookieDate1 = $listshowmin;
}
if (empty($CookieDate2)) {
    $CookieDate2 = $listshowmax;
}
$CookieDate1 = date("Y-m-d", $CookieDate1);
$CookieDate2 = date("Y-m-d", $CookieDate2);
if ($myat == "list") {
    $GoURL = "lt.php";
} else {
    $GoURL = "li.php";
}

$mu = "#_@mobilelogin";
$UserList = $YumDamSql->selectdb(" Id,ucname ", $mu, " `usergroup`='2' and `IsDisplay`='1'");
if (!is_array($UserList["select"])) {
    $UserList["select"] = array();
}
$UserListC = $UserList["select"];
#print_r($UserListC);echo "\n\n<br><br>";
##########################################以上为用户数据############################################################

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
    <div class="Tinfo" style=" border-bottom:solid 1px #cccccc; height:50px; line-height:50px;">
        日期： <input type="text" value="<?= $CookieDate1 ?>" id="d1" class="InPutTxt"
                   style="width:120px; cursor:pointer; _cursor:hand;" readonly="readonly"
                   onclick="choose_date_czw('d1')"/> - <input type="text" value="<?= $CookieDate2 ?>" id="d2"
                                                              class="InPutTxt"
                                                              style="width:120px; cursor:pointer; _cursor:hand;"
                                                              readonly="readonly" onclick="choose_date_czw('d2')"/>
        &nbsp; <select name="uc" id="uc">
            <option value="0">-全部-</option><? foreach ($UserListC as $ck => $cv) { ?>
                <option value="<?= ecode($cv["Id"]) ?>"><?= $cv["ucname"] ?></option><? } ?>
        </select> &nbsp; <select name="uc2" id="uc2">
            <option value="0">详细</option>
            <option value="1" selected="selected">统计</option>
        </select> &nbsp; <input type="button" value="查询" id="sbtn" class="B"/> &nbsp; <input type="button"
                                                                                             value="导出Excel" id="sbtn"
                                                                                             onclick="alert('功能暂未开通，敬请期待！')"
                                                                                             class="B"/> &nbsp; <font
                color="#FF0000">温馨提示：为了系统正常运行，选择日期段不要太长！</font>
    </div>
    <div class="Content" id="sdata">
        <strong style="color:#F00; line-height:60px;">选择日期进行查询，日期格式请不要选错！点击查询！</strong>
        <div class="clearit"></div>
    </div>
    <script type="text/javascript">
        function mylistst() {
            var d1 = document.getElementById("d1").value;
            var d2 = document.getElementById("d2").value;
            var d3 = document.getElementById("uc").value;
            var d4 = document.getElementById("uc2").value;
            if (d1 == "" || d1 == "0" || d2 == "" || d2 == "0") {
                return false;
            }
            var url = "Ajax/<?=$GoURL?>?action=<?=encode("list")?>&d1=" + d1 + "&d2=" + d2 + "&d3=" + d3 + "&d4=" + d4 + "&r=" + Math.random();
            request.open("GET", url, true);
            document.getElementById("sdata").innerHTML = "查询中……";
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var response = request.responseText;
                    document.getElementById("sdata").innerHTML = response + "<div class=\"clearit\"></div>";
                }
            }
            request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            request.send(null);
        }

        document.getElementById("sbtn").onclick = mylistst;
        //window.onload=mylistst;
    </script>
    <div class="clearit"></div>
</div>
</body>
</html>