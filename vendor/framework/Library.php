<?php namespace App\Library;


class Library{

	function __construct(){

	}

	public function load($lib){

		if( file_exists( __DIR__ . '/../library/'.$lib.'/autoload.php' ) ){
			include __DIR__ . '/../library/'.$lib.'/autoload.php';
		}else{
			var_dump('Library '.$lib.' not found');

			exit;
		}

	}

}
