<?php namespace App\Models;

class Model{

	public function __construct(){
		
	}
}

foreach(glob(__DIR__ . '/../models'.'/*.php') as $file) {

	require_once($file);

}