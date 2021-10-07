<?php
include("../Config/Config.Inc.php");
function insert($post)
{
    global $YumDamSql, $YumDamSId;
    $field = "";
    $value = "";

    $data = $post;

    $strDate = preg_split("/[- :]/", $data['datetime']);
    $data['datetime'] = mktime($strDate[3], $strDate[4], $strDate[5], $strDate[1], $strDate[2], $strDate[0]);

    $typeid = $data["typeid"];
    $datetime = $data['datetime'];

    $sql = "select xiaofei,duihua,zhanxian,dianji from yumdam_retimedata where typeid = {$typeid} and datetime={$datetime} order by datetime";
    $ds = $YumDamSql->selectsql($sql);

    if ($ds['row'] > 0) {
        echo json_encode(array("id" => $data["id"], "zt" => "<em style='color:#369B5D;font-weight:bold;'>已有数据</em>"));
    }

    $datas = array(
        'datetime' => $data['datetime'],
        'xiaofei' => $data['xiaofei'],
        'duihua' => $data['duihua'],
        'zhanxian' => $data['zhanxian'],
        'dianji' => $data['dianji'],
        'typeid' => $data['typeid'],
        'inuser' => $YumDamSId,
        'uip' => getip(),
        'indate' => time()
    );


    foreach ($datas as $key => $v) {
        $field .= "`" . $key . "`" . ",";
        $value .= "'" . $v . "'" . ",";
    }
    $field = trim($field, ",");
    $value = trim($value, ",");

    // $sql = "insert into yumdam_retimedata($field) values($value)"

    // $sql2 = "insert into yumdam_retimedata($field) values($value)";
    // $e = $YumDamSql->selectsql($sql2,true);

    $e = $YumDamSql->insertdb("yumdam_retimedata", $field, $value);
    if ($e["affect"] != 0) {
        $zt = "<em style='color:#369B5D;font-weight:bold;'>Success</em>";
    } else {
        $zt = "<em style='color:red;font-weight:bold;'>Error</em>";
    }
    echo json_encode(array("id" => $data["id"], "zt" => $zt));
}//---insert---


function selected($post)
{
    global $YumDamSql;
    $data = $post;
    $strDate = preg_split("/[- :]/", $data['datetime']);
    $data['datetime'] = mktime($strDate[3], $strDate[4], $strDate[5], $strDate[1], $strDate[2], $strDate[0]);


    $typeid = $data["typeid"];
    $datetime = $data['datetime'];

    $sql = "select xiaofei,duihua,zhanxian,dianji from yumdam_retimedata where typeid = {$typeid} and datetime={$datetime} order by datetime";
    $ds = $YumDamSql->selectsql($sql);

    if ($ds['row'] > 0) {
        $xiaofei = "<input readOnly='true' type='text' value=" . $ds['select'][0]['xiaofei'] . ">";
        $duihua = "<input readOnly='true' type='text' value=" . $ds['select'][0]['duihua'] . ">";
        $zhanxian = "<input readOnly='true' type='text' value=" . $ds['select'][0]['zhanxian'] . ">";
        $dianji = "<input readOnly='true' type='text' value=" . $ds['select'][0]['dianji'] . ">";
        if ($ds['select'][0]['duihua'] != 0) {
            $chengben = round($ds['select'][0]['xiaofei'] / $ds['select'][0]['duihua'], 2);
        } else {
            $chengben = 0;
        }
        $zhuangtai = "<em style='color:#369B5D;font-weight:bold;'>已有数据</em>";
    } else {

        $xiaofei = "<input type='text' value='0'>";
        $duihua = "<input type='text' value='0'>";
        $chengben = 0;
        $zhanxian = "<input type='text' value='0'>";
        $dianji = "<input type='text' value='0'>";
        $zhuangtai = '<input class="submit" type="button" value="提交" >';
    }

    echo json_encode(array(
        "xiaofei" => $xiaofei,
        "duihua" => $duihua,
        "chengben" => $chengben,
        "zhanxian" => $zhanxian,
        "dianji" => $dianji,
        "zhuangtai" => $zhuangtai,
        "id" => $data['id']
    ));
}//--select---


if (!empty($_POST) && $_GET['action'] == "insert") {
    insert($_POST);
}

if (!empty($_POST) && $_GET['action'] == "select") {
    selected($_POST);
}

?>