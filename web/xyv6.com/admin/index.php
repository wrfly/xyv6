<?php
require_once '_main.php';
$ssmin = new \Ss\Etc\Ana();
$mt = $ssmin->getMonthTraffic();
$mt = $mt/$togb;
$mt = round($mt,3);
$active_user = $ssmin->activedUserCount();
$all_user = $ssmin->allUserCount();
$node_count = $ssmin->nodeCount();
$ing_downloads = $ssmin->ing_downloadsCount();
$all_downloads = $ssmin->all_downloadsCount();
?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                管理中心
                <small>Manage Center</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <a href="node.php" class="small-box-footer">
                        <div class="inner">
                            <p>
                                节点
                            </p>
                            <h3>
                                <?php  echo $node_count; ?>
                            </h3>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cloud"></i>
                        </div>                        
                            <p>管理 <i class="fa fa-arrow-circle-right"></i></p>                        
                        </a>
                    </div>                    
                </div><!-- ./col -->

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                    <a href="user.php" class="small-box-footer">
                        <div class="inner">
                            <p>
                                用户
                            </p>
                            <h3>
                                <?php  echo $all_user; ?>
                            </h3>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>                        
                            <p>查看 <i class="fa fa-arrow-circle-right"></i></p>
                        </a>
                    </div>
                </div><!-- ./col -->

                <div class="col-lg-3 col-xs-5">
                    <!-- small box -->
                    <div class="small-box bg-green">
                    <a href="downloads.php" class="small-box-footer">
                        <div class="inner">
                            <p>
                                下载
                            </p>
                            <h3>
                                <?php  echo $ing_downloads; ?>/
                                <?php  echo $all_downloads; ?>
                            </h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-download"></i>
                        </div>                        
                            <p>查看 <i class="fa fa-arrow-circle-right"></i></p>
                        </a>
                    </div>
                </div><!-- ./col -->

            </div><!-- /.row -->

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once '_footer.php'; ?>



