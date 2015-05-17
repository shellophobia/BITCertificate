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
echo '<table style="color:red;font-size:12px">';
$roll=$_GET['roll'];


$type=$_GET['type'];
if($type=="pro")
$type="PROVISIONAL";
if($type=="mig")
$type="MIGRATION";
$q="select * from history where roll='$roll' and type='$type' order by issue";
$r=mysqli_query($con,$q);
if(($r)&&(mysqli_num_rows($r)>0))
{	echo '<tr class="form-control btn-warning"><th>NOTICE</th></tr><tr><td><hr></td></tr>';
	while($row=mysqli_fetch_array($r))
	{
		echo '<tr><td style="text-transform:lowercase;">This Person has alredy been '.$row[2].'D a '.$type.' CERTIFICATE on '.$row[3].'</td></tr><tr><td><hr></td></tr>';
	}
}
echo '</table>';
?>