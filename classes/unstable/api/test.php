<?php
	echo $password;
	if(isset($password))
		die("...why is \$password set?");
	$password = "vagrant";
	echo json_encode( array( "hello" => "world", "password" => password_hash($password, PASSWORD_BCRYPT), "dal" => $DAL->query("SELECT (30+12) as MeaningOfLife, NOW() as Timestamp")));
	unset($password); # Just to be sure no one does anything stupid like including this file and have it overwriting something important like a password.
?>
