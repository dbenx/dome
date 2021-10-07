<?php
include("../Config/Config.Inc.php");
if ($_GET['at'] == "i") {
    @include "insert.php";
}

if ($_GET["at"] == "d") {
    @include "show.php";
}

?>