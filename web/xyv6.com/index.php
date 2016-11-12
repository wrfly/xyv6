<?php
require_once '_main.php';
$info = $oo->get_user_info_array();

//获得流量信息
if($info['u']+$info['d']<1000000)
    $transfers=0;
else
    $transfers = $info['u']+$info['d'];

//计算流量并保留2位小数
$all_transfer = $info['transfer_enable']/$togb;
$unused_transfer =  $oo->unused_transfer()/$togb;
$used_100 = $oo->get_transfer()/$info['transfer_enable'];
$used_100 = round($used_100,2);
$used_100 = $used_100*100;
//计算流量并保留2位小数
$transfers = $transfers/$togb;
$transfers = round($transfers,2);
$all_transfer = round($all_transfer,2);
$unused_transfer = round($unused_transfer,2);

if ($transfers < 0 ) $transfers = 0;
if ($unused_transfer < 0 ) $unused_transfer = 0;

?>

    <style type="text/css">
    div.col-md-6 {
        margin-top: 20px !important;
        }
    .content {
        padding: 10px 15px 50px 15px ;
    }
    </style>

    <!-- ============== index ========================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                用户中心
                <small>User Center</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- START PROGRESS BARS -->
            <div class="row">

                <div class="col-md-6" >
                    <div class="box box-solid">
                        <div class="box-header">
                            <i class="fa fa-comments-o"></i>
                            <h3 class="box-title">
                            <b>公告</b></h3>
                        </div><!-- /.box-header -->
                        <div class="box-body" style="height:150px;overflow-y: scroll; ">
                        <?php
                            include 'anno.php';
                        ?>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col (right) -->

                <div class="col-md-6">
                    <div class="box box-solid">
                        <div class="box-header">
                            <i class="fa fa-bar-chart"></i>
                            <h3 class="box-title">流量使用情况</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <p> 套餐可用流量：<?php echo $all_transfer ."GB";?> </p>
                            <div title="已经用掉<?php echo $used_100; ?>%啦" class="progress progress-striped">
                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $used_100; ?>%">
                                    <span class="sr-only">Transfer</span>
                                </div>
                            </div>
                            <p> 已用流量：<?php
                              if ($transfers > 1) {
                                echo $transfers.'GB';
                              }else {
                                echo ($transfers*1024).'MB';
                              }
                            ?> </p>
                            <p> 剩余流量：<?php
                            if ($unused_transfer > 1) {
                              echo $unused_transfer.'GB';
                            }else {
                              echo ($unused_transfer*1024).'MB';
                            } ?> </p>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col (left) -->



                <div class="col-md-6">
                    <div class="box box-solid">
                        <div class="box-header">
                        <i class="fa fa-gift"></i>
                            <h3 class="box-title">签到获取流量</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <p> 每天都可以签到一次哦～</p>
                            <p>而且奖励的流量跟你今天的运气有关呢～</p>
                            <?php  if($oo->is_able_to_check_in())  { ?>
                                <p id="checkin-btn"> <button id="checkin" class="btn btn-success  btn-flat">立即签到</button></p>
                            <?php  }else{ ?>
                                <p><a class="btn btn-success btn-flat disabled" href="#"></i>今天已经签过了呢</a> </p>
                            <p>下次签到时间：<?php echo date('Y-m-d H:i:s',$info['last_check_in_time']+3600*21);?></p>
                            <?php  } ?>
                            <p id="checkin-msg" ></p>
                        </div><!-- /.box-body -->
                   </div><!-- /.box -->
                </div><!-- /.col (right) -->


                <div class="col-md-6">
                    <div class="box box-solid">
                        <div class="box-header">
                            <i class="fa fa-info"></i>
                            <h3 class="box-title">连接信息</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <p> 状态：
                            <?php if ( $info['enable'] == '0') {
                                echo "锁定 "; ?>
                                <i class="fa fa-lock"></i> <?php
                            }
                            else {
                                echo "正常 ";
                                ?><i class="fa fa-unlock"></i>
                                <?php }
                                ?>
                            </p>
                            <p> 端口：<?php
                            if ($info['port'] == 0) {
                                echo "<h3><a id=\"get_port\" href=\"#\"><span class=\"label label-danger\">点击获取端口</a></h3>";
                            }else
                                echo '<code>'.$info['port'].'</code>';
                            ?> <br /></p>
                            <p> 密码：<code><?php echo htmlentities($info['passwd']);?></code> </p>
                            <p> 套餐：<span class="label label-info">
                            <?php include 'plan.php';?></span> </p>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col (right) -->
            </div><!-- /.row -->
            <!-- END PROGRESS BARS -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once '_footer.php'; ?>

<script>
    $(document).ready(function(){
        $("#checkin").click(function(){
            $.ajax({
                type:"GET",
                url:"_checkin.php",
                dataType:"json",
                success:function(data){
                    $("#checkin-btn").hide();
                    $("#checkin-msg").html(data.msg);
                    layer.msg(data.msg, {icon: 6, time: 1500});

                },
                error:function(jqXHR){
                    alert("发生错误："+jqXHR.status);
                }
            })
        })
        $("#get_port").click(function(){
            $.ajax({
                type:"GET",
                url:"_get_port.php",
                dataType:"json",
                success:function(data){
                    layer.msg(data.msg, {icon: 6, time: 1500});
                    $("#get_port").html(data.p);
                    $("#msg").hide();

                },
                error:function(jqXHR){
                    alert("发生错误："+jqXHR.status);
                }
            })
        })
    })
</script>
