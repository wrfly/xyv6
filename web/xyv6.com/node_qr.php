<?php
require_once 'lib/config.php';
require_once '_check.php';
$id = $_GET['id'];
$node = new \Ss\Node\NodeInfo($id);
$type = isset($_GET['type']) ? $_GET['type'] : 6;
	if ( $type == 4 ) {
		$server =  $node->Server_v4();
	}else
		$server =  $node->Server();

$name =  $node->name();
$method = $node->Method();
$pass = htmlspecialchars($oo->get_pass());
$port = $oo->get_port();
$plan = $oo->get_plan();
$node_type = $node->type();

$ssurl =  $method.":".$pass."@".$server.":".$port;
if ( $node_type == 1 && $plan == 'C') $ssurl="x:y:v:6:6";
$ssqr = "ss://".base64_encode($ssurl);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $name;?> 节点二维码</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="xyv6.png">
<style type="text/css">
.text a{color:#c33;}
#infscr-loading{text-align:center;margin:auto;}
body{background-color:#7d9eae;}
body{
	background-attachment:fixed;
	background-size:contain;
	_background-image:none;
}
</style>

<style>
	.popo{position:absolute;opacity:0;visibility:hidden;background:#eee;box-shadow:0 0 6px rgba(0,0,0,0.2) inset;-webkit-border-radius:50%;-moz-border-radius:50%;border-radius:50%;}

	#popo1{-webkit-animation:move6 80s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move6 80s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move6 80s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo2{-webkit-animation:move2 60s cubic-bezier(0.3,0.3,0.2,0.2) 1s infinite alternate;-moz-animation:move2 60s cubic-bezier(0.3,0.3,0.2,0.2) 1s infinite alternate;animation:move2 60s cubic-bezier(0.3,0.3,0.2,0.2) 1s infinite alternate;}
	#popo3{-webkit-animation:move3 50s cubic-bezier(0.1,0.1,0.2,0.2) 1s infinite alternate;-moz-animation:move3 50s cubic-bezier(0.1,0.1,0.2,0.2) 1s infinite alternate;animation:move3 50s cubic-bezier(0.1,0.1,0.2,0.2) 1s infinite alternate;}
	#popo4{-webkit-animation:move4 60s cubic-bezier(0.2,0.2,0.1,0.1) 1s infinite alternate;-moz-animation:move4 60s cubic-bezier(0.2,0.2,0.1,0.1) 1s infinite alternate;animation:move4 60s cubic-bezier(0.2,0.2,0.1,0.1) 1s infinite alternate;}
	#popo5{-webkit-animation:move5 120s cubic-bezier(0.3,0.3,0.2,0.2) 1s infinite normal;-moz-animation:move5 120s cubic-bezier(0.3,0.3,0.2,0.2) 1s infinite normal;animation:move5 120s cubic-bezier(0.3,0.3,0.2,0.2) 1s infinite normal;}
	#popo6{-webkit-animation:move1 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move1 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move1 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo7{-webkit-animation:move2 80s cubic-bezier(0.1,0.1,0.1,0.1) 1s infinite alternate;-moz-animation:move2 80s cubic-bezier(0.1,0.1,0.1,0.1) 1s infinite alternate;animation:move2 80s cubic-bezier(0.1,0.1,0.1,0.1) 1s infinite alternate;}
	#popo8{-webkit-animation:move1 90s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move1 90s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move1 90s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo9{-webkit-animation:move2 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move2 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move2 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}

	#popo10{-webkit-animation:move1 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move1 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move1 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo11{-webkit-animation:move2 60s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move2 60s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move2 60s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo12{-webkit-animation:move4 80s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move4 80s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move4 80s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo13{-webkit-animation:move1 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move1 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move1 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo14{-webkit-animation:move2 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move2 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move2 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo15{-webkit-animation:move1 60s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move1 60s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move1 60s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo16{-webkit-animation:move1 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move1 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move1 100s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}
	#popo17{-webkit-animation:move2 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;-moz-animation:move2 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;animation:move2 50s cubic-bezier(0.2,0.2,0.3,0.3) 1s infinite alternate;}

	@-webkit-keyframes move1{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.1;}
		30%{opacity:0.16;-webkit-transform:translate(80px,80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.18;-webkit-transform:translate(140px,160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.24;-webkit-transform:translate(240px,260px) scale(2) rotate(20deg);}
	}
	@-moz-keyframes move1{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.1;}
		30%{opacity:0.16;-moz-transform:translate(80px,80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.18;-moz-transform:translate(140px,160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.24;-moz-transform:translate(240px,260px) scale(2) rotate(20deg);}
	}
	@keyframes move1{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.1;}
		30%{opacity:0.16;transform:translate(80px,80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.18;transform:translate(140px,160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.24;transform:translate(240px,260px) scale(2) rotate(20deg);}
	}

	@-webkit-keyframes move2{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-webkit-transform:translate(-80px,-80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-webkit-transform:translate(-140px,-160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-webkit-transform:translate(-240px,-260px) scale(2) rotate(20deg);}
	}
	@-moz-keyframes move2{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-moz-transform:translate(-80px,-80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-moz-transform:translate(-140px,-160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-moz-transform:translate(-240px,-260px) scale(2) rotate(20deg);}
	}
	@keyframes move2{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;transform:translate(-80px,-80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;transform:translate(-140px,-160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;transform:translate(-240px,-260px) scale(2) rotate(20deg);}
	}

	@-webkit-keyframes move3{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-webkit-transform:translate(-80px,80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-webkit-transform:translate(-140px,160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-webkit-transform:translate(-240px,260px) scale(2) rotate(20deg);}
	}
	@-moz-keyframes move3{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-moz-transform:translate(-80px,80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-moz-transform:translate(-140px,160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-moz-transform:translate(-240px,260px) scale(2) rotate(20deg);}
	}
	@keyframes move3{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;transform:translate(-80px,80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;transform:translate(-140px,160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;transform:translate(-240px,260px) scale(2) rotate(20deg);}
	}

	@-webkit-keyframes move4{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-webkit-transform:translate(80px,-80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-webkit-transform:translate(140px,-160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-webkit-transform:translate(240px,-260px) scale(2) rotate(20deg);}
	}
	@-moz-keyframes move4{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-moz-transform:translate(80px,-80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-moz-transform:translate(140px,-160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-moz-transform:translate(240px,-260px) scale(2) rotate(20deg);}
	}
	@keyframes move4{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;transform:translate(80px,-80px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;transform:translate(140px,-160px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;transform:translate(240px,-260px) scale(2) rotate(20deg);}
	}

	@-webkit-keyframes move5{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;-webkit-transform:translate(0,-200px) scale(1.5) rotate(3deg);}
		30%{opacity:0.06;-webkit-transform:translate(0,-300px) scale(1.8) rotate(5deg);}
		50%{opacity:0.1;-webkit-transform:translate(0,-400px) scale(2.2) rotate(10deg);}
		100%{opacity:0.17;-webkit-transform:translate(0,-800px) scale(4) rotate(20deg);}
	}
	@-moz-keyframes move5{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;-moz-transform:translate(0,-200px) scale(1.5) rotate(3deg);}
		30%{opacity:0.06;-moz-transform:translate(0,-300px) scale(1.8) rotate(5deg);}
		50%{opacity:0.1;-moz-transform:translate(0,-400px) scale(2.2) rotate(10deg);}
		100%{opacity:0.17;-moz-transform:translate(0,-800px) scale(4) rotate(20deg);}
	}
	@keyframes move5{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;transform:translate(0,-200px) scale(1.5) rotate(3deg);}
		30%{opacity:0.06;transform:translate(0,-300px) scale(1.8) rotate(5deg);}
		50%{opacity:0.1;transform:translate(0,-400px) scale(2.2) rotate(10deg);}
		100%{opacity:0.17;transform:translate(0,-800px) scale(4) rotate(20deg);}
	}

	@-webkit-keyframes move6{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-webkit-transform:translate(60px,20px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-webkit-transform:translate(100px,40px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-webkit-transform:translate(160px,80px) scale(2) rotate(20deg);}
	}
	@-moz-keyframes move6{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;-moz-transform:translate(60px,20px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;-moz-transform:translate(100px,40px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;-moz-transform:translate(160px,80px) scale(2) rotate(20deg);}
	}
	@keyframes move6{
		0%{opacity:0;visibility:visible;}
		2%{opacity:0.04;}
		30%{opacity:0.06;transform:translate(60px,20px) scale(1.5) rotate(5deg);}
		50%{opacity:0.1;transform:translate(100px,40px) scale(1.6) rotate(10deg);}
		100%{opacity:0.17;transform:translate(160px,80px) scale(2) rotate(20deg);}
	}
</style>
</head>
<body>
	<br/><br/><br/><br/><br/><br/><br/>
	<div align="center">
		<h3><?php if ( $node_type == 1 && $plan == 'C') {
			echo "抱歉，您不是VIP用户，不能使用Pro节点，请购买套餐以使用Pro节点，谢谢。";
		}else{
			echo $name.'节点二维码';
		}
		?> </h3>
			<div id="qrcode"></div>
			<div id="info">
	    	<p><?php
	    	if ( $node_type == 1 && $plan == 'C')
	    			echo "抱歉，您不是VIP用户，不能使用Pro节点，请购买套餐以使用Pro节点，谢谢。";
				elseif ( $port == 0 )
						echo "对不起，您还没有获取端口，请先点击中户中心的“点击获取端口”以获取您的私有端口。";
	    	else
	    			echo "<code>".$ssurl."</code>";?></p>
			</div>
	</div>


<div class="bbg" style="height:100%;width:100%;">
	<div id="popo1" class="popo" style="height: 150px; width: 150px;; left:0;top:0;"></div>
	<div id="popo2" class="popo" style="height: 180px; width: 180px; right:0;bottom:0;"></div>
	<div id="popo3" class="popo" style="height: 90px; width: 90px; right:0;top:0;"></div>
	<div id="popo4" class="popo" style="height: 100px; width: 100px; left:0;bottom:0;"></div>
	<div id="popo5" class="popo" style="height: 82px; width: 82px; left:50%;top:50%;"></div>
	<div id="popo6" class="popo" style="height: 140px; width: 140px; left:0;top:50%;"></div>
	<div id="popo7" class="popo" style="height: 94px; width: 94px; right:0;top:50%;"></div>
	<div id="popo8" class="popo" style="height: 120px; width: 120px; left:50%;top:0;"></div>
	<div id="popo9" class="popo" style="height: 174px; width: 174px; left:50%;bottom:0;"></div>
	<div id="popo10" class="popo" style="height: 116px; width: 116px; left:25%;top:25%;"></div>
	<div id="popo11" class="popo" style="height: 140px; width: 140px; left:25%;bottom:25%;"></div>
	<div id="popo12" class="popo" style="height: 160px; width: 160px; right:25%;top:25%;"></div>
	<div id="popo13" class="popo" style="height: 120px; width: 120px; right:25%;bottom:25%;"></div>
	<div id="popo14" class="popo" style="height: 174px; width: 174px; left:25%;top:50%;"></div>
	<div id="popo15" class="popo" style="height: 116px; width: 116px; right:25%;top:50%;"></div>
	<div id="popo16" class="popo" style="height: 140px; width: 140px; left:50%;top:25%;"></div>
	<div id="popo17" class="popo" style="height: 100px; width: 100px; left:50%;bottom:25%;"></div>
</div>

<script src="asset/js/jQuery.min.js"></script>
<script src="asset/js/jquery.qrcode.min.js"></script>
<script>
    jQuery('#qrcode').qrcode("<?php echo $ssqr;?>");
</script>

</body></html>
