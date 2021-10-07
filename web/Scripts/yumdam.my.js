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


function toisok(sid) {

    if (!confirm('确定要进行此操作吗?')) {
        return false;
    }
    var listid = sid;
    if (listid == "") {
        return false;
    }
    var url = "dook.php?action=IsOK&LId=" + listid + "&r=" + Math.random();
    //alert(url);
    request.open("GET", url, true);
    //request.onreadystatechange = updatePage(listid);
    document.getElementById("okresult" + listid).innerHTML = "处理中……";
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.getElementById("okresult" + listid).innerHTML = response;
            window.location.reload();
        }
    }
    request.send(null);
}

function GoGroup(sid, gid) {
    var listid = sid;
    var groupid = gid;
    if (listid == "") {
        return false;
    }
    var url = "dook.php?action=NowGroup&LId=" + listid + "&GId=" + groupid + "&r=" + Math.random();
    //alert(url);
    request.open("GET", url, true);
    document.getElementById("NowGroup" + listid).innerHTML = "处理中……";
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.getElementById("NowGroup" + listid).innerHTML = response;
        }
    }
    request.send(null);
}


function nocanok(varid) {
    var nocanid = varid;
    var tipsname = prompt("请输入备注内容", "");//将输入的内容赋给变量 name ，
//这里需要注意的是，prompt有两个参数，前面是提示的话，后面是当对话框出来后，在对话框里的默认值
    if (tipsname)//如果返回的有内容
    {
        var url = "dook.php?action=NoCanOK&LId=" + nocanid + "&NoCont=" + tipsname + "&r=" + Math.random();
        //alert(url);
        request.open("GET", url, true);
        document.getElementById("nocancontid" + nocanid).innerHTML = "处理中……";
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                document.getElementById("nocancontid" + nocanid).innerHTML = response;
                window.location.reload();
            }
        }
        request.send(null);
    }

}


function GetCont() {
    var url = "YumDam.Inc?r=" + Math.random();
    request.open("GET", url, false);
    request.send(null);
    IsCont = request.responseText;
    return IsCont;
}

GetCont();


function GetNewCont() {
    var url = "YumDam.Inc?r=" + Math.random();
    request.open("GET", url, false);
    request.onreadystatechange = function () {//回调函数开始
        if (request.readyState == 4 && request.status == 200) {
            newcont = request.responseText;
            if (IsCont != newcont) {
                window.focus();
                alert('有新内容，请阅读！');
                window.location.reload();
            }
        }
    }//回调函数结束
    request.send(null);
}

function mytimeout() {
    GetNewCont();
    timeout = setTimeout('mytimeout()', 10000);
}

timeout = setTimeout('mytimeout()', 10000);


//////////////////////////////
/*
function updatePage(lid)
{
	if(request.readyState == 4)
	{
	var response = request.responseText;
	document.getElementById("okresult"+lid).innerHTML=response;
	}
	if(request.readyState < 4)
	{
		document.getElementById("okresult"+lid).innerHTML="处理成功！";
	}
}*/