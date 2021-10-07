<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Untitled Document</title>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body>
<?

#$GoUrl="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx174ca15eb9a7331e&redirect_uri=http%3a%2f%2fi.dangdai.cc%2fweixin%2foauth2.php&response_type=code&scope=snsapi_base&state=123#wechat_redirect";

$GoUrl = "http://www.baidu.com";

function GetCont($url)
{
    if (empty($url)) {
        exit;
    }
    $ch = curl_init($url);
    #$user_agent = "HUAMEI+(+http://www.dangdai.cc/Search.htm)";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    #curl_setopt($ch, CURLOPT_REFERER, "http://www.dangdai.cc");
    #curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    $c = curl_exec($ch);
    curl_close($ch);
    return $c;
}

$Cont = GetCont($GoUrl);

print_r($Cont);

exit;


#$code = $_GET['code'];//获取code
$weixin = file_get_contents("");//通过code换取网页授权access_token
$jsondecode = json_decode($weixin);//对JSON格式的字符串进行编码
print_r($jsondecode);
$array = get_object_vars($jsondecode);//转换成数组
$openid = $array['openid'];//输出openid
print_r($array);
?>
</body>
</html>
