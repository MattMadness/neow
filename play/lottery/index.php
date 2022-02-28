<?php
session_start();
$username = $_SESSION['username'];
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
    exit("Did you know you have to <em>log in</em> to participate in the lottery?");
}
$thisdir = getcwd();
chdir('..');
chdir('..');
chdir('user');
chdir($_SESSION['username']);
$neowcoins = fopen("neowcoins.txt", "r");
$neowcoins = fread($neowcoins,filesize("neowcoins.txt"));
chdir($thisdir);
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
<a id=menu href="https://neow.matthewevan.xyz/logout.php">Logout</a>
<h1>Lottery</h1>
<p>The Powerball ain't got nothing on the neowplay Lottery! Buy some tickets below.</p><br>
<form action="index.php" method="post" autocomplete="off">
    <label>Tickets to Purchase</label>
    <input type="number" name="amount">
    <button id="link" type="submit">Purchase for <img style="width:18;" src="https://neow.matthewevan.xyz/neowcoin.png"> 100 Each</button>
    <?php
    $neowcoincost = $_POST['amount'] * 100;
    if($_SERVER['REQUEST_METHOD'] == 'POST' and $neowcoincost <= $neowcoins and $_POST['amount'] > 0) {
        chdir('../../user/');
        chdir($_SESSION['username']);
        $neowcoins = fopen("neowcoins.txt", "r");
        $neowcoins = fread($neowcoins,filesize("neowcoins.txt"));
        $neowcoins = $neowcoins - $neowcoincost;
        $oldneowcoins = fopen("neowcoins.txt", "w");
        fwrite($oldneowcoins, $neowcoins);
        fclose($oldneowcoins);
        chdir($thisdir);
        chdir("stake");
        if(file_exists($_SESSION['username']) == false){
            $tmpuserstake = fopen($_SESSION['username'], "w");
            fwrite($tmpuserstake, '0');
            fclose($tmpuserstake);
        }
        $userstake = fopen($_SESSION['username'], "r");
        $userstake = fread($userstake,filesize($_SESSION['username']));
        $userstake = $userstake + $_POST['amount'];
        $olduserstake = fopen($_SESSION['username'], "w");
        fwrite($olduserstake, $userstake);
        fclose($olduserstake);
        chdir("..");
        if(file_exists("totalstake") == false){
            $tmptotalstake = fopen("totalstake", "w");
            fwrite($tmptotalstake, '0');
            fclose($tmptotalstake);
        }
        $totalstake = fopen("totalstake", "r");
        $totalstake = fread($totalstake,filesize("totalstake"));
        $totalstake = $totalstake + $_POST['amount'];
        $oldtotalstake = fopen("totalstake", "w");
        fwrite($oldtotalstake, $totalstake);
        fclose($oldtotalstake);
        chdir($thisdir);
        $chance = number_format(($userstake / $totalstake) * 100, 0);
        echo("<p>You just purchased " . $_POST['amount'] . " lottery tickets costing <img style='width:18;' src='https://neow.matthewevan.xyz/neowcoin.png'> " . $neowcoincost . ". With your " . $userstake . " lottery tickets, you have a " . $chance . "% chance of winning.  Good luck!</p>");
        echo("<meta http-equiv='refresh' content='30;url=https://neow.matthewevan.xyz/play/lottery/' />");
        }
    ?>
</form>
<p>The lottery is drawn every Monday at 9AM EST.</p>
<?php
    $totalstake = fopen("totalstake", "r");
    $totalstake = fread($totalstake,filesize("totalstake"));
    $userstake = fopen("stake/".$_SESSION['username'], "r");
    $userstake = fread($userstake,filesize("stake/".$_SESSION['username']));   
    $reward = $totalstake * 100;
?>
<h2>Current Lottery Statistics</h2>
<div style="text-align:left; max-width:500px; margin:0 auto;"> 
    <p><strong>Jackpot</strong>: <img style='width:18;' src='https://neow.matthewevan.xyz/neowcoin.png'> <?php echo($reward); ?></p>
    <p><strong>Total Tickets in Stake</strong>: <?php echo($totalstake); ?></p>
    <p><strong>Tickets You Own</strong>: <?php echo($userstake); ?></p>
    <p><strong>Winning Chance</strong>: <?php echo(number_format(($userstake / $totalstake) * 100, 0)."%"); ?></p>
    <table style="margin:0 auto; border:solid 1px black;">
        <tr style="border-bottom: solid 1px black;">
            <th>#</th>
            <th>Stakeholders</th>
            <th>Tickets</th>
        </tr>
        <?php
        chdir("stake");
        $stakeholders = array_diff(scandir(getcwd()), array('..', '.'));
        foreach($stakeholders as $stakeholder) {
            $shs = fopen($stakeholder, "r");
            $shs = fread($shs, filesize($stakeholder));
            $rankings[] = array("stakeholder" => $stakeholder, "stake" => $shs);
        }
        $columns = array_column($rankings, 'stake');
        array_multisort($columns, SORT_DESC, $rankings);
        $num = 1;
        foreach ($rankings as $rank) {
            echo("<tr><th>".$num."</th><th>".$rank['stakeholder']."</th><th>".$rank['stake']."</th></tr>");
            $num++;
        }
        chdir("..");
        ?>
    </table>
</div>
<?php
    $winner = fopen("winner", "r");
    $winner = fread($winner, filesize("winner"));
    $winnertickets = fopen("winnertickets", "r");
    $winnertickets = fread($winnertickets, filesize("winnertickets"));
    $prevstake = fopen("prevstake", "r");
    $prevstake = fread($prevstake, filesize("prevstake"));
    $finaljackpot = fopen("finaljackpot", "r");
    $finaljackpot = fread($finaljackpot, filesize("finaljackpot"));       
?>
<h2>Previous Lottery Results</h2>
<div style="text-align:left; max-width:500px; margin:0 auto;">
<p><strong>Winner</strong>: <?php echo($winner); ?></p>
<p><strong>Winner's Tickets Owned</strong>: <?php echo($winnertickets); ?></p>
<p><strong>Total Tickets in Stake</strong>: <?php echo($prevstake); ?></p>
<p><strong>Final Jackpot and Reward</strong>: <img style='width:18;' src='https://neow.matthewevan.xyz/neowcoin.png'> <?php echo($finaljackpot); ?></p>
</div>
</div>
</body>
</html>
