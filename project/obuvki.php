<?php
include ("config.php");

$id = $_GET["purzalka"] ? $_GET["purzalka"] : 0; 

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

