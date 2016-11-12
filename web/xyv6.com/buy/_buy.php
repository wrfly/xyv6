<?php
header("Content-type: text/html; charset=utf-8");
require_once 'f2fpay/F2fpay.php';

$referer = $_SERVER["HTTP_REFERER"];
$refererhost = parse_url($referer);
$host = strtolower($refererhost['host']);
if ( $host != 'xiaoyuanv6.com' ) {
	echo "www.baidu.com";
	die();
}


if (!empty($_POST['uid']) && !empty($_POST['plan']) ){
	$f2fpay = new F2fpay();
	//检测plan & month //A-160G B-30G D-1G E-VPN F-10G G-400G
	if ( $_POST['plan'] == 'A' || $_POST['plan'] == 'B' || $_POST['plan'] == 'D'|| $_POST['plan'] == 'E'|| $_POST['plan'] == 'F' || $_POST['plan'] == 'G') {
		$plan = $_POST['plan'];
	}else
		die();
	$month = isset($_POST['month']) ? intval($_POST['month']) : 1;
	$uid = isset($_POST['uid']) ? intval($_POST['uid']) : 1;
	if ( $month >= 6 || $month <= 0 || $uid <= 0 ) {
		die();
	}

	$out_trade_no = $uid.$plan.time();

	if ( $plan == 'A') {
		$subject = "校园V6 160G套餐 6个月";
		$month = 6;
		$total_amount = 50;
	}elseif ( $plan == 'B' ) {
		$total_amount = 10*$month;
		$subject = "校园V6 30G套餐 x " .$month. "个月" ;
	}elseif ( $plan == 'D' ) {
		$subject = "校园V6 体验套餐";
		$month = 1;
		$total_amount = 1;
	}elseif ( $plan == 'E' ) {
		$subject = "校园V6 Openvpn套餐";
		$total_amount = 20*$month;
	}elseif ( $plan == 'F') {
		$subject = "校园V6 15G流量";
		$total_amount = 5;
	}elseif ( $plan == 'G') {
		$subject = "校园V6 包年400G套餐";
		$total_amount = 99;
	}

	$response = $f2fpay->qrpay($out_trade_no,  $total_amount, $subject, $uid, $plan, $month);
	// echo var_dump($response);die();

	// print_r( $response );
	$qr_code = $response->{'alipay_trade_precreate_response'}->{'qr_code'};

	$return['uid'] = $uid;
	$return['subject'] = $subject;
	$return['total_amount'] = $total_amount;
	$return['qr_code_url'] = "https://mobilecodec.alipay.com/show.htm?code=".substr($qr_code,22);
	echo json_encode($return);
}else
	die();
?>
