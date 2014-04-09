<?php
ob_start();
$hostname = "localhost"; 
$username = "root";
$password = "";

$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");

$selected = mysql_select_db("test",$dbhandle) or die("Could not select examples");

?>