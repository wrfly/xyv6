<?php
require_once '_main.php';

//更新
if(!empty($_POST)){
    $node_id       = $_POST['node_id'];
    $node_name     = $_POST['node_name'];
    $node_type     = $_POST['node_type'];
    $node_server   = $_POST['node_server'];
    $node_ipv4     = $_POST['node_ipv4'];
    $node_method   = $_POST['node_method'];
    $node_info     = $_POST['node_info'];
    $node_status   = $_POST['node_status'];
    $node_order    = $_POST['node_order'];
    $node = new \Ss\Node\NodeInfo($node_id);
    $query = $node->Update($node_name,$node_type,$node_server,$node_ipv4,$node_method,$node_info,$node_status,$node_order);
    if($query){
        echo " <script>window.location='node.php';</script> " ;
    }
}

if(!empty($_GET)){
    //获取id
    $id = $_GET['id'];
    $node = new \Ss\Node\NodeInfo($id);
    $rs = $node->NodeArray();
}else
    die();

?>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            节点编辑
            <small>Node Update</small>
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
                        <h3 class="box-title">编辑节点</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="node_edit.php">
                        <div class="box-body">

                            <div class="form-group" style="display:none" >
                                <label for="cate_title" >ID</label>
                                <input  class="form-control" name="node_id" value="<?php echo $id;?>"  >
                            </div>

                            <div class="form-group">
                                <label for="cate_title">节点名字</label>
                                <input  class="form-control" name="node_name" value="<?php echo $rs['node_name'];?>" >
                            </div>

                            <div class="form-group">
                                <label for="cate_title">节点IPV6地址</label>
                                <input  class="form-control" name="node_server" value="<?php echo $rs['node_server'];?>" >
                            </div>

                            <div class="form-group">
                                <label for="cate_title">节点IPV4地址</label>
                                <input  class="form-control" name="node_ipv4" value="<?php echo $rs['node_ipv4'];?>" >
                            </div>
                            
                            <div class="form-group">
                                <label for="cate_method">加密方式</label>
                                <input  class="form-control" name="node_method" value="aes-256-cfb" hide=true;>
                            </div>

                            <div class="form-group">
                                <label for="cate_title">节点描述</label>
                                <input  class="form-control" name="node_info" value="<?php echo $rs['node_info'];?>" >
                            </div>

                            <div class="form-group">
                                <label for="cate_order">分类</label>
                                <select class="form-control" name="node_type"><b>
                                    <option value="<?php echo $rs['node_type'];?>"><?php if($rs['node_type'] == 0)echo "FREE";else echo "PRO";?></option>
                                    <option value="0">FREE</option>
                                    <option value="1">PRO</option></b>
                                </select> 
                            </div>

                            <div class="form-group">
                                <label for="cate_order">状态</label>
                                <select class="form-control" name="node_status">
                                    <option value="<?php echo $rs['node_status'];?>"><?php echo $rs['node_status'];?></option>
                                    <option value="正常">正常</option>
                                    <option value="暂停">暂停</option>
                                </select> 
                            </div>

                            <div class="form-group">
                                <label for="cate_order">排序</label>
                                <input   class="form-control" name="node_order"  value="<?php echo $rs['node_order'];?>" >
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" name="action" value="edit" class="btn btn-primary">修改</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.box -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php
require_once '_footer.php'; ?>
