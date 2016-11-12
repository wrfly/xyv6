<?php


namespace Ss\Alipay;


class precreate {

    private $db;

    private $table = "pre_create";

    function __construct(){
        global $db;
        $this->db = $db;
    }

    function Add_precreate($out_trade_no, $total_amount, 
        $subject, $plan, $month, $uid, $time_create){
        
        $this->db->insert($this->table,[
            "out_trade_no"=> $out_trade_no,
            "total_amount"=> $total_amount,
            "subject"=> $subject,
            "plan"=> $plan,
            "month"=> $month,
            "uid"=> $uid,
            "time_create"=> $time_create,
            "success"=> 0
        ]);
        return 1;
    }
}