<?php
session_start();
include('connect.php');
if(!isset($_SESSION['userid'])) 
header('location:message.php'); 

if(isset($_GET['cert']))
{	
	
	$type=$_GET['cert'];
	
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
			
			//$fdate=$year.'-'.$month.'-'.$date;
		}		
		if($_GET['his']==1)
		{
			if($type=="BOTH")
			$q="select * from history limit 50";
			else
			$q="select * from history where doctype='$type'";
		}
		if($_GET['his']==0)
		{
			if($type=="BOTH")
			$q="select * from history where date(`time`)=curdate()";
			else
			$q="select * from history where date(`time`)=curdate() and doctype='$type'";
		}
		else if($_GET['his']==2)
		{
			if($type=="BOTH")
			$q="select * from history where date(`time`) between curdate()-interval 1 WEEK and curdate()";		
			else
			$q="select * from history where date(`time`) between curdate()- interval 1 week and curdate() and doctype='$type'";		
		}
			
		else if($_GET['his']==3)
		{
			$date=1;
			$fdate=$year.'-'.$month.'-'.$date;
			if($type=="BOTH")
			$q="select * from history where date(`time`) >= '$fdate'";
			else
			$q="select * from history where date(`time`) >= '$fdate' and doctype='$type'";
		}
			
		else if($_GET['his']==4)
		{
			if($type=="BOTH")
			$q="select * from history where date(`time`) >= (curdate()-interval 1 MONTH)";
			else
			$q="select * from history where date(`time`) >= (curdate()-interval 1 MONTH) and doctype='$type'";
				
		}
			
		else if($_GET['his']==5)
		{
			$date=1;
			$month=1;
			$fdate=$year.'-'.$month.'-'.$date;
			if($type=="BOTH")
				
			$q="select * from history where date(`time`) >= '$fdate'";
			else
			$q="select * from history where date(`time`) >= '$fdate' and doctype='$type'";
		}
		
		else if($_GET['his']==6)
		{
			$year=$year-1;
			$fdate=$year.'-'.$month.'-'.$date;
			if($type=="BOTH")
			$q="select * from history where date(`time`) >= '$fdate'";		
			else
			$q="select * from history where date(`time`) >= '$fdate' and doctype=$type";		
		}
			
		else if($_GET['his']==7)
		{
			$date1=$_GET['date1'];
			$date2=$_GET['date2'];
			if($type=="BOTH")
			$q="select * from history where date(`time`) >= '$date1' and date(`time`)<='$date2'";
			else
			$q="select * from history where date(`time`) >= '$date1' and date(`time`)<='$date2' and doctype='$type'";
		}	
?>
<table class="table" style="width:50%;font-size:13px;border:1px solid">
			<tr bgcolor="#073350" style="color:white"><th>Date</th><th>ROLL NO.</th><th>CERTIFICATE</th><th>TYPE</th><th>ISSUE / REISSUE</th></tr>
			<?php
			$r=mysqli_query($con,$q);
			if($r)
			{
				while($row=mysqli_fetch_array($r))
				{
				$rows=explode(' ',$row[4]);
				$row[4]=$rows[0];
				echo "<tr id='hover'><td>".$row[4]."</td><td>".$row[0]."</td><td>".$row[3]."</td><td>".$row[1]."</td>";
				echo"<td>".$row[2]."</td></tr>";
				}
			}
	?>
</table>
<?php } ?>
