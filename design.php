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

<?php
echo 'jojo';
if(isset($_GET['pro']))
{
echo 'jojo';
	$design=mysqli_real_escape_string($con,$_GET['pro']);
	echo '<textarea rows="30" cols="40">'.$design.'</textarea>';
	$q="delete from pro where name='user'";
	$r=mysqli_query($con,$q);
	if($r)
	{
		$q="insert into pro values ('$design','user')";
		$r=mysqli_query($con,$q);
		if($r) {}
	}
}
if( isset($_GET['mig']))
{
	$design=mysqli_real_escape_string($con,$_GET['mig']);
	echo '<textarea rows="30" cols="40">'.$design.'</textarea>';
	$q="delete from mig where name='user'";
	$r=mysqli_query($con,$q);
	if($r)
	{
		$q="insert into mig values ('$design','user')";
		$r=mysqli_query($con,$q);
		if($r) {}
	}
}
?>