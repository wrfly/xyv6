<?php
require_once 'lib/config.php';

$rem = $_POST['remember_me'];

if($rem= "week"){
    $ext = 3600*24*7;
}else{
    $ext = 3600;
}

//phpcaptcha
session_set_cookie_params($ext, '/', '', false);
$sessionName = "xyv6";
session_name($sessionName);
session_start();
// code for check server side validation
if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
    $a['msg'] = "验证码不正确";
    echo json_encode($a);
    die();
}



$email = $_POST['email'];
$email = strtolower($email);
$passwd = $_POST['passwd'];
$passwd = \Ss\User\Comm::SsPW($passwd);
// $rem = $_POST['remember_me'];
$c = new \Ss\User\UserCheck();
$q = new \Ss\User\Query();
if($c->EmailLogin($email,$passwd)){
    $rs['code'] = '1';
    $rs['ok'] = '1';
    $rs['msg'] = "欢迎回来";
    //login success
    if($rem= "week"){
        $ext = 3600*24*7;
    }else{
        $ext = 3600;
    }
    //获取用户id
    $id = $q->GetUidByEmail($email);
    //处理密码
    $pw = \Ss\User\Comm::CoPW($passwd);
    // setcookie("user_pwd",$pw,time()+$ext);
    // setcookie("uid",$id,time()+$ext);
    // setcookie("user_email",$email,time()+$ext);

    $_SESSION["user_pwd"] = $pw;
    $_SESSION["uid"] = $id;
    $_SESSION["user_email"] = $email;
    unset($_SESSION['captcha_code']);

}else{
    $rs['code'] = '0';
    $rs['msg'] = "邮箱或者密码错误";
}
echo json_encode($rs);