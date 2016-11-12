<?php
//设置编码
header("content-type:text/html;charset=utf-8");
require_once 'lib/config.php';
require 'lib/SendGrid.php';
require 'vendor/autoload.php';

$sendgrid = new SendGrid($api_key);
$email    = new SendGrid\Email();

//
$code     = $_POST['code'];
$addr    = $_POST['email'];
$uid      = $_POST['uid'];
$password = $_POST['password'];
$repasswd = $_POST['repasswd'];
//
$ur = new \Ss\User\UserInfo($uid);

    $rs = '1';

    if(!$rs){
        $a['code'] = '0';
        $a['msg']  =  "邮箱错误";
    }elseif($repasswd != $password){
        $a['code'] = '0';
        $a['msg'] = "两次密码输入不符";
    }elseif(strlen($password)<8){
        $a['code'] = '0';
        $a['msg'] = "密码太短";
    }else{
        $rst = new \Ss\User\ResetPwd($uid);
        $u   = new \Ss\User\User($uid);
        if($rst->IsCharOK($code,$uid)){
            $NewPwd = $password;
            $u->UpdatePWd($NewPwd);
            $rst->Del($code,$uid);
            $a['code'] = '1';
            $a['ok'] = '1';
            $a['msg']  =  "您的新密码重置成功！";
        }else{
            $a['code'] = '0';
            $a['msg']  =  "链接无效";
        }
    }
echo json_encode($a);
