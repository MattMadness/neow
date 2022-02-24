<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $username = $_SESSION['username'];
} else {
    exit('You must sign in to edit your profile picture.');
}
?>

<?php
if(file_exists($username)){
chdir($username);
if(file_exists('imagename.txt')){
$propic = fopen("imagename.txt", "r");
$propic = fread($propic, filesize('imagename.txt'));
}
} else {
mkdir($username);
chdir($username);
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (isset($_POST['save_profile'])) {
    // for the database
    $bio = stripslashes($_POST['bio']);
    $profileImageName = $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = $username;
    $target_file = basename($profileImageName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['profileImage']['size'] > 200000) {
      $msg = "Image size should not be greater than 200 kilobytes. Try resizeing or cropping the image";
      $msg_class = "alert-danger";
    }
    $info = getimagesize($_FILES['profileImage']['tmp_name']);
    if ($info === FALSE) {
       $msg = "Unable to determine image type.";
       $msg_class = "alert-danger";
       die('Hey, whatchu doin?');
    }

    if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
      $msg = "Not a gif/jpeg/png";
      $msg_class = "alert-danger";       
      die('What kind of image did you upload? Try a gif, jpeg, or a png next time.');
    }
    if (empty($error)) {
    //Instead of using an sql base, use a txt cause I'm lazy
    unlink($propic);
    if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)){
    $myfile = fopen("imagename.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $target_file);
    fclose($myfile);
    }
    }
  }
}
?>

<html>
<head>
<title>edit your profile page</title>
<link rel="shortcut icon" href="https://neow.matthewevan.xyz/favicon.ico" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
<style>
html{background: rgb(238,174,202);
background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);}
body { font-family: Tahoma, Geneva, sans-serif; }
#heading { background-color:gray ;
color:red ;
text-align:left;
}
#everythingelse {position:center;
padding:7;
margin:auto ;
border:10px;
padding: 10px;
text-align:center;
overflow-x: hidden;
overflow-y: auto;
height:auto;
}

</style>
<script>
function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
</script>
</head>
<body>
<div id="heading"><br><a href="https://neow.matthewevan.xyz" ><img style="height:30; text-align:left;" src="https://neow.matthewevan.xyz/neow.png"></a>

<br><br></div>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
<div id="everythingelse">
<p>Welcome, <a href="https://neow.matthewevan.xyz/user/<?php echo($_SESSION['username']);?>"><?php echo $_SESSION['username'];?></a>. Not you? <a href="https://neow.matthewevan.xyz/logout.php">Logout.</a></p>
<h1>Edit Profile Picture</h1>
<p>Upload your own profile image here.</p>
        <form action="editimage.php" method="post" enctype="multipart/form-data">
          <?php if (!empty($msg)): ?>
            <div class="alert <?php echo $msg_class ?>" role="alert">
              <?php echo $msg; ?>
            </div>
          <?php endif; ?>
          <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <img style="height:50px; width:50px; border:solid 1px grey;" src="<?php echo($username); ?>/<?php echo($propic); ?>" onClick="triggerClick()" id="profileDisplay">
            </span>
            <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
            <p><?php echo($_SESSION['username']);?></p>
          </div>
          <div class="form-group">
            <button type="submit" name="save_profile" class="btn btn-primary btn-block">Save User</button>
          </div>
        </form>
        
</div>
</body>
</html>
    

