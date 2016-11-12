#!/bin/bash
SS_NODES='servers.servers'

START='{
    "configs": ['
END='    ],
    "localPort": 1080,
    "shareOverLan": false,
    "global" : true,
    "enabled" : true
}'

HEAD='{
    "method": "aes-256-cfb",
    "password": "pwd",'
    # "remarks": "sgp-f1",
    # "server": "188.166.236.90",
TAIL='    "server_port": 10000
},'

m=1
for i in `cat $SS_NODES`; do
	if [[ $m -eq 1 ]]; then
		echo -n $HEAD "\"remarks\": \"$i-ipv6\","
		server=$i
	fi
	if [[ $m -eq 2 ]]; then
		echo "\"server\": \"$i\"," $TAIL
	fi
	if [[ $m -eq 3 ]]; then
		echo -e $HEAD "\"remarks\": \"$server-ipv4\",\"server\": \"$i\"," $TAIL
		m=0
	fi
	let m+=1
done > all_servers

REMOVE(){
LAST_LINE=`tail -1 $1`
sed -i '$d' $1
echo $LAST_LINE | sed "s/},/}/g" >> $1
}

GENERATE_CONFIG(){
	echo $START > $2
	cat $1 >> $2
	echo $END >> $2
}

GENERATE(){
	REMOVE $1
	GENERATE_CONFIG $1 $1.json
	rm -f $1
}

# vip
cat all_servers > z-vip-config
GENERATE z-vip-config

# vip-ipv4
grep "ipv4" all_servers > z-vip-config4
GENERATE z-vip-config4

# vip-ipv6
grep "ipv6" all_servers > z-vip-config6
GENERATE z-vip-config6

# free
grep -E '\-f.' all_servers > z-free-config
GENERATE z-free-config

# free-ipv4
grep -E "\-f.-ipv4" all_servers > z-free-config4
GENERATE z-free-config4

# free-ipv6
grep -E "\-f.-ipv6" all_servers > z-free-config6
GENERATE z-free-config6

# clean
rm -f all_servers