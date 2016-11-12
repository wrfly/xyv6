<?php
//检测是否登录，若没登录则转向登录界面
$uid = isset($_COOKIE['uid']) ? isset($_COOKIE['uid']) : 0;

if( $uid != '' || $uid != 0 ){
        //co
        $uid = $_COOKIE['uid'];
        $user_email = $_COOKIE['user_email'];
        $user_pwd  = $_COOKIE['user_pwd'];

        $U = new \Ss\User\UserInfo($uid);
        //验证cookie
        $pwd = $U->GetPasswd();
        $pw = \Ss\User\Comm::CoPW($pwd);
        if($pw != $user_pwd){
            header("Location:login.php");
        }
        if(!$U->isAdmin()){
            header("Location:../user/index.php");
        }
}else{
    header("Location:login.php");
    exit();
}
$oo = new Ss\User\Ss($uid);
