<?php
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
		<link href="css/style.css" rel="stylesheet">
		<link rel="shortcut icon" type="image/x-icon" href="img/fav.ico">
		<!-- script jquery and bootstrap for faster loading of the page-->
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/ext_cour_bran.js"></script>
		<!-- script jquery and bootstrap for faster loading of the page-->
</head>
<?php $site="cour"; include("header.php");?>
	<div class="container">
	<div class="row">
		<div id="main_body" class="jumbotron col-sm-7">
			
		</div>
		<div class="col-sm-5">
		<div style="margin:0px 10px 10px;padding:10px:height:auto" id="spdiv">
		<h3 class="nav-banner">
			ADD COURSE AND BRANCHES :
		</h3>
		<form name="add_course" onsubmit="return false;">
		<div class="row">
			<br><input type="text" placeholder="PRE" name="cour_pre" class="form-control col-sm-1" style="width:60px;margin-left:10px">
			<input style="margin-left:5px;width:55%;float:left" placeholder="COURSE NAME" class="form-control" name="name" required>
			<select class="btn btn-default" name="type" style="margin-left:5px;float:left">
				<option value="degree" selected>DEGREE</option>
				<option value="diploma">DIPLOMA</option>
			</select><br>
		</div>
		<br><br>
		<div class="form-group">
			<label class="control-label col-sm-7" style="font-size:16px">Select the no. of Branches</label>
			<div class="col-sm-5">
			<select class="form-control" style="width:70px;margin-top:-5px" onchange="branchpre()" id="pre" name="count">
			<?php
			for($i=1;$i<=10;$i++){
				echo '<option>'.$i.'</option>';
			}
			?>
			</select>
			</div>
		</div>
		<div id="addbox"></div>
			<button class="btn btn-primary btn-block" id="bitbutton" name="sub" onclick="addcourse()" style="margin-top:60px;">ADD</button>
			<br><div class="alert alert-danger" style="height:50px;font-size:12px;">You Can Add OR Delete Branches Even After Clicking On "ADD" Button</div>
		</form>
		</div>
		<div class="jumbotron" style="margin:0px 10px;padding:10px">
			<h3>REMOVE COURSE:</h3>
			<div class="row">
			<div class="col-sm-6" style="margin-left:10px;">
			<form name="del_cour">
			<select name="type" onchange="showcour(1)" class="btn btn-default">
				<option value="degree" selected>DEGREE</option>
				<option value="diploma">DIPLOMA</option>
			</select>
             <select name="cour"  class="btn btn-default select" id="cour_space1" style="margin-top:7px">
			</select><br>
			<span id="bitbutton" style="margin-top:10px" class="btn btn-sm btn-primary" onclick='removecourse()'>REMOVE</span>
			</div>
			</div>
			</form>
		</div>
		<div class="jumbotron" style="margin:30px 10px;padding:10px">
			<h3>REMOVE BRANCH:</h3>
			<div style="margin-left:10px">
			<form name="del_bran">
			<div class="row"><div class="col-sm-5">
			<select name="type" onchange="showcour(2)" class="btn btn-default form-control" style="width:150px">
				<option value="degree" selected>DEGREE</option>
				<option value="diploma">DIPLOMA</option>
			</select></div><div class="col-sm-7">
			<select id="cour_space2"  class="btn btn-default select form-control" name="cour" onchange="showbran(0)" style="width:200px;">
			</select></div></div>
			<div>
			<div id="bran_space" style="margin-left:10px;margin-top:10px;width:80%">
			</div>
			<div id="bitbutton" class="btn btn-sm btn-primary clumsy" style="margin-top:10px;margin-left:10px" onclick="removebranch()">REMOVE</div>
			</div>
			</form>
			</div>
		</div>
		
		</div>
		
	</div>
	</div>
	<center>
	<span style="font-size:10px;padding:10px">Designed & Developed by A.S.U.S</span>
	</center>
	<div id="lock"></div>
</body>
</html>