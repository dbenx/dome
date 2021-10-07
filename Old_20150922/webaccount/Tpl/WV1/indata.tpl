<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>贵阳当代医疗美容医院</title>
    <link href="/CSS/Style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Scripts/yumdam.my.js"></script>
</head>

<body>
<?
#@include_once("Inc/head.php");
?>
<div class="Cont">
    <?
	if($myaction=="new")
	{
		if($form=="wm")
		{
			$form="6";
			}
		$today=time()-3600*24;
		$today1=ecode(date("Ymd",$today));
		$today2=date("Y年m月d日",$today);
	?>
    <div class="Tinfo">
        <strong>您现在的位置：</strong>新增报表 <a href="./list.php">查看报表</a>&nbsp;&nbsp;<font
                color="red"><strong>请慎重填写如下内容，谢谢！</strong></font>
    </div>
    <form action="" name="myform" id="myform" method="post" onsubmit="return mysubmit<?=$form?>()">
        <div class="Tinfo" style="text-align:center; border-bottom:solid 1px #cccccc;">
            <font color="green"><strong>&gt;&gt; 以下为<?=$formname?>信息 &lt;&lt;</strong>&nbsp;</font>
        </div>
        <div class="Content">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="right">报表日期</td>
                    <td><strong><input type="hidden" name="itime" value="<?=$today1?>"/><font
                                    color="#FF0000"><?=$today2?></font></strong></td>
                    <td><input type="hidden" name="it" value="<?=ecode($form)?>"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <?
    if(CheckId($form)==true||$form=="wm")
	{
	?>
                <tr>
                    <td align="right" width="150">资金投入</td>
                    <td width="150"><input name="im" type="text" id="im" onmouseout="PCIM()" onblur="PCIM()"
                                           class="InPutTxt" autocomplete="off" style="width:150px" value=""/></td>
                    <td align="right" width="200">手机投入</td>
                    <td width="150"><input name="mim" type="text" id="mim" onmouseout="PCIM()" onblur="PCIM()"
                                           class="InPutTxt" autocomplete="off" style="width:150px" value=""/></td>
                    <td align="right" width="150">PC投入</td>
                    <td width="150"><span id="pcim">0</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">点击次数</td>
                    <td><input name="ic" type="text" id="ic" class="InPutTxt" autocomplete="off" style="width:150px"
                               value=""/></td>
                    <td align="right">展现量</td>
                    <td><input name="is" type="text" id="is" class="InPutTxt" autocomplete="off" style="width:150px"
                               value=""/></td>
                    <td align="right">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <?
	}
	elseif($form=="more")
	{
	  ?>
                <tr>
                    <td align="right">商务通对话</td>
                    <td><input name="italk" type="text" id="italk" onmouseout="PCTK()" onblur="PCTK()"
                               autocomplete="off" class="InPutTxt" style="width:150px" value=""/></td>
                    <td align="right">手机对话</td>
                    <td><input name="iwtalk" type="text" id="iwtalk" onmouseout="PCTK()" onblur="PCTK()"
                               autocomplete="off" class="InPutTxt" style="width:150px" value=""/></td>
                    <td align="right">PC对话</td>
                    <td><span id="pctk">0</span></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">到院重复对话</td>
                    <td><input name="isre" type="text" id="isre" class="InPutTxt" style="width:150px" autocomplete="off"
                               value=""/></td>
                    <td align="right">未到院重复对话</td>
                    <td><input name="isre2" type="text" id="isre2" class="InPutTxt" style="width:150px"
                               autocomplete="off" value=""/></td>
                    <td align="right">行政无效对话</td>
                    <td><input name="isre3" type="text" id="isre3" class="InPutTxt" style="width:150px"
                               autocomplete="off" value=""/></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">下单人数</td>
                    <td><input name="iss" type="text" id="iss" class="InPutTxt" style="width:150px" autocomplete="off"
                               value=""/></td>
                    <td align="right">到诊人数</td>
                    <td><input name="isf" type="text" id="isf" class="InPutTxt" style="width:150px" autocomplete="off"
                               value=""/></td>
                    <td align="right">成交人数</td>
                    <td><input name="iso" type="text" id="iso" class="InPutTxt" style="width:150px" autocomplete="off"
                               value=""/></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">网站访问量</td>
                    <td><input name="wi" type="text" id="wi" class="InPutTxt" style="width:150px" autocomplete="off"
                               value=""/></td>
                    <td align="right">企业QQ对话</td>
                    <td><input name="bq" type="text" id="bq" class="InPutTxt" style="width:150px" autocomplete="off"
                               value=""/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <?
	}
	elseif($form=="item")
	{
		$itemtoday=dcode($today1);
		$itemintimemin=strtotime($itemtoday."00:00:00");
		$itemintimemax=strtotime($itemtoday."23:59:59");
		$itemsqlwhere=" $mt4.`selecttime` between $itemintimemin and $itemintimemax and $mt4.`Id`=$mt6.`fdate`";
		$OkItem=$YumDamSql->selectdb(" `fitem` ","$mt4,$mt6",$itemsqlwhere);
                if(!is_array($OkItem["select"]))
                {
                $OkItem["select"]=array();
                }
                $OkItem=unserialize($OkItem["select"][0][0]);
                $OkItem=array_keys($OkItem);
                #print_r($OkItem);exit;


                $mt5='#_@itemclass';
                $ItemSRes=$YumDamSql->selectsql("SELECT * FROM $mt5 where `isshow`='1' and TId=0");
                if(!is_array($ItemSRes["select"]))
                {
                $ItemSRes["select"]=array();
                }
                $ItemClass=$ItemSRes["select"];


                $ItemClassShow="";
                foreach($ItemClass as $k=>$cv){
                $ItemClassShowC=array();
                $ItemClassShowC=$cv;
                $ItemClassShow.="
                <optgroup label=\"".$cv["iname"]."\">\n";
                    $where=" `TId`=".$cv["Id"]." and `isshow`=1";
                    $ItemClass2=$YumDamSql->selectdb("Id,iname",$mt5,$where);
                    $ItemClass2=$ItemClass2["select"];
                    foreach($ItemClass2 as $ks=>$sv){
                    if(!in_array(ecode($sv["Id"]),$OkItem))
                    {
                    $ItemClassShow.="
                    <option value=\"".(ecode($sv["Id"]))."\">--".$sv["iname"]."</option>
                    \n";
                    }
                    }
                    $ItemClassShow.="
                </optgroup>
                \n";
                }


                ?>
                <tr>
                    <td align="right">咨询项目</td>
                    <td>
                        <select name="ii" id="ii">
                            <option value="">--请选择咨询项目--</option>
                            <?=$ItemClassShow?>
                        </select>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">咨询数量</td>
                    <td><input name="in" type="text" id="in" class="InPutTxt" style="width:150px" autocomplete="off"
                               value=""/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">下单数量</td>
                    <td><input name="isi" type="text" id="isi" class="InPutTxt" autocomplete="off" style="width:150px"
                               value=""/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">到诊数量</td>
                    <td><input name="tisf" type="text" id="tisf" class="InPutTxt" autocomplete="off" style="width:150px"
                               value=""/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">消费金额</td>
                    <td><input name="ism" type="text" id="ism" class="InPutTxt" autocomplete="off" style="width:150px"
                               value="0"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <?
	}
	else
	{
	echo '<script type="text/javascript"> window.location="./";</script>';
                }
                ?>
            </table>
            <div class="clearit"></div>
        </div>
        <div class="ContBtn">
            <input type="submit" class="B" id="mysubmit" value="保存"/>&nbsp;<input type="reset" class="B" value="清空"/>
        </div>
    </form>
    <?
	 }
     else{
	 ?>
    <div class="Tinfo2">
        <span>
        	<?
			$indextoday=time()+3600*24;
			$indextoday1=date("Ymd",$indextoday);
			$indextoday2=date("Y年m月d日",$indextoday);
			$indexintimemin=strtotime($indextoday1."00:00:00");
			$indexintimemax=strtotime($indextoday1."23:59:59");
			$indexsqlwhere=" $mt4.`selecttime` between $indexintimemin and $indexintimemax";
			$OkIndex=$YumDamSql->selectdb(" `t1` ",$mt4,$indexsqlwhere);
			if(!is_array($OkIndex["select"]))
			{
				$OkIndex["select"]=array();
			}	
			$OkIndex=unserialize($OkIndex["select"][0][0]);
			#$OkIndex=array_keys($OkIndex);
			
			#print_r($OkIndex);exit;
			
			$SRes=$YumDamSql->selectsql("SELECT * FROM  $mt1 where `isshow`='1'");
			if(!is_array($SRes["select"]))
			{
				$SRes["select"]=array();
			}	
			$classform=$SRes["select"];
            foreach($classform as $k=>$v)
			{
				$ii++;
				$id=encode($v["tname"]);
				if(!in_array($v["tname"],$OkIndex)||$v["tname"]=="item")
				{
					$i++;
			?>
        	<a href="?at=new&e=<?=$id?>&c=<?=encode($v[" cname"])?>" class="inputbtn" style="margin:20px 10px;" target="_self">&gt;&gt;新增<?=$v["cname"]?>
            数据&lt;&lt;</a>&nbsp; | &nbsp;
            <?
				}
			}
			?><a href="./Cf.php" class="inputbtn" target="_self">&gt;&gt;新增信息来源数据&lt;&lt;</a>&nbsp; | &nbsp;<a
                    href="./list.php" class="inputbtn" target="_self">&gt;&gt;查看报表数据&lt;&lt;</a>
        </span>
    </div>
    <?
	 }
	  ?>
    <div class="clearit"></div>
</div>
</body>
</html>