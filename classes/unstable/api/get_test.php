<?php
	if(isset($password))
		die("...why is \$password set?");
	$password_test = "vagrant";
	#$password = password_hash($password_test, PASSWORD_BCRYPT);
	$password = generate_password_hash($password_test);
	if($password === false)
		die("UPGRADE PHP TO AT LEAST 5.3.7+ as per https://github.com/ircmaxell/password_compat");
	if (password_verify($password_test, $password)) {
	    /* Valid */
	} else {
	    /* Invalid */
		die("UPGRADE PHP TO AT LEAST 5.3.7+ as per https://github.com/ircmaxell/password_compat");
	}
	$return = array("hello" => "world", "password" => $password, "dal" => $DAL->query("SELECT (30+12) as MeaningOfLife, NOW() as Timestamp"));
	unset($password); # Just to be sure no one does anything stupid like including this file and have it overwriting something important like a password.
	unset($password_test);

	display_api_call($return);
?>
