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

if (empty($CookieDate1)) {
    $CookieDate1 = $YesToday;
}

$CookieDate1 = date("Y-m", $CookieDate1);
#####################################################################################

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳美莱医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body>
<div class="Cont">
    <div class="Tinfo" style=" border-bottom:solid 1px #cccccc; height:auto; padding:15px 0px;">日期： <input type="text"
                                                                                                           value="<?= $CookieDate1 ?>"
                                                                                                           id="d1"
                                                                                                           class="InPutTxt"
                                                                                                           style="width:120px; cursor:pointer; _cursor:hand;"
                                                                                                           readonly="readonly"
                                                                                                           onclick="YumDamChooseDate('d1')"/>
        &nbsp; <input type="button" value="查询" id="sbtn" class="B"/>
        <div class="clearit"></div>
    </div>
    <div class="Content" style="padding:15px 0px;" id="sdata">
        <div class="clearit"></div>
    </div>
    <div class="clearit"></div>
</div>
<script type="text/javascript">
    function mylistst() {
        var d1 = document.getElementById("d1").value;
        if (d1 == "" || d1 == "0") {
            return false;
        }
        var url = "./Ajax/dtable.php?action=<?=encode("list")?>&d1=" + d1 + "&d2=&r=" + Math.random();
        request.open("GET", url, true);
        //document.getElementById("sdata").innerHTML="查询中……";
        MyYumDamLoadingShow();
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

    document.getElementById("sbtn").onclick = mylistst;
    window.onload = mylistst;
</script>
</body>
</html>