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

$myaction = $_GET["at"];
#####################################################################################
if (empty($CookieDate1)) {
    $CookieDate1 = $YesToday + 3600 * 22;
}
if (empty($CookieDate2)) {
    $CookieDate2 = $CookieDate1;
}
$CookieDate1 = date("Y-m-d", $CookieDate1);
$CookieDate2 = date("Y-m-d", $CookieDate2);

if ($myaction == "M") {
    $GoURL = "mlt.php";
} else {
    $GoURL = "lt.php";
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

<body>
<?
#@include_once("Inc/head.php");
?>
<div class="Cont">
    <div class="Tinfo" style=" border-bottom:solid 1px #cccccc; height:50px; line-height:50px;">
        日期： <input type="text" value="<?= $CookieDate1 ?>" id="d1" class="InPutTxt"
                   style="width:120px; cursor:pointer; _cursor:hand;" readonly="readonly"
                   onclick="choose_date_czw('d1')"/> - <input type="text" value="<?= $CookieDate2 ?>" id="d2"
                                                              class="InPutTxt"
                                                              style="width:120px; cursor:pointer; _cursor:hand;"
                                                              readonly="readonly" onclick="choose_date_czw('d2')"/>
        &nbsp; <input type="button" value="查询" id="sbtn" class="B"/> &nbsp; <input type="button" value="导出Excel"
                                                                                   onclick="ToExcel()" class="B"/>
        &nbsp; <font color="#FF0000">温馨提示：为了系统正常运行，选择日期段不要太长！</font>
    </div>
    <div class="Content" id="sdata">
        <strong style="color:#F00;">选择日期进行查询，日期格式请不要选错！</strong>
        <div class="clearit"></div>
    </div>
    <script type="text/javascript">


        document.getElementById("sbtn").onclick = mylistst;
        window.onload = mylistst;

        function mylistst() {
            var d1 = document.getElementById("d1").value;
            var d2 = document.getElementById("d2").value;
            if (d1 == "" || d1 == "0" || d2 == "" || d2 == "0") {
                return false;
            }
            var MyUrl = "./Ajax/<?=$GoURL?>?action=<?=encode("list")?>&d1=" + d1 + "&d2=" + d2 + "&r=" + Math.random();
            request.open("GET", MyUrl, true);
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


    </script>
    <div class="clearit"></div>
</div>
</body>
</html>