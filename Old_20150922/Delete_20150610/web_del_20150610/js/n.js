function sjyz(f) {
    if (f.name.value == "") {
        document.getElementById("tsxx").innerHTML = '请输入您的称呼！'
        f.name.focus();
        return false;
    }

    var cellphone = /^1[3|4|5|8]\d{9}$/;
    if (!cellphone.test(f.tel.value)) {
        document.getElementById("tsxx").innerHTML = '请输入有效的手机号码！'
        f.tel.focus();
        return false;
    }


    if (f.info.value == "" && f.info.value != '比如：预约项目、联系您的合适时间等') {
        document.getElementById("tsxx").innerHTML = '请输入有效的内容！'
        f.contxt.focus();
        return false;
    }

}

function Cinfo() {
    var textobj = document.getElementById('info');
    if (textobj.innerHTML == '比如：预约项目、联系您的合适时间等') {
        textobj.innerHTML = "";
    }
}

function Finfo() {
    var textobj = document.getElementById('info');
    if (textobj.innerHTML.replace(/\s+/g, "") == '') {
        textobj.innerHTML = "比如：预约项目、联系您的合适时间等";
    }
}


function GoTop(idum, sj) {
    var speed = sj || "45";
    var dum = document.getElementById(idum);
    var dum1 = document.getElementById(idum + '1');
    var dum2 = document.getElementById(idum + '2');
    dum2.innerHTML = dum1.innerHTML;

    function Marquee() {
        if ((dum2).offsetHeight - dum.scrollTop <= 0) {
            dum.scrollTop -= (dum1).offsetHeight;
        } else {
            dum.scrollTop++;
        }
    }

    var MyMar = setInterval(Marquee, speed);
    dum.onmouseover = function () {
        clearInterval(MyMar);
    }
    dum.onmouseout = function () {
        MyMar = setInterval(Marquee, speed);
    }
}
