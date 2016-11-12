#!/usr/bin/python
# -*- coding: utf-8 -*-

import cymysql
import Config
import time
import os
import pause

node_number = Config.node_number

def update_node_speed():
    # 更新服务器网速
    while True:
        conn = cymysql.connect(host=Config.MYSQL_HOST, port=Config.MYSQL_PORT,
                               user=Config.MYSQL_USER, passwd=Config.MYSQL_PASS,
                               db=Config.MYSQL_DB, charset='utf8')
        cur = conn.cursor()
        # interface
        iface = Config.iface
        # before
        net_rx_before = os.popen('ifconfig '+iface+'|grep bytes|cut -d \":\" -f 2|cut -d \" \" -f 1').read()
        time.sleep(1)
        # after
        net_rx_after = os.popen('ifconfig '+iface+'|grep bytes|cut -d \":\" -f 2|cut -d \" \" -f 1').read()
        # calculate
        speed = (int(net_rx_after) - int(net_rx_before)) / 1024
        # unit
        unit=" K"
        if speed > 1024:unit=" M";speed= speed / 1024
        node_speed = str(speed)+unit+'B/s'
        # update
        net_query_sql = 'UPDATE ss_node set node_speed=\'' + node_speed + \
            '\' where id=\'' + str(node_number) + '\';'
        cur.execute(net_query_sql)
        conn.commit()
        cur.close()
        conn.close()

def update_user():
    # 更新用户套餐
    while True:
        pause.minutes(1)
        conn = cymysql.connect(host=Config.MYSQL_HOST, port=Config.MYSQL_PORT,
                               user=Config.MYSQL_USER, passwd=Config.MYSQL_PASS,
                               db=Config.MYSQL_DB, charset='utf8')
        cur = conn.cursor()
        # 体验套餐流量用完后变成免费套餐
        net_query_sql = 'UPDATE user set plan=\'C\',u=0, money = 0, d=0, transfer_enable=\'3221225472\' where transfer_enable-u-d < 10240 and plan = \'D\';'
        cur.execute(net_query_sql)
        conn.commit()

        # A/B/D/G 套餐到期后变成免费套餐
        net_query_sql = 'UPDATE user set plan=\'C\', money=0, u=0, d=0, transfer_enable=\'3221225472\' where vip_end_time < '+str(int(time.time()))+' and ( plan = \'A\' or plan = \'B\' or plan = \'D\' or plan = \'G\' );'
        cur.execute(net_query_sql)
        conn.commit()

        # B 套餐每月减少money和更新流量
        net_query_sql = 'UPDATE user set money=money-10, vip_month=vip_month-1, u=0, d=0, transfer_enable=\'32212254720\' where vip_end_time-(3600*24*31*( vip_month - 1 )) < '+str(int(time.time()))+' and plan = \'B\';'
        cur.execute(net_query_sql)
        conn.commit()

        # 更新用户在线信息
        net_query_sql = 'UPDATE user set w_n = 0 where t + 20 < '+str(int(time.time()))+';'
        cur.execute(net_query_sql)
        conn.commit()

        cur.close()
        conn.close()

class email_alert(object):
    """docstring for email_alert"""
    def __init__(self):
        self.SENDGRID_API_KEY = 'SG.www--www.www'
        while 1:
            self.conn = cymysql.connect(host=Config.MYSQL_HOST, port=Config.MYSQL_PORT, user=Config.MYSQL_USER, passwd=Config.MYSQL_PASS,db=Config.MYSQL_DB, charset='utf8')
            self.cur = self.conn.cursor()

            self.scan_users()

            self.conn.commit()
            self.cur.close()
            self.conn.close()
            pause.minutes(10)

    def update_mail_status(self, uid, value):
        self.cur.execute('UPDATE user set email_status = email_status %s where uid = %s' % (value, uid) ) # value = +1 +2 -1 -2
        self.conn.commit()

    def send_vip_alert(self, uid):
        self.send_email(uid, 0)

    def send_bandwidth_alert(self, uid):
        self.send_email(uid, 1)

    def scan_users(self):
        # update vip +2
        self.cur.execute('SELECT uid FROM user where plan != \'C\' and plan != \'D\' and email_status != 2 and email_status != 3 and vip_end_time - 3600*24*2 <'+str(int(time.time())))
        for uid in self.cur.fetchall():
            uid = str(uid[0])
            self.send_vip_alert(uid)
            self.update_mail_status(uid, '+2')

        # update bandwidth +1
        self.cur.execute('SELECT uid FROM user where email_status != 1 and email_status != 3 and transfer_enable - u - d < 1024*1024*100')
        for uid in self.cur.fetchall():
            uid = str(uid[0])
            self.send_bandwidth_alert(uid)
            self.update_mail_status(uid, '+1')

        # update vip -2
        self.cur.execute('SELECT uid FROM user where plan != \'C\' and plan != \'D\' and (email_status = 2 or email_status = 3) and vip_end_time - 3600*24*2 > '+str(int(time.time())))
        for uid in self.cur.fetchall():
            uid = str(uid[0])
            self.update_mail_status(uid, '-2')

        # update bandwidth -1
        self.cur.execute('SELECT uid FROM user where (email_status = 1 or email_status = 3) and transfer_enable - u - d > 1024*1024*100')
        for uid in self.cur.fetchall():
            uid = str(uid[0])
            self.update_mail_status(uid, '-1')

    def get_user_info(self, uid):
        # (u'admin', u'mr@xyv6.com', 1463937527L, u'B', 39181999827L)
        # row[0], row[1], row[2], row[3], row[4]
        self.cur.execute('select user_name, email, vip_end_time, plan, transfer_enable - u - d from user where uid = %s' % uid )
        return self.cur.fetchone()

    def send_email(self, uid, alert_type):
        import datetime
        now = str(datetime.datetime.now())[:19]
        user_name, user_email, vip_end_time, plan, transfer_remain = self.get_user_info(uid)
        vip_end_time = str(datetime.datetime.fromtimestamp(vip_end_time))
        if plan == 'A':
            plan_name = "VIP-160G-半年"
        elif plan == 'B':
            plan_name = 'VIP-30G-包月'
        elif plan == 'G':
            plan_name = 'VIP-400G-包年'

        sg = sendgrid.SendGridClient(self.SENDGRID_API_KEY)
        message = sendgrid.Mail()
        message.add_to(user_email)
        message.set_from("no-reply@xyv6.com")
        message.set_from_name('校园V6')
        if alert_type == 1:
            message.set_subject('用户流量提醒 | Bandwidth Alert')
            message.set_html("截止到 "+str(now)+", 您的校园V6账户\""+str(user_name)+"\"剩余流量为 "+str(transfer_remain/1024/1024)+"MB, 为了不影响您的正常使用，建议您及时签到获取流量，或者购买流量加油包。<br />再次感谢您选择校园V6!<br />")
        else:
            message.set_subject('VIP到期提醒 | VIP Alert')
            message.set_html("截止到 "+str(now)+", 您的校园V6账户 "+str(user_name)+" 所购买的 \""+ plan_name +"套餐\" 将于<b>"+ vip_end_time +"</b>到期, 剩余流量为 <b>"+str(transfer_remain/1024/1024)+"MB</b>, 为了不影响您的正常使用，建议您及时续费。<br />再次感谢您选择校园V6!<br /> ")

        message.add_filter('templates', 'enable', '1')
        message.add_filter('templates', 'template_id', '41d21bb1-f061-4311-84c9-eef7a58221bf')
        sg.send(message)

if __name__ == '__main__':
    pass
