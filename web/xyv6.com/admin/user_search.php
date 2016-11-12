<?php
require_once '_main.php';

if(!empty($_GET)){
    //获取id
    $email = $_GET['email'];
    $asdfasd = new \Ss\User\User();
    $uid = $asdfasd->get_user_uid($email);
    if ($uid == '') {
        $uid = '1';
    }
    $u = new \Ss\User\UserInfo($uid);
    $rs = $u->UserArray();
}
else{
    $u = new \Ss\User\UserInfo("1");
    $rs = $u->UserArray();
}

include 'user_info.php';

