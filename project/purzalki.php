<meta charset="utf-8" />
<?php
session_start(); 

include ("config.php");
include ("menu.php");

if(!$_SESSION["username"]){
	header("location:members.php?p=register"); 
}
$result = mysql_query("SELECT * FROM parzalki");

while ($row = mysql_fetch_array($result)) {
   echo "ID: ".$row['id']. " Èìå: <b><a href='obuvki.php?a=razpisanie&purzalka=".$row['id']."'>".$row['name']."</a></b><br>";
}
?>