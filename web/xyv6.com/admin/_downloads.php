<?php
require_once '../lib/config.php';
require_once '_check.php';

$type = isset($_GET['type']) ? $_GET['type'] : 'add' ;
$M = new Ss\Download\mission();

if ($type == 'add') {

	$file_name = $_POST['file_name'];

	if ($file_name == '') $file_name = \Ss\Etc\Comm::get_random_char(4);

	$id = $M->Get_last_id() + 1;
	$file_name = $id.'-'.$uid.'-'.$file_name;

	$file_url = $_POST['file_url'];

	if ($file_url == '' ){

		$a['msg'] = "URL不能为空";

		echo json_encode($a);
		die();
	}elseif ( $M->check_url($file_url)) {
		
		$a['msg'] = "URL必须以http://或者ftp://开头，不支持迅雷连接。";

		echo json_encode($a);
		die();
	}

	$M->Add($uid,$file_name,$file_url);

	$a['ok'] = '1';
	$a['msg'] = "添加成功";

	echo json_encode($a);
}
elseif ($type == 'delete') {
	$id = $_GET['id'];
	$uid = $_GET['uid'];
	$M->Del($id,$uid);
	echo ' <script>alert("删除成功!")</script> ';
	echo " <script>location.replace(document.referrer);</script> " ;
}