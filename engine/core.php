<?php
	namespace engine;

	if(!defined('pixzel')) :
		die('You have no candy, get off my lawn!');
	endif;

	$routes_array = [];

	class core{
		public $url;
		public $theme_dir;
		function __construct(){
			$this->url = $this->server();
			$this->theme_dir = $this->server('theme_dir');
		}

		public function view($page,$data=null){
			if(file_exists('app/'.$page.'.php')==1){
				if($data!=null){
					foreach($data as $var){
						$$var = $var;
					}
				}
				include $this->theme_dir.'/app/'.$page.'.php';
			}else{
				return 0;
			}

		}

		private function model($model){
			if(file_exists('app/'.$page.'.php')!=1){

			}else{
				
			}
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
		function route($e,$d,$f=false){
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
				return "Ops! each route must be unique, you cannot declare same route at the same time";
			}

			$routes_array[] = [ 'name' => $e, 'render' => $d, 'controller' => $f ];
		}

	}


	$app = new core();

	require $app->theme_dir.'/engine/routes.php';
	require $app->theme_dir.'/engine/http.php';

	if(count($routes_array)===0){
		die('The engine could not start because you did not define any routes yet.');
	}
?>
