<?php
require_once 'lib/config.php';
require_once '_check.php';

$type = isset($_GET['type']) ? $_GET['type'] : 'add' ;
$M = new Ss\Download\mission();

if ($type == 'add') {

	$file_name = $_POST['file_name'];

	if ($file_name == '') $file_name = \Ss\Etc\Comm::get_random_char(4);

	$id = $M->Get_last_id() + 1;
	$file_name = $id.'-'.$uid.'-'.$file_name;

	$file_url = $_POST['file_url'];

	$user_plan = $oo->get_plan();

	if ($file_url == '') {
		$a['msg'] = "URL不能为空";
	}
	elseif ($M->check_user($uid) and $user_plan == 'C') {
		$a['msg'] = "免费用户每天只能有一个离线下载资格。";
	}
	elseif ( $M->check_url($file_url) ) {
		$a['msg'] = "不支持您所输入的URL。";
	}
	else{
		$M->Add($uid,$file_name,$file_url);
		$a['ok'] = '1';
		$a['msg'] = "添加成功，任务已进入队列。";
	}

	echo json_encode($a);
}
elseif ($type == 'delete') {

	$id = $_GET['id'];
	if( $M->Del($id,$uid) ){
	echo ' <script>alert("删除成功!")</script> ';
	echo " <script>location.replace(document.referrer);</script> " ;
	}
}