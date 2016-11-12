<?php

namespace Ss\User;


class UserInfo {

    public  $uid;
    private $db;

    private $table = "user";

    function __construct($uid=0){
        global $db;
        $this->uid = $uid;
        $this->db  = $db;
    }

    //user info array
    function UserArray(){
        $datas = $this->db->select($this->table,"*",[
            "uid" => $this->uid,
            "LIMIT" => "1"
        ]);
        return $datas[0];
    }

    function GetPasswd(){
        return $this->UserArray()['pass'];
    }

    function Getport(){
        return $this->UserArray()['port'];
    }

    function Getused(){
        $u = $this->UserArray()['u'];
        $d = $this->UserArray()['d'];

        $used = $u + $d;

    }

    function Getunused(){
        $u = $this->UserArray()['u'];
        $u = $this->UserArray()['u'];

    }

    function Getportpass(){
        return $this->UserArray()['passwd'];
    }

    function Get_plan_round_time(){
        $vip_end_time = $this->UserArray()['vip_end_time'];
        $plan = $this->UserArray()['plan'];
        if ( $plan == 'C' || $plan == 'D') {
            $round_time = strtotime(date('Y-m-01', time()+3600*24*31));
        }elseif ( $plan == 'A' || $plan == 'G' ) {
            $round_time = $vip_end_time;
        }elseif ( $plan == 'B' || $plan == 'F') {
            $month = $this->UserArray()['vip_month'];
            $round_time = $vip_end_time-(3600*24*31*($month - 1));
        }
        return $round_time;
    }

    function GetEmail(){
        return $this->UserArray()['email'];
    }

    function GetUid(){
        return $this->UserArray()['uid'];
    }

    function GetUserName(){
        return $this->UserArray()['user_name'];
    }

    function RegDate(){
        return $this->UserArray()['reg_date'];
    }

    function RegDateUnixTime(){
        return strtotime($this->RegDate());
    }

    function InviteNum(){
        return $this->UserArray()['invite_num'];
    }

    function InviteNumToZero(){
        $this->db->update("user",[
            "invite_num" => '0'
        ],[
            "uid" => $this->uid
        ]);
    }

    function Money(){
        return $this->UserArray()['money'];
    }

    function AddMoney($money){
        $this->db->update("user",[
            "money[+]" => $money
        ],[
            "uid" => $this->uid
        ]);
    }


    function GetAliapyAccount(){
        return $this->UserArray()['alipay_account'];
    }

    function GetTotalEarned(){
        return $this->UserArray()['total_earned'];
    }

    function GetEarnedMoney(){
        return $this->UserArray()['earned_money'];
    }

    function GetTotalSpent($uid){
        return $this->db->sum("pre_create", "total_amount",[
            "AND" => [
            "uid" => $uid,
            "success" => 1
            ]

        ]);
    }

    function GetRefCount($uid){
        $c = $this->db->count($this->table,"uid",[
            "AND" => [
            "ref_by" => $uid,
            "valid" => 1
            ]
        ]);
        return $c;
    }

    function UpdatePwd($pass){
        $this->db->update("user",[
            "pass" => $pass
        ],[
            "uid" => $this->uid
        ]);
    }

    function isAdmin(){
        if($this->db->has("ss_user_admin",[
            "uid" => $this->uid
        ])){
            return true;
        }else{
            return false;
        }
    }

    function DelMe($port){
        $this->db->update("port_pool",[
            "used" => 0
        ],[
            "port" => $port
        ]);

        $this->db->delete($this->table,[
            "uid" => $this->uid
        ]);
    }

    function BanMe(){
        $this->db->ban_user($this->table,[
            "uid" => $this->uid
        ]);
    }
    function ActiveMe(){
        $this->db->active_user($this->table,[
            "uid" => $this->uid
        ]);
    }
    function ClearMe(){
        $this->db->update("user",[
            "u" => '0',
            "d" => '0'
        ],[
            "uid" => $this->uid
        ]);
    }

    function Can_gen_link(){
        if($this->db->has("ref_link",[
            "uid" => $this->uid
        ]))
            return 0;
        else
            return 1;
    }

    function Get_link_code(){
        $link = $this->db->select("ref_link","link_code",[
            "uid" => $this->uid
        ]);
        return $link['0'];
    }
}
