<?php
	namespace App\Http;

	use App as app;

	if(!defined('pixzel')) :
		die('You have no candy, get off my lawn!');
	endif;

	$app = new app\core();

	// process the request
	$request = trim($_SERVER['REQUEST_URI'], '/');

	if($request==='') {
		if(file_exists($app->theme_dir.'/app/index.php')!=1 ){
			header('HTTP/1.1 404 Not Found');
		    echo 'Ghost page? seems like this page does not exist';
		    exit;
		}

		
	}

	//check if route exist
	$http = 0;
	$http_portal = '';
	$controller = false;

	foreach($routes_array as $key => $value){
		if($request === $value['name']){
			$http = 1;
			$http_portal = $value['render'];
			$controller = $value['controller'];
			break;
		}
	}

	if($http===1){
		if(!$controller){
			if($app->view($http_portal) === 0){
				echo 'Page does not exist';
				exit;
			}
		}else{
			$controller_class = explode('@', $controller);
			if(file_exists($app->theme_dir.'/engine/controllers/'.$controller_class[0].'.php')==1){
				require $app->theme_dir.'/engine/controllers/'.$controller_class[0].'.php';
				$controller_init = 'App\Controllers\\'.$controller_class[0];
				$controller_instance = new $controller_init();
				$controller_class_init = $controller_class[1];
				return $controller_instance->$controller_class_init();
			}else{
				echo 'Undefined controller';
				exit;
			}
		}
		
	}else{
		header('HTTP/1.1 404 Not Found');
		echo 'Page does not exist';
		exit;
	}


