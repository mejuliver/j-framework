<?php

namespace App\Database;

use App\j_framework as framework;

class Controller extends framework{

	public function __construct(){

	}

	public function connectDB(){

		require(__DIR__ . '/../config.php');

		$conn = new mysqli( $db['host'], $db['username'], $db['password'] );

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

	}


	public function query($query){
		
	}

}