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
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/form.css" rel="stylesheet">
		<link href="css/basic.css" rel="stylesheet">
		<link rel="shortcut icon" type="image/x-icon" href="img/fav.ico">
</head>
<?php $site="exte"; include("header.php");?>
	<div class="container">
		<div class="jumbotron">
				<ol>
<?php $q="select * from review";
$r=mysqli_query($con,$q);
if($r)
while($row=mysqli_fetch_array($r))
{
echo '<li>'.$row[0].'</li>';
}
?>
</ol>

		</div>
	</div>
</body>
</html>
