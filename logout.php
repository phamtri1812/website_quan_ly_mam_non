<?php require_once("connect.php");
	error_reporting(0); 
	session_start();
	session_destroy();
	header("Location:inc/home.php");
	
?>