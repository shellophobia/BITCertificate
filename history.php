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
		<link href="css/style.css" rel="stylesheet">
		<link href="css/form.css" rel="stylesheet">
		<link href="css/basic.css" rel="stylesheet">
                <link rel="shortcut icon" type="image/x-icon" href="img/fav.ico">
				
</head>
<?php $site="hist";  include("header.php");?>

	<div class="container" style="min-length:600px;">
		<div class="jumbotron">
			<center><h3>HISTORY</h3></center>
			<hr>
			
			<form name="history" style="border-style:outset;border-radius:5px;" class="format form-horizontal">
			<legend>History Filters</legend>
			<div class="row">
				<div class="col-md-2">
					<label>CERTIFICATE:</label>
				</div>
				<div class="col-md-2 ">
					<select class="form-control" onchange="put_between()" name="cert">
						<option value="provisional">PROVISIONAL</option>
						<option value="migration">MIGRATION</option>
						<option value="BOTH" selected>BOTH</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label>TIME:</label>
				</div>
				<div class="col-md-2">	
						<select class="form-control" name="option" onchange="put_between()">
							<option value="1">All</option>
							<option value="0">Today</option>
							<option value="2">Last 7 days</option>
							<option value="3">This month</option>
							<option value="4">Last 30 days</option>
							<option value="5">This year</option>
							<option value="6">Last 12 months</option>
							<option value="7">Between</option>
						</select>
				</div>
			</div>
			<div class="row" id="between" style="padding:10px">				
								<div class="col-sm-1" style="padding:0px;margin:0px">
									<select name="st_date"  class="form-control">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>11</option>
										<option>12</option>
										<option>13</option>
										<option>14</option>
										<option>15</option>
										<option>16</option>
										<option>17</option>
										<option>18</option>
										<option>19</option>
										<option>20</option>
										<option>21</option>
										<option>22</option>
										<option>23</option>
										<option>24</option>
										<option>25</option>
										<option>26</option>
										<option>27</option>
										<option>28</option>
										<option>29</option>
										<option>30</option>
										<option>31</option>
									</select>
								</div>
								<div class="col-sm-1" style="padding:0px;margin:0px">
									<select name="st_month"  class="form-control">
										<option value="1">Jan</option>
										<option value="2">Feb</option>
										<option value="3">Mar</option>
										<option value="4">Apr</option>
										<option value="5">May</option>
										<option value="6">Jun</option>
										<option value="7">Jul</option>
										<option value="8">Aug</option>
										<option value="9">Sep</option>
										<option value="10">Oct</option>
										<option value="11">Nov</option>
										<option value="12">Dec</option>
									</select>
								</div>
								<div class="col-sm-2" style="padding:0px;margin:0px">
									<input type="number" class="form-control" maxlength="4" name="st_year" value="2013">
								</div>
								<div class="col-sm-1">
									<label for="x" class="control-label" style="padding:0px 0px 0px 10px">AND</label>
								</div>
								<div class="col-sm-1" style="padding:0px;margin:0px">
									<select name="fi_date"  class="form-control">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>11</option>
										<option>12</option>
										<option>13</option>
										<option>14</option>
										<option>15</option>
										<option>16</option>
										<option>17</option>
										<option>18</option>
										<option>19</option>
										<option>20</option>
										<option>21</option>
										<option>22</option>
										<option>23</option>
										<option>24</option>
										<option>25</option>
										<option>26</option>
										<option>27</option>
										<option>28</option>
										<option>29</option>
										<option>30</option>
										<option>31</option>
									</select>
								</div>
								<div class="col-sm-1" style="padding:0px;margin:0px">
									<select name="fi_month"  class="form-control">
										<option value="1">Jan</option>
										<option value="2">Feb</option>
										<option value="3">Mar</option>
										<option value="4">Apr</option>
										<option value="5">May</option>
										<option value="6">Jun</option>
										<option value="7">Jul</option>
										<option value="8">Aug</option>
										<option value="9">Sep</option>
										<option value="10">Oct</option>
										<option value="11">Nov</option>
										<option value="12">Dec</option>
									</select>
								</div>
								<div class="col-sm-2" style="padding:0px;margin:0px">
									<input type="number" class="form-control" maxlength="4"name="fi_year" value="2013">
								</div>
								<div class="col-sm-1" style="padding:0px;margin-left:10px">
									<input type="button" name="sub_hist_between" class="form-control btn btn-primary pull-right" id="bitbutton" value="Search" onclick="put_date_time()">
								</div>
			</div>
			</form>
			<center><div id="history"></div></center>
		</div>
	</div>
	
	<center>
	<span style="font-size:10px;padding:10px">Designed & Developed by A.S.U.S</span>
	</center>
	
	<!-- script jquery and bootstrap for faster loading of the page-->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/history.js"></script>
	<!-- script jquery and bootstrap for faster loading of the page-->
</body>
</html>