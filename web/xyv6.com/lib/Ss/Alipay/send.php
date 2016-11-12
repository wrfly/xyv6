<?php
//        发送邮件通知
// require_once '../../SendGrid.php';
// spl_autoload_register(SendGrid.\);

// spl_autoload_register(__NAMESPACE__ .'/../../SendGrid::send');
require '../../../vendor/autoload.php';
require '../../../lib/config.php';
$api_key = 'SG.MN-LBKotSiKRBu_Vj8NGHg.oNWhy-hello';
        $sendgrid = new SendGrid($api_key);
        $email    = new SendGrid\Email();

        $ur = new \Ss\User\UserInfo(1);
        $addr = $ur->GetEmail();
        $email->addTo('mr@kfd.me')
          ->setFrom('a@xyv6.com','校园V6')
          ->setSubject('校园V6 | 套餐变更提醒')
          ->setHtml('亲爱的')
            ;
        $sendgrid->send($email);
        echo "ok";
