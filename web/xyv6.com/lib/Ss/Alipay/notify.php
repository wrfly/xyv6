<?php


namespace Ss\Alipay;

class notify {

    private $db;

    private $table = "notify";

    function __construct(){
        global $db;
        $this->db = $db;
    }

    function Add($subject, $trade_no, $gmt_create,
        $gmt_payment, $notify_time, $notify_type, $total_amount,
        $out_trade_no, $invoice_amount, $receipt_amount, $buyer_pay_amount,
        $body, $trade_status, $seller_email, $buyer_logon_id){

        $this->db->insert($this->table,[
            "subject" => $subject,
            "trade_no" => $trade_no,
            "gmt_create" => $gmt_create,
            "gmt_payment" => $gmt_payment,
            "notify_time" => $notify_time,
            "notify_type" => $notify_type,
            "total_amount" => $total_amount,
            "out_trade_no" => $out_trade_no,
            "invoice_amount" => $invoice_amount,
            "receipt_amount" => $receipt_amount,
            "buyer_pay_amount" => $buyer_pay_amount,
            "body" => $body,
            "trade_status" => $trade_status,
            "seller_email" => $seller_email,
            "buyer_logon_id" => $buyer_logon_id
        ]);
        return 1;
    }

    function check_if_exist($out_trade_no){
        if ( $this->db->has($this->table, ["out_trade_no" => $out_trade_no] ) )
            return 1;
        else
            return 0;
    }
    function update_precreate($out_trade_no){
        $this->db->update("pre_create", [ "success" => 1 ] ,
            [ "out_trade_no" => $out_trade_no ] );
    }

    function test_update_plan(){

        $details = $this->db->select("pre_create", [
            "uid",
            "plan",
            "month"
            ], [
            "out_trade_no" => '1F1472997718'
            ]);

        $uid = $details[0]['uid'];
        $month = $details[0]['month'];
        $plan = $details[0]['plan'];
        echo $uid;
    }

    function update_plan($out_trade_no){

        $details = $this->db->select("pre_create", [
            "uid",
            "plan",
            "month"
            ], [
            "out_trade_no" => $out_trade_no
            ]);

        $uid = $details[0]['uid'];
        $month = $details[0]['month'];
        $plan = $details[0]['plan'];

        if ($plan == "A") {
            $transfer_enable = 171798691840;
            $invite_num = 5;
            $money = 50;
            $plan_name = "160G/半年";
        }elseif ($plan == "B") {
            $transfer_enable = 32212254720;
            $invite_num = 3;
            $plan_name = "30G/包月";
            $money = 10*$month;
        }elseif ($plan == "D") {
            $transfer_enable = 1073741824;
            $invite_num = 1;
            $money = 1;
            $plan_name = "体验套餐/24小时";
        }elseif ($plan == "E") {
            $money = 20*$month;
            $plan_name = "OpenVPN";
        }elseif ($plan == 'F') {
            $plan_name = "buymore";
        }elseif ($plan == "G") {
            $money = 120;
            $transfer_enable = 400*1024*1024*1024;
            $plan_name = "400G/包年";
        }

        $now = time();

        //VIP是否叠加
        $vip_end_time = $this->db->get("user", "vip_end_time",["uid" => $uid]);
        $older_plan = $this->db->get("user", "plan",["uid" => $uid]);
        $ovpn_end = $this->db->get("user", "ovpn_end",["uid" => $uid]);
        $last_transfer_enable = $this->db->get("user", "transfer_enable",["uid" => $uid]);

        if ($plan == 'A') { //160G
                $this->db->update( "user", [
                    "vip_start_time" => $now,
                    "vip_end_time" => $now+3600*24*31*6,
                    "plan" => $plan,
                    "money" => $money,
                    "have_profit_ref" => 1,
                    "transfer_enable" => $transfer_enable,
                    "u" => 0,
                    "d" => 0
                    ],[
                    "uid" => $uid
                    ]);
                $vip_end_time = $now+3600*24*31*6;
        }elseif ($plan == 'B') { //30G
            if ( $vip_end_time >= time() && $older_plan == 'B' ) { // B-> B
                $this->db->update( "user", [
                    "vip_end_time[+]" => 3600*24*31*$month,
                    "transfer_enable[+]" => 5368709120, //充值加5G
                    "money[+]" => $money,
                    "have_profit_ref" => 1,
                    "vip_month[+]" => $month,
                    "plan" => 'B'
                    ],[
                    "uid" => $uid
                    ]);
                $vip_end_time = $vip_end_time+3600*24*31*$month;
            }else{ // A->B or new buyer
                $this->db->update( "user", [
                    "vip_start_time" => $now,
                    "have_profit_ref" => 1,
                    "plan" => $plan,
                    "vip_month" => $month,
                    "vip_end_time" => $now+3600*24*31*$month,
                    "money" => $money,
                    "transfer_enable" => $transfer_enable,
                    "u" => 0,
                    "d" => 0
                    ],[
                    "uid" => $uid
                    ]);
                $vip_end_time = $now+3600*24*31*$month;
            }
        }elseif ($plan == 'D') {
            $this->db->update( "user", [
                "vip_end_time" => time()+3600*24,
                "vip_start_time" => time(),
                "plan" => $plan,
                "transfer_enable" => $transfer_enable,
                "u" => 0,
                "d" => 0
                ],[
                "uid" => $uid
                ]);
            $vip_end_time = time()+3600*24;
        }elseif ($plan == 'E') { // 20RMB = 30G
            if ( $ovpn_end >= time() ) {
                $this->db->update( "user", [
                    "ovpn_end" => $ovpn_end+3600*24*31*$month
                    ],[
                    "uid" => $uid
                    ]);
                $vip_end_time = $ovpn_end+3600*24*31*$month;
            }else{
                $this->db->update( "user", [
                    "ovpn_end" => $ovpn_end+3600*24*32*$month,
                    "ovpn_start" => $now,
                    "ovpn" => 1
                    ],[
                    "uid" => $uid
                    ]);
                $vip_end_time = $now+3600*24*31*$month;
            }
        }elseif ($plan == 'F') { // add more transfer
            $this->db->update( "user", [
                "transfer_enable[+]" => 16106127360
                ],[
                "uid" => $uid
                ]);
        }elseif ($plan == 'G') { // 400G/year
            $this->db->update( "user", [
                "vip_end_time" => $now+3600*24*365,
                "vip_start_time" => $now,
                "plan" => $plan,
                "money" => $money,
                "have_profit_ref" => 1,
                "transfer_enable" => $transfer_enable,
                "u" => 0,
                "d" => 0
                ],[
                "uid" => $uid
                ]);
        }
        //真尼玛不容易啊！！！！
        require_once __DIR__.'/../../send_email.php';
        send_email($uid, $plan_name, $vip_end_time);
    }
}