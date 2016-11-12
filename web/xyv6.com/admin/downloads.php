<?php
require_once '_main.php';
    $Missions = new Ss\Download\mission();
    $rpp = 50;
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $all = isset($_GET["all"]) ? $_GET["all"] : 1;
    if ( $all == 0) $ms = $Missions->Finished_downloads();
        else $ms = $Missions->All_downloads();
    $tcount = count($ms);
    $tpages = ($tcount) ? ceil($tcount/$rpp) : 1;
    if ($page >= $tpages) $page = $tpages;
    $i = ($page-1)*$rpp;
?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                下载管理
                <small>User Manage</small>
            <small>| 
            <a href="downloads.php?all=1">所有下载</a> |
            <a href="downloads.php?all=0">完成的下载</a> |
            &nbsp;&nbsp;&nbsp;&nbsp;<?php 
            if ($all == 1) {
                echo "一共".$tcount;
            }
            else echo $tcount;?> 个
            </small>
            </h1><p></p>
            <form>
            	<input id="file_name" style="width:240px;vertical-align:middle;display:inline;" class="form-control" placeholder="自定义文件名" >
            	<input id="file_url" style="width:440px;vertical-align:middle;display:inline;" class="form-control" placeholder="下载地址" >
            	<bottom id="add" type="submit" style="vertical-align:middle;display:inline;" class="btn btn-info btn-sm" value="add">提交</bottom>
            </form>
            <!-- //反馈信息 -->
            <p></p>
            <div align="center" id="msg-success" class="alert alert-info alert-dismissable" style="display: none;alien:center;height:80px;width:480px;">
                <button type="button" class="close" id="ok-close" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i>添加任务成功!</h4>
                <p id="msg-success-p"></p>
            </div>
    
            <div align="center" id="msg-error" class="alert alert-warning alert-dismissable" style="display: none;alien:center;height:80px;width:480px;">
                <button type="button" class="close" id="error-close" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i>出错了!</h4>
                <p id="msg-error-p"></p>
            </div>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div align="center" class="box-body table-responsive no-padding" >
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>用户</th>
                                    <th>文件名</th>
                                    <th>文件格式</th>
                                    <th>大小</th>
                                    <th>添加时间</th>
                                    <th>开始时间</th>
                                    <th>结束时间</th>
                                    <th>百分比</th>
                                    <th>是否存在</th>
                                    <th>操作</th>
                                </tr>
                                <?php

                                $ms = array_slice($ms,$i,$rpp);
								    foreach ($ms as $rs) {
								    ?>
                                    <tr>
                                        <td><?php echo $rs['id']; ?></td>
                                        <td><?php echo $rs['uid']; ?></td>
                                        <td><?php echo $rs['file_name']; ?></td>
                                        <td><?php echo $rs['file_format']; ?></td>
                                        <td><?php echo \Ss\Etc\Comm::flowAutoShow($rs['file_size']); ?></td>
                                        <td><?php echo date("Y-n-d G:i:s",$rs['add_time']); ?></td>
                                        <td><?php echo ($rs['start_time'] == 0) ? '<i class="fa fa-spinner fa-spin"></i>' :date("Y-n-d G:i:s",$rs['start_time']); ?></td>
                                        <td><?php echo ($rs['finish_time'] == 0) ? '<i class="fa fa-spinner fa-spin"></i>' :date("Y-n-d G:i:s",$rs['finish_time']); ?></td>
                                        <td><?php echo $rs['percentage']."%"; ?></td>
                                        <td><?php echo ($rs['exist'] == 0) ? "否":"是"; ?></td>
                                        <td><?php if ($rs['exist'] == 1) {
                                            ?>
                                            <a class="btn btn-info btn-sm" target="_blank" href="<?php echo $rs['down_link']; ?>">下载</a>
                                            <a class="btn btn-danger btn-sm" onclick="JavaScript:return confirm('确定删除吗？')" href="_downloads.php?type=delete&id=<?php echo $rs['id']; ?>&uid=<?php echo $rs['uid'];?>">删除</a>
                                            <?php
                                        }elseif($rs['exist'] == 0 and $rs['down_link'] =='fail' ){ ?>
                                            <a class="btn btn-danger btn-flat disabled">下载失败</a>
                                          <?php
                                        }else{ ?>
                                            <a class="btn btn-success btn-flat disabled">无法操作</a>
                                          <?php } ?>                                     </td>
                                    </tr>
                                   <?php 
                                   }?>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    <div id="bottom" align="center">
						<form action="downloads.php" method="get">
                            <a href="<?php echo '?page=1&all='.$all; ?>"> 首页 &nbsp;&nbsp;&nbsp;</a>
							<a href="<?php echo '?page='.($page-1).'&all='.$all; ?>">&lt;&lt;<?php echo $page-1; ?>&lt;&lt;&nbsp;</a>
							<input class="form-control" style="text-align:center;width:40px;height:25px;display:inline;" name="page" value="<?php echo $page;?>">
                            <a href="<?php echo '?page='.($page+1).'&all='.$all; ?>"> &nbsp;&gt;&gt;<?php echo $page+1; ?>&gt;&gt;</a>
                            <a href="<?php echo '?page='.$tpages.'&all='.$all; ?>">&nbsp;&nbsp;&nbsp;尾页 </a>
						</form>
					</div>
                </div>
            </div>
        </section><!-- /.content -->        
    </div><!-- /.content-wrapper -->

<!-- jQuery 2.1.3 -->
<script src="../asset/js/jQuery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../asset/js/bootstrap.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="../asset/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../asset/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../asset/js/app.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
         function addmission(){
            $.ajax({
                type:"POST",
                url:"_downloads.php",
                dataType:"json",
                data:{
                    file_name: $("#file_name").val(),
                    file_url: $("#file_url").val()
                },
                success:function(data){
                    if(data.ok){
                        $("#msg-error").hide(100);
                        $("#msg-success").show(100);
                        $("#msg-success-p").html(data.msg);
                        location.reload(true);
                    }else{
                        $("#msg-error").hide(10);
                        $("#msg-error").show(100);
                        $("#msg-error-p").html(data.msg);
                    }
                },
                error:function(jqXHR){
                    $("#msg-error").hide(10);
                    $("#msg-error").show(100);
                    $("#msg-error-p").html("发生错误："+jqXHR.status);
                }
            });
        }
        $("html").keydown(function(event){
            if(event.keyCode==13){
                addmission();
            }
        });
        $("#add").click(function(){
            addmission();
        });
        $("#ok-close").click(function(){
            $("#msg-success").hide(100);
        });
        $("#error-close").click(function(){
            $("#msg-error").hide(100);
        });
    })
</script>

<?php
require_once '_footer.php'; ?>
