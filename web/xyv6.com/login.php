<?php
require_once 'lib/config.php';
$sessionName = "xyv6";
session_name($sessionName);
session_start();
$uid = isset($_SESSION['uid']) ? isset($_SESSION['uid']) : 0;
if( $uid != '' || $uid != 0 ){
    $uid = $_SESSION['uid'];
    $user_email = $_SESSION['user_email'];
    $user_pwd  = $_SESSION['user_pwd'];
    $U = new \Ss\User\UserInfo($uid);
    //验证cookie
    $pwd = $U->GetPasswd();
    $pw = \Ss\User\Comm::CoPW($pwd);
    if($pw != $user_pwd || $pw == null || $user_pwd == null  ){

    }else{
        header("Location:index");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $site_name;  ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <style type="text/css">
        body,html {
              background: url(asset/img/bg.jpg) no-repeat center center fixed;
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
            }
        .cc {
            margin-top: 50px;
            box-shadow: 5px 20px 60px black;
            padding:20px;
            }
    </style>
    <link rel="shortcut icon" href="xyv6.png">
    <link href="asset/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="asset/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="asset/css/blue.css" rel="stylesheet" type="text/css" />
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <img src="xyv6.png" width="50px" height="50px">
        <a href="<?php echo $site_url;  ?>"><b><?php echo $site_name;  ?></b></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body cc">
        <p class="login-box-msg">登录到用户中心</p>

            <form>
            <div class="form-group has-feedback">
                <input id="email" name="Email" type="text" class="form-control" placeholder="邮箱"/>
                <span  class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="passwd" name="Password" type="password" class="form-control" placeholder="密码"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div>
                <a href='javascript: refreshCaptcha();' tabindex="-1"><img src="phpcaptcha/captcha.php?rand=<?php echo rand();?>" id='captchaimg' title='点击刷新'></a>

                <input type="text" id="captcha_code" name="captcha_code" class="form-control" style="display:inline;width:61%" placeholder="验证码"/>
            </div>
            </form>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input id="remember_me" value="week" type="checkbox"> 记住我
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button id="login" type="submit" class="btn btn-primary btn-block btn-flat">登录 <i class="fa fa-sign-in"></i></button>
                </div><!-- /.col -->
            </div>
        <a href="reg" class="text-center">注册帐号</a>
        <a href="resetpwd" class="text-center" style="float:right;" >忘记密码</a>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- jQuery 2.1.3 -->
<script src="asset/js/jQuery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<!-- iCheck -->
<script src="asset/js/icheck.min.js" type="text/javascript"></script>
<script src="asset/plugins/layer/layer.js"></script>

<script>
    function refreshCaptcha(){
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
    }
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
<script>

    $(document).ready(function(){
        function login(){
            $.ajax({
                type:"POST",
                url:"_login.php",
                dataType:"json",
                data:{
                    email: $("#email").val(),
                    passwd: $("#passwd").val(),
                    captcha_code: $("#captcha_code").val(),
                    remember_me: $("#remember_me").val()
                },
                success:function(data){
                    if(data.ok){
                        layer.msg(data.msg, {icon: 6, time: 1000});
                        window.setTimeout("location.href='index'", 1000);
                    }else{
                        layer.msg(data.msg, {icon: 5, time: 1000});
                    }
                },
                error:function(jqXHR){
                    layer.msg("发生错误："+jqXHR.status, {icon: 5, time: 1000});
                }
            });
        }
        $("html").keydown(function(event){
            if(event.keyCode==13){
                login();
            }
        });
        $("#login").click(function(){
            login();
        });
    })
</script>
</body>
</html>
