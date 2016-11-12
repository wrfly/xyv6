<?php
$config = array (
		'alipay_public_key_file' => dirname ( __FILE__ ) . "/YeK/alipay_rsa_public_key.pem",
		'merchant_private_key_file' => dirname ( __FILE__ ) . "/YeK/rsa_private_key.pem",
		'merchant_public_key_file' => dirname ( __FILE__ ) . "/YeK/rsa_public_key.pem",		
		'charset' => "UTF-8",
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
		'app_id' => "208888888888" 
);
require_once __DIR__.'/../lib/config.php';
require_once __DIR__.'/../_check.php';