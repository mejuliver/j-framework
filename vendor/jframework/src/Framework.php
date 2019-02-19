<?php namespace jframework;

require_once(__DIR__.'/Session.php'); // require the library

$session = new Session();

class Framework{
	public function __construct(){

		global $session;

		$session->Session();

	}
	// ------------ THE FIRST METHOD TO BE CALLED
	public function init(){

		return $this->route($this->checkHttp());
	}
	// ------------ CHECK CURRENT HTTP REQUEST
	private function checkHttp(){

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

		$app_url = ( $this->config('url',true) && trim($this->config('url',true)) != '' ) ? true : false; 

		$base_server = $server;
		
		$server = $base_server;


		$raw_request = parse_url(trim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH);

		if( $app_url ){
			$server = $this->config('url',true);
			$trim_server = ltrim(str_replace($base_server, '',$server),'/');
			$raw_request = ltrim(str_replace($trim_server,'',parse_url(trim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH)),'/');
		}

		return [ $server, $raw_request ];

	}
	// ------------ BUILD THE ROUTES
	public function route($_http){

		global $route;

		if( $_http[1] == '' || $_http[1] == '/' ){

			$_route = 'index';

		}else{
			$_route = ( isset($route[$_http[1]]) ) ? $route[$_http[1]] : false;
		}

		if( !$_route ){
			return [false,$this->error(6)];
		}else{
			return [true,$_route];
		}

	}

	// ------------ WILL GIVE THE REQUESTED CONFIG NAME FROM THE CONFIG.PHP
	public function config($name,$internal = false){

		global $app;

		$error = ( isset($app[$name]) ) ? false : true;

		if( !$error ){
			return $app[$name];
		}else{
			if( !$internal ){
				return $this->error(5);
			}else{
				return false;
			}
		}
		

	}

	// ------------ ERROR BAG MODULE
	private function error($e=false){

		$error =  [
			0 => 'Please define your routes in routes.php',
		 	1 => 'Template not found',
		 	2 => 'Undefined controller',
		 	3 => 'Page does not exist',
		 	4 => 'Ops! each route must be unique, you cannot declare same route at the same time',
		 	5 => 'Config name not found!',
		 	6 => 'Route not found',
		];

		if( $this->config('error_bag',true) && is_array( $this->config('error_bag',true) ) ){
			$error = $this->config('error_bag',true);
		}

		if($e){
			return $error[$e];
		}

		return $error;


	}

	// ------------ THE TEMPLATE MODULE
	public function view($page,$data=false){

		$file = __DIR__ . '/../../../templates/'.$page.'.php';

		if(file_exists($file)){

			if($data){
				foreach($data as $key => $value ){
					$$key = $value;
				}
			}

			include_once($file);

			exit;

		}else{
			if( file_exists( __DIR__ . '/helpers/error.php' ) ){
				$error_name = $this->error(1);
				include __DIR__ . '/helpers/error.php';
				exit;
			}else{
				header('HTTP/1.1 404 Not Found');
				die($this->error(1));
			}
		}

	}

	// ------------ THE INPUT STORAGE
	public function input_request($request=false,$type='get',$sanitize=true){

		if( $request ){
			if( $sanitize ){
				// prevent XSS
				$_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
				$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			}

			if( strtolower($type) == 'get' ){

				if( isset( $_GET[$request] ) ){
					return $_GET[$request];
				}
				$get_arr = [];

				$req = explode( '&',parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY) );

				foreach( $req as $q ){
					$http_raw = explode('=',$q);

					if( isset($http_raw[1]) ){
						$get_arr[$http_raw[0]] = $http_raw[1];
					}else{
						$get_arr[$http_raw[0]] = '';
					}

				}

				$data = isset( $get_arr[$request] ) ? $get_arr[$request] : false;

				if( !$data ){ // do the 2nd filtering
					$url = $_SERVER['REQUEST_URI'];
					if( isset(parse_url($url)['query'] ) ){
						parse_str(parse_url($url)['query'], $params);

						return $params[$request];
					}

				}else{
					return $data;
				}

			}elseif( strtolower($type) == 'post' ){

				return isset( $_POST[$request] ) ? $_POST[$request] : false;

			}elseif( strtolower($type) == 'file'){

				return isset( $_FILE[$request] ) ? $_FILE[$request] : false;
			}

		}

		
		return false;
		
	}

	// ------------ GIVES ABSOLUTE THEME PATH
	public function theme_path(){
		return str_replace('\\', '/', getcwd());
	}

	// ------------ GIVES THE APP PATH
	public function app_path(){

		return __DIR__.'/../../../';

	}
	//redirect helper
	public function redirect($url, $permanent = false){
		
	    header('Location: ' . $url, true, $permanent ? 301 : 302);

	    exit();
	}
	//session helper
	public function session_set($n,$v){
		// $_SESSION[$name] = $http_raw;
		// return true;

		global $session;

		$session->set_userdata($n,$v);

		return true;
	}
	public function session_get($n){

		// return isset( $_SESSION[$name] ) ? $_SESSION[$name] : false;
		global $session;
		return $session->userdata($n);
	}

	public function session_flash($k,$v){
		global $session;

		$session->set_flashdata($k, $v);
	}

	public function session_keep_flash($k){
		global $session;
		$sesion->keep_flashdata($k);
	}

	public function session_get_flash($k){
		global $session;
		return $session->flashdata($k);
	}

	public function session_all(){
		global $session;
		return $session->all_userdata();
	}
	public function session_delete($n){
		// if( isset( $_SESSION[$name] ) )
		// unset($_SESSION[$name]);
		// return true;

		global $session;

		$session->unset_userdata($n);

		return true;
	}

	public function session_destroy_all(){
		// session_destroy(); 
		// return;
		global $session;

		$session->destroy();

		return true;
	}
	public function session_delete_all(){
		session_unset(); 
		return true;
	}


}