<?php
session_start();
?>
<html>
<style>
html{
  background: url('https://neow.matthewevan.xyz/loading.gif') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
<?php
chdir('..');
chdir('..');
chdir('user');
chdir($_SESSION['username']);
$neowcoins = fopen("neowcoins.txt", "r");
$neowcoins = fread($neowcoins,filesize("neowcoins.txt"));
$neowcoins = $neowcoins + 10;
$oldneowcoins = fopen("neowcoins.txt", "w");
fwrite($oldneowcoins, $neowcoins);
?>
</html>
<p>Ads are disabled so I guess you get your coins for free mate.</p>
<script>
	function wait(ms){
 	    var start = new Date().getTime();
    	var end = start;
 	    while(end < start + ms) {
        end = new Date().getTime();
        }
    }
	wait(5000);
	close();
</script>
<noscript>
	<p>Oh, you should consider turning JavaScript on for this site.</p>
</noscript>
<!--<meta http-equiv="refresh" content="0; url=https://onemboaran.com/afu.php?zoneid=3066731" />