<?php

namespace Ss\User;


class Login {

    static function Check(){
        if(!isset($_SESSION['user_name'])||!isset($_SESSION['user_uid'])||!isset($_SESSION['user_pwd'])){
        // if(!isset($_COOKIE['user_name'])||!isset($_COOKIE['user_uid'])||!isset($_COOKIE['user_pwd'])){
            header("Location:login.php");
            // header("Location:login");
            // return false;
        }else{
            $uid = $_SESSION['user_uid'];
        }
    }
}