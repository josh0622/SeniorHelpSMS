<?php
if (isset($_POST["serviceCode"]))
{
  $output = '';
  $connect = mysqli_connect('localhost', 'root', '', 'service');
  $query = "SELECT * FROM serviceType INNER JOIN servicerequest ON serviceType.serviceCode = servicerequests.serviceCode AND serviceCode = '".$_POST["serviceCode"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<div class="table-responsive">
  <table class="table table-bordered">';

  while ($row = mysqli_fetch_array($result)) {
    $output .=
    '
    <tr>
    <td width="30%"><label>Required Date</label></td>
    <td width="70%"><label>'.$row['reqDate'].'</td>
    </tr>

    <tr>
    <td width="30%"><label>Required Time</label></td>
    <td width="70%"><label>'.$row['reqTime'].'</td>
    </tr>

    <tr>
    <td width="30%"><label>Notes</label></td>
    <td width="70%"><label>'.$row['notes'].'</td>
    </tr>

    <tr>
    <td width="30%"><label>Status</label></td>
    <td width="70%"><label>'.$row['status'].'</td>
    </tr>
    ';
  }

  $output .= '
  </table>
  </div>
  ';
  echo $output;
}
?>
