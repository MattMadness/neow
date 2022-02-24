<?php

require_once 'config.php';

// Special char reveal function
function onlyValidChars($text){
        if (!preg_match("#^[a-zA-Z0-9äöüÄÖÜ]+$#", $text)) {
           return false;   
        } else {
           return true;
        }
}

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    #echo("Registrations are disabled.");
    #die();
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "<br>Please enter a username.";
    } else if(!onlyValidChars($_POST['username'])){
        $username_err = "<br>Username may only contain letters, numbers and accents.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM neow.users WHERE username = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();

                if($stmt->num_rows == 1){
                    $username_err = "<br>This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "<br>Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        //$stmt->mysqli_close();
    }

    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "<br>Please enter a password.";
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "<br>Password must have at least 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = '<br>Please confirm password.';
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = '<br>Password did not match.';
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO neow.users (username, password) VALUES (?, ?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_username, $param_password);

            // Set parameters
            $param_username = $_POST['username'];
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                $chat = fopen("sandmanconsole.php", "a");
                $data="Registration success by ".$_SERVER["REMOTE_ADDR"].' whose username is '. $_POST['username'] . ' on <strong>' . date("Y/m/d") . " " . date("h:i:sa") . "</strong><br>";
                fwrite($chat,$data); 
                fclose($chat);
                header("location: login.php");
            } else{
                echo "<br>Something went wrong. Please try again later.";
            }
        }

        // Close statement
        //$stmt->close();
    }

        // Close statement
        //$stmt->mysqli_close();
    

    // Close connection
    //$mysqli->mysqli_close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>register for neow</title>
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
<br><br></div>    <h2>register for neow</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>username<sup></sup></label>
            <input id="forms" type="text" name="username"class="form-control" value="<?php echo $_POST['username']; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <br>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>password<sup></sup></label>
            <input id="forms" type="password" name="password" class="form-control" value="<?php echo $_POST['password']; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <br>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>confirm password<sup></sup></label>
            <input id="forms" type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <br>
        <p>By pressing the Submit button below you agree to our <a href="terms.html" target="_blank">Terms and Conditions</a></p>
        <div class="form-group">
            <input type="submit" id="forms" value="Submit">
            <input type="reset" id="forms" value="Reset">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</div>
</body>
</html>
