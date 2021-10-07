<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳当代医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body oncontextmenu="return false;">
<div class="Cont">
    <div class="Content">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <form action="" name="myform" id="myform" method="post">
                <?
            if(count($UpDateDataC)>0)
                {
                ?>
                <input type="hidden" name="m" value="<?=ecode($aid)?>"/>
                <input type="hidden" name="m2" value="<?=ecode($updatetime)?>"/>
                <input type="hidden" name="mc" value="<?=encode(" update")?>" />
                <?
            }
            ?>
                <!--<tr>
                    <td width="25%" align="right">可选日期：</td>
                    <td colspan="4">
                    <?
                    foreach($CanDateListArrayShow as $k=>$v)
                    {
                    echo date("Y年m月d日",strtotime($v."00:00:00"))." &nbsp; ";
                    }
                    ?>
                    </td>
                </tr>
                -->
                <tr>
                    <td width="25%" align="right"><strong>时间</strong></td>
                    <td colspan="4">
                        <?=!empty($updatetime)?timetodate($updatetime,true):"";?>
                        <strong><?=$yestoday2?></strong><input type="hidden" name="itime" value="<?=$yestoday1?>"/>
                    </td>
                </tr>
                <tr>
                    <td align="right"><strong>姓名</strong></td>
                    <td colspan="4">
                        <?
              if(!empty($UpDateDataC["ucname"]))
              {
              echo "<strong>".$UpDateDataC["ucname"]."</strong>";
                        }else
                        {
                        ?>
                        <select name="uc">
                            <?
                        foreach($DataUserListShow as $ck=>$cv)
                            {
                            ?>
                            <option value="<?=ecode($cv[" Id
                            "])?>"><?=$cv["ucname"]?></option>
                            <?
						}
						?>
                        </select>
                        <?
              }
              ?>
                    </td>
                </tr>
                <tr>
                    <td align="right" height="45" style="border-bottom:none;"><strong>项目</strong></td>
                    <th width="100">咨询量</th>
                    <th width="100">下单量</th>
                    <th width="100">到诊量</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <td align="right"><strong>整外</strong></td>
                    <td><input type="text" name="zwtk" id="zwtk" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCzw)>0?$UpDateDataCzw[" tk"]:"0"?>" onmouseout="_total('tk')"
                        onblur="_total('tk')" />
                    </td>
                    <td><input type="text" name="zwsy" id="zwsy" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCzw)>0?$UpDateDataCzw[" sy"]:"0"?>" onmouseout="_total('sy')"
                        onblur="_total('sy')" />
                    </td>
                    <td><input type="text" name="zwfr" id="zwfr" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCzw)>0?$UpDateDataCzw[" fr"]:"0"?>" onmouseout="_total('fr')"
                        onblur="_total('fr')" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td align="right"><strong>无创</strong></td>
                    <td><input type="text" name="wctk" id="wctk" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCwc)>0?$UpDateDataCwc[" tk"]:"0"?>" onmouseout="_total('tk')"
                        onblur="_total('tk')" />
                    </td>
                    <td><input type="text" name="wcsy" id="wcsy" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCwc)>0?$UpDateDataCwc[" sy"]:"0"?>" onmouseout="_total('sy')"
                        onblur="_total('sy')" />
                    </td>
                    <td><input type="text" name="wcfr" id="wcfr" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCwc)>0?$UpDateDataCwc[" fr"]:"0"?>" onmouseout="_total('fr')"
                        onblur="_total('fr')" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td align="right"><strong>皮肤</strong></td>
                    <td><input type="text" name="sktk" id="sktk" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCsk)>0?$UpDateDataCsk[" tk"]:"0"?>" onmouseout="_total('tk')"
                        onblur="_total('tk')" />
                    </td>
                    <td><input type="text" name="sksy" id="sksy" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCsk)>0?$UpDateDataCsk[" sy"]:"0"?>" onmouseout="_total('sy')"
                        onblur="_total('sy')" />
                    </td>
                    <td><input type="text" name="skfr" id="skfr" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCsk)>0?$UpDateDataCsk[" fr"]:"0"?>" onmouseout="_total('fr')"
                        onblur="_total('fr')" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td align="right"><strong>口腔</strong></td>
                    <td><input type="text" name="tktk" id="tktk" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCtk)>0?$UpDateDataCtk[" tk"]:"0"?>" onmouseout="_total('tk')"
                        onblur="_total('tk')" />
                    </td>
                    <td><input type="text" name="tksy" id="tksy" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCtk)>0?$UpDateDataCtk[" sy"]:"0"?>" onmouseout="_total('sy')"
                        onblur="_total('sy')" />
                    </td>
                    <td><input type="text" name="tkfr" id="tkfr" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCtk)>0?$UpDateDataCtk[" fr"]:"0"?>" onmouseout="_total('fr')"
                        onblur="_total('fr')" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td align="right"><strong>无效(其它)</strong></td>
                    <td><input type="text" name="nltk" id="nltk" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCnl)>0?$UpDateDataCnl[" tk"]:"0"?>" onmouseout="_total('tk')"
                        onblur="_total('tk')" />
                    </td>
                    <td><input type="text" name="nlsy" id="nlsy" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCnl)>0?$UpDateDataCnl[" sy"]:"0"?>" onmouseout="_total('sy')"
                        onblur="_total('sy')" />
                    </td>
                    <td><input type="text" name="nlfr" id="nlfr" class="InPutTxt" style="width:80px;ime-mode:disabled;"
                               onpaste="return false;" onkeypress="keyPress()" autocomplete="off"
                               value="<?=count($UpDateDataCnl)>0?$UpDateDataCnl[" fr"]:"0"?>" onmouseout="_total('fr')"
                        onblur="_total('fr')" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td align="right"><strong>小计</strong></td>
                    <td id="tttk">&nbsp;</td>
                    <td id="ttsy">&nbsp;</td>
                    <td id="ttfr">&nbsp;</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5" align="right">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="4"><input type="submit" value="保存" class="B"/></td>
                </tr>
            </form>
        </table>
        <div class="clearit"></div>
    </div>
    <div class="clearit"></div>
</div>
<script type="text/javascript">

    function keyPress() {
        var keyCode = event.keyCode;
        //this.value=this.value.replace(/[\d]/g,'');
        if ((keyCode >= 48 && keyCode <= 57)) {
            event.returnValue = true;
        } else {
            event.returnValue = false;
        }
    }


    function _total(cl) {
        var _zw = document.getElementById("zw" + cl).value;
        var _wc = document.getElementById("wc" + cl).value;
        var _pf = document.getElementById("sk" + cl).value;
        var _kq = document.getElementById("tk" + cl).value;
        var _nt = document.getElementById("nl" + cl).value;
        document.getElementById("tt" + cl).innerHTML = "<strong style=\"color:red;\">" + (parseInt(_zw) + parseInt(_wc) + parseInt(_pf) + parseInt(_kq) + parseInt(_nt)) + "</strong>";
    }
</script>
</body>
</html>