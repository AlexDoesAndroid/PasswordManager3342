<?php
	session_start();
	$_SESSION["RegState"] = 1;
	header("location:../index.html");
	exit();
?>