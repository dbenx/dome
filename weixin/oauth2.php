<?php
#error_reporting(E_ALL);

$wxcode = "";

if (isset($_GET['code'])) {
    $wxcode = $_GET['code'];
    #echo $wxcode;
} else {
    echo "NO CODE";
    exit;
}

$wxappid = "wx174ca15eb9a7331e";
$wxsecret = "01e78302706aa07e986a3121f2e2717c";


function GetCont($url)
{
    if (empty($url)) {
        exit;
    }
    $ch = curl_init($url);
    $user_agent = "HUAMEI+(+http://www.dangdai.cc/Search.htm)";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0); // 不要http header 加快效率
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    // https请求 不验证证书和hosts
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    #curl_setopt($ch, CURLOPT_REFERER, "http://www.dangdai.cc");
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    $c = curl_exec($ch);
    curl_close($ch);
    $ccode = json_decode($c);//对JSON格式的字符串进行编码
    $carray = get_object_vars($ccode);//转换成数组
    return $carray;
}


$GoUrl = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $wxappid . "&secret=" . $wxsecret . "&code=" . $wxcode . "&grant_type=authorization_code";
$Cont = GetCont($GoUrl);
$openid = $Cont['openid'];//输出openid

##############################################################################################################################################################

$GlobalUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $wxappid . "&secret=" . $wxsecret;

$GlobalCont = GetCont($GlobalUrl);
$Globalaccess_token = $GlobalCont["access_token"];
#print_r($Globalarray);


##############################################################################################################################################################

$UserUrl = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $Globalaccess_token . "&openid=" . $openid;
$UserCont = GetCont($UserUrl);
$UserNickname = $UserCont["nickname"];
print_r($UserCont);


$MLShowUserArray = array("耳东" => "倪向东", "非富先生" => "倪向东");


print_r($MLShowUserArray);

if (array_key_exists($UserNickname, $MLShowUserArray)) {
    echo "Yes";
} else {
    echo "No";
}


#header( "Location:".$tourl);
?>