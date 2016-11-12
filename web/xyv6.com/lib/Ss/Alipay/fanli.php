<?php


namespace Ss\Alipay;


class fanli {

    private $db;

    private $table = "pre_create";

    function __construct(){
        global $db;
        $this->db = $db;
    }

    function Add( $out_trade_no ){
    $pre_create_info = $this->db->get("pre_create",[
        "plan",
        "uid" 
        ],[
        "out_trade_no" => $out_trade_no
        ]);
    $uid = $pre_create_info['uid'];
    $plan = $pre_create_info['plan'];
    
    // 返利
    $info = $this->db->get("user", [
        "have_profit_ref",
        "ref_by"
        ],[
        "uid" => $uid
        ]);

    $have_profit_ref = $info['have_profit_ref'];
    $ref_by = $info['ref_by'];


    if( $plan != 'D' && $have_profit_ref != 1 && $ref_by != 0 ){
        // add money
        $this->db->update( "user", [
            "total_earned[+]" => 5
            ],[
            "uid" => $ref_by
            ]);
        // update info        
        $this->db->update( "user", [
            "have_profit_ref" => 1
            ],[
            "uid" => $uid
            ]); 
    	}
    }
}