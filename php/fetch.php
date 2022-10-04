<?php
$connect = mysqli_connect('localhost', 'root', '', 'service');

if (isset($_POST["requestID"])) {
  $query = "SELECT * FROM servicerequests WHERE requestID = '".$_POST["requestID"]."'";
  $result = mysqli_query($connect, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);
}
?>
