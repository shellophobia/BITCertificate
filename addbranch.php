<?php
ob_start();
session_start();
include('connect.php');
if(!isset($_SESSION['userid'])) 
header('location:message.php'); 
?>

<?php
	if(isset($_GET['exte']))
	{
		$e=$_GET['exte'];
		$q="insert into extension values('$e')";
		$r=mysqli_query($con,$q);
		if($r)
		echo '1';
		else
		echo '2';
	}
	else if(isset($_GET['dide']))
	{
		$d=$_GET['dide'];
		$q="select name from course where type='$d'";
		$r=mysqli_query($con,$q);
		if($r)
		while($row=mysqli_fetch_array($r))
		{
			echo '<option>'.$row[0].'</option>';
		}
	}
	else if(isset($_GET['cour']))
	{
		$c=$_GET['cour'];
		$q="select branch from course where name='$c'";
		$r=mysqli_query($con,$q);
		if($r)
		while($row=mysqli_fetch_array($r))
		{
			$tok=strtok($row[0],',');
			while($tok !== false)
			{
				echo '<option>'.$tok.'</option>';
				$tok=strtok(",");
			}	
		}
	}
	else if(isset($_POST['cname'])){
		$course=$_POST['cname'];
		$type=$_POST['type'];
		$q="select cour_pre,branch,branch_pre from course where name='$course' and type='$type'";
		$r=mysqli_query($con,$q);
		$json;
		if($r){
			while($row=mysqli_fetch_array($r)){
				$json=array('cour_pre'=>$row[0],'branch'=>$row[1],'pre'=>$row[2]);
			}
		}
		echo json_encode($json);
	}
	else if(isset($_POST['update'])){
		if($_POST['update']==='brapre'){
			$course=$_POST['course'];
			$type=$_POST['type'];
			$prefix=$_POST['pre'];
			$branch=$_POST['bran'];
			$q="update course set branch='$branch',branch_pre='$prefix' where name='$course' and type='$type'";
			$r=mysqli_query($con,$q);
			if($r){
				echo 'Updation succesfull!';
			}
		}
		else{
			$prefix=$_POST['pre'];
			$course=$_POST['course'];
			$type=$_POST['type'];
			$q="update course set cour_pre='$prefix' where name='$course' and type='$type'";
			$r=mysqli_query($con,$q);
			if($r){
				echo 'Updation succesfull!';
			}
		}
	}
	else if(isset($_POST['add'])){
		if($_POST['add']==='branch'){
			$course=$_POST['course'];
			$type=$_POST['type'];
			$branch=$_POST['branch'];
			$prefix=$_POST['pre'];
			$q="select branch,branch_pre from course where name='$course' and type='$type'";
			$r=mysqli_query($con,$q);
			$t_branch;
			$t_pre;
			if($r){
			while($row=mysqli_fetch_array($r)){
				$t_branch=$row[0];
				$t_pre=$row[1];
			}}
			$temp=explode(',',$t_branch);
			$t=1;
			if(in_array($branch,$temp))
			$t=0;
			if($t){
			if($t_branch!=''){
			$branch=$t_branch.','.$branch;
			$prefix=$t_pre.','.$prefix;
			}
			$q="update course set branch='$branch',branch_pre='$prefix' where name='$course' and type='$type'";
			$r=mysqli_query($con,$q);
			if($r)
			echo 'Branch added successfully!';
			}
			else
			echo 'Branch already exists!';
		}
		else{
			$course=$_POST['course'];
			$type=$_POST['type'];
			$branch=$_POST['branch'];
			$cour_pre=$_POST['pre'];
			$bran_pre=$_POST['bran_pre'];
			$branch=explode(',',$branch);
			$prefix=explode(',',$bran_pre);
			if(count($branch)>1){
			$temp=array_unique($branch);
			$dup=array_diff_key($branch,$temp);
			$branch=implode(',',$temp);
			$key=array_keys($dup);
			for($i=0;$i<count($key);$i++){
				unset($prefix[$key[$i]]);
			}
				$prefix=array_values($prefix);
				$prefix=implode(',',$prefix);
			}
			else
			{
				$branch=implode(',',$branch);
				$prefix=implode(',',$prefix);
			}
			$q="insert into course values('$course','$cour_pre','$type','$branch','$bran_pre')";
			//$q=mysql_real_escape_string($q);
			//echo $q;
			$r=mysqli_query($con,$q);
			if($r)
			echo 'Course Added Successfully!';
			else
			echo 'Desired Course Already Exists';
		}
	}
?>