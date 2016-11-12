<?php
require_once 'lib/config.php';
require 'vendor/autoload.php';
require 'lib/SendGrid.php';

$email = $_POST['email'];
$email = strtolower($email);
$passwd = \Ss\Etc\Comm::get_random_char(4);
$name = $_POST['name'];
$repasswd = $passwd;
$ref =  isset($_COOKIE['ref'])? $_COOKIE['ref']: 0 ;

//phpcaptcha
$sessionName = "xyv6";
session_name($sessionName);
session_start();
// code for check server side validation
if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){
    $a['msg'] = "验证码不正确";
    echo json_encode($a);
    die();
}

if( $ref != 0 ){
    $ref = new \Ss\User\Reflink($ref);
    $ref_ok = $ref->IsRefok();
    if ( $ref_ok == 1) {
        $ref_by = $ref->GetCodeUid();
    }else
        $ref_by = 0;
}
// }else
//     die();

$c = new \Ss\User\UserCheck();

if(!$c->IsEmailLegal($email)){
    $a['msg'] = "换一个大厂的邮箱呗";
}elseif($c->IsEmailUsed($email)){
    $a['msg'] = "邮箱已被使用";
}elseif(strlen($name)<3 ){
    $a['msg'] = "不行哦，用户名太短呢";
}elseif (strlen($name)>30 ){
   $a['msg'] = "用户名太长啦";
}elseif($c->IsUsernameUsed($name)){
    $a['msg'] = "用户名已经被占用，换一个吧";
}elseif($c->IsNameLegal($name)){
    $a['msg'] = "用户名已经被占用，换一个吧";    
}else{
    // get value

    $passwd = \Ss\User\Comm::SsPW($passwd);
    $plan = "C";
    $transfer = $a_transfer;
    $invite_num = rand($user_invite_min,$user_invite_max);

    //do reg
    $reg = new \Ss\User\Reg();
    $ref_by = isset($ref_by) ? $ref_by : 0;
    $reg->Reg($name,$email,$passwd,$plan,$transfer,$invite_num,$ref_by);
    $a['ok'] = '1';
    $a['msg'] = "请登陆您的邮箱查看注册信息,<br/>如果没有收到邮件,请使用找回密码功能以重置您的密码。";

    //send welcome
    $addr=$email;
    $sendgrid = new SendGrid($api_key);
    $email    = new SendGrid\Email();
    $email->addTo($addr)
          ->setFrom($sender,"校园V6")
          ->setFromName('校园V6')
          ->setSubject('校园V6用户注册 | Welcome')
          ->setHtml('
                感谢您注册“校园V6”！ <br/>
                您在校园V6的用户注册信息为：<br/>
                ---------------------------------------------------<br/>
                邮箱：'.$addr.'<br/>
                密码：'.$repasswd.' （登陆后请及时修改您的密码）<br/>
                用户套餐：免费套餐 <br/>
                注册时间：'.date("Y-m-d H:i:s").'<br/>
                ---------------------------------------------------<br/>
                <br/>请登陆<a href="https://xiaoyuanv6.com/user/">用户中心</a>查看您的端口信息以及V6节点信息。<br/>
                安装以及配置教程：<a href="https://xiaoyuanv6.com/tutorials/">教程</a><br/>
                协议以及注意事项：<a href="https://xiaoyuanv6.com/tos/">用户协议</a><br/>
                再次感谢您注册“校园V6”，祝您使用愉快！
            ')
          ->setTemplateId('41d21bb1-f061-4311-84c9-eef7a58221bf')
    ;
    $sendgrid->send($email);
}

echo json_encode($a);
