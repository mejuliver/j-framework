<?php
	if(!defined('pixzel')) :
		die('You have no candy, get off my lawn!');
	endif;

	// process the request
	$request = trim($_SERVER['REQUEST_URI'], '/');

	if($request==='') {
		if(file_exists('app/index.php')===0){
		    header('HTTP/1.1 404 Not Found');

		    echo 'Ghost page? seems like this page does not exist';

		    exit;
		}

		include $core->theme_dir.'/app/index.php';
		exit;
	}

	//check if route exist

	$http = 0;
	$http_portal = '';

	foreach($routes_array as $key => $value){
		if($request === $value['name']){
			$http = 1;
			$http_portal = $value['render'];
			break;
		}
	}

	if($http===1){
		if(view($http_portal) === 0){
			echo 'Page does not exist';
			exit;
		}
	}else{
		header('HTTP/1.1 404 Not Found');
		echo 'Page does not exist';
		exit;
	}


