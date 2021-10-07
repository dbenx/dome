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

include("./Config/YumDam.MSG.php");####加载配置文件

$service = 'http://211.147.239.62/Service/WebService.asmx?wsdl';
$account = 'gzgyml@gzgyml';
$password = 'u=,9U8c8';
$mms = new YumDamMSG();
$mms->setWebservice($service, $account, $password);
print_r($mms);
$p = $mms->setPhone(array('15998989668'));
print_r($p);
$str = $mms->sendMsg($p, "这还是一条测试", "这还是一条测试");
print_r($str);
#$data = $mms->getResponse(array($account, $password, 'batchid'=>$str, 'mobile'=>'', 'pageindex'=>'1', 'flag'=>'0'));


#print_r($data);
?>