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


/*******************************
 *   用来判断是否闰年的函数    *
 *   可以根据更复杂的算法改进  *
 *******************************/
function IsMyYear($year)
{
    if ($year % 4 == 0) // basic rule
    {
        return true; // is leap year
    } else {
        return false;
    }
}

/*******************************
 *   对一些变量进行赋值操作    *
 *   特别注意对二月份的赋值    *
 *******************************/
function ThisMonth()
{
    global $mon_num;
    $mon_num = array("31", "30", "31", "30", "31", "30", "31", "31", "30", "31", "30", "31");
    global $mon_name;
    $mon_name = array("一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二");
    if (IsMyYear($firstday[year])) // basic rule
    {
        $mon_num[1] = 29; // is leap year
    } else {
        $mon_num[1] = 28;
    }
}

/*******************************
 *   显示表格中的一格          *
 *   显示的内容和颜色可变      *
 *******************************/
function ShowCont($content, $show_color, $tdbgcolor = "#ffffff")
{
    $Today = date("d", time());
    if ($content == $Today) {
        $tdbgcolor = "#66CCFF";
    }
    $begin_mark = "<td width=\"60\" bgcolor=\"" . $tdbgcolor . "\">\n";
    $begin_mark = $begin_mark . "<font color=\"$show_color\">";
    $end_mark = "</font></td>";
    echo $begin_mark . $content . $end_mark;
}


/*******************************
 *   获取任务列表          *
 *   有就显示，没有就不显示，不影响正常日历
 *******************************/

function GetTalkList()
{
    global $YumDamSql, $YumDamSId;
    $mt = "#_@mytask";
    $ListTaskRes = $YumDamSql->selectsql("SELECT * FROM  $mt where `inid`='" . $YumDamSId . "' and `IsDisplay`='1'");
    $ListTaskResSelect = $ListTaskRes["select"];
    $ListTaskResArray = array();
    foreach ($ListTaskResSelect as $k => $v) {
        if ($v["TaskType"] == "1") {
            $ListTaskResArray[] = array("T" => $v["Title"], "D" => $v["MyCont"]);
        }
        if ($v["TaskType"] == "2" && date("w", time()) == date("w", $v["TaskDate"])) {
            $ListTaskResArray[] = array("T" => $v["Title"], "D" => $v["MyCont"]);
        }
        if ($v["TaskType"] == "3" && date("d", time()) == date("d", $v["TaskDate"])) {
            $ListTaskResArray[] = array("T" => $v["Title"], "D" => $v["MyCont"]);
        }
        if ($v["TaskType"] == "4" && date("Ymd", time()) == date("Ymd", $v["TaskDate"])) {
            $ListTaskResArray[] = array("T" => $v["Title"], "D" => $v["MyCont"]);
        }
    }
    return $ListTaskResArray;
}

$TaskList = GetTalkList();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳美莱医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="../Scripts/yumdam.my.js"></script>
    <style type="text/css">
        html, body {
            height: 100%;
        }

        .mytasklist {
            width: 100%;
            height: 100%;
            line-height: 35px;
            font-size: 14px;
            font-weight: bold;
            color: #00F;
            padding: 0px 0px 0px 15px;
        }

        .mytasklist span {
            color: #999;
            font-weight: normal;
        }
    </style>
</head>

<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="50%" rowspan="2" valign="top">
            <ul class="mytasklist">
                <?
                if (count($TaskList) > 0) {
                    ?>
                    <li style="font-size:18px; text-decoration:underline;">以下是今日「<?= date("Y年m月d日", time()) ?>
                        」需要完成的任务，请认真核对！
                    </li>
                    <?
                    foreach ($TaskList as $mk => $mv) {
                        $ii++;
                        echo $ii . "、" . $mv["T"] . "<br /><span>" . $mv["D"] . "</span><br />";
                    }
                } else {
                    echo "暂未添加每日计划任务！请尽快完善！<a href=\"intask.php\" target=\"mainframe\">点击新增计划</a>";
                }
                ?>
            </ul>
        </td>
        <td height="50%">
            <?
            //获得当前的日期
            $firstday = getdate(mktime(0, 0, 0, date("m"), 1, date("Y")));

            ThisMonth();

            //显示表格的名称
            echo "<table border=\"0\" width=\"100%\" height=\"100%\" cellspacing=\"4\">\n";
            echo "<tr align=\"right\" style=\"height:25px;\"><td colspan=\"7\"><a href=\"intask.php?at=L\" target=\"mainframe\">管理计划</a> | <a href=\"intask.php\" target=\"mainframe\">新增计划</a></td></tr>\n";
            echo "<tr style=\"height:25px;\"><td colspan=\"7\">\n<center><font color=\"red\"><strong>" . $firstday[year] . "年" . $mon_name[$firstday[mon] - 1] . "月</strong></font></center></td></tr>\n";
            //表头
            $weekDay[0] = "日";
            $weekDay[1] = "一";
            $weekDay[2] = "二";
            $weekDay[3] = "三";
            $weekDay[4] = "四";
            $weekDay[5] = "五";
            $weekDay[6] = "六";

            echo "<tr align=\"center\" valign=\"center\" style=\"font-weight:bold;\">";

            //显示表格的第一行
            for ($dayNum = 0; $dayNum < 7; ++$dayNum) {
                ShowCont($weekDay[$dayNum], "red", "#cccccc");
            }

            echo "</tr>\n";

            $toweek = $firstday[wday];//本月的第一天是星期几
            $lastday = $mon_num[$firstday[mon] - 1];//本月的最后一天是星期几
            $day_count = 1;//当前应该显示的天数
            $up_to_firstday = 1;//是否显示到本月的第一天

            for ($row = 0; $row <= ($lastday + $toweek - 1) / 7; ++$row)//本月有几个星期
            {
                echo "<tr align=\"center\" valign=\"middle\">";
                for ($col = 1; $col <= 7; ++$col) {
//在第一天前面显示的都是"空"                             
                    if (($up_to_firstday <= $toweek) || ($day_count > $lastday)) {
                        echo "<td>&nbsp;</td>\n";
                        $up_to_firstday++;
                    } else {
//显示本月中的某一天                                        
                        ShowCont($day_count, "blue", "#CAE8F2");
                        $day_count++;
                    }
                }
                echo "</tr>\n";
            }

            echo "</table>";
            ?>
        </td>
    </tr>
    <tr>
        <td height="50%">&nbsp;</td>
    </tr>
</table>
</body>
</html>