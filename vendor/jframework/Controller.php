<?php namespace App\Controllers;

use App\framework as framework;

class Controller extends framework{

	public function __construct(){

	}

}

$_controller = explode( '@', $controller );

require_once(__DIR__ . '/../../controllers/'.ucfirst($_controller[0]).'.php');

if( count( $_controller ) == 2 ){

	$class = 'App\Controllers\\'.ucfirst($_controller[0]);
	$controller_instance = new $class();
	$controller_class_init = $_controller[1];

	$controller_instance->$controller_class_init();
}else{


	$class = 'App\Controllers\\'.ucfirst($_controller[0]);
	$controller_instance = new $class();
	$controller_class_init = 'index';

	$controller_instance->$controller_class_init();
}