<?php
require_once '_main.php';
    $Users = new Ss\User\User();
    $rpp = 50;
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $recent = isset($_GET["recent"]) ? $_GET["recent"] : 0;
    $online = isset($_GET["online"]) ? $_GET["online"] : 0;
    $all = isset($_GET["all"]) ? $_GET["all"] : 0;
    if ( $all == 0){
        if ($recent != 0) {
            $us = $Users->RecentUser();
            $show_type="最近";
        }elseif ($online != 0) {
            $us = $Users->OnlineUser();
            $show_type="在线";
        }else{
            $us = $Users->ValidUser();
            $show_type="有效";
        }
    }else{
        $show_type="全部";
        $us = $Users->AllUser();
    }
    $tcount = count($us);
    $tpages = ($tcount) ? ceil($tcount/$rpp) : 1;
    if ($page >= $tpages) $page = $tpages;
    $i = ($page-1)*$rpp;

    //which node
    $n = new Ss\Node\Node();
    // $nodes = $n->GetNodeName($node_id)
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
                用户管理
                <small>User Manage</small>
            <small>|
            <a href="user.php?all=1">全部用户</a> |
            <a href="user.php?all=0">有效用户</a> |
            <a href="user.php?all=0&amp;recent=1">最近用户</a> |
            <a href="user.php?all=0&amp;online=1">在线用户</a> |
            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $show_type."用户 一共".$tcount;?>人
            </small>
            </h1>

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
                                    <th>用户名</th>
                                    <th>邮箱</th>
                                    <th>端口号</th>
                                    <th>套餐</th>
                                    <th>总流量</th>
                                    <th>剩余流量</th>
                                    <th>已使用流量</th>
                                    <th>最后使用</th>
                                    <th>所在节点</th>
                                    <th>邀请ID</th>
                                    <th>操作</th>
                                </tr>
                                <?php

                                $us = array_slice($us,$i,$rpp);
								    foreach ($us as $rs) {
								    ?>
                                    <tr>
                                        <td><b><?php echo $rs['uid']; ?></b></td>
                                        <td><?php echo $rs['user_name']; ?></td>
                                        <td title="<?php echo $rs['email'];?>"><?php echo substr($rs['email'],0, 15); ?></td>
                                        <td><?php echo $rs['port']; ?></td>
                                        <td>
                                            <?php
                                        include '_plan.php';
                                            ?>
                                        </td>
                                        <td><?php \Ss\Etc\Comm::flowAutoShow($rs['transfer_enable']); ?></td>
                                        <td><?php \Ss\Etc\Comm::flowAutoShow(($rs['transfer_enable']-$rs['u']-$rs['d'])); ?></td>
                                        <td><?php \Ss\Etc\Comm::flowAutoShow(($rs['u']+$rs['d'])); ?></td>
                                        <td><?php echo date('m-d H:i:s',$rs['t']); ?></td>
                                        <td title="<?php if ( $rs['w_n'] != 0 ) echo $n->GetNodeName($rs['w_n']); else echo "Off line"; ?>"><?php echo $rs['w_n']; ?></td>
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
                                            <a class="btn btn-danger btn-sm" href="user_action.php?action=ban&amp;uid=<?php echo $rs['uid']; ?>">禁用</a>
                                        </td>
                                    </tr>
                                   <?php
                                   }?>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    <div id="bottom" align="center">
						<form action="user.php" method="get">
                            <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&page=1'; ?>"> 首页 &nbsp;&nbsp;&nbsp;</a>
							<a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&page='.($page-1); ?>">&lt;&lt;<?php echo $page-1; ?>&lt;&lt;&nbsp;</a>
                             <input class="form-control" style="text-align:center;width:40px;height:25px;display:inline;" name="page" value="<?php echo $page;?>">
                            <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&page='.($page+1); ?>"> &nbsp;&gt;&gt;<?php echo $page+1; ?>&gt;&gt;</a>
                            <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&page='.$tpages; ?>">&nbsp;&nbsp;&nbsp;尾页 </a>
						</form>
					</div>
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

<?php
require_once '_footer.php'; ?>
