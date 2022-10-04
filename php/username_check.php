<?php
// connecting to database
$servername = "localhost";
$username = "root";
$serverPassword = "";
$dbname = "service";
$con = mysqli_connect($servername, $username, $serverPassword, $dbname);

if (isset($_POST['username'])) {
  $username = $_POST['username'];
  if (!empty($username)) {
    $username_query = mysqli_query($con, "SELECT * FROM SeniorHelpUsers WHERE username = '$username'");
    $count = mysqli_num_rows($username_query);
    if($count == 0) {
      echo "Username doesn't exist";
      exit;
    } else {

      echo "Username already exists";
      exit;
    }
  }
}

?>
