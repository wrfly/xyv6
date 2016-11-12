<?php


namespace Ss\Download;


class mission {

    private $db;

    private $table = "offline_download";

    function __construct(){
        global $db;
        $this->db = $db;
    }

    function Add($uid,$file_name,$file_url){

        $this->db->insert($this->table,[
            "uid" => $uid,
            "file_name" => $file_name,
            "file_size" => 0,
            "file_format" => 0,
            "file_url" => $file_url,
            "down_link" => 0,
            "start_time" => 0,
            "finish_time" => 0,
            "percentage" => 0,
            "ave_speed" => 0,
            "is_start" => 0,
            "is_finish" => 0,
            "exist" => 0,
            "add_time" => time()
        ]);
        return 1;
    }

    function Del($id,$uid){
        $this->db->update("offline_download",[
            "exist"=>0
            ],
            ["AND" => [
             "id[=]" => $id,
             "uid[=]" => $uid
            ]
         ]);
         return 1;
    }

    function Cancel(){

    }

    function Finished_downloads(){
        $datas = $this->db->select($this->table,"*",[
            "is_finish" => 1
            ]);
        return $datas;
     }

    function All_downloads(){
        $datas = $this->db->select($this->table,"*");
        return $datas;
     }

    function My_downloads($uid){
        $datas = $this->db->select($this->table,"*",["uid" => $uid]);
        return $datas;
     }

    function Get_last_id(){
        $mission_id = $this->db->select($this->table,"*",[
            "ORDER" => "id DESC",
            "LIMIT" => 1
        ]);
        return $mission_id['0']['id'];
    }

    function check_user($uid){
        $now = time();
        $last_add_time = $this->db->select($this->table,"add_time",[
            "ORDER" => "add_time DESC",
            "uid" => $uid
            ]);
        $lt = $last_add_time['0'];
        if ($now - $lt > 3600*24) {
            return 0;
        }else{
            return 1;
        }
     }

    function check_url($url){
        if (stristr( $url,'http://') == TRUE or stristr($url,'ftp://') == TRUE or stristr($url,'https://') == TRUE ) {
            return 0;
        }else{
            return 1;
        }
     }
}