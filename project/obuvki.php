<meta charset="utf-8" />
<?php
session_start(); 

include ("config.php");
include ("menu.php");

$action	= isset($_GET['a'])	? trim($_GET['a'])	: "";
$id = isset($_GET['purzalka'])  ? trim($_GET['purzalka']) : 0;

if(!$_SESSION["username"]){
	header("location:members.php?p=register"); 
}

switch ($action)
{
	case "nalichnost":

		obuvka($id);
		break;
		
	case "reservation":

		reservation($id);
		break;
		
	case "razpisanie":

		razpisanie($id);
		break;

	default:

		obuvka($id);
		break;
}

function razpisanie($id) {

	$day_box['1'] = "Понеделник";
	$day_box['2'] = "Вторник";
	$day_box['3'] = "Сряда";
	$day_box['4'] = "Четвъртък";
	$day_box['5'] = "Петък";
	$day_box['6'] = "Събота";
	$day_box['7'] = "Неделя";
	
	$result = mysql_query("SELECT * FROM razpisanie WHERE id_rink =" . $id);
	
	if (mysql_num_rows($result)) {
		echo "<table>";
		while ($row = mysql_fetch_array($result)) {
		
			$startDay = $row['start'];
			$endDay = $row['end'];
				$date_start_day = @substr($startDay, 0, 1);
				$date_start_hours = @substr($startDay, 1, 2);
				$date_start_minute = @substr($startDay, 3, 2); 
					$start = $date_start_hours . ":" .$date_start_minute;
				$date_end_hours = @substr($endDay, 1, 2);
				$date_end_minute = @substr($endDay, 3, 2);
					$end = $date_end_hours . ":" .$date_end_minute;
			echo "<tr>
				<td>". $day_box[$date_start_day] . "</td>
				<td>". $start ."</td><td>". $end ."</td><td><a href='obuvki.php?a=nalichnost&purzalka=".$id."'>Инфо</a></td></tr>";
		}

		echo "</table>";
		
	} else {
		echo "Няма налична информация";
	}
	unset($result);

}

function obuvka($id) {
	$result = mysql_query("SELECT * FROM purzalki_obuvki WHERE id_purzalka=".$id);

	if (mysql_num_rows($result)) {

		while ($row = mysql_fetch_array($result)) {
			echo "Номер на обувката: <b>".$row['nomer_obuvka']."</b> Наличност: <b>".$row['broi_chifta']."</b><br>";
		}
		
	} elseif ($id == 0) {
	
		$result = mysql_query("SELECT * FROM parzalki");
		while ($row = mysql_fetch_array($result)) {
		   echo "Име: <b><a href='obuvki.php?a=razpisanie&purzalka=".$row['id']."'>".$row['name']."</a></b><br>"; 
		}

	} else {
		echo "Няма налична информация";
	}
	unset($result);
	
	return 1;
}

function reservation($id) {


	$day_box['1'] = "Понеделник";
	$day_box['2'] = "Вторник";
	$day_box['3'] = "Сряда";
	$day_box['4'] = "Четвъртък";
	$day_box['5'] = "Петък";
	$day_box['6'] = "Събота";
	$day_box['7'] = "Неделя";

	$result = mysql_query("SELECT * FROM razpisanie WHERE id_rink =" . $id);
	
	if (mysql_num_rows($result)) {

	echo "<form method='post' action=''>";
		echo "Дата <select name='date'>";
		
		while ($row = mysql_fetch_array($result)) {
		
			$startDay = $row['start'];
			$endDay = $row['end'];
				$date_start_day = @substr($startDay, 0, 1);
				$date_start_hours = @substr($startDay, 1, 2);
				$date_start_minute = @substr($startDay, 3, 2); 
					$start = $day_box[$date_start_day] . " " . $date_start_hours . ":" .$date_start_minute;
				$date_end_hours = @substr($endDay, 1, 2);
				$date_end_minute = @substr($endDay, 3, 2);
					$end = $date_end_hours . ":" .$date_end_minute;
			echo "<option value=".$row['id'].">". $start." - ".$end."</option>";
		}

		
		echo "</select><br />";
			$query = mysql_query("SELECT * FROM purzalki_obuvki WHERE id_purzalka=".$id);

			if (mysql_num_rows($query)) {
				echo "Номер на обувката <select name='obuvka1'>";
				
				while ($row = mysql_fetch_array($query)) {
					echo "<option value=".$row['id'].">".$row['nomer_obuvka']."</option>";
				}
				
				echo "</select>";
			}
			unset($query);
		echo "<input name='submit' type='submit' value='Sub'>";
		
		echo "</form>";
	} else {
		echo "Няма налична информация";
	}
	unset($result);
	
	if (isset($_POST['submit'])  &&  $_POST['submit']) {
		$obuvka = $_POST['obuvka1'];
		$parzalka = $_GET['purzalka'];
		$date = $_POST['date'];
		mysql_query("INSERT INTO reservation (id_obuvka, id_rink, id_member, id_razpisanie) 
				VALUES ('$obuvka', '$parzalka', '".$_SESSION["member_id"]."', '$date')");
	}
	
	return 1;
}
?>

