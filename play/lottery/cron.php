<?php
date_default_timezone_set('EST');
if(date("l h:i A") == "Monday 09:00 AM") {
    chdir("stake");
    $stakeholders = array_diff(scandir(getcwd()), array('..', '.'));
    foreach($stakeholders as $stakeholder) {
        $shs = fopen($stakeholder, "r");
        $shs = fread($shs, filesize($stakeholder));
        $rankings[] = array("stakeholder" => $stakeholder, "stake" => $shs);
    }
    foreach($rankings as $rank) {
        for($num = 0; $num < $rank['stake']; $num++){
            $strawdraw[] = $rank['stakeholder'];
        }
    }
    chdir("..");
    $straw = $strawdraw[rand(0, count($strawdraw))];
    $winner = fopen("winner", "w");
    fwrite($winner, $straw);
    fclose($winner);
    chdir("stake");
    $userstake = fopen($straw, "r");
    $userstake = fread($userstake, filesize($straw));
    chdir("..");
    $winnertickets = fopen("winnertickets", "w");
    fwrite($winnertickets, $userstake);
    fclose($winnertickets);
    $prevstake = fopen("prevstake", "w");
    fwrite($prevstake, count($strawdraw));
    fclose($prevstake);
    $finaljackpot = fopen("finaljackpot", "w");
    fwrite($finaljackpot, count($strawdraw) * 100);
    fclose($finaljackpot);
    $totalstake = fopen("totalstake", "w");
    fwrite($totalstake, 0);
    fclose($stake);
    chdir("../../user");
    chdir($straw);
    $neowcoins = fopen("neowcoins.txt", "r");
    $neowcoins = fread($neowcoins,filesize("neowcoins.txt"));
    $neowcoins = $neowcoins + (count($strawdraw) * 100);
    $oldneowcoins = fopen("neowcoins.txt", "w");
    fwrite($oldneowcoins, $neowcoins);
    chdir("../../play/lottery/stake");
    $stakeholders = array_diff(scandir(getcwd()), array('..', '.'));
    foreach($stakeholders as $stakeholder) {
        unlink($stakeholder);
    }   
    chdir("..");
}

?>
