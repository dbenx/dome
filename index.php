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
#header( "Location:./login.php");
if ($YumDamGId == "5") {
    @header("Location:/SendMsg.php?f=Main");
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳美莱医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="./Scripts/yumdam.my.js"></script>
    <style type="text/css">
        html, body, iframe {
            height: 100%;
        }

        /*body{ overflow:hidden;}*/
        body {
            background: #000;
        }

        .Top {
            width: 100%;
            height: 32px;
            line-height: 32px;
            padding: 4px 0px;
            font-size: 18px;
            font-weight: bold;
            text-indent: 10px;
            overflow: hidden;
        }

        .Left1 {
            width: 80px;
            background: #791d77;
            font-size: 14px;
            font-weight: bold;
            color: #FFF;
            border-right: solid 2px #000;
            border-bottom: solid 6px #eeeeee;
            padding: 0px 10px;
        }

        .Left2 {
            width: 100px;
            background: #eeeeee;
            border-right: solid 2px #000;
        }

        .sliderbox {
            width: 100px;
            height: 100%;
            overflow: hidden;
        }

        .sliderbox dt, .dt {
            width: 80px;
            height: 30px;
            line-height: 30px;
            font-size: 14px;
            font-weight: bold;
            color: #FFF;
            background: #791d77;
            padding: 0px 10px;
            cursor: pointer;
            _cursor: hand;
            border-bottom: solid 2px #eeeeee;
        }

        .sliderbox dt a, .dt a {
            color: #FFF;
        }

        .sliderbox dd {
            width: 100px;
            height: auto;
            font-weight: bold;
        }

        .sliderbox dd div {
            width: 90px;
            height: 30px;
            line-height: 30px;
            padding: 0px 5px 0px 5px;
            overflow: hidden;
        }

        .Right1 {
            width: 100%;
            height: 30px;
            line-height: 30px;
            background: #791d77;
            color: #FFF;
            border-bottom: solid 6px #eeeeee;
            overflow: hidden;
        }

        .Right1 a {
            color: #FFF;
        }

        .Right3 {
            width: 100%;
            height: 100%;
            background: #FFF;
        }

        .Bottom {
            width: 100%;
            height: 25px;
            background: #791d77;
            line-height: 25px;
            color: #FFF;
            overflow: hidden;
            text-indent: 10px;
        }
    </style>

</head>

<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="2" class="Top"><img src="/Images/l.jpg" width="338" height="32"/></td>
    </tr>
    <tr>
        <td class="Left1">+ 功能导航</td>
        <td class="Right1">&nbsp; &nbsp;<a href="./maintips.php" target="mainframe">返回桌面</a>&nbsp; &nbsp;<a
                    href="./Login/pr.php" target="mainframe">密码修改</a>&nbsp; &nbsp;<a href="./SendMsg.php"
                                                                                     target="mainframe">发送短信</a>&nbsp;
            &nbsp;欢迎您 <strong><?= $_SESSION["YumDamCname"] ?></strong> ！<span id="TimeShow"></span></td>
    </tr>
    <tr>
        <td class="Left2" valign="top">
            <dl class="sliderbox" id="sliderbox">

                <?
                if ($YumDamGId == "2" || $YumDamGId == "1" || $YumDamGId == "4") {
                    ?>
                    <dt class="open">网电咨询</dt>
                    <dd>
                        <div><a href="./cst/indata.php?at=d" target="mainframe">数据录入</a></div>
                        <div><a href="./cst/?at=bGlzdA==" target="mainframe">查看数据</a></div>
                        <div><a href="./cst/?at=M" target="mainframe">项目数据</a></div>
                        <div><a href="./cst/mytelnum.php?at=L" target="mainframe">手机号码抓取</a></div>
                        <div class="clearit" style="height:0px;"></div>
                    </dd>
                    <?
                }
                if ($YumDamGId == "3" || $YumDamGId == "1") {
                    ?>
                    <dt class="open">数据统计</dt>
                    <dd>
                        <div><a href="./webaccount/" target="mainframe">新增数据</a></div>
                        <div><a href="./webaccount/Item.php?at=Item" target="mainframe">项目数据</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a
                                    href="./webaccount/Item.php?at=lmd" target="mainframe">日</a></div>
                        <div><a href="./webaccount/Item.php?at=Fm" target="mainframe">信息来源</a>&nbsp;<a
                                    href="./webaccount/InData4.php?at=I" style="display:none;" target="mainframe">新增</a>
                        </div>
                        <div><a href="./webaccount/Item.php" target="mainframe">综合报表</a></div>
                        <div><a href="./webaccount/mItem.php?at=ms" target="mainframe">月度情况</a></div>
                        <div><a href="./webaccount/mItem.php?at=msm" target="mainframe">月度消费</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a
                                    href="./webaccount/Item.php?at=msmd" target="mainframe">日</a></div>
                        <div><a href="./webaccount/mItem.php?at=msi" target="mainframe">月度项目</a></div>
                        <div><a href="./webaccount/table.php?at=L"
                                target="mainframe">对话情况</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a
                                    href="./webaccount/Item.php?at=mtmd" target="mainframe">日</a></div>
                        <div class="clearit" style="height:0px;"></div>
                    </dd>
                    <dt class="open">工作任务</dt>
                    <dd>
                        <div><a href="./Task/nnf.php" target="mainframe">新增敌情</a></div>
                        <div><a href="./Task/lnf.php" target="mainframe">查看敌情</a></div>
                        <div class="clearit" style="height:0px;"></div>
                    </dd>
                    <dt class="open">抓取号码</dt>
                    <dd>
                        <div><a href="./mnum/indata.php" target="mainframe">数据导入</a></div>
                        <div><a href="./mnum/?at=templist" target="mainframe">临时数据</a></div>
                        <div><a href="./mnum/" target="mainframe">查看数据</a></div>
                        <div><a href="./mnum/?at=d" target="mainframe">完成情况</a></div>
                        <div class="clearit" style="height:0px;"></div>
                    </dd>
                    <dt class="open">用户管理</dt>
                    <dd>
                        <div><a href="./Login/pr.php" target="mainframe">密码修改</a></div>
                        <div><a href="./Login/ur.php" target="mainframe">添加用户</a></div>
                        <div><a href="./Login/ur.php" target="mainframe">用户管理</a></div>
                        <div><a href="./Login/wxur.php" target="mainframe">微信管理</a></div>
                        <div><a href="./Login/logs.php" target="mainframe">操作日志</a></div>
                        <div><a href="./webaccount/ulist.php?YumDam=b" target="mainframe">查看情况</a></div>
                        <div class="clearit" style="height:0px;"></div>
                    </dd>
                    <?
                }
                ?>
                <dt class="open">时段报表</dt>
                <dd>
                    <div><a href="./retime/?at=i" target="mainframe">数据录入</a></div>
                    <div><a href="./retime/?at=d" target="mainframe">查看数据</a></div>
                    <div class="clearit" style="height:0px;"></div>
                </dd>
                <div class="dt"><a href="./Login/?m=exit" target="_parent">安全退出</a></div>
                <div class="clearit" style="height:0px;"></div>
            </dl>
        </td>
        <td class="Right3">
            <iframe width="100%" height="100%" name="mainframe" id="mainframe" scrolling="auto" frameborder="0"
                    src="./maintips.php"></iframe>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="Bottom">贵阳美莱医疗美容医院·电子商务部</td>
    </tr>
</table>
<script type="text/javascript">
    var accordion = function () {
        var tm = sp = 10;

        function slider(n) {
            this.nm = n;
            this.arr = []
        }

        slider.prototype.init = function (t, c, k) {
            var a, h, s, l, i;
            a = document.getElementById(t);
            this.sl = k ? k : '';
            h = a.getElementsByTagName('dt');
            s = a.getElementsByTagName('dd');
            this.l = h.length;
            for (i = 0; i < this.l; i++) {
                var d = h[i];
                this.arr[i] = d;
                d.onclick = new Function(this.nm + '.pro(this)');
                if (c == i) {
                    d.className = this.sl
                }
            }
            l = s.length;
            for (i = 0; i < l; i++) {
                var d = s[i];
                d.mh = d.offsetHeight;
                if (c != i) {
                    d.style.height = 0;
                    d.style.display = 'none'
                }
            }
        }
        slider.prototype.pro = function (d) {
            for (var i = 0; i < this.l; i++) {
                var h = this.arr[i], s = h.nextSibling;
                s = s.nodeType != 1 ? s.nextSibling : s;
                clearInterval(s.tm);
                if ((h == d && s.style.display == 'none') || (h == d && s.style.display == '')) {
                    s.style.display = '';
                    su(s, 1);
                    h.className = this.sl
                } else if (s.style.display == '') {
                    su(s, -1);
                    h.className = ''
                }
            }
        }

        function su(c, f) {
            c.tm = setInterval(function () {
                sl(c, f)
            }, tm)
        }

        function sl(c, f) {
            var h = c.offsetHeight, m = c.mh, d = f == 1 ? m - h : h;
            c.style.height = h + (Math.ceil(d / sp) * f) + 'px';
            c.style.opacity = h / m;
            c.style.filter = 'alpha(opacity=' + h * 100 / m + ')';
            if (f == 1 && h >= m) {
                clearInterval(c.tm)
            } else if (f != 1 && h == 1) {
                c.style.display = 'none';
                clearInterval(c.tm)
            }
        }

        return {slider: slider}
    }();
    var sliderbox = new accordion.slider("sliderbox");
    sliderbox.init("sliderbox", 0, "open");


    var t = null;
    t = setTimeout(time, 1000);//开始执行
    function time() {
        clearTimeout(t);//清除定时器
        dt = new Date();
        var year = dt.getFullYear();
        var month = dt.getMonth() + 1;
        var day = dt.getDate();
        var h = dt.getHours();
        var m = dt.getMinutes();
        var s = dt.getSeconds();

        if (month < 10) {
            month = "0" + month;
        }
        if (day < 10) {
            day = "0" + day;
        }


        if (h < 10) {
            h = "0" + h;
        }
        if (m < 10) {
            m = "0" + m;
        }
        if (s < 10) {
            s = "0" + s;
        }
        var week;
        //switch判断
        switch (dt.getDay()) {
            case 1:
                week = "星期一";
                break;
            case 2:
                week = "星期二";
                break;
            case 3:
                week = "星期三";
                break;
            case 4:
                week = "星期四";
                break;
            case 5:
                week = "星期五";
                break;
            case 6:
                week = "星期六";
                break;
            default:
                week = "星期天";
                break;
        }

        document.getElementById("TimeShow").innerHTML = "&nbsp;&nbsp;今天日期是：" + year + "年" + month + "月" + day + "日(" + week + ")&nbsp;&nbsp;现在的时间为：" + h + "时" + m + "分" + s + "秒";
        t = setTimeout(time, 1000); //设定定时器，循环执行
    }


</script>
</body>
</html>