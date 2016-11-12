<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once 'config.php';
require_once 'SendGrid.php';

function send_email($uid, $plan_name, $vip_end_time)
{
    $api_key = 'hello';
    $sender = 'no-reply@xyv6.com';

    $sendgrid = new SendGrid($api_key);
    $email    = new SendGrid\Email();
if( $plan_name != "Openvpn" && $plan_name != "buymore"){
    $ur = new \Ss\User\UserInfo($uid);
    $addr = $ur->GetEmail();
    $email->addTo($addr)
        ->setFrom($sender)
        ->setFromName('校园V6')
        ->setSubject('校园V6 | 套餐变更提醒')
        ->setHtml('
        您在 '.date("Y-m-d H:i:s",time()).' 变更套餐为 “'.
        $plan_name.'”。<br/>
        <br/>开通时间：'.date("Y年m月d日",time()).'，<br/>
        到期时间：'.date("Y年m月d日",$vip_end_time).'。
        <br/><br/>感谢您的使用。
        ')
        ->setTemplateId('41d21bb1-f061-4311-84c9-eef7a58221bf')
    ;
}elseif ($plan_name == "buymore") {
    $ur = new \Ss\User\UserInfo($uid);
    $addr = $ur->GetEmail();
    $email->addTo($addr)
        ->setFrom($sender)
        ->setFromName('校园V6')
        ->setSubject('校园V6 | 套餐变更提醒')
        ->setHtml('
        您在 '.date("Y-m-d H:i:s",time()).' 购买了15G流量。<br/>
        流量仅在本套餐周期有效，下个周期将会失效。
        <br/>感谢您的使用。
        ')
        ->setTemplateId('41d21bb1-f061-4311-84c9-eef7a58221bf')
    ;
}else{
    $ur = new \Ss\User\UserInfo($uid);
    $addr = $ur->GetEmail();
    $email->addTo($addr,"o-vpn@xyv6.com")
        ->setFrom($sender)
        ->setFromName('校园V6')
        ->setSubject('校园V6 | 套餐变更提醒')
        ->setHtml('
        您在 '.date("Y-m-d H:i:s",time()).' 开通“'.
        $plan_name.'套餐”。<br/>
        开通时间：'.date("Y年m月d日",time()).'，<br/>
        到期时间：'.date("Y年m月d日",$vip_end_time).'。<br/>
        您用来接收配置文件的邮箱是：'.$addr.'<br/>
        12小时内将会有“用户配置文件”发送到您的邮箱，请您耐心等待。如果有任何问题，请发送邮件到 o-vpn@xyv6.com 咨询。
        <br/>感谢您的使用。
        ')
        ->setTemplateId('41d21bb1-f061-4311-84c9-eef7a58221bf')
    ;
  }
    $sendgrid->send($email);
}
