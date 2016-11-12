<?php
require_once '_main.php';
?>
<iframe height="0" width="0" src="https://tfsimg.alipay.com/"/></iframe>
<iframe height="0" width="0" src="https://mobilecodec.alipay.com/show.htm"/></iframe>
    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                套餐价格
                <small>Plans &amp; Prices ps:购买时必须连接外网，否则无法显示二维码。</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">VIP-30G套餐</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <b>￥10</b> <del><b>￥12</b></del>，<b>30G</b>流量，包月可叠加，不限客户端。(￥0.33/G)
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            立即购买：
                            <select id="month" style="width:50px; padding:5px; border-radius:0; text-indent: 5px;">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>个月
                            <button type="submit" id="buy_B" class="btn btn-primary">30G套餐</button>
                        </div><!-- /.box-footer-->
                    </div><!-- /.box -->

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">15G流量加油包（非VIP勿买）</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <b>￥5</b>，<b>15G</b>流量，仅限本套餐周期内使用，下个周期将会失效。(￥0.33/G)
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                           立即购买：<button type="submit" id="buy_F" class="btn btn-primary">15G流量</button>
                        </div><!-- /.box-footer-->
                    </div><!-- /.box -->

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">VIP-160G套餐</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <b>￥50</b> <del><b>￥60</b></del>，<b>160G</b>流量，可用6个月，不限客户端。(￥0.30/G)
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                           立即购买：<button type="submit" id="buy_A" class="btn btn-primary">160G套餐</button>
                        </div><!-- /.box-footer-->
                    </div><!-- /.box -->


                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">VIP-400G套餐</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <b>￥99</b> <del><b>￥120</b></del>，<b>400G</b>流量，可用12个月，不限客户端。(￥0.24/G)
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                           立即购买：<button type="submit" id="buy_G" class="btn btn-primary">400G套餐</button>
                        </div><!-- /.box-footer-->
                    </div><!-- /.box -->

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">体验套餐</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <b>￥1</b>，<b>1G</b>流量，24小时内可用任意Pro节点。到期后自动切换为免费套餐。
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            立即购买：<button type="submit" id="buy_D"class="btn btn-primary">体验套餐</button>
                        </div><!-- /.box-footer-->
                    </div><!-- /.box -->
                </div>
                <div class="col-md-6">
                    <div class="callout callout-info">
                        <h4>说明</h4>
                        <p></p>
                        <p title="对！就是三天～">除体验套餐外，所有套餐均可三天无理由退款。</p>
                        <p title="对！">OpenVPN套餐暂停出售。</p>
                        <p title="就是这样！">VIP期间内邀请好友所获得的流量到下个月会被清零。</p>
                        <p>附：<a target="_blank" href="https://xiaoyuanv6.com/wp-content/uploads/files/Shadowsocks_v2.10.3.apk" style="text-decoration:none;">安卓手机端-Shadowsocks-2.10.3</a></p>
                    </div>
                    <div class="callout callout-warning">
                        <h4>注意</h4>
                        <p></p>
                        <p title="逗不逗？">如果您已经购买了VIP套餐，您可以在VIP期间内再次购买相同套餐，VIP的时间会累加，但是如果您要更换套餐，
                        请务必等到VIP到期后再购买，否则会造成套餐混乱，如果您硬是要这样做，将以最后一次购买的套餐为准。</p>
                        <p title="嗯！">续费30G套餐将会获得额外5G流量。</p>
                        <p title="嗯！">新购15G流量将会立即获得，下个周期失效。</p>
                        <p title="嗯！">并不是购买了VIP就能马上嗖嗖的下载,还需要您手动选择Pro节点才可以.</p>
                    </div>
                </div>
            </div>
        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

<?php
require_once '_footer.php'; ?>

<script>
$(document).ready(function(){
    function clickHindler() {
        var strId = '' + this.id;
        var planValue = '';
        switch(strId[4]) {
            case 'A' : 
                planValue = 'VIP 160G套餐';
                break;
            case 'B' : 
                planValue = 'VIP 30G套餐';
                break;
            case 'D' : 
                planValue = '体验套餐';
                break;
            case 'F' : 
                planValue = '15G流量加油包';
                break;
            case 'G' : 
                planValue = 'VIP 400G套餐';
                break;
        }
        var loading = layer.load(0, {shade: false});
        $.ajax({
            type:"POST",
            url:"buy/_buy.php",
            dataType:"json",
            data:{
                uid: <?php echo $U->GetUid();?>,
                plan: strId[4],
                month: $("#month").val()
            },
            success:function(data){
                layer.close(loading);
                layer.confirm('您确定购买 '+ planValue +' 吗？', {
                    title: '确认提示',
                    btn: ['确定','取消'] //按钮
                    }, function(){
                        var loading = layer.load(0, {shade: false});
                        layer.open({
                            type: 1,
                            title: false,
                            area: ['330px', '360px'],
                            shade: 0.8,
                            closeBtn: true,
                            shadeClose: false,
                            content: '<div align=\"center\">\
                            <img src=\"'+data.qr_code_url+'\"/>\
                            <p>购买套餐：\"'+data.subject+'\"</p>\
                            <p>共需支付：<b>'+data.total_amount+'</b>元 | \
                            用户邮箱：<code><?php echo $U->GetEmail(); ?></code></p>\
                            <small>支付成功后刷新页面查看自己的套餐信息</small></div>\
                            '
                        });
                        layer.msg('扫描二维码完成支付', {icon: 6, time: 800});
                        layer.close(loading);
                }, function(){
                    layer.msg('>_< 不买你点我干什么 >_<', {shift: 6});
                });
            },
            error:function(jqXHR){
                alert("发生错误："+jqXHR.status);
            }
        })
    }

    $("#buy_B").click(clickHindler);
    $("#buy_G").click(clickHindler);
    $("#buy_F").click(clickHindler);
    $("#buy_A").click(clickHindler);
    $("#buy_D").click(clickHindler);

})

</script>
