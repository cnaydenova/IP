<meta charset="utf-8" />
<?php
session_start(); 

include ("config.php");
include ("menu.php");

if(!$_SESSION["username"]){
	header("location:members.php?p=register"); 
}

$action	= isset($_GET['a'])	? trim($_GET['a'])	: "";
$id = isset($_GET['purzalka'])  ? trim($_GET['purzalka']) : 0;

echo '
	<ul>
		<li><a href="admin.php?a=showRinks">Пързалки</a></li>
		<li>Разписания</li>
		<li>Потребители</li>
	</ul>
';

switch ($action)
{
	case "showRinks":
		showRinks();
		break;
		
	case "addRink":
		addRink(0);
		break;
		
	case "deleteRink":

		deleteRink($id);
		break;
		
	case "editRink":
		addRink($id);
		break;

	default:
		showRinks();
		break;
}

function showRinks() {

	$result = mysql_query("SELECT * FROM parzalki");
	echo "<table><tr><th>Име</th><th>Действия</th></tr>";
	while ($row = mysql_fetch_array($result)) {
	   echo "<tr><td>".$row['name']."</td><td><a href='admin.php?a=editRink&purzalka=".$row['id']."'>Редактирай</a> <a href='admin.php?a=deleteRink&purzalka=".$row['id']."'>Изтрий</a></td></tr>"; 
	}
	echo "</table>";

}

function addRink($id) {

	if ($id) {

		$result = mysql_query("SELECT * FROM parzalki WHERE id='$id' LIMIT 1");

		if (mysql_num_rows($result)) {

			$obj = mysql_fetch_object($result);
			$body = isset($_POST['nameRink']) ? stripslashes(trim($_POST['nameRink'])) : $obj->name;
			
			unset($obj);

		echo '
		
		<form method="post" action="">

		<label for="field_name">Име</label>
		<input type="text" id="field_name" name="nameRink" value="'. $body .'" maxlength="32" size="32">

		<input name="submit" type="submit">
		</form>
		
		';

		}
		
		unset($result);
		
	} else {
	
	echo '
		
		<form method="post" action="">
			<label for="field_name">Име</label>
			<input type="text" id="field_name" name="nameRink" value="" maxlength="32" size="32">
			<input name="submit" type="submit">
		</form>
		
		';
	}

	$nameRink  = isset($_POST['nameRink']) && $_POST['nameRink'] ? stripslashes(trim($_POST['nameRink'])) : "";
		

	if (isset($_POST['submit'])  &&  $_POST['submit'] && $nameRink != "") {
		if ($nameRink == "") {
			echo "Въведи име";
			return 0;
		}
		
		if($id) {
			mysql_query("UPDATE parzalki SET name='$nameRink' WHERE id='$id' LIMIT 1");
			echo "Успешно промени пързалка";
		} else {
			mysql_query("INSERT INTO parzalki (name) VALUES('$nameRink')");
			echo "Успешно добави пързалка";
		}
		
		header("location:admin.php?a=showRinks"); 
		
		return 1;
	}		
}

function deleteRink($id) {

	mysql_query("DELETE FROM parzalki WHERE id='$id' LIMIT 1");
	mysql_query("DELETE FROM purzalki_obuvki WHERE id_purzalka='$id'");
	mysql_query("DELETE FROM razpisanie WHERE id_rink='$id'");
	mysql_query("DELETE FROM reservation WHERE id_rink='$id'");
	
	echo "Пързалката е изтрита";
	
	header("location:admin.php?a=showRinks"); 
	
	return 1;

}

?>