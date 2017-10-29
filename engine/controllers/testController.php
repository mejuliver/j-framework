<?php
	
	namespace engine\http\controllers;

	use engine as core;

	class testController extends core\core{

		public function __construct(){

			
		}

		public function index(){

		 	echo $this->server('theme_dir');
		}

	}

