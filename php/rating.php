<?php
if(isset($_POST)){
  $conn = mysqli_connect('localhost','root','','service');
  if(mysqli_query($conn,"INSERT INTO comments(id,reviewer, providerUsername, body,rating, created_at, updated_at) VALUES ('','".$_POST['v1']."', '".$_POST['v2']."','".$_POST['v3']."','".$_POST['v4']."',now(),null)")){
  }
}
 ?>
