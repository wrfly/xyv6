<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1>
            用户管理
            <small>User Manage</small>
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
					        <form action="user_search.php" method="get">
					        	<input class="form-group form-control box-body" name="email">
					        </form>
                  <table class="table">
                    <tr>
                      <td>ID: <?php echo $uid;?></td>
                      <td>当前所在结点：<?php $n = new Ss\Node\Node();if ( $rs['w_n'] != 0 ) echo $n->GetNodeName($rs['w_n']); else echo "Off line"; ?></td>
                    </tr>
                    <tr>
                      <td>邮箱：<?php echo $rs['email'];?></td>
                      <td>用户名：<?php echo $rs['user_name'];?></td>
                    </tr>
                    <tr>
                      <td>端口号：<?php echo $rs['port'];?></td>
                      <td>端口密码：<?php echo $rs['passwd'];?></td>
                    </tr>
                    <tr>
                      <td>注册时间：<?php echo $rs['reg_date'];?></td>
                      <td>最后使用时间：<?php echo date('Y-m-d H:i:s',$rs['t']);?></td>
                    </tr>
                    <tr>
                      <td>VIP开通时间：<?php echo date('Y-m-d H:i:s',$rs['vip_start_time']);?></td>
                      <td>VIP到期时间：<?php echo date('Y-m-d H:i:s',$rs['vip_end_time']);?></td>
                    </tr>
                    <tr>
                      <td>余额：<input id="money" value="<?php echo $rs['money'];?>" ></td>
                      <td>用户当前套餐：<?php
                      if ($rs['plan'] == 'A') { //50yuan
                      	echo "VIP 160G";
                      }
                      elseif ($rs['plan'] == 'B') {//10yuan
                      	echo "VIP 30G";
                      }
                      elseif ($rs['plan'] == 'C') {
                      	echo "免费";
                      }
                      elseif ($rs['plan'] == 'D') {//1yuan
                      	echo "1G";
                      }
                      else{
                      	echo "Beta";
                      }
                      if ($rs['ovpn'] == 1) {
                        echo " + Openvpn";
                      }
                      ?></td>
                    </tr>
                    <tr>
                      <td>设置流量：
                        <input id="transfer_enable" value="<?php echo $rs['transfer_enable']/$togb;?>" ></td>
                      <td>已用流量：<?php
                        $yyll = number_format(($rs['d']+$rs['u'])/$togb,2);
                        if ($yyll < 1) {
                          echo ($yyll*1024).'MB';
                        }else {
                          echo $yyll.'GB';
                        }
                      ?></td>
                    </tr>
                    <tr>
                      <td>Month：<?php echo $rs['vip_month'];?></td>
                      <td>邀请者：<?php echo $rs['ref_by'];?></td>
                    </tr>
                    
                    <tr>
                      <td>邀请了：<?php echo $U->GetRefCount($uid);?>人</td>
                    </tr>

                    <tr>
                      <td>返利：<?php echo $rs['total_earned'];?> RMB</td>
                      <td>实收：<?php echo $rs['earned_money'];?> RMB</td>
                    </tr>

                    <tr>
                      <td>支付宝：<code><?php echo $rs['alipay_account'];?></code></td>
                      <td>消费：<?php echo $U->GetTotalSpent($uid);?> RMB</td>
                    </tr>

                  </table>

            </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" id="submit" name="submit"   class="btn btn-primary">修改</button>
                            <a class="btn btn-danger btn-sm" href="_user_del.php?uid=<?php echo $rs['uid']; ?>" onclick="JavaScript:return confirm('确定删除吗？')">删除</a>
                            <a class="btn btn-default btn-sm" href="user_action.php?action=ban&uid=<?php echo $rs['uid']; ?>">禁用</a>
                            <a class="btn btn-default btn-sm" href="user_action.php?action=active&uid=<?php echo $rs['uid']; ?>">激活</a>
                            <a class="btn btn-default btn-sm" href="user_action.php?action=clear&uid=<?php echo $rs['uid']; ?>">流量清空</a>
                            <a class="btn btn-danger btn-sm" href="user_action.php?action=gift&uid=<?php if($rs['total_earned'] - $rs['earned_money'] > 0) echo $rs['uid']; else echo 0; ?>" onclick="JavaScript:return confirm('Are You Sure?')">GIFT</a>
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
require_once '_footer.php'; ?>

<script>
    $(document).ready(function(){
        $("#submit").click(function(){
            $.ajax({
                type:"POST",
                url:"_user_edit.php",
                dataType:"json",
                data:{
                    uid: <?php echo $uid;?>,
                    // name: $("#name").val(),
                    // email: $("#email").val(),
                    money: $("#money").val(),
                    // passwd: $("#passwd").val(),
                    // plan: $("#plan").val(),
                    transfer_enable: $("#transfer_enable").val() * 1024 * 1024 * 1024,
                    invite_num: 1
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
