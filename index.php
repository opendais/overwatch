<?php 
	$request_url = explode('/', $_SERVER['REQUEST_URI']);

	require_once('config.php');

	$version = $request_url[1]; 
	if(!in_array($version, array('unstable'))) {
		header("HTTP/1.0 404 API Object Not Found");
		die();
	}

	define('VERSION', $version);

	$api_call = ucfirst($request_url[2]);
	$action = $request_url[3];

	$response = array();

	if(file_exists(BASE.'classes/' . VERSION . '/api/' . $class_name . '.php')
	$request = new $object();
	$request->$action($_GET);

	
?>
