<?php
require_once 'lib/config.php';
$ref = isset($_GET['ref']) ? $_GET['ref'] : null;
if ($ref != null) {
    setcookie("ref",$ref,time()+3600); //cookie保存60s
    header("Location:reg");
}
$sessionName = "xyv6";
session_name($sessionName);
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $site_name;  ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="xyv6.png">
    <link href="asset/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="asset/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="asset/css/reg.css" rel="stylesheet" type="text/css" />

</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <img src="xyv6.png" width="50px" height="50px">
        <a href="<?php echo $site_url;  ?>"><b><?php echo $site_name;  ?></b></a>
    </div>
    <div class="login-box-body cc">
        <p class="login-box-msg">注册，然后自由。</p>

            <div class="form-group has-feedback">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <input type="text" id="name" class="form-control" placeholder="选个帅气的名字"/>
            </div>
            <div class="form-group has-feedback">
                <input type="text" name="email" id="email" class="form-control" placeholder="再加上您的邮箱"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <ul class="list"></ul>
            </div>
            <div>
                <a tabindex="-1" href='javascript: refreshCaptcha();'><img src="phpcaptcha/captcha.php?rand=<?php echo rand();?>" id='captchaimg' title='点击刷新'></a>
                <input type="text" id="captcha_code" name="captcha_code" class="form-control" style="display:inline;width:61%" placeholder="输入左边的验证码"/>
            </div>

            <div>
                <p></p>
                <p align="center">注册即代表同意<a target="_blank" href="tos">服务条款</a></p>
                <button type="submit" id="reg" class="btn btn-primary btn-block btn-flat">然后就可以注册啦</button>
            </div>
    </div><!-- /.form-box -->
</div><!-- /.register-box -->

<script src="asset/js/jQuery.min.js"></script>
<script src="asset/plugins/layer/layer.js"></script>
<script src="asset/js/bootstrap.min.js" type="text/javascript"></script>
<script src="asset/js/icheck.min.js" type="text/javascript"></script>
<script src="asset/js/reg.js" type="text/javascript"></script>

</body>
</html>
