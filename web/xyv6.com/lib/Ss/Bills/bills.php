<?php

namespace Ss\Bills;

class bills {
    private $db;

    private $table = "pre_create";

    function __construct(){
        global $db;
        $this->db = $db;
    }

    function success_bills(){
        $datas = $this->db->select($this->table,"*",[
          "ORDER" => "id DESC",
          "AND"=>[
            "success" => 1,
            "uid[!]" => 1
          ]
          ]);
        return $datas;
     }

    function all_money(){
       $money = $this->db->sum("pre_create","total_amount",[
         "AND"=>[
           "success" => 1,
           "uid[!]" => 1
         ]]);
        $gift = $this->db->sum("gifts","amount");
       return $money-$gift;
     }

    function all_bill(){
       $count = $this->db->count("notify","total_amount");
       return $count;
     }

     function user_info($uid){
       $userinfo = $this->db->select("user",[
         "user_name",
         "email"
       ],
     [
       "uid" => $uid
       ]);
       return $userinfo[0];
     }

    function mybills($uid){
       $datas = $this->db->select("pre_create","*",
     ["AND" => [
       "uid" => $uid,
       "success" => 1
       ]]);
       return $datas;
     }

    function refund($out_trade_no){
        $this->db->update("pre_create",[
          "success" => 0
        ],[
          "out_trade_no" => $out_trade_no
        ]);

        $uid = $this->db->get("pre_create", "uid", [
          "out_trade_no" => $out_trade_no
        ]);
        
        $this->db->update("user",[
          "plan" => 'C',
          "u" => 0,
          "transfer_enable" => 3221225472
        ],[
          "uid" => $uid
        ]);
        return 0;
     }

}
