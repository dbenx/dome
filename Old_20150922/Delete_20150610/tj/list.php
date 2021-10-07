<?
session_start();
header("Content-Type:text/html; charset=utf-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳当代医疗美容医院网站商务数据统计平台！</title>
    <script src="/js/My97DatePicker/WdatePicker.js"></script>
    <link rel="stylesheet" type="text/css" href="page.css"/>
    <style type="text/css">
        @charset "utf-8";
        /* CSS Document */
        /* 全局样式 */
        /*html { filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1); }*/
        * {
            margin: 0px;
            padding: 0px;
        }

        body, ul, ol, li, p, h1, h2, h3, h4, h5, h6, form, table, td, img, div {
            margin: 0;
            padding: 0;
            border: 0;
        }

        body {
            color: #000;
            font-size: 12px;
            margin: 0px;
            font-family: "宋体", "Arial Unicode MS";
            background: #FFF;
        }

        ul, ol {
            list-style-type: none;
            margin: 0px;
            padding: 0px;
            line-height: 25px;
        }

        select, input, img, select {
            vertical-align: middle;
        }

        a {
            text-decoration: none;
            border: none;
        }

        a:link {
            color: #000;
        }

        a:visited {
            color: #000;
        }

        a:hover, a:active, a:focus {
            color: #000;
            text-decoration: underline;
        }

        .clearit {
            clear: both;
        }


        .main {
            margin: 0 auto;
            width: 980px;
        }

        /*此处不能加背景色*/

        .Cont {
            height: auto;
            padding: 10px 20px;
            border: solid 1px #cccccc;
            margin-bottom: 10px;
        }

        .Tinfo {
            height: 30px;
            line-height: 32px;
            margin-bottom: 20px;
        }

        .Tinfo1 {
            height: 50px;
            line-height: 32px;
            margin-bottom: 20px;
        }

        .Content {
            height: auto;
        }

        .Content td {
            border-bottom: dashed 1px #cccccc;
            height: 35px;
            padding: 5px 10px;
        }

        .Content .noborder td {
            border-bottom: none;
        }

        .ContInfo {
            width: 300px;
            height: 120px;
            line-height: 24px;
            border: solid 1px #eeeeee;
            padding: 2px;
            font-weight: bold;
        }

        .ContBtn {
            height: 25px;
            line-height: 25px;
            padding: 10px 100px 10px 200px;
        }


        .InPutTxt {
            width: 300px;
            height: 28px;
            line-height: 28px;
            border: solid 1px #eeeeee;
            padding: 2px;
        }


    </style>
</head>

<body>

<?php


include_once("page.class.php");
include("../Config/Common.Inc.php");####加载配置文件
include("../Config/YumDam.Connet.php");####加载配置文件
include("../Config/Swt.Function.php");####加载配置文件
include("../Config/Config.Function.php");####加载配置文件

if (getip() != '61.236.191.15') {

    if (!isset($_SESSION["pwd"])) {

        echo '<form method="post">用户名:<input type="text" name="user" ><br/><br/>密码：<input type="password" name="pwd" ><input type="submit" value="查看"></form>';

        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';

        $user = $_POST['user'];

        if ($pwd == '' || $user == '') exit('请输入有效信息');

        if ($pwd == $npwd && $user == date('Ymd')) {

            $_SESSION['pwd'] = 'dnal';
            echo "<script type=\"text/javascript\"> \n alert('成功登录!');\n window.location.href=\"list.php\";\n</script>";

        } else {
            exit('输入错误，请重新输入！');
        }
    }

}


$uurl = $_SERVER['HTTP_REFERER'];
$forasp = strtolower($_SERVER['HTTP_USER_AGENT']);
$dirname = str_replace("\\", '/', dirname(__FILE__));
$pageSize = 20;

$sql = "select * from yumdam_swttj where 1=1";
$order = ' order by tdate ASC';

$endtime = date("Y-m-d", time());
$statime = date("Y-m-d", strtotime("-15 day"));
$where = " and tdate BETWEEN '" . $statime . "' and '" . $endtime . "'";


if (isset($_GET['page'])) {

    $limit = " limit " . (($pageSize * $page) - $pageSize) . "," . $pageSize;
} else {

    $limit = " limit 0 ," . $pageSize;
}

$message = "";
if (isset($_GET['sx'])) {

    $statime = $_GET['stadate'];//开始时间
    $endtime = $_GET['enddate'];//结束时间
    $item = $_GET['item'];//项目
    $age = $_GET['age'];//年龄
    $sex = $_GET['sex'];//性别
    $contact = $_GET['contact'];//联系方式
    $ly = $_GET['ly'];//来源
    $cf = $_GET['cf'];//是否重复咨询
    $zxs = $_GET['zxs'];//咨询师


    if ($statime == '' || $endtime == '') {

        $endtime = date("Y-m-d", time());
        $statime = date("Y-m-d", strtotime("-15 day"));
        $where = " and tdate BETWEEN '" . $statime . "' and '" . $endtime . "'";
        $message .= '日期：' . $statime . '至' . $endtime;
    } else {
        $where = " and tdate BETWEEN '" . $statime . "' and '" . $endtime . "'";
        $twhere = " and tdate BETWEEN '" . $statime . "' and '" . $endtime . "'";
        $message .= '日期：' . $statime . '至' . $endtime;

    }


    //判断项目，-1为没有选择
    if ($item != '-1') {
        $where .= " and item=" . $item;
        $message .= ' 项目：' . Getitem($item);
    }


    if ($age != '') {
        if (strstr($age, "-") != "") {
            $Arr = explode("-", $age);
            $where .= " and age BETWEEN '" . $Arr[0] . "' and '" . $Arr[1] . "'";
            $message .= ' 年龄:' . $Arr[0] . '至' . $Arr[1];
        } else {
            $where .= " and age=" . $age;
            $message .= ' 年龄:' . $age;
        }
    }


    if ($sex != '-1') {
        $where .= " and sex=" . $sex;
        $message .= ' 性别:' . Getsex($sex);
    }
    if ($contact != '-1') {
        $where .= " and contact=" . $contact;
        $message .= ' 联系方式:' . Getcontact($contact);
    }
    if ($ly != '-1') {
        $where .= " and ly=" . $ly;
        $message .= ' 来源:' . Getly($ly);
    }

    if ($cf != '-1') {
        $where .= " and cf=" . $cf;
        $message .= ' 是否重复:' . Getcf($cf);
    }
    if ($zxs != '-1') {
        $where .= " and zxs=" . $zxs;
        $message .= ' 咨询师:' . Getzxs($zxs);
    }

}

$sql .= $where . $order . $limit;

#echo $sql;

$YumDamSql = new YumDam_DB_Connet;

$SRes = $YumDamSql->selectsql($sql);


$Allres = $YumDamSql->selectsql('select * from yumdam_swttj where 1=1 ' . $where);


/*		if(($statime!=''&&$endtime!='')&&($item!=''||$age!=''||$sex!=''|| $sex!=''||$contact!=''||$ly!=''||$cf!=''||$zxs!=''))
		{
			$TAllres=$YumDamSql->selectsql('select id form yumdam_swttj where'.$twhere);
	
					
			if(!is_array($TAllres['select']))
			{
				$TAllres["select"]=array();
				}
				
			$TAnListCount=$TAllres["row"];	
		}
		
		*/


if (!is_array($SRes["select"])) {
    $SRes["select"] = array();
}


if (!is_array($Allres['select'])) {
    $Allres["select"] = array();
}


$AnList = $SRes["select"];

$AnListCount = $Allres["row"];


pageft($AnListCount, $pageSize, 1, 1, 1, 9, 20, 1);


?>


<div class="Cont">
    <div class="Tinfo"><h3>贵阳当代医疗美容医院网站商务数据统计平台！</h3></div>
</div>


<div class="Cont">
    <div class="Tinfo1">
        <table>
            <tr>
                <td style="font-size:16px; font-weight:bold;"><? echo $message ?> 共<font
                            color="#FF0000"><? echo $AnListCount; ?></font>条记录<br/>
                    <?php

                    if (isset($_GET['sx'])) {
                        if (($statime != '' && $endtime != '') && ($item != '-1' || $age != '' || $sex != '-1' || $contact != '-1' || $ly != '-1' || $cf != '-1' || $zxs != '-1')) {

                            #echo 'select * from yumdam_swttj where 1=1 '.$twhere.$order;
                            $TAllres = $YumDamSql->selectsql('select id from yumdam_swttj where 1=1 ' . $twhere);


                            if (!is_array($TAllres['select'])) {
                                $TAllres["select"] = array();
                            }

                            $TAnListCount = $TAllres["row"];

                            if ($TAnListCount != 0) {

                                $pp = round(($AnListCount / $TAnListCount) * 100, 2) . "％";//120%
                                echo '占比值：<u>' . $pp . '</u>';
                            }
                        }
                    }
                    ?>

                    <br/>


                </td>
                <td></td>
            </tr>
        </table>

    </div>
    <div class="Content">


        <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC" align="center">


            <tr height="30">
                <th>编号</th>
                <th>日期</th>
                <th>项目</th>
                <th>年龄</th>
                <th>性别</th>
                <th>联系方式</th>
                <th>来源</th>
                <th>是否重复</th>
                <th>咨询师</th>
            </tr>
            <form action="" method="get">
                <tr bgcolor="#996666" align="center">
                    <td><input type="submit" value="查询" name="sx"/><a href="list.php">清除条件</a></td>
                    <td>
                        开始时间：<input class="Wdate" type="text" onClick="WdatePicker()" name="stadate"
                                    style="height:20px; line-height:20px;" value="<? echo $statime ?>"><br/>
                        结束时间：<input class="Wdate" type="text" onClick="WdatePicker()" name="enddate"
                                    style="height:20px; line-height:20px;" value="<? echo $endtime ?>"></td>
                    <td><select name="item" id="item" style="height:20px; line-height:20px;">
                            <option value="-1" <?php if ($item == "-1") echo "selected" ?> >请选择项目</option>
                            <optgroup label="整形美容">
                                <option value="1" <?php if ($item == "1") echo "selected" ?>>吸脂整形</option>
                                <option value="2" <?php if ($item == "2") echo "selected" ?>>隆胸整形</option>
                                <option value="3" <?php if ($item == "3") echo "selected" ?>>鼻部整形</option>
                                <option value="4" <?php if ($item == "4") echo "selected" ?>>胸部整形</option>
                                <option value="5" <?php if ($item == "5") echo "selected" ?>>修复系列</option>
                                <option value="6" <?php if ($item == "6") echo "selected" ?>>眼部整形</option>
                                <option value="7" <?php if ($item == "7") echo "selected" ?>>眼袋整形</option>
                                <option value="8" <?php if ($item == "8") echo "selected" ?>>眉部整形</option>
                                <option value="9" <?php if ($item == "9") echo "selected" ?>>耳部整形</option>

                                <option value="10" <?php if ($item == "10") echo "selected" ?>>唇部整形</option>
                                <option value="11" <?php if ($item == "11") echo "selected" ?>>下颌整形</option>
                                <option value="12" <?php if ($item == "12") echo "selected" ?>>面部整形</option>
                                <option value="13" <?php if ($item == "13") echo "selected" ?>>自体脂肪</option>
                                <option value="14" <?php if ($item == "14") echo "selected" ?>>私密整形</option>
                            </optgroup>

                            <optgroup label="无创美容">
                                <option value="15" <?php if ($item == "15") echo "selected" ?>>无创注射</option>
                                <option value="16" <?php if ($item == "16") echo "selected" ?>>瘦脸针</option>
                                <option value="17" <?php if ($item == "17") echo "selected" ?>>注射填充</option>
                                <option value="18" <?php if ($item == "18") echo "selected" ?>>注射除皱</option>

                            </optgroup>

                            <optgroup label="皮肤美容">
                                <option value="19" <?php if ($item == "19") echo "selected" ?>>毛发移植</option>
                                <option value="20" <?php if ($item == "20") echo "selected" ?>>紧肤治疗</option>
                                <option value="21" <?php if ($item == "21") echo "selected" ?>>去皱拉皮</option>
                                <option value="22" <?php if ($item == "22") echo "selected" ?>>美白皮肤</option>
                                <option value="23" <?php if ($item == "23") echo "selected" ?>>祛斑治疗</option>
                                <option value="24" <?php if ($item == "24") echo "selected" ?>>祛痘治疗</option>
                                <option value="25" <?php if ($item == "25") echo "selected" ?>>疤痕治疗</option>
                                <option value="26" <?php if ($item == "26") echo "selected" ?>>取痣治疗</option>
                                <option value="27" <?php if ($item == "27") echo "selected" ?>> 红血丝</option>
                                <option value="28" <?php if ($item == "28") echo "selected" ?>>激光美容</option>
                                <option value="29" <?php if ($item == "29") echo "selected" ?>>美容护理</option>
                                <option value="30" <?php if ($item == "30") echo "selected" ?>>脱毛治疗</option>
                                <option value="31" <?php if ($item == "31") echo "selected" ?>>纹绣美容</option>
                                <option value="32" <?php if ($item == "32") echo "selected" ?>>美甲</option>
                            </optgroup>

                            <optgroup label="口腔美容">
                                <option value="33" <?php if ($item == "33") echo "selected" ?>>美容冠</option>
                                <option value="34" <?php if ($item == "34") echo "selected" ?>>正畸</option>
                                <option value="35" <?php if ($item == "35") echo "selected" ?>>牙齿美白</option>
                                <option value="36" <?php if ($item == "36") echo "selected" ?>>种植牙</option>
                                <option value="37" <?php if ($item == "37") echo "selected" ?>>牙外科</option>
                            </optgroup>

                            <option value="38" <?php if ($item == "38") echo "selected" ?>>其它</option>
                        </select></td>


                    <td><input name="age" type="text" id="stitle" style="height:20px; line-height:20px;"
                               onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)"
                               value="<? echo $_GET['age'] ?>"/></td>


                    <td><select name="sex" id="sex" style="height:20px; line-height:20px;">
                            <option value="-1" <?php if ($sex == "-1") echo "selected" ?> >请选择性别</option>
                            <option value="1" <?php if ($sex == "1") echo "selected" ?>>女</option>
                            <option value="2" <?php if ($sex == "2") echo "selected" ?>>男</option>
                            <option value="0" <?php if ($sex == "0") echo "selected" ?>>未知</option>
                        </select></td>
                    <td><select name="contact" id="contact" style="height:20px; line-height:20px;">
                            <option value="-1" <?php if ($contact == "-1") echo "selected" ?> >请选择联系方式</option>
                            <option value="1" <?php if ($contact == "1") echo "selected" ?>>电话</option>
                            <option value="2" <?php if ($contact == "2") echo "selected" ?>>QQ</option>
                            <option value="0" <?php if ($contact == "0") echo "selected" ?>>未留</option>
                        </select></td>
                    <td><select name="ly" id="ly" style="height:20px; line-height:20px;">
                            <option value="-1" <?php if ($ly == "-1") echo "selected" ?>>请选择来源</option>
                            <option value="1" <?php if ($ly == "1") echo "selected" ?>>PC</option>
                            <option value="2" <?php if ($ly == "2") echo "selected" ?>>移动</option>
                        </select></td>
                    <td><select name="cf" id="cf" style="height:20px; line-height:20px;">
                            <option value="-1" <?php if ($cf == "-1") echo "selected" ?>>请选择重复类型</option>
                            <option value="1" <?php if ($cf == "1") echo "selected" ?>>未重复</option>
                            <option value="2" <?php if ($cf == "2") echo "selected" ?>>术后重复咨询</option>
                            <option value="3" <?php if ($cf == "3") echo "selected" ?>>未上门重复咨询</option>
                            <option value="5" <?php if ($cf == "5") echo "selected" ?>>上门未成交重复咨询</option>
                        </select></td>
                    <td><select name="zxs" id="zxs" style="height:20px; line-height:20px;">
                            <option value="-1" <?php if ($zxs == "-1") echo "selected" ?>>请选择咨询师</option>
                            <option value="1" <?php if ($zxs == "1") echo "selected" ?>>当代国际整形专家邓思敏</option>
                            <option value="2" <?php if ($zxs == "2") echo "selected" ?>>当代国际整形专家董金枝</option>
                            <option value="3" <?php if ($zxs == "3") echo "selected" ?>>当代国际整形专家方园</option>
                            <option value="4" <?php if ($zxs == "4") echo "selected" ?>>当代国际整形专家刘阳旭</option>
                            <option value="5" <?php if ($zxs == "5") echo "selected" ?>>当代国际整形专家唐艳</option>
                            <option value="6" <?php if ($zxs == "6") echo "selected" ?>>当代国际整形专家王丽</option>
                            <option value="7" <?php if ($zxs == "7") echo "selected" ?>>当代国际整形专家吴丽娜</option>
                            <option value="8" <?php if ($zxs == "8") echo "selected" ?>>当代国际整形专家吴医生</option>
                            <option value="9" <?php if ($zxs == "9") echo "selected" ?>>当代国际整形专家肖萧</option>
                            <option value="10" <?php if ($zxs == "10") echo "selected" ?>>当代国际整形专家陈丽娟</option>
                            <option value="11" <?php if ($zxs == "11") echo "selected" ?>>当代国际整形专家陈明燕</option>
                            <option value="12" <?php if ($zxs == "12") echo "selected" ?>>当代国际整形专家黄莉</option>
                            <option value="13" <?php if ($zxs == "13") echo "selected" ?>>当代国际整形专家李瑞娟</option>
                            <option value="14" <?php if ($zxs == "14") echo "selected" ?>>当代国际整形专家潘雪蕾</option>
                            <option value="15" <?php if ($zxs == "15") echo "selected" ?>>当代国际整形专家2</option>
                            <option value="16" <?php if ($zxs == "16") echo "selected" ?>>当代国际整形专家杨曼熙</option>
                            <option value="17" <?php if ($zxs == "17") echo "selected" ?>>当代国际整形专家杨夕雅</option>
                            <option value="18" <?php if ($zxs == "18") echo "selected" ?>>当代国际整形专家杨洋</option>

                        </select></td>


                </tr>
            </form>


            <?php


            foreach ($AnList as $k => $v) {
                $sid += 1;
                ?>

                <tr bgcolor="#FFFFFF" align="center">

                    <td id="<?= $v['id'] ?>"><?= $sid ?></td>
                    <td><?= $v['tdate'] ?></td>
                    <td><?= Getitem($v['item']) ?></td>
                    <td><?= $v['age'] ?></td>
                    <td><?= Getsex($v['sex']) ?></td>
                    <td><?= Getcontact($v['contact']) ?></td>
                    <td><?= Getly($v['ly']) ?></td>
                    <td><?= GetCf($v['cf']) ?></td>
                    <td><?= GetZxs($v['zxs']) ?></td>

                </tr>

                <?php
            }
            ?>


        </table>


        <div class="clearit"></div>
    </div>
</div>

<div class="digg"><?php echo $pagenav; ?></div>

<script type="text/javascript">
    function GoUrl(site) {
        window.open(site, '_blank');
    }


    function setTab(name, cursel, n) {
        for (i = 1; i <= n; i++) {
            var menu = document.getElementById(name + i);
            var con = document.getElementById("con_" + name + "_" + i);
            menu.className = i == cursel ? "hover" : "";
            con.style.display = i == cursel ? "" : "none";
        }
    }

</script>
</body>
</html>