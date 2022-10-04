
<?php include '../php/server.php';
$con=mysqli_connect('localhost','root','','service');
if(!$con){
  echo"connection fail";
}
//get data from database

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
    .textbox{
      margin-top: 10px;
    }
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
          <?php if ($_SESSION['username']['userType'] == "serviceProvider"): ?>
          <li><a href="comments.php"><span class="glyphicon glyphicon-comment"></span> Review</a></li>
          <?php endif;?>
          <?php if($_SESSION['username']['userType']=="seniorCitizen"):?>
          <li><a href="review1.php"><span class="glyphicon glyphicon-comment"></span> Review</a></li>
          <?PHP endif;?>
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
  <?php $sql = "SELECT * FROM servicerequests INNER JOIN serviceProvider ON servicerequests.code = serviceprovider.serviceCode AND serviceProvider.providerUsername = '".$_SESSION['username']['username']."' AND status = 'Pending'";
  $result=mysqli_query($con,$sql);
  if(mysqli_num_rows($result) > 0):?>
<div class="Text">
  <center>
  <h3>Service Requests</h3>
  <form class="textbox" action="serviceAccept2.php" method="get">
      <label for="code">Request ID:
      <input type="text" name="requestID" id="code">
      </label>
      <input type="submit" value="View" name="submit">
  </form>
</center>
</div>

<center>
  <table id="second-tb">
    <tr>
      <th>RequestID</th>
      <th>Service Code</th>
      <th>Service Requested</th>
      <th>Date</th>
      <th>Status</th>
    <tr>
      <?php

      $sql = "SELECT * FROM servicerequests INNER JOIN serviceProvider ON servicerequests.code = serviceprovider.serviceCode AND serviceProvider.providerUsername = '".$_SESSION['username']['username']."' AND status = 'Pending'";
      $result=mysqli_query($con,$sql);
      //connect to database
      if (mysqli_num_rows($result) > 0 ) {
          while($row = mysqli_fetch_array($result) ){
          echo"<tr>";
          echo"<td>".$row['requestID']."</td>";
          echo"<td>".$row['code']."</td>";
          echo"<td>".$row['serviceRequested']."</td>";
          echo"<td>".$row['reqDate']."</td>";
          echo"<td>".$row['status']."</td>";
          echo"</tr>";
        }
      }

      ?>
  </table>
</center>
<?php endif;?>
<?PHP if(mysqli_num_rows($result) == 0):?>
<center>
<img src="../images/No-data-found-banner.png" >
</center>
<?php endif;?>



  <script type="text/javascript">
    var table = document.getElementById('second-tb');

    for(var i = 1; i < table.rows.length; i++){
      table.rows[i].onclick=function(){
        document.getElementById("code").value = this.cells[0].innerHTML;
      };
    }
  </script>
  </body>

</html>
