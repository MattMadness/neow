<?php
session_start();
$username = $_SESSION['username'];
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
    exit("Did you know you have to <em>log in</em> to trade neowcoins?");
}
chdir('..');
chdir('user');
chdir($_SESSION['username']);
$neowcoins = fopen("neowcoins.txt", "r");
$neowcoins = fread($neowcoins,filesize("neowcoins.txt"));
?>
<html>
<head>
<title>neowcoin transactions</title>
<link rel="shortcut icon" href="https://neow.matthewevan.xyz/favicon.ico" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
<link rel="stylesheet" href="https://neow.matthewevan.xyz/neowtheme.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
#forms {
background-color:rgb(0,0,0,0); border:solid; color:purple;
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
 <a id=menu href="https://neow.matthewevan.xyz/logout.php">Logout</a>
<br><br><h1>transaction menu</h1><img style="width:10%; text-align:center; margin:0 auto;" src="https://neow.matthewevan.xyz/neowcoin.png">
<h2>send neowcoins</h2>
<form spellcheck="false" action="index.php" method="post">
<label>recipient </label><input id="forms" name="recipient" type="username"><br><br>
<label>neowcoins to send </label><input id="forms" name="amount" type="number"><br><br>
<button id="forms" type="submit" value="Submit" >send neowcoins</button>
</form>
<?php
$username = $_SESSION['username'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
        chdir('..');
        if(file_exists($_POST['recipient'])){
                if($_POST['amount'] <= $neowcoins and $_POST['amount'] > 0){
                        chdir('..');
                        chdir('neowcoins');
                        $recipient = $_POST['recipient'];
                        $amount = $_POST['amount'];
                        $username = $_SESSION['username'];
                        
                        $sendlog = fopen("$username.txt", "a");
                        $line = "You sent ".$amount.' neowcoins to '.$recipient.' on '.date('l jS \of F Y h:i:s A')."<br>";
                        fwrite($sendlog, $line);
                        fclose($sendlog);
                        
                        $sendlog = fopen("$recipient.txt", "a");
                        $line = "You received ".$amount.' neowcoins from '.$username.' on '.date('l jS \of F Y h:i:s A')."<br>";
                        fwrite($sendlog, $line);
                        fclose($sendlog);
                        
                        chdir('..');
                        chdir('user');
                        chdir($_SESSION['username']);
                        $neowcoins = fopen("neowcoins.txt", "r");
                        $neowcoins = fread($neowcoins,filesize("neowcoins.txt"));
                        $neowcoins = $neowcoins - $amount;
                        $oldneowcoins = fopen("neowcoins.txt", "w");
                        fwrite($oldneowcoins, $neowcoins);
                        fclose($oldneowcoins);
                        chdir('..');
                        chdir($recipient);
                        $neowcoins = fopen("neowcoins.txt", "r");
                        $neowcoins = fread($neowcoins,filesize("neowcoins.txt"));
                        $neowcoins = $neowcoins + $amount;
                        $oldneowcoins = fopen("neowcoins.txt", "w");
                        fwrite($oldneowcoins, $neowcoins);
                        fclose($oldneowcoins);
                        echo("Transaction success.");
                } else {
                        echo("Invalid neowcoin amount, attempt to send neowcoins failed.");
                }
        } else {
                echo("Invalid Recipient, attempt to send neowcoins failed.");
        }
}
chdir(realpath(dirname(__FILE__)));
$transactionhistory = fopen("$username.txt", "r");
if(filesize("$username.txt") == 0){
$sendlog = fopen("$username.txt", "a");
$line = "Transaction account generated.<br>";
fwrite($sendlog, $line);
fclose($sendlog);
}
?>
<h1>your transcaction history</h1>
<div style="width:80%; height:300px; overflow-y:scroll; text-align:left; margin:0 auto; padding:5px;" id="forms">
<span style="color:844287;"><?php
echo(fread($transactionhistory,filesize("$username.txt")));
?></span>
</div>
