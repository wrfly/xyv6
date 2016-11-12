<?php
/**
 * User Shadowsocks  info Class
 * @author  orvice <orvice@gmail.com>
 */
namespace Ss\User;

class Ss {
    //
    public  $uid;
    public $db;

    function  __construct($uid=0){
        global $db;
        $this->uid = $uid;
        $this->db  = $db;
    }

    //user info array
    function get_user_info_array(){
        $datas = $this->db->select("user","*",[
            "uid" => $this->uid,
            "LIMIT" => "1"
        ]);
        return $datas[0];
    }

    //返回端口号
    function  get_port(){
         return $this->get_user_info_array()['port'];
    }

    //获取流量
    function get_transfer(){
        return $this->get_user_info_array()['u']+$this->get_user_info_array()['d'];
    }

    //返回密码
    function  get_pass(){
        return $this->get_user_info_array()['passwd'];
    }

    //返回Plan
    function  get_plan(){
        return $this->get_user_info_array()['plan'];
    }
    //if VPN
    function  get_vpn(){
        return $this->get_user_info_array()['ovpn'];
    }

    //返回transfer_enable
    function  get_transfer_enable(){
        return $this->get_user_info_array()['transfer_enable'];
    }

    //get money
    function  get_money(){
        return $this->get_user_info_array()['money'];
    }

    //VIP结束时间
    function  vip_end_time(){
        return $this->get_user_info_array()['vip_end_time'];
    }

    //VIP开通时间
    function  vip_start_time(){
        return $this->get_user_info_array()['vip_start_time'];
    }

    //get enabled
    function  get_enabled(){
        return $this->get_user_info_array()['enable'];
    }

    //get enabled
    function  enable(){
        $this->db->update("user",[
            "enable" => 1
            ],[
            "uid" => $this->uid
            ]);
    }

    //get unused traffic
    function unused_transfer(){
        //global $dbc;
        return $this->get_transfer_enable() - $this->get_transfer();
    }

    //get last time
    function get_last_unix_time(){
        return $this->get_user_info_array()['t'];
    }

    //get last check in time
    function get_last_check_in_time(){
        return  $this->get_user_info_array()['last_check_in_time'];
    }

    //check is able to check in
    function is_able_to_check_in(){
        // $today = strtotime(date('Y-m-d', time()));
        $now = time();
        if( $this->get_last_check_in_time() + 3600*21 < $now ){
        // if( $this->get_last_check_in_time() < $today ){
            return 1;
        }else{
            return 0;
        }
    }

    //check is able to get a new port
    function is_able_to_get_port(){
        if( $this->get_port() == 0 ){
            return 1;
        }else{
            return 0;
        }
    }

    //get a new port
    function get_new_port(){
        //select a unused port
        $new_port = $this->db->select("port_pool","port",[
            "used" => 0,
            "LIMIT" => 1
            ]);
        //update user
        $this->db->update("user",[
            "port" => $new_port['0'],
            "valid" => 1 //用户为有效用户，至少邮箱是有效的
        ],[
            "uid" => $this->uid
        ]);
        //update port_pool
        $this->db->update("port_pool",[
            "used" => 1
        ],[
            "port" => $new_port['0']
        ]);

        return $new_port['0'];
    }

    //update last check_in time
    function update_last_check_in_time(){
        $now = time();
        $this->db->update("user",[
            "last_check_in_time" => $now
        ],[
            "uid" => $this->uid
        ]);
    }

    //add transfer 添加流量
    function add_transfer_to_ref(){
        $valid = $this->get_user_info_array()['valid'];
        $ref = $this->get_user_info_array()['ref_by'];
        if ( $valid == 0 && $ref != 0 ) {
            $this->db->update("user",[
                "transfer_enable[+]" => 3221225472
            ],[
                "uid" => $ref
            ]);
        }
    }

    function add_transfer($transfer=0){
        $transfer = $this->get_transfer_enable()+$transfer;
        $this->db->update("user",[
            "transfer_enable" => $transfer
        ],[
            "uid" => $this->uid
        ]);
    }

    //add money
    function add_money($uid,$money){
        $money = $this->get_money()+$money;
        $this->db->update("user",[
            "money" => $money
        ],[
            "uid" => $uid
        ]);
    }

    //update ss pass
    function update_ss_pass($pass){
        $this->db->update("user",[
            "passwd" => $pass
        ],[
            "uid" => $this->uid
        ]);
    }

    //update alipay account
    function update_alipay_account($account){
        $this->db->update("user",[
            "alipay_account" => $account
        ],[
            "uid" => $this->uid
        ]);
    }

    //user info array
    function getUserArray(){
        $datas = $this->db->select("user","*",[
            "uid" => $this->uid,
            "LIMIT" => "1"
        ]);
        return $datas['0'];
    }

    //获取已用流量
    function getUsedTransfer(){ //上传 + 下载
        return $this->getUserArray()['u']+$this->getUserArray()['d'];
    }

    //获取总流量
    function getTransferEnable(){
        return $this->getUserArray()['transfer_enable'];
    }

    //剩余流量
    function getUnusedTransfer(){
        return $this->getTransferEnable()-$this->getUsedTransfer();
    }

}
