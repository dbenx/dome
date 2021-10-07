<?php
//website :  http://www.lvtao.net
//请尊重作者劳动成果!保留版权说明
//因为这并不影响程序执行的速度
//如果你有更好的思路或者方法或能更好的提高程序执行效率，欢迎你参与探讨
//@@@  QQ: 954270
@$page = ceil($_GET['page']);
if (!function_exists('pageft')) {

    function pageft($totle, $displaypg = 20, $shownum = 0, $showtext = 0, $showselect = 0, $showlvtao = 7, $showselects = 20, $showjump = 0, $url = '')
    {
        global $page, $firstcount, $pagenav, $_SERVER;
        $GLOBALS["displaypg"] = $displaypg;

        if (!$page || $page < 0) $page = 1;
        if (!$url) {
            $url = $_SERVER["REQUEST_URI"];
        }
        $parse_url = parse_url($url);
        $url_query = $parse_url["query"];
        if ($url_query) {
            $url_query = ereg_replace("(^|&)page=$page", "", $url_query);
            $url = str_replace($parse_url["query"], $url_query, $url);
            if ($url_query) $url .= "&page"; else $url .= "page";
        } else {
            $url .= "?page";
        }
        $lastpg = ceil($totle / $displaypg);
        $page = min($lastpg, $page);
        $prepg = $page - 1;
        $nextpg = ($page == $lastpg ? 0 : $page + 1);
        $firstcount = ($page - 1) * $displaypg;
        if ($page > $lastpg) $page = $lastpg;
        if ($showtext == 1) {
            $pagenav = "<span class='disabled'>" . ($totle ? ($firstcount + 1) : 0) . "-" . min($firstcount + $displaypg, $totle) . "/$totle 记录</span><span class='disabled'>$page/$lastpg 页</span>";
        } else {
            $pagenav = "";
        }
        if ($lastpg <= 1) return false;

        if ($prepg) $pagenav .= "<a href='$url=1'>首页</a>"; else $pagenav .= '<span class="disabled">首页</span>';
        if ($prepg) $pagenav .= "<a href='$url=$prepg'>上一页</a>"; else $pagenav .= '<span class="disabled">上一页</span>';
        if ($shownum == 1) {
            $o = $showlvtao;
            $u = ceil($o / 2);
            $f = $page - $u;
            if ($f < 0) {
                $f = 0;
            }
            $n = $lastpg;
            if ($n < 1) {
                $n = 1;
            }
            if ($page == 1) {
                $pagenav .= '<span class="current">1</span>';
            } else {
                $pagenav .= "<a href='$url=1'>1</a>";
            }
            ///////////////////////////////////////
            for ($i = 1; $i <= $o; $i++) {
                if ($n <= 1) {
                    break;
                }
                $c = $f + $i;
                if ($i == 1 && $c > 2) {
                    $pagenav .= '...';
                }
                if ($c == 1) {
                    continue;
                }
                if ($c == $n) {
                    break;
                }
                if ($c == $page) {
                    $pagenav .= '<span class="current">' . $page . '</span>';
                } else {
                    $pagenav .= "<a href='$url=$c'>$c</a>";
                }
                if ($i == $o && $c < $n - 1) {
                    $pagenav .= '...';
                }
                if ($i > $n) {
                    break;
                }
            }
            if ($page == $n && $n != 1) {
                $pagenav .= '<span class="current">' . $n . '</span>';
            } else {
                $pagenav .= "<a href='$url=$n'>$n</a>";
            }
        }

        if ($nextpg) $pagenav .= "<a href='$url=$nextpg'>下一页</a>"; else $pagenav .= '<span class="disabled">下一页</span>';
        if ($nextpg) $pagenav .= "<a href='$url=$lastpg'>尾页</a>"; else $pagenav .= '<span class="disabled">尾页</span>';
        if ($showjump == 1) {
            $pagenav .= "转到<input type='text' size='3' title='请输入要跳转到的页数并回车' onkeyup=\"this.value=this.value.replace(/\D/g,'')\" onafterpaste=\"this.value=this.value.replace(/\D/g,'')
\" onkeydown=\"javascript:if(event.charCode==13||event.keyCode==13){if(!isNaN(this.value)){document.location.href='$url='+this.value+'';}return false;}\"/>页";
        }
        if ($showselect == 1) {
            $pagenav .= "跳至<select name='topage' size='1' onchange='window.location=\"$url=\"+this.value'>\n";
            $lvtao = $page - $showselects / 2;
            if ($lvtao <= 0) {
                $lvtaos = 1;
            } else {
                $lvtaos = $lvtao;
            }

            $lvtaoe = $page + $showselects / 2;
            if ($page < $showselects / 2 && $showselects <= $lastpg) {
                $lvtaoe = $showselects;
            } elseif ($lvtaoe >= $lastpg) {
                $lvtaoe = $lastpg;
            }
            for ($i = $lvtaos; $i <= $lvtaoe; $i++) {
                if ($i == $page) $pagenav .= "<option value='$i' selected>$i</option>\n";
                else $pagenav .= "<option value='$i'>$i</option>\n";
            }
            $pagenav .= "</select>页";
        }
    }
}
?>

