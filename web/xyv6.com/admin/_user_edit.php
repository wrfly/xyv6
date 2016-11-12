<?php
require_once '../lib/config.php';
require_once '_check.php';

if(!empty($_POST)){
    $uid = $_POST['uid'];
    $transfer_enable = $_POST['transfer_enable'];
    $money = $_POST['money'];

    //更新
    $User = new Ss\User\User($uid);
    $query = $User->updateUser($transfer_enable,$money);
    if($query){
                $ue['code'] = '1';
                $ue['ok'] = '1';
                $ue['msg'] = "修改成功！即将跳转到用户管理列表！";
    }else{
                $ue['code'] = '0';
                $ue['msg'] = "出错了，请重试..";
    }
}
echo json_encode($ue);
