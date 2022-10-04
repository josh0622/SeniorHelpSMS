<?php
session_start();

$username1 = "";
$password = "";
$fullname = "";
$mobileNo = "";
$address = "";
$serviceCode = "";
$errors = array();

// connecting to database
$servername = "localhost";
$username = "root";
$serverPassword = "";
$dbname = "service";
$con = mysqli_connect($servername, $username, $serverPassword, $dbname);

// if the register button is clicked
if (isset($_POST['register'])){
  $username1 = $_POST['username'];
  $password = $_POST['password'];
  $password_1 = $_POST['password_1'];
  $fullname = $_POST['full-name'];
  $mobileNo = $_POST['mobileNo'];
  $address = $_POST['address'];
  if(isset($_POST['userType'])){
    $typeOfUser = $_POST['userType'];
  } else {
    $typeOfUser = "";
  }
  $serviceCode = $_POST['serviceCode'];

  if (empty($username1)) {
    array_push($errors, "Username is required");
  }

  if(empty($password)){
    array_push($errors, "Password is required");
  }

  if(empty($fullname)){
    array_push($errors, "Please enter your name");
  }

  if(empty($address)){
    array_push($errors, "Address is required");
  }

  if (empty($typeOfUser)) {
    array_push($errors, "Please select a type of user");
  }

  if ($typeOfUser == "serviceProvider") {
    if (empty($serviceCode)) {
      array_push($errors, "Service Code is required");
    }
  }

  if (empty($mobileNo)) {
    array_push($errors, "Mobile No is required");
  }

  if ($password != $password_1) {
    array_push($errors, "Password must match");
  }

  // if there are no errors, save user to database
  if(count($errors) == 0){
    $password = md5($password);
    $sql = "INSERT INTO SeniorHelpUsers (username, password, fullname, mobileNo, userType) VALUES ('$username1', '$password', '$fullname', '$mobileNo', '$typeOfUser')";

    if(strcmp($typeOfUser, "seniorCitizen") == 0){
      $sql2 = "INSERT INTO seniorCitizen (citizenUsername, address) VALUES ('$username1', '$address')";
    }

    if(strcmp($typeOfUser, "serviceProvider") == 0) {
      $sql1 = "INSERT INTO serviceProvider (providerUsername, address, serviceCode) VALUES ('$username1', '$address', '$serviceCode')";
    }
    mysqli_query($con, $sql);
    mysqli_query($con, $sql1);
    mysqli_query($con, $sql2);
    $_SESSION['username'] = $username1;
    header('location: ../html/index.php'); //redirect to index page
  }
}


// login user from login page
if (isset($_POST['login'])) {
  $username1 = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username1)) {
    array_push($errors, "Username is required");
  }

  if(empty($password)){
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM SeniorHelpUsers WHERE username = '$username1' AND password = '$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
      // log user in
      $user = mysqli_fetch_assoc($result);
      if($user['userType'] == 'serviceProvider'){
        $_SESSION['username'] = $user;
        header('location: ../html/homeProvider.php');
      } else {
        $_SESSION['username'] = $user;
        header('location: ../html/home.php');
      }
    } else {
      array_push($errors, "The username or password is incorrect");
    }
  }
}

// retrieve request form service page and send to database
if (isset($_POST['openSub'])){
  $username1 = $_SESSION['username']['username'];
  $serviceCode = $_POST['code'];
  $serviceDate = date ('Y-m-d', strtotime($_POST['reqDate']));
  $serviceTime = $_POST['reqTime'];
  $serviceNote = $_POST['notes'];
  $serviceStatus = "Pending";

  if (strcmp($serviceCode, 'A4531') == 0){
    $sql = "INSERT INTO servicerequests (requestID, code, reqDate, reqTime, notes, serviceRequested, status, citizenUsername, providerUsername)
    VALUES (NULL, '$serviceCode', '$serviceDate', '$serviceTime', '$serviceNote', 'Cleaning', '$serviceStatus', '$username1', NULL)";
  } else if (strcmp($serviceCode, 'A4532') == 0){
    $sql = "INSERT INTO servicerequests (requestID, code, reqDate, reqTime, notes, serviceRequested, status, citizenUsername, providerUsername)
    VALUES (NULL, '$serviceCode', '$serviceDate', '$serviceTime', '$serviceNote', 'Cooking', '$serviceStatus', '$username1', NULL)";
  } else if (strcmp($serviceCode, 'A4533') == 0){
    $sql = "INSERT INTO servicerequests (requestID, code, reqDate, reqTime, notes, serviceRequested, status, citizenUsername, providerUsername)
    VALUES (NULL, '$serviceCode', '$serviceDate', '$serviceTime', '$serviceNote', 'Driving', '$serviceStatus', '$username1', NULL)";
  } else if (strcmp($serviceCode, 'A4534') == 0){
    $sql = "INSERT INTO servicerequests (requestID, code, reqDate, reqTime, notes, serviceRequested, status, citizenUsername, providerUsername)
    VALUES (NULL, '$serviceCode', '$serviceDate', '$serviceTime', '$serviceNote', 'Shopping', '$serviceStatus', '$username1', NULL)";
  } else {
    $sql = "INSERT INTO servicerequests (requestID, code, reqDate, reqTime, notes, serviceRequested, status, citizenUsername, providerUsername)
    VALUES (NULL, '$serviceCode', '$serviceDate', '$serviceTime', '$serviceNote', 'Playing', '$serviceStatus', '$username1', NULL)";
  }

  $result = mysqli_query($con, $sql);
}

// Logout
if (isset($_GET['logout'])){
  session_destroy();
  unset($_SESSION['username']);
  header('location: ../html/index.php');
}

mysqli_close($con);
?>
