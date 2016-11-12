<?php
require_once '_main.php';
$node = new Ss\Node\Node();
$ssmin = new \Ss\Etc\Ana();
?>

    <!-- =============================================== -->
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
                节点列表
                <small>Node List</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <p> <a class="btn btn-success btn-sm" href="node_add.php">添加</a> </p>
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>节点</th>
                                    <th>类型</th>
                                    <th>Order</th>
                                    <th>IPV6地址</th>
                                    <th>IPV4地址</th>
                                    <!-- <th>剩余空间</th> -->
                                    <th>在线人数</th>
                                    <th>实时速度</th>
                                    <th>操作</th>
                                </tr>
                                <?php
                                $n = new \Ss\Node\Node();
                                $nodes = $n->AllNode();
                                foreach($nodes as $rs){ ?>
                                    <tr>
                                        <td><?php echo $rs['id']; ?></td>
                                        <td><?php echo $rs['node_name']; ?></td>
                                        <td><?php if($rs['node_type'] == 0) echo "free";
                                            else echo "<b>PRO</b>";; ?></td>
                                        <td><?php echo $rs['node_order']; ?></td>
                                        <td><?php echo $rs['node_server']; ?></td>
                                        <td><?php echo $rs['node_ipv4']; ?></td>
                                        <!-- <td><?php echo \Ss\Etc\Comm::flowAutoShow($rs['node_free_space']); ?></td> -->
                                        <td><?php echo $ssmin->count_node_people($rs['id']); ?></td>
                                        <td id="speed"><?php echo $rs['node_speed']; ?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="node_edit.php?id=<?php echo $rs['id']; ?>">编辑</a>
                                            <a class="btn btn-danger btn-sm" href="node_del.php?id=<?php echo $rs['id']; ?>">删除</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once '_footer.php'; ?>