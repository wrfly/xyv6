<?php
/**
 * class invite_code
 */
namespace Ss\User;

class Reflink {

    public $ref;
    private $db;

    private $table = "ref_link";


    function  __construct($ref=0){
        global $db;
        $this->ref = $ref;
        $this->db   = $db;
    }

    //邀请链接是否有效检测
    function IsRefok(){
        if($this->db->has("ref_link",[
            "link_code" => $this->ref
        ])){
            return 1;
        }else{
            return 0;
        }
    }

    function GetCodeUid(){
        $uid = $this->db->select($this->table,"uid",[
            "link_code" => $this->ref
        ]);
        return $uid['0'];
    }

    function Addlink($sub,$user,$num){
        for($a=0;$a<$num;$a++) {
            $x = rand(10, 1000);
            $z = rand(10, 1000);
            $x = md5($x).md5($z);
            $x = base64_encode($x);
            $code = $sub.substr($x, rand(1, 13), 24);
            $this->db->insert("invite_code",[
                "link_code" => $code,
                "user" => $user
            ]);
        }
    }


}