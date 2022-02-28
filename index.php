<?php
include("sandman.php");
?>
<?php 
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("location: neow.php");
}
$items = scandir('user/'); // this will contain array of folders and files in folder "users"
$items = count($items);
?>
<html>
<head>
<title>neow</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
<link rel="stylesheet" href="https://neow.matthewevan.xyz/neowtheme.css">
<meta name="propeller" content="a760dea16b76ba7a477685d4d70487ac">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div id="heading"><br><a href="https://neow.matthewevan.xyz" ><img style="height:30;" src="https://neow.matthewevan.xyz/neow.png"></a>
<br><br></div>
<div id="everythingelse">
<a id="menu" href="login.php">Login / Signup</a>
<h1>Welcome to neow!</h1>
<p>This is a handcrafted site with chat, bulletin board, currency (neowcoins), and mid-tier gambling (currently with a fun dice game and a lottery). It is Free Software, it's source code is available <a href="https://github.com/MattMadness/neow" target="_blank">here</a>.</p>
<h2>Why Play</h2>
<p>You should play because it's fun and does not affect your real-life wealth. </p>
<h2>What are neowcoins</h2>
<p>neowcoins are nothing more then a number in a text file on the web server. It's worthless, but that's what makes this game fun. You can gamble it, earn it, and lose it; you're not affected.</p>
<p>The currency, neowcoins, cannot and should not be bought or sold because that way there are no real life implications of losing it.</p>
<div style="padding:50px;">
<h2>Total User Count:</h2><span style="font-size:3em; color:#E14242;"><?php echo($items - 6);?></span></div>
<?php
$items = scandir('c/'); // this will contain array of folders and files in folder "users"
$items = count($items);
$items = $items - 8;
?>
<br>
<div style="padding:50px;">
<h2>Total neowchat Count:</h2><span style="font-size:3em; color:#E14242;"><?php echo($items);?></span>

</div>

</div>
</body>
</html>
