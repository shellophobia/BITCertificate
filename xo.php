<?php
ob_start();
session_start();
include('connect.php');
if(!isset($_SESSION['userid'])) 
header('location:message.php'); 

$moff=$_GET['moff'];
$yoff=$_GET['yoff'];
$name=$_GET['name'];
$roll=$_GET['roll'];
$cour=$_GET['cour'];
$dide=$_GET['dide'];
$exte=$_GET['exte'];
$cgpa=$_GET['cgpa'];	
$date=date('d-m-Y');
$mark=$_GET['cgpa']*10;
$mark=$mark.' %';
if(isset($_GET['bran']))
$bran=$_GET['bran'];
else
$bran="";
?>
<form name="data" onsubmit="return false;" style="position:absolute;visibility:hidden">
	<input name="name" value="<?php echo $name; ?>" readonly>
	<input name="mark" value="<?php echo $mark; ?>" readonly>
	<input name="roll" value="<?php echo $roll; ?>" readonly>
	<input name="cour" value="<?php echo $cour; ?>" readonly>
	<input name="bran" value="<?php echo $cour.' ('.$bran.')';?>" readonly>
	<input name="cgpa" value="<?php echo $cgpa; ?>" readonly>
	<input name="date" value="<?php echo $date; ?>" readonly>
	<input name="dide" value="<?php echo $dide; ?>" readonly>
	<input name="moff" value="<?php echo $moff; ?>" readonly>
	<input name="yoff" value="<?php echo $yoff; ?>" readonly>
	<input name="exte" value="<?php if($exte!='Mesra (Main Campus)') echo '('.$exte.' Extension)';?>" readonly>
</form>
<html>
<head>
<title>BIT CERTIFICAITE</title>
<style>
#preview
{
	font-family:times new roman;
	font-size:13px;
	text-align:center;
	width:16.5cm;
	height:19.5cm;
	word-spacing:2px;
}
#para_institute
{
font-size:23px;
padding:20px 0px 0px 0px;
}

#para_extension
{
font-weight:bold;
}
#para_mesra
{
font-weight:bold;
}
#para_certificate
{
text-transform:uppercase;
padding:75px 0px 50px 0px;
line-height:150%;
font-weight:bold;
}
#para_1
{
text-align:left;
text-indent:80px;
margin:0px 50px;
line-height:200%;
}
#para_2 
{
text-transform:uppercase;margin:25px 50px;font-weight:bold;
}
#para_3
{
text-align:left;text-indent:40px;margin:0px 50px;line-height:200%;
}
#para_4
{
text-align:left;text-indent:40px;margin:25px 50px;line-height:200%;}
#para_5
{
margin:60px 50px;line-height:200%;
}
#name,#cour,#roll,#bran,#cgpa,#moff,#dide,#mark,#yoff
{
font-weight:bold;
}
#name:hover,#cour:hover,#roll:hover,#bran:hover,#cgpa:hover,#moff:hover,#dide:hover,#mark:hover
{
background:orange;
cursor:pointer
}
</style>		
</head>
<body style="padding:80px 0px">
	<center>
		<div id="preview" style="background:url(img/bit_logo_copy.jpg);background-position:50% 50%;background-size:58% 47%;background-repeat:no-repeat;
		border-style:solid;
		border-image:url(img/logo.jpg) 100 100 100 100 ;
	-moz-border-image:url(img/logo.jpg) 100 100 100 100 ;
	-ms-border-image:url(img/logo.jpg) 100 100 100 100;
	-o-border-image:url(img/logo.jpg) 100 100 100 100 ;
	border-width:20px;">
		<b></b>
		<?php
		if($_GET['default']!='custom')
		{
		?>
							<div id="para_institute">
								<span><b>BIRLA INSTITUTE OF TECHNOLOGY</b></span>
							</div>
							<span>(Deemed University)</span>
							<div id="para_mesra">
								<span>MESRA,RANCHI(INDIA)-835215</span>
							</div>
							<div id="para_extension">
								<span id="exte"><b></b></span>
							</div>
							<div id="para_certificate">
								<span>PROVISIONAL CERTIFICATE</span>
								<br>
								<span style="text-transform:lowercase;">for</span>
								<br>
								<span id="cour"></span>
							</div>
							<div id="para_1">
								This is to certify that Mr./Ms. <span id="name"></span> has passed the prescribed examination and has completed all the requirements in the month of <span id="moff"   ></span>, <span id="yoff"></span> for the award of Degree of 	
							</div>
							<div id="para_2" >
								<span id="bran"></span>
							</div>
							<div id="para_3">
								<i>The <span id="dide"></span> will be awarded to him/her in the ensuing Convocation.</i>
							</div>
							<div id="para_4">
							<i>
								He/She has obtained a C.G.P.A of <span id="cgpa"> </span> in a 10.00 Point Scale which, according to regulation, is equivalent to <span id="mark"></span> marks. He/She has been placed in First class with Distinction.
							</i>
							</div>
							<table id="para_5">
								<tr>
								<td style="min-width:5cm;text-align:right;padding:0px 20px 0px 0px">Roll No. <span id="roll"></span></td>
								<td style="padding:0px 10px"><br>
								<span>Checked By</span><br>
								<span id="date">Date </span></td>
								<td>
								</td></tr>
							</table>
							<?php
							}
							else if($_GET['default']=='custom')
							{
								echo '</form>';
								$q='select c from pro where name="user"';
								$r=mysqli_query($con,$q);
								if($r)
								while($row=mysqli_fetch_array($r))
								echo $row[0];
							}
							else
							{
							}
							?><b></b>
		</div>
	</center>
	<script>
	document.getElementById('name').innerHTML=document.forms['data']['name'].value;
	document.getElementById('roll').innerHTML=document.forms['data']['roll'].value;
	document.getElementById('cour').innerHTML=document.forms['data']['cour'].value;
	document.getElementById('bran').innerHTML=document.forms['data']['bran'].value;
	document.getElementById('cgpa').innerHTML=document.forms['data']['cgpa'].value;
	document.getElementById('date').innerHTML='Date '+document.forms['data']['date'].value;
	document.getElementById('dide').innerHTML=document.forms['data']['dide'].value;
	document.getElementById('moff').innerHTML=document.forms['data']['moff'].value;
	document.getElementById('yoff').innerHTML=document.forms['data']['yoff'].value;
	document.getElementById('exte').innerHTML=document.forms['data']['exte'].value;
	document.getElementById('mark').innerHTML=document.forms['data']['mark'].value;
	</script>
</body>
</html>
