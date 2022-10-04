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
  <!-- <link rel="stylesheet" href="../css/logincss.css"> -->
  <style media="screen">
  /* Icon 3*/
  .animated-icon1{
    width: 30px;
    height: 20px;
    position: relative;
    margin: 0px;
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
    -webkit-transition: .5s ease-in-out;
    -moz-transition: .5s ease-in-out;
    -o-transition: .5s ease-in-out;
    transition: .5s ease-in-out;
    cursor: pointer;
  }

  .animated-icon1 span{
    display: block;
    position: absolute;
    height: 2px;
    width: 100%;
    border-radius: 9px;
    opacity: 1;
    left: 0;
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
    -webkit-transition: .25s ease-in-out;
    -moz-transition: .25s ease-in-out;
    -o-transition: .25s ease-in-out;
    transition: .25s ease-in-out;
  }

  .animated-icon1 span {
    background: #e3f2fd;
  }

  .animated-icon1 span:nth-child(1) {
    top: 0px;
  }

  .animated-icon1 span:nth-child(2) {
    top: 8px;
  }

  .animated-icon1 span:nth-child(3) {
    top: 16px;
  }

  .animated-icon1.open span:nth-child(1) {
    top: 11px;
    -webkit-transform: rotate(135deg);
    -moz-transform: rotate(135deg);
    -o-transform: rotate(135deg);
    transform: rotate(135deg);
  }

  .animated-icon1.open span:nth-child(2) {
    opacity: 0;
    left: -60px;
  }

  .animated-icon1.open span:nth-child(3) {
    top: 11px;
    -webkit-transform: rotate(-135deg);
    -moz-transform: rotate(-135deg);
    -o-transform: rotate(-135deg);
    transform: rotate(-135deg);
  }

  /* Core Styles */
  #home{
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
    background: #333;
    color: #fff;
    font-size: 14px;
    line-height: 1.5;
  }

  nav {
    top : 0;
    position: fixed;
  }

  #home img {
    display: block;
    width: 100%;
    height: 200px;
    border-bottom: 1px solid black;
  }

  #home h1, h2, h3 {
    margin: 0;
    padding: 1em 0;
    text-align: center;
  }

  #home p {
    margin: 0;
    padding: 1em 0;
    text-align: center;
  }

  /* Header Showcase */
  #showcase {
    min-height: 375px;
    color: #fff;
    text-align: center;
  }

  #showcase .bg-image{
    position: absolute;
    background: #333 url("../images/seniorCitizen.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: 375px;
    z-index: -1;
    opacity: 0.4;
  }

  #showcase h1{
    padding-top: 100px;
    padding-bottom: 0;
  }

  #showcase .content-wrap,
  #section-a .content-wrap{
    padding: 0 1em;
  }

  /* Section A*/
  #section-a {
    background: #eaeaea;
    color: #333;
    padding-bottom: 2em;
  }

  /* Section B */
  #section-b{
    padding: 1em 2em;
  }

  #section-b ul{
    list-style: none;
    margin: 0;
    padding: 0;
  }

  #section-b li{
    margin-bottom: 1em;
    background: #fff;
    color: #333;
  }

  .card-content {
    padding: 1em;
  }

  .card-content p {
    color: black;
  }

  /* Section C */
  #section-c {
    background: #fff;
    color: #333;
    padding: 2em;
  }

  /* Section D / Boxes */
  #section-d .box {
    padding: 2em;
    color: #fff;
  }

  #section-d .box:first-child{
    background: #2690d4;
  }

  /* Footer */
  #main-footer{
    padding: 2em;
    background: #000;
    color: #fff;
    text-align: center;
  }

  @media (min-width: 700px){

    /* Grid Styles */
    .grid {
      display: grid;
      grid-template-columns: 1fr repeat(2, minmax(auto, 25em)) 1fr;
    }

    #section-a .content-text {
      columns: 2;
      column-gap: 2em;

    }

    #section-a .content-text p {
      padding-top: 0;
      color: black;
    }

    .content-wrap, #section-b ul {
      grid-column: 2/4;
    }

    .box, #main-footer div {
      grid-column: span 2;
    }

    #section-b ul {
      display: flex;
      justify-content: space-around;
    }

    #section-b li {
      width: 31%;
    }

    .sides {
      animation: 0.7s curtain cubic-bezier(.86,0,.07,1) 0.4s both;
      display: grid;
      grid-template-columns: 23vw 50vw;
    }

    #home .sides .card img {
      width: 100%;
      height: 150px;
    }

    @keyframes curtain {
      0% {
        grid-gap: 50vw;
      }

      100% {
        grid-gap: 0;
      }
    }

    #main-footer{
      padding: 2em;
      background: #000;
      color: #fff;
      text-align: center;
      display: block;
    }
  }
  </style>
  <title>SeniorHelp Homepage</title>
</head>
<body id="home">
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
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome, <?php echo $_SESSION['username']['username']; ?></a></li>
        <?php endif ?>
        <li><a href="index.php?logout='1'"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- Header Showcase -->
<header>
  <div id="showcase" class="grid">
    <div class="bg-image"></div>
    <div class="content-wrap">
      <h1>Welcome to SeniorHelp Service Matching System</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et
        dolore magna aliqua. Ut enim ad m</p>
        <select id = "myList" style="height: auto; width: 200px; background-color: grey; font-weight: normal;" onchange="changeSize(this);">
          <option value = "default">Select a font size</option>
          <option value = "20">20px</option>
          <option value = "25">25px</option>
          <option value = "30">30px</option>
          <option value = "35">35px</option>
        </select>
      </div>
    </div>
  </header>
  <!-- Main Area -->
  <main id="main">
    <!-- Section A -->
    <section id="section-a" class="grid">
      <div class="content-wrap">
        <h2 class="content-title">SeniorHelp History</h2>
        <div class="content-text">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu purus quis nulla pharetra cursus eget interdum lorem. Phasellus sed lacus in mi sollicitudin vestibulum ut a justo. Aenean egestas, eros ut pulvinar laoreet, augue nisi pharetra urna, vitae faucibus eros magna vel velit. Aenean elementum finibus libero, ut porta ipsum sagittis bibendum. Quisque sed maximus libero. Pellentesque eu blandit ex. Cras sit amet suscipit ipsum. Suspendisse non nunc nec enim tristique scelerisque.</p>
        </div>
      </div>
    </section>

    <!-- Section B -->
    <h1 style="padding-bottom: 5px;">Our Mission</h1>
    <section id="section-b" class="grid">
      <div class="sides">
        <ul>
          <li>
            <div class="card">
              <img src="../images/satisfaction.png" alt="An image that describes satisfaction">
              <div class="card-content">
                <h3 class="card-title">Customer Satisfaction</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  Donec eu purus quis nulla pharetra cursus eget interdum lorem.</p>
                </div>
              </div>
            </li>

            <li>
              <div class="card">
                <img src="../images/quality.jpg" alt="An image that describes quality experience">
                <div class="card-content">
                  <h3 class="card-title">Quality Experience</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Donec eu purus quis nulla pharetra cursus eget interdum lorem.</p>
                  </div>
                </div>
              </li>

              <li>
                <div class="card">
                  <img src="../images/feedback.jpg" alt="An image that describes customer feedback">
                  <div class="card-content">
                    <h3 class="card-title">Customer Feedback</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      Donec eu purus quis nulla pharetra cursus eget interdum lorem.</p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </section>
          <!-- Section C -->
          <section id="section-c" class="grid">
            <div class="content-wrap">
              <h2 class="content-title">Our Aim</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad m</p>
              </div>
            </section>
            <!-- Section D -->
            <section id="section-d" class="grid">
              <div class="box">
                <h2 class="content-title">Contact Us</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                  sed do eiusmod tempor incididunt ut labore et
                  dolore magna aliqua. Ut enim ad m</p>
                </div>

                <div class="box">
                  <h2 class="content-title">What We Do</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad m</p>
                  </div>
                </section>
              </main>
              <!-- Footer -->
              <footer id="main-footer" class="grid">
                <div>SeniorHelp Service Management System</div>
                <div>
                  Project By Chen Jia Wei & Tsai Yung-Yang
                </div>
              </footer>

              <script type="text/javascript">
              // a script to toggle the hamburger navigation bar
              $(document).ready(function () {
                $('.animated-icon1').click(function () {
                  $(this).toggleClass('open');
                });
              });

              // a function to change the size of the whole page
              function changeSize(n) {
                var s = document.getElementById('home');
                s.style.fontSize = n.value + 'px'
              }
              </script>
            </body>
            </html>
