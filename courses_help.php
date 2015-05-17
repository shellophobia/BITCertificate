<?php
ob_start();
session_start();
include('connect.php');
if(!isset($_SESSION['userid'])) 
header('location:message.php'); 
$i=0;
?>

<center><h2 style="padding:0px;margin:0px 0px 10px 0px;border-bottom:1px solid">AVAILABLE COURSES AND BRANCHES</h2></center>
				<fieldset class="scheduler-border"  id="degree">
					<h3>Degree Courses</h3>
						Course:
						<select class="btn btn-default" style="width:400px;" id="cour_list1" onchange="fill_data(1)">
						</select>
						<div class='row'>
								<div class='col-sm-1'>
								<form name='setpre1' style='margin-left:0px;margin-top:10px' onsubmit='return false;'>
								<input type='text' value='' class='form-control' style='width:50px' name='pre1'>
								<input type='submit' value='Save' class='btn btn-warning' style='margin-top:10px;margin-left:0px;' onclick='savpre(1)'>
								</form>
								</div>
								<div style='background:white;margin:10px;margin-left:85px;border-radius:10px;width:500px'>
								&nbsp;&nbsp;
								<span id='open1' onclick='show(1)' class='btn btn-success'><b class='caret'></b></span>
								<span id='close1' onclick='hide(1)' class='go_hide btn btn-danger' style='padding:0px 12px '><b>&times    </b></span><span id='cour_name1' style='margin-left:5px'></span>
								<div id="1" style="margin-left:30px" class="go_hide">
								
								</div>
								<div id="add1" class='go_hide' style="margin:10px 10px 30px 10px;padding:0px 0px 40px 0px">
								Add Branch :<form name="ab1" action="#" onsubmit="return false;">
								<div class='row' style='margin-left:10px'>
								<input class='form-control col-sm-1' placeholder="PRE" type='text' name='pre1' style="width:60px"><input  class='form-control col-sm-6' placeholder="BRANCH NAME" type='text' name='branch1' style="width:350px; margin-left:8px"></div></form><button class='btn btn-primary pull-right btn-block' id='bitbutton' onclick="addbranch(1)" style="margin-right:160px;width:170px">ADD</button></div></div></div>
				</fieldset>
				<br>
				<fieldset class="scheduler-border" id="diploma">
						<h3>Diploma Courses</h3>
						Course:
						<select class="btn btn-default" style="width:400px;" id="cour_list2" onchange="fill_data(2)">
						</select>
						<div class='row'>
								<div class='col-sm-1'>
								<form name='setpre2' style='margin-left:0px;margin-top:10px'>
								<input type='text' value='' class='form-control' style='width:50px' name='pre2'>
								<input type='submit' value='Save' class='btn btn-warning' style='margin-top:10px;margin-left:0px;' onclick='savpre(2)'>
								</form>
								</div>
								<div style='background:white;margin:10px;margin-left:85px;border-radius:10px;width:500px'>
								&nbsp;&nbsp;
								<span id='open2' onclick='show(2)' class='btn btn-success'><b class='caret'></b></span>
								<span id='close2' onclick='hide(2)' class='go_hide btn btn-danger' style='padding:0px 12px '><b>&times    </b></span><span id='cour_name2' style='margin-left:5px'></span>
								<div id="2" style="margin-left:30px" class="go_hide">
								
								</div>
								<div id="add2" class='go_hide' style="margin:10px 10px 30px 10px;padding:0px 0px 40px 0px">
								Add Branch :<form name="ab2" action="#" onsubmit="return false;">
								<div class='row' style='margin-left:10px'>
								<input class='form-control col-sm-1' type='text' name='pre2' style="width:60px" placeholder="PRE"><input  class='form-control col-sm-6' type='text' placeholder="BRANCH NAME" name='branch2' style="width:350px; margin-left:8px"></div></form><button class='btn btn-primary pull-right btn-block' id='bitbutton' onclick="addbranch(2)" style="margin-right:160px;width:170px">ADD</button></div></div></div>
				</fieldset>