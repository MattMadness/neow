<?php
session_start();
include '../../config.php';

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) and empty($password_err) and empty($confirm_password_err)){
    
    /*
    
        // Prepare a drop insert statement
        $sql = "DELETE FROM `login` WHERE username= ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $peram_username);

            // Set parameters
            $param_username = $_SESSION['username'];

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                //
                echo "User deleted...";
            } else{
                echo "Something went wrong. Please try again later.";
                exit();
            }
        }
        sleep(1);
        // Prepare an insert statement
        $sql = "INSERT INTO neow.users (username, password) VALUES (?, ?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $peram_username, $param_password);

            // Set parameters
            $param_username = $_SESSION['username'];
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                echo('User was reinserted.');
            } else{
                echo "Something went wrong. Please try again later.";
                exit();
            }
        }

        */
        
        // Prepare an update statement
        $username = $_SESSION['username'];
        $hashedpassword = password_hash($_POST['password'], PASSWORD_DEFAULT); // Creates a password hash

        $sql = "UPDATE `login` SET `password`= ? WHERE `username` = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $hashedpassword, $param_username);
            
            

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                echo('User was updated.');
            } else{
                echo "Something went wrong. Please try again later.";
                exit();
            }
        }
        
        
        // Close statement
        //$stmt->close();
    }
    
    // Close connection
    //$mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>register for neow</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
        <style>
    html{background-color:#202024; color:#844287;}
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
<div id="heading"><br><a href="https://neow.matthewevan.xyz" ><img src="https://neow.matthewevan.xyz/neow.png"></a>
<br><br></div>
<div id="everythingelse">
    <h2>register for neow</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>password<sup></sup></label>
            <input id="forms" type="password" name="password" class="form-control" value="<?php echo $password; ?>">
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
