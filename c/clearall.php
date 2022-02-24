<?php
session_start();
error_reporting(0);
if($_SERVER["REQUEST_METHOD"] == "POST" and $_SESSION['username'] = 'MattMadness'){
//$exclude = array('index.php', 'neowcoins.txt', 'post.php', 'edit.php', 'editimage.php', 'footer.php', 'header.php', 'DEFAULT');
$exclude = array('DEFAULT', '..', '.', 'ajax.js', 'c.php', 'chatheader.php', 'clearall.php', 'commands.php', 'default.css', 'index.php', 'jquery-1.10.2.min.js', 'propeller.php');
$items = scandir(getcwd());
$dir = getcwd();
foreach ($items as $item) {
        if(in_array($item, $exclude)){ } else {
        if(in_array($item, $exclude)){ } else {
                chdir($dir);
                chdir($item);
                $chat = fopen("chatdata.txt", "w");
                //$data="<b>Server</b> cleared chat<br>";
                $data="";
                fwrite($chat,$data);
                fclose($chat);
                chdir('..');
        }
        }
}
}
?>
<form action="clearall.php" method="post">
<p>Only the administrator can use this button.</p>
<input type="submit"value="Use the Infinity Stones to clear all the chats">
</form>