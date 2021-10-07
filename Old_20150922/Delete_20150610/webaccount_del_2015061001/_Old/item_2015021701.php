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

if (getip() != "61.236.191.15") {
    exit;##该内容不能放入公用文件！
}

$myaction = $_GET["at"];
if ($myaction != "ls") {
    #exit;
}

$form = decode($_GET["e"]);###类型ID
$formname = decode($_GET["c"]);###类型名称

$mt1 = '#_@formclass';
$mt2 = '#_@formdata';
$mt3 = '#_@formdata3';
$mt4 = '#_@dataclass';
$mt5 = '#_@itemclass';
$mt6 = '#_@formdata2';


#####################################################################################
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳当代医疗美容医院</title>
    <link href="CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="Scripts/yumdam.my.js"></script>
</head>

<body>
<?
@include_once("Inc/head.php");
?>
<div class="Cont">
    <?
    if ($myaction == "list") {
        $listtoday = time();
        $listshowtody = date("Y年m月d日", $listtoday);
        $listshowtime = $listtoday - 3600 * 24 * 5;
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


###################################################################################################################################
        $ItemSRes = $YumDamSql->selectsql("SELECT `Id`,`iname` as aname FROM  $mt5 where `isshow`='1' and TId=0");
        if (!is_array($ItemSRes["select"])) {
            $ItemSRes["select"] = array();
        }
        $ItemClass = $ItemSRes["select"];
        $ItemClassShow = array();
        foreach ($ItemClass as $k => $cv) {
            $ItemClassShowC = array();
            $ItemClassShowC = $cv;
            $where = " `TId`=" . $cv["Id"] . " and `isshow`=1";
            $ItemClass2 = $YumDamSql->selectdb("Id,iname", $mt5, $where);
            $ItemClassShowC["row"] = $ItemClass2["row"];
            $ItemClassShowC["son"] = $ItemClass2["select"];
            $ItemClassShow[] = $ItemClassShowC;
        }
###################################################################################################################################
        $ItemList = $YumDamSql->selectsql("SELECT $mt6.`fitem`,$mt4.`selecttime` FROM  $mt6,$mt4 where $mt6.`fdate`=$mt4.`Id` and $mt4.`selecttime` between " . $listshowmin . " and " . $listshowmax);


        #print_r($ItemClassShow);#exit;
        $ItemListSonArray = array();
        foreach ($ItemClassShow as $ak => $av) {
            foreach ($av["son"] as $sk => $sv) {
                $ItemListSonArray[] = $sv;
            }
        }


        ?>
        <div class="Tinfo">
            <strong>您现在的位置：</strong>查看报表 <a href="./">新增报表</a>
        </div>
        <div class="Tinfo" style=" border-bottom:solid 1px #cccccc; height:50px; line-height:50px;">
            日期： <input type="text" value="<?= $CookieDate1 ?>" id="d1" class="InPutTxt" style="width:120px"
                       readonly="readonly" onclick="choose_date_czw('d1')"/> - <input type="text"
                                                                                      value="<?= $CookieDate2 ?>"
                                                                                      id="d2" class="InPutTxt"
                                                                                      style="width:120px"
                                                                                      readonly="readonly"
                                                                                      onclick="choose_date_czw('d2')"/>
            &nbsp; <input type="button" value="查询" id="sbtn" class="B"/> &nbsp; <font color="#FF0000">温馨提示：为了系统正常运行，选择日期段不要太长！</font>
        </div>
        <div class="Content" id="sdata">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <th height="30">&nbsp;</th>
                    <?
                    foreach ($ItemClassShow as $ak => $av) {
                        $i++;
                        $bgcolor = $i % 2 == 1 ? "style=\"background:#cccccc;\"" : "";
                        ?>
                        <th colspan="<?= $av["row"] ?>"<?= $bgcolor ?>><?= $av["aname"] ?></th>
                        <?
                    }
                    ?>
                </tr>
                <tr>
                    <td height="30">日期</td>
                    <?
                    foreach ($ItemClassShow as $ak => $av) {
                        foreach ($av["son"] as $sk => $sv) {
                            ?>
                            <td><?= $sv["iname"] ?></td>
                            <?
                        }
                    }
                    ?>
                </tr>
                <tr>
                    <td height="30">日期</td>
                    <?
                    foreach ($ItemListSonArray as $ak2 => $av2) {
                        ?>
                        <td><?= $av2["iname"] ?></td>
                        <?
                    }
                    ?>
                </tr>
                <?
                foreach ($ItemList["select"] as $ssk => $ssv) {
                    ?>
                    <tr>
                        <td height="30"><?= timetodate($ssv["selecttime"], true) ?></td>
                        <?
                        $itemcont = unserialize($ssv["fitem"]);
                        foreach ($ItemListSonArray as $lk => $lv) {
                            ?>
                            <td><?= $itemcont[ecode($lv["Id"])][0] ?></td>
                            <?
                        }
                        /*foreach($ItemClassShow as $ak2=>$av2){
                        {

                            foreach($av["son"] as $sk=>$sv){
                                echo "<td>".$sv["Id"]."</td>";
                                }
                            }*/
                        #echo "<td>"; print_r($itemcont); echo "</td>";
                        ?>
                    </tr>
                    <?
                }
                ?>
            </table>
            <div class="clearit"></div>
        </div>
        <script type="text/javascript">
            function myst() {
                var d1 = document.getElementById("d1").value;
                var d2 = document.getElementById("d2").value;
                if (d1 == "" || d1 == "0" || d2 == "" || d2 == "0") {
                    return false;
                }
                var url = "ld.php?action=<?=encode("list")?>&d1=" + d1 + "&d2=" + d2 + "&r=" + Math.random();
                request.open("GET", url, true);
                document.getElementById("sdata").innerHTML = "查询中……";
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        var response = request.responseText;
                        document.getElementById("sdata").innerHTML = response + "<div class=\"clearit\"></div>";
                    }
                }
                request.send(null);
            }

        </script>
        <?
    }
    ?>
    <div class="clearit"></div>
</div>
</body>
</html>