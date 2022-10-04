<?php include('../php/server.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap Links -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!-- StyleSheet -->
  <link rel="stylesheet" href="../css/logincss.css">
  <title>Sign Up Page</title>
</head>
<body id="signUp">
  <div class="container">
    <div class="header-container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
    </div>
    <div class="main-info">
      <div class="info-top">
        <form action="signup.php" method="post">
          <?php include('../php/errors.php'); ?>
          <input id="username" class="text" type="text" placeholder="Enter Username" name="username" value="<?php echo $username1; ?>">
          <span id="username_status" style="color:red;"></span>

          <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="at least one number, one uppercase and one lowercase and at least 8 character" -->
          <input class="text password" type="password" placeholder="Enter Password" name="password">

          <input class="text" type="password" placeholder="Repeat Password" name="password_1">

          <input class="text fullname" type="text" placeholder="Enter Fullname" name="full-name">

          <input class="text fullname" type="number" placeholder="Enter Mobile Number" name="mobileNo">

          <textarea class="special-txt" name="address" rows="4" cols="22" placeholder="Enter your address"></textarea>

          <label for="userType">Are you a:
            <input type="radio" name="userType" value="seniorCitizen">Senior
            <input type="radio" name="userType" onclick="showMe()" value="serviceProvider">Service Provider
          </label>

          <div id="display-box">
            <label for="serviceType">Select a service code: </label>
            <select id="selection" class="service-code" name="serviceCode">
              <option value="default">Please select...</option>
              <option value="A4531">A4531 - Cleaning</option>
              <option value="A4532">A4532 - Cooking</option>
              <option value="A4533">A4533 - Driving</option>
              <option value="A4534">A4534 - Shopping</option>
              <option value="A4535">A4535 - Playing</option>
            </select>
          </div>
          <hr>
          <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

          <div class="regcan-btn">
            <input onclick="location.href='index.php'" type="button" class="cancelbtn" value="Cancel">
            <input type="submit" name="register" class="registerbtn" value="Register">
          </div>
        </form>

        <p>Already have an account? <a href="index.php">Login now!</a>.</p>
      </div>
    </div>
  </div>


  <!-- JQuery Library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- A script to restrict checkbox only able to check one -->
  <script type="text/javascript">
  $("#display-box").hide();
  $("input[type='radio']").change(function(){
    if($(this).val() == "serviceProvider"){
      $("#display-box").show();
    } else {
      $("#display-box").hide();
    }
  });

  $('select > option:first').hide();


  $('#username').keyup( function() {
    var username = $(this).val();
    $('#username_status').text('Searching...');
    if(username != '') {
      $.post('../php/username_check.php', { username: username}, function(data) {
        $('#username_status').text(data);
      });
    } else {
      $('#username_status').text('');
    }
  });
  </script>
</body>
</html>
