<?php
ob_start();
session_start();
include('connect.php');
if(isset($_COOKIE["userid"]))
{	
	if($_COOKIE["userid"]=="user_id_auth_remember")
	$_SESSION['userid']="admuser";
}
if(!isset($_SESSION['userid']))
{ 
header('location:index.php'); 
}
?>
<html>
<head>
<title>BIT CERTIFICATE</title>
		<meta name="viewport" content="width=device-width , initial-scale=1.0">
		
		<link rel="shortcut icon" type="image/x-icon" href="img/fav.ico">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/form.css" rel="stylesheet">
		<link href="css/basic.css" rel="stylesheet">
		
</head>
<?php $site="revi";  include("header.php");?>
<?php
$done='not';
if(isset($_POST['rev']))
{
$cont=$_POST['content'];
$q="insert into review values('$cont')";
$r=mysqli_query($con,$q);
if($r) $done="done";
}
?>
	<div class="container">
		<div class="jumbotron">
		<?php
			if($done=="done")
			echo '<center><h3 style="color:green">Thanks for your review!</h3></center>
			<hr><center><h3 style="color:green">you can write a new review</h3></center>';
		?>
			<form id="history" name="rev" method="post"><textarea rows="10" col="10" name="content" class="form-control" placeholder="Write a review..."></textarea> 
			<br>
			<input id="bitbutton" type="submit" name="rev" class="btn btn-primary" >
			</form>
			<b style="color:red">this is a temporary section</b>
		</div>
	</div>
	
	<center>
	<span style="font-size:10px;padding:10px">Designed & Developed by A.S.U.S</span>
	</center>
	
	<!-- script jquery and bootstrap for faster loading of the page-->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/history.js"></script>
	<!-- script jquery and bootstrap for faster loading of the page-->
</body>
</html>
<!---------------------------------------------------------A.5.U.S---------------------------------------------------------->
