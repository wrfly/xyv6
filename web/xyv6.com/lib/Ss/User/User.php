<?php


namespace Ss\User;


 class User {

     public  $uid;
     private $db;

     private $table = "user";

     function __construct($uid=0){
         global $db;
         $this->uid = $uid;
         $this->db  = $db;
     }

     function AllUser(){
        $datas = $this->db->select($this->table,"*");
        return $datas;
     }

     function ValidUser(){
        $datas = $this->db->select($this->table,"*",[ 
        "AND"=>[
        "d[!]" => 0,
        "port[!]" => 0
        ]]);
        return $datas;
     }

     function OnlineUser(){
        $datas = $this->db->select($this->table,"*",[ "w_n[!]" => 0 ]);
        return $datas;
     }

     function RecentUser(){
        $now = time()-3600*24*7;
        $datas = $this->db->select($this->table,"*",[
          "t[>]" => $now,
          "ORDER" => "t DESC"
          ]);
        return $datas;
     }

     function VipUser(){
        $datas = $this->db->select($this->table,"*",[
            "plan" => ["A","B","E","G"],
            "ORDER" => "vip_start_time DESC",
            ]);
        return $datas;
     }

    function CountVipUser(){
        $count = $this->db->count($this->table,"*",[
            "plan" => ["A","B","E","G"]
            ]);
        return $count;
    }

     function updateUser($transfer_enable,$money){
         return $this->db->update($this->table,[
             "transfer_enable" => $transfer_enable,
             "money" => $money
         ],[
             "uid" => $this->uid
         ]);
     }

     function updateVIPUser($plan, $money, $transfer_enable,
        $vip_start_time, $vip_end_time){
        if ($money != 1 || $money != 50) {
            $month = $money / 10;
        }
         return $this->db->update($this->table,[
             "plan" => $plan,
             "money" => $money,
             "vip_month" => $month,
             "transfer_enable" => $transfer_enable,
             "vip_start_time" => $vip_start_time,
             "vip_end_time" => $vip_end_time
         ],[
             "uid" => $this->uid
         ]);
     }

     //del user
     function del(){
         $this->db->delete("user",[
             "uid" => $this->uid
         ]);
         return 1;
     }

    function ban(){
        $this->db->ban_user("user",[
            "uid" => $this->uid
        ]);
        return 1;
    }
    function active(){
        $this->db->active_user("user",[
            "uid" => $this->uid
        ]);
        return 1;
    }
    function clear(){
        $this->db->update("user",[
            "u" => '0',
            "d" => '0'
        ],[
            "uid" => $this->uid
        ]);
        return 1;
    }

     //获取 临时 temp $pass
     function get_temp_pass(){
         $a = rand(10000,99999);
         return $a;
     }

     //判断username是否可用
     //可用,用户名不存在返回1
     function is_username_used($username){
         if($this->db->has("user",[
             "user_name" => $username
         ])){
             //用户名不可用
             return 0;
         }else{
             //用户名可用
             return 1;
         }
     }

     //is email used
     function is_email_used($email){
         if($this->db->has("user",[
             "email" => $email
         ])){
             return 0;
         }else{
             return 1;
         }
     }

     //login check
     function login_check($username,$passwd){
         if($this->db->has("user",[
             "AND" => [
                 "OR" => [
                     "user_name" => $username,
                     "email" => $username
                 ],
                 "pass" => $passwd
             ]
         ])){
             return 1;
         }else{
             return 0;
         }
     }

     //根据用户名返回UID
    function get_user_uid($username){
        $datas = $this->db->select("user","*", [
        "OR" => [
            "user_name" => $username,
            "email" => $username,
            "uid" => $username
        ],
         "LIMIT" => 1
        ]);

        if( $datas != Null ) return $datas[0]['uid'];
        else return 1;
    }

    function UpdatePWd($pwd){
        $this->db->update("user",[
           "pass" => \Ss\User\Comm::SsPW($pwd)
        ],[
            "uid" => $this->uid
        ]);
    }

 }
