<?php

require_once __DIR__.'/../../../lib/config.php';

//合作身份者id，以2088开头的16位纯数字
$alipay_config['partner']		= '20884888888888';

//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
$alipay_config['cacert']    = getcwd().'/lib/cacert.pem';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport']    = 'https';
?>
