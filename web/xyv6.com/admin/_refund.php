<?php
require_once '../lib/config.php';
require_once '_check.php';

if(!empty($_GET)){
    $otn = $_GET['otn'];

    //更新User
    $bill = new Ss\Bills\bills();
    $query = $bill->refund($otn);
    if( !$query){
    	echo '<script> alert("Success!") </script>';
		echo " <script>location.href = document.referrer;</script> " ;
    }else{
    	echo '<script> alert("Failed!") </script>';
		echo " <script>location.href = document.referrer;</script> " ;
    }
}

?>