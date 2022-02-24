<?php
session_start();
$dir = getcwd();
if($dir == "/srv/disk15/2508703/www/neow.matthewevan.xyz/c/DEFAULT"){
        header("location: https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fs2.quickmeme.com%2Fimg%2F29%2F2913d5ce5fd10092dbbc01e38e0ceb7134ed97afbf9b02c216ac2c8d6ed55dd8.jpg&f=1&nofb=1");
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $udir = getcwd();
	$part = explode('/', $udir);
	$last = array_key_last($part);
    chdir('..');
    include('chatheader.php');
    chdir($dir);
} else {
?>
<META http-equiv="refresh" content="0;URL=https://neow.matthewevan.xyz/login.php">
<?php
exit('Only logged in users may chat in neowchat.');
}
?>
<div id="online"></div>
<div id='result'></div>
<div class='chatcontrols'>
	<form method="post" onsubmit="return submitchat();">
	<input type='text' name='chat' id='chatbox' autocomplete="off" placeholder="ENTER CHAT HERE"/>
	<input type='submit' name='send' id='send' class='btn btn-send' value='Send' />
	<input type='button' name='clear' class='btn btn-clear' id='clear' value='X' title="Clear Chat" />
</form>
<script type="text/javascript" src="https://neow.matthewevan.xyz/c/ajax.js"></script>
</div>
</body>
</html>