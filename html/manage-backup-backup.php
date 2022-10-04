<?php include('../php/server.php');
// if user is not logged in, they cannot access this page
if (empty($_SESSION['username'])) {
  header('location: index.php');
}

$con = mysqli_connect('localhost', 'root', '', 'service');
if ($_SESSION['username']['userType'] == 'serviceProvider') {
  $sql = "SELECT * FROM servicerequests INNER JOIN serviceType ON servicerequests.code = serviceType.serviceCode AND servicerequests.providerUsername = '".$_SESSION['username']['username']."' AND servicerequests.status = 'Accepted' ORDER BY requestID ASC";
} else {
  $sql = "SELECT * FROM servicerequests INNER JOIN serviceType ON servicerequests.code = serviceType.serviceCode AND servicerequests.citizenUsername = '".$_SESSION['username']['username']."' ORDER BY requestID ASC";
}
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <!-- viewport -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap Components -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../js/sorttable.js"></script>
  <link rel="stylesheet" href="../css/logincss.css">
  <title>Manage Services</title>
</head>
<body id="manage">
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
        <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <?php if ($_SESSION['username']['userType'] == "serviceProvider"): ?>
          <li><a href="serviceAccept.php"><span class="glyphicon glyphicon-list-alt"></span> Request</a></li>
        <?php endif; ?>
        <?php if ($_SESSION['username']['userType'] == "seniorCitizen"): ?>
          <li><a href="service.php"><span class="glyphicon glyphicon-list-alt"></span> Services</a></li>
        <?php endif; ?>
        <li><a href="manage.php"><span class="glyphicon glyphicon-folder-open"></span> Manage</a></li>
        <li><a href="review1.php"><span class="glyphicon glyphicon-comment"></span> Review</a></li>
      </ul>
      <!-- Login and Sign Up Components -->
      <ul class="nav navbar-nav navbar-right">
        <?php if (isset($_SESSION['username'])): ?>
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome,<?php echo $_SESSION['username']['username']; ?></a></li>
        <?php endif ?>
        <li><a href="index.php?logout='1'"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<header>
  <div class="table-head">
    <h1>Manage Request/Service</h1>
    <h4>Click on table header to sort:</h4>
  </div>

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

    <?php
    if (mysqli_num_rows($result) > 0 ) {
      while($row = mysqli_fetch_array($result))
      {
        ?>
        <tr>
          <td><?php echo $row["requestID"]; ?></td>
          <td><?php echo $row["serviceDescription"]; ?></td>
          <td><?php echo $row["code"]; ?></td>
          <td><?php echo $row["reqDate"]; ?></td>
          <td><?php echo $row["reqTime"]; ?></td>
          <td><?php echo $row["status"]; ?></td>
          <td><a class="btn btn-small btn-primary view_data" id="<?php echo $row["requestID"];?>">Edit</a></td>
        </tr>
        <?php
      }
    }
    ?>
  </table>
</header>

<div class="modal fade" id="dataModal" role="dialog">
  <div class="modal-dialog modal-md vertical-align-center">
    <div class="modal-content animate">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Service Request</h4>
      </div>
      <div class="modal-body" id="employee_detail">

      </div>
      <div class="modal-footer">
        <button type="button" id="danger-btn" data-dismiss="modal" class="btn btn-sm">Close</button>
        <button type="button" id="update-btn" class="btn btn-sm">Update Details</button>
        <button type="button" id="special-btn" class="btn btn-sm"><a href="review1.html">Review User</a></button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $(document).on('click', '.view_data', function(){
    //$('#dataModal').modal();
    var requestID = $(this).attr("id");
    $.ajax({
      url:"../php/select.php",
      method:"POST",
      data:{requestID:requestID},
      success:function(data){
        $('#employee_detail').html(data);
        $('#dataModal').modal('show');
      }
    });
  });
});

// a script to send the service code to the text field
/*
var table = document.getElementById('managetb-display');
for(var i = 1; i < table.rows.length; i++){
table.rows[i].onclick=function(){
document.getElementById("rid").value = this.cells[0].innerHTML;
};
}*/

function setModalMaxHeight(element) {
  this.$element     = $(element);
  this.$content     = this.$element.find('.modal-content');
  var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
  var dialogMargin  = $(window).width() < 768 ? 20 : 60;
  var contentHeight = $(window).height() - (dialogMargin + borderWidth);
  var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
  var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
  var maxHeight     = contentHeight - (headerHeight + footerHeight);

  this.$content.css({
    'overflow': 'hidden'
  });

  this.$element
  .find('.modal-body').css({
    'max-height': maxHeight,
    'overflow-y': 'auto'
  });
}

$('.modal').on('show.bs.modal', function() {
  $(this).show();
  setModalMaxHeight(this);
});

$(window).resize(function() {
  if ($('.modal.in').length != 0) {
    setModalMaxHeight($('.modal.in'));
  }
});
</script>
</body>
</html>
