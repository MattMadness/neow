<html>
<head>  
	<title>c/<?php echo($part[$last]); ?></title>
	<link rel="favicon" href="https://neow.matthewevan.xyz/favicon.ico" />
	<link id="pageStyle" rel="stylesheet" href="https://neow.matthewevan.xyz/c/dark.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="https://neow.matthewevan.xyz/c/jquery-1.10.2.min.js" ></script>
</head>
<body>
<noscript><div style="text-align:center;position:absolute;top:0;left:0;bottom:0;right:0;height:100%;width:100%;background-color:black; color:white;"><br><br><br><br><br><strong>Uhh, guys?</strong><br>Looks like you have JavaScript disabled. In order to chat, you gotta have it on.</div></noscript>
<div class='header'>
	<h1 style="color:black;">
		<a href="https://neow.matthewevan.xyz"><img style="width:30%;" src="https://neow.matthewevan.xyz/c/neow.png"></a>
		
	</h1>

</div>
<script>
$(".chatcontrols").fadeTo(5000,1).fadeOut(1000);

// function swapStyleSheet() {
//    if (document.getElementById("lightSwitch").checked) {
//        document.getElementById("pageStyle").setAttribute('href', 'https://neow.matthewevan.xyz/c/dark.css');
//    } else {
//        document.getElementById("pageStyle").setAttribute('href', "https://neow.matthewevan.xyz/c/default.css");
//        }
//    }

var notify = new Audio('https://srv-file7.gofile.io/download/FO6WtW/notify.mp3');
function itsanerror() {
window.alert('Send Error: Text may not exceed 200 characters.');
}
function itsanothererror() {
window.alert('Clear Error: Only the administrator may clear this chat.');
}
function cooldown() {
window.alert('Please wait a few moments before attempting that action again.');
}
</script>
<div class='main'>
<a id='send' class='btn btn-send' style="padding:10px; position:absolute;top:0;right:0; margin:5px;" href="https://neow.matthewevan.xyz/c">Return to Kiosk</a>
<?php 
error_reporting(0);
$username = $_SESSION['username'];
if (isset($_SESSION['username'])){ } else { exit('<a target="_blank" href="https://neow.matthewevan.xyz/login.php">Login</a> to chat in neowchat.');} 
chdir('..');
chdir('user');
if (file_exists("$username/index.php")){ } else { exit('<a target="_blank" href="https://neow.matthewevan.xyz/user/edit.php">Create your profile page</a> to chat in neowchat.');} 
chdir('..');
chdir('c');
chdir($dir);
?>
