<?php
if ($oo->get_plan() == 'A') {
echo "VIP-160G-半年";
}
elseif ($oo->get_plan() == 'B') {
echo "VIP-30G-包月";
}
elseif ($oo->get_plan() == 'C') {
echo "免费";
}
elseif ($oo->get_plan() == 'D') {
echo "1天体验";
}
elseif ($oo->get_plan() == 'G') {
echo "VIP-400G-包年";
}
else{
echo "Beta";
}

if ($oo->get_vpn() == '1') {
echo " + OpenVpn套餐";
}
