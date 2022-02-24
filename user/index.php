<?php
session_start();
if($_SESSION['loggedin'] != true){
    die("You must be logged in to view profile pages.");
}
require 'header.php';
?>
<title>search users</title>
<form id="" action="index.php" method="GET">
        <div>
            <label>search<sup></sup></label>
            <input id="page" type="text" name="q" class="form-control" value="<?php echo htmlentities(strip_tags($_GET['q']), ENT_QUOTES); ?>">
        </div>
        <br>
        <div class="form-group">
            <input id="btn" type="submit" class="btn btn-primary" value="Search">
        </div>
    </form>
<?php
if($_SERVER["REQUEST_METHOD"] == "GET" and strlen($_GET["q"]) != 0){
        $exclude = array('index.php', 'pageheader.php', 'neowcoins.txt', 'post.php', 'edit.php', 'editimage.php', 'footer.php', 'header.php');
        $q = $_GET["q"];
        $items = scandir(getcwd()); // this will contain array of folders and files in folder "users"
        $matches = array();
        foreach ($items as $item) {
           if (strpos(strtolower($item), strtolower($q)) > -1) {
               $matches[] = $item;
           }
        }
        echo('Search results for: '.$q.'<br><br>');
        $result = 0;
        $http = "/";
        if(count($matches) == 0){
            echo("<em>No results found for your query...</em>");
        }
        while($matches[$result] != ''){
                $i = $matches[$result];
                if(in_array($i, $exclude) == false){
                        echo('<a href=http:'.$http.$http.'neow.matthewevan.xyz/user/'.$matches[$result].'>'.$matches[$result].'</a>');
                        echo('<br>');
                }
                $result = $result + 1;
        }

}
?>
<?php
require 'footer.php';
?>
