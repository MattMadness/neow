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
<div style="padding:50px; background-image:url(https://www.cpomagazine.com/wp-content/uploads/2019/12/tim-berners-lee-launches-new-contract-for-the-web-to-create-a-better-internet_1500.jpg); background-size:cover;">
<h2>Total User Count:</h2><span style="font-size:3em; color:red;"><?php echo($items - 6);?></span></div>
<?php
$items = scandir('c/'); // this will contain array of folders and files in folder "users"
$items = count($items);
$items = $items - 8;
?>
<div style="padding:50px; background-image:url(https://blog.mozilla.org/internetcitizen/files/2016/12/connect-dots_cropped.jpg); background-size:cover;">
<h2>Total neowchat Count:</h2><span style="font-size:3em; color:red;"><?php echo($items);?></span></div>
</div>
</body>
</html>
