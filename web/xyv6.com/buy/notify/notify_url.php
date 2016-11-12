<?php
require_once("lib/alipay.config.php");
require_once("lib/alipay_notify.class.php");

if (get_magic_quotes_gpc ()) {
        foreach ( $_POST as $key => $value ) {
            $_POST [$key] = stripslashes ( $value );
            }
        foreach ( $_GET as $key => $value ) {
            $_GET [$key] = stripslashes ( $value );
            }
        foreach ( $_REQUEST as $key => $value ) {
            $_REQUEST [$key] = stripslashes ( $value );
            }
}

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//验证成功
	//传递各种参数
	$subject = $_POST['subject'];
	$trade_no = $_POST['trade_no'];
	$gmt_create = $_POST['gmt_create'];
	$gmt_payment = $_POST['gmt_payment'];
	$notify_time = $_POST['notify_time'];
	$notify_type = $_POST['notify_type'];
	$total_amount = $_POST['total_amount'];
	$out_trade_no = $_POST['out_trade_no'];
	$invoice_amount = $_POST['invoice_amount'];
	$receipt_amount = $_POST['receipt_amount'];
	$buyer_pay_amount = $_POST['buyer_pay_amount'];
	$body = $_POST['body'];
	$trade_status = $_POST['trade_status'];
	$seller_email = $_POST['seller_email'];
	$buyer_logon_id = $_POST['buyer_logon_id'];

	if ($trade_status == 'TRADE_SUCCESS') {
        require_once('/var/www/xyv6/user/lib/Ss/Alipay/notify.php');
        require_once('/var/www/xyv6/user/lib/Ss/Alipay/precreate.php');
		$notify = new \Ss\Alipay\notify();

		if ( $notify->check_if_exist($out_trade_no) == 1 ) die();

		$notify->Add($subject, $trade_no, $gmt_create,
			$gmt_payment, $notify_time, $notify_type, $total_amount,
			$out_trade_no, $invoice_amount, $receipt_amount, $buyer_pay_amount,
			$body, $trade_status, $seller_email, $buyer_logon_id);

		$notify->update_plan($out_trade_no);
    	$notify->update_precreate($out_trade_no);

		$fanli = new \Ss\Alipay\fanli();
		$fanli->Add( $out_trade_no );

		echo "success";		//请不要修改或删除
	}
}
else {
    //验证失败
    echo "fail";
}

?>
