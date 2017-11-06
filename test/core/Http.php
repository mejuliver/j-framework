<?php

	namespace App;
	use App\j_framework as framework;
	$framework = new framework;
	require_once($framework->theme_dir.'/routes.php');

	class Http extends framework{

		public function __construct(){

		}

		public function checkRequest($request){
			if($request==='') {
				if(file_exists($this->theme_dir.'/app/index.php')!=1 ){
					return 0;
				}else{
					return 1;
				}
			}
		}

		public function checkRoutes($request,$routes_list){
			$http = 0;
			$http_portal = '';
			$controller = false;

			foreach($routes_list as $key => $value){
				if($request === $value['name']){
					$http = 1;
					$http_portal = $value['render'];
					$controller = $value['controller'];
					break;
				}
			}

			return [ 'http' => $http, 'http_portal' => $http_portal, 'controller' => $controller ];

		}

	}

	// process the request
	$request = trim($_SERVER['REQUEST_URI'], '/');

	$http = new Http();


	if( $http->checkRequest($request) === 0 ){
		header('HTTP/1.1 404 Not Found');
		echo 'Ghost page? seems like this page does not exist';
		exit;
	}

	//check if route exist
	$http = $http->checkRoutes($request,$routes_array)['http'];
	$http_portal = $http->checkRoutes($request,$routes_array)['http_portal'];
	$controller =  $http->checkRoutes($request,$routes_array)['controller'];
	

	
	// if($http===1){
	// 	if(!$controller){
	// 		if($app->view($http_portal) === 0){
	// 			echo 'Page does not exist';
	// 			exit;
	// 		}
	// 	}else{
	// 		$controller_class = explode('@', $controller);
	// 		if(file_exists($app->theme_dir.'/engine/controllers/'.$controller_class[0].'.php')==1){
	// 			require $app->theme_dir.'/engine/controllers/'.$controller_class[0].'.php';
	// 			$controller_init = 'App\Controllers\\'.$controller_class[0];
	// 			$controller_instance = new $controller_init();
	// 			$controller_class_init = $controller_class[1];
	// 			return $controller_instance->$controller_class_init();
	// 		}else{
	// 			echo 'Undefined controller';
	// 			exit;
	// 		}
	// 	}
		
	// }else{
	// 	header('HTTP/1.1 404 Not Found');
	// 	echo 'Page does not exist';
	// 	exit;
	// }


	
