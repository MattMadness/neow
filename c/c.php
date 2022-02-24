<?php
session_start();
chdir($cwd);
error_reporting(0);
function convertToLink($input) {
   $pattern = '@(http(s)?://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
   return $output = preg_replace($pattern, '<a href="http$2://$3">$0</a>', $input);
}

if(isset($_SESSION['username'])){
        if($_SESSION['username'] == 'MattMadness'){ 
                $user="<span style=color:yellow;>".$_SESSION['username']."</span>";
                $http = "/";
                $user = "<a href=http:".$http.$http."neow.matthewevan.xyz/user/".$_SESSION['username'].">".$user."</a>";
        } else {
                $user = $_SESSION['username'];
                $http = "/";
                $user = "<a href=http:".$http.$http."neow.matthewevan.xyz/user/".$_SESSION['username'].">".$user."</a>";
        }
        

        
        
} else {
        exit('You have been logged out.');
}

if(isset($_POST['ajaxsend']) && $_POST['ajaxsend']==true && empty($_POST['chat']) != true){
	// Code to save and send chat
        
        if(strlen($_POST['chat']) < 200){
        
        if($_SESSION['username'] == 'MattMadness'){
                $sub = $_POST['chat'];
                $sub = htmlentities($_POST['chat'], ENT_QUOTES);
                $sub = convertToLink($sub);
                $user="<span style=color:yellow;>".$_SESSION['username'].":</span>";
                $http = "/";
                $user = "<a href=http:".$http.$http."neow.matthewevan.xyz/user/".$_SESSION['username'].">".$user."</a>";
                } else {
                $sub = htmlentities($_POST['chat'], ENT_QUOTES);
                $sub = convertToLink($sub);
                $user="<span>".$_SESSION['username'].":</span>";
                $http = "/";
                $user = "<a href=http:".$http.$http."neow.matthewevan.xyz/user/".$_SESSION['username'].">".$user."</a>";
                }
	$chat = fopen("chatdata.txt", "a");
	$data = "<b>".$user.'</b> '.$sub."<br>";
	fwrite($chat,$data);
	fclose($chat);

	$chat = fopen("chatdata.txt", "r");
	echo fread($chat,filesize("chatdata.txt"));
	fclose($chat);
        
        } else {
        echo('<script> itsanerror();</script>');
        }
        
} else if(isset($_POST['ajaxget']) && $_POST['ajaxget']==true){
        // Code to send chat history to the user
        $part = explode('/', $dir);
        $chat = array_key_last($part);
        $chat = file_get_contents('chatdata.txt', FALSE, NULL, $$chat);
        $chat = "".$chat."<br>";
	//$chat = fopen("chatdata.txt", "r");
        if(isset($_SESSION['prev']) == false){
                $_SESSION['prev'] = filesize("chatdata.txt");
        }
	//echo fread($chat,filesize("chatdata.txt"));
        echo $chat;
        if($_SESSION['prev'] != filesize('chatdata.txt')){
                echo('<script>notify.play();</script>');
                $_SESSION['prev'] = filesize("chatdata.txt");
        }
	//fclose($chat);
        // Who Is Online v2
        $username = $_SESSION['username'];
        $online = fopen("$username", "w");
        $timestamp = time();
        fwrite($online,$timestamp);
        fclose($online);
} else if(isset($_POST['ajaxonline']) && $_POST['ajaxonline']==true){
                // Who's Online Checker
        $exclude = array('c.php', 'index.php', 'chatdata.txt', '.', '..', 'current.txt');
        $items = scandir(getcwd());
        sort($items, SORT_NATURAL | SORT_FLAG_CASE);
        echo('<p style=color:green;>Currently active:');
        $unit = 0;
        foreach ($items as $item) {
        if(in_array($item, $exclude)){} else {
                $online = fopen("$item", "r");
                $prevdate = fread($online,filesize("$item"));
                $currdate = fopen("current.txt", "w");
                $timestamp = time();
                fwrite($currdate, $timestamp);
                $currdate = fopen("current.txt", "r");
                $currdate = fread($currdate, filesize("current.txt"));
                $soontobe = 20;
                
                settype($currdate, "integer");
                settype($prevdate, "integer");
                
                $diff = $currdate - $prevdate;
                if($diff > $soontobe){
                        if($diff > 60){
                                unlink($item);
                                if($item == 'MattMadness'){ 
                                        $user="<span style=color:yellow;>".$item."</span>";
                                        $http = "/";
                                        $user = "<a href=http:".$http.$http."neow.matthewevan.xyz/user/".$item.">".$user."</a>";
                                } else {
                                        $user = $item;
                                        $http = "/";
                                        $user = "<a href=http:".$http.$http."neow.matthewevan.xyz/user/".$item.">".$user."</a>";
                                }
                                $chat = fopen("chatdata.txt", "a");
                                $data="<b>".$user.'</b> timed out<br>';
                                fwrite($chat,$data);
                                fclose($chat);
                                $chat = fopen("chatdata.txt", "r");
                                echo fread($chat,filesize("chatdata.txt"));
                                fclose($chat);
                        }
                } else {
                    if($unit > 0){
                        echo(', ');
                        echo($item);
                    } else {
                        echo(' ');
                        echo($item);
                    }
                    $unit = $unit + 1;
                }
        }
        }
        echo('.</p>');
} else if(isset($_POST['ajaxclear']) && $_POST['ajaxclear']==true){
        $featured = array('chat', 'general', 'dating', 'funny', 'anime', 'programming');
        $part = explode('/', $dir);
        $roomname = array_key_last($part);
        if(in_array($roomname, $featured) and $_SESSION['username'] == "MattMadness"){
                $chat = fopen("chatdata.txt", "w");
                $data="<b>".$user.'</b> cleared chat<br>';
                fwrite($chat,$data);
                fclose($chat);
        } else if(in_array($roomname, $featured) and $_SESSION['username'] !== "MattMadness"){
                echo('<script>itsanothererror();</script>');
        } else {
                $chat = fopen("chatdata.txt", "w");
                $data="<b>".$user.'</b> cleared chat<br>';
                fwrite($chat,$data);
                fclose($chat);
        }
} else if(isset($_POST['ajaxjoin']) && $_POST['ajaxjoin']==true){
        $chat = fopen("chatdata.txt", "a");
        $data="<b>".$user.'</b> entered the chat<br>';
	fwrite($chat,$data);
	fclose($chat);
	$chat = fopen("chatdata.txt", "r");
	echo fread($chat, filesize("chatdata.txt"));
	fclose($chat);
} else if(isset($_POST['ajaxleave']) && $_POST['ajaxleave']==true){
        unlink($_SESSION['username']);
        $chat = fopen("chatdata.txt", "a");
        $data="<b>".$user.'</b> left the chat<br>';
	fwrite($chat, $data);
	fclose($chat);
	$chat = fopen("chatdata.txt", "r");
	echo fread($chat, filesize("chatdata.txt"));
	fclose($chat);
}
