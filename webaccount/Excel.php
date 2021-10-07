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

if (!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) || strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) != "xmlhttprequest") {
    echo "Er:005";
    exit;
}
exit;##功能带开发
#echo $_GET["d1"];
$myaction = decode($_GET["action"]);
$url = js_unescape($_GET["d1"]);
#echo $url;exit;
if ($myaction != "Excel") {
    echo time() . "<br>出错!";
    exit;
}
$data = GetCont($url);
@header("Content-type:application/vnd.ms-excel");
@header("Content-Disposition:filename=导出数据日期" . date("Y年m月d日", time()) . ".xls");

echo $data;


/*
  echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>贵阳美莱医疗美容医院</title>
<style>
td{
  text-align:center;
  font-size:12px;
  font-family:Arial, Helvetica, sans-serif;
  border:#1C7A80 1px solid;
  color:#152122;
  width:100px;
}
table,tr{
  border-style:none;
}
.title{
  background:#7DDCF0;
  color:#FFFFFF;
  font-weight:bold;
}
</style>
</head>

<body>
<table width='800' border='1'>
<tr>
  <td class='title'>Date</td>
  <td class='title' colspan='5' style='width:500px;text-align:center;'>CSAT Score</td>
  <td class='title'>Grand Total</td>
  <td class='title'>CSAT</td>
</tr>
<tr>
  <td>08/01/11</td>
  <td>0</td>
  <td>0</td>
  <td>测试内容！！</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>0%</td>
</tr>
<tr>
  <td>08/01/11</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>0%</td>
</tr>
<tr>
  <td>08/01/11</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>0</td>
  <td>0%</td>
</tr>
</table>
</body>
</html>
";
*/
?>