<?php

	class DAL {
		private $dbh;
		
		function __construct($username, $password, $hostname) {
			try {
				$this->dbh = new PDO("mysql:host=$hostname", $username, $password);		
				$this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch (PDOException $E) {
				trigger_error("DAL failed to connect with $E", E_USER_ERROR);
				die();
			}
		}
		
		function query($sql, $parameters = array(), $lazy = true) {
			/* http://dev.mysql.com/doc/refman/5.1/en/query-cache-operation.html - different case, doesn't cache*/
			$sth = $this->dbh->prepare(strtolower($sql), array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY)); 
			$sth->execute($parameters);
			
			if($lazy)
				return $sth->fetchAll(PDO::FETCH_ASSOC);
			else
				return $sth;
		}

	}	

?>
