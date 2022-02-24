<?php
function command($command, $syntax) {
        if($command==":neowcoins"){
                chdir('..');
                chdir('user');
                chdir($syntax);
                $neowcoins = fopen("neowcoins.txt", "r");
                echo fread($neowcoins,filesize("neowcoins.txt"));
                fclose($neowcoins);
                
        }
}
command(':neowcoins', 'Jedi-Jason');
?>