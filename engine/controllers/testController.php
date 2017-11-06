<?php

	
	namespace engine\http\controllers;

	use engine as core;

	class testController extends core\core{

		public function __construct(){

			
		}

		public function index(){
			$model = $this->model('testModel');
		 	$this->view('index',$model) ;
		}

	}
