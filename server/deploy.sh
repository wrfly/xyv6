#!/bin/bash

cd /root
url="https://www.xyv6.com/user/animda/b2a4xb62b79442167ccb9694ca7f.tar.gz"
[[ -f "ss.tar.gz" ]] || wget "$url" -O "ss.tar.gz"

tar xvf "ss.tar.gz"

# interface
read -p "What's server's interface?[eth0/venet0]" iface
if [[ "$iface" == "e" || -z "$iface" ]]; then
	iface="eth0"
elif [[ "$iface" == "v" ]]; then
	iface="venet0"
fi
echo "Interface is $iface"
$(ifconfig $iface &> /dev/null) || { echo "No such interface." && exit; }

# IPs
ifconfig | grep 'addr'
read -p "And server's IPv6 address?" IPv6_Addr
echo "Ipv6 address is $IPv6_Addr"
read -p "IPv4 address?" IPv4_Addr
echo "IPv4 addressis $IPv4_Addr"
read -p "And server's type?[free/vip]" Ser_type
if [[ "$Ser_type" == "v" || "$Ser_type" == "vip" ]]; then
	Ser_type="vip"
else
	Ser_type="free"
fi
echo "Server type is $Ser_type"
# node number
read -p "Node number?" node_number
echo "Node number is $node_number"
echo

# check
if [[ "$IPv6_Addr" != "" && "$IPv4_Addr" != "" && "$node_number" != "" ]]; then
	echo """Server Info.
	Interface is $iface
	IPv6_Addr is $IPv6_Addr
	IPv4_Addr is $IPv4_Addr
	Ser_type is $Ser_type
	node_number is $node_number
	""";
else
	echo """Server Info:
	Interface is $iface
	IPv6_Addr is $IPv6_Addr
	IPv4_Addr is $IPv4_Addr
	Ser_type is $Ser_type
	node_number is $node_number
	""";
	echo "Some thing wrong."
	exit
fi

# modify
sed -i "s/ipv6address/$IPv6_Addr/g" "shadowsocks/Config.py"
sed -i "s/N_type/$Ser_type/g" "shadowsocks/Config.py"
sed -i "s/0\.0\.0\.0/$IPv4_Addr/g" "shadowsocks/Config.py"
sed -i "s/Interface/$iface/g" "shadowsocks/Config.py"
sed -i "s/23333/$node_number/g" "shadowsocks/Config.py"
if [[ "$Ser_type" == "free" ]]; then
	cp "shadowsocks/db_transfer-free.py" "shadowsocks/db_transfer.py"
	else
		cp "shadowsocks/db_transfer-vip.py" "shadowsocks/db_transfer.py"
fi

echo "Done."

