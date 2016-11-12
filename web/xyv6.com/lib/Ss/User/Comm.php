<?php

namespace Ss\User;


class Comm {

    //pwd on cookies
    static function CoPW($pw){
        global $salt;
        //$x =  base64_encode($pw.$salt);
        $x =  hash('sha256',$pw.$salt);
        $x = substr($x,5,45);
        return $x;
    }

    //pwd on db
    static function SsPW($pwd){
        global $salt;
        global $pwd_mode;
        switch ($pwd_mode){
            case 1 :
                return md5($pwd);
                break;
            case 2 :
                return hash('sha256',$pwd.$salt);
                break;
            default:
                return hash('sha256',$pwd.$salt);
        }
    }

    static function md5WithSaltPw($pwd){
        global $salt;
        return md5($pwd.$salt);
    }

    //Get qq head
    static function Gravatar( $email ){
        $url = "https://q1.qlogo.cn/g?b=qq&s=100&nk=";
        if(preg_match("/^[0-9]{4,10}@qq.com$/", $email, $matches)){
            $qq_email = $matches[0];
            preg_match("/[0-9]+/",$qq_email,$qq_num);
            $url = $url.$qq_num[0];
        } else {
                $url = "https://xiaoyuanv6.com/user/xyv6.png";
            }
        return $url;
    }

}
