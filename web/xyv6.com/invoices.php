<?php
require_once '_main.php';
$Bills = new Ss\Bills\bills();
$bs = $Bills->mybills($uid);

?>
<style>
td{
  text-align: center;
}
</style>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                购买记录
                <small>My Invoices</small>
                <small>除体验套餐外，所有套餐均可在购买三天内申请退款。</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
                 <div class="col-xs-12">
                     <div class="box">
                         <div align="center" class="box-body table-responsive no-padding" >
                             <table class="table table-hover">
                                 <tr>
                                     <th>订单ID</th>
                                     <th>用户邮箱</th>
                                     <th>套餐名称</th>
                                     <th>开通时长</th>
                                     <th>付款金额</th>
                                     <th>购买时间</th>
                                     <th>开通时间</th>
                                     <th>结束时间</th>
                                 </tr>
                                 <?php
 							    foreach ($bs as $rs) {
 								    ?>
                                     <tr>
                                         <td><?php echo $rs['id']; ?></td>
                                         <td><?php echo $U->GetEmail(); ?></td>
                                         <td><?php echo $rs['subject']; ?></td>
                                         <td><?php if( $rs['total_amount'] != 1 ){
                                           echo $rs['month'].'个月';
                                           $endtime = date("Y-m-d H:i:s",strtotime($rs['time_create'])+3600*24*31*$rs['month']);
                                         }else {
                                           echo "1天";
                                           $endtime = date("Y-m-d H:i:s",strtotime($rs['time_create'])+3600*24);
                                         }; ?></td>
                                         <td><?php echo $rs['total_amount'].'元'; ?></td>
                                         <td><?php echo $rs['time_create']; ?></td>
                                         <td><?php echo $rs['time_create']; ?></td>
                                         <td><?php if ( $rs['total_amount'] == 5) {
                                           $endtime = $U->Get_plan_round_time();
                                           echo date("Y-m-d H:i:s",$endtime);
                                         }else //马各级，储存格式不一样！
                                         echo $endtime; ?></td>
                                     </tr>
                                    <?php
                                    }?>
                             </table>
                         </div><!-- /.box-body -->
                     </div><!-- /.box -->
                 </div>
             </div>
        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

<?php
require_once '_footer.php'; ?>
