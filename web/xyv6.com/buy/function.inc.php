<?php
// function writeLog($text) {
// 	// $text=iconv("GBK", "UTF-8//IGNORE", $text);
// 	// $text = characet ( $text );
// 	file_put_contents ( dirname ( __FILE__ ) . "/log/log.txt", date ( "Y-m-d H:i:s" ) . "  " . $text . "\r\n", FILE_APPEND );
// }

/**
 * 使用SDK执行接口请求
 * @param unknown $request
 * @param string $token
 * @return Ambigous <boolean, mixed>
 */
function aopclient_request_execute($request, $token = NULL) {
	global $config;
	require 'config.php';
	$aop = new AopClient ();
	$aop->gatewayUrl = $config ['gatewayUrl'];
	$aop->appId = $config ['app_id'];
	$aop->rsaPrivateKeyFilePath = $config ['merchant_private_key_file'];
	$aop->apiVersion = "1.0";
	$result = $aop->execute ( $request, $token );
	//writeLog("response: ".var_export($result,true));
	return $result;
}