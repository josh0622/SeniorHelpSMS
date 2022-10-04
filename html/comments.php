<?php include('../php/server.php');
$con=mysqli_connect('localhost','root','','service');
  // if user is not logged in, they cannot access this page
  if (empty($_SESSION['username'])) {
    header('location: index.php');
  }
  if($_SESSION['username']['userType']=="seniorCitizen"){
    $provider=$_GET['providerUsername'];
  }else{
    $provider=$_SESSION['username']['username'];
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8" http-equiv="refresh">
		<title>Review</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
    <style>
    body{
      background-image: url(../images/review1.jpg);
      background-size:;
    }
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
    .bar-5 {width:  <?php $sql=mysqli_query($con,"SELECT COUNT(id) FROM comments Where providerUsername='$provider'"); $total=mysqli_fetch_array($sql);
        $sqll=mysqli_query($con,"SELECT COUNT(id) FROM comments WHERE rating='5' and providerUsername='$provider'"); $five=mysqli_fetch_array($sqll);
        $width=($five[0]/$total[0])*100; echo $width;?>%; height: 18px; background-color: #4CAF50;}
    .bar-4 {width:<?PHP $sqll=mysqli_query($con,"SELECT COUNT(id) FROM comments WHERE rating='4'and providerUsername='$provider'"); $four=mysqli_fetch_array($sqll);
        $width=($four[0]/$total[0])*100; echo $width;?>%; height: 18px; background-color: #2196F3;}
    .bar-3 {width: <?PHP $sqll=mysqli_query($con,"SELECT COUNT(id) FROM comments WHERE rating='3'and providerUsername='$provider'"); $three=mysqli_fetch_array($sqll);
        $width=($three[0]/$total[0])*100; echo $width;?>%; height: 18px; background-color: #00bcd4;}
    .bar-2 {width: <?PHP $sqll=mysqli_query($con,"SELECT COUNT(id) FROM comments WHERE rating='2'and providerUsername='$provider'"); $two=mysqli_fetch_array($sqll);
        $width=($two[0]/$total[0])*100; echo $width;?>%; height: 18px; background-color: #ff9800;}
    .bar-1 {width: <?PHP $sqll=mysqli_query($con,"SELECT COUNT(id) FROM comments WHERE rating='1'and providerUsername='$provider'"); $one=mysqli_fetch_array($sqll);
        $width=($one[0]/$total[0])*100; echo $width;?>%; height: 18px; background-color: #f44336;}

    form button { margin: 5px 0px; }
    textarea { display: block; margin-bottom: 10px; }
    /*post*/
    .post { border: 1px solid #ccc; margin-top: 10px; }
    /*comments*/
    .comments-section { margin-top: 10px; border: 1px solid #ccc; }
    .comment { margin-bottom: 10px; }
    .comment .comment-name { font-weight: bold; }
    .comment .comment-date {
    	font-style: italic;
    	font-size: 0.8em;
    }
    .comment .edit-btn { font-size: 0.8em; }
    .comment-details { width: 91.5%; float: left; }
    .comment-details p { margin-bottom: 0px; }
    .comment .profile_pic {
    	width: 40px;
    	height: 40px;
    	margin-right: 5px;
    	float: left;
    	border-radius: 50%;
      margin-top:10px;
    }
    .profilepic{
      width: 40px;
    	height: 40px;
    	margin-right: 5px;
      display: block;
    	border-radius: 50%;
      margin-top:10px;
    }
    #comment_form { margin-top: 10px; }
    .starrr {
      display: inline-block; }
    .starrr a {
      font-size: 30px;
      padding: 0 1px;
      cursor: pointer;
      color: #FFD119;
      text-decoration: none; }
    .a{
      color: yellow;
    }
    #rating {
      font-family: Arial;
      width: 300px;
      font-size: 15px;
      margin-top: 20px;

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
          <?PHP endif;?>
          <?php if ($_SESSION['username']['userType'] == "seniorCitizen"): ?>
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

    <div class="container" style="margin-top:60px; margin-bottom: 10px;width:1000px;">
    	<div class="row" >
    		<div class="col-md-6 col-md-offset-3 post" style="background-color:white;" >
          <center>
    			<?php if($_SESSION['username']['userType']=="seniorCitizen"):
          $username=$_SESSION['username']['username'];
          echo '<img src="../images/profile.png" alt="" class="profilepic">';
          echo "<h2>$provider</h2>"?>
        </center>
        <?php endif; ?>
        <?php if($_SESSION['username']['userType']=="serviceProvider"):
          echo '<img src="../images/profile.png" alt="" class="profilepic">';
          echo "<h2>$provider</h2>";?>
        <?php endif;?>
        <center>
        <div id="rating"; style="padding-bottom:5px;">
          <?PHP
          $sql=mysqli_query($con,"SELECT ROUND(AVG(rating),1) FROM comments WHERE providerUsername='$provider'");
          $avg=mysqli_fetch_array($sql);
          if($avg[0]>=1 and $avg[0]<1.5){ echo "<td><i class='fa fa-star a'> </i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td></br> " ; }
          if($avg[0]>=1.5 and $avg[0]<2.5){ echo "<td><i class='fa fa-star a'> </i><i class='fa fa-star a'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td></br> " ; }
          if($avg[0]>=2.5 and $avg[0]<3.5){ echo "<td><i class='fa fa-star a'> </i><i class='fa fa-star a'></i><i class='fa fa-star a'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td></br> " ; }
          if($avg[0]>=3.5 and $avg[0]<4.5){ echo "<td><i class='fa fa-star a'> </i><i class='fa fa-star a'></i><i class='fa fa-star a'></i><i class='fa fa-star a'></i><i class='fa fa-star'></i></td></br> "; }
          if($avg[0]>=4.5){ echo "<td><i class='fa fa-star a'> </i><i class='fa fa-star a'></i><i class='fa fa-star a'></i><i class='fa fa-star a'></i><i class='fa fa-star a'></i></td></br> "; }
          ?>
         <h2><strong><?php $sql=mysqli_query($con,"SELECT ROUND(AVG(rating),1) FROM comments WHERE providerUsername='$provider'");
          $avg=mysqli_fetch_array($sql);echo $avg[0];?></h2>
            <p> average based on <?php  $result=mysqli_query($con,"SELECT count(providerUsername)FROM comments WHERE providerUsername='$provider'");
            $count=mysqli_fetch_array($result);echo $count[0];?> Ratings.</p>
            <hr style="border:3px solid #f1f1f1">

            <div class="row">
              <div class="side">
                <div>5 star</div>
              </div>
              <div class="middle">
                <div class="bar-container">

                      <div class="bar-5";></div>
                </div>
              </div>
              <div class="side right">
                <div><?php $sql=mysqli_query($con,"SELECT COUNT(rating) FROM comments WHERE rating='5' and providerUsername='$provider'");
                $fivestar=mysqli_fetch_array($sql); echo $fivestar[0];?></div>
              </div>
              <div class="side">
                <div>4 star</div>
              </div>
              <div class="middle">
                <div class="bar-container">
                  <div class="bar-4"></div>
                </div>
              </div>
              <div class="side right">
                <div><?php $sql=mysqli_query($con,"SELECT COUNT(rating) FROM comments WHERE rating='4'and providerUsername='$provider'");
                $fourstar=mysqli_fetch_array($sql); echo $fourstar[0];?></div>
              </div>
              <div class="side">
                <div>3 star</div>
              </div>
              <div class="middle">
                <div class="bar-container">
                  <div class="bar-3"></div>
                </div>
              </div>
              <div class="side right">
                <div><?php $sql=mysqli_query($con,"SELECT COUNT(rating) FROM comments WHERE rating='3'and providerUsername='$provider'");
                $threestar=mysqli_fetch_array($sql); echo $threestar[0];?></div>
              </div>
              <div class="side">
                <div>2 star</div>
              </div>
              <div class="middle">
                <div class="bar-container">
                  <div class="bar-2"></div>
                </div>
              </div>
              <div class="side right">
                <div><?php $sql=mysqli_query($con,"SELECT COUNT(rating) FROM comments WHERE rating='2'and providerUsername='$provider'");
                $twostar=mysqli_fetch_array($sql); echo $twostar[0];?></div>
              </div>
              <div class="side">
                <div>1 star</div>
              </div>
              <div class="middle">
                <div class="bar-container">
                  <div class="bar-1"></div>
                </div>
              </div>
              <div class="side right">
                <div><?php $sql=mysqli_query($con,"SELECT COUNT(rating) FROM comments WHERE rating='1'and providerUsername='$provider'");
                $onestar=mysqli_fetch_array($sql); echo $onestar[0];?></div>
              </div>
            </div>
          </div>
        </center>
        </div>
        <?php if($_SESSION['username']['userType']=="seniorCitizen"):?>
    		<div class="col-md-6 col-md-offset-3 comments-section" style="padding-bottom:10px;background-color:white;">
    				<form class="clearfix"method="post" id="comment_form">
              <?php $comment=''; ?>
              <input type="hidden" id="provider" value=<?php echo htmlspecialchars($provider)?>>
              <input type="hidden" id="username" value=<?php echo htmlspecialchars($username)?>>
              <label for="rating">Rating :</label>
	  	        <div class='starrr' id='rating-student'></div> 	<br>
    					<textarea name="comment_text"id="comment_text" class="form-control" cols="30" rows="3" required></textarea>
    					<input type="button" class="btn btn-primary btn-sm pull-right" value="Submit comment"name="submit_comment" id="submit" onclick="setTimeout(function(){window.location.reload();},2)">

             </form>
          </div>
        <?php endif; ?>
            <div class="col-md-6 col-md-offset-3 comments-section"style="background-color:white;">

    			<!-- Display total number of comments on this post  -->
          <h2><?php $result=mysqli_query($con,"SELECT count(providerUsername)FROM comments WHERE providerUsername='$provider'");
          $count=mysqli_fetch_array($result);echo $count[0];?> Comment(s)</h2>
    			<hr>
    			<!-- comments wrapper -->
    			<div id="comments-wrapper">
    				<!-- comment -->
    				<div class="comment clearfix" style="overflow:auto;height:200px;">
              <?php if($count[0]==0){
                echo "<center>";
                echo "<h2>Be the first to leave a comment</h2>";
                echo "</center>";
              }else{
              $sql="SELECT * FROM comments WHERE providerUsername='$provider' order by id DESC";
              $result=mysqli_query($con,$sql);
              if(mysqli_num_rows($result)){
                while ($row=mysqli_fetch_array($result)){
                  echo '<img src="../images/profile.png" alt=\"\" class="profile_pic">';
                  echo '<div class=\"comment-details\">';
                  if($row['rating']==1){ echo "<td><i class='fa fa-star a'> </i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td></br> " ; }
					        if($row['rating']==2){ echo "<td><i class='fa fa-star a'> </i><i class='fa fa-star a'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td></br> " ; }
					        if($row['rating']==3){ echo "<td><i class='fa fa-star a'> </i><i class='fa fa-star a'></i><i class='fa fa-star a'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td></br> " ; }
					        if($row['rating']==4){ echo "<td><i class='fa fa-star a'> </i><i class='fa fa-star a'></i><i class='fa fa-star a'></i><i class='fa fa-star a'></i><i class='fa fa-star'></i></td></br> "; }
					        if($row['rating']==5){ echo "<td><i class='fa fa-star a'> </i><i class='fa fa-star a'></i><i class='fa fa-star a'></i><i class='fa fa-star a'></i><i class='fa fa-star a'></i></td></br> "; }
                  echo '<span class="comment-name">'.$row['reviewer'].' </span>';
                  echo '<span class="comment-date">'.$row['created_at'].'</span>';
                  echo '<p>'.$row['body'].'</p>';
                  echo '<hr>';
                  echo '</div>';
                }
              }
            }

              ?>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- star js -->
<script src="../js/ratingstar.js"></script>
<!-- ajax -->
<script>
// rating
var rate;
$('#rating-student').starrr({
  change: function(e, value){
  	rate = value;
    if (value) {
      $('.your-choice-was').show();
    } else {
      $('.your-choice-was').hide();
    }
  }
});
$("#submit").click(function(){
  var username=$('#username').val();
  var provider=$('#provider').val();
  var comment=$('#comment_text').val();
	$.ajax({
    url: "../php/rating.php",
    type: 'post',
    data: {v1 : username, v2 : provider,v3:comment ,v4 : rate},
    success: function (status) {

      }

    });

});

</script>
	</body>
</html>
