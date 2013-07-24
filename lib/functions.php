<?php
	function generate_password_hash($password) {
		$options = array( 'cost' => ENCRYPT_COST );
		$p = password_hash($password, PASSWORD_BCRYPT, $options);
		return $p;
	}

	function display_api_call($return) {
		$end = microtime(true);
        	$return['runtime_in_seconds'] = $end-START;
	        echo json_encode($return);
	}
?>
