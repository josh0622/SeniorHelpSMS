<?php include('../php/server.php');
// if user is not logged in, they cannot access this page
if (empty($_SESSION['username'])) {
  header('location: index.php');
}

$con = mysqli_connect('localhost', 'root', '', 'service');

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
      <th class="sorttable_nosort">Service Description</th>
      <th class="sorttable_nosort">ServiceCode</th>
      <th>Required Date</th>
      <th>Required Time</th>
      <th>Status</th>
    </tr>

    <?php
    if ($_SESSION['username']['userType'] == 'serviceProvider') {
      $sql = "SELECT * FROM servicerequests INNER JOIN serviceType ON servicerequests.code = serviceType.serviceCode AND servicerequests.providerUsername = '".$_SESSION['username']['username']."' AND servicerequests.status = 'Accepted'";
    } else {
      $sql = "SELECT * FROM servicerequests INNER JOIN serviceType ON servicerequests.code = serviceType.serviceCode AND servicerequests.citizenUsername = '".$_SESSION['username']['username']."'";
    }
    $result = mysqli_query($con,$sql);
    //check if query result returned is more than 0 then add to the arraylist
    if (mysqli_num_rows($result) > 0 ) {
      while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>".$row['requestID']."</td>";
        echo "<td>".$row['serviceDescription']."</td>";
        echo "<td>".$row['code']."</td>";
        echo "<td>".$row['reqDate']."</td>";
        echo "<td>".$row['reqTime']."</td>";
        echo "<td>".$row['status']."</td>";
        echo "</tr>";
      }
    }

    $result->close();
    ?>
  </table>
</header>

<main>
  <div class="form-style-3">
    <div class="form-style-2-heading">
      Service Request Form
    </div>
    <form action="manage.php" method="post" id="form-search">
      <label for="code"><span>Request ID:</span>
        <input type="text" class="input-field" id="rid" name="rid" placeholder="Enter Request ID" readonly/>
      </label>
      <input type="button" name="openModalWindow" class="openModalWindow" value="Submit" />
    </form>
  </div>
</main>

<div class="modal fade" id="modelWindow" role="dialog">
  <div class="modal-dialog modal-md vertical-align-center">
    <div class="modal-content animate">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Service Request</h4>
      </div>
      <div class="modal-body">
        <label for="displayDate">Required Date:
          <input type="text" name="input-field" name="displayDate" id="displayDate">
        </label>

        <label for="displayDate">Required Time:
          <input type="text" name="input-field" name="displayTime" id="displayTime">
        </label>

        <label for="updateNotes">Notes:
          <textarea class="textarea-field" name="updateNotes" id="updateNotes" rows="4" cols="50"></textarea>
        </label>

        <label for="updateStatus">Status: </label>
        <select class="statusChoice" name="statusChoice" id="statusChoice">
          <option value="Pending">Pending</option>
          <option value="Cancelled">Cancelled</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" id="danger-btn" data-dismiss="modal" class="btn btn-sm">Close</button>
        <button type="button" id="update-btn" class="btn btn-sm">Update Details</button>
        <button type="button" id="special-btn" class="btn btn-sm"><a href="review1.html">Review User</a></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
// a script to send the service code to the text field
var table = document.getElementById('managetb-display');
for(var i = 1; i < table.rows.length; i++){
  table.rows[i].onclick=function(){
    document.getElementById("rid").value = this.cells[0].innerHTML;
  };
}

// opens the modal when update button is clicked
$(document).on('click', '.openModalWindow', function () {
  $('#modelWindow').modal('show');
});

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
