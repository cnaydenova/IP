<?php
include ("config.php");

$result = mysql_query("SELECT * FROM parzalki");

while ($row = mysql_fetch_array($result)) {
   echo "ID: ".$row{'id'}. " Name: <b><a href='obuvki.php?purzalka=".$row{'id'}."'>".$row{'name'}."</a></b><br>"; 
}
mysql_close($dbhandle);
?>