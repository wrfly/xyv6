<?php
require_once '_main.php';
    $Bills = new Ss\Bills\bills();
    $rpp = 50;
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $bs = $Bills->success_bills();
    $money = $Bills->all_money();
    $count = $Bills->all_bill();
    $tcount = count($bs);
    $tpages = ($tcount) ? ceil($tcount/$rpp) : 1;
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
                账单管理
                <small>Billings Manage</small>
            <small>
              嗯……<?php echo "一共".$count."个订单，共计".number_format($money,2)."元"; ?>
            </small>
            </h1><p></p>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>用户</th>
                                    <th>邮箱</th>
                                    <th>套餐</th>
                                    <th>开通时长</th>
                                    <th>消费</th>
                                    <th>时间</th>
                                    <th>订单号</th>
                                    <th>查看用户</th>
                                </tr>
                                <?php
                                  $bs = array_slice($bs,$i,$rpp);
              								    foreach ($bs as $rs) {
                                ?>
                                    <tr>
                                        <td>#<?php echo $rs['id']; ?></td>
                                        <td><?php echo $Bills->user_info($rs['uid'])["user_name"]; ?></td>
                                        <td><?php echo $Bills->user_info($rs['uid'])["email"]; ?></td>
                                        <td><?php include '_plan.php'; ?></td>
                                        <td><?php echo $rs['month']; ?></td>
                                        <td><?php echo $rs['total_amount']; ?></td>
                                        <td><?php echo $rs['time_create']; ?></td>
                                        <td><?php echo $rs['out_trade_no']; ?> <?php
                                        if( strtotime($rs['time_create'])+3600*24*3 > time())
                                            echo "<small><a onclick=\"JavaScript:return confirm('确定吗？')\" href=\"_refund.php?otn=".
                                            $rs['out_trade_no']
                                                ."\">退款</a></small>";
                                        ?></td>
                                        <td>
                                          <a class="btn btn-info btn-sm" target="_blank" href="user_search.php?email=<?php echo $rs['uid']; ?>">查看用户</a>
                                        </td>
                                    </tr>
                                   <?php
                                   }?>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    <div id="bottom" align="center">
						<form action="bills.php" method="get">
                            <a href="<?php echo '?page=1'; ?>"> 首页 &nbsp;&nbsp;&nbsp;</a>
							<a href="<?php echo '?page='.($page-1); ?>">&lt;&lt;<?php echo $page-1; ?>&lt;&lt;&nbsp;</a>
							<input class="form-control" style="text-align:center;width:40px;height:25px;display:inline;" name="page" value="<?php echo $page;?>">
                            <a href="<?php echo '?page='.($page+1); ?>"> &nbsp;&gt;&gt;<?php echo $page+1; ?>&gt;&gt;</a>
                            <a href="<?php echo '?page='.$tpages; ?>">&nbsp;&nbsp;&nbsp;尾页 </a>
						</form>
					</div>
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

<?php
require_once '_footer.php'; ?>