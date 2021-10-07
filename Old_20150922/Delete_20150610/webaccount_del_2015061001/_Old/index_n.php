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
include("Config/Config.Inc.php");####加载配置文件

if (getip() != "61.236.191.15") {
    exit;##该内容不能放入公用文件！
}

$myaction = $_GET["at"];
$form = decode($_GET["e"]);###类型ID
$formname = decode($_GET["c"]);###类型名称

$mt1 = '#_@formclass';
$mt2 = '#_@formdata';
$mt3 = '#_@formdata3';
$mt4 = '#_@dataclass';
$mt6 = '#_@formdata2';


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
    $itime = dcode($itime);
    $myintimemin = strtotime($itime);
    $myintime = strtotime($itime . "12:00:00");
    $myintimemax = strtotime($itime . "23:59:59");
    $sqlwhere = " `selecttime` between $myintimemin and $myintimemax";
    $IsExsit = $YumDamSql->selectdb(" `Id`,`t1` ", $mt4, $sqlwhere);
    $table = array($form);
    if ($IsExsit["row"] == "1") {
        $isintable = unserialize($IsExsit["select"][0]["t1"]);
        $isintableid = $IsExsit["select"][0]["Id"];
        if (!in_array($table[0], $isintable)) {
            $newtable = array_merge($table, $isintable);
            $newtable = serialize($newtable);
            $InNewTable = $YumDamSql->updatedb($mt4, "`t1`='$newtable',`tupdate`='" . time() . "'", "`Id`='$isintableid'");
        } else {
            if ($form != "item") {
                echo "添加出错！检查是否已经添加过该数据！01";
                exit;
            }
        }
    } elseif ($IsExsit["row"] < 1) {
        $table = serialize($table);
        $field1 = "`selecttime`,`t1`,`indate`,`tupdate`,`inip`";
        $field2 = "'$myintime','$table','" . time() . "','" . time() . "','" . getip() . "'";
        $_InTable = $YumDamSql->insertdb($mt4, $field1, $field2);
    } else {
        echo "数据出错！01";
        exit;
    }
########################################################################
    if (empty($isintableid)) {
        $isintableid = $_InTable["id"];
    }
########################################################################	
    if (CheckId($form) == true || $form == "wm") {
        $classid = $_POST["it"];
        $classid = dcode($classid);
        $field1 = "`fdate`,`fclass`,`fmoney`,`wapmoney`,`fclick`,`fshow`,`indate`,`uip`";
        $field2 = "'$isintableid','$classid','$im','$mim','$ic','$is'," . time() . ",'" . getip() . "'";
        $IRes = $YumDamSql->insertdb($mt2, $field1, $field2);
        if ($IRes["affect"] == "1") {
            echo '添加成功<a href="./">继续添加</a>';
        }
        exit;
    } ########################################################################
    elseif ($form == "more") {
        $field1 = "`fdate`,`talkall`,`talkwap`,`retalk1`,`retalk2`,`notalk`,`issys`,`isfrom`,`isok`,`webip`,`bqq`,`indate`,`inip`";
        $field2 = "'$isintableid','$italk','$iwtalk','$isre','$isre2','$isre3','$iss','$isf','$iso','$wi','$bq'," . time() . ",'" . getip() . "'";
        $IRes = $YumDamSql->insertdb($mt3, $field1, $field2);
        if ($IRes["affect"] == "1") {
            echo '添加成功<a href="./">继续添加</a>';
            exit;
        }
        exit;
    } ########################################################################
    elseif ($form == "item") {
        $itemwhere = "`fdate`=" . $isintableid;
        $ItemIsExsit = $YumDamSql->selectdb(" `Id`,`fitem` ", $mt6, $itemwhere);
        $ItemFormCont = $isi . "," . $in . "," . $ism;
        $ItemFormCont = explode(",", $ItemFormCont);
        $ItemForm = array($ii => $ItemFormCont);
        #print_r($ItemForm);exit;
        if ($ItemIsExsit["row"] == "1") {
            $ItemIsInTable = unserialize($ItemIsExsit["select"][0]["fitem"]);
            $ItemIsInTableId = $ItemIsExsit["select"][0]["Id"];
            $ItemForm1 = array_keys($ItemForm);
            $ItemIsInTable1 = array_keys($ItemIsInTable);
            if (!in_array($ItemForm1[0], $ItemIsInTable1)) {
                $ItemNewTable = array_merge($ItemForm, $ItemIsInTable);
                $ItemNewTable = serialize($ItemNewTable);
                $ItemInNewTable = $YumDamSql->updatedb($mt6, "`fitem`='$ItemNewTable'", "`Id`='$ItemIsInTableId'");
                echo '添加成功<a href="./">继续添加</a>';
            } else {
                echo "添加出错！检查是否已经添加过该数据！02";
                exit;
            }
        } elseif ($ItemIsExsit["row"] < 1) {
            $ItemForm = serialize($ItemForm);
            $field1 = "`fdate`,`fitem`,`indate`,`uip`";
            $field2 = "'$isintableid','$ItemForm'," . time() . ",'" . getip() . "'";
            $ItemIRes = $YumDamSql->insertdb($mt6, $field1, $field2);
            if ($ItemIRes["affect"] == "1") {
                echo '添加成功<a href="./">继续添加</a>';
                exit;
            }
        } else {
            echo "数据出错！02";
            exit;
        }
        exit;
    }
########################################################################
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳当代医疗美容医院</title>
    <link href="CSS/Style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="Cont">
    <div class="Tinfo">
        <h3>贵阳当代医疗美容医院网络部数据报表</h3>
    </div>
</div>
<div class="Cont">
    <?
    if ($myaction == "new") {
        $today = time() - 3600 * 24;
        $today1 = ecode(date("Ymd", $today));
        $today2 = date("Y年m月d日", $today);
        ?>
        <div class="Tinfo">
            <strong>您现在的位置：</strong>新增报表 <a href="./list.php">查看报表</a>&nbsp;&nbsp;<font color="red"><strong>请慎重填写如下内容，谢谢！</strong></font>
        </div>
        <form action="" name="myform" id="myform" method="post" onsubmit="return mysubmit<?= $form ?>()">
            <div class="Tinfo" style="text-align:center; border-bottom:solid 1px #cccccc;">
                <font color="green"><strong>&gt;&gt; 以下为<?= $formname ?>信息 &lt;&lt;</strong>&nbsp;</font>
            </div>
            <div class="Content">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="right">报表日期</td>
                        <td><strong><input type="hidden" name="itime" value="<?= $today1 ?>"/><font
                                        color="#FF0000"><?= $today2 ?></font></strong></td>
                        <td><input type="hidden" name="it" value="<?= ecode($form) ?>"/></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <?
                    if (CheckId($form) == true || $form == "wm") {
                        ?>
                        <tr>
                            <td align="right" width="150">资金投入</td>
                            <td width="150"><input name="im" type="text" id="im" onmouseout="PCIM()" onblur="PCIM()"
                                                   class="InPutTxt" style="width:150px" value=""/></td>
                            <td align="right" width="200">手机投入</td>
                            <td width="150"><input name="mim" type="text" id="mim" onmouseout="PCIM()" onblur="PCIM()"
                                                   class="InPutTxt" style="width:150px" value=""/></td>
                            <td align="right" width="150">PC投入</td>
                            <td width="150"><span id="pcim">0</span></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="right">点击次数</td>
                            <td><input name="ic" type="text" id="ic" class="InPutTxt" style="width:150px" value=""/>
                            </td>
                            <td align="right">展现量</td>
                            <td><input name="is" type="text" id="is" class="InPutTxt" style="width:150px" value=""/>
                            </td>
                            <td align="right">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <?
                    } elseif ($form == "more") {
                        ?>
                        <tr>
                            <td align="right">商务通对话</td>
                            <td><input name="italk" type="text" id="italk" class="InPutTxt" style="width:150px"
                                       value=""/></td>
                            <td align="right">手机对话</td>
                            <td><input name="iwtalk" type="text" id="iwtalk" class="InPutTxt" style="width:150px"
                                       value=""/></td>
                            <td align="right">PC对话</td>
                            <td>256</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="right">到院重复对话</td>
                            <td><input name="isre" type="text" id="isre" class="InPutTxt" style="width:150px" value=""/>
                            </td>
                            <td align="right">未到院重复对话</td>
                            <td><input name="isre2" type="text" id="isre2" class="InPutTxt" style="width:150px"
                                       value=""/></td>
                            <td align="right">行政无效对话</td>
                            <td><input name="isre3" type="text" id="isre3" class="InPutTxt" style="width:150px"
                                       value=""/></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="right">下单人数</td>
                            <td><input name="iss" type="text" id="iss" class="InPutTxt" style="width:150px" value=""/>
                            </td>
                            <td align="right">到诊人数</td>
                            <td><input name="isf" type="text" id="isf" class="InPutTxt" style="width:150px" value=""/>
                            </td>
                            <td align="right">成交人数</td>
                            <td><input name="iso" type="text" id="iso" class="InPutTxt" style="width:150px" value=""/>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="right">网站访问量</td>
                            <td><input name="wi" type="text" id="wi" class="InPutTxt" style="width:150px" value=""/>
                            </td>
                            <td align="right">企业QQ对话</td>
                            <td><input name="bq" type="text" id="bq" class="InPutTxt" style="width:150px" value=""/>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <?
                    } elseif ($form == "item") {
                        $itemtoday = dcode($today1);
                        $itemintimemin = strtotime($itemtoday . "00:00:00");
                        $itemintimemax = strtotime($itemtoday . "23:59:59");
                        $itemsqlwhere = " $mt4.`selecttime` between $itemintimemin and $itemintimemax and $mt4.`Id`=$mt6.`fdate`";
                        $OkItem = $YumDamSql->selectdb(" `fitem` ", "$mt4,$mt6", $itemsqlwhere);
                        if (!is_array($OkItem["select"])) {
                            $OkItem["select"] = array();
                        }
                        $OkItem = unserialize($OkItem["select"][0][0]);
                        $OkItem = array_keys($OkItem);
                        #print_r($OkItem);exit;


                        $mt5 = '#_@itemclass';
                        $ItemSRes = $YumDamSql->selectsql("SELECT * FROM  $mt5 where `isshow`='1' and TId=0");
                        if (!is_array($ItemSRes["select"])) {
                            $ItemSRes["select"] = array();
                        }
                        $ItemClass = $ItemSRes["select"];


                        $ItemClassShow = "";
                        foreach ($ItemClass as $k => $cv) {
                            $ItemClassShowC = array();
                            $ItemClassShowC = $cv;
                            $ItemClassShow .= "<optgroup label=\"" . $cv["iname"] . "\">\n";
                            $where = " `TId`=" . $cv["Id"] . " and `isshow`=1";
                            $ItemClass2 = $YumDamSql->selectdb("Id,iname", $mt5, $where);
                            $ItemClass2 = $ItemClass2["select"];
                            foreach ($ItemClass2 as $ks => $sv) {
                                if (!in_array(ecode($sv["Id"]), $OkItem)) {
                                    $ItemClassShow .= "<option value=\"" . (ecode($sv["Id"])) . "\">--" . $sv["iname"] . "</option>\n";
                                }
                            }
                            $ItemClassShow .= "</optgroup>\n";
                        }


                        ?>
                        <tr>
                            <td align="right">咨询项目</td>
                            <td>
                                <select name="ii" id="ii">
                                    <option value="">--请选择咨询项目--</option>
                                    <?= $ItemClassShow ?>
                                </select>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="right">咨询数量</td>
                            <td><input name="in" type="text" id="in" class="InPutTxt" style="width:150px" value=""/>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="right">下单数量</td>
                            <td><input name="isi" type="text" id="isi" class="InPutTxt" style="width:150px" value=""/>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="right">消费金额</td>
                            <td><input name="ism" type="text" id="ism" class="InPutTxt" style="width:150px" value="0"/>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <?
                    } else {
                        echo '<script type="text/javascript"> window.location="./";</script>';
                    }
                    ?>
                </table>
                <div class="clearit"></div>
            </div>
            <div class="ContBtn">
                <input type="submit" class="B" id="mysubmit" value="保存"/>&nbsp;<input type="reset" class="B"
                                                                                      value="清空"/>
            </div>
        </form>
        <?
    } elseif ($myaction == "list") {
        $listtoday = time();
        $listshowtody = date("Y年m月d日", $listtoday);
        $listshowtime = $listtoday - 3600 * 24 * 30;
        $listshowtime1 = $listtoday - 3600 * 24;
        $listshowdate = date("Ymd", $listshowtime);
        $listshowdate2 = date("Ymd", $listshowtime1);

        $listshowmin = strtotime($listshowdate . "00:00:00");
        $listshowmax = strtotime($listshowdate2 . "23:59:59");
        ?>
        <div class="Tinfo">
            <strong>您现在的位置：</strong>查看报表 <a href="./">新增报表</a>
        </div>
        <div class="Tinfo" style=" border-bottom:solid 1px #cccccc; height:50px; line-height:50px;">
            日期： <input type="text" value="<?= date("Y年m月d日", $listshowmin) ?>" class="InPutTxt" style="width:120px"/> -
            <input type="text" value="<?= date("Y年m月d日", $listshowmax) ?>" class="InPutTxt" style="width:120px"/> <input
                    type="button" value="查询" class="B"/>
        </div>
        <div class="Content">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <th height="30">编号</th>
                    <th>日期</th>
                    <th>账户类型</th>
                    <th>资金投入</th>
                    <th>手机投入</th>
                    <th>PC投入</th>
                    <th>点击次数</th>
                    <th>展现量</th>
                    <th>&nbsp;</th>
                </tr>
                <?

                $ListSRes = $YumDamSql->selectsql("SELECT $mt4.`Id` as `cid`,$mt4.`selecttime`,$mt4.`t1`,$mt4.`indate`,$mt2.`fmoney`,$mt2.`wapmoney`,$mt2.`fclick`,$mt2.`fshow`,$mt1.`cname` FROM  $mt4,$mt2,$mt1 where $mt4.`Id`=$mt2.`fdate` and $mt2.`fclass`=$mt1.`Id` and $mt4.`selecttime` between $listshowmin and $listshowmax order by $mt4.`Id` desc,$mt4.`selecttime` desc");
                if (!is_array($ListSRes["select"])) {
                    $ListSRes["select"] = array();
                }
                $List = $ListSRes["select"];
                for ($ii = 0; $ii <= count($List); $ii++) {
                    $v = $List[$ii];
                    $i++;
                    if ($isfirst != $v["selecttime"] && $i != '1') {
                        ?>
                        <tr>
                            <th height="30" align="center">日小计</th>
                            <th><?= timetodate($alltime, true) ?></th>
                            <th>当日全部账户</th>
                            <th><?= $allmoney ?></th>
                            <th><?= $allwapmoney ?></th>
                            <th><?= $allmoney - $allwapmoney ?></th>
                            <th><?= $allclick ?></th>
                            <th><?= $allshow ?></th>
                            <th>&nbsp;</th>
                        </tr>
                        <?
                        $List2SRes = $YumDamSql->selectsql("SELECT $mt3.* FROM  $mt3,$mt4 where $mt3.`fdate`=$mt4.`Id` and $mt4.`selecttime`=$isfirst");
                        if (!is_array($List2SRes["select"])) {
                            $List2SRes["select"] = array();
                        }
                        $List2 = $List2SRes["select"][0];
                        $List2Show = "商务通对话：" . $List2["talkall"] . "个 | 手机对话：" . $List2["talkwap"] . "个 | PC对话：" . ($List2["talkall"] - $List2["talkwap"]) . "个 | 到院重复：" . $List2["retalk1"] . "个 | 未到院重复：" . $List2["retalk2"] . "个 | 行政无效类：" . $List2["notalk"] . "个 | 系统下单：" . $List2["issys"] . "个 | 到院：" . $List2["isfrom"] . "个 | 成交：" . $List2["isok"] . "个 网站IP访问量：" . $List2["webip"] . "次 | 企业QQ对话：" . $List2["bqq"] . "个";
                        $List2Show2 = "&nbsp;&nbsp;<strong>总计：" . ($List2["talkall"] + $List2["bqq"]) . "个</strong>";
                        ?>
                        <tr>
                            <td colspan="9" align="center"><?= $List2Show . $List2Show2; ?></td>
                        </tr>
                        <?
                        $myid = 0;
                        $alltime = 0;
                        $allmoney = 0;
                        $allwapmoney = 0;
                        $allclick = 0;
                        $allshow = 0;
                        if ($ii >= count($List)) {
                            break;
                            #exit;
                        }
                    }
                    ?>
                    <tr>
                        <td align="center"><?= $i ?></td>
                        <td align="center" bgcolor="#CAE8F2"><?= timetodate($v["selecttime"], true) ?></td>
                        <td align="center"><?= $v["cname"] ?></td>
                        <td align="center" bgcolor="#CAE8F2"><?= $v["fmoney"] ?></td>
                        <td align="center"><?= $v["wapmoney"] ?></td>
                        <td align="center" bgcolor="#CAE8F2"><?= $v["fmoney"] - $v["wapmoney"] ?></td>
                        <td align="center"><?= $v["fclick"] ?></td>
                        <td align="center" bgcolor="#CAE8F2"><?= $v["fshow"] ?></td>
                        <?
                        if ($myid == 0) {
                            ?>
                            <td rowspan="<?= $myid2 ?>" align="center"><a
                                        href="m.php?at=<?= encode("show") ?>&d=<?= ecode($v["cid"]) ?>&d2=<?= ecode($v["indate"]) ?>"
                                        target="_self" style="font-weight:bold; color:red;">&gt;&gt;查看详细</a></td>
                            <?
                            $myid2 = 0;
                        }
                        ?>
                    </tr>

                    <?
                    $myid++;
                    $myid2++;
                    $alltime = $v["selecttime"];
                    $allmoney = $allmoney + $v["fmoney"];
                    $allwapmoney = $allwapmoney + $v["wapmoney"];
                    $allclick = $allclick + $v["fclick"];
                    $allshow = $allshow + $v["fshow"];
                    $isfirst = $v["selecttime"];
                }
                ?>
            </table>
        </div>
        <?
    } else {
        ?>
        <div class="Tinfo2">
        <span>
        	<?
            $indextoday = time() - 3600 * 24;
            $indextoday1 = date("Ymd", $indextoday);
            $indextoday2 = date("Y年m月d日", $indextoday);
            $indexintimemin = strtotime($indextoday1 . "00:00:00");
            $indexintimemax = strtotime($indextoday1 . "23:59:59");
            $indexsqlwhere = " $mt4.`selecttime` between $indexintimemin and $indexintimemax";
            $OkIndex = $YumDamSql->selectdb(" `t1` ", $mt4, $indexsqlwhere);
            if (!is_array($OkIndex["select"])) {
                $OkIndex["select"] = array();
            }
            $OkIndex = unserialize($OkIndex["select"][0][0]);
            #$OkIndex=array_keys($OkIndex);

            #print_r($OkIndex);exit;

            $SRes = $YumDamSql->selectsql("SELECT * FROM  $mt1 where `isshow`='1'");
            if (!is_array($SRes["select"])) {
                $SRes["select"] = array();
            }
            $classform = $SRes["select"];
            foreach ($classform as $k => $v) {
                $ii++;
                $id = encode($v["tname"]);
                if (!in_array($v["tname"], $OkIndex) || $v["tname"] == "item") {
                    $i++;
                    ?>
                    <a href="?at=new&e=<?= $id ?>&c=<?= encode($v["cname"]) ?>" class="inputbtn" target="_self">&gt;&gt;新增<?= $v["cname"] ?>数据&lt;&lt;</a>&nbsp; | &nbsp;
                    <?
                }
                if ($i <= 1 && $ii == count($classform)) {
                    echo '<a href="./list.php" class="inputbtn">点击查看' . $indextoday2 . '报表</a>';
                }
            }
            ?>
        </span>
        </div>
        <?
    }
    ?>
    <div class="clearit"></div>
</div>
<script type="text/javascript" src="Scripts/yumdam.my.js"></script>
</body>
</html>