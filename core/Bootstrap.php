<?php

namespace App;

require_once('j_framework.php');
require_once('Model.php');
require_once('Controller.php');


use App\j_framework as framework;

$app = new framework;

//register the routes
include __DIR__ . '/../routes.php';

$init = $app->init();

if( $init['type'] === 'error' ){
	$error_name = $init['error'];
	if( file_exists( __DIR__ . '/../app/helpers/error.php' ) ){
		include __DIR__ . '/../app/helpers/error.php';
		exit;
	}else{
		header('HTTP/1.1 404 Not Found');
		die($init['error']);
	}
}else{

	if( $init['controller'] ){
		$controller = explode( '@', $init['controller'] );

		include __DIR__ . '/controllers/'.$controller[1].'.php';

		$class = 'App\Controllers\\'.$controller[1];
		$controller_instance = new $class();
		$controller_class_init = $controller[0];
		
		$controller_instance->$controller_class_init();

	}else{

		$app->view( $init['portal'] );
	}

}



