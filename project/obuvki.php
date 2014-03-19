<?php
session_start(); 

include ("config.php");
include ("menu.php");

$id = isset($_GET['purzalka'])  ? trim($_GET['purzalka']) : 0; 

if(!$_SESSION["username"]){
	header("location:members.php?p=register"); 
}

$result = mysql_query("SELECT * FROM purzalki_obuvki WHERE id_purzalka=".$id."");

if (mysql_num_rows($result)) {

	while ($row = mysql_fetch_array($result)) {
		echo "Nomer obuvka: <b>".$row{'nomer_obuvka'}."</b> Nalichnost: <b>".$row{'broi_chifta'}."</b><br>"; 
	}
	
} else {
	echo "nqma nalichna informacia";
}
mysql_close($dbhandle);
?>

