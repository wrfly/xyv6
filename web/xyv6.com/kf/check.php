<?php
require_once '../lib/config.php';
//检测是否登录，若没登录则转向登录界面
$sessionName = "xyv6";
session_name($sessionName);
session_start();

$uid = isset($_SESSION['uid']) ? isset($_SESSION['uid']) : 0;

if( $uid != '' || $uid != 0 ){
        //co
        $uid = $_SESSION['uid'];
        $user_email = $_SESSION['user_email'];
        $user_pwd  = $_SESSION['user_pwd'];

        $U = new \Ss\User\UserInfo($uid);
        //验证cookie
        $pwd = $U->GetPasswd();
        $pw = \Ss\User\Comm::CoPW($pwd);
        if($pw != $user_pwd){
            header("Location:login.php");
        }
}else{
    header("Location:login");
    exit();
}

 /* 已验证登录的用户信息 */
$username = $user_email;

 /* 您的安全校验码(API通信密匙) */
$key = "<code>";

 /* 您的云客服平台地址 */
$url = "https://xyv6.kf5.com/user/remote";

 /* 建立通信串 */
$time = isset($_GET['time']) ? $_GET['time'] : time();
$msg = $username.$time.$key;
$token = MD5($msg);

$url .= "?username=".$username."&time=".$time."&token=".$token;

/* 指定用户名或者手机(可选) */
$name = $U->GetUserName();
$url .= "&name=".$name;
//$phone = "138********";
//$url .= "&phone=".$phone;

// $photo = "https://xyv6.com/user/xyv6.png";
$photo = urlencode(Ss\User\Comm::Gravatar($U->GetEmail()));
$url .= "&photo=".$photo;

/* 指定回跳地址(可选) */
//$return_to = isset($_GET['return_to']) ? $_GET['return_to'] : '';
//$url .= '&return_to='.$return_to;


/* 跳转回帮助台验证登录 */
header("Location: ".$url);
