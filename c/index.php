<?php
session_start();
chdir("/var/www/neow.c1.biz/c/");
if (isset($_SESSION['username'])){
        } else {
        exit("You are not logged in!");
        }
function rcopy($src, $dst) {
  if (file_exists($dst)) rrmdir($dst);
  if (is_dir($src)) {
    mkdir($dst);
    $files = scandir($src);
    foreach ($files as $file)
    if ($file != "." && $file != "..") rcopy("$src/$file", "$dst/$file");
  }
  else if (file_exists($src)) copy($src, $dst);
}
$cdir = getcwd();
//chdir('..');
//chdir('user');
//chdir($_SESSION['username']);
//$neowcoins = fopen("neowcoins.txt", "r");
//$neowcoins = fread($neowcoins,filesize("neowcoins.txt"));
//chdir('..');
//chdir('..');
//chdir('c');
//error_reporting(0);

// Active Chats
$featured = array('chat', 'general', 'dating', 'funny', 'anime', 'programming');
foreach ($featured as $citem){
        chdir($cdir);
        chdir($citem);
        $items = scandir(getcwd());
        $$citem = count($items) - 6;
        if ($$citem < 0){
                $$citem = 0;
        }
        chdir('..');
}
chdir($cdir);
?>
<html>
<head>
	<title>neowchat</title>
        <link rel="favicon" href="https://neow.matthewevan.xyz/favicon.ico" />
	<link rel="stylesheet" href="https://neow.matthewevan.xyz/c/dark.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="https://neow.matthewevan.xyz/c/jquery-1.10.2.min.js" ></script>
</head>
<body>
<div class='header'>
	<h1 style="color:black;">
                <a href="https://neow.matthewevan.xyz"><img style="width:30%;" src="https://neow.matthewevan.xyz/c/neow.png"></a>
		
	</h1>

</div>
<div class="main">
<div id="result" style="border:solid 2px purple;">
<span style="color:yellow;">Welcome to  the neowchat kiosk!</span><br><span style="color:lightblue;">Please type the neowchat you would like to go to and press enter to head there! By typing a new chat you will create it.</span><br>
<br><span style="color:limegreen;">Featured Rooms:<br><br>
chat <span style="color:yellow;">(<?php echo($chat); ?> currently active)</span><br>
general <span style="color:yellow;">(<?php echo($general); ?> currently active)</span><br>
dating <span style="color:yellow;">(<?php echo($dating); ?> currently active)</span><br>
funny <span style="color:yellow;">(<?php echo($funny); ?> currently active)</span><br>
anime <span style="color:yellow;">(<?php echo($anime); ?> currently active)</span><br>
programming <span style="color:yellow;">(<?php echo($programming); ?> currently active)</span>
</span>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $room = preg_replace('/[^\p{L}\p{N}\s]/u', '', $_POST['room']);
        $room = preg_replace('/\s+/', '', $room);
        $room = strtolower($room);
        echo('<p>');
                if(file_exists($room)){
                        if($room == "DEFAULT"){
                                exit('You think you are slick?');
                        }
                        $room = $room;
                        ?>
                        <large><a href="/c/<?php echo($room);?>">Join /<?php echo($room);?></a></large>
                        <?php
                } else if(strlen($room) <= 20) {
                rcopy("DEFAULT", $room);
                echo($room);
                echo(" was created");
                } else if(strlen($room) > 20){
                echo('Error: Chatroom name must be 20 characters or lower.');
                }
        echo('</p>');
         
} else {

}
?>
</div>
<div class='chatcontrols'>
<form action="" method="POST">
        <input name="room" placeholder="ENTER ROOM HERE" id="chatbox"></input>
        <button id='send' class='btn btn-send' type="submit" value="Submit" label="Start">Send</button>
</form>
</div>
</div>
</html>
