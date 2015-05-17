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
if(isset($_GET['pro'])){
	$bran=$_GET['bran'];
	$moff=$_GET['moff'];
	$yoff=$_GET['yoff'];
	$name=$_GET['name'];
	$roll=$_GET['roll'];
	$cour=$_GET['cour'];
	$dide=$_GET['dide'];
	$exte=$_GET['exte'];
	$cgpa=$_GET['cgpa'];
	$q="select sname,yoff from stud where sroll='$roll'";
	$r=mysqli_query($con,$q);
	if(mysqli_num_rows($r)>0){
		while($row=mysqli_fetch_array($r)){
			if($row[1]==='0000'){
				$query="insert into history values('$roll','$dide','issue','provisional',now())";
				$result=mysqli_query($con,$query);
			}
			else{
				$query="insert into history values('$roll','$dide','reissue','provisional',now())";
				$result=mysqli_query($con,$query);
			}
		}
		$query="update stud set course='$cour',branch='$bran',cgpa=$cgpa,moff='$moff', yoff='$yoff' where sroll='$roll'";
		$result=mysqli_query($con,$query);
	}
	else{
		$query="insert into stud values('$name','$roll','$dide','$cour','$bran',$cgpa,'$moff','$yoff','$exte','',now())";
		$result=mysqli_query($con,$query);
		$query="insert into history values('$roll','$dide','issue','provisional',now())";
		$result=mysqli_query($con,$query);
	}
}
else if(isset($_GET['mig'])){
	$name=$_GET['name'];
	$roll=$_GET['roll'];
	$dide=$_GET['dide'];
	$exte=$_GET['exte'];
	$yofj=$_GET['yofj'];
	$yofp=$_GET['yofp'];
	$q="select sname,yofp from stud where sroll='$roll'";
	$r=mysqli_query($con,$q);
	if(mysqli_num_rows($r)>0){
		while($row=mysqli_fetch_array($r)){
			if($row[1]==='0000'){
				$query="insert into history values('$roll','$dide','issue','migration',now())";
				$result=mysqli_query($con,$query);
			}
			else{
				$query="insert into history values('$roll','$dide','reissue','migration',now())";
				$result=mysqli_query($con,$query);
			}
		}
		$query="update stud set yofp='$yofp' where sroll='$roll'";
		$result=mysqli_query($con,$query);
	}
	else{
		$query="insert into stud(sname,sroll,type,extension,yofp,time) values('$name','$roll','$dide','$exte','$yofp',now())";
		$result=mysqli_query($con,$query);
		$query="insert into history values('$roll','$dide','issue','migration',now())";
		$result=mysqli_query($con,$query);
	}
}
?>