<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $username = $_SESSION['username'];
} else {
    exit('You must sign in to edit your profile page.');
}
chdir($_SESSION['username']);
$neowcoins = fopen("neowcoins.txt", "r");
$neowcoins = fread($neowcoins,filesize("neowcoins.txt"));
?>
<html>
<head>
<title>edit your profile page</title>
<link rel="shortcut icon" href="https://neow.matthewevan.xyz/favicon.ico" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
<link rel="stylesheet" href="https://neow.matthewevan.xyz/neowtheme.css">
<style>

#body{
width:80%;
height:500px;
color:purple;
font-weight: normal;
background-color:#f4f4f4;
padding:10px;
overflow-y:visable;
}
</style>
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
 <a id=menu href="https://neow.matthewevan.xyz/logout.php">Logout</a><h1>Edit Profile Page</h1>
<form action="post.php" method="post">
<?php
chdir('/srv/disk15/2508703/www/neow.matthewevan.xyz/user/');
chdir($username);
if (file_exists("bio.txt")) {
        $myfile = fopen("bio.txt", "r") or die("Unable to open file!");
        $content = fread($myfile,filesize("bio.txt"));
        fclose($myfile);
}
?>
<textarea style="text-align:left;" id="body" name="input" placeholder="Here's who I am.">
<?php echo($content); ?>
</textarea>
<br><br>
<input id="btn" type="submit" value="Save">
</form>
</div>
</body>
</html>
    

