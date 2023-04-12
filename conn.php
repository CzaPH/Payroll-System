<?php
	$conn=mysqli_connect("localhost", "root", "", "payroll");
 
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
?>