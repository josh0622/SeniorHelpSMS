<?php
include('../php/server.php');
$connect = mysqli_connect('localhost', 'root', '', 'service');

if (!empty($_POST)) {
  $output = '';
  $message = '';
  $date = date ('Y-m-d', strtotime($_POST['reqDate']));
  $time = $_POST["reqTime"];
  $notes = $_POST["notes"];
  $status = $_POST["status"];

  // here you can add another if statement if the status is cancelled
  // you can delete the table row -note to self-
  if ($_POST["requestID"] != '') {
    $query = "UPDATE servicerequests SET reqDate = '$date', reqTime = '$time', notes = '$notes', status = '$status' WHERE requestID = '".$_POST["requestID"]."'";
  } else {
    $message = 'Data Not Updated!';
  }

  if(mysqli_query($connect, $query))
  {
    if ($_SESSION['username'] == 'serviceProvider') {
      $sql = "SELECT * FROM servicerequests INNER JOIN serviceType ON servicerequests.code = serviceType.serviceCode AND servicerequests.providerUsername = '".$_SESSION['username']['username']."' AND servicerequests.status = 'Accepted' ORDER BY requestID ASC";
    } else {
      $sql = "SELECT * FROM servicerequests INNER JOIN serviceType ON servicerequests.code = serviceType.serviceCode AND servicerequests.citizenUsername = '".$_SESSION['username']['username']."' AND NOT(servicerequests.status = 'Completed') AND NOT(servicerequests.status = 'Cancelled') ORDER BY requestID ASC";
    }
    $result = mysqli_query($connect, $sql);
    $output .= '
    <table id="managetb-display" class="sortable">
    <tr>
    <th>RequestID</th>
    <th class="sorttable_nosort">serviceDescription</th>
    <th class="sorttable_nosort">ServiceCode</th>
    <th>Required Date</th>
    <th>Required Time</th>
    <th>Status</th>
    <th>Action</th>
    </tr>
    ';
    while($row = mysqli_fetch_array($result))
    {
      $output .= '
      <tr>
      <td>'.$row["requestID"].'</td>
      <td>'.$row["serviceDescription"].'</td>
      <td>'.$row["code"].'</td>
      <td>'.$row["reqDate"].'</td>
      <td>'.$row["reqTime"].'</td>
      <td>'.$row["status"].'</td>
      <td><a class="btn btn-small btn-primary edit_data" id='.$row["requestID"].'>Edit</a></td>
      </tr>
      ';
    }
    $output .= '</table>';
  }
  echo $output;
}
?>
