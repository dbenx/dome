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

$myaction = $_GET["at"];
#$form=decode($_GET["it"]);###类型ID
$formname = decode($_GET["c"]);###类型名称


$mt4 = '#_@dataclass';
$mt8 = '#_@comeform';

#####################################################################################
if ($_POST) {
    foreach ($_POST as $v => $k) {
        $k = str_replace(",", "", $k);
        ${$v} = $k;
        #${$v}=str_replace(",","",$k);
        if ((${$v}) == "") {
            echo "有数据为空！";
            exit;
        }
    }

    if (decode($it) != "comefrom") {
        exit("异常008");
    }


    $itime = dcode($itime);
    $myintimemin = strtotime($itime . "00:00:00");
    $myintimemax = strtotime($itime . "23:59:59");
    $sqlwhere = "  $mt4.`selecttime` between $myintimemin and $myintimemax";
    $IsExsit = $YumDamSql->selectdb(" $mt8.`Id` ", "$mt8,$mt4", "$mt8.`fdate`=$mt4.`Id` and " . $sqlwhere);
    if ($IsExsit["row"] > "0") {
        echo "本日（" . date("Y年m月d日", $myintimemin) . "）数据已添加！";
        echo '<a href="./">点击返回</a>';
        exit;
    }

    $FdateId = $YumDamSql->selectdb(" $mt4.`Id` ", "$mt4", $sqlwhere);

    if ($FdateId["row"] == "1") {
        $incfarray = serialize($incf);

        $fid = $FdateId["select"][0]["Id"];

        $field1 = "`fdate`,`cf`,`indate`,`uip`";
        $field2 = "'$fid','$incfarray','" . time() . "','" . getip() . "'";
        $InTable = $YumDamSql->insertdb($mt8, $field1, $field2);
        echo '添加成功<a href="./">继续添加</a>';
        exit;
    } else {
        exit("数据有异常！005");
    }
    exit;

    #print_r($_POST);exit;
########################################################################
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳当代医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body>
<?
#@include_once("Inc/head.php");

$today = time() - 3600 * 24;
$today1 = ecode(date("Ymd", $today));
$today2 = date("Y年m月d日", $today);
$form = "comefrom";
?>
<div class="Cont">
    <div class="Tinfo">
        <strong>您现在的位置：</strong>新增信息来源报表 <a href="./list.php">查看报表</a>&nbsp;&nbsp;<font color="red"><strong>请慎重填写如下内容，谢谢！</strong></font>
    </div>
    <form action="" name="myform" id="myform" method="post">
        <div class="Tinfo" style="text-align:center; border-bottom:solid 1px #cccccc;">
            <font color="green"><strong>&gt;&gt; 新增信息来源信息 &lt;&lt;</strong>&nbsp;</font>
        </div>
        <div class="Content">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="right" width="200">报表日期</td>
                    <td><strong><input type="hidden" name="itime" value="<?= $today1 ?>"/><font
                                    color="#FF0000"><?= $today2 ?></font></strong></td>
                    <td><input type="hidden" name="it" value="<?= encode($form) ?>"/></td>
                </tr>
                <?
                foreach ($YumDamComeFrom as $k => $v) {
                    ?>
                    <tr>
                        <td align="right"><?= $v ?></td>
                        <td><input name="incf[<?= $k ?>]" type="text" class="InPutTxt" style="width:150px"
                                   autocomplete="off" value="0"/></td>
                        <td>&nbsp;</td>
                    </tr>
                    <?
                }
                ?>
                <tr>
                    <th colspan="3">&nbsp;</th>
                </tr>
            </table>
            <div class="clearit"></div>
        </div>
        <div class="ContBtn">
            <input type="submit" class="B" id="mysubmit" value="保存"/>&nbsp;<input type="reset" class="B" value="清空"/>
        </div>
    </form>
    <div class="clearit"></div>
</div>
</body>
</html>