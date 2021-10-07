<?php
header("Content-Type:text/html; charset=utf-8");

include("../Config/Common.Inc.php");####加载配置文件
include("../Config/YumDam.Connet.php");####加载配置文件
include("../Config/Config.Function.php");####加载配置文件


$uurl = $_SERVER['HTTP_REFERER'];
$forasp = strtolower($_SERVER['HTTP_USER_AGENT']);
$dirname = str_replace("\\", '/', dirname(__FILE__));


if ($_POST) {
    $uurl = $_SERVER['HTTP_REFERER'];

    $tdate = $_POST["tdate"];    //日期待

    $item = $_POST["item"];        //项目

    $age = $_POST["age"];//年龄

    $sex = $_POST["sex"];//性别

    $contact = $_POST["contact"];//联系方式

    $ly = $_POST['ly'];//来源

    $zxs = $_POST['zxs'];

    $cf = $_POST['cf'];

    $remark = $_POST["remark"];//备注

    /*if($name=="")
        {
        echo "<script type=\"text/javascript\"> \n alert('用户姓名不能为空！');\n window.location.href=\"\";\n</script>";
        exit;
        }

     if($tel=="")
        {
        echo "<script type=\"text/javascript\"> \n alert('电话号码有误！');\n window.location.href=\"\";\n</script>";
        exit;
        }	*/


    $field = "`tdate`,`item`,`age`,`sex`,`ly`,`zxs`,`cf`,`contact`,`remark`";
    $valus = "'$tdate','$item','$age','$sex','$ly','$zxs','$cf','$contact','$remark'";

    $YumDamSql = new YumDam_DB_Connet;

    $IRes = $YumDamSql->insertdb("Yumdam_swttj", $field, $valus);
    echo "<script type=\"text/javascript\"> \n alert('提交成功!');\n window.location.href=\"/tj/\";\n</script>";


}


?>
