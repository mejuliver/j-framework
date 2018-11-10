<?php namespace jframework;

class Framework{
	public function __construct(){
		
	}
	// ------------ THE FIRST METHOD TO BE CALLED
	public function init(){

		// set url history
		$this->url_history();
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
				foreach($data as $key => $http_rawue ){
					$$key = $http_rawue;
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

				$get_arr = [];

				$req = explode( '&',parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY) );

				foreach( $req as $q ){
					$http_raw = explode('=',$q);

					$get_arr[$http_raw[0]] = $http_raw[1];
				}

				return $get_arr[$request];

			}elseif( strtolower($type) == 'post' ){

				return $_POST[$request];

			}elseif( strtolower($type) == 'file'){

				return $_FILE[$request];
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
	public function session_set($name,$http_raw){
		$_SESSION[$name] = $http_raw;
		return true;
	}
	public function session_get($name){

		return isset( $_SESSION[$name] ) ? $_SESSION[$name] : false;
	}
	public function session_delete($name){
		if( isset( $_SESSION[$name] ) )
		unset($_SESSION[$name]);
		return true;
	}

	public function session_destroy_all(){
		session_destroy(); 
		return;
	}
	public function session_delete_all(){
		session_unset(); 
		return true;
	}
	public function prev_url($count=false){
		
		if( !$this->session_get('prev_urls') ){
			return '';
		}else{
			if(!$count){
				return isset( $this->session_get('prev_urls')[1] ) ? $this->session_get('prev_urls')[1] : '';
			}else{
				return ( $count == 0 ) ? $this->session_get('prev_urls')[0] : $this->session_get('prev_urls')[$count-1];
			}
		}
		
	}
	public function url_history(){

		// $this->session_set('prev_urls',)

		$http_raw = $this->checkHttp()[0].'/'.$this->checkHttp()[1];

		if( !$this->session_get('prev_urls') ){
			
			$this->session_set('prev_urls',[$http_raw]);

		}else{
			
			if( count( $this->session_get('prev_urls') ) > 50 ){

				$url_sessions = $this->session_get('prev_urls');

				$new_arr_sessions = array_values(array_splice($url_sessions, 0, (count($url_sessions)-5) ));

				$this->session_set('prev_urls',$new_arr_sessions);


			}else{
				
				if ( count( $this->session_get('prev_urls') ) > 0 ){
					
					$tmp_sessions = $this->session_get('prev_urls');

					array_unshift($tmp_sessions, 'saedx');
					
					$this->session_set('prev_urls',$tmp_sessions);

				}else{

					$this->session_set('prev_urls',[$http_raw]);

				}
				
			}

		}

		return;
	}

}