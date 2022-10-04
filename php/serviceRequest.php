<?php
// Connect to database
$con = mysqli_connect('localhost', 'root', '', 'service');

// getting requestID
$requestID = $_GET["requestID"];
$result = mysqli_query($con, "SELCT * FROM servicerequests WHERE requestID = $requestID");

$requst = mysqli_fetch_object($result);
echo json_encode($request); // returnug the json string;
?>
