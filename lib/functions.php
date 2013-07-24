<?php
	function generate_password_hash($password) {
		$options = array( 'cost' => ENCRYPT_COST );
		$p = password_hash($password, PASSWORD_BCRYPT, $options);
		return $p;
	}

	function display_api_call($return, $status=200) {
		$end = microtime(true);
        	$return['runtime_in_seconds'] = $end-START;
		$return['status'] = $status;
	        echo json_encode($return);
	}
?>
