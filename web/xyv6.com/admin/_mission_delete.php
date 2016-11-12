<?php
require_once '../lib/config.php';
require_once '_check.php';
require '../vendor/autoload.php';
require '../lib/SendGrid.php';

$id = $_GET['id'];

$M = new Ss\Download\mission();

$M->Del($id);

	echo " <script>alert(\"删除成功!\")</script> ";
	echo " <script>window.location = history.go(-1)</script> " ;