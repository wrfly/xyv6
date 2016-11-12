<?php

namespace Ss\Bills;

class gifts {
    private $db;

    private $table = "gifts";

    function __construct(){
        global $db;
        $this->db = $db;
    }

    function add($uid, $user_alipay, $amount){
        $this->db->insert($this->table,[
            "uid" => $uid,
            "user_alipay" => $user_alipay,
            "#date" => 'NOW()',
            "amount" => $amount
        ]);

        $this->db->update("user", [
        "earned_money[+]" => $amount
        ], [ "uid" => $uid ]);

    }

    // function del($id){
        
    // }
}