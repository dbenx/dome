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

/*

$sitelist = array(
'1'=>array(
'site'=>'huiyang120.com',
'sname'=>'惠阳男科',
),
);
*/
header("Content-type: text/html; charset=utf-8");

$action = $_GET["action"];

$time = $_GET["t"];
$sitelist = array(
    '21' => 'www.gyml.cc|www.dangdai.cc',
    '22' => '3g.gyml.cc|3g.dangdai.cc',
    '23' => 'wap.gyml.cc|wap.dangdai.cc',
);


/*
$sitelist=array(
'6'=>'www.gyml.cc',
'7'=>'3g.gyml.cc',
'1'=>'www.dangdai.cc|www.dangdaizx.com',
'2'=>'wap.dangdaizx.com',
'3'=>'wap.dangdai.cc|m.dangdaizx.com',
'4'=>'www.gydangdai.com',
'5'=>'www.gyddzx.com',
);
*/

$OkGroup = array(
    "1" => "程序",
    "2" => "美工",
    "3" => "编辑",
    "4" => "策划",
);


include("./Config/Common.Inc.php");####加载配置文件

include("./Config/YumDam.Connet.php");####加载配置文件

include("./Config/Config.Function.php");####加载配置文件

session_start();
if (!isset($_SESSION['tm'])) {

    if (getip() != "61.236.191.15") {

        if ($time != date("Ymd")) {
            $_SESSION['tm'] = "sessce";
            echo date('Ymd');
            exit;
        }
    }
}

$YumDamSql = new YumDam_DB_Connet();

session_name("YumDamSessionId");
session_save_path(str_replace("\\", '/', dirname(__FILE__)) . "/../MySid/");


$YumDamSid = $_SESSION["YumDamSid"];

$YumDamGid = $_SESSION["YumDamGroup"];


?>