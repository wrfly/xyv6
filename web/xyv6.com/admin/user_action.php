<?php
//引入配置文件
require_once '../lib/config.php';
require_once '_check.php';
$uid = $_GET['uid'];
	
if($uid == 0) echo " <script>location.href = document.referrer;</script> " ;

$u = new \Ss\User\UserInfo($uid);

$action = isset($_GET['action']) ? $_GET['action'] : 'active' ; 

if ( $action == 'active' ) {
	$u->ActiveMe();
	echo "<script>alert(\"激活成功!\")</script>";
	echo " <script>location.href = document.referrer;</script> " ;
}
elseif ( $action == 'ban' ) {
	$u->BanMe();
	echo " <script>alert(\"禁用成功!\")</script> ";
	echo " <script>location.href = document.referrer;</script> " ;
}
elseif ( $action == 'clear' ) {
	$u->ClearMe();
	echo " <script>alert(\"流量清空成功!\")</script> ";
	echo " <script>location.href = document.referrer;</script> " ;
}elseif ( $action == 'gift'){
	$Gifts = new Ss\Bills\gifts();
	$user_alipay = $u->GetAliapyAccount();
	$amount = 50;
	$Gifts->add($uid, $user_alipay, $amount);
	echo " <script>alert(\"ADD 50 RMB!\")</script> ";
	echo " <script>location.href = document.referrer;</script> " ;
}