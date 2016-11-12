<?php
require_once '_main.php';
    $Users = new Ss\User\User();
    $rpp = 50;
    $page = $_GET["page"];
    $us = $Users->VipUser();
    $vip_user_num = $Users->CountVipUser();
    $tcount = count($us);
    $tpages = ($tcount) ? ceil($tcount/$rpp) : 1;
    if($page<=0) $page = 1;
    if ($page >= $tpages) $page = $tpages;
    $i = ($page-1)*$rpp;
?>
<style type="text/css">
    td{
        text-align: center;
    }
</style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                VIP用户 <?php echo $vip_user_num ?>
                <small>
                <a href="vip_user_add.php">添加VIP用户</a>
                </small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>邮箱</th>
                                    <th>端口号</th>
                                    <th>套餐</th>
                                    <th>余额</th>
                                    <th>总流量</th>
                                    <th>VIP开始</th>
                                    <th>已用流量</th>
                                    <th>VIP截止</th>
                                    <th>邀请ID</th>
                                    <th>操作</th>
                                </tr>
                                <?php

                                $us = array_slice($us,$i,$rpp);
								    foreach ($us as $rs) {
								    ?>
                                    <tr>
                                        <td>#<?php echo $rs['uid']; ?></td>
                                        <td><?php echo $rs['user_name']; ?></td>
                                        <td title="<?php echo $rs['email'];?>"><?php echo substr($rs['email'],0, 15); ?></td>
                                        <td><?php echo $rs['port']; ?></td>
                                        <td>
                                        <b><?php
                                            include '_plan.php';
                                        ?>
                                        </td>
                                        <td><?php echo $rs['money']; ?></td>
                                        <td><?php \Ss\Etc\Comm::flowAutoShow($rs['transfer_enable']); ?></td>
                                        <td><?php echo date('Y-m-d H:i',$rs['vip_start_time']); ?></td>
                                        <td><?php \Ss\Etc\Comm::flowAutoShow($rs['u'] + $rs['d']); ?></td>
                                        <td><?php echo date('Y-m-d H:i',$rs['vip_end_time']); ?></td>
                                        <td>
										<?php
										if ( $rs['ref_by'] != 0 ){
                                            echo $rs['ref_by'];
											}
                                        else {
                                            echo '';
                                        	}
										?>
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="user_edit.php?uid=<?php echo $rs['uid']; ?>">编辑</a>
                                        </td>
                                    </tr>
                                   <?php
                                   }?>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    <div id="bottom" align="center">
						<form action="vip_user.php" method="get">
							<a href="<?php echo '?page='.($page-1); ?>">&lt;&lt;上一页</a>
                             <input class="form-control" style="text-align:center;width:40px;height:25px;display:inline;" name="page" value="<?php echo $page;?>">
							<a href="<?php echo '?page='.($page+1); ?>">下一页&gt;&gt;</a>
						</form>
                        <p>一共<?php echo $tpages;?>页 当前第<?php echo $page;?>页</p>
					</div>
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

<?php
require_once '_footer.php'; ?>
