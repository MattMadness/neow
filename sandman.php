<?php
session_start();

// This has been uncommented for a good while.

/*
$dir = getcwd();
if (isset($_SERVER)){
if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
if(strpos($ip,",")){
$exp_ip = explode(",",$ip);
$ip = $exp_ip[0];
}
}else if(isset($_SERVER["HTTP_CLIENT_IP"])){
$ip = $_SERVER["HTTP_CLIENT_IP"];
}else{
$ip = $_SERVER["REMOTE_ADDR"];
}
}else{
if(getenv('HTTP_X_FORWARDED_FOR')){
$ip = getenv('HTTP_X_FORWARDED_FOR');
if(strpos($ip,",")){
$exp_ip=explode(",",$ip);
$ip = $exp_ip[0];
}
}else if(getenv('HTTP_CLIENT_IP')){
$ip = getenv('HTTP_CLIENT_IP');
}else {
$ip = getenv('REMOTE_ADDR');
}
}
$yourip = $ip;
$chat = fopen("sandmanconsole.php", "a");
$cwd = getcwd();
$data="Connection made by IP ".$yourip.' in '. $cwd . $_SERVER['PHP_SELF'] . ' whom username is ' . $_SESSION['username'] . ' on ' . date("Y/m/d") . " " . date("h:i:sa") . "<br>";
fwrite($chat,$data); 
fclose($chat);
chdir($dir);
*/
?>
