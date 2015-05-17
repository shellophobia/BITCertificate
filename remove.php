<?php
ob_start();
session_start();
include('connect.php');
if(!isset($_SESSION['userid'])) 
header('location:message.php'); 

if(isset($_POST['showbran']))
{
	$c=$_POST['course'];
	$type=$_POST['type'];
	$q="select branch from course where name ='$c' and type='$type'";
	$r=mysqli_query($con,$q);
	if($r)
	{
		while($row=mysqli_fetch_array($r))
		{
			echo $row[0];
		}
	}
}
if(isset($_POST['rembran']))
{
	$b=$_POST['rembran'];
	$c=$_POST['cour'];
	$type=$_POST['type'];
	$branch='';
	$prefix='';
	$q="select branch,branch_pre from course where name ='$c' and type='$type'";
	$r=mysqli_query($con,$q);
	if($r)
	{
		while($row=mysqli_fetch_array($r))
		{
			$branch=$row[0];
			$prefix=$row[1];
		}
	}
	$branch=explode(',',$branch);
	$prefix=explode(',',$prefix);
	if(count($branch)==1){
		$new_b='';
		$new_p='';
	}
	else{
		for($i=0;$i<count($branch);$i++){
			if($branch[$i]===$b){
				unset($branch[$i]);
				break;
			}
		}
		unset($prefix[$i]);
		$branch=array_values($branch);
		$prefix=array_values($prefix);
		$new_b=implode(',',$branch);
		$new_p=implode(',',$prefix);
	}
	$q="update course set branch='$new_b',branch_pre='$new_p' where name ='$c' and type='$type'";
	$r=mysqli_query($con,$q);
	if($r)
	echo 'Branch Removed Successfully!';
	else
	echo 'Some Error Encountered. Please try again!';
}
else if(isset($_POST['showcour']))
{
	$type=$_POST['type'];
	$q="select name from course where type='$type' order by name";
	$r=mysqli_query($con,$q);
	if($r)
	{
		while($row=mysqli_fetch_array($r))
		{
			echo '<option>'.$row[0].'</option>'; 	
		}			
	}
}
else if(isset($_POST['showpre'])){
	$type=$_POST['type'];
	$course=$_POST['course'];
		$q="select cour_pre from course where name='$course' and type='$type'";
		$r=mysqli_query($con,$q);
		if($r){
			while($row=mysqli_fetch_array($r)){
				echo $row[0];
			}
		}
}
else if(isset($_POST['remcour']))
{
	$c=$_POST['remcour'];
	$type=$_POST['type'];
	$q="delete from course where name='$c' and type='$type'";
	$r=mysqli_query($con,$q);
	if($r)
	echo 'Course Removed Successfully!';
}
else if(isset($_GET['showexte']))
{
$q="select name from extension";
$r=mysqli_query($con,$q);
if($r)
{
	while($row=mysqli_fetch_array($r))
	{
	
	echo"<option>".$row[0]."</option>";
	}
}
}
else if(isset($_GET['exte']))
{
$e=$_GET['exte'];
$q="delete from extension where name='$e'";
$r=mysqli_query($con,$q);
}

else if(isset($_GET['listexte']))
{
$q="select name from extension";
echo '<h3>List of Extension Centers</h3><hr style="">';
$r=mysqli_query($con,$q);
if($r)
{
	echo '<ul>';
	while($row=mysqli_fetch_array($r))
	{
	echo"<li>".$row[0]."</li>";
	}
	echo '</ul>';
}
}

?>