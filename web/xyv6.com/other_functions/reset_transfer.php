<?php
/*
 * 清空流量
 */
//定义清零日期,1为每月1号
$reset_date = '1';
// 日期符合就清零 
if (date('d')==$reset_date){
    $db->update("user",[
        "u" => "0",
        "d" => "0",
        "transfer_enable" => "3221225472"
    ],[
    	"plan" => 'C'
    ]);
    echo ' <script>alert("操作成功!")</script> ';
	echo " <script>window.close()</script> " ;
}
else{
	echo ' <script>alert("日期不符合")</script> ';
	echo " <script>window.close()</script> " ;
}


?>