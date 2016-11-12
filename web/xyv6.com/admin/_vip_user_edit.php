<?php
require_once '../lib/config.php';
require_once '_check.php';
require '../vendor/autoload.php';
require '../lib/SendGrid.php';


if(!empty($_POST)){
    $uid = $_POST['uid'];    
    $plan = $_POST['plan'];
    $month = $_POST['month'];

    $vip_start_time = time();
    
    if ($plan == "A") {
		$transfer_enable = 171798691840;
		$money = 50;
		$plan_name = "160G/半年";
        $month = 6;
        $vip_end_time = $vip_start_time+3600*24*31*$month;
    }
    elseif ($plan == "B") {
    	$transfer_enable = 32212254720;
		$plan_name = "30G/包月";
		$money = 10*$month;
        $vip_end_time = $vip_start_time+3600*24*31*$month;
    }
    elseif ($plan == "D") {
    	$transfer_enable = 1073741824;
		$money = 1;
		$plan_name = "体验套餐/24小时";
        $vip_end_time = $vip_start_time+3600*24;
    }
    elseif ($plan == "G") {
        $transfer_enable = 400*1024*1024*1024;
        $money = 120;
        $month = 12;
        $plan_name = "400G/包年";
        $vip_end_time = $vip_start_time+3600*24*31*$month;
    }else{
        $transfer_enable = 3221225472;
        $money = 0;
        $plan_name = "免费";
        $vip_end_time = $vip_start_time+3600*24;
    }

    //更新
    $User = new Ss\User\User($uid);
    $query = $User->updateVIPUser($plan,$money,$transfer_enable,
            $vip_start_time,$vip_end_time);
    $query_2 = $User->clear();

    if($query and $query_2){
                $ue['code'] = '1';
                $ue['ok'] = '1';
                $ue['msg'] = "修改成功！即将跳转到用户管理列表！";
    }

    //发送邮件通知
    $sendgrid = new SendGrid($api_key);
    $email    = new SendGrid\Email();

    $ur = new \Ss\User\UserInfo($uid);
    $addr = $ur->GetEmail();
    $email->addTo($addr)
      ->setFrom($sender,'校园V6')
      ->setSubject('校园V6 | 套餐变更提醒')
      ->setHtml('您在 '.date("Y-m-d H:i:s",$vip_start_time).
                ' 变更套餐为 “'.$plan_name.'”。<br/>
                <br/>开通时间：'.date("Y年m月d日",$vip_start_time).'<br/>
                到期时间：'.date("Y年m月d日",$vip_end_time).'。
                <br/><br/>感谢您的使用。
                ')
      ->setTemplateId('41d21bb1-f061-4311-84c9-eef7a58221bf')
        ;
    $sendgrid->send($email);
}
else{
            $ue['code'] = '0';
            $ue['msg'] = "出错了，请重试";
}

echo json_encode($ue);


