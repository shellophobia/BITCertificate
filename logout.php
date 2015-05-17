<?php
ob_start();
session_start();
setcookie("userid","",time()-3600);
session_destroy();
header("location:index.php");

?>