<?php
if($site=='none')
echo '<body>';
else
{
?>
<body style="background:url('img/bit.jpg');background-position:0% 0%;background-size:100% 100%;background-repeat:no-repeat;background-attachment:fixed;">
<?php
}
?>
	<div class="navbar navbar-inverse navbar-static-top noprint">
		<div id="container">
			<img class="img-responsive col-md-3" src="img/name.jpg">
			<button class="navbar-toggle" data-toggle = "collapse" data-target=".navHeaderCollapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="collapse navbar-collapse navHeaderCollapse col-md-3 pull-right" style="padding:20px 30px 0px 0px">
				<ul class="nav nav-pills navbar-right">
					<li <?php if($site=="home") echo 'class="active"';?> ><a href="form.php" id="">HOME</a></li>
					<li <?php if($site=="hist") echo 'class="active"';?> ><a href="history.php" id="">HISTORY</a></li>
					<li <?php if($site=="exte") echo 'class="active"';?> ><a href="extensions.php" >EXTENSIONS</a></li>
					<li <?php if($site=="cour") echo 'class="active"';?> ><a href="courses.php" >COURSES</a></li>
					<li><a href="logout.php" id="" class="">LOGOUT</a></li>
					<li <?php if($site=="revi") echo 'class="active"';?> ><a href="review.php">WRITE US</a></li>
				</ul>
				</div>
		</div>	
	</div>
