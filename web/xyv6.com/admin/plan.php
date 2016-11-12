<?php
if ($rs['plan'] == 'A') { //50yuan
	echo "VIP 160G";
}
elseif ($rs['plan'] == 'B') {//10yuan
	echo "VIP 30G";
}
elseif ($rs['plan'] == 'C') {
	echo "免费";
}
elseif ($rs['plan'] == 'G') {
	echo "VIP 400G";
}
elseif ($rs['plan'] == 'D') {//1yuan
	echo "1G";
}else{
	echo "Beta";
}
if ($rs['ovpn'] == 1) {
	echo " + Openvpn";
}
?>
</b></p>
	<select class="form-control" id="plan">
	<option value ="B">VIP 30G</option>
	<option value ="A">VIP 160G</option>
	<option value ="G">VIP 400G</option>
	<option value="D">1G体验</option>
	<option value="E">VPN</option>
	<option value ="C">免费</option>
	</select>
	<p></p>
<p>开通时长</p>
	<select class="form-control" id="month">
	<option value ="1">1个月</option>
	<option value ="2">2个月</option>
	<option value ="3">3个月</option>
	<option value ="4">4个月</option>
	<option value ="5">5个月</option>
	<option value ="6">6个月</option>
</select>
