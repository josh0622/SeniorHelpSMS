
<?php include('../php/server.php');
$con=mysqli_connect('localhost','root','','service');
// if user is not logged in, they cannot access this page
if (empty($_SESSION['username'])) {
  header('location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <style>
  .side {
    float: left;
    width: 15%;
    margin-top:10px;
  }

  .middle {
    margin-top:10px;
    float: left;
    width: 70%;
  }

  /* Place text to the right */
  .right {
    text-align: right;
  }

  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }

  /* The bar container */
  .bar-container {
    width: 100%;
    background-color: #f1f1f1;
    text-align: center;
    color: white;
  }

  /* Individual bars */
  .bar-5 {width: 60%; height: 18px; background-color: #4CAF50;}
  .bar-4 {width: 30%; height: 18px; background-color: #2196F3;}
  .bar-3 {width: 10%; height: 18px; background-color: #00bcd4;}
  .bar-2 {width: 4%; height: 18px; background-color: #ff9800;}
  .bar-1 {width: 15%; height: 18px; background-color: #f44336;}


  body{
    height: 70%;
  }
  #rating {
    font-family: Arial;
    width: 300px;
    font-size: 15px;
    margin-top: 20px;

  }
  #reviewtable td, #reviewtable th {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  #reviewtable tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  #reviewtable tr:not(:first-child):hover {
    background-color: #ddd;
  }

  #reviewtable th {
    padding-top: 12px;
    padding-bottom: 12px;
    background-color: #4CAF50;
    color: white;
  }
  #reviewtable{
    width:90%;
  }
  </style>
  <!-- viewport -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap Components -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" htrf="../css/commentsBox.css">
  <script src="../js/review.js"></script>


  <title>Review</title>
</head>
<body>
  <!-- Navitgation bar using fixed top and inverse -->
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

<header>
  <?php if($_SESSION['username']['userType']=="seniorCitizen"):?>
    <div style="margin-top:80px;">
      <center><h3>Review</h3></center>
    </div>



    <center>
      <table id="reviewtable">
        <tr>
          <th>RequestID</th>
          <th>Service Code</th>
          <th>Service Requested</th>
          <th>Provider Name</th>
          <th>Date</th>
          <th>Status</th>
          <th>Review</th>
        </tr>
        <tr>
          <?php

          $sql = "SELECT * FROM servicerequests INNER JOIN seniorcitizen ON seniorcitizen.citizenUsername = servicerequests.citizenUsername AND seniorcitizen.citizenUsername = '".$_SESSION['username']['username']."' AND servicerequests.status = 'Completed'";
          $result=mysqli_query($con,$sql);
          //connect to database
          if (mysqli_num_rows($result) ) {
            while($row = mysqli_fetch_array($result) ){
              $provider = $row['providerUsername'];
              $requestID = $row['requestID'];
              echo"<tr>";
              echo"<td>".$row['requestID']."</td>";
              echo"<td>".$row['code']."</td>";
              echo"<td>".$row['serviceRequested']."</td>";
              echo"<td>".$row['providerUsername']."</td>";
              echo"<td>".$row['reqDate']."</td>";
              echo "<td>".$row['status']."</td>";
              echo "<td><a method=\"POST\" href=\"comments.php?providerUsername=$provider\" >Review</a></td>";
              echo"</tr>";
            }
          }
          ?>
        </table>
      </center>
    <?php endif;  ?>
  </header>



</body>
</html>
