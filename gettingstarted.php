<?php
ob_start();
session_start();
include('connect.php');
if(!isset($_SESSION['userid'])) 
header('location:index.php'); 
?>

<html>
<head>
<title>BIT CERTIFICAITE</title>
		<meta name="viewport" content="width=device-width , initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:url('img/bit.jpg');background-position:0% 0%;background-size:100% 100%;background-repeat:no-repeat;background-attachment:fixed;">
		<div class="navbar navbar-inverse navbar-static-top">
		<div id="container">
			<img class="img-responsive" src="img/name.jpg">
				<button class="navbar-toggle" data-toggle = "collapse" data-target=".navHeaderCollapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="collapse navbar-collapse navHeaderCollapse">
				<ul class="nav nav-tabs navbar-left">
					<li><a href="index.php" id="" class="">HOME</a></li>
					<li><a href="history.php" id="" class="">HISTORY</a></li>
					<li><a href="extensions.php" id="" class="">EXTENSIONS</a></li>
					<li><a href="courses.php" id="" class="">COURSES</a></li>
					<li><a href="logout.php" id="" class="">LOGOUT</a></li>
					<li class="active"><a href="gettingstarted.php" id="" class="">GETTING STARTED</a></li>
				</ul>
				</div>
		</div>	
		</div>
	<div class="container row" >
		<div class="col-md-3 jumbotron" style="padding:0px;margin:20px">
			<ol>
				<li>
					CERTIFICATE GENERATION
					<ul>
						<li>Form Entry</li>
						<li>Edit</li>
						<li>Print</li>
					</ul>
				</li>
				<li>
					DATA RETRIEVAL
					<ul>
						<li>Certificate </li>
						<li>Time</li>
						<li>Own Span</li>
					</ul>
				</li>
				<li>
					EXTENSION
					<ul>
						<li>View</li>
						<li>Add</li>
						<li>Delete</li>
					</ul>
				</li>
				<li>
					COURSES
					<ul>
						<li>View Courses</li>
						<li>Add Courses</li>
						<li>Add Branch</li>
						<li>Delete Course</li>
						<li>Delete Branch</li>
					</ul>
				</li>
			</ol>
		</div>
		<div class="col-md-7 jumbotron" style="background:#8fb8b8;padding:20px;margin:20px">
			<div id="generation" class="row">
				<h1>CERTIFICATE</h1>
					<span style="font-size:25px">FILL UP THE FORM</span>
					<ol>
					<li>Select the option for provisional or migration certificate.</li>
					<li>fill the details for the certificate.</li>
					<li>Click on the next button after completing the form.</li>
					</ol>
					<span style="font-size:20px">Form for Migration Certificate<b class="caret"></b></span>
					<img src="img/form.jpg" class="img-responsive">
					<span style="font-size:20px">Form for Migration Certificate<b class="caret"></b></span>
					<img src="img/form.jpg" class="img-responsive">
				<hr>
					
					<span style="font-size:25px">EDIT THE CERTIFICATE</span>
					<ol>
					<li>A certificate will appear on the screen as shown in figure below.</li>
					<span style="font-size:20px">Migration Certificate</span>
					<img src="img/certificate.jpg" class="img-responsive">
					<li>You can edit or print that certificate by clicking on the buttons.</li>
					<li>You can change the size of font make font itallic or bold.</li>
					<li>You can only change the non data contents which are not fed by form.</li>
					</ol>
					<img src="img/edit.jpg" class="img-responsive">
			</div>
		</div>
	</div>
		<!-- script jquery and bootstrap for faster loading of the page-->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<!-- script jquery and bootstrap for faster loading of the page-->
</body>
</html>