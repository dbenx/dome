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
        return $word = iconv("gb2312", "UTF-8", $word);
    }

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

?>