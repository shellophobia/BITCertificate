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
			<center><h2 class="featurette-heading">BIRLA INSTITUTE OF TECHNOLOGY </h2>
			<h3 class="featurette-heading">MESRA , RANCHI (INDIA) - 835215</h3></center>
			<div class="alert alert-danger" style="width:500px;margin-left:260px;height:50px;"><center><h4>EXTENSION CENTER MANAGEMENT</h4></center></div>
			<div class="row">
				<div class="col-md-4" >
					<fieldset class="scheduler-border" id="ext_list">
					</fieldset>
				</div>
				<div class="col-md-6 pull-right">
				<br><br>
						<form name="add_ext"  onsubmit="return false;">
							ADD NEW EXTENSION : <input type="text" name="new" class="btn btn-primary" style="background:white;color:#000066">
							<span class="btn btn-primary" id="bitbutton" onclick="addext()">ADD</span>
						</form><br>
						<form name="del_ext">
							DELETE EXTENSION : <select name="old" class="btn" id="del_list"></select>
							<span class="btn btn-primary" id="bitbutton" onclick="delext()">REMOVE</span>
						</form>
				</div>
			</div>
		</div>
	</div>
	<center>
	<span style="font-size:10px;padding:10px">Designed & Developed by A.S.U.S</span>
	</center>
	<!-- script jquery and bootstrap for faster loading of the page-->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script>
		showext();
		function addext()
		{
			var m=document.forms["add_ext"]["new"].value;
			var x=confirm("Are you sure you want to add "+m+" as an Extension Center")
			if(x)
			{
			var xmlDoc,xmlhttp;
			if (window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
			else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.open("GET","addbranch.php?exte="+m,false);
			xmlhttp.send();
			showext();
			}
		}
		function delext()
		{
			var m=document.forms["del_ext"]["old"].value;
			var x=confirm("Are you sure you want to delete "+m+" from the list of Extension Centers")
			if(x)
			{
			var xmlDoc,xmlhttp;
			if (window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
			else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.open("GET","remove.php?exte="+m,false);
			xmlhttp.send();
			showext();
			}
		}
		function showext()
		{
			var xmlDoc,xmlhttp;
			if (window.XMLHttpRequest)
			xmlhttp=new XMLHttpRequest();
			else
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.open("GET","remove.php?showexte=x",false);
			xmlhttp.send();
			var ext=xmlhttp.responseText;
			document.getElementById('del_list').innerHTML=ext;
			listexte();			
		}
		
		function listexte() // update form field for remove branch
		{
			var x;
			if (window.XMLHttpRequest)
			x=new XMLHttpRequest();
			else
			x=new ActiveXObject("Microsoft.XMLHTTP");
			x.onreadystatechange=function()
			  {
			  if (x.readyState==4 && x.status==200)
				{
				document.getElementById("ext_list").innerHTML=x.responseText;
				}
			  }
			x.open("GET","remove.php?listexte=x",true);
			x.send();
		}

	</script>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<!-- script jquery and bootstrap for faster loading of the page-->
</body>
</html>
