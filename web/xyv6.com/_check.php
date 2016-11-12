<?php
$sessionName = "xyv6";
session_name($sessionName);
session_start();
//检测是否登录，若没登录则转向登录界面
$uid = isset($_SESSION['uid']) ? isset($_SESSION['uid']) : 0;
// $uid = isset($_COOKIE['uid']) ? isset($_COOKIE['uid']) : 0;

if( $uid != '' || $uid != 0 ){
        //co
        $uid = $_SESSION['uid'];
        $user_email = $_SESSION['user_email'];
        $user_pwd  = $_SESSION['user_pwd'];

        $U = new \Ss\User\UserInfo($uid);
        //验证cookie
        $pwd = $U->GetPasswd();
        $pw = \Ss\User\Comm::CoPW($pwd);
        if($pw != $user_pwd || $pw == null || $user_pwd == null  ){
            session_destroy();
            header("Location:login");
        }else{
            // header("Location:index");
        }
}else{
    session_destroy();
    header("Location:login");
    die();
}
$oo = new Ss\User\Ss($uid);
