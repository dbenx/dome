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


function YumDamUpload($file, $mydir = "./")
{
    $uptypes = array('application/vnd.ms-excel');
    $type = $_FILES[$file]["type"];
    $size = $_FILES[$file]["size"];
    $name = $_FILES[$file]["name"];
    $tmp_name = $_FILES[$file]["tmp_name"];
    $error = $_FILES[$file]["error"];

    if (!in_array($type, $uptypes)) {
#echo "文件类型不符!".$type;
        echo "<script>alert('文件类型不符!!');history.back()</script>";
        exit;
    }
    $newname = substr(md5(time() . rand(0, 10000)), 8, 16) . strrchr($name, ".");
#$filedir="Uploads/".$mydir;
    if (!is_dir($mydir)) {
        YumDamMkDir($mydir);
    }
    #echo $filedir;
    $fileallname = $mydir . $newname;
#echo "||".$fileallname;exit;
    if ($error > 0) {
        echo "上传文件有误:" . $error . "<br/>";
        exit;
    }
    if (move_uploaded_file($tmp_name, $fileallname)) {
        return $newname;
    } else {
        return "false";
    }
}


function upload($file)
{
    $uptypes = array('image/jpg', 'image/jpeg', 'image/png', 'image/pjpeg', 'image/gif', 'image/bmp', 'image/x-png');
    $type = $_FILES[$file]["type"];
    $size = $_FILES[$file]["size"];
    $name = $_FILES[$file]["name"];
    $tmp_name = $_FILES[$file]["tmp_name"];
    $error = $_FILES[$file]["error"];

    if (!in_array($type, $uptypes)) {
        echo "文件类型不符!" . $type;
        exit;
    }
    $newname = md5(time() . rand(0, 10000)) . strrchr($name, ".");
    $topath = "Uploads/" . date("Ymd", time()) . "/";
    if (!is_dir($topath)) {
        mkdir($topath, 0777);
    }
    $fileallname = $topath . $newname;
    if ($error > 0) {
        echo "上传文件有误:" . $error . "<br/>";
        exit;
    }
    if (move_uploaded_file($tmp_name, $fileallname)) {
        return $fileallname;
    } else {
        return false;
    }
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
#if(mb_detect_encoding($title, 'UTF-8', true)!="UTF-8")
#{
        $word = iconv('gbk', 'utf-8//IGNORE', $word);
#}
#$word=mb_convert_encoding($word,"UTF-8","ascii,GB2312,gbk,UTF-8,unicode");
#$word=mb_convert_encoding($word,"UTF-8","auto");
#$word=mb_convert_encoding($word, "UTF-8");
#$word=iconv("gbk","UTF-8//IGNORE",$word);
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
    /*
    $filec=fopen($file,'r');
    $filecont=@fread($filec,filesize($file));
    fclose($filec);
    if(empty($filecont))
    {
        $filecont="0";
        }
    if(!CheckId($filecont))
    {
        $filecont="0";
        }
        */
    $filecont = time();
    $filec = fopen($file, 'w');
    $result = @fwrite($filec, $filecont);
    fclose($filec);
#echo $file_content;
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


function PercentDataColor($nowdata, $sysdata, $ld = "%")
{
    if ($nowdata < $sysdata) {
        $returndata = "<font color=\"#FF0000\">" . $nowdata . $ld . "</font>";
    } else {
        $returndata = "<font color=\"#008000\">" . $nowdata . $ld . "</font>";
    }
    return "<strong>" . $returndata . "</strong>";
}


function TalkDataColor($nowdata, $sysdata)
{
    if ($nowdata < $sysdata) {
        $returndata = "<font color=\"#008000\">" . $nowdata . "</font>";
    } else {
        $returndata = "<font color=\"#FF0000\">" . $nowdata . "</font>";
    }
    return "<strong>" . $returndata . "</strong>";
}


function isempty($data = 0)
{
    if ($data == "") {
        $data = 0;
    }
    return $data;
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
    echo "<!DOCTYPE html>\n<html>\n<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<title>当代医疗美容医院温馨提示</title>\n";
    echo "<style type=\"text/css\">\n.ShowMsg{width:440px; height:120px; border:solid 2px #cccccc; position:absolute; top:50%; left:50%; margin:-80px 0px 0px -220px; font-size:16px; font-weight:bold; color:#333; background:#eeeeee; line-height:40px; padding:30px 20px;}\n</style>\n</head>\n\n<body oncontextmenu=\"return false;\">\n";
    echo '<div class="ShowMsg">' . $tipsinfo . '<br><a href="' . $aurl . '">如果你的浏览器没有自动跳转，请点击这里！</a></div>';
    echo "<script type=\"text/javascript\">\n";
    echo "function GoUrl()\n{\n " . $furl . "}\n";
    echo "setTimeout('GoUrl()'," . ($wtime * 1000) . ");\n";
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
    #$str=base64_encode($str);
    #$str=addslashes($str);
    #$str=htmlspecialchars($str);
    return $str;
}


function YumDamMStatus($str, $date = 0)
{
    global $YumDamMStatus;
    if (empty($str)) {
        $showstr = "待处理";
        $showcolor = "#FF0000";
    } else {
        $showstr = $YumDamMStatus[$str];
        if ($str != '1') {
            $showcolor = "#FF9900";
        } else {
            $showcolor = "#008000";
        }
    }
    if (!empty($date)) {
        $date = timetodate($date, true) . " ";
    } else {
        $date = "";
    }
    $recont = "<font color=\"" . $showcolor . "\">" . $date . $showstr . "</font>";
    return $recont;
}


function mbsubstr($str, $strf = 0, $strlen = 12)
{
    return mb_substr($str, $strf, $strlen, "utf-8");
}


function InLogs($ucont, $uid = "")
{
    global $YumDamSql, $YumDamSId;
    #$ucont=$YumDamUcn."->".$ucont;
    if ($uid != "") {
        $YumDamSId = $uid;
    }
    $mt1 = '#_@mobilelogs';
    $field1 = "`UId`,`ucont`,`InDate`,`InIp`";
    $field2 = "'$YumDamSId','$ucont','" . time() . "','" . getip() . "'";
    $IRes = $YumDamSql->insertdb($mt1, $field1, $field2);
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


?>