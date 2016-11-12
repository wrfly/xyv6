<?php
$referer = $_SERVER["HTTP_REFERER"];
$refererhost = parse_url($referer);
$host = strtolower($refererhost['host']);
if ( $host != 'xyv6.com' ) die();
$url = $_GET['url'];
header('Content-type: image/jpeg');
$img = file_get_contents($url);
echo $img;
?>
