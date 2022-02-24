<?php
include("sandman.php");
?>
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
    header("location: index.php");
}
chdir('user');
chdir($_SESSION['username']);
$neowcoins = fopen("neowcoins.txt", "r");
$neowcoins = fread($neowcoins,filesize("neowcoins.txt"));
include('header.php');
?>
<h1>What's New? (2/21/22)</h1>
<p>- WE BACK! Now at neow.matthewevan.xyz :) -</p>
<p>- Previous accounts were not perserved, but neowcoins were, if you re-register you will have your neowcoins and transactions back. -</p>
<!--<h1>What's New? (4/2/20)</h1>
<p>- Message Feed (WOP) -</p>-->
<br><br><a style="text-decoration:none;padding:10px;border:solid;" href="https://neow.matthewevan.xyz/c">Start <strong>neowchat</strong> Client</a>
<br><br><br><a style="text-decoration:none;padding:10px;border:solid;" href="https://neow.matthewevan.xyz/play">Play <strong>neowgames</strong></a>
<br><br><br><a style="text-decoration:none;padding:10px;border:solid;" href="https://neow.matthewevan.xyz/feed">View the <strong>Message Feed</strong> (Under Construction)</a>
<br><br>
</div>
</body>
</html>
    

