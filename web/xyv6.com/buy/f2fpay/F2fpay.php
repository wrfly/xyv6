<?php
require_once 'AopSdk.php';
require_once 'function.inc.php';
require 'config.php';

class F2fpay {
	
	public function qrpay($out_trade_no,  $total_amount, $subject, $uid, $plan, $month) {
		date_default_timezone_set('Asia/Shanghai');
	
		$time_expire = date('Y-m-d H:i:s', time()+60*15);

		$biz_content="{\"out_trade_no\":\"" . $out_trade_no . "\",";
		$biz_content.="\"total_amount\":\"" . $total_amount
		. "\",\"discountable_amount\":\"0.00\",";
		$biz_content.="\"subject\":\"" . $subject . "\",\"body\":\"" . $uid.'-'.$plan.'-'.$month . "\",";
		$biz_content.="\"goods_detail\":[{\"plan\":\"".$plan."\",\"goods_name\":\"校园V6\",\"month\":\"".$month."\",\"uid\":\"".$uid."\"}],";
		$biz_content.="\"time_expire\":\"" . $time_expire . "\"}";
	
		$request = new AlipayTradePrecreateRequest();
		$request->setBizContent ( $biz_content );
		// return $request;
		$time_create = date('Y-m-d H:i:s', time());
		$add = new \Ss\Alipay\precreate();
		$add->Add_precreate($out_trade_no, $total_amount, $subject, $plan, $month, $uid, $time_create);
		$response = aopclient_request_execute ( $request );

		return $response;
	}
}