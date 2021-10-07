<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    if (empty($_GET['at'])) die;
    $cate = $YumDamSql->selectsql("select id,name,pid from yumdam_retimecategory order by ppid,pid,px");
    $cate = $cate['select'];
    ?>

    <meta charset="UTF-8">
    <title>数据添加</title>
    <style>
        table {
            border-collapse: collapse;
            border: none;
            margin: 0 auto;
            margin-bottom: 25px;
            border: 2px #ccc solid;
        }

        td {
            border: solid #ccc 1px;
            padding: 5px;
            width: 85px;
            font-size: 14px;
        }

        td input {
            border: none;
            padding: 5px;
            width: 80px;
        }

        .onfocus {
            background-color: #EAF0E8;
        }

        .onblur {
            background-color: #fff;
        }

        select {
            padding: 5px 10px;
            cursor: pointer;
        }

        .submit {
            padding: 5px 15px;
            cursor: pointer;
            border-color: #000;
            border: 1px #f90 solid;
            margin: 0 auto;
            display: block;
        }

        .thd {
            text-align: center;
            background-color: #eee;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .th {
            text-align: center;
            background-color: #eee;
        }
    </style>
</head>
<body>
<table id="table">
    <tr>
        <td>日期</td>
        <td colspan="6"><input type="text" readOnly="true" id="date" value='<?php echo date("Y-m-d"); ?>'></td>
    </tr>
    <tr>
        <td>时间</td>
        <td colspan="6">
            <select name="time" id="time">
                <?php for ($i = date("H"); $i > date("H") - 3; $i--) {
                    $sd = $i - 1;
                    if ($sd == date("H")) {
                        echo "<option selected=\"true\" value=\"{$sd}:00:00\">{$sd}:00:00 -- {$i}:00:00</option>";
                    } else {
                        echo "<option value=\"{$sd}:00:00\">{$sd}:00:00 -- {$i}:00:00</option>";
                    }
                } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>展现</td>
        <td>点击</td>
        <td>消费</td>
        <td>对话</td>
        <td>成本</td>
        <td>状态</td>
    </tr>
    <?php foreach ($cate as $c): ?>
        <tr>
            <?php if ($c['pid'] == 0): ?>
                <td class="thd" colspan="7"> <?php echo $c['name'] ?></td>
            <?php else: ?>
                <td class="th" typeid="<?php echo $c['id'] ?>"><?php echo $c['name'] ?></td>
                <td><input type="text" value="0"></td>
                <td><input type="text" value="0"></td>
                <td><input type="text" value="0"></td>
                <td><input type="text" value="0"></td>
                <td>0</td>
                <td><input class="submit" type="button" value="提交"></td>
            <?php endif ?>
        </tr>
    <?php endforeach ?>
</table>
<script src="js/ajax.js" type="text/javascript"></script>
<script>
    var table = document.getElementById('table');
    var tr = table.getElementsByTagName('tr');
    var datetime = document.getElementById('time');
    if (window.document.all != null) { // IE
        datetime.attachEvent("onchange", selectChange);
    } else { // other
        datetime.addEventListener("change", selectChange, false);
    }

    function selectChange() {
        selectChanged(this);
    }

    function selectChanged(obj) {

        var datetimes = document.getElementById('date').value + " " + obj.value;
        for (var i = 3; i < tr.length; i++) {
            var td = tr[i].getElementsByTagName('td');
            if (td.length > 1) {
                var data = {
                    typeid: td[0].getAttribute("typeid"),
                    datetime: datetimes,
                    id: i
                }
                Ajax("json").post("action.php?action=select", data, function (d) {
                    // console.log(d);
                    var td = tr[d.id].getElementsByTagName('td');
                    td[1].innerHTML = d.zhanxian;
                    td[2].innerHTML = d.dianji;
                    td[3].innerHTML = d.xiaofei;
                    td[4].innerHTML = d.duihua;
                    td[5].innerHTML = d.chengben;
                    td[6].innerHTML = d.zhuangtai;
                    tdChecked();
                });
            }
        }
    }

    function tdChecked() {
        for (var i = 3; i < tr.length; i++) {
            var td = tr[i].getElementsByTagName('td');

            if (td.length > 1) {
                tr[i].index = i;
                //insert data
                var btnSend = tr[i].getElementsByTagName("td")[td.length - 1].getElementsByTagName("input")[0];
                if (typeof btnSend != "undefined") {
                    btnSend.index = i;
                    btnSend.onclick = function () {
                        var td = tr[this.index].getElementsByTagName('td');
                        var zhanxians = td[1].getElementsByTagName('input')[0].value;
                        var dianjis = td[2].getElementsByTagName('input')[0].value;
                        var xiaofeis = td[3].getElementsByTagName('input')[0].value;
                        var duihuas = td[4].getElementsByTagName('input')[0].value;
                        var data = {
                            typeid: td[0].getAttribute("typeid"),
                            xiaofei: xiaofeis,
                            duihua: duihuas,
                            zhanxian: zhanxians,
                            dianji: dianjis,
                            datetime: document.getElementById('date').value + " " + document.getElementById('time').value,
                            id: this.index
                        }
                        if (xiaofeis == "0" && duihuas == "0" && zhanxians == "0" && dianjis == "0") {
                            alert("数据没有填写，请填写数据！");
                            return;
                        }

                        if (confirm("确定确认提交吗？")) {
                            Ajax("json").post("action.php?action=insert", data, function (d) {
                                var td = tr[d.id].getElementsByTagName('td');
                                td[6].innerHTML = d.zt;
                                td[1].getElementsByTagName('input')[0].setAttribute("readOnly", "false");
                                td[2].getElementsByTagName('input')[0].setAttribute("readOnly", "false");
                                td[3].getElementsByTagName('input')[0].setAttribute("readOnly", "false");
                                td[4].getElementsByTagName('input')[0].setAttribute("readOnly", "false");
                            });
                            this.style.display = "none";
                        } else {
                            return;
                        }
                    }
                }
            }//end insert data

            //count chengben
            tr[i].onmouseover = function () {
                if (this.index < tr.length && this.index > 0) {
                    var tds = this.getElementsByTagName('td');
                    if (tds.length > 1) {
                        if (tds[3].getElementsByTagName('input')[0].value != "0" &&
                            tds[4].getElementsByTagName('input')[0].value != "0" &&
                            tds[3].getElementsByTagName('input')[0].value != "" &&
                            tds[4].getElementsByTagName('input')[0].value != "") {
                            tds[tds.length - 2].innerHTML = (parseFloat(tds[3].getElementsByTagName('input')[0].value) / parseFloat(tds[4].getElementsByTagName('input')[0].value)).toFixed(2);

                        } else {
                            tds[tds.length - 2].innerHTML = "0";
                        }

                    }
                }
            }

            // td > input changed
            for (var j = 1; j < td.length - 2; j++) {
                var input = td[j].getElementsByTagName('input')[0];

                if (typeof input != "undefined") {

                    if (input.value == "" || input.value == "0") {
                        input.value = "0";
                        input.style.color = "#666";
                    } else {
                        input.style.color = "#00f";
                    }

                    input.onfocus = function () {
                        this.setAttribute("class", "onfocus");
                        if (this.value == "0") this.value = "";
                    }

                    input.onblur = function () {
                        if (this.value.match(/^[0-9]+\.{0,1}[0-9]{0,9}$/) == null) this.value = "0";
                        if (this.value == "" || this.value == "0") {
                            this.value = "0";
                            this.style.color = "#666";
                        } else {
                            this.style.color = "#00f";
                        }
                        this.setAttribute("class", "onblur");
                    }
                }

            } //end  for;

        }//end first for

    }

    window.onload = function () {
        selectChanged(document.getElementById('time'));
    }
</script>
</body>
</html>
