
<?php include '../php/server.php';
if (empty($_SESSION['username'])) {
  header('location: index.php');
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Components -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/acceptService.css">
    <title>Accept Service</title>
    <style>
    td, th {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:not(:first-child):hover {
      background-color: #ddd;
    }

    th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #4CAF50;
        color: white;
    }
    table{
      width:90%;
    }

    </style>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <!-- Hamburger Component after screen size decreases -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#dropDown" aria-controls="dropDown"
        aria-expanded="false" aria-label="Toggle navigation"><div class="animated-icon1"><span></span><span></span><span></span></div>
        </button>
        <a class="navbar-brand" href="home.html">SeniorHelp</a>
      </div>
      <!-- Navigation Components -->
      <div class="collapse navbar-collapse" id="dropDown">
        <ul class="nav navbar-nav navbar-left">
          <?php if($_SESSION['username']['userType']=="serviceProvider"):?>
              <li><a href="homeProvider.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
          <?php endif; ?>
          <?php if($_SESSION['username']['userType']=="seniorCitizen"):?>
              <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
          <?php endif; ?>
          <?php if ($_SESSION['username']['userType'] == "serviceProvider"): ?>
              <li><a href="serviceAccept.php"><span class="glyphicon glyphicon-list-alt"></span> Request</a></li>
          <?php endif; ?>
          <?php if ($_SESSION['username']['userType'] == "seniorCitizen"): ?>
              <li><a href="service.php"><span class="glyphicon glyphicon-list-alt"></span> Services</a></li>
          <?php endif; ?>
          <?php if($_SESSION['username']['userType']=="seniorCitizen"):?>
              <li><a href="manage.php"><span class="glyphicon glyphicon-folder-open"></span> Manage</a></li>
          <?php endif; ?>
          <li><a href="review1.php"><span class="glyphicon glyphicon-comment"></span> Review</a></li>
        </ul>
        <!-- Login and Sign Up Components -->
        <ul class="nav navbar-nav navbar-right">
          <?php if (isset($_SESSION['username'])): ?>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome,<?php echo $_SESSION['username']['username']; ?></a></li>
          <?php endif; ?>
          <li><a href="index.php?logout='1'"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>
<div class="Text">
  <center><h3>Service Requests</h3></center>
</div>
<center>
  <table id="second-tb">
    <tr>
      <th>Date</th>
      <th>Note</th>
      <th>Status</th>
    <tr>
      <?php
      $con=mysqli_connect('localhost','root','','service');
      if(!$con){
        echo"connection fail";
      }
      $requestid=$_GET['requestID'];
      if(empty($requestid)){
        header('Location:serviceAccept.php');
      }else{

      $query="SELECT * FROM  servicerequests WHERE requestID= $requestid";
      $result=mysqli_query($con,$query);
      while($row=mysqli_fetch_array($result)){
        echo"<tr>";
        echo"<td>".$row['reqDate']."</td>";
        echo"<td>".$row['notes']."</td>";
        echo"<td>".$row['status']."</td>";
        echo"</tr>";
        $checkDate=$row['reqDate'];
      }
      }


       ?>
  </table>

  <form class="comments"  method="post">
     <textarea  name="comment" rows="5" cols="50" placeholder="What you want to say?" ><?php echo $row['comment']?></textarea>
   <ul>
     <li><button type="accept" name="accept" value="accept">Accept</button></li>
     <li><input type="button" value="Back" onclick="window.location='serviceAccept.php';"></li>
   </ul>
   <?php
   if(isset($_REQUEST['accept'])){
     $sqll="SELECT reqDate FROM servicerequests INNER JOIN serviceprovider ON serviceprovider.providerUsername = servicerequests.providerUsername AND serviceprovider.providerUsername = '".$_SESSION['username']['username']."' AND servicerequests.status = 'Accepted'";
     $result1=mysqli_query($con,$sqll);
     $check=mysqli_fetch_assoc($result1);
     if(in_array($checkDate,$check)){
      echo '<script language="javascript">';
      echo 'alert("You already have a request at the date")';
      echo '</script>';

      $URL = "../html/serviceAccept.php";
      echo "<script> location.href='$URL'</script>";
     }else{
      $comment = $_POST['comment'];
      $username1 = $_SESSION['username']['username'];
      $sql="UPDATE servicerequests Set status ='Accepted', notes = '$comment', providerUsername = '$username1'  WHERE requestID = $requestid";
      $result = mysqli_query($con,$sql);
      header("Location:serviceAccept.php");
     }
   }
   $con->close();
   ?>
 </form>
 </center>
  </body>

</html>
