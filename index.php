<?php 
	$request_url = explode('/', $_SERVER['REQUEST_URI']);

	$version = $request_url[1]; 
	if(!in_array($version, array('unstable'))) {
		header("HTTP/1.0 404 API Object Not Found");
		die();
	}

	define('VERSION', $version);

	$api_call = strtolower(str_replace(".json",".php",$request_url[2]));

	$response = array();

	require_once('config.php');
	$target = BASE.'classes/' . VERSION . '/api/' . $api_call;
	if(file_exists($target)) {
		echo 'test';
		require_once($target);
		echo 't2';
	}
	else {
		header("HTTP/1.0 404 API Object Not Found");die();		
	}
	
?>
