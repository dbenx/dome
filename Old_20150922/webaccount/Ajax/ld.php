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
include("../../Config/Config.Inc.php");####加载配置文件

if (!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) || strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) != "xmlhttprequest") {
    echo "Er:005";
    exit;
}


$date1 = $_GET["d1"];
$date2 = $_GET["d2"];
$myaction = decode($_GET["action"]);

if ($myaction != "list") {
    echo time() . "<br>出错!";
    exit;
}


$date1 = returndatetime($date1);
$date2 = returndatetime($date2, "max");
@setcookie("vd1", $date1, time() + 3600, "/");
@setcookie("vd2", $date2, time() + 3600, "/");

function DataShow($indate, $outdate)
{
    global $YumDamSql;
    $mt1 = '#_@formclass';
    $mt2 = '#_@formdata';
    $mt3 = '#_@formdata3';
    $mt4 = '#_@dataclass';
    $where = " $mt4.`Id`=$mt2.`fdate` and $mt2.`fclass`=$mt1.`Id` and $mt4.`selecttime` between " . $indate . " and " . $outdate;
    $order = " order by $mt4.`Id` desc,$mt4.`selecttime` desc";
    $DataList = array();
    $ListSRes = $YumDamSql->selectsql("SELECT $mt4.`Id`,$mt4.`selecttime`,$mt1.`cname`,count($mt2.`fdate`) as `countnum`,sum($mt2.fmoney) as `allfmoney`,sum($mt2.`wapmoney`) as `allwapmoney`,sum($mt2.fclick) as `allfclick`,sum($mt2.fshow) as `allfshow` FROM  $mt4,$mt2,$mt1 where " . $where . " group by $mt2.`fdate`" . $order);
    $ListSRes2 = $YumDamSql->selectsql("SELECT $mt4.`Id` as `cid`,$mt4.`selecttime`,$mt4.`t1`,$mt4.`indate`,$mt2.`fmoney`,$mt2.`wapmoney`,$mt2.`fclick`,$mt2.`fshow`,$mt1.`cname` FROM  $mt4,$mt2,$mt1 where " . $where . $order);
    foreach ($ListSRes["select"] as $k => $v) {
        foreach ($ListSRes2["select"] as $kk => $vv) {
            if ($v["Id"] == $vv["cid"]) {
                $v["data"][] = $vv;
            }
        }
        $ListSRes3 = $YumDamSql->selectsql("SELECT $mt3.* FROM  $mt3,$mt4 where $mt3.`fdate`=$mt4.`Id` and $mt4.`Id`=" . $v["Id"]);
        $List2 = $ListSRes3["select"][0];
        $List2Show = "商务通对话：" . $List2["talkall"] . "人 | 手机对话：" . $List2["talkwap"] . "人 | PC对话：" . ($List2["talkall"] - $List2["talkwap"]) . "人 | 到院重复：" . $List2["retalk1"] . "人 | 未到院重复：" . $List2["retalk2"] . "人 | 行政无效类：" . $List2["notalk"] . "人 | 系统下单：" . $List2["issys"] . "人 | 到院：" . $List2["isfrom"] . "人 | 成交：" . $List2["isok"] . "人 网站IP访问量：" . $List2["webip"] . "次 | 企业QQ对话：" . $List2["bqq"] . "人&nbsp;&nbsp;<strong>总计：" . ($List2["talkall"] + $List2["bqq"]) . "人</strong>";
        $v["data2"] = $List2Show;
        $DataList[] = $v;
    }
    return $DataList;
}

$list = DataShow($date1, $date2);
#print_r($list);

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <th height="30">编号</th>
        <th>日期</th>
        <th>账户类型</th>
        <th>资金投入</th>
        <th>手机投入</th>
        <th>PC投入</th>
        <th>点击次数</th>
        <th>点击价格</th>
        <th>展现量</th>
        <th>&nbsp;</th>
    </tr>
    <?
    foreach ($list as $k => $v) {
        foreach ($v["data"] as $k2 => $v2) {
            $i++;
            ?>
            <tr>
                <td align="center"><?= $i ?></td>
                <?
                if ($i == "1") {
                    ?>
                    <td rowspan="<?= $v["countnum"] ?>" align="center"
                        bgcolor="#CAE8F2"><?= timetodate($v2["selecttime"], true) ?></td>
                    <?
                }
                ?>
                <td align="center"><?= $v2["cname"] ?></td>
                <td align="center" bgcolor="#CAE8F2"><?= $v2["fmoney"] ?>元</td>
                <td align="center"><?= $v2["wapmoney"] ?>元</td>
                <td align="center" bgcolor="#CAE8F2"><?= $v2["fmoney"] - $v2["wapmoney"] ?>元</td>
                <td align="center"><?= $v2["fclick"] ?>次</td>
                <td align="center" bgcolor="#CAE8F2"><?= round($v2["fmoney"] / $v2["fclick"], 2) ?>元/次</td>
                <td align="center"><?= $v2["fshow"] ?>次</td>
                <?
                if ($i == "1") {
                    ?>
                    <td rowspan="<?= $v["countnum"] ?>" align="center"><a
                                href="m.php?at=<?= encode("show") ?>&d=<?= ecode($v2["cid"]) ?>&d2=<?= ecode($v2["indate"]) ?>"
                                target="_self" style="font-weight:bold; color:red;">&gt;&gt;查看详细</a></td>
                    <?
                }
                ?>
            </tr>
            <?
        }
        unset($i);
        ?>
        <tr>
            <th height="35" align="center">日小计</th>
            <th><?= timetodate($v["selecttime"], true) ?></th>
            <th>当日全部账户</th>
            <th><?= $v["allfmoney"] ?>元</th>
            <th><?= $v["allwapmoney"] ?>元</th>
            <th><?= $v["allfmoney"] - $v["allwapmoney"] ?>元</th>
            <th><?= $v["allfclick"] ?>次</th>
            <th><?= round($v["allfmoney"] / $v["allfclick"], 2) ?>元/次</th>
            <th><?= $v["allfshow"] ?>次</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td colspan="10" height="35" align="center"><?= $v["data2"] ?></td>
        </tr>
        <?
    }
    ?>
</table>