<?php
if(isset($_POST['input'])){
        if(strlen($_POST['input']) > 1000){
                die('Your bio may not exceed 1000 characters.');
        }
        session_start();
        $header = fopen("pageheader.php", "r");
        $header = fread($header,filesize("pageheader.php"));
        $footer = fopen("footer.php", "r");
        $footer = fread($footer,filesize("footer.php"));
        $username = $_SESSION['username'];
        if(file_exists($username)){
        } else {
                mkdir($username);
        }
        $input = htmlentities($_POST["input"]);
        $input = nl2br($input, false);
        chdir($username);
        //$input = '<title>'.$username.'</title><div id=nametag> '.$username.' on neow <br></div> '.$input.'';
        $index = $header . $footer;
        $myfile = fopen("index.php", "w");
        fwrite($myfile, $index);
        fclose($myfile);
        $myfile = fopen("bio.txt", "w");
        fwrite($myfile, $input);
        fclose($myfile);
}
?>
<script>
window.location = "https://neow.matthewevan.xyz/user/<?php echo($username);?>"
</script>
