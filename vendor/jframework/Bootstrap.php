<?php namespace App;

// check if theres a config file first
if( file_exists(  __DIR__.'/../../config.php' ) ){
	require_once( __DIR__.'/../../config.php'); // require the config

	
		if( defined('fresh') ){
			include __DIR__ . '/helpers/welcome.php';
			exit;
		}
		
	
}else{
	if( file_exists( __DIR__ . '/helpers/error.php' ) ){
		$error_name = 'App config file was not found (config.php)';
		include __DIR__ . '/helpers/error.php';
		exit;
	}else{
		header('HTTP/1.1 404 Not Found');
		die('App config file was not found (config.php)');
	}
	
}

// check for the routes file
if( file_exists(  __DIR__.'/../../routes.php' ) ){
	require_once( __DIR__.'/../../routes.php'); // require the config
}else{
	if( file_exists( __DIR__ . '/helpers/error.php' ) ){
		$error_name = 'App routes file is required (routes.php)';
		include __DIR__ . '/helpers/error.php';
		exit;
	}else{
		header('HTTP/1.1 404 Not Found');
		die('App routes file is required (routes.php)');
	}
}

require_once( __DIR__.'/../../routes.php'); // require the config

if( file_exists(  __DIR__.'/Framework.php' ) ){
	require_once( __DIR__.'/Framework.php'); // require the config
}else{
	if( file_exists( __DIR__ . '/helpers/error.php' ) ){
		$error_name = 'jframework was not found (framework.php)';
		include __DIR__ . '/helpers/error.php';
		exit;
	}else{
		header('HTTP/1.1 404 Not Found');
		die('jframework was not found (framework.php)');
	}
}


use App\Framework as framework;

// initialize the framework
$_app = new framework;
// get the route, init checks the current http request and get the specific route base on the return http request type
$_route = $_app->init(); // run app init

require_once(__DIR__.'/Library.php'); // require the library

// check routes
if( $_route[0] ){ // check if true/false, if false then it means there's an error bag
	if( $_route[1] == 'index' ){ // check if current route returns index, if index then means the current http request is '/' or ''
		if( file_exists( __DIR__ . '/../../templates/index.php' ) ){
			$_app->view('index');
		}else{
			if( file_exists( __DIR__ . '/helpers/error.php' ) ){
				$error_name = 'Default index was not found in the templates (index.php)';
				include __DIR__ . '/helpers/error.php';
				exit;
			}else{
				header('HTTP/1.1 404 Not Found');
				die('Default index was not found in the templates (index.php)');
			}
		}
		
	}else{ // if route is not 'index' then look unto routes.php
		$controller = false;
		$models = false;
		if( isset( $_route[1][2] ) && $_route[1][2] != false ){
			$models = $_route[1][2];
		}
		require_once('Model.php'); // require the base model
		// check if current
		if( isset( $_route[1][1] ) && $_route[1][1] != false){ // if no controller specified then load the view automatically
			$controller = $_route[1][1];
			require_once('Controller.php'); // require the base controller
		}else{
			$_app->view($_route[1][0]);
		}
	}
}else{
	if( file_exists( __DIR__ . '/helpers/error.php' ) ){
		$error_name = $_route[1];
		include __DIR__ . '/helpers/error.php';
		exit;
	}else{
		header('HTTP/1.1 404 Not Found');
		die($_route[1]);
	}
}




