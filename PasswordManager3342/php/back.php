<?php
	session_start();
	$_SESSION["RegState"] = 0;
	header("location:../login.html");
	exit();
?>