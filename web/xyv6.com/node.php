<?php
require_once '_main.php';
$node = new \Ss\Node\Node();
$ssmin = new \Ss\Etc\Ana();
?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                节点列表
                <small>Nodes List</small>
                <small><a href="config">下载全部节点配置信息（json格式）</a></small>
                <small><a href="config?4">IPv4节点配置信息</a></small>
                <small><a href="config?6">IPv6节点配置信息</a></small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- START PROGRESS BARS -->
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-solid">
                        <div class="box-header">
                            <i class="fa fa-hdd-o"></i>
                            <h3 class="box-title">免费节点</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="callout callout-warning">
                                <h4>Notice:</h4>
                                <p>
                                    如果网速变慢，可尝试更换空闲节点，或者购买使用Pro节点。
                                </p>
                            </div><?php
                            $node0 = $node->NodesArray(0);
                            foreach($node0 as $row){
                                ?>
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs pull-right">
                                        <li>
                                            <a target="_blank" href="node_qr?id=<?php echo $row['id']; ?>">
                                                <span class="fa fa-qrcode"> IPV6二维码</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a target="_blank" href="node_qr?type=4&amp;id=<?php echo $row['id']; ?>">
                                                <span class="fa fa-qrcode"> IPV4二维码</span>
                                            </a>
                                        </li>

                                        <li class="pull-left header">
                                            <i class="fa fa-cloud"> <?php echo $row['node_name']; ?></i>

                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1-1">
                                            <p>
                                                节点状态:<?php
                                                if ($row['node_status'] != '暂停') {
                                                    echo '<a class="btn btn-xs bg-orange btn-flat margin" href="#" title="节点状态">';
                                                    if ( $ssmin->count_node_people($row['id']) < 3 ) {
                                                        echo "空闲";
                                                    }
                                                    elseif ( $ssmin->count_node_people($row['id']) < 12) {
                                                        echo "正常";
                                                    }
                                                    else {
                                                        echo "忙碌";
                                                    }
                                                }else{
                                                    echo '<a class="btn btn-xs bg-red btn-flat margin" href="#" title="节点状态">';
                                                    echo "暂停";
                                                    }
                                                ?>
                                                </a>
                                                当前速度:<a class="btn btn-xs bg-green btn-flat margin" href="./node" title="节点实时速度"><?php echo $row['node_speed']; ?></a>
                                                在线人数:<a class="btn btn-xs bg-purple btn-flat margin" href="./node" title="节点在线人数"><?php echo $ssmin->count_node_people($row['id']); ?></a>
                                            </p>
                                            <small><?php echo $row['node_info']; ?></small>
                                        </div><!-- /.tab-pane -->
                                    </div><!-- /.tab-content -->
                                </div><!-- nav-tabs-custom -->
                            <?php }?>
                        </div><!-- /.box-body -->


                    </div><!-- /.box -->
                </div><!-- /.col (left) -->

                <div class="col-md-6">
                    <div class="box box-solid">
                        <div class="box-header">
                            <i class="fa fa-server"></i>
                            <h3 class="box-title">Pro节点</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="callout callout-warning">
                                <h4>Notice:</h4>
                                <p>免流量上网请选择IPV6二维码，科学上网请选择IPV4二维码</p>
                            </div><?php
                            $node1 = $node->NodesArray(1);
                            foreach($node1 as $row){
                                ?>
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs pull-right">
                                        <li class="dropdown">
                                        <li>
                                            <a target="_blank" href="node_qr?type=6&amp;id=<?php echo $row['id']; ?>">
                                                <span class="fa fa-qrcode"> IPV6二维码</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="node_qr?type=4&amp;id=<?php echo $row['id']; ?>">
                                                <span class="fa fa-qrcode"> IPV4二维码</span>
                                            </a>
                                        </li>
                                        <li class="pull-left header">
                                            <i class="fa fa-skyatlas"> <?php echo $row['node_name']; ?></i>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1-1">
                                            <p>节点状态:<?php
                                                if ($row['node_status'] != '暂停') {
                                                    echo '<a class="btn btn-xs bg-orange btn-flat margin" href="#" title="节点状态">';
                                                    if (intval($row['node_speed']) <= 100 and preg_match("/KB/i", $row['node_speed'])) {
                                                        echo "空闲";
                                                    }
                                                    elseif (intval($row['node_speed']) >= 100 and intval($row['node_speed']) <= 999 and preg_match("/KB/i", $row['node_speed'])) {
                                                        echo "正常";
                                                    }
                                                    elseif (preg_match("/MB/i", $row['node_speed']) and intval($row['node_speed']) <= 4) {
                                                        echo "正常";
                                                    }
                                                    elseif (preg_match("/MB/i", $row['node_speed']) and intval($row['node_speed']) >= 4) {
                                                        echo "忙碌";
                                                    }
                                                }else{
                                                    echo '<a class="btn btn-xs bg-red btn-flat margin" href="#" title="节点状态">';
                                                    echo "暂停";
                                                    }
                                                ?>
                                                </a>
                                                当前速度:<a class="btn btn-xs bg-green btn-flat margin" href="./node" title="节点实时速度"><?php echo $row['node_speed']; ?></a>
                                                在线人数:<a class="btn btn-xs bg-purple btn-flat margin" href="./node" title="节点在线人数"><?php echo $ssmin->count_node_people($row['id']); ?></a>
                                            </p>
                                            <small> <?php echo $row['node_info']; ?></small>
                                        </div><!-- /.tab-pane -->
                                    </div><!-- /.tab-content -->
                                </div><!-- nav-tabs-custom -->
                            <?php }?>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col (right) -->

            </div><!-- /.row -->
            <!-- END PROGRESS BARS -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once '_footer.php'; ?>
