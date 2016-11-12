<?php
require_once '_main.php';
?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                意见反馈
                <small>Feedback</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">标题</h3><p></p>
                            <input class="form-control" id="subject" placeholder="反馈标题">

                        </div><!-- /.box-header -->

                        <div class="box-header">
                            <h3 class="box-title">内容</h3><p></p>
                            <textarea class="form-control" id="content" style="height:250px;resize: none;"placeholder="在此输入您想反馈的内容"></textarea>
                        </div><!-- /.box-header -->

                    </div>
            <div>
                <a href='javascript: refreshCaptcha();'><img src="phpcaptcha/captcha.php?rand=<?php echo rand();?>" id='captchaimg' title='点击刷新'></a>

                <input tabindex="-1" type="text" id="captcha_code" name="captcha_code" class="form-control" style="display:inline;width:20%" placeholder="验证码"/>

                <button id="send" type="submit" class="btn btn-primary">发送 <i class="fa fa-arrow-circle-o-right"></i></button><p></p>

            </div>

            <center><div id="msg-success" class="alert alert-info alert-dismissable" style="display: none;">
                <button type="button" class="close" id="ok-close" aria-hidden="true">&times;</button>
                <h4 text-align="cneter"><i class="icon fa fa-info"></i>成功!</h4>
                <p id="msg-success-p"></p>
            </div></center>
           <center> <div id="msg-error" class="alert alert-warning alert-dismissable" style="display: none;">
                <button type="button" class="close" id="error-close" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> 出错了!</h4>
                <p id="msg-error-p"></p>
            </div></center>


                </div>





                <div class="col-md-6">
                    <div class="box box-solid">
                        <div class="box-body">

                            <div class="callout callout-info">
                                <h4>说明</h4>
                                <p><b>也可以在我们的讨论社区发起问题：<a href="https://xyv6.kf5.com/hc/community/">校园V6讨论社区（测试中）</a></b><p>
                                <p>如果有任何使用中的问题，好的意见或建议，请及时反馈给我们。</p>
                                <p>遇到无法解决的问题，可以加QQ群：225856700 进行咨询。</p>
                                <p>我们的新浪微博是 <a href="http://weibo.com/xyv6">@xyv6</a>，发布最新的更新消息，欢迎关注呢。</p>
                                <p>可以在此处申请退款，标题注明申请退款即可。</p>
                            </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col (right) -->




                </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

<script src="asset/js/icheck.min.js" type="text/javascript"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
    $("#msg-error").hide(100);
    $("#msg-success").hide(100);
</script>

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
        function feedback(){
            $.ajax({
                type:"POST",
                url:"_send.php?type=feedback",
                dataType:"json",
                data:{
                    uid: <?php echo $uid;?>,
                    content: $("#content").val(),
                    subject: $("#subject").val(),
                    captcha_code: $("#captcha_code").val()
                },
                success:function(data){
                    if(data.ok){
                        $("#msg-error").hide(100);
                        $("#msg-success").show(100);
                        $("#msg-success-p").html(data.msg);
                        window.setTimeout("location.href='feedback.php'", 2000);
                    }else{
                        $("#msg-error").hide(10);
                        $("#msg-error").show(100);
                        $("#msg-error-p").html(data.msg);
                    }
                },
                error:function(jqXHR){
                    $("#msg-error").hide(10);
                    $("#msg-error").show(100);
                    $("#msg-error-p").html("发生错误："+jqXHR.status);
                }
            });
        }
        $("#send").click(function(){
            feedback();
        });
         $("#ok-close").click(function(){
            $("#msg-success").hide(100);
        });
        $("#error-close").click(function(){
            $("#msg-error").hide(100);
        });
    })
</script>

<?php
require_once '_footer.php'; ?>
