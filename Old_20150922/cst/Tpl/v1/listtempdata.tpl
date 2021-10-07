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
            <tr>
                <th rowspan="2" bgcolor="#CCCCCC">日期</th>
                <th rowspan="2" bgcolor="#CCCCCC">姓名</th>
                <th height="28" colspan="3" bgcolor="#999999">整外</th>
                <th colspan="3" bgcolor="#CCCCCC">无创</th>
                <th colspan="3" bgcolor="#999999">皮肤</th>
                <th colspan="3" bgcolor="#CCCCCC">口腔</th>
                <th colspan="3" bgcolor="#999999">无效（其它）</th>
                <th rowspan="2" bgcolor="#CCCCCC">操作</th>
            </tr>
            <tr>
                <th height="28" bgcolor="#A3DFFC">咨询量</th>
                <th>下单量</th>
                <th bgcolor="#A3DFFC">到诊量</th>
                <th>咨询量</th>
                <th bgcolor="#A3DFFC">下单量</th>
                <th>到诊量</th>
                <th bgcolor="#A3DFFC">咨询量</th>
                <th>下单量</th>
                <th bgcolor="#A3DFFC">到诊量</th>
                <th>咨询量</th>
                <th bgcolor="#A3DFFC">下单量</th>
                <th>到诊量</th>
                <th bgcolor="#A3DFFC">咨询量</th>
                <th>下单量</th>
                <th bgcolor="#A3DFFC">到诊量</th>
            </tr>
            <?
            if($TempDataList["row"]<=0)
            {
            ?>
            <tr>
                <td colspan="18" align="center"><strong>暂时没有可参考性数据！<a href="./?ma=<?=encode(" list")?>">点击查看数据</a>
                    </strong></td>
            </tr>
            <?
            }
            else
            {
            #print_r($TempDataListC);
            foreach($TempDataListC as $tk=>$tv)
            {
            $i++;
            $zw=unserialize($tv["izw"]);
            $wc=unserialize($tv["iwc"]);
            $sk=unserialize($tv["isk"]);
            $tk=unserialize($tv["itk"]);
            $nl=unserialize($tv["notnl"]);
            if(!empty($tv["Id"]))
            {
            ?>
            <tr>
                <td><?=timetodate($tv["selecttime"],true)?></td>
                <td><?=$tv["ucname"]?></td>
                <td><?=$zw["tk"];?></td>
                <td><?=$zw["sy"];?></td>
                <td><?=$zw["fr"];?></td>
                <td><?=$wc["tk"];?></td>
                <td><?=$wc["sy"];?></td>
                <td><?=$wc["fr"];?></td>
                <td><?=$sk["tk"];?></td>
                <td><?=$sk["sy"];?></td>
                <td><?=$sk["fr"];?></td>
                <td><?=$tk["tk"];?></td>
                <td><?=$tk["sy"];?></td>
                <td><?=$tk["fr"];?></td>
                <td><?=$nl["tk"];?></td>
                <td><?=$nl["sy"];?></td>
                <td><?=$nl["fr"];?></td>
                <td align="center"><a href="./indata.php?c=<?=ecode($tv[" Id"])."&d=".ecode($tv["selecttime"])?>">修改</a>
                </td>
            </tr>
            <?
            }else
            {
            ?>
            <tr>
                <td colspan="17"></td>
                <td align="center">
                    <strong>
                        <?
              if(empty($tv["selecttime"]))
              {
              #echo "<a href=\"#\">全部结算</a>";
                        }
                        else
                        {
                        echo "<a href=\"./?ma=".encode("ins")."&ie=".ecode($tv["selecttime"])."\" onclick=\"return
                                 confirm('结算后将无法修改数据！确定结算吗?')\">结算</a>";
                        }
                        ?>
                    </strong>
                </td>
            </tr>
            <?
            }
            }
            }
            ?>
        </table>
        <div class="clearit"></div>
    </div>
    <div class="clearit"></div>
</div>
</body>
</html>