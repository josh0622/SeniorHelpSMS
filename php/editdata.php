<?php
    // connecting to database
    $servername = "localhost";
    $username = "root";
    $serverPassword = "";
    $dbname = "service";
    $con = mysqli_connect($servername, $username, $serverPassword, $dbname);

    $id = $_GET['requestID'];

    if (isset($_POST['submit'])) {
    	$id = $_POST['requestID'];
    	$name = $_POST['reqDate'];
    	$phone = $_POST['reqTime'];
    	$address = $_POST['notes'];
    	$email = $_POST['status'];
      $sql = "UPDATE servicerequests SET reqDate = $name, reqTime = $phone, notes=$address, status=$email WHERE requestID = $id";
    	$result = mysqli_query($con, $sql);
    	header("location:manage.php");
    }

    $query = "SELECT * FROM servicerequests WHERE requestID = $id";
    $result2 = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form method="post" action="editdata.php" role="form">
	<div class="modal-body">
		<div class="form-group">
		    <label for="id">ID</label>
		    <input type="text" class="form-control" id="id" name="id" value="<?php echo $row['requestID'];?>" readonly="true"/>
		</div>
		<div class="form-group">
		    <label for="name">Name</label>
	            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['reqDate'];?>" />
		</div>
		<div class="form-group">
		    <label for="phone">Phone</label>
	            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['reqTime'];?>" />
		</div>
		<div class="form-group">
		     <label for="address">Address</label>
		     <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['notes'];?>" />
		</div>
		<div class="form-group">
                     <label for="email">Email</label>
		     <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['status'];?>" />
		</div>
		</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</form>
</body>
</html>
