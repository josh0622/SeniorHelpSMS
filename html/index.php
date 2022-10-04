<?php include('../php/server.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap Plugin -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
  <!-- Inline Stylesheet -->
  <style media="screen">
  .error {
    width: 280px;
    margin: 30px auto;
    padding: 10px;
    border: 1px solid #a94442;
    color: #a94442;
    background: #f2dede;
    border-radius: 5px;
    text-align: center;
  }
  /* Login Style */
  #login,html {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background-image: url("../images/login_img.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: 100%;
  }

  .login-box {
    width: 280px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
  }

  .login-box h1{
    float: left;
    font-size: 40px;
    border-bottom: 6px solid #4caf50 ;
    margin-bottom: 50px;
    padding: 13px 0;
  }

  .textbox {
    width: 100%;
    overflow: hidden;
    font-size: 20px;
    padding: 8px 0;
    margin: 8px 0;
    border-bottom: 1px solid #4caf50;
  }

  .textbox i {
    width: 26px;
    float: left;
    text-align: center;
  }

  .textbox input {
    border: none;
    outline: none;
    background: none;
    color: white;
    font-size: 18px;
    width: auto;
    float: left;
    margin: 0 10px;
  }

  .textbox ::placeholder {
    color:white;
  }

  .btn-login{
    display: inline-block;
    width: 49%;
    background: none;
    border: 2px solid #4caf50;
    color: white;
    padding: 5px;
    font-size: 18px;
    cursor: pointer;
    margin: 12px 0;
  }

  .btn-signup {
    width: 49%;
    background: none;
    border: 2px solid #4caf50;
    color: white;
    padding: 5px;
    font-size: 18px;
    cursor: pointer;
    margin: 12px 0;
  }

  input[type="submit"]:hover, input[type="button"]:hover {
    background: black;
  }

  </style>
  <title>Login Form</title>
</head>
<body id="login">
  <form action="index.php" method="post">
    <?php include('../php/errors.php'); ?>
    <div class="login-box">
      <h1>Login</h1>
      <div class="textbox">
        <i class="fa fa-user" aria-hidden="true"></i>
        <input type="text" placeholder="Username" name="username" value="<?php echo $username1; ?>">
      </div>

      <div class="textbox">
        <i class="fa fa-lock" aria-hidden="true"></i>
        <input type="password" placeholder="Password" name="password" value="">
      </div>

      <input onclick="location.href='signup.php'" class="btn-signup" type="button" name="signup" value="Sign Up">
      <input class="btn-login" type="submit" name="login" value="Login">
    </div>
  </form>
</body>
</html>
