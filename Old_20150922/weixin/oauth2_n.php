<?php

$wxcode = "";

if (isset($_GET['code'])) {
    $wxcode = $_GET['code'];
} else {
    echo "NO CODE";
    exit;
}

$tourl = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx174ca15eb9a7331e&secret=01e78302706aa07e986a3121f2e2717c&code=" . $wxcode . "&grant_type=authorization_code";
header("Location:" . $tourl);
?>