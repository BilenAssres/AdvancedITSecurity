<?php
include('../dbconfig.php');
	
	$info=$_GET['id'];
	
	mysqli_query($conn,"delete from feedback where id='$info'");
	header('location:index.php?info=index');
?>