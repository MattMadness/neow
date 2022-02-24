<?php
session_start();
if (isset($_SESSION['username'])){
        } else {
        exit("You are not logged in!");
        }
?>
<html>
<style>
#item{
display:inline-block;
padding:20px;
font-size:20px;
border:solid 2px purple;
margin:2px;
width:150px;
height:100px;
text-decoration:none;
}
#forms {
background-color:rgb(0,0,0,0); border:solid; color:purple;
}
</style>
<title>neowgames</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
<link rel="shortcut icon" href="https://neow.matthewevan.xyz/favicon.ico" />
<link rel="stylesheet" href="https://neow.matthewevan.xyz/neowtheme.css">
<body>
<div id="heading"><br><a href="https://neow.matthewevan.xyz" ><img style="height:30px;" src="https://neow.matthewevan.xyz/neow.png"></a>
<br><br></div>
<div id="everythingelse">
<h1>neowgames</h1>
<a href="dice"><div id="item">Dice</div></a>
<a href="lottery"><div id="item">Lotto</div></a>
<a href="adcoins"><div id="item">AdCoins</div></a>
</html>
