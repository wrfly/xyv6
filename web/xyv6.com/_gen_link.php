<?php
require_once 'lib/config.php';
require_once '_check.php';
$invite = new \Ss\User\Invite($uid);
if( $U->Can_gen_link() == 1){
    $invite->Gen_ref_link();
    $a['ok'] = "0";
    $a['msg'] = "Done";
}
else
	die();
echo json_encode($a);