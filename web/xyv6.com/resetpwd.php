<?php
require_once 'lib/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $site_name;  ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="asset/css/f-a.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="asset/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="asset/css/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <img src="xyv6.png" width="50px" height="50px">
        <a href="<?php echo $site_url;  ?>"><b><?php echo $site_name;  ?></b></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body cc">
        <p class="login-box-msg">请输入您的注册邮箱以重置密码</p>

            <div class="form-group has-feedback">
                <input id="email" name="Email" type="text" class="form-control" placeholder="Email"/>
                <span  class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div>
                <a href='javascript: refreshCaptcha();'><img src="phpcaptcha/captcha.php?rand=<?php echo rand();?>" id='captchaimg' title='点击刷新'></a>

                <input type="text" id="captcha_code" name="captcha_code" class="form-control" style="display:inline;width:61%" placeholder="验证码"required autofocus>
            </div>
            <p></p>
            <div class="form-group has-feedback">
                <button type="submit" id="reset" class="btn btn-primary btn-block btn-flat">发送重置邮件</button>
            </div>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<script src="asset/js/jQuery.min.js"></script>
<script src="asset/js/bootstrap.min.js" type="text/javascript"></script>
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
          function reset(){
               $.ajax({
                type:"POST",
                url:"_send.php?",
                dataType:"json",
                data:{
                    email: $("#email").val(),
                    captcha_code: $("#captcha_code").val()
                },
                success:function(data){
                    if(data.ok){
                      layer.msg(data.msg, {icon: 6, time: 1000});
                      window.setTimeout("location.href='login.php'", 2000);
                    }else{
                      layer.msg(data.msg, {icon: 6, time: 1000});
                    }
                },
                error:function(jqXHR){
                    layer.msg("发生错误："+jqXHR.status, {icon: 5, time: 1000});
                }
            });
          }
        $("html").keydown(function(event){
            if(event.keyCode==13){
                reset();
            }
        });
        $("#reset").click(function(){
            reset();
        });
        $("#ok-close").click(function(){
            $("#msg-success").hide(100);
        });
        $("#error-close").click(function(){
            $("#msg-error").hide(100);
        });
    })
</script>

</body>
</html>
