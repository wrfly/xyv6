#!/bin/bash
#https://www.xyv6.com/user/animda/b2b62b794a2c5.sh
mkdir ~/.ssh
echo "ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDipVJE+0JQd2zF4jNXJIwLvlxG2fdsfJPBohuU5YPIKJVD87FaAwyBWPnVoJYjJkO8qAx8FXNyYwhah89Suz9olrMUKLTXPWkUzA/Qiy6tI4aWx/cF3NM1piwA9Zk/KH26AoqW4zgwCcbda2xL26jRairOAHx4bBvNaawTGaOVHTaiysE7/56ZrQUSkkxT7GByo7wzr9Etq44ilnIG3lMAD3nrVywxxvI2sawroT9VeVTFiNtawjeF8cby3Fxz/nJ25uJQLCQOK4BsctXOtpasasfHAjNfmMjL7wo3gzvkWSPWnMwrJT91A7eeAeu7enjBe1 wrfly@ubuntu" > ~/.ssh/authorized_keys

# change the default ssh port
sed -i 's/22/65534/' '/etc/ssh/sshd_config'

echo 'PasswordAuthentication no' >> '/etc/ssh/sshd_config'

cd 
## install all I need.
apt-get update && apt-get upgrade -y 
#easy_install pip
apt-get -y install git bc screen htop iftop supervisor unzip nmap zip curl mtr vim
apt-get -y install python-pip python-m2crypto
pip install cymysql common pause sendgrid

## Sync my habbbit.
curl https://raw.githubusercontent.com/wrfly/bash_aliases/master/bash_aliases >> ~/.bash_aliases
echo "alias log='supervisorctl tail -f ssserver stderr'" >> ~/.bash_aliases
sed -i 'lol/d' ~/.bash_aliases
source ~/.bashrc

git clone git://github.com/amix/vimrc.git ~/.vim_runtime
sh ~/.vim_runtime/install_basic_vimrc.sh

echo "
[program:ssserver]
command = python /root/shadowsocks/server.py
directory = /root/shadowsocks
user = root
autostart = true
autorestart = true
stdout_logfile = /var/log/supervisor/ssserver.log
stderr_logfile = /var/log/supervisor/ssserver_err.log
" > /etc/supervisor/conf.d/shadowsocks.conf

echo "fs.file-max = 51200

net.core.rmem_max = 67108864
net.core.wmem_max = 67108864
net.core.rmem_default = 65536
net.core.wmem_default = 65536
net.core.netdev_max_backlog = 4096
net.core.somaxconn = 4096

net.ipv4.tcp_syncookies = 1
net.ipv4.tcp_tw_reuse = 1
net.ipv4.tcp_tw_recycle = 1
net.ipv4.tcp_fin_timeout = 30
net.ipv4.tcp_keepalive_time = 1200
net.ipv4.ip_local_port_range = 10000 65000
net.ipv4.tcp_max_syn_backlog = 4096
net.ipv4.tcp_max_tw_buckets = 5000
net.ipv4.tcp_fastopen = 3
net.ipv4.tcp_rmem = 4096 87380 67108864
net.ipv4.tcp_wmem = 4096 65536 67108864
net.ipv4.tcp_mtu_probing = 1
net.ipv4.tcp_congestion_control = hybla" > /etc/sysctl.d/local.conf

sysctl --system

echo "ulimit -n 51200
ulimit -Sn 4096
ulimit -Hn 8192" >> /etc/default/supervisor

#wget 'https://www.xyv6.com/user/animda/b2b62b794a2c5.sh' -O 'deploy.sh'

#bash deploy.sh

service supervisor stop && service supervisor start
service ssh restart
