<?php  
require_once '_main.php';

if(!empty($_GET)){
    //获取id
    $email = $_GET['email'];
    $asdfasd = new \Ss\User\User();
    $uid = $asdfasd->get_user_uid($email);
    if ($uid == '') {
        $uid = '1';
    }
    $u = new \Ss\User\UserInfo($uid);
    $rs = $u->UserArray();
}
else{
    $u = new \Ss\User\UserInfo("1");
    $rs = $u->UserArray();
}
?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
        <h1>
            添加VIP用户
            <small>Add VIP User</small>
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
                        <h3 class="box-title">查询用户</h3>
                    </div><!-- /.box-header -->
                        <div class="box-body">
					        <form action="vip_user_add.php" method="get">
					        	<input class="form-group form-control box-body" name="email">
					        </form>

                            <div class="form-group">
                                <label for="cate_title">用户名</label>
                                <input disabled="true" class="form-control" id="name" value="<?php echo $rs['user_name'];?>" >
                                <input type="hidden" class="form-control" id="uid" value="<?php echo $rs['uid'];?>" >
                            </div>

                            <div class="form-group">
                                <label for="cate_title">用户邮箱</label>
                                <input disabled="true" class="form-control" id="email" value="<?php echo $rs['email'];?>"  >
                            </div>
                            <div class="form-group">
                                <label for="cate_title">用户套餐</label>
                                <p>当前：<b><?php 
                                include 'plan.php';
                            ?>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" id="submit" name="submit"   class="btn btn-primary">添加</button>
                        </div>
                        <div id="msg-success" class="alert alert-info alert-dismissable" style="display: none;">
                            <button type="button" class="close" id="ok-close" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-info"></i> 成功!</h4>
                            <p id="msg-success-p"></p>
                        </div>
                        <div id="msg-error" class="alert alert-warning alert-dismissable" style="display: none;">
                            <button type="button" class="close" id="error-close" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-warning"></i> 出错了!</h4>
                            <p id="msg-error-p"></p>
                        </div>
                </div>
            </div><!-- /.box -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php
require_once '_footer.php'; 
?>

<script>
    $(document).ready(function(){
        $("#submit").click(function(){
            $.ajax({
                type:"POST",
                url:"_vip_user_edit.php",
                dataType:"json",
                data:{
                    uid: $("#uid").val(),
                    plan: $("#plan").val(),
                    month: $("#month").val()
                },
                success:function(data){
                    if(data.ok){
                        $("#msg-error").hide(10);
                        $("#msg-success").show(100);
                        $("#msg-success-p").html(data.msg);
                        window.setTimeout("window.location.reload()", 1000);
                    }else{
                        $("#msg-error").show(100);
                        $("#msg-error-p").html(data.msg);
                    }
                },
                error:function(jqXHR){
                    $("#msg-error").hide(10);
                    $("#msg-error").show(100);
                    $("#msg-error-p").html("发生错误："+jqXHR.status);
                }
            })
        })
        $("#ok-close").click(function(){
            $("#msg-success").hide(100);
        })
        $("#error-close").click(function(){
            $("#msg-error").hide(100);
        })
    })
</script>

