<?php
//引入配置文件
require_once '../lib/config.php';
require_once '_check.php';
$uid = $_GET['uid'];
$u = new \Ss\User\UserInfo($uid);
//$u->UpdatePwd(\Ss\Etc\Comm::get_random_char(8));
$port = $u->Getport();
$u->DelMe($port);

echo ' <script>alert("删除成功!")</script> ';
echo '<script>window.location="user.php"</script>' ;
