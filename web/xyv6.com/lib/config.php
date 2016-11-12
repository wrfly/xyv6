<?php
/*
 * ss-panel配置文件
 * https://github.com/orvice/ss-panel
 * Author @orvice
 * https://orvice.org
 */

//定义流量
$tokb = 1024;
$tomb = 1024*1024;
$togb = $tomb*1024;
//Define DB Connection  数据库信息
define('DB_HOST','172.17.0.1');
define('DB_USER','ss');
define('DB_PWD','hello');
define('DB_DBNAME','ss');
define('DB_CHARSET','utf8');
define('DB_TYPE','mysql');

//注册用户的初始化流量
//默认5GiB
$a_transfer = $togb*3;

//签到设置 签到活的的最低最高流量,单位MB
$check_min = 50;
$check_max = 166;

//name
$site_name = "校园V6";
$site_url  = "https://xiaoyuanv6.com";

$pwd_mode = 1;

//用户注册后获得的邀请码最低最高
//都设置为0用户就不能邀请
$user_invite_min = '0';
$user_invite_max = '0';

//
//邮件服务
//Sendgrid
$api_key = 'SG.MN-hello.oNWhy-hello';
$sender = 'no-reply@xyv6.com';

require_once 'do.php';
