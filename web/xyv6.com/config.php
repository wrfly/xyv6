<?php
require_once 'lib/config.php';
require_once '_check.php';

$type = $_GET;

// if (isset($type['4'])) $type = 4;
// elseif (isset($type['6'])) $type = 6;
// else $type = '';

$type = isset($type['4']) ? 4: (isset($type['6']) ? 6 : '');

$pass = $oo->get_pass();
$port = $oo->get_port();
$plan = $oo->get_plan();

$fov = $plan == 'C' ? "free" : "vip";
$configfile = file_get_contents("z-".$fov."-config".$type.".json");

$configfile = str_replace("pwd", $pass, $configfile);
$configfile = str_replace("10000", $port, $configfile);

// $temp = tmpfile();
// fwrite($temp, $configfile);
// fseek($temp, 0);
// echo fread($temp, 102400);
// fclose($temp);

header('Content-Disposition: attachment; filename="gui-config.json"');
header('Content-type: application/json');
echo $configfile;



// echo "z-".$fov."-config".$type.".json";
