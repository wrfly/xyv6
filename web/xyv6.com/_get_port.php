<?php
require_once 'lib/config.php';
require_once '_check.php';
//权限检查
if($oo->is_able_to_get_port()){

	//注意顺序！否则会出问题！valid变为1变为1
	$oo->add_transfer_to_ref();
	$port = $oo->get_new_port();
	$oo->enable();

	$a['msg'] = "您的新端口为".$port.",祝您使用愉快。";
	$a['p'] = $port;
	echo json_encode($a);
}else
	die();

