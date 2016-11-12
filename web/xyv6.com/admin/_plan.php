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
}
elseif ($rs['plan'] == 'E') {//20yuan
	echo "VPN";
}
else{
	echo "Beta";
}
?>
