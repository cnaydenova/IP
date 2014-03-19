<?php

$username = isset($_SESSION["username"]) && $_SESSION["username"] ? trim($_SESSION["username"]) : "";

if($username){
	echo '
	
	<ul>
		<li><a href="members.php">Members</a></li>
		<li><a href="purzalki.php">Purzalki</a></li>
		<li><a href="members.php?p=logout">Exit</a></li>
	</ul>
	
	';
	
} else {

	echo '
	
	<ul>
		<li><a href="members.php?p=login">Log in</a></li>
		<li><a href="members.php?p=register">Register</a></li>
	</ul>
	
	';
	
}

?>
