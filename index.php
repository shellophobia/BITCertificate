<?php
ob_start();
session_start();
include('connect.php');
if(isset($_COOKIE["userid"]))
{	
	if($_COOKIE["userid"]=="user_id_auth_remember")
	$_SESSION['userid']="admuser";
}

if(isset($_POST['sub']))
{
if(isset($_POST['reme']))
$reme=1;
else
$reme=0;

$pass=$_POST['pass'];
$name=$_POST['name'];
	$query="SELECT name, pass FROM  `users` WHERE name =  '$name' AND pass =  '$pass'";
	$r=mysqli_query($con,$query);
	if($r)
	{
		if(mysqli_num_rows($r)!=0)
		{
		$_SESSION['userid']="admuser";
		$time=time()+(60*60*365*24);
		setcookie("userid","user_id_auth_remember",$time);
		header('location:form.php');
		}
		else
		{
		?>
		<script>alert("Password and username does not match!");</script>
		<?php
		}
	}
	else
	{ echo 'OOPS !! ERROR  :( ';}
}
?>				
<?php
if(isset($_SESSION['userid']))
if(isset($_SESSION['userid'])=='admuser')
header('location:form.php');	
?>

<html>
<head>
<title>BIT CERTIFICAITE</title>
		<meta name="viewport" content="width=device-width , initial-scale=1.0">
		<link rel="shortcut icon" type="image/x-icon" href="img/fav.ico">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/login.css" rel="stylesheet">
</head>

<body style="background:url('img/bit.jpg');background-position:0% 0%;background-size:100% 100%;background-repeat:no-repeat;background-attachment:fixed;">
	<div class="navbar navbar-inverse navbar-static-top">
		<div id="container">
			<img class="col-md-3 img-responsive navbar-brand" src="img/name.jpg">
		</div>
	</div>
	<center>
	<div class="container">
		<div class=" col-md-4"></div>
		<div class=" col-md-4 jumbotron form-signin" role="form" style="">
			<form method="post" name="login">
					<input type="text" name="name" class="form-control" placeholder="Username" required autofocus><br>
					<input type="password" name="pass" class="form-control" placeholder="Password" required><br>
					<label class="checkbox"><input name="reme" type="checkbox" style="width:20px;height:20px;background:green" value="rem" checked><span class="pull-left" style="padding:0px 10px">Remember Me</span></label>
					<input type="submit" name="sub" class="btn" id="bitbutton" value="Sign in">
			</form>
		</div>
	</div>
	</center>
		<!-- script jquery and bootstrap for faster loading of the page-->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<!-- script jquery and bootstrap for faster loading of the page-->
</body>
</html>