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
$listtoday = time();
$listshowtody = date("Y年m月d日", $listtoday);
$listshowtime = $listtoday - 3600 * 24 * 1;
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
if ($myaction == "templist") {
    $GoURL = "tl.php";
} elseif ($myaction == "list") {
    $GoURL = "ld.php";
} elseif ($myaction == "d") {
    $GoURL = "data.php";
} else {
    $GoURL = "ld.php";
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
    <div class="Tinfo" style=" border-bottom:solid 1px #cccccc; height:50px; line-height:50px; display:none;">
        日期： <input type="text" value="<?= $CookieDate1 ?>" id="d1" class="InPutTxt"
                   style="width:120px; cursor:pointer; _cursor:hand;" readonly="readonly"
                   onclick="choose_date_czw('d1')"/> - <input type="text" value="<?= $CookieDate2 ?>" id="d2"
                                                              class="InPutTxt"
                                                              style="width:120px; cursor:pointer; _cursor:hand;"
                                                              readonly="readonly" onclick="choose_date_czw('d2')"/>
        &nbsp; <input type="button" value="查询" id="sbtn" class="B"/> &nbsp; <font color="#FF0000">温馨提示：为了系统正常运行，选择日期段不要太长！</font>
    </div>
    <div class="Content" id="sdata">
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
            var url = "Ajax/<?=$GoURL?>?action=<?=encode("list")?>&d1=" + d1 + "&d2=" + d2 + "&r=" + Math.random();
            request.open("GET", url, true);
            MyYumDamLoadingShow();
            //document.getElementById("sdata").innerHTML="查询中……";
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var response = request.responseText;
                    document.getElementById("sdata").innerHTML = response + "<div class=\"clearit\"></div>";
                    MyYumDamLoadingShow("Ok");
                }
            }
            request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            request.send(null);
        }

        function _GoToLink(murl, cont) {
            var cont = cont || "";
            if (cont != "") {
                var _cont = document.getElementById(cont).value;
                if (_cont == "") {
                    return false;
                }
                cont = "&yumdamc=" + encodeURIComponent(_cont);
            }
            var url = murl + cont + "&r=" + Math.random();
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


        function GoT(d, k) {
            if (d == "" || d == "0") {
                return false;
            }
            if (confirm('确认操作行为！') == false) {
                return false;
            }
            var url = "Ajax/sd.php?<?=$_SERVER["QUERY_STRING"]?>&dt=" + d + "&di=" + k + "&m2=<?=encode("inda")?>&action=<?=encode("list")?>&r=" + Math.random();
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


        function _SendMoreMsg() {
            var str = document.getElementsByName("tbox");
            var objarray = str.length;
            var chestr = "";
            for (i = 0; i < objarray; i++) {//牛图库JS特效，http://js.niutuku.com/
                if (str[i].checked == true) {
                    chestr += str[i].value + ",";
                }
            }//牛图库JS特效，http://js.niutuku.com/
            if (chestr == "") {
                alert("抱歉，您没有选择号码，请选择号码！");
            } else {
                return false;
            }
        }

    </script>
    <div class="clearit"></div>
</div>
</body>
</html>