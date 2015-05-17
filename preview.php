<?php
ob_start();
session_start();
include('connect.php');
if(!isset($_SESSION['userid'])) 
header('location:index.php'); 
if(isset($_POST['subpro']))
{
$desi=$_POST['desi'];
$moff=$_POST['moff'];
$yoff=$_POST['yoff'];
$name=$_POST['name'];
$roll=$_POST['roll'];
$cour=$_POST['cour'];
$dide=$_POST['dide'];
$exte=$_POST['exte'];
$cgpa=$_POST['cgpa'];
$date="24-11-2013";
$mark=$_POST['cgpa']*10;
if(isset($_POST['bran']))
$bran=$_POST['bran'];
else
$bran="";
?>
<html>
<head>
<title>BIT CERTIFICATE</title>
		<meta name="viewport" content="width=device-width , initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/print.css" rel="stylesheet" media="print">
		<link rel="shortcut icon" type="image/x-icon" href="img/fav.ico">
</head>
<?php $site="none"; include("header.php"); // contains the header -> navigation bar and title bar //?>
	<div><!--contains whole body-->
		<center>
			<div class="col-md-8" id="space"><!--space for certificate preview-->
				<form action="printpro.php" name="myform" id="myform" method="post"><!--form for textarea of iframe-->
					<textarea style="display:none;" name="myTextArea" id="myTextArea" cols="100" rows="14"></textarea>
					<iframe name="richTextField" id="richTextField" style="overflow:hidden;border:none;width:19.5cm;height:25.5cm;position:relative;top:10px;background:white;" src="xo.php?<?php echo 'name='.$name.'&roll='.$roll.'&moff='.$moff.'&yoff='.$yoff.'&cgpa='.$cgpa.'&date='.$date.'&exte='.$exte.'&dide='.$dide.'&bran='.$bran.'&cour='.$cour.'&default='.$desi?>"><!--iframe with source of provisional certificate-->
					</iframe>
				</form>		
			</div>
			<div class="col-md-3 pull-right noprint" id="col-edit"><!--Edit the certificate preview-->
				<h2>PROVISONAL</h2><ul style="padding:10px 0px">									<!--buttons to print and edit-->
					<li class="btn btn-default btn-danger" id="edit" onclick="hide(),iFrameOn()">EDIT </li>
					<li class="btn btn-default btn-success" id="done" onclick="show(),iFrameOff()" style="visibility:hidden;position:absolute">DONE</li>
					<li class="btn btn-default btn-warning" id="print" onClick="save('pro')">PRINT</li>
				</ul>
			<form name="change" method="post" id="data_field" style="display:none"><!--for data change-->
						<br><!----space for design choice---->
						<input onfocus="change('roll')" type="text"name="roll"class="form-control" placeholder="ROLL" value="<?php echo $roll ?>" required><!--Roll-->
						<input onchange="change('name')" type="text"name="name"class="form-control" placeholder="STUDENT'S NAME"value="<?php echo $name ?>" required><!--name-->
						<select name="exte" class="form-control"><!--extension-->
					<?php
						$q="select name from extension";
						$r=mysqli_query($con,$q);
						if($r)
						while($row=mysqli_fetch_array($r))
						{
							if($row[0]!=$exte)
							echo '<option>'.$row[0].'</option>';
							else
							echo '<option selected>'.$row[0].'</option>';
						}
					?>
					</select>
						<select name="dide" onchange="seeCourse()" class="form-control" required>
						<option <?php if($dide=='Diploma')echo'selected'?> > Diploma</option>
						<option <?php if($dide=='Degree')echo'selected';?> > Degree</option>
						</select>
						<select name="cour" id="cour_select" onchange="seeBranch()" class="form-control" placeholder="COURSE" required>
						<?php
						$q="select name from course";
						$r=mysqli_query($con,$q);
						if($r)
						while($row=mysqli_fetch_array($r))
						{
							if($row[0]!=$cour)
							echo '<option>'.$row[0].'</option>';
							else
							echo '<option selected>'.$row[0].'</option><script>seeBranch()</script>';
						}
						?>
					</select>
						<select name="bran"  id="bran_select" class="form-control" placeholder="BRANCH (IF ANY)">
						<?php
						$q="select branch from course where name='$cour'";
						$r=mysqli_query($con,$q);
						if($r)
						while($row=mysqli_fetch_array($r))
						{
							$tok=strtok($row[0],',');
							while($tok!=false)
							{
								if($tok==$bran)
								echo '<option selected> '.$tok.'</option>';
								else
								echo '<option>'.$tok.'</option>';
								$tok=strtok(",");
							}
						}
						?>
						</select>
						<input type="text" name="cgpa" class="form-control" placeholder="CGPA" value="<?php echo $cgpa; ?>" required>
						<select name="moff" class="form-control" placeholder="month">
							<option <?php if($moff=='January')echo'selected'?>>January</option>
							<option <?php if($moff=='February')echo'selected'?>>February</option>
							<option <?php if($moff=='March')echo'selected'?>>March</option>
							<option <?php if($moff=='April')echo'selected'?>>April</option>
							<option <?php if($moff=='May')echo'selected'?>>May</option>
							<option <?php if($moff=='June')echo'selected'?>>June</option>
							<option <?php if($moff=='July')echo'selected'?>>July</option>
							<option <?php if($moff=='August')echo'selected'?>>August</option>
							<option <?php if($moff=='September')echo'selected'?>>September</option>
							<option <?php if($moff=='October')echo'selected'?>>October</option>
							<option <?php if($moff=='November')echo'selected'?>>November</option>
							<option <?php if($moff=='December')echo'selected'?>>December</option>
						</select>
						<input type="number" name="yoff" class="form-control" placeholder="Year" value="<?php echo $yoff; ?>">
						<input name="subpro" type="hidden">
						<input type="submit" class="btn-primary form-control" onclick="sure();" name="sub" value="Change all">
			</form>
			<div id="bitbutton" class="btn styler" style="display:none;padding:10px 0px"><!--styler ie,bold italic or underline--><br><br>
					<div class="col-md-3">
					<form name="fsize">
					<select name="f_s" style="height:35px" onchange="iFontSize()"> 
						<option value="1">10</option>
						<option value="2">12</option>
						<option value="3">14</option>
						<option value="4">16</option>
						<option value="5">18</option>
						<option value="6">20</option>
						<option value="7">30</option>
					</select>
					</form>
					</div>
					<div class="col-md-8">
						<span class="btn btn-default" onClick="iBold()"><b>B</b></span>
						<span class="btn btn-default" onClick="iItalic()"><i>I</i></span>
						<span class="btn btn-default" onClick="iUnderline()"><u>U</u></span>
					</div>
			</div>
			<table id="tips"><!--tips-->
			<tr class="btn-warning"><th><center>Few tips</center></th></tr>
			<tr><td><br><b>1.</b> Always try to do minimum edit in this section</td></tr>
			<tr><td><br><b>2.</b> If you want to change the data vlues like name,roll,course,etc you can change it by filling the form while editing</td></tr>
			<tr><td><br><b>3.</b> It is highly recommended that you first fill check that all the data is correct and then start editing the design </td></tr>
			<tr><td><br><b>4.</b> Do not try to edit those data which are indicated by orange colour on hovering (rolling over) the mouse </td></tr>
			<tr><td><br><b>5.</b> You can toggle between the Default Design and Custom Design by selecting the design select input and then click on the change all button </td></tr>
			
			</table>
			</div>
		</center>
	</div>
	<!-- script jquery and bootstrap for faster loading of the page-->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/editor.js"></script>
	<script src="js/change_pro.js"></script>
	<!-- script jquery and bootstrap for faster loading of the page-->
</body>
</html>
<?php
}



else if(isset($_POST['submig']))
{ // /////////////////////////////////////// for migration certificate////////////////////////////////////
$desi=$_POST['desi'];
$name=$_POST['name'];
$roll=$_POST['roll'];
$dide=$_POST['dide'];
$yofj=$_POST['yofj'];
$yofp=$_POST['yofp'];
$exte=$_POST['exte'];
$no="M12343453121";
$date="11-12-13";
?>
<html>
<head>
<title>BIT CERTIFICAITE</title>
		<meta name="viewport" content="width=device-width , initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/print.css" rel="stylesheet" media="print">
		<link rel="shortcut icon" type="image/x-icon" href="img/fav.ico">
</head>
<?php $site="none"; include("header.php"); // contains the header -> navigation bar and title bar //?>
	<div>	
	<center>
		<div class="col-md-8" id="blank_paper"><!--space for certificate-->
					<form action="printmig.php" name="myform" id="myform" method="post">
					<textarea style="display:none;" name="myTextArea" id="myTextArea" cols="100" rows="14"></textarea>
						<iframe name="richTextField" id="richTextField" style="overflow:hidden;border:none;width:19.5cm; height:25.5cm;position:relative;top:10px;background:white;" src="yo.php?<?php echo 'name='.$name.'&roll='.$roll.'&yofj='.$yofj.'&yofp='.$yofp.'&exte='.$exte.'&dide='.$dide.'&date='.$date.'&no='.$no.'&default='.$desi; ?>">
						</iframe>
						</form>
		</div>
		<div class="col-md-3 pull-right noprint" id="col-edit"><!--editor-->
			<h2>MIGRATION</h2><ul style="padding:10px 0px">									<!--buttons to print and edit-->
				<li class="btn btn-default btn-danger" id="edit" onclick="hide(),iFrameOn()">EDIT </li>
				<li class="btn btn-default btn-success" id="done" onclick="show(),iFrameOff()" style="visibility:hidden;position:absolute">DONE</li>
				<li class="btn btn-default btn-warning" id="print" onClick="save('mig')">PRINT</li>
			</ul>
			<form name="change" onsubmit="return false;" style="display:none" method="post"  id="data_field"><!--data form-->
					<hr><!----space for design choice---->
					<input type="text"name="roll"class="form-control" placeholder="ROLL" value="<?php echo $roll ?>" required>
					<input type="text"name="name"class="form-control" placeholder="STUDENT'S NAME"value="<?php echo $name ?>" required>
					<select name="exte" class="form-control">
				<?php
					$q="select name from extension";
					$r=mysqli_query($con,$q);
					if($r)
					while($row=mysqli_fetch_array($r))
					{
						if($row[0]!=$exte)
						echo '<option>'.$row[0].'</option>';
						else
						echo '<option selected>'.$row[0].'</option>';
					}
				?>
				</select>
					<select name="dide" onchange="seeCourse()" class="form-control" required>
					<option <?php if($dide=='Diploma')echo'selected'?> > Diploma</option>
					<option <?php if($dide=='Degree')echo'selected';?> > Degree</option>
					</select>
					<input type="number" name="yofj" class="form-control" placeholder="Year of Joining" value="<?php echo $yofj; ?>">
					<input type="number" name="yofp" class="form-control" placeholder="Year of Passing" value="<?php echo $yofp; ?>">
					<input name="submig" type="hidden">
					<input type="submit" class="btn-primary form-control" onclick="sure();" name="sub" value="Change all">
		</form>
			<div id="bitbutton" class="btn styler" style="padding:10px 0px;display:none"><!--Styler--><br>
				<div class="col-md-3">
				<form name="fsize">
				<select name="f_s" style="height:35px" onchange="iFontSize()"> 
					<option value="1">10</option>
					<option value="2">12</option>
					<option value="3">14</option>
					<option value="4">16</option>
					<option value="5">18</option>
					<option value="6">20</option>
					<option value="7">30</option>
				</select>
				</form>
				</div>
				<div class="col-md-8">
					<span class="btn btn-default" onClick="iBold()"><b>B</b></span>
					<span class="btn btn-default" onClick="iItalic()"><i>I</i></span>
					<span class="btn btn-default" onClick="iUnderline()"><u>U</u></span>
				</div>
			</div>
			<table id="tips"><!--tips-->
			<tr class="btn-warning"><th><center>Few tips</center></th></tr>
			<tr><td><br><b>1.</b> Always try to do minimum edit in this section</td></tr>
			<tr><td><br><b>2.</b> If you want to change the data vlues like name,roll,course,etc you can change it by filling the form while editing</td></tr>
			<tr><td><br><b>3.</b> It is highly recommended that you first fill check that all the data is correct and then start editing the design </td></tr>
			<tr><td><br><b>4.</b> Do not try to edit those data which are indicated by orange colour on hovering (rolling over) the mouse </td></tr>
			</table>
		</div>
	</center>
	</div>
	<!-- script jquery and bootstrap for faster loading of the page-->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/editor.js"></script>
	<script src="js/change_mig.js"></script>
	<!-- script jquery and bootstrap for faster loading of the page-->
</body>
</html>
<?php
}
?>