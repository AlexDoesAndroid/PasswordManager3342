<?php
	session_start();
	$_SESSION["RegState"] = 1;
	header("location:../login.html");
	exit();
?>