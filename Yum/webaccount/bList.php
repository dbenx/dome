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
    $CookieDate1 = $YesToday;
}
if (empty($CookieDate2)) {
    $CookieDate2 = $CookieDate1;
}
$CookieDate1 = date("Y-m-d", $CookieDate1);
$CookieDate2 = date("Y-m-d", $CookieDate2);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>美莱医疗美容医院</title>
    <link href="../CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../Scripts/yumdam.my.js"></script>
</head>

<body oncontextmenu="return false;">
<div class="Cont">
    <div class="DivTitle" style="font-size:14px;">
        日期： <input type="text" value="<?= $CookieDate1 ?>" id="d1" class="InPutTxt"
                   style="width:120px; cursor:pointer; _cursor:hand;" readonly="readonly"
                   onclick="choose_date_czw('d1')"/> - <input type="text" value="<?= $CookieDate2 ?>" id="d2"
                                                              class="InPutTxt"
                                                              style="width:120px; cursor:pointer; _cursor:hand;"
                                                              readonly="readonly" onclick="choose_date_czw('d2')"/>
        &nbsp;&nbsp;
        查询模式：
        <select>
            <option disabled="disabled">总计</option>
            <option>详细</option>
        </select> &nbsp;&nbsp;
        选择来源：
        <select>
            <option>全部</option>
        </select> &nbsp;&nbsp;
        <input type="button" class="B" id="sbtn" value="查询"/>
    </div>
    <div class="Content" id="sdata">
        <strong style="color:#F00;">选择日期进行查询，日期格式请不要选错！</strong>
        <div class="clearit"></div>
    </div>
    <script type="text/javascript">
        window.onload = document.getElementById("sbtn").onclick = function () {
            var d1 = document.getElementById("d1").value;
            var d2 = document.getElementById("d2").value;
            var gourl = '<?=$myaction?>';
            if (gourl == "" || gourl == "0") {
                return false;
            }
            if (d1 == "" || d1 == "0" || d2 == "" || d2 == "0") {
                return false;
            }
            var MyUrl = "./Ajax/" + gourl + ".php?action=<?=encode("list")?>&d1=" + d1 + "&d2=" + d2 + "&r=" + Math.random();
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