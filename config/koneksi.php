<?php 
session_start();
date_default_timezone_set("Asia/Jakarta");
$is_local = "yes";
if (strtolower($is_local) == 'yes') {
	// error_reporting(0);
	$conn = new mysqli("localhost","root","","futsal");
}else{
	$conn = mysqli_connect('localhost','monb9823_monev','monb9823_monev==D','monb9823_brainy');
}
?>