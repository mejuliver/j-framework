<?php namespace jframework\Models;

use jframework\Framework as framework;

class Model extends framework{

	public function __construct(){
		
	}
}

if( $models ){
	if (is_array($models) or ($models instanceof Traversable)){
		foreach($models as $m){
			require_once( __DIR__ . '/../../../models/'.ucfirst($m).'.php');
		}
	}else{
		require_once( __DIR__ . '/../../../models/'.ucfirst($models).'.php');
	}
}else{
	foreach(glob(__DIR__ . '/../../../models'.'/*.php') as $file) {

		require_once($file);

	}
}