<?php


namespace Ss\Node;


class NodeInfo extends \Ss\Etc\Db {

    private $table = "ss_node";

    function NodeArray(){
        $datas = $this->db->select($this->table,"*",[
            "id" => $this->id,
            "LIMIT" => "1"
        ]);
        return $datas['0'];
    }

    function Server(){
        return $this->NodeArray()['node_server'];
    }

    function type(){
        return $this->NodeArray()['node_type'];
    }

    function Server_v4(){
        // if ( $this->NodeArray()['node_type'] == 1 ) {
            // return $this->NodeArray()['node_ipv4'];
        // }else
            return $this->NodeArray()['node_ipv4'];
            // return $this->NodeArray()['node_server'];        
    }

    function Name(){
        return $this->NodeArray()['node_name'];
    }


    function Method(){
        return $this->NodeArray()['node_method'];
    }

    function Del(){
        $this->db->delete($this->table,[
            "id" => $this->id
        ]);
    }

    function Update($node_name,$node_type,$node_server,$node_ipv4,$node_method,$node_info,$node_status,$node_order){
        $this->db->update("ss_node", [
            "node_name" => $node_name,
            "node_type" => $node_type,
            "node_server" => $node_server,
            "node_ipv4" => $node_ipv4,
            "node_method" => $node_method,
            "node_info" => $node_info,
            "node_status" => $node_status,
            "node_order" =>  $node_order
        ],[
            "id[=]"  => $this->id
        ]);
        return 1;
    }

}