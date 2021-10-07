<div class="Cont">
    <div class="Tinfo">
        <img src="Images/l.jpg" width="338" height="32"/>
    </div>
    <?
    #if(getip()!="61.236.191.15"&&$YumDamNotSelf!=encode("Y",2))
    if (1 != 1) {
        ?>
        <div class="Tinfo" style=" height:50px; line-height:50px;">
            请输入识别码(<?= $YumDamNotSelfCont ?>)：<input type="text" value="" name="ns" id="ns" class="InPutTxt"
                                                     style="width:200px"/> &nbsp;<span id="lt"></span>&nbsp; <input
                    type="submit" value="提交" id="nsbtn" class="B"/>
        </div>
        <script type="text/javascript">
            document.getElementById("nsbtn").onclick = function () {
                var dd1 = document.getElementById("ns").value;
                if (dd1 == "" || dd1 == "0") {
                    return false;
                }
                var url = "Ajax/NotSelf.php?m=<?=encode("Self")?>&c=" + dd1 + "&r=" + Math.random();
                request.open("GET", url, true);
                document.getElementById("lt").innerHTML = "查询中……";
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        var response = request.responseText;
                        if (response == "Y") {
                            window.location.reload();
                            //window.location.href=window.location;
                        } else {
                            document.getElementById("lt").innerHTML = "<font color=red><strong>=_=处理失败！</strong></font>";
                        }
                    }
                }
                request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                request.send(null);
            }
        </script>
        <?
        echo "\n</div>\n</body>\n</html>";
        exit;
    }
    ?>
</div>