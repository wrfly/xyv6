<?php
require 'vendor/autoload.php';
require 'lib/SendGrid.php';
require_once 'lib/config.php';

//phpcaptcha
session_name("xyv6");
session_start();
// code for check server side validation
if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){
    $a['msg'] = "验证码不正确";
    echo json_encode($a);
    die();
}

$addr = isset($_POST['email']) ? $_POST['email'] : 'null';

$uid = isset($_POST['uid']) ? $_POST['uid'] : 0;

// Type: reset_pwd; feedback; notice
$type = isset($_GET['type']) ? $_GET['type'] : 'reset_pwd';

$sendgrid = new SendGrid($api_key);
$email    = new SendGrid\Email();


if ($type == 'reset_pwd'){
    $c = new \Ss\User\UserCheck();
    $q = new \Ss\User\Query();
    $a = [];
    if($c->IsEmailUsed($addr)){
        $uid = $q->GetUidByEmail($addr);
        $rst = new \Ss\User\ResetPwd($uid);
        $ur = new \Ss\User\UserInfo($uid);
        if($rst->IsAbleToReset()){
            $code = $rst->NewLog();
            //send
            # Now, compose and send your message.
            $email->addTo($addr)
                  ->setFrom($sender)
                  ->setFromName('校园V6')
                  ->setSubject($site_name.' 密码重置|Reset Password')
                  ->setHtml('
                        您在 '.date("Y-m-d H:i:s").'申请重置密码。<br />
                        请访问此链接以重置密码:<a href='.$site_url.
                      '/user/resetpwd_do.php?code='.$code.'&uid='.$uid.'>重置密码</a>'.'<br/>
                      <br/>如果链接无法点击，请将下面的url复制到浏览器的地址栏中打开：'
                      .$site_url.'/user/resetpwd_do.php?code='.$code.'&uid='.$uid)
                  ->setTemplateId('41d21bb1-f061-4311-84c9-eef7a58221bf')
            ;
            $sendgrid->send($email);

            $a['code'] = '1';
            $a['ok'] = '1';
            $a['msg']  =  "邮件已发送，请注意查收";
        }else{
            $a['code'] = '1';
            $a['msg']  =  "24小时内申请超过上限";
        }
    }else{
        $a['ok'] = '1';
        $a['code'] = '0';
        $a['msg']  =  "邮件已发送，请注意查收";
    }
    echo json_encode($a);
}
elseif ( $type == 'feedback' ) {
    //feed_back
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    if ($uid == 0) {
        $a['msg']  =  "uid = 0";
    }
    elseif ($subject != '' and $content != '') {
        $ur = new \Ss\User\UserInfo($uid);
        $addr = $ur->GetEmail();
        $admin_email = 'admin@xyv6.com';
        $email->addTo($admin_email)
          ->setFrom($addr)
          ->setSubject('问题反馈 | '.$ur->GetUserName())
          ->setHtml('<br/>标题：'.$subject.'<br/><br/>内容：<br/>'
            .$content.'<br/><br/>日期：'.date("Y-m-d H:i:s").'<br/>
            ')
            ;
        $sendgrid->send($email);

        $a['code'] = '1';
        $a['ok'] = '1';
        $a['msg']  =  "反馈成功！";
    }
    else
    {
        $a['code'] = '1';
        $a['msg']  =  "标题或内容不能为空！";
    }

    echo json_encode($a);
}
elseif ( $type == 'notice') {
    # code...
}
