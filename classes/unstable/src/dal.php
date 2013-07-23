<?php

	class DAL {
		private $dbh;
		
		__construct($username, $password, $hostname) {
			try {
				$this->$dbh = new PDO("mysql:host=$hostname", $username, $password);		
			}
			catch (PDOException $E) {
				trigger_error("DAL failed to connect with $E", E_USER_ERROR);
				die();
			}
		}

	}	

?>
