<?php
$sessionName = "xyv6";
session_name($sessionName);
session_start();
session_destroy();
header("Location:login");
exit;