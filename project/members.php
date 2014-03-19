<?php
session_start();

include ("config.php");
include ("menu.php");

$p	= isset($_GET['p'])	? trim($_GET['p'])	: ""; 
switch ($p)
{
	case "members":
		show_members();
		break;
		
	case "login":
		login();
		break;
		
	case "logout":
		logout();
		break;
		
	case "register":
		show_register();
		break;

	default:
		show_members();
		break;
}

function show_members() {

	$result = mysql_query("SELECT * FROM  members ORDER BY member_id DESC");

	
	if (mysql_num_rows($result))
	{
	echo '
		<table>
			<thead>
				<tr>
					<th>Username</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
	';
		while($obj = mysql_fetch_array($result, MYSQL_ASSOC)) 
		{
			echo "<tr><td>" .$obj['username'] . "</td><td>" .$obj['email'] . "</td></tr>";			
		}
		
	echo '
		</tbody>
		</table>
	';

		unset($obj);
	}
	else
	{
		echo "Nqma potrebiteli";
		return;
	}
	
}

function login()
{

	echo '
		<form name="login" method="post" action=""> 
		<label for="field_online_only">Username</label>
		<input type="text" class="text" id="field_online_only" name="username" value="" maxlength="32" size="32">

		<label for="field_password">Password</label>
		<input type="password" class="text" id="field_password" name="password" value="" size="20" maxlength="32">
		
		<input type="submit" name="submit" value="Login">
		<input type="hidden" name="islogin" value="1">
		</form> 
	';
	
	$username = isset($_POST["username"]) && $_POST["username"] ? trim($_POST["username"]) : "";
	$password = isset($_POST["password"]) && $_POST["password"] ? trim($_POST["password"]) : "";

	if( $username != "" && $password != "") {
		$username = addslashes($username);
		$password = addslashes($password);

		if (isset($_POST['islogin'])  &&  $_POST['islogin'])
		{
			$sql = "SELECT * FROM members WHERE username='" . $username . "' AND password='" . md5($password) . "'";
			$result = mysql_query($sql); 

				$count = mysql_num_rows($result); 
			
			if($count==1){ 
				$_SESSION["username"] = $username;
				$_SESSION["password"] = $password;
				header("location:purzalki.php"); 
			} else { 
				echo "Greshen potrebitel ili parola!";
				
			}
		}
	}
	return 1;
}

function logout() {

	session_destroy();
	header("location:members.php?p=login"); 

}

function show_register()
{

	echo '
	
	<form name="register" method="post" action="">

	<label for="field_online_only">Username</label>
	<input type="text" class="text" id="field_online_only" name="username" value="" maxlength="32" size="32">

	<label for="field_password">Password</label>
	<input type="password" class="text" id="field_password" name="password" value="" size="20" maxlength="32">

	<label for="field_password_confirm">Confirm Password</label>
	<input type="password" class="text" id="field_password_confirm" name="password_confirm" value="" size="20" maxlength="32"><br>

	<label for="field_email">Email</label>
	<input type="text" class="text" id="field_email" name="email" value="" size="32" maxlength="64">

	<label for="field_email_confirm">Confirm email</label>
	<input type="text" class="text" id="field_email_confirm" name="email_confirm" value="" size="32" maxlength="64">

	<input class="submit" name="submit" value="Register" type="submit">
	<input type="hidden" name="isregister" value="1">
	</form>
	
	';
	$username		 = isset($_POST['username'])		 && $_POST['username']		 ? stripslashes(trim($_POST['username']))		 : "";
	$password		 = isset($_POST['password'])		 && $_POST['password']		 ? stripslashes(trim($_POST['password']))		 : "";
	$password_confirm = isset($_POST['password_confirm']) && $_POST['password_confirm'] ? stripslashes(trim($_POST['password_confirm'])) : "";
	$email			= isset($_POST['email'])			&& $_POST['email']			? stripslashes(trim($_POST['email']))			: "";
	$email_confirm	= isset($_POST['email_confirm'])	&& $_POST['email_confirm']	? stripslashes(trim($_POST['email_confirm']))	: "";
	
	if (isset($_POST['isregister'])  &&  $_POST['isregister'])
	{
		save_register($username, $password, $password_confirm, $email, $email_confirm);
	}
	
	return 1;


}


function save_register($username, $password, $password_confirm, $email, $email_confirm)
{

	if ($username == "")
	{
		echo "populni potrebitelsko ime";
		return 0;
	}

	if ($password == ""  ||  $password_confirm == "")
	{
		echo "vuvedi parola";
		return 0;
	}
	elseif ($password != $password_confirm)
	{
		echo "parolite ne suvpadat";
		return 0;
	}

	if ($email == "")
	{
		echo "populni email";
		return 0;
	}
	elseif ($email != $email_confirm)
	{
		echo "email-lite ne suvpadat";
		return 0;
	}
	

	
	$result = mysql_query("SELECT username, email FROM members WHERE username='$username' OR email='$email' LIMIT 1");
		

	if (mysql_num_rows($result))
	{
		$obj = mysql_fetch_object($result);



		if (strcmp(strtolower($obj->username), strtolower($username)) == 0)

		{
			echo "potrebitelskoto ime e zaeto";
			return 0;
		}
		elseif (strcmp(strtolower($obj->email), strtolower($email)) == 0)
		{
			echo "veche ima registriran potrebitel s tozi email";
			return 0;
		}
	}
	

	unset($obj);
	unset($result);
	

	mysql_query("INSERT INTO members (username, password, email) VALUES ('$username', '" . md5($password) . "', '$email')");
	header("location:members.php?p=login"); 
	
	return 1;
}

?>