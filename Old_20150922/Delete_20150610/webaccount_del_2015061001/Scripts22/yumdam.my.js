// JavaScript Document 
var request = false;

var newcont = "";
var timeout = null; //
//开始初始化XMLHttpRequest对象
if (window.XMLHttpRequest) { //Mozilla 浏览器
    request = new XMLHttpRequest();
    if (request.overrideMimeType) {//设置MiME类别
        request.overrideMimeType("text/xml");
    }
} else if (window.ActiveXObject) { // IE浏览器
    try {
        request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            request = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {
        }
    }
}
if (!request) { // 异常，创建对象实例失败
    window.alert("不能创建XMLHttpRequest对象实例.");

}


function CheckData(v) {
    var a = /^[0-9]*(\.[0-9]{1,2})?$/;
    if (!a.test(v)) {
//alert("格式不正确");
        return false;
    } else {
///alert("格式正确");
        return true;
    }
}


///////////////////////////////////////////////////数据提交部分//////////////////////////////////////////////////////////////

function PCIM() {
    var allim = document.getElementById("im").value;
    var wim = document.getElementById("mim").value;
    var showcont = "";
    if (!CheckData(allim) || !CheckData(wim)) {
        return false;
    }
    if (allim != 0) {
        document.getElementById("pcim").innerHTML = allim - wim;
    }
}


function PCTK() {
    var _allim = document.getElementById("italk").value;
    var _wim = document.getElementById("iwtalk").value;
    var showcont = "";
    if (!CheckData(_allim) || !CheckData(_wim)) {
        return false;
    }
    if (_allim != 0) {
        document.getElementById("pctk").innerHTML = _allim - _wim;
    }
}

///////////////////////////////////////////////////数据提交部分//////////////////////////////////////////////////////////////

function mybtn() {
    var myvar = document.getElementById("mysubmit");
    myvar.disabled = true;
    myvar.value = '正在提交，请稍等……';
    return true;
}


function tips() {
    document.body.appendChild('<div id="tipsinfo" style="width:440px; height:40px; border:solid 1px #535353; position:absolute; top:50%; left:50%; margin:-20px 0px 0px -220px; font-size:14px; font-weight:bold; color:#333; line-height:40px; padding:30px 20px;">提示消息</div>');
    //document.getElementsByName("body").prepend($("<div>...dosomething</div>"))
    //document.write('<div id="tipsinfo" style="width:440px; height:40px; border:solid 1px #535353; position:absolute; top:50%; left:50%; margin:-20px 0px 0px -220px; font-size:14px; font-weight:bold; color:#333; line-height:40px; padding:30px 20px;">提示消息</div>');
    //return mybtn();

    //setTimeout('document.getElementById("tipsinfo").style.display="none";',5000);
    return false;
}

function mysubmit1() {

    tips();
    return false;
}


function choose_date_czw(date_id, objtd) {
    if (date_id == "choose_date_czw_close") {////关闭
        //document.getElementById("choose_date_czw_id").style.display="none";
        document.body.removeChild(document.getElementById("choose_date_czw_id"));
        return false;
    }

    if (objtd != undefined) {
        if (objtd == "choose_date_czw_empty") {
            document.getElementById(date_id).value = "";
        } else {
            var year1 = document.getElementById("choose_date_czw_year").value;
            var month1 = document.getElementById("choose_date_czw_month").value;
            objtd.innerHTML = objtd.innerHTML < 10 ? "0" + objtd.innerHTML : objtd.innerHTML;
            month1 = month1 < 10 ? "0" + month1 : month1;
            document.getElementById(date_id).value = year1 + "-" + month1 + "-" + objtd.innerHTML;
            //document.getElementById("choose_date_czw_id").style.display="none";
            document.body.removeChild(document.getElementById("choose_date_czw_id"));
        }
        return false;
    }
    var nstr = new Date(); //当前
    if (document.getElementById("choose_date_czw_year") != null) {
        var year = document.getElementById("choose_date_czw_year").value;
        var month = document.getElementById("choose_date_czw_month").value;
        var str = year + "/" + month + "/1";
        nstr = new Date(str); //当前
    }
    var ynow = nstr.getFullYear(); //年份
    var mnow = nstr.getMonth(); //月份
    var dnow = nstr.getDate(); //今日日期
    var n1str = new Date(ynow, mnow, 1); //当月第一天
    var firstday = n1str.getDay(); //当月第一天星期几
    function is_leap(year) {
        return (year % 100 == 0 ? res = (year % 400 == 0 ? 1 : 0) : res = (year % 4 == 0 ? 1 : 0));
    }

    var dstr = "<select id=\"choose_date_czw_year\" onchange=\"choose_date_czw('" + date_id + "')\">";
    for (var y = ynow - 5; y < ynow + 10; y++) {
        if (y == ynow) {
            dstr += "<option value='" + y + "' selected>" + y + "</option>"
        } else {
            dstr += "<option value='" + y + "'>" + y + "</option>"
        }
    }
    dstr += "</select>&nbsp;<select id=\"choose_date_czw_month\" onchange=\"choose_date_czw('" + date_id + "')\">";
    for (var m = 1; m < 13; m++) {
        if (parseInt(mnow + 1) == m) {
            dstr += "<option value='" + m + "' selected>" + m + "</option>"
        } else {
            dstr += "<option value='" + m + "'>" + m + "</option>"
        }
    }
    dstr += "</select>&nbsp;<span style='cursor:pointer; padding:0px 5px;' onclick=\"choose_date_czw('choose_date_czw_close')\">关闭</span>|<span style='cursor:pointer; padding:0px 5px;' onclick=\"choose_date_czw('" + date_id + "','choose_date_czw_empty')\">清空</span>";
//一三五七八十腊(十二月),三十一日永不差;四六九冬(十一月)三十日,唯有二月二十八(闰年二十九).
    var m_days = new Array(31, 28 + is_leap(ynow), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    var tr_str = Math.ceil((m_days[mnow] + firstday) / 7);
    dstr += "<table border='0' cellpadding='8' cellspacing='0' width='100%' style='margin:5px 0px 0px 0px;'><tr bgcolor='#CAE8F2'><th height='25'>日</th><th>一</th><th>二</th><th>三</th><th>四</th><th>五</th><th>六</th></tr>";
    var dqdate = new Date(); //当前
    for (i = 0; i < tr_str; i++) { //外层for语句 - tr标签
        dstr += "<tr>";
        for (k = 0; k < 7; k++) { //内层for语句 - td标签
            idx = i * 7 + k; //表格单元的自然序号
            date_str = idx - firstday + 1; //计算日期
            if (date_str <= 0 || date_str > m_days[mnow]) {
                dstr += "<td>&nbsp;</td>";
            } else {
                if (ynow == dqdate.getFullYear() && mnow == dqdate.getMonth() && dqdate.getDate() == date_str) {
                    dstr += "<td onmouseover=\"this.style.backgroundColor='#6FF'\" onmouseout=\"this.style.backgroundColor='#fff'\" onclick=\"choose_date_czw('" + date_id + "',this)\" style='background-color:#6FF; text-align:center;'>" + date_str + "</td>";
                } else {
                    dstr += "<td onmouseover=\"this.style.backgroundColor='#6FF'\" onmouseout=\"this.style.backgroundColor='#fff'\" onclick=\"choose_date_czw('" + date_id + "',this)\" style='cursor:pointer; text-align:center; padding:2px; height:25px; line-height:25px;'>" + date_str + "</td>";
                }
            }
        }
        dstr += "</tr>";
    }
    dstr += "</table>";
    if (document.getElementById("choose_date_czw_id") == null) {
        var obj = document.getElementById(date_id);
        var odiv = document.createElement("div");
        odiv.id = "choose_date_czw_id";
        odiv.innerHTML = dstr;
        odiv.style.position = "absolute";
        odiv.style.border = "1px #999 solid";
        odiv.style.fontSize = "12px";
        odiv.style.padding = "5px";
        odiv.style.zIndex = 99999;
        odiv.style.backgroundColor = "#ffffff";
        odiv.style.top = obj.offsetTop + obj.offsetHeight + "px";
        odiv.style.left = obj.offsetLeft + "px";
        document.body.appendChild(odiv);
    } else {
        document.getElementById("choose_date_czw_id").style.display = "block";
        document.getElementById("choose_date_czw_id").innerHTML = dstr;
    }
}