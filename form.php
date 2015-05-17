<?php
ob_start(); session_start(); include('connect.php');//for database, session control and header control
if(isset($_COOKIE["userid"])){if($_COOKIE["userid"]=="user_id_auth_remember") $_SESSION['userid']="admuser";} //cookie check
if(!isset($_SESSION['userid'])) header('location:index.php'); // session check
?>
<html>
<head>
<title>BIT CERTIFICATE</title>
		<meta name="viewport" content="width=device-width , initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/form.css" rel="stylesheet">
		<link href="css/basic.css" rel="stylesheet">
		<link rel="shortcut icon" type="image/x-icon" href="img/fav.ico">
		
</head>
<?php $site="home"; include("header.php"); // contains the header -> navigation bar and title bar //?>
	<div class="container"><!-- wraps the whole body -->
		<div class="jumbotron row"><!-- wraps the whole body with background color-->
					<div class=" col-sm-3" role="form"><!--logo and selection for certificate-->
						<br>
						<form name="form"><!--selection for type of certificate-->
						<select onchange="put_doc()" name="cert" class="form-control"     required>
							<option>PROVISIONAL</option>
							<option>MIGRATION</option>
						</select>
						<div style="padding:30px 10px 10px 30px">
							<img src="img/logo.gif" class="img-responsive" style="border-radius:100px">
							<div id="notice">
								
							</div>
						</div>
						</form>
					</div>
					<div class=" col-md-8 " role="form" id="pro_det" style="font-size:15px"><!--provisional-->
					<h3>DETAILS FOR PROVISIONAL </h3><hr>
					<form class="form-horizontal" name="pro" method="post" action="preview.php">
						<div class="form-group">
						<select name="desi" class="form-control" style="margin-top:5px;">
							<option selected>DEFAULT DESIGN</option>
							<option>CUSTOM DESIGN</option>
						</select><!--Design selector-->
						</div>
						<div class="form-group"><!--roll without prefix-->
							<label for="roll" class="col-sm-4 control-label">ROLL </label>
							<div class="col-sm-4" style="width:150px">
								<input type="number"  name="rnum" class="form-control" placeholder="ROLL" required >
							</div>
							<div class="col-sm-3">
								<input type="number"  name="ryea" class="form-control" placeholder="YEAR" required>
							</div>
							
						</div>
						<div class="form-group"><!--no of prefix-->
							<label for="roll" class="col-sm-4 control-label">PREFIXES</label>
							<div class="col-sm-8">
								<div class="col-sm-3">
									<select onchange="fixpre('pro')" name="pre" class="form-control">
									<option>0</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									</select>	
								</div>
								<div class="col-sm-9" id="prefixpro"><!--prefixes-->
								</div>
							</div>
						</div>
						<div class="form-group"><!--roll no with prefixes-->
							<label class="col-sm-4 control-label">
							<button onclick="showRoll('pro');return false;" class="btn btn-warning btn-sm">SEE ROLL No.</button>
							</label>
							<div class="col-sm-8">
							<input type="text" name="roll" class="form-control" readonly required>
							</div>
						</div>
						<div class="form-group"><!--name--><hr>
							<label for="name" class="col-sm-4 control-label">NAME</label>
							<div class="col-sm-8">
								<input type="text" name="name" class="form-control" id="name" placeholder="STUDENT'S NAME" required>
							</div>
						</div>
						<div class="form-group"><!--extension-->
							<label for="exte" class="col-sm-4 control-label">EXTENSION </label>
							<div class="col-sm-8">
							<select id="pro_exte" name="exte" class="form-control">
							<?php
								$q="select name from extension";
								$r=mysqli_query($con,$q);
								if($r)
								while($row=mysqli_fetch_array($r))
								{
									if($row[0]!="Mesra (Main Campus)")
									echo '<option>'.$row[0].'</option>';
									else
									echo '<option selected>'.$row[0].'</option>';
								}
							?>
							</select>
							</div>
						</div>
						<div class="form-group"><!--tpe of certificate-->
							<label for="type" class="col-sm-4 control-label">TYPE </label>
							<div class="col-sm-8">
								<select name="dide" onchange="seeCourse()" class="form-control" id="type" required>
								<option>Diploma</option>
								<option selected>Degree</option>
								</select>
							</div>
						</div>
						<div class="form-group"><!--course-->
							<label for="cour" class="col-sm-4 control-label">COURSE </label>
							<div class="col-sm-8">
								<select name="cour" onchange="" class="form-control" id="cour" placeholder="COURSE" required>
								<?php
								$q="select name from course";
								$r=mysqli_query($con,$q);
								if($r)
								while($row=mysqli_fetch_array($r))
								{
									if($row[0]!="Bachelor of Engineering")
									echo '<option>'.$row[0].'</option>';
									else
									echo '<option selected>'.$row[0].'</option><script>seeBranch()</script>';
								}
								?>
								</select>
							</div>
						</div>
						<div class="form-group"><!--branch-->
							<label for="bran" class="col-sm-4 control-label">BRANCH </label>
							
							<div class="col-sm-8">
								<select name="bran" class="form-control" id="bran" placeholder="BRANCH (IF ANY)">
								<?php 
								$q="select branch from course where name='Bachelor of Engineering'";
								$r=mysqli_query($con,$q);
								if($r)
								while($row=mysqli_fetch_array($r))
								{
									$tok=strtok($row[0],',');
									while($tok!=false)
									{
										echo '<option selected>'.$tok.'</option>';
										$tok=strtok(",");
									}
									
								}
								?>
								</select>
							</div>
						</div>
						<div class="form-group"><!--cgpa-->
							<label for="cgpa" class="col-sm-4 control-label">CGPA </label>
							<div class="col-sm-8">
								<input type="text" onblur="see_pcg()" name="cgpa" class="form-control" id="cgpa" placeholder="CGPA" required>
							</div>
						</div>
						<div class="form-group"><!--year and month of issuing the certificate-->
							<label for="moff" class="col-sm-4 control-label">MONTH </label>
							<div class="col-sm-4">
								<select name="moff" id="moff" class="form-control" placeholder="month">
									<option>January</option>
									<option>February</option>
									<option>March</option>
									<option>April</option>
									<option>May</option>
									<option>June</option>
									<option>July</option>
									<option>August</option>
									<option>September</option>
									<option>October</option>
									<option>November</option>
									<option>December</option>
								</select>
							</div>
							<div class="col-sm-4">
								<input type="number" name="yoff" class="form-control" placeholder="Year" value="2013">
							</div>
						</div>
						<input type="submit" name="subpro" class="btn btn-primary btn-lg pull-right" id="bitbutton" value="NEXT"><!--submit-->
					</form>	
					</div>
					<div class=" col-md-8 " role="form" id="mig_det" style="font-size:15px"><!--migration-->
					<h3>DETAILS FOR MIGRATION & TRANSFER </h3><hr>
					<form class="form-horizontal" name="mig" method="post" action="preview.php">
						<div class="form-group"><!--Design selector-->
						</div>
						<div class="form-group"><!--roll and year-->
							<label for="roll" class="col-sm-4 control-label">ROLL </label>
							<div class="col-sm-4" style="width:150px">
								<input type="number" name="rnum" class="form-control" placeholder="ROLL" required >
							</div>
							<div class="col-sm-3">
								<input type="number" name="ryea" class="form-control" placeholder="YEAR" required>
							</div>
							
						</div>
						<div class="form-group"><!--no of prefix-->
							<label for="roll" class="col-sm-4 control-label">PREFIXES</label>
							<div class="col-sm-8">
								<div class="col-sm-3">
									<select onchange="fixpre('mig')" name="pre" class="form-control">
									<option>0</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									</select>	
								</div>
								<div class="col-sm-9" id="prefixmig"><!--prefixes-->
								</div>
							</div>
						</div>
						<div class="form-group"><!--roll no with prefixes-->
							<label class="col-sm-4 control-label">
							<button onclick="showRoll('mig');return false;" class="btn btn-warning btn-sm">SEE ROLL No.</button>
							</label>
							<div class="col-sm-8">
							<input type="text" name="roll" class="form-control" readonly required>
							</div>
						</div>
						<div class="form-group"><!--name--><hr>
							<label for="name" class="col-sm-4 control-label">NAME</label>
							<div class="col-sm-8">
								<input type="text" name="name" class="form-control" id="name" placeholder="STUDENT'S NAME" required>
							</div>
						</div>
						<div class="form-group"><!--extension-->
							<label for="exte" class="col-sm-4 control-label">EXTENSION </label>
							<div class="col-sm-8">
							<select name="exte" class="form-control" id="mig_exte" required>
							<?php
								$q="select name from extension";
								$r=mysqli_query($con,$q);
								if($r)
								while($row=mysqli_fetch_array($r))
								{
									if($row[0]!="Mesra (Main Campus)")
									echo '<option>'.$row[0].'</option>';
									else
									echo '<option selected>'.$row[0].'</option>';
								}
							?>
							</select>
							</div>
						</div>
						<div class="form-group"><!--type of certificate-->
							<label for="type" class="col-sm-4 control-label">TYPE </label>
							<div class="col-sm-8">
								<select name="dide" class="form-control" id="type" required>
								<option>DIPLOMA</option>
								<option>DEGREE</option>
								</select>
							</div>
						</div>
						<div class="form-group"><!--year of joining-->
							<label for="yofj" class="col-sm-4 control-label">YEAR OF JOINING </label>
							<div class="col-sm-8">
								<input type="number" name="yofj" class="form-control" id="yofj" placeholder="YEAR OF JOINING" required>
							</div>
						</div>
						<div class="form-group"><!--year of passing-->
							<label for="yofp" class="col-sm-4 control-label">YEAR OF PASSING </label>
							<div class="col-sm-8">
								<input type="number" name="yofp" class="form-control" id="yofp" placeholder="YEAR OF LEAVING" required>
							</div>
						</div>
						<input type="submit" onclick="check_mig()"  name="submig" class="btn btn-primary btn-lg pull-right" id="bitbutton" value="NEXT"><!--submit-->
					</form>	
					</div>
		</div>
	</div>
	<center>
	<span style="font-size:10px;padding:10px">Designed & Developed by A.S.U.S</span>
	</center>
	
	<!-- script jquery and bootstrap of the page-->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/form.js"></script>
	<script src="js/valid.js"></script>
	<!-- script jquery and bootstrap of the page-->
</body>
</html>
