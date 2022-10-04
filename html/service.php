<?php include('../php/server.php');
// if user is not logged in, they cannot access this page
if (empty($_SESSION['username'])) {
  header('location: index.php');
}

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <link rel="stylesheet" href="../css/logincss.css">

  <title>Request Services</title>
</head>
<body id="service">
  <!-- Navitgation bar using fixed top and inverse -->
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <!-- Hamburger Component after screen size decreases -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#dropDown" aria-controls="dropDown"
        aria-expanded="false" aria-label="Toggle navigation"><div class="animated-icon1"><span></span><span></span><span></span></div>
      </button>
      <a class="navbar-brand" href="home.php">SeniorHelp</a>
    </div>
    <!-- Navigation Components -->
    <div class="collapse navbar-collapse" id="dropDown">
      <ul class="nav navbar-nav navbar-left">
        <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="service.php"><span class="glyphicon glyphicon-list-alt"></span> Services</a></li>
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
<!-- Table Section -->
<header>
  <div class="table-head">
    <h1> Request Services </h1>
  </div>
  <table id="tb-display">
    <tr>
      <th>Service Code</th>
      <th>Service Type</th>
      <th>Description</th>
    </tr>

    <tr>
      <td>A4531</td>
      <td>Cleaning</td>
      <td>This is a cleaning service.</td>
    </tr>

    <tr>
      <td>A4532</td>
      <td>Cooking</td>
      <td>This is a cooking service.</td>
    </tr>

    <tr>
      <td>A4533</td>
      <td>Driving</td>
      <td>This is a driving service.</td>
    </tr>

    <tr>
      <td>A4534</td>
      <td>Shopping</td>
      <td>This is a shopping service.</td>
    </tr>

    <tr>
      <td>A4535</td>
      <td>Playing</td>
      <td>This is a playing service.</td>
    </tr>
  </table>
</header>

<div class="form-style-2">
  <div class="form-style-2-heading">
    Service Request Form
  </div>
  <form onsubmit="return confirm('Do you really want to request the service?');" action="service.php" method="post" id="formfield">
    <label for="code"><span>Service Code <span class="required">*</span></span>
      <input style="background-color: white;" type="text" class="input-field" id="code" name="code" placeholder="Enter Service Code" readonly/>
    </label>

    <label for="reqDate"><span>Date <span class="required">*</span></span>
      <input type="date" class="input-field-2" id="date" name="reqDate" placeholder="Enter a date" readonly/>
    </label>

    <label for="reqTime"><span>Time <span class="required">*</span></span>
      <input type="time" class="input-field-2" id="time" name="reqTime" placeholder="Enter a time" readonly/>
    </label>

    <label for="reqDuration"><span>Duration <span class="required">*</span></span>
      <select id = "myList" style="height: 25px; width: 200px; background-color: white; font-weight: normal;">
        <option value = "default">Please select a duration</option>
        <option value = "1 hour">1 Hour</option>
        <option value = "2 hour">2 Hour</option>
        <option value = "3 hour">3 Hour</option>
        <option value = "4 hour">4 Hour</option>
      </select>
    </label>

    <label for="notes"><span>Notes <span class="required">*</span></span>
      <textarea name="notes" class="textarea-field" placeholder="Enter Additional Notes..." required></textarea>
    </label>

    <label><span>&nbsp;</span>
      <input type="submit" name="openSub" value="Request" id="submitBtn"/>
    </label>
  </form>
</div>

<div class="modal fade" id="modelWindowSub" role="dialog">
  <div class="modal-dialog modal-sm, vertical-align-center">
    <div class="modal-content animate">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation Service Request</h4>
      </div>
      <div class="modal-body">
        <form id="insert_form" action="service.php" method="post">
          <label for="displayDate">RequestID
            <input type="text" name="input-field" id="requestInput" class="form-control" value="R001" readonly>
          </label>

          <label for="updateStatus">Status:
            <input type="text" name="input-field" id="statusInput" class="form-control" value="Pending" readonly>
          </label>

          <label for="updateCode">Service Code:
            <input type="text" name="input-field" id="codeInput" class="form-control" readonly>
          </label>

          <label for="displayDate">Required Date:
            <input type="text" name="input-field" id="dateInput" class="form-control" readonly>
          </label>

          <label for="displayTime">Required Time:
            <input type="text" name="input-field" id="timeInput" class="form-control" readonly>
          </label>

          <label for="updateNotes">Notes:
            <textarea class="form-control" name="updateNotes" id="noteInput" rows="4" cols="50" readonly></textarea>
          </label>

          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="danger-btn" data-dismiss="modal" class="btn btn-sm">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Jqeury Components -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<!-- Js for sending input form table to text fields -->
<script type="text/javascript">
var table = document.getElementById('tb-display');
for(var i = 1; i < table.rows.length; i++){
  table.rows[i].onclick=function(){
    document.getElementById("code").value = this.cells[0].innerHTML;
  };
}

// hide first option
$('select > option:first').hide();

// a query to enable date to be supported on safari 'iOS'
//if browser doesn't support input type="date", load files for jQuery UI Date Picker
var datefield = document.createElement("input")
datefield.setAttribute("type", "date")
if (datefield.type!="date"){
  document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
  document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"><\/script>\n')
}
// a query to disable past or today's date
//if browser doesn't support input type="date", initialize date picker widget:
if (datefield.type != "date"){
  $(document).ready(function() {
    $('#date').datepicker({
      minDate: 1
    });
  });
}

// enable time widget
$('#time').timepicker({
  timeFormat: 'H:mm:ss',
  interval: 30,
  minTime: '9',
  maxTime: '9:00pm',
  startTime: '9:00am',
  dynamic: false,
  dropdown: true,
  scrollbar: true
});

// validation for date to be able to pick after today's date
var today = new Date().toISOString().split('T')[0];
document.getElementsByName("reqDate")[0].setAttribute('minDate', dateToday);

var dateToday = new Date();
var dates = $("#date, #date").datepicker({
  defaultDate: "+1w",
  changeMonth: true,
  numberOfMonths: 3,
  minDate: dateToday,
  onSelect: function(selectedDate) {
    var option = this.id == "date" ? "minDate" : "maxDate",
    instance = $(this).data("datepicker"),
    date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
    dates.not(this).datepicker("option", option, date);
  }
});

// a function to set the modal screen to the middle of the page (responsive)
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

if ( window.history.replaceState ) {
        window.historys.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>
