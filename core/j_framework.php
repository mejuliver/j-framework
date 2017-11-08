<?php

namespace App;

$routes_array = [];

class j_framework{
	public $url;
	public $theme_dir;
	public $http_request;
	
	function __construct(){
		$this->url = $this->server();
		$this->theme_dir = $this->server('theme_dir');
		$this->http_request = trim($_SERVER['REQUEST_URI'], '/');
	}

	public function init(){

		$init = $this->checkHttp();


		if($init['type'] === 'error'){

			return [ 'type' => 'error', 'error' => $this->error($init['error']) ];

		}

		return $init;

	}
	public function server($type='url'){
		$server_name = $_SERVER['SERVER_NAME'];
		if (!in_array($_SERVER['SERVER_PORT'], [80, 443])) {

		$port = ":$_SERVER[SERVER_PORT]";
		} else {
		$port = '';
		}

		if (!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) {
		$scheme = 'https';
		} else {
		$scheme = 'http';
		}
		$server = $scheme.'://'.$server_name.$port;
 
		$theme_path = str_replace('\\', '/', getcwd());

		if($type==='url'){
			return $server;
		}else{
			return $theme_path;
		}
	}

	private function error($e=false){
		$error =  [
					'0' => 'Please define your routes in routes.php',
				 	'1' => 'Page does not exist',
				 	'2' => 'Undefined controller',
				 	'3' => 'Page does not exist',
				 	'4' => 'Ops! each route must be unique, you cannot declare same route at the same time'
				 ];

		if($e){
			return $error[$e];
		}

		return $error;


	}

	public function view($page,$data=false){
		if(file_exists(__DIR__ . '/../app/'.$page.'.php')){

			if($data){
				foreach($data as $key => $value ){
					$$key = $value;
				}
			}
			include __DIR__ . '/../app/'.$page.'.php';

			exit;
		}else{
			return [ 'type'  => 'error', 'error' => 1 ];
		}

	}

	public function route($e,$f=false,$g=false){
		global $routes_array;
		$route_exist = false;
		//check if routes already exist
		foreach($routes_array as $key => $value){
			if($value['name'] === $e){
				$route_exist = true;
			}
			break;
		}

		if($route_exist){
			return [ 'type'  => 'error', 'error' => 4 ];
		}

		$routes_array[] = [ 'name' => $e, 'controller' => $f, 'render' => $g ];
	}

	private function checkRoutes(){
		$request = $this->http_request;
		$http = 0;
		$http_portal = false;
		$controller = false;

		global $routes_array;

		foreach($routes_array as $key => $value){
			if($request === $value['name']){
				$http = 1;
				$http_portal = $value['render'];
				$controller = $value['controller'];
				break;
			}
		}

		return [ 'http' => $http, 'http_portal' => $http_portal, 'controller' => $controller ];

	}

	private function checkHttp(){
		global $routes_array;
		// request variable
		$request = $this->http_request;
		$http_init = $this->checkRoutes($request);
		// http variable
		$http = $http_init['http'];
		$http_portal = $http_init['http_portal'];
		$controller = $http_init['controller'];
		// check if routes array is empty then throw an error
		if( count($routes_array) === 0 ){
			return [ 'type'  => 'error', 'error' => 0 ];
		}
		//check if route exist
		if($http===1){
			if(!$controller){
				if(file_exists(__DIR__ . '/../app/'.$http_portal.'.php')){
					return [ 'type'  => 'app', 'controller' => $controller, 'portal' => $http_portal ];
				}

				return [ 'type'  => 'error', 'error' => 1 ];

			}else{
				$controller_class = explode('@', $controller);
				if(file_exists(__DIR__ . '/controllers/'.$controller_class[1].'.php')){

					return [ 'type'  => 'app', 'controller' => $controller ];

				}else{
					return [ 'type'  => 'error', 'error' => 2 ]; 
				}
			}
			
		}else{
			return [ 'type'  => 'error', 'error' => 3 ];
		}
	}

	private function m_array($e,$f,$g = false){
	    foreach ($f as $item) {
	        if (($g ? $item === $e : $item == $e) || (is_array($item) && $this->m_array($e, $item, $g))) {
	            return true;
	        }
	    }

	    return false;
	}

}