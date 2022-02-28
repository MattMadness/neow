<?php
session_start();
$username = $_SESSION['username'];
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
    exit("Did you know you have to <em>log in</em> to play dice?");
}
$olddir = getcwd();
chdir('..');
chdir('..');
chdir('user');
chdir($_SESSION['username']);
$neowcoins = fopen("neowcoins.txt", "r");
$neowcoins = fread($neowcoins,filesize("neowcoins.txt"));

$dice = 6;
if(isset($_SESSION['multi'])){} else {
        $_SESSION['multi'] = 1;
}
if(isset($_SESSION['lossmulti'])){} else {
        $_SESSION['lossmulti'] = 1;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['bet'] <= $neowcoins and $_POST['bet'] > 0){
        $dice = rand(1,6);
        $oldmulti = $_SESSION['multi'];
        $oldlossmulti = $_SESSION['lossmulti'];
        if($_POST['hilo'] == true and $dice >= 4){
                $_SESSION['multi']++;
                $_SESSION['lossmulti'] = 1;
        } else if($_POST['hilo'] == false and $dice <= 3){
                $_SESSION['multi']++;
                $_SESSION['lossmulti'] = 1;
       } else {
                $_SESSION['multi'] = 1;
                $_SESSION['lossmulti']++;
        }
}
?>
<html>
<head>
<title>neowplay</title>
<link rel="shortcut icon" href="https://neow.matthewevan.xyz/favicon.ico" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
<link rel="stylesheet" href="https://neow.matthewevan.xyz/neowtheme.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv='refresh' content='60;url=https://neow.matthewevan.xyz/play/dice/' />
</head>
<body>
<div id="heading"><br><a href="https://neow.matthewevan.xyz" ><img style="height:30;" src="https://neow.matthewevan.xyz/neow.png"></a>

<br><br></div>
<div id="everythingelse">
          <a style"font-size:30;" id="menu" href="https://neow.matthewevan.xyz/user/<?php echo($_SESSION['username']);?>"><?php echo $_SESSION['username'];?></a>
<a href="https://neow.matthewevan.xyz/neowcoins" id="menu"><img style="width:18;" src="https://neow.matthewevan.xyz/neowcoin.png"> <strong><span class="neowcoins"><?php echo($neowcoins);?></strong></span></a>
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
<h1>neowplay</h1>
<div style="background-size:20px; background-image:url('https://neow.matthewevan.xyz/background.png'); background-repeat:repeat; color:black; min-width:200px; max-width:544px; height:600px; margin: 0 auto; border:ridge 5px grey;overflow:scroll;">
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer; top: 0; left: 0;
  right: 0;
  bottom: 0;
  background-color: #2196F3;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #ff0000;
}

input:focus + .slider {
  box-shadow: 0 0 1px #ff0000;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<h1>Dice</h1>
<h5>Bet HI or LO to win neowcoins!</h5>
<?php
if($_SESSION['multi'] != 1){
?>
    <h5>Your next <span style="color:lime;">win</span> multiplier is x<?php echo($_SESSION['multi']);?>!</h5>
<?php
} else {
?>
    <h5>Your next <span style="color:red;">loss</span> multiplier is x<?php echo($_SESSION['lossmulti']);?>!</h5>
<?php
}
function dicefunds($mod) {
    $prevdir = getcwd();
    chdir("../../play/dice/");
    $funds = fopen("funds", "r");
    $funds = fread($funds, filesize("funds"));
    $funds = $funds + $mod;
    if ($funds <= 0) {
        $funds = 0;
    }
    $oldfunds = fopen("funds", "w");
    fwrite($oldfunds, $funds);
    chdir("stats");
    $userstat = fopen($_SESSION['username'], "r");
    $userstat = fread($userstat, filesize($_SESSION['username']));
    $userstat = $userstat - $mod;
    $olduserstat = fopen($_SESSION['username'], "w");
    fwrite($olduserstat, $userstat);
    chdir($prevdir);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['bet'] <= $neowcoins and $_POST['bet'] > 0){
        if($_POST['hilo'] == true and $dice >= 4){
                dicefunds((-1 * abs($_POST['bet'])) * $oldmulti);
                $prevdir = getcwd();
                chdir("../../play/dice/");
                $funds = fopen("funds", "r");
                $funds = fread($funds, filesize("funds"));
                chdir("olddir");
                if($funds <= 0){
                    echo("<span style='color:red;'><strong>The casino is broke.</strong></span> Unable to reward neowcoins.<br><br>");
                } else {
                    $neowcoins = $neowcoins + ($_POST['bet'] * $oldmulti);
                    $neowcoins = round($neowcoins);
                    echo('You won ');
                    echo($_POST['bet'] * $oldmulti);
                    echo(' neowcoins!<br><br>');
                    $oldneowcoins = fopen("neowcoins.txt", "w");
                    fwrite($oldneowcoins, $neowcoins);
                }
        } else if($_POST['hilo'] == false and $dice <= 3) {
                dicefunds((-1 * abs($_POST['bet'])) * $oldmulti);
                $prevdir = getcwd();
                chdir("../../play/dice/");
                $funds = fopen("funds", "r");
                $funds = fread($funds, filesize("funds"));
                chdir("olddir");
                if($funds <= 0){
                    echo("<span style='color:red;'><strong>The casino is broke.</strong></span> Unable to reward neowcoins.<br><br>");
                } else {
                    $neowcoins = $neowcoins + ($_POST['bet'] * $oldmulti);
                    $neowcoins = round($neowcoins);
                    echo('You won ');
                    echo($_POST['bet'] * $oldmulti);
                    echo(' neowcoins!<br><br>');
                    $oldneowcoins = fopen("neowcoins.txt", "w");
                    fwrite($oldneowcoins, $neowcoins);
                }
        } else {
                dicefunds($_POST['bet'] * $oldlossmulti);
                $neowcoins = $neowcoins - ($_POST['bet'] * $oldlossmulti);
                $neowcoins = round($neowcoins);
                if($neowcoins <= 0){
                    $neowcoins = 0;
                    echo("<span style='color:red;'><strong>You're Broke!</strong></span> ");
                }
                echo('You lost '.$_POST['bet'] * $oldlossmulti.'');
                echo(' neowcoins!<br><br>');
                $oldneowcoins = fopen("neowcoins.txt", "w");
                fwrite($oldneowcoins, $neowcoins);
        }
        echo('You now have '.$neowcoins.'');
        echo(' neowcoins!<br><br>');
        echo("<script> const coin = document.querySelector('.neowcoins'); coin.innerText=".$neowcoins.";</script>");
}
?>
<img src="<?php echo($dice);?>.png" style="width:150px;">
<br><br>
<form action="index.php" method="post" autocomplete="off">
<span style="font-size:45px; color:blue;">LO </span>
<span style="font-size:45px; color:red;"> HI</span><br>
<label class="switch">
  <input name="hilo" type="checkbox" <?php if($_POST['hilo']){echo("checked=checked");}?>>
  <span class="slider"></span>
</label>
<br><br>
<label>Bet</label>
<input type="number" name="bet" value="<?php echo($_POST['bet']); ?>">
<button type="submit">Roll!</button>
</form>
</div>
<?php
chdir($olddir);
$funds = fopen("funds", "r");
$funds = fread($funds, filesize("funds"));
?>
<h2>Dice Statistics</h2>
<div style="text-align:left; max-width:500px; margin:0 auto;">
    <p><strong>Casino Funds</strong>: <img style='width:18;' src='https://neow.matthewevan.xyz/neowcoin.png'> <?php echo($funds); ?></p>
    <table style="margin:0 auto; border:solid 1px black;">
        <tr style="border-bottom: solid 1px black;">
            <th>#</th>
            <th>Gambler</th>
            <th>Earnings</th>
        </tr>
        <?php
        chdir("stats");
        $gamblers = array_diff(scandir(getcwd()), array('..', '.'));
        foreach($gamblers as $gambler) {
            $shs = fopen($gambler, "r");
            $shs = fread($shs, filesize($gambler));
            $rankings[] = array("gambler" => $gambler, "earnings" => $shs);
        }
        $columns = array_column($rankings, 'earnings');
        array_multisort($columns, SORT_DESC, $rankings);
        $num = 1;
        foreach ($rankings as $rank) {
            echo("<tr><th>".$num."</th><th>".$rank['gambler']."</th><th>".$rank['earnings']."</th></tr>");
            $num++;
        }
        chdir("..");
        ?>
    </table>
</div>
<br><br>
</div>
</body>
</html>
    

