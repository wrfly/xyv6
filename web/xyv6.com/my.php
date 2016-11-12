<?php
require_once '_main.php'; ?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                我的信息
                <small>My Information</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-body">
                        <table class="table">
                            <tr><?php $user_info = $U->UserArray();?>
                                <td>用户名：<?php echo $user_info['user_name']; ?></td>
                                <td>注册邮箱：<?php echo $user_email; ?></td>
                            </tr>
                            <tr>
                                <td>最后使用日期：<?php echo date("Y-n-d G:i:s",$user_info['t']);?></td>
                                <td>注册日期：<?php echo $user_info['reg_date'];?></td>
                            </tr>
                            <tr>
                                <td>
                                  套餐：<span class="label label-info"><?php include 'plan.php';?></span>
                                <td>
                                用户状态：<?php
                                    if ( $user_info['enable'] == 0 ) {
                                        echo "锁定";
                                    }
                                    else{echo "正常";}?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                  流量重置日期：<?php echo date("Y-m-d H:i:s",$U->Get_plan_round_time());?></td>
                                </td>
                                <td>
                                    账户余额：<?php echo $user_info['money'];?>元
                                </td>
                            </tr>
                            <?php if ($user_info['plan'] != 'C') {
                                ?>
                                <td> VIP开通时间：<?php echo date("Y-n-d G:i:s",$user_info['vip_start_time'] );?> </td>
                                <td> VIP到期时间：<?php echo date("Y-n-d G:i:s",$user_info['vip_end_time'] );?> </td>
                            <?php }?>
                        </table>

                        </div><!-- /.box -->
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                        <table class="table">
                            <tr>
                                <td>我的端口：<?php echo $user_info['port']; ?></td>
                                <td>端口密码：<?php echo $user_info['passwd']; ?></td>
                            </tr>
                            <tr>
                                <td>已用流量：<?php
                                  $yyll = number_format($oo->getUsedTransfer()/1024/1024/1024,2);
                                  if ($yyll < 1) {
                                    echo ($yyll*1024).'MB';
                                  }else {
                                    echo $yyll.'GB';
                                  }
                                ?></td>
                                <td>剩余流量：<?php
                                  $syll = number_format(($user_info['transfer_enable'] - $user_info['u'] - $user_info['d'])/1024/1024/1024,2);
                                  if ($syll < 1) {
                                    echo ($syll*1024).'MB';
                                  }else {
                                    echo $syll.'GB';
                                  }
                                ?></td>
                            </tr>
                            <tr>
                                <td>当前是否在线：<?php if ( $user_info['w_n'] == 0 ) echo "否";else echo "是";?></td>
                                <td>当前所在结点：<?php if ( $user_info['w_n'] != 0 ) {
                                        $n = new Ss\Node\Node();
                                        echo $n->GetNodeName($user_info['w_n']);
                                    }else
                                        echo "Off line"; ?></td>
                            </tr>
                        </table>

                        </div><!-- /.box -->
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once '_footer.php'; ?>
