<?php
session_start();
$username = $_SESSION['username'];
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
    exit("Did you know you have to <em>log in</em> to play adcoins?");
}
chdir('..');
chdir('..');
chdir('user');
chdir($_SESSION['username']);
$neowcoins = fopen("neowcoins.txt", "r");
$neowcoins = fread($neowcoins,filesize("neowcoins.txt"));
?>
<html>
<head>
<title>neowplay</title>
<link rel="shortcut icon" href="https://neow.matthewevan.xyz/favicon.ico" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
<link rel="stylesheet" href="https://neow.matthewevan.xyz/neowtheme.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div id="heading"><br><a href="https://neow.matthewevan.xyz" ><img style="height:30;" src="https://neow.matthewevan.xyz/neow.png"></a>

<br><br></div>
<div id="everythingelse">
          <a style"font-size:30;" id="menu" href="https://neow.matthewevan.xyz/user/<?php echo($_SESSION['username']);?>"><?php echo $_SESSION['username'];?></a>
<a href="https://neow.matthewevan.xyz/neowcoins" id="menu"><img style="width:18;" src="https://neow.matthewevan.xyz/neowcoin.png"> <strong><?php echo($neowcoins);?></strong></a>
<a id="menu" href="https://neow.matthewevan.xyz/user">View Profile Pages</a>
<a id="menu" href="https://neow.matthewevan.xyz/user/edit.php">Edit Profile Page</a>
<?php 
if($_SESSION['username']=="MattMadness" or $_SESSION['username']=="Jedi-Jason" or $_SESSION['username']=="railpro101"){
echo("<a id=menu href");
echo("=");
echo("sandmanconsole.php");
echo(">Sandman Console</a>");
} ?>
 <a id=menu href="https://neow.matthewevan.xyz/logout.php">Logout</a>
<h1>AdCoins</h1>
<p>With AdCoins, you can get neowcoins just by viewing an ad. <img style="width:18;" src="https://neow.matthewevan.xyz/neowcoin.png"> 10 per ad! Powered by Propeller Ads.</p><br>
<script>
function stuff() {
window.location.reload();
}
</script>
<a id="link" style="text-decoration:none;padding:10px;border:solid;" href="fetchad.php" target="_blank" onclick="stuff();" >View Ad for <img style="width:18;" src="https://neow.matthewevan.xyz/neowcoin.png"> 10</a>
<br><br>


