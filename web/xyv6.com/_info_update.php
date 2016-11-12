<?php
require_once 'lib/config.php';
require_once '_check.php';

if(isset($_POST['nowpwd'])){
    $nowpwd = $_POST['nowpwd'];
    $pwd = $_POST['pwd'];
    $repwd = $_POST['repwd'];

    $nowpwd = \Ss\User\Comm::SsPW($nowpwd);
    if($U->GetPasswd() != $nowpwd) {
        $a['error'] = '1';
        $a['msg'] = "密码错误";
    }elseif($pwd != $repwd){
        $a['error'] = '1';
        $a['msg'] = "两次密码输入不同";
    }elseif(strlen($pwd)<8){
        $a['error'] = '1';
        $a['msg'] = "密码太短啦";
    }else{
        $a['ok'] = '1';
        $a['msg'] = "修改成功";
        $pwd = \Ss\User\Comm::SsPW($pwd);
        $U->UpdatePwd($pwd);
    }
    //echo
    echo json_encode($a);
}elseif(isset($_POST['sspwd'])){
    if($_POST['sspwd'] == ''){
        $pwd = \Ss\Etc\Comm::get_random_char(5);
    }else{
        $pwd = $_POST['sspwd'];
        $pwd = substr($pwd,0,16);
        $pwd = htmlspecialchars($pwd, ENT_QUOTES, 'UTF-8');
        $pwd = \Ss\Etc\Comm::checkHtml($pwd);
    }
    $oo->update_ss_pass($pwd);
    $a['ok'] = '1';
    $a['msg'] = "新密码为".htmlentities(substr($pwd,0,16));
    echo json_encode($a);
}elseif(isset($_POST['aa'])){
    $alipay_account = str_replace(" ", "",$_POST['aa']); 
    $alipay_account = htmlentities($alipay_account); 
    if($alipay_account != ''){    
        $oo->update_alipay_account($alipay_account);
        $a['ok'] = '1';
        echo json_encode($a);
    }
    else{
        $a['ok'] = '0';
        echo json_encode($a);
    }
}else
    die();