<?php
ob_start();
session_start();
include('connect.php');
if(!isset($_SESSION['userid'])) 
header('location:message.php'); 

$name=$_GET['name'];
$roll=$_GET['roll'];
$dide=$_GET['dide'];
$yofj=$_GET['yofj'];
$yofp=$_GET['yofp'];
$exte=$_GET['exte'];
$q1="select year(CURDATE())";
		$q2="select month(CURDATE())";
		$q3="select dayofmonth(CURDATE())";
		$r1=mysqli_query($con,$q1);
		$r2=mysqli_query($con,$q2);
		$r3=mysqli_query($con,$q3);
		if($r1&&$r2&&$r3)
		{
			$row1=mysqli_fetch_array($r1);
			$row2=mysqli_fetch_array($r2);
			$row3=mysqli_fetch_array($r3);
			
			$year=$row1[0];
			$month=$row2[0];
			$date=$row3[0];
			
		}		
$no=$date.''.$month.''.$year;
$date=$date.'-'.$month.'-'.$year;
?>
<form name="data" onsubmit="return false;" style="position:absolute;visibility:hidden">
	<input name="name" value="<?php echo $name; ?>" readonly>
	<input name="roll" value="<?php echo $roll; ?>" readonly>
	<input name="date" value="<?php echo $date; ?>" readonly>
	<input name="dide" value="<?php echo $dide; ?>" readonly>
	<input name="yofp" value="<?php echo $yofp; ?>" readonly>
	<input name="yofj" value="<?php echo $yofj; ?>" readonly>
	<input name="no" value="<?php echo $no; ?>" readonly>
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
padding:5px 0px 0px 0px;
}
#para_certificate
{
text-transform:uppercase;
padding:100px 0px 50px 0px;
font-weight:bold;
}
#line_1
{
margin:0px 60px;
line-height:300%;
}
#line_2 
{
margin:30px 60px;
}
#line_3
{
margin:0px 80px;
line-height:180%;
}
#line_4
{
margin:30px 80px;
line-height:180%;
}
#line_5
{
margin:90px 80px;
line-height:180%;
}
#name,#roll,#dide,#rofl,#cond,#exte
{
font-weight:bold;
}
#name:hover,#roll:hover,#dide:hover,#exte:hover,#yofj:hover,#yofp:hover
{
background:orange;
cursor:pointer
}
</style>
</head>
<body style="padding:80px 0px">
	<center>
	<div id="preview" style="background:url('img/bit_logo copy.jpg');background-position:50% 47%;background-size:58% 47%;background-repeat:no-repeat;
	border-style:solid;color:black;
	border-image:url('img/logo.jpg') 100 100 100 100 stretch;
	-moz-border-image:url('img/logo.jpg') 100 100 100 100 stretch;
	-ms-border-image:url('img/logo.jpg') 100 100 100 100 stretch;
	-o-border-image:url('img/logo.jpg') 100 100 100 100 stretch;
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
			<span>MIGRATION &#38; TRANSFER CERTIFICATE</span>
		</div>
		<div id="line_1">
			<i>The institute has no objection to Mr./Ms.</i> <span id="name"></span>,<br><i>Roll No.</i><span id="roll"></span>,<i>a student of the institute migrating to another university.</i>
		</div>			
		<div id="line_2">
			He/She was admitted to the institute in the academic year <span id="yofj"></span>-<span id="yofp"></span> in the <span id="dide"></span> Course. 
		</div>
		<div id="line_3">
			His/Her conduct during the stay was : <span id="cond">Good/Satisfactory</span>
		</div>
		<div id="line_4">
			Reson of leaving : <span id="rofl">Completion of course/Withdrawal</span>
		</div>
		<table id="line_5">
							<tr>
							<td style="width:5cm">	No. <span id="no"></span></td>
							<td>
							<br>
							<span>Verified By</span><br>
							<span id="date">Date </span></td>
							<td>
							</td></tr>
						</table>
				<?php
				}
				else if($_GET['default']=='custom')
				{
				echo '</form>';
				$q='select c from mig where name="user"';
				$r=mysqli_query($con,$q);
				if($r)
				while($row=mysqli_fetch_array($r))
				echo $row[0];
				}
				else
				{
				echo 'hasidhiasd';
				}
				?><b></b>
	</div>
	</center>
	<!-- script jquery and bootstrap for faster loading of the page-->
	<script>
	
	document.getElementById('name').innerHTML=document.forms['data']['name'].value;
	document.getElementById('roll').innerHTML=document.forms['data']['roll'].value;
	document.getElementById('date').innerHTML='Date '+document.forms['data']['date'].value;
	document.getElementById('dide').innerHTML=document.forms['data']['dide'].value;
	document.getElementById('yofj').innerHTML=document.forms['data']['yofj'].value;
	document.getElementById('yofp').innerHTML=document.forms['data']['yofp'].value;
	document.getElementById('exte').innerHTML=document.forms['data']['exte'].value;
	document.getElementById('no').innerHTML=document.forms['data']['no'].value;
	</script>
	<!-- script jquery and bootstrap for faster loading of the page-->
	</body>
	</html>