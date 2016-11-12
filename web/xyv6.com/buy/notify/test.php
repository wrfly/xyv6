<?php
require_once("lib/alipay.config.php");
require_once("lib/alipay_notify.class.php");
$notify = new \Ss\Alipay\notify();

$notify->test_update_plan();