<?php
session_start();
$chat = fopen("sandmanconsole.php", "a");
$data="Logout success by ".$_SERVER["REMOTE_ADDR"].' whom username is '. $_SESSION['username'] . ' on <strong>' . date("Y/m/d") . " " . date("h:i:sa") . "</strong><br>";
fwrite($chat,$data); 
fclose($chat);
?>
<?php
// Unset all of the session variables
$_SESSION['loggedin'] = false;
$_SESSION = array();

// Destroy the session.
session_destroy();
header("location: index.php");