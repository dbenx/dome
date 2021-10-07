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

#exit;

$action = $_GET["action"];

if ($action == "mnum") {
    header("Location:./mnum/?" . $_SERVER["QUERY_STRING"]);
    exit;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>美莱(贵州)医疗美容医院</title>
    <link href="http://i.dangdai.cc/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        html, body, iframe {
            height: 100%;
        }

        /*body{ overflow:hidden;}*/

        .Top {
            width: 100%;
            height: 32px;
            line-height: 32px;
            padding: 4px 0px;
            font-size: 18px;
            font-weight: bold;
            text-indent: 20px;
        }

        .MyMain {
            height: 100%;
        }

        .Left {
            width: 100px;
            height: 100%;
            background: #eeeeee;
            float: left;
        }

        .sliderbox {
            width: 100px;
            height: auto;
        }

        .sliderbox dt, .dt {
            width: 80px;
            height: 35px;
            line-height: 35px;
            font-size: 16px;
            font-weight: bold;
            color: #FFF;
            background: #999;
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
            width: 80px;
            height: 30px;
            line-height: 30px;
            padding: 0px 10px 0px 10px;
            background: #eeeeee;
            overflow: hidden;
        }

        .sliderbox dd div a {
            width: 80px;
            height: 30px;
            display: inline-block;
        }

        .Right {
            height: 100%;
            padding: 0px 0px 0px 10px;
            margin: 0px 0px 0px 100px;
        }

        .Right1 {
            width: 100%;
            height: 30px;
            background: #0C3;
            border-bottom: solid 10px #eeeeee;
        }

        .Right1C {
            width: 100%;
            height: 30px;
            line-height: 30px;
            background: #CCC;
        }

        .Right3 {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .Right3C {
            width: 100%;
            height: 100%;
        }


    </style>
</head>

<body>
<div class="Top"><img src="/Images/l.jpg" width="338" height="32"/></div>
<div class="MyMain">
    <div class="Left">
        <dl class="sliderbox" id="sliderbox">
            <dt class="open">数据统计</dt>
            <dd>
                <div><a href="./webaccount/" target="mainframe">新增数据</a></div>
                <div><a href="./webaccount/list.php" target="mainframe">查看报表</a></div>
                <div><a href="./webaccount/item.php?at=list" target="mainframe">项目报表</a></div>
                <div><a href="./webaccount/item.php?at=listd" target="mainframe">商务通数据</a></div>
                <div><a href="./webaccount/item.php?at=lstm" target="mainframe">投入数据</a></div>
                <div><a href="./webaccount/mitem.php?at=list" target="mainframe">月报表</a></div>
                <div><a href="./webaccount/ulist.php?YumDam=list" target="mainframe">查看日志</a></div>
                <div class="clearit" style="height:0px;"></div>
            </dd>
            <dt class="open">咨询成绩</dt>
            <dd>
                <div><a href="./cst/indata.php?at=d" target="mainframe">数据录入</a></div>
                <div><a href="./cst/?ma=list" target="mainframe">临时数据</a></div>
                <div><a href="./cst/item.php?ma=bGlzdA==" target="mainframe">正式数据</a></div>
                <div class="clearit" style="height:0px;"></div>
            </dd>
            <dt class="open">手机号码</dt>
            <dd>
                <div><a href="./mnum/indata.php" target="mainframe">数据导入</a></div>
                <div><a href="./mnum/?at=templist" target="mainframe">临时数据</a></div>
                <div><a href="./mnum/" target="mainframe">查看数据</a></div>
                <div><a href="./mnum/?at=d" target="mainframe">完成情况</a></div>
                <div class="clearit" style="height:0px;"></div>
            </dd>
            <dt class="open">网站反馈</dt>
            <dd>
                <div><a href="./web/" target="mainframe">新增反馈</a></div>
                <div><a href="./web/?action=list" target="mainframe">查看反馈</a></div>
                <div class="clearit" style="height:0px;"></div>
            </dd>
            <dt class="open">用户管理</dt>
            <dd>
                <div><a href="./Login/pr.php" target="mainframe">密码修改</a></div>
                <div><a href="./Login/ur.php" target="mainframe">添加用户</a></div>
                <div><a href="./Login/ur.php" target="mainframe">用户管理</a></div>
                <div class="clearit" style="height:0px;"></div>
            </dd>
            <div class="dt"><a href="./Login/?m=exit" target="_parent">安全退出</a></div>
        </dl>
        <div class="clearit"></div>
    </div>
    <div class="Right">
        <div class="Right1">
            <div class="Right1C">&nbsp; &nbsp;欢迎您 <strong
                        style="color:#008000;"><?= $_SESSION["YumDamCname"] ?></strong> ！<span id="TimeShow"></span>
            </div>
        </div>
        <div class="Right3">
            <div class="Right3C">
                <iframe width="100%" height="100%" name="mainframe" style="position:absolute;" id="mainframe"
                        scrolling="auto" frameborder="0" src="./maintips.html"></iframe>
                <div class="clearit"></div>
            </div>
            <div class="clearit"></div>
        </div>
        <div class="clearit"></div>
    </div>
    <div class="clearit"></div>
</div>


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
    var slider2 = new accordion.slider("slider2");
    slider2.init("sliderbox", 0, "open");


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