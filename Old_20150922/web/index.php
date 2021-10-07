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


$mtitle = '#_@anlist';

$mnocan = '#_@nocan';

if ($_POST) {
    foreach ($_POST as $v => $k) {
        ${$v} = $k;
    }
    if ($stitle == "") {
        exit("标题为空！");
    }
    if (is_uploaded_file($_FILES["sfile"]["tmp_name"])) {
        $uploadfilename = upload('sfile');
    } else {
        $uploadfilename = "NULL";
    }
    if (is_uploaded_file($_FILES["cfile"]["tmp_name"])) {
        $cuploadfilename = upload('cfile');
    } else {
        $cuploadfilename = "NULL";
    }
    $field1 = "`SiteId`,`Title`,`Cont`,`Lipic`,`Lipic2`,`FromSite`,`InDate`,`InputIP`";
    $field2 = "'$ssite','" . addslashes($stitle) . "','" . addslashes($sdescription) . "','$uploadfilename','$cuploadfilename','$fsite'," . time() . ",'" . getip() . "'";
    $IRes = $YumDamSql->insertdb($mtitle, $field1, $field2);
    if ($IRes["affect"] == "1") {
        @IsNewCont("YumDam.Inc");
        echo '添加成功<a href="./list.php">查看列表</a>';
    }
    exit;
}

if ($action == "list") {

    $GetSiteList = $_GET["s"];

    if (!CheckId($GetSiteList)) {
        $GetSiteList = "";
    }

    if (!empty($GetSiteList)) {
        $GetSiteListC = " `SiteId`=$GetSiteList and ";
    }

    $sql = "SELECT * FROM  $mtitle where $GetSiteListC";

    $SRes = $YumDamSql->selectsql("($sql `IsDisplay`=1 and `OkDate` is NULL order by InDate asc limit 0,100) union ($sql `IsDisplay`=1 and `OkDate`=1 order by InDate asc limit 0,20) union ($sql `IsDisplay`=1 and `OkDate` is not NULL order by OkDate desc limit 0,20)");

    if (!is_array($SRes["select"])) {
        $SRes["select"] = array();
    }
    $AnList = $SRes["select"];
    $AnListCount = $SRes["row"];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>网站问题反馈平台！</title>
    <style type="text/css">
        @charset "utf-8";
        /* CSS Document */
        /* 全局样式 */
        /*html { filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1); }*/
        * {
            margin: 0px;
            padding: 0px;
        }

        body, ul, ol, li, p, h1, h2, h3, h4, h5, h6, form, table, td, img, div {
            margin: 0;
            padding: 0;
            border: 0;
        }

        body {
            color: #000;
            font-size: 12px;
            margin: 0px;
            font-family: "宋体", "Arial Unicode MS";
            background: #FFF;
        }

        ul, ol {
            list-style-type: none;
            margin: 0px;
            padding: 0px;
            line-height: 25px;
        }

        select, input, img, select {
            vertical-align: middle;
        }

        a {
            text-decoration: none;
            border: none;
        }

        a:link {
            color: #000;
        }

        a:visited {
            color: #000;
        }

        a:hover, a:active, a:focus {
            color: #000;
            text-decoration: underline;
        }

        .clearit {
            clear: both;
        }


        .main {
            margin: 0 auto;
            width: 980px;
        }

        /*此处不能加背景色*/

        .Cont {
            height: auto;
            padding: 10px 20px;
            border: solid 1px #cccccc;
            margin-bottom: 10px;
        }

        .Tinfo {
            height: 32px;
            line-height: 32px;
        }

        .Content {
            height: auto;
        }

        .Content td {
            border-bottom: dashed 1px #cccccc;
            height: 35px;
            padding: 5px 10px;
        }

        .Content .noborder td {
            border-bottom: none;
        }

        .ContInfo {
            width: 300px;
            height: 120px;
            line-height: 24px;
            border: solid 1px #eeeeee;
            padding: 2px;
            font-weight: bold;
        }

        .ContBtn {
            height: 25px;
            line-height: 25px;
            padding: 10px 100px 10px 200px;
        }


        .InPutTxt {
            width: 300px;
            height: 28px;
            line-height: 28px;
            border: solid 1px #eeeeee;
            padding: 2px;
        }


    </style>
</head>

<body>
<div class="Cont">
    <div class="Tinfo"><h3>贵阳当代医疗美容医院网站BUG平台！</h3></div>
</div>
<?

if (isset($YumDamSid)) {
    ?>

    <div class="Cont">
        <div class="Tinfo">欢迎您！<strong><?= $_SESSION["YumDamSname"] ?></strong>&nbsp;&nbsp;<a href="./login.php?m=exit">安全退出</a>
        </div>
    </div>
    <?
}
?>

<?
if ($action == "list") {
    ?>
    <div class="Cont">
        <div class="Tinfo">
            <strong>您现在的位置：</strong>查看列表 <a href="./">新增问题</a>&nbsp; <a href="./?action=list">刷新页面</a>&nbsp;
            <select name="ssite" id="ssite" onchange="location.href=this.options[this.selectedIndex].value;">
                <option value="./?action=list">查看全部内容</option>
                <?
                foreach ($sitelist as $k => $v) {
                    ?>
                    <option <? if ($GetSiteList == $k) { ?> selected="selected" <? } ?>
                            value="./?action=list&s=<?= $k ?>"><?= $v ?></option>
                    <?
                }
                ?>
            </select>
            &nbsp;&nbsp;<font color="#FF9900"><strong>如问题超过预期时间还没有解决或答复，可以跟踪当前操作人。</strong></font>
        </div>
        <div class="Content">
            <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                <tr height="30">
                    <th>编号</th>
                    <th>标题</th>
                    <th>站点</th>
                    <th>提交时间</th>
                    <th>完成时间</th>
                    <th>完成人</th>
                </tr>
                <?
                foreach ($AnList as $k => $v) {
                    $setid += 1;
                    $listcont = $v['Cont'];
                    $imgcont = $v["Lipic"];
                    $imgcont2 = $v["Lipic2"];
                    $FromSite = $v["FromSite"];
                    $nowuser = $v["NowUser"];
                    ?>
                    <tr bgcolor="#FFFFFF" id="scid<?= $setid ?>" class="noborder" title="点击查看详情"
                        onclick="setTab('scid','<?= $setid ?>','<?= $AnListCount ?>')"
                        style="cursor:pointer; _cursor:hand;">
                        <td><?= $setid; ?></td>
                        <td><?= $v['Title'];
                            if ($FromSite != "" && $FromSite != "http://") {
                                echo '[<a href="javascript:;" target="_self" onclick="GoUrl(\'' . $FromSite . '\')" style=" color:green; font-weight:bold;">进入参考网址</a>]';
                            } ?></td>
                        <td><? if ($GetSiteList != $v['SiteId']) {
                                echo "<a href=\"index.php?action=list&s=" . $v['SiteId'] . "\">" . $sitelist[$v['SiteId']] . "</a>";
                            } else {
                                echo $sitelist[$v['SiteId']];
                            } ?></td>
                        <td><?= date("Y-m-d H:i:s", $v['InDate']); ?></td>
                        <td id="okresult<?= $v['Id']; ?>">
                            <?
                            $OkDate = $v['OkDate'];
                            if ($OkDate != "" && $OkDate != "1") {
                                echo '<font color="green">' . date("Y-m-d H:i:s", $OkDate) . '</font>';
                            } else {
                                if ($OkDate == "1") {
                                    $where = " `AnId`='" . $v['Id'] . "' order by Id desc";
                                    $sql = " Cont ";
                                    $SRes = $YumDamSql->selectdb($sql, "$mnocan", "$where");
                                    $AnCont = $SRes["select"][0]["Cont"];
                                    echo "<span id=\"nocancontid" . $v['Id'] . "\"><font color=\"#FF6600\">(" . $AnCont . ")</font></span>&nbsp;&nbsp;";
                                } else {
                                    if (!isset($YumDamSid)) {
                                        echo '当前<strong style="color:green;">' . $OkGroup[$nowuser] . '</strong>：<font color="red">正在处理……</font>';
                                    }
                                }
                                if (isset($YumDamSid)) {
                                    if ($_SESSION["YumDamGroup"] == $v["NowUser"] || $_SESSION["YumDamGroup"] == "1") {
                                        echo '<a href="javascript:;" onclick="toisok(' . $v['Id'] . ')" target="_self" style="color:red;">点此标记完成</a>&nbsp;&nbsp;<a href="javascript:;" onclick="nocanok(' . $v['Id'] . ')" target="_self" style="color:red;">[添加备注]</a>';
                                    } else {
                                        echo "<font color=red>未完成！</font>";
                                    }
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?
                            echo $OkUser[$v['OkUser']];
                            if ($YumDamGid == "1" && $OkDate == "" || $OkDate == "NULL") {
                                ?>
                                <span id="NowGroup<?= $v['Id'] ?>">
    <select onchange="GoGroup(<?= $v['Id'] ?>,this.options[this.selectedIndex].value)">
    	<?
        foreach ($OkGroup as $k => $v) {
            ?>
            <option <? if ($nowuser == $k) { ?> selected="selected" <? } ?> value="<?= $k ?>"><?= $v ?></option>
            <?
        }
        ?>
    </select>
    </span>
                                <?
                            }
                            if ($YumDamGid != "1" && $OkDate == "" || $OkDate == "NULL") {
                                echo $OkGroup[$nowuser];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr id="con_scid_<?= $setid ?>" <? if ($setid != '1') {
                        echo 'style="display:none;"';
                    } ?>>
                        <td colspan="6">
                            <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                                <?
                                if (!empty($listcont) || !empty($imgcont) || $imgcont != "NULL") {
                                    ?>
                                    <tr bgcolor="#eeeeee" class="noborder">
                                        <td><strong>问题说明：</strong><? if ($imgcont != '' && $imgcont != "NULL") {
                                                echo '<img src="' . $imgcont . '" />';
                                            } ?><br/><?= $listcont ?></td>
                                    </tr>
                                    <?
                                }
                                if ($imgcont2 != "" && $imgcont2 != "NULL") {
                                    ?>
                                    <tr class="noborder">
                                        <td><strong>参考效果图：</strong><img src="<?= $imgcont2 ?>"/></td>
                                    </tr>
                                    <?
                                } ?>
                            </table>
                        </td>
                    </tr>
                    <?
                }
                ?>
            </table>
            <div class="clearit"></div>
        </div>
    </div>
    <script type="text/javascript">
        function GoUrl(site) {
            window.open(site, '_blank');
        }


        function setTab(name, cursel, n) {
            for (i = 1; i <= n; i++) {
                var menu = document.getElementById(name + i);
                var con = document.getElementById("con_" + name + "_" + i);
                menu.className = i == cursel ? "hover" : "";
                con.style.display = i == cursel ? "" : "none";
            }
        }

    </script>
<?
if (isset($YumDamSid)){
?>
    <script type="text/javascript" src="Scripts/yumdam.my.js"></script>
<?
}
}
else if ($action == "Login" && !isset($YumDamSid))
{
?>

    <div class="Cont">
        <div class="Tinfo"><strong>您现在的位置：</strong>登录</div>
        <form action="login.php" name="myform" id="myform" method="post" enctype="multipart/form-data"
              onsubmit="return login()">
            <div class="Content">
                <table width="100%" border="0" cellpadding="2" cellspacing="1">
                    <tr>
                        <td width="15%" align="right">用户名：</td>
                        <td><input name="suser" type="text" id="suser" class="InPutTxt" style="width:300px" value=""/>&nbsp;<font
                                    color="#FF0000">*</font></td>
                    </tr>
                    <tr>
                        <td align="right">密码：</td>
                        <td><input name="spass" type="password" id="spass" class="InPutTxt" style="width:300px"
                                   value=""/></td>
                    </tr>
                </table>
                <div class="clearit"></div>
            </div>
            <div class="ContBtn">
                <input type="submit" class="B" id="submitbtn" name="submitbtn" value="登录"/>&nbsp;<input type="reset"
                                                                                                        class="B"
                                                                                                        value="重填"/>
            </div>
        </form>
        <div class="clearit"></div>
    </div>
    <script type="text/javascript">

        function login() {
            var submitvar = document.getElementById("submitbtn");
            submitvar.disabled = true;
            submitvar.value = '正在登录……';
            return true;
        }
    </script>
<?
}
else
{
?>


    <div class="Cont">
        <div class="Tinfo"><strong>您现在的位置：</strong>新增问题 <a
                    href="./?action=list&<? "t=" . isset($_GET["t"]) ? $_GET["t"] : "" ?>">查看列表</a>&nbsp;&nbsp;<font
                    color="red"><strong>请尽量完全填写如下内容，以便快速解决问题！谢谢！</strong></font></div>
        <form action="" name="myform" method="post" id="myform" enctype="multipart/form-data"
              onsubmit="return submitinput()">
            <div class="Content">
                <table width="100%" border="0" cellpadding="2" cellspacing="1">
                    <tr>
                        <td width="15%" align="right">文章标题：</td>
                        <td><input name="stitle" type="text" id="stitle" class="InPutTxt" style="width:300px" value=""/>&nbsp;<font
                                    color="#FF0000">*</font></td>
                    </tr>
                    <tr>
                        <td align="right">站点：</td>
                        <td>
                            <select name="ssite" id="ssite">
                                <?
                                foreach ($sitelist as $k => $v) {
                                    ?>
                                    <option value="<?= $k ?>"><?= $v ?></option>
                                    <?
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">问题描述图：</td>
                        <td><input type="file" name="sfile" id="sfile"/>(可选)<br/><span id="sfileshow"></span></td>
                    </tr>
                    <tr>
                        <td align="right">参考效果图：</td>
                        <td><input type="file" name="cfile" id="cfile"/>(可选)<br/><span id="cfileshow"></span></td>
                    </tr>
                    <tr>
                        <td align="right">参考地址：</td>
                        <td><input name="fsite" type="text" id="fsite" class="InPutTxt" style="width:300px"/>(可选)</td>
                    </tr>
                    <tr>
                        <td align="right">文档描述：</td>
                        <td><textarea name="sdescription" class="ContInfo" rows="5" id="sdescription"></textarea>(可选)
                        </td>
                    </tr>
                </table>
                <div class="clearit"></div>
            </div>
            <div class="ContBtn">
                <input type="submit" class="B" value="保存" id="submitinputbtn" name="submitinputbtn"/>&nbsp;<input
                        type="reset" class="B" value="清空"/>
            </div>
        </form>
        <div class="clearit"></div>
    </div>

    <script type="text/javascript">


        function submitinput() {
            var submitvar = document.getElementById("submitinputbtn");
            submitvar.disabled = true;
            submitvar.value = '内容正在保存……';
            return true;
        }
    </script>


    <?
}
?>


</body>
</html>