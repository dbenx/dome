<?php
/*
商务通数据处理函数
*/

//项目处理
function GetItem($itemK)
{
    include 'Config.Swt.php';
    return $item[$itemK];
}


//性别
function GetSex($sexK)
{
    include 'Config.Swt.php';
    return $sex[$sexK];
}

//联系方式

function GetContact($contactK)
{
    include 'Config.Swt.php';
    return $contact[$contactK];
}

//来源
function Getly($lyk)
{
    include 'Config.Swt.php';
    return $ly[$lyk];
}


//是否重复咨询
function GetCf($cfk)
{
    include 'Config.Swt.php';
    return $cf[$cfk];
}


//是否重复咨询
function GetZxs($zxsk)
{
    include 'Config.Swt.php';
    return $zxs[$zxsk];
}


?>