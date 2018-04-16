<?php 

	namespace App;


	class inputStorage{

		function __construct(){

			// store all request
			$requests = $_REQUEST;
			
			$input = [];

			foreach($requests as $key => $value ){

				$input[$key] = $value;

			}

			unset($_POST);
			unset($_GET);
			unset($_REQUEST);
		}


	}
