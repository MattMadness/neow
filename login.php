<?php
include("sandman.php");
?>
<?php

require_once 'config.php';
$redirectlink = $_GET['redirect'];

// Define variables and initialize with empty values
$username = $password = $seckey = "";
$username_err = $password_err = $seckey_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Verify security key
	//if($_POST["seckey"] != "IMAGINEIFIKEPTTHEPASSWORDSIN"){
	//    $seckey_err = "<br>Please enter a valid security key.";
	//}

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = '<br>Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = '<br>Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err) ){
        // Prepare a select statement
        $sql = "SELECT username, password FROM neow.users WHERE username = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement if($stmt->execute()){
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){
                    // Bind result variables
                    $stmt->bind_result($username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['loggedin'] = true;
                            $chat = fopen("sandmanconsole.php", "a");
                            $data="Login success by ".$_SERVER["REMOTE_ADDR"].' whose username is '. $username . ' on <strong>' . date("Y/m/d") . " " . date("h:i:sa") . "</strong><br>";
                            fwrite($chat,$data); 
                            fclose($chat);
                            chdir('user');
                            if(file_exists($username)){
                                } else {
                                        mkdir($username);
                                }
                            chdir($username);
                            if(file_exists('neowcoins.txt') == false){
                                    $coins = fopen("neowcoins.txt", "w");
                                    fwrite($coins, '0');
                                    fclose($coins);
                            }
                            chdir('..');
                            chdir('..');
                            chdir('neowcoins');
                            if(isset($redirectlink)){
                                        ?>
                                        <meta http-equiv="refresh" content="2;url=<?php echo($redirectlink);?>" />
                                        <?php
                                        die('Redirecting...');
                            }
                            header("Location: neow.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = '<br>The password you entered was not valid.';
                            $chat = fopen("sandmanconsole.php", "a");
                            $data="Login failure by ".$_SERVER["REMOTE_ADDR"].' whose username is '. $username . ' on <strong>' . date("Y/m/d") . " " . date("h:i:sa") . "</strong><br>";
                            fwrite($chat,$data); 
                            fclose($chat);
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = '<br>No account found with that username.';
                }
            } else{
                echo "<br>Oops! Something went wrong. Please try again later.";
            }
        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login to neow</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <link rel="stylesheet" href="https://neow.matthewevan.xyz/neowtheme.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
#heading {
color:red ;
text-align:center;
}
#everythingelse, .wrapper { height:100%; width:100%; position:center;
padding:7;
margin:auto ;
border:10px;
padding: 10px;
text-align:center;
overflow-x: hidden;
overflow-y: auto;

height:auto;
}
#forms {
background-color:rgb(0,0,0,0); border:solid; color:purple;
}
</style>
    
</head>
<body>
<div class="wrapper">

<div id="heading"><br><a href="https://neow.matthewevan.xyz" ><img style="width:50%; text-align:left;" src="https://neow.matthewevan.xyz/neow.png"></a>
<br><br></div>    <h2>login to neow</h2>
    <form action="login.php" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>username<sup></sup></label>
            <input id="forms" type="text" name="username"class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <br>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>password<sup></sup></label>
            <input id="forms" type="password" name="password" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <br>
	<div class="form-group">
            <input id="forms" type="submit" class="btn btn-primary" value="Submit">
        </div>
        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
    </form>
</div>
</body>
</html>
