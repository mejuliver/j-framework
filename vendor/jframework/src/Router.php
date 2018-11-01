<?php namespace jframework;

use jframework/Framework as framework

class Router extends framework{
	public function __construct(){

	}

	public function get($e){
		// store all requests unto the global array
		global $jframework_routes;

		foreach( $_GET as $g ){
			
		}
	}

	public function post($e){

	}

	public function put($e){

	}

	public function delete($e){

	}

	public function head($e){

	}

	public function options($e){

	}

}