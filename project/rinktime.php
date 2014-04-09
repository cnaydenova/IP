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
	case "add_time":

		addTime($id);
		break;

	default:

		showRink();
		break;
}

function showRink() {

$result = mysql_query("SELECT * FROM parzalki");

while ($row = mysql_fetch_array($result)) {
   echo "ID: ".$row{'id'}. " Name: <b><a href='rinktime.php?a=add_time&purzalka=".$row{'id'}."'>".$row{'name'}."</a></b><br>";
}

}

function addTime($id) {

	if (!$id) {
		echo "Няма избрана пързалка<br />";
$result = mysql_query("SELECT * FROM parzalki");

while ($row = mysql_fetch_array($result)) {
   echo "<a href='rinktime.php?a=add_time&purzalka=".$row{'id'}."'>".$row{'name'}."</a><br />";
}

		exit;
	}

	echo "<form method='post'>

	Ден <select name='start_day'>
		<option value='1'>Понеделник</option>
		<option value='2'>Вторник</option>
		<option value='3'>Сряда</option>
		<option value='4'>Четвъртък</option>
		<option value='5'>Петък</option>
		<option value='6'>Събота</option>
		<option value='7'>Неделя</option>
	</select><br />

	Започва <select name='start_hour'>
		<option value='00'>00</option>
		<option value='01'>01</option>
		<option value='02'>02</option>
		<option value='03'>03</option>
		<option value='04'>04</option>
		<option value='05'>05</option>
		<option value='06'>06</option>
		<option value='07'>07</option>
		<option value='08'>08</option>
		<option value='09'>09</option>
		<option value='10'>10</option>
		<option value='11'>11</option>
		<option value='12'>12</option>
		<option value='13'>13</option>
		<option value='14'>14</option>
		<option value='15'>15</option>
		<option value='16'>16</option>
		<option value='17'>17</option>
		<option value='18'>18</option>
		<option value='19'>19</option>
		<option value='20'>20</option>
		<option value='21'>21</option>
		<option value='22'>22</option>
		<option value='23'>23</option>
	</select>

	<select name='start_minute'>
		<option value='00'>00</option>
		<option value='01'>01</option>
		<option value='02'>02</option>
		<option value='03'>03</option>
		<option value='04'>04</option>
		<option value='05'>05</option>
		<option value='06'>06</option>
		<option value='07'>07</option>
		<option value='08'>08</option>
		<option value='09'>09</option>
		<option value='10'>10</option>
		<option value='11'>11</option>
		<option value='12'>12</option>
		<option value='13'>13</option>
		<option value='14'>14</option>
		<option value='15'>15</option>
		<option value='16'>16</option>
		<option value='17'>17</option>
		<option value='18'>18</option>
		<option value='19'>19</option>
		<option value='20'>20</option>
		<option value='21'>21</option>
		<option value='22'>22</option>
		<option value='23'>23</option>
		<option value='24'>24</option>
		<option value='25'>25</option>
		<option value='26'>26</option>
		<option value='27'>27</option>
		<option value='28'>28</option>
		<option value='29'>29</option>
		<option value='30'>30</option>
		<option value='31'>31</option>
		<option value='32'>32</option>
		<option value='33'>33</option>
		<option value='34'>34</option>
		<option value='35'>35</option>
		<option value='36'>36</option>
		<option value='37'>37</option>
		<option value='38'>38</option>
		<option value='39'>39</option>
		<option value='40'>40</option>
		<option value='41'>41</option>
		<option value='42'>42</option>
		<option value='43'>43</option>
		<option value='44'>44</option>
		<option value='45'>45</option>
		<option value='46'>46</option>
		<option value='47'>47</option>
		<option value='48'>48</option>
		<option value='49'>49</option>
		<option value='50'>50</option>
		<option value='51'>51</option>
		<option value='52'>52</option>
		<option value='53'>53</option>
		<option value='54'>54</option>
		<option value='55'>55</option>
		<option value='56'>56</option>
		<option value='57'>57</option>
		<option value='58'>58</option>
		<option value='59'>59</option>
	</select><br />
	
	Свършва <select name='end_hour'>
		<option value='00'>00</option>
		<option value='01'>01</option>
		<option value='02'>02</option>
		<option value='03'>03</option>
		<option value='04'>04</option>
		<option value='05'>05</option>
		<option value='06'>06</option>
		<option value='07'>07</option>
		<option value='08'>08</option>
		<option value='09'>09</option>
		<option value='10'>10</option>
		<option value='11'>11</option>
		<option value='12'>12</option>
		<option value='13'>13</option>
		<option value='14'>14</option>
		<option value='15'>15</option>
		<option value='16'>16</option>
		<option value='17'>17</option>
		<option value='18'>18</option>
		<option value='19'>19</option>
		<option value='20'>20</option>
		<option value='21'>21</option>
		<option value='22'>22</option>
		<option value='23'>23</option>
	</select>

	<select name='end_minute'>
		<option value='00'>00</option>
		<option value='01'>01</option>
		<option value='02'>02</option>
		<option value='03'>03</option>
		<option value='04'>04</option>
		<option value='05'>05</option>
		<option value='06'>06</option>
		<option value='07'>07</option>
		<option value='08'>08</option>
		<option value='09'>09</option>
		<option value='10'>10</option>
		<option value='11'>11</option>
		<option value='12'>12</option>
		<option value='13'>13</option>
		<option value='14'>14</option>
		<option value='15'>15</option>
		<option value='16'>16</option>
		<option value='17'>17</option>
		<option value='18'>18</option>
		<option value='19'>19</option>
		<option value='20'>20</option>
		<option value='21'>21</option>
		<option value='22'>22</option>
		<option value='23'>23</option>
		<option value='24'>24</option>
		<option value='25'>25</option>
		<option value='26'>26</option>
		<option value='27'>27</option>
		<option value='28'>28</option>
		<option value='29'>29</option>
		<option value='30'>30</option>
		<option value='31'>31</option>
		<option value='32'>32</option>
		<option value='33'>33</option>
		<option value='34'>34</option>
		<option value='35'>35</option>
		<option value='36'>36</option>
		<option value='37'>37</option>
		<option value='38'>38</option>
		<option value='39'>39</option>
		<option value='40'>40</option>
		<option value='41'>41</option>
		<option value='42'>42</option>
		<option value='43'>43</option>
		<option value='44'>44</option>
		<option value='45'>45</option>
		<option value='46'>46</option>
		<option value='47'>47</option>
		<option value='48'>48</option>
		<option value='49'>49</option>
		<option value='50'>50</option>
		<option value='51'>51</option>
		<option value='52'>52</option>
		<option value='53'>53</option>
		<option value='54'>54</option>
		<option value='55'>55</option>
		<option value='56'>56</option>
		<option value='57'>57</option>
		<option value='58'>58</option>
		<option value='59'>59</option>
	</select>
	
	<input name='submit' type='submit' value='Sub'>
	</form>";
	
	if (isset($_POST['submit'])  &&  $_POST['submit']) {
		$id_parzalka = $_GET['purzalka'];
		$start = $_POST['start_day'] . $_POST['start_hour'] . $_POST['start_minute'];
		$end = $_POST['start_day'] . $_POST['end_hour'] . $_POST['end_minute'];
		addRinkTime($id_parzalka, $start, $end);
	}

}

function addRinkTime($id_parzalka, $start, $end) {

	mysql_query("INSERT INTO razpisanie (id_rink, start, end) VALUES ('$id_parzalka', '$start', '$end')");

	header("location:rinktime.php"); 

	return 1;

}

?>