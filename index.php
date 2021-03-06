<?php 
	/* GotHeader? */
	header('X-API-Requests-Remaining: 60'); # Headers are less 'obvious' than response payloads. It may be better to put it there.
	header('X-Refill-API-Requests-At: ??'); #timestamp should go here when I build the ratelimiting - YYYY-MM-DDTHH:MM:SSZ / ISO 8601
	header('Accept: application/json');
	header('Content-Type: application/json');
	header("Cache-Control: no-cache, must-revalidate"); # Because data changes.
	header("Expires: Fri, 31 Dec 1999 11:59:59 GMT"); # Let us party like it is 1999

	$request_url = explode('/', $_SERVER['REQUEST_URI']);

	$version = $request_url[1]; 
	if(!in_array($version, array('unstable')) || substr_count($_SERVER['REQUEST_URI'], 'php') > 0 ) {
		header("HTTP/1.0 404 API Object Not Found");
		echo json_encode(array('status' => 404));
		exit(0);
	}

	define('VERSION', $version);
	
	# Basic API Call: 	https://dev.local/unstable/test.json 
	#			https://uri/version/function.json or https://uri/version/function/id.json
	#			POST = Create, PUT = Update, GET = Read, DELETE = Delete

	$api_call = strtolower($_SERVER['REQUEST_METHOD']) ."_". strtolower(str_replace(".json","",$request_url[2])).".php";

	$id = -1;
	if(isset($request_url[3]))
		$id = strtolower(str_replace(".json","",$request_url[3]));
	if($id == -1)
		unset($id);

	$response = array();

	require_once('config.php');
	$target = BASE.'classes/' . VERSION . '/api/' . $api_call ;
	if(file_exists($target)) {
		require_once($target);
	}
	else {
		header("HTTP/1.0 404 API Object Not Found");		
		echo json_encode(array('status' => 404));
		exit(0);
	}
	
