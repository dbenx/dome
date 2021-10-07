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


function getip()
{
    $ip = false;
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) {
            array_unshift($ips, $ip);
            $ip = FALSE;
        }
        for ($i = 0; $i < count($ips); $i++) {
            if (!eregi("^(10|172\.16|192\.168)\.", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return $getip = ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}


function CheckId($C_id)
{
    if (!preg_match("/^[0-9]+$/", $C_id)) {
        return false;
    }
    return true;
}


function js_unescape($str)////反解编码
{
    $ret = '';
    $len = strlen($str);
    for ($i = 0; $i < $len; $i++) {
        if ($str[$i] == '%' && $str[$i + 1] == 'u') {
            $val = hexdec(substr($str, $i + 2, 4));
            if ($val < 0x7f) $ret .= chr($val);
            else if ($val < 0x800) $ret .= chr(0xc0 | ($val >> 6)) . chr(0x80 | ($val & 0x3f));
            else $ret .= chr(0xe0 | ($val >> 12)) . chr(0x80 | (($val >> 6) & 0x3f)) . chr(0x80 | ($val & 0x3f));
            $i += 5;
        } else if ($str[$i] == '%') {
            $ret .= urldecode(substr($str, $i, 3));
            $i += 2;
        } else $ret .= $str[$i];
    }
    return $ret;
}


function is_utf8($word)   ###判断是否不u8 
{
    if (@preg_match("/^([" . chr(228) . "-" . chr(233) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}){1}/", $word) == true || @preg_match("/([" . chr(228) . "-" . chr(233) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}){1}$/", $word) == true || @preg_match("/([" . chr(228) . "-" . chr(233) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}){2,}/", $word) == true) {
        return $word;
    } else {
        $word = iconv('gbk', 'utf-8//IGNORE', $word);
        return $word;
    }
}


function toutf8($word)
{
    if (mb_detect_encoding($word, 'UTF-8', true) != "UTF-8") {
        $word = iconv('gbk', 'utf-8//IGNORE', $word);
    }
    return $word;
}


function IsNewCont($file)##新内容增加文件
{
    $filecont = time();
    $filec = fopen($file, 'w');
    $result = @fwrite($filec, $filecont);
    fclose($filec);
    if ($result) {
        return true;
    } else {
        return false;
    }
}


function passmd5($pass, $pn = 2)####密码MD5加密
{
    for ($i = 1; $i <= $pn; $i++) {
        $pass = md5($pass);
    }
    return $pass;
}


function encode($string, $num = '1')////进行URL编码
{

    for ($i = 1; $i <= $num; $i++) {
        $string = urlencode($string);
        $string = base64_encode($string);
    }
    return $string;
}


function decode($string, $num = 1)////进行URL解码
{
    for ($i = 1; $i <= $num; $i++) {
        $string = base64_decode($string);
        $string = urldecode($string);
    }
    return $string;
}


function ecode($str) ##进行字符转换
{
    $str = '\0' . substr(chunk_split(bin2hex($str), 2, '\0'), 0, -2);
    $string = str_replace("\\", "", $str);
    return $string;
}  //十六进制 转 ASCII 


function dcode($str) ###进行字符解码
{
    for ($ii = 0; $ii <= strlen($str) / 3 - 1; $ii++) {
        $strs = substr($str, 3 * $ii, 3);
        $s .= "\\" . $strs;
    }
    $str = $s;
    $str = join('', explode('\0', $str));
    $len = strlen($str);
    for ($i = 0; $i < $len; $i += 2)
        $string .= chr(hexdec(substr($str, $i, 2)));
    return $string;
}

function IsTwoInput($time = 2, $Go = true)
{
    $nowurl = GetCurUrl();
    $getnowtime = $_COOKIE[md5($nowurl)];
    if (empty($getnowtime)) {
        $getnowtime = 0;
    }
    if ($getnowtime <= $time) {
        @setcookie(md5($nowurl), $getnowtime + 1, time() + 3600, "/");///ID
        return true;
    } else {
        if ($Go == true) {
            exit;
        }
        return false;
    }
}


function timetodate($time, $isdate = false)
{
    if (empty($time)) {
        $time = time();
    }
    if ($isdate == true) {
        $date = date("Y-m-d", $time);
    } else {
        $date = date("Y-m-d H:i", $time);
    }
    return $date;
}


function returndatetime($d, $c = "min")
{
    if (empty($d)) {
        echo "NoDate:" . time();
        return false;
    }
    $d = str_replace("年", "", $d);
    $d = str_replace("月", "", $d);
    $d = str_replace("日", "", $d);
    $d = str_replace("-", "", $d);
    if ($c == "min") {
        $lasttime = "00:00:00";
    } else {
        $lasttime = "23:59:59";
    }
    return strtotime($d . " " . $lasttime);
}


function YumDamShowMsgExit($tipsinfo, $furl = '#', $wtime = '5')
{
    @header('Content-Type:text/html; charset=utf-8');
    $aurl = $furl;
    if ($furl == "#") {
        $furl = "window.history.back(-1);\n";
        $aurl = "javascript:history.back(-1);";
    } elseif ($furl == "-1") {
        $furl = "window.history.back(-1);\n";
        $aurl = "javascript:history.back(-1);";
    } elseif ($furl == "now") {
        $furl = $_SERVER['REQUEST_URI'];
    } else {
        $furl = " window.top.location.href=\"" . $furl . "\"";
    }
    echo "<!DOCTYPE html>\n<html>\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<title>美莱医疗美容医院温馨提示</title>\n";
    echo "<style type=\"text/css\">\n.ShowMsg{width:440px; height:120px; border:solid 2px #4b1249; position:absolute; top:50%; left:50%; margin:-80px 0px 0px -220px; font-size:16px; font-weight:bold; color:#FFFFFF; background:#791d77; line-height:40px; padding:30px 20px; border-radius:6px;}\n.ShowMsg a{color:#FFFFFF;}\n</style>\n</head>\n\n<body oncontextmenu=\"return false;\">\n";
    echo '<div class="ShowMsg">' . $tipsinfo . '<br><a href="' . $aurl . '">如果你的浏览器没有自动跳转，请点击这里！</a></div>';
    echo "<script type=\"text/javascript\">\n";
    echo "function GoUrl()\n{\n " . $furl . "}\n";
    echo "setTimeout('GoUrl()'," . ($wtime * 1000) . ");\n";
    echo "</script>\n";
    echo "</body>\n</html>";
    exit;
}


function YumDamShowMsgAlertExit($tipsinfo, $furl = '#')
{
    @header('Content-Type:text/html; charset=utf-8');
    $aurl = $furl;
    if ($furl == "#") {
        $furl = "window.history.back(-1);\n";
        $aurl = "javascript:history.back(-1);";
    } elseif ($furl == "-1") {
        $furl = "window.history.back(-1);\n";
        $aurl = "javascript:history.back(-1);";
    } elseif ($furl == "now") {
        $furl = $_SERVER['REQUEST_URI'];
    } else {
        $furl = " window.location.href=\"" . $furl . "\"";
    }
    echo "<!DOCTYPE html>\n<html>\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<title>美莱医疗美容医院温馨提示</title>\n";
    echo "</head>\n\n<body oncontextmenu=\"return false;\">\n";
    echo "<script type=\"text/javascript\">\n";
    echo "alert('" . $tipsinfo . "');\n";
    echo "function GoUrl()\n{\n " . $furl . "}\n";
    echo "GoUrl();\n";
    echo "</script>\n";
    echo "</body>\n</html>";
    exit;
}


if (!function_exists('YumDamMkDir')) {
    function YumDamMkDir($dir)
    {
        $_dir = DIRECTORY_SEPARATOR;
        $dir = str_replace("/", $_dir, $dir);
        $dirarray = explode($_dir, $dir);
        foreach ($dirarray as $setdir) {
            $dirpath .= $setdir . $_dir;
            if (!is_dir($dirpath)) {
                mkdir($dirpath, 0755);
            }
        }
    }
}


function YumDamToStr($str)
{
    $str = str_replace(",", "，", $str);
    $str = str_replace("'", "", $str);
    return $str;
}


function mbsubstr($str, $strf = 0, $strlen = 12)
{
    return mb_substr($str, $strf, $strlen, "utf-8");
}


function InLogs($ucont, $uid = "")
{
    global $YumDamSql, $YumDamSId;
    if ($uid != "") {
        $YumDamSId = $uid;
    }
    $mt1 = '#_@logs';
    $field1 = "`UId`,`ucont`,`InDate`,`InIp`";
    $field2 = "'$YumDamSId','$ucont','" . time() . "','" . getip() . "'";
    $IRes = $YumDamSql->insertdb($mt1, $field1, $field2);
}


function DateToWeek($date)
{
    $w = date("w", $date);
    switch ($w) {
        case 1:
            $week = "星期一";
            break;
        case 2:
            $week = "星期二";
            break;
        case 3:
            $week = "星期三";
            break;
        case 4:
            $week = "星期四";
            break;
        case 5:
            $week = "星期五";
            break;
        case 6:
            $week = "<font color=\"#FF0000\">星期六</font>";
            break;
        default:
            $week = "<font color=\"#FF0000\">星期日</font>";
    }
    return $week;
}


function MobleNum($num)
{
    $num = substr_replace($num, '****', 3, 4);
    return $num;
}


function YumDamToIPname($ip)
{
    if (!ereg("^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$", $ip)) {
        return 'IP Address Error';
    }
    $dat_path = SiteData . '/IDat.Dat';
    if (!$fd = @fopen($dat_path, 'rb')) {
        return 'IP date file not exists or access denied';
    }
    $ip = explode('.', $ip);
    $ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];
    $DataBegin = fread($fd, 4);
    $DataEnd = fread($fd, 4);
    $ipbegin = implode('', unpack('L', $DataBegin));
    if ($ipbegin < 0) $ipbegin += pow(2, 32);
    $ipend = implode('', unpack('L', $DataEnd));
    if ($ipend < 0) $ipend += pow(2, 32);
    $ipAllNum = ($ipend - $ipbegin) / 7 + 1;
    $BeginNum = 0;
    $EndNum = $ipAllNum;
    while ($ip1num > $ipNum || $ip2num < $ipNum) {
        $Middle = intval(($EndNum + $BeginNum) / 2);
        fseek($fd, $ipbegin + 7 * $Middle);
        $ipData1 = fread($fd, 4);
        if (strlen($ipData1) < 4) {
            fclose($fd);
            return 'System Error';
        }
        $ip1num = implode('', unpack('L', $ipData1));
        if ($ip1num < 0) $ip1num += pow(2, 32);
        if ($ip1num > $ipNum) {
            $EndNum = $Middle;
            continue;
        }
        $DataSeek = fread($fd, 3);
        if (strlen($DataSeek) < 3) {
            fclose($fd);
            return 'System Error';
        }
        $DataSeek = implode('', unpack('L', $DataSeek . chr(0)));
        fseek($fd, $DataSeek);
        $ipData2 = fread($fd, 4);
        if (strlen($ipData2) < 4) {
            fclose($fd);
            return 'System Error';
        }
        $ip2num = implode('', unpack('L', $ipData2));
        if ($ip2num < 0) $ip2num += pow(2, 32);
        if ($ip2num < $ipNum) {
            if ($Middle == $BeginNum) {
                fclose($fd);
                return 'Unknown';
            }
            $BeginNum = $Middle;
        }
    }
    $ipFlag = fread($fd, 1);
    if ($ipFlag == chr(1)) {
        $ipSeek = fread($fd, 3);
        if (strlen($ipSeek) < 3) {
            fclose($fd);
            return 'System Error';
        }
        $ipSeek = implode('', unpack('L', $ipSeek . chr(0)));
        fseek($fd, $ipSeek);
        $ipFlag = fread($fd, 1);
    }
    if ($ipFlag == chr(2)) {
        $AddrSeek = fread($fd, 3);
        if (strlen($AddrSeek) < 3) {
            fclose($fd);
            return 'System Error';
        }
        $ipFlag = fread($fd, 1);
        if ($ipFlag == chr(2)) {
            $AddrSeek2 = fread($fd, 3);
            if (strlen($AddrSeek2) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
            fseek($fd, $AddrSeek2);
        } else {
            fseek($fd, -1, SEEK_CUR);
        }
        while (($char = fread($fd, 1)) != chr(0))
            $ipAddr2 .= $char;
        $AddrSeek = implode('', unpack('L', $AddrSeek . chr(0)));
        fseek($fd, $AddrSeek);
        while (($char = fread($fd, 1)) != chr(0))
            $ipAddr1 .= $char;
    } else {
        fseek($fd, -1, SEEK_CUR);
        while (($char = fread($fd, 1)) != chr(0))
            $ipAddr1 .= $char;

        $ipFlag = fread($fd, 1);
        if ($ipFlag == chr(2)) {
            $AddrSeek2 = fread($fd, 3);
            if (strlen($AddrSeek2) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
            fseek($fd, $AddrSeek2);
        } else {
            fseek($fd, -1, SEEK_CUR);
        }
        while (($char = fread($fd, 1)) != chr(0)) {
            $ipAddr2 .= $char;
        }
    }
    fclose($fd);
    if (preg_match('/http/i', $ipAddr2)) {
        $ipAddr2 = '';
    }
    $ipaddr = "$ipAddr1 $ipAddr2";
    $ipaddr = preg_replace('/CZ88.Net/is', '', $ipaddr);
    $ipaddr = preg_replace('/^s*/is', '', $ipaddr);
    $ipaddr = preg_replace('/s*$/is', '', $ipaddr);
    if (preg_match('/http/i', $ipaddr) || $ipaddr == '') {
        $ipaddr = 'Unknown';
    }
    $ipaddr = iconv('gbk', 'utf-8', $ipaddr);
    if ($ipaddr != '  ')
        return $ipaddr;
    else
        $ipaddr = '地址未知！';
    return $ipaddr;
}


function GetCont($url, $isarray = false)
{
    if (empty($url)) {
        exit;
    }
    $ch = curl_init($url);
    $user_agent = "GyMyLike+(+http://www.gyml.cc/Search.htm)";
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
    if ($isarray == true) {
        $ccode = json_decode($c);//对JSON格式的字符串进行编码
        $c = get_object_vars($ccode);//转换成数组
    }
    return $c;
}

function GetWXToken($wid, $wct)
{
    $GlobalUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $wid . "&secret=" . $wct;
    $GlobalCont = GetCont($GlobalUrl, true);
    $Globalaccess_token = $GlobalCont["access_token"];
    return $Globalaccess_token;
}


function YumDamToWxMsg($ACCESS_TOKEN, $ToWxId, $date, $GoURL, $C1 = "", $C2 = "")###
{
    if (empty($ACCESS_TOKEN) || empty($ToWxId) || empty($date) || empty($GoURL)) {
        exit;
    }
    $first = "消费「日」报表已生成！";
    $keyword1 = $date . "消费情况";
    if (!empty($C1)) {
        $first = $C1;
    }
    if (!empty($C2)) {
        $keyword1 = $C2;
    }

    #echo $ACCESS_TOKEN."||<br>\n".$ToWxId."||<br>\n".$date."||<br>\n".$GoURL;	exit;
    $YumDamPOSTData = array(
        "touser" => $ToWxId,
        "template_id" => "n2lXURQjlGMpoSPgUppP1PyGRTAvU-hugst9VUey05g",
        "url" => $GoURL,
        "data" => array(
            "first" => array("value" => $first, "color" => "#173177"),
            "keyword1" => array("value" => $keyword1, "color" => "#173177"),
            "keyword2" => array("value" => date("H时i分", time()), "color" => "#173177"),
            "remark" => array("value" => "点击查看详细内容……", "color" => "#173177"),
        ),
    );

    /*
    {{first.DATA}}
    业务类型：{{keyword1.DATA}}
    操作时间：{{keyword2.DATA}}
    {{remark.DATA}}



    正在为您接入会话，请稍等。
    业务类型：在线咨询
    操作时间：2014年7月21日 18:36
    如您有任何问题和投诉，可以拨打95059-6。
    */

    $WXSendUrl = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $ACCESS_TOKEN;
    $YumDamPOSTData = json_encode($YumDamPOSTData);
    $ch = curl_init($WXSendUrl);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $YumDamPOSTData);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($YumDamPOSTData))
    );
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}


/**
 *  删除目录及子文件
 *
 * @return    true
 */

if (!function_exists('YumDamDeleteDirAndFile')) {
    function YumDamDeleteDirAndFile($dirname)
    {
        if (is_dir($dirname)) {
            $dir = opendir($dirname);
            while ($filename = readdir($dir)) {
                if ($filename != "." && $filename != "..") {
                    $file = $dirname . "/" . $filename;
                    if (is_dir($file)) {
                        YumDamDeleteDirAndFile($file); //使用递归删除子目录
                    } else {
                        unlink($file);
                    }
                }
            }
            closedir($dir);
            rmdir($dirname);
        }
    }
}


/**
 *  更新会员缓存(仅用于用户添加和修改页面)
 *
 * @access    public
 * @return    void
 */
function YumDamUpDateAdminInfoCache()
{
    global $YumDamSql;
    $mu = "#_@mobilelogin";
    $UserList = $YumDamSql->selectdb(" `Id`,`ucname` ", $mu, " `IsDisplay`='1'");
    #$aa=$dsql->Execute("dd","SELECT id,uname FROM `#@__admin` ORDER BY id DESC");
    $uinfo = "\n";
    foreach ($UserList["select"] as $k => $v) {
        $uinfo .= "'" . $v["Id"] . "'=>'" . $v["ucname"] . "',\n";
    }
    $aufile = SiteInc . '/YumDamUser.Info';
    $usercont = "<" . "?\r\n//Administrator Name\n###############Name###############\n" . '$AdminList=' . "array(" . $uinfo . ");" . "\n\n\n?" . ">";
    $fp = fopen($aufile, 'w+');
    flock($fp, 3);
    fwrite($fp, $usercont);
    fclose($fp);
}

/**
 *  会员读取
 *
 * @access    public
 * @return    void
 */
function YumDamReadAdmin($ui)
{
    $aufile = SiteInc . '/YumDamUser.Info';
    if (!is_file($aufile)) {
        return $ui;
    }
    @include($aufile);###因为是循环，所以此处不能加once
    if (empty($AdminList[$ui])) {
        $AdminListOut = $ui;
    } else {

        $AdminListOut = $AdminList[$ui];
    }
    return $AdminList[$ui];
}

/**
 *  时间区间
 *
 */

function YumDamDay($mydaymin = 0, $mydaymax = 0)
{
    if (empty($mydaymin)) {
        $mydaymin = date("Ymd ", time());
    }
    if (empty($mydaymax)) {
        $mydaymax = $mydaymin;
    }
    $mydaymin = strtotime($mydaymin . "00:00:00");
    $mydaymax = strtotime($mydaymax . "23:59:59");
    return "between $mydaymin and $mydaymax";
}

function YumDamDataDay($day)
{
    return strtotime($day . " 08:00:00");###昨日中文日期;
}


?>