<?php
header("Content-Type:text/html; charset=utf-8");
session_start();

include("../Config/Common.Inc.php");####加载配置文件

if (!isset($_SESSION["pwd"])) {

    echo '<form method="post">用户名:<input type="text" name="user" ><br/><br/>密码：<input type="password" name="pwd" ><input type="submit" value="查看"></form>';

    $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';

    $user = $_POST['user'];

    if ($pwd == '' || $user == '') exit('请输入有效信息');

    if ($pwd == $npwd && $user == date('Ymd')) {

        $_SESSION['pwd'] = 'dnal';
        echo "<script type=\"text/javascript\"> \n alert('成功登录!');\n window.location.href=\"index.php\";\n</script>";

    } else {
        exit('输入错误，请重新输入！');
    }


}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>商务数据统计平台！</title>
    <script src="/js/My97DatePicker/WdatePicker.js">
    </script>
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
    <div class="Tinfo"><h3>贵阳当代医疗美容医院网站商务数据统计平台！</h3></div>
</div>

<div class="Cont">
    <form action="AddTj.php" name="myform" method="post" id="myform" enctype="multipart/form-data"
          onsubmit="return submitinput()">
        <div class="Content">
            <table width="100%" border="0" cellpadding="2" cellspacing="1">
                <tr>
                    <td width="15%" align="right">日期：</td>
                    <td><input class="Wdate" type="text" onClick="WdatePicker()" name="tdate"
                               style="width:300px; height:28px; line-height:28px; border:solid 1px #eeeeee; padding:2px;"><span
                                id="tdate" style="color:#F00;"></span>
                        &nbsp;必填
                    </td>
                </tr>
                <tr>
                    <td align="right">项目：</td>
                    <td>
                        <select name="item" id="item" style=" width:300px; height:30px; line-height:30px;">

                            <optgroup label="整形美容">
                                <option value="1">吸脂整形</option>
                                <option value="2">隆胸整形</option>
                                <option value="3">鼻部整形</option>
                                <option value="4">胸部整形</option>
                                <option value="5">修复系列</option>
                                <option value="6">眼部整形</option>
                                <option value="7">眼袋整形</option>
                                <option value="8">眉部整形</option>
                                <option value="9">耳部整形</option>
                                <option value="10">唇部整形</option>
                                <option value="11">下颌整形</option>
                                <option value="12">面部整形</option>
                                <option value="13">自体脂肪</option>
                                <option value="14">私密整形</option>
                            </optgroup>

                            <optgroup label="无创美容">
                                <option value="15">无创注射</option>
                                <option value="16">瘦脸针</option>
                                <option value="17">注射填充</option>
                                <option value="18">注射除皱</option>

                            </optgroup>

                            <optgroup label="皮肤美容">
                                <option value="19">毛发移植</option>
                                <option value="20">紧肤治疗</option>
                                <option value="21">去皱拉皮</option>
                                <option value="22">美白皮肤</option>
                                <option value="23">祛斑治疗</option>
                                <option value="24">祛痘治疗</option>
                                <option value="25">疤痕治疗</option>
                                <option value="26">取痣治疗</option>
                                <option value="27"> 红血丝</option>
                                <option value="28">激光美容</option>
                                <option value="29">美容护理</option>
                                <option value="30">脱毛治疗</option>
                                <option value="31">纹绣美容</option>
                                <option value="32">美甲</option>
                            </optgroup>

                            <optgroup label="口腔美容">
                                <option value="33">美容冠</option>
                                <option value="34">正畸</option>
                                <option value="35">牙齿美白</option>
                                <option value="36">种植牙</option>
                                <option value="37">牙外科</option>
                            </optgroup>

                            <option value="38">其它</option>


                        </select>


                    </td>
                </tr>
                <tr>
                    <td align="right">年龄：</td>
                    <td><input name="age" type="text" id="stitle" class="InPutTxt" style="width:300px"
                               onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)"/>
                        填写0代表没有数据<br/><span id="sfileshow" style="color:#F00;"></span></td>
                </tr>
                <tr>
                    <td align="right">性别：</td>
                    <td><select name="sex" id="sex" style="width:300px;height:30px; line-height:30px;">
                            <option value="1">女</option>
                            <option value="2">男</option>
                            <option value="0">未知</option>
                        </select>
                        (必填)<br/><span id="cfileshow"></span></td>
                </tr>

                <tr>
                    <td align="right">联系方式：</td>
                    <td><select name="contact" id="sex" style="width:300px;height:30px; line-height:30px;">
                            <option value="1">电话</option>
                            <option value="2">QQ</option>
                            <option value="0">未留</option>
                        </select>
                        (必填)
                    </td>
                </tr>


                <tr>
                    <td align="right">来源：</td>
                    <td><select name="ly" id="ly" style="width:300px;height:30px; line-height:30px;">
                            <option value="1">PC</option>
                            <option value="2">移动</option>
                        </select>
                        (必填)ipad统计为移动
                    </td>
                </tr>

                <tr>
                    <td align="right">是否重复咨询：</td>
                    <td><select name="cf" id="cf" style="width:300px;height:30px; line-height:30px;">
                            <option value="1">未重复</option>
                            <option value="2">术后重复咨询</option>
                            <option value="3">未上门重复咨询</option>
                            <option value="5">上门未成交重复咨询</option>
                        </select>
                        (必填)
                    </td>
                </tr>

                <tr>
                    <td align="right">咨询师：</td>
                    <td><select name="zxs" id="zxs" style="width:300px;height:30px; line-height:30px;">
                            <option value="1">当代国际整形专家邓思敏</option>
                            <option value="2">当代国际整形专家董金枝</option>
                            <option value="3">当代国际整形专家方园</option>
                            <option value="4">当代国际整形专家刘阳旭</option>
                            <option value="5">当代国际整形专家唐艳</option>
                            <option value="6">当代国际整形专家王丽</option>
                            <option value="7">当代国际整形专家吴丽娜</option>
                            <option value="8">当代国际整形专家吴医生</option>
                            <option value="9">当代国际整形专家肖萧</option>
                            <option value="10">当代国际整形专家陈丽娟</option>
                            <option value="11">当代国际整形专家陈明燕</option>
                            <option value="12">当代国际整形专家黄莉</option>
                            <option value="13">当代国际整形专家李瑞娟</option>
                            <option value="14">当代国际整形专家潘雪蕾</option>
                            <option value="15">当代国际整形专家2</option>
                            <option value="16">当代国际整形专家杨曼熙</option>
                            <option value="17">当代国际整形专家杨夕雅</option>
                            <option value="18">当代国际整形专家杨洋</option>

                        </select>
                        (必填)
                    </td>
                </tr>


                <tr>
                    <td align="right">备注：</td>
                    <td><textarea name="remark" class="ContInfo" rows="5" id="sdescription"></textarea>
                        (可选)
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
    window.onload = function () {
        if (getCookie('nowtime') == null) {
            var myDate = new Date();
            myform.tdate.value = myDate.getFullYear() + '-' + (myDate.getMonth() + 1) + '-' + myDate.getDate();
        } else {
            myform.tdate.value = getCookie('nowtime');
        }
    }

    function submitinput() {

        if (myform.tdate.value == "") {
            document.getElementById("tdate").innerHTML = '请输入日期!'
            myform.tdate.focus();
            return false;
        }

        if (myform.age.value == "") {
            document.getElementById("sfileshow").innerHTML = '请输入年龄!'
            myform.age.focus();
            return false;
        }

        if (window.confirm('你确定数据无误并提交吗？')) {
            setCookie('nowtime', myform.tdate.value);

            return true;

        } else {
            return false;
        }

        var submitvar = document.getElementById("submitinputbtn");
        submitvar.disabled = true;
        submitvar.value = '内容正在保存……';


        return true;
    }

    //写cookies
    function setCookie(name, value) {
        var Days = 30;
        var exp = new Date();
        exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
        document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
    }

    //读取cookies
    function getCookie(name) {
        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
        if (arr = document.cookie.match(reg)) return unescape(arr[2]);
        else return null;
    }
</script>


</body>
</html>