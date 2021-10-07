<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <th rowspan="2" bgcolor="#CCCCCC">日期</th>
        <th rowspan="2" bgcolor="#CCCCCC">姓名</th>
        <th height="28" colspan="5" bgcolor="#999999">整外</th>
        <th colspan="5" bgcolor="#CCCCCC">无创</th>
        <th colspan="5" bgcolor="#999999">皮肤</th>
        <th colspan="5" bgcolor="#CCCCCC">口腔</th>
        <th colspan="3" bgcolor="#999999">无效（其它）</th>
        <th colspan="5" bgcolor="#CCCCCC">总计</th>
    </tr>
    <tr>
        <th height="28" bgcolor="#A3DFFC">咨询</th>
        <th>下单</th>
        <th bgcolor="#A3DFFC">下单率</th>
        <th>到诊</th>
        <th bgcolor="#A3DFFC">到诊率</th>
        <th>咨询</th>
        <th bgcolor="#A3DFFC">下单</th>
        <th>下单率</th>
        <th bgcolor="#A3DFFC">到诊</th>
        <th>到诊率</th>
        <th bgcolor="#A3DFFC">咨询</th>
        <th>下单</th>
        <th bgcolor="#A3DFFC">下单率</th>
        <th>到诊</th>
        <th bgcolor="#A3DFFC">到诊率</th>
        <th>咨询</th>
        <th bgcolor="#A3DFFC">下单</th>
        <th>下单率</th>
        <th bgcolor="#A3DFFC">到诊</th>
        <th>到诊率</th>
        <th bgcolor="#A3DFFC">咨询</th>
        <th>下单</th>
        <th bgcolor="#A3DFFC">到诊</th>
        <th bgcolor="#CCCCCC">咨询</th>
        <th bgcolor="#CCCCCC">下单</th>
        <th bgcolor="#CCCCCC">下单率</th>
        <th bgcolor="#CCCCCC">到诊</th>
        <th bgcolor="#CCCCCC">到诊率</th>
    </tr>
    <?
    if($DataList["row"]<=0)
    {
    ?>
    <tr>
        <td colspan="30" align="center"><strong>暂时没有可参考性数据！<a href="./?ma=<?=encode(" list")?>">点击查看数据</a></strong></td>
    </tr>
    <?
    }
    else
    {
    foreach($DataListC as $tk=>$tv)
    {
    $i++;
    if(!empty($tv["selecttime"]))
    {
    $itemdata=unserialize($tv["itemdata"]);
    #print_r($itemdata);
    foreach($itemdata as $ik=>$iv)
    {
    if($ik!="notnl")
    {
    $totaltk+=$iv["tk"];
    $totalsy+=$iv["sy"];
    $totalfr+=$iv["fr"];
    }
    }
    ?>
    <tr>
        <td><?=timetodate($tv["selecttime"],true)?></td>
        <td><?=$tv["ucname"]?></td>
        <td><?=$itemdata["izw"]["tk"];$ttizwtk=$ttizwtk+$itemdata["izw"]["tk"];?></td>
        <td><?=$itemdata["izw"]["sy"];$ttizwsy=$ttizwsy+$itemdata["izw"]["sy"];?></td>
        <td><?=round($itemdata["izw"]["sy"]/$itemdata["izw"]["tk"]*100,2);?>%</td>
        <td><?=$itemdata["izw"]["fr"];$ttizwfr=$ttizwfr+$itemdata["izw"]["fr"];?></td>
        <td><?=round($itemdata["izw"]["fr"]/$itemdata["izw"]["tk"]*100,2);?>%</td>

        <td><?=$itemdata["iwc"]["tk"];$ttiwctk=$ttiwctk+$itemdata["iwc"]["tk"];?></td>
        <td><?=$itemdata["iwc"]["sy"];$ttiwcsy=$ttiwcsy+$itemdata["iwc"]["sy"];?></td>
        <td><?=round($itemdata["iwc"]["sy"]/$itemdata["iwc"]["tk"]*100,2);?>%</td>
        <td><?=$itemdata["iwc"]["fr"];$ttiwcfr=$ttiwcfr+$itemdata["iwc"]["fr"];?></td>
        <td><?=round($itemdata["iwc"]["fr"]/$itemdata["iwc"]["tk"]*100,2);?>%</td>


        <td><?=$itemdata["isk"]["tk"];$ttisktk=$ttisktk+$itemdata["isk"]["tk"];?></td>
        <td><?=$itemdata["isk"]["sy"];$ttisksy=$ttisksy+$itemdata["isk"]["sy"];?></td>
        <td><?=round($itemdata["isk"]["sy"]/$itemdata["isk"]["tk"]*100,2);?>%</td>
        <td><?=$itemdata["isk"]["fr"];$ttiskfr=$ttiskfr+$itemdata["isk"]["fr"];?></td>
        <td><?=round($itemdata["isk"]["fr"]/$itemdata["isk"]["tk"]*100,2);?>%</td>

        <td><?=$itemdata["itk"]["tk"];$ttitktk=$ttitktk+$itemdata["itk"]["tk"];?></td>
        <td><?=$itemdata["itk"]["sy"];$ttitksy=$ttitksy+$itemdata["itk"]["sy"];?></td>
        <td><?=round($itemdata["itk"]["sy"]/$itemdata["itk"]["tk"]*100,2);?>%</td>
        <td><?=$itemdata["itk"]["fr"];$ttitkfr=$ttitkfr+$itemdata["itk"]["fr"];?></td>
        <td><?=round($itemdata["itk"]["fr"]/$itemdata["itk"]["tk"]*100,2);?>%</td>

        <td><?=$itemdata["notnl"]["tk"];$ttinltk=$ttinltk+$itemdata["notnl"]["tk"];?></td>
        <td><?=$itemdata["notnl"]["sy"];$ttinlsy=$ttinlsy+$itemdata["notnl"]["sy"];?></td>
        <td><?=$itemdata["notnl"]["fr"];$ttinlfr=$ttinlfr+$itemdata["notnl"]["fr"];?></td>


        <td bgcolor="#CCCCCC"><?=$totaltk-$itemdata["notnl"]["tk"];$nexttotaltk=$nexttotaltk+$totaltk;?></td>
        <td bgcolor="#CCCCCC"><?=($totalsy+$itemdata["notnl"]["sy"]);  $nexttotalsy=$nexttotalsy+$totalsy;?></td>
        <td bgcolor="#CCCCCC"><?=round(($totalsy+$itemdata["notnl"]["sy"])/($totaltk-$itemdata["notnl"]["tk"])*100,2);?>
            %
        </td>
        <td bgcolor="#CCCCCC"><?=($totalfr+$itemdata["notnl"]["fr"]);  $nexttotalfr=$totalfr+$totalfr;?></td>
        <td bgcolor="#CCCCCC"><?=round(($totalfr+$itemdata["notnl"]["fr"])/($totalsy+$itemdata["notnl"]["sy"])*100,2);unset($totaltk);unset($totalsy);unset($totalfr);?>
            %
        </td>

    </tr>
    <?
    }else
    {
    if($DataList["row"]==$i)
    {
    ?>
    <tr bgcolor="#999999">
        <td colspan="22">全部记录：<?=$tv["re"]?>条</td>
        <td><?=$lastttnltk;?></td>
        <td><?=$lastttnlsy;?></td>
        <td><?=$lastttnlfr;?></td>
        <td><?=$lasttttk?></td>
        <td><?=$lastttsy?></td>
        <td><?=round(($lastttsy+$lastttnlsy)/($lasttttk-$lastttnltk)*100,2);?>%</td>
        <td><?=$lastttfr?></td>
        <td><?=round(($lastttfr+$lastttnlfr)/($lastttsy+$lastttnlsy)*100,2);?>%</td>
    </tr>
    <?
    }
    else
    {
    ?>
    <tr bgcolor="#A3DFFC">
        <td colspan="2" align="center">小计</td>
        <td><?=$ttizwtk;?></td>
        <td><?=$ttizwsy;?></td>
        <td><?=round($ttizwsy/$ttizwtk*100,2);?>%</td>
        <td><?=$ttizwfr;?></td>
        <td><?=round($ttizwfr/$ttizwtk*100,2);?>%</td>

        <td><?=$ttiwctk;?></td>
        <td><?=$ttiwcsy;?></td>
        <td><?=round($ttiwcsy/$ttiwctk*100,2);?>%</td>
        <td><?=$ttiwcfr;?></td>
        <td><?=round($ttiwcfr/$ttiwctk*100,2);?>%</td>


        <td><?=$ttisktk;?></td>
        <td><?=$ttisksy;?></td>
        <td><?=round($ttisksy/$ttisktk*100,2);?>%</td>
        <td><?=$ttiskfr;?></td>
        <td><?=round($ttiskfr/$ttisktk*100,2);?>%</td>

        <td><?=$ttitktk;?></td>
        <td><?=$ttitksy;?></td>
        <td><?=round($ttitksy/$ttitktk*100,2);?>%</td>
        <td><?=$ttitkfr;?></td>
        <td><?=round($ttitkfr/$ttitktk*100,2);?>%</td>

        <td><?=$ttinltk;?></td>
        <td><?=$ttinlsy;?></td>
        <td><?=$ttinlfr;?></td>


        <td>
            <?
      $attitk=$ttizwtk+$ttiwctk+$ttisktk+$ttitktk;
      $lasttttk=$lasttttk+$attitk;
      $attisy=$ttizwsy+$ttiwcsy+$ttisksy+$ttitksy;
      $lastttsy=$lastttsy+$attisy;
      $attifr=$ttizwfr+$ttiwcfr+$ttiskfr+$ttitkfr;
      $lastttfr=$lastttfr+$attifr;
      
      $lastttnltk=$lastttnltk+$ttinltk;
      $lastttnlsy=$lastttnlsy+$ttinlsy;
      $lastttnlfr=$lastttnlfr+$ttinlfr;
      
      
      echo $attitk;
      ?>
        </td>
        <td><?=$attisy?></td>
        <td><?=round(($attisy+$ttinlsy)/($attitk-$ttinltk)*100,2);?>%</td>
        <td><?=$attifr?></td>
        <td><?=round(($attifr+$ttinlfr)/($attisy+$ttinlsy)*100,2);?>%</td>

    </tr>
    </tr>
    <?
    unset($ttizwtk);unset($ttizwsy);unset($ttizwfr);
    unset($ttiwctk);unset($ttiwcsy);unset($ttiwcfr);
    unset($ttisktk);unset($ttisksy);unset($ttiskfr);
    unset($ttitktk);unset($ttitksy);unset($ttitkfr);
    
    unset($ttinltk);unset($ttinlsy);unset($ttinlfr);
    }
    }}
    }
    ?>
</table>