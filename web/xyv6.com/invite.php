<?php
require_once '_main.php';

$invite = new \Ss\User\Invite($uid);
$code = $invite->CodeArray();
?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                邀请返利
                <small>Invite And Earn!</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-body">
                            <?php // 邀请链接
                            if( $U->Can_gen_link() == 1){ ?>
                                <button id="gen_link" class="btn btn-sm btn-info">生成我的邀请链接</button>
                            <?php }else{ ?>
                                <p></p>
                                <p>我的邀请链接是：<p></p>
                                <input readonly class="form-control" value="http://xiaoyuanv6.com/user/reg.php?ref=<?php echo $U->Get_link_code();?>">
                                    <p></p>
                                    <a target="_blank" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=https%3A%2F%2Fxiaoyuanv6.com%2Fuser%2Freg.php%3fref%3d<?php echo $U->Get_link_code();?>&showcount=1&summary=%E6%A0%A1%E5%9B%AD%E7%BD%91%E6%B5%81%E9%87%8F%E4%B8%8D%E5%A4%9F%E7%94%A8%EF%BC%9F%E8%AF%95%E8%AF%95%E6%A0%A1%E5%9B%ADV6%E5%90%A7%EF%BC%81%E9%80%9A%E8%BF%87IPv6%E4%B8%8A%E7%BD%91%EF%BC%8C%E4%B8%8D%E6%B6%88%E8%80%97%E5%8F%AF%E6%80%9C%E7%9A%84%E6%B5%81%E9%87%8F%EF%BC%8C%E6%9B%B4%E6%B2%A1%E6%9C%89%E5%B8%A6%E5%AE%BD%E9%99%90%E5%88%B6&desc=%E8%BF%99%E6%98%AF%E6%88%91%E7%9A%84%E9%82%80%E8%AF%B7%E9%93%BE%E6%8E%A5%EF%BC%8C%E6%B3%A8%E5%86%8C%E5%B0%B1%E6%9C%8910G%E6%B5%81%E9%87%8F%E5%91%A2!&title=%E6%A0%A1%E5%9B%ADV6%20|%20%E4%B8%80%E4%B8%AA%E5%B8%AE%E4%BD%A0%E4%B8%8A%E7%BD%91%E7%9A%84%E7%BD%91%E7%AB%99&site=%E6%A0%A1%E5%9B%ADV6&pics=https%3A%2F%2Fxiaoyuanv6.com%2Fuser%2Fasset%2Fimg%2Flogo2.jpg&style=202&width=105&height=31&otype=share">
                                        <img style="padding-left:10px;" src="asset/img/intro.png" title="分享到QQ空间" >
                                    </a>
                                    <a target="_blank" href="http://service.weibo.com/share/share.php?url=http%3A%2F%2Fopen.weibo.com%2Fsharebutton&type=button&ralateUid=5692553634&language=zh_cn&title=%E6%A0%A1%E5%9B%AD%E7%BD%91%E6%B5%81%E9%87%8F%E4%B8%8D%E5%A4%9F%E7%94%A8%EF%BC%9F%E8%AF%95%E8%AF%95%E6%A0%A1%E5%9B%ADV6%E5%90%A7%EF%BC%81%E9%80%9A%E8%BF%87IPv6%E4%B8%8A%E7%BD%91%EF%BC%8C%E4%B8%8D%E6%B6%88%E8%80%97%E5%8F%AF%E6%80%9C%E7%9A%84%E6%B5%81%E9%87%8F%EF%BC%8C%E6%9B%B4%E6%B2%A1%E6%9C%89%E5%B8%A6%E5%AE%BD%E9%99%90%E5%88%B6%E3%80%82%E8%BF%99%E6%98%AF%E6%88%91%E7%9A%84%E9%82%80%E8%AF%B7%E9%93%BE%E6%8E%A5%EF%BC%9Ahttps%3A%2F%2Fxiaoyuanv6.com%2Fuser%2Freg.php%3Fref=<?php echo $U->Get_link_code();?> %EF%BC%8C%E6%B3%A8%E5%86%8C%E5%B0%B1%E9%80%8110%E4%B8%AAG%E3%80%82&pic=https%3A%2F%2Fxiaoyuanv6.com%2Fuser/%2Fasset%2Fimg%2Flogo2.jpg&searchPic=false&style=simple">
                                        <img style="padding-left:10px;" src="asset/img/WB_logo.png" title="分享到微博" >
                                    </a>
                                </p>
                            <?php } ?>
                            <p></p>
                            <div id="msg-error" class="alert alert-warning alert-dismissable" style="display:none">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-warning"></i> 出错了!</h4>
                                <p id="msg-error-p"></p>
                            </div>
                            <h4>共邀请<?php echo $U->GetRefCount($uid);?>个好友,
                            <b>累计返利 <?php echo $U->GetTotalEarned();?> 元,
                            累计提现 <?php echo $U->GetEarnedMoney();?> 元</b></h4>
                        </div><!-- /.box -->
                    </div>
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">支付宝账号绑定/修改</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <input type="text" id="aa" placeholder="请输入您的支付宝账号" class="form-control"  >
                            <h4>您当前绑定的支付宝账号为：</h4>
                            <h4 align="center"><code><b><?php echo htmlspecialchars($U->GetAliapyAccount());?></b></code></h4>

                        </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" id="aa_update" class="btn btn-primary" >修改</button>
                    </div>

                    </div><!-- /.box -->
                </div><!-- /.col (right) -->
                </div>

                <div class="col-md-6">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="callout callout-info">
                                <h4>说明</h4>
                                <p>把邀请链接分享给您的朋友。</p>
                                <p>每邀请一个有效用户注册，系统就会赠送您3G流量。</p>
				<p>邀请获得的流量将会在下个套餐周期清零。</p>
				<h4>每邀请一位付费用户，您即可获得5元的赏金，赏金累计50元，即可申请提现，打到您的支付宝账户.</h4>
                            </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col (right) -->




                </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once '_footer.php'; ?>

<script>
    $(document).ready(function(){
        $("#invite").click(function(){
            $.ajax({
                type:"GET",
                url:"_invite.php",
                dataType:"json",
                success:function(data){
                    if(data.ok){
                        window.location.reload();
                    }else{
                        $("#msg-error").show();
                        $("#msg-error-p").html(data.msg);
                    }
                },
                error:function(jqXHR){
                    alert("发生错误："+jqXHR.status);
                }
            })
        })
    })
    $(document).ready(function(){
        $("#gen_link").click(function(){
            $.ajax({
                type:"GET",
                url:"_gen_link.php",
                dataType:"json",
                success:function(data){
                    if(data.ok){
                        window.location.reload();
                    }else{
                        alert(1);
                    }
                },
                error:function(jqXHR){
                    alert("发生错误："+jqXHR.status);
                }
            })
        })
    })
    $(document).ready(function(){
        $("#aa_update").click(function(){
            $.ajax({
                type:"POST",
                url:"_info_update.php",
                dataType:"json",
                data:{
                    aa: $("#aa").val()
                },
                success:function(data){
                    if(data.ok){
                        window.location.reload();
                    }else{
                        $("#msg-error").show();
                        $("#msg-error-p").html(data.msg);
                    }
                },
                error:function(jqXHR){
                    alert("发生错误："+jqXHR.status);
                }
            })
        })
    })
</script>
