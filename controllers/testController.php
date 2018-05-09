<?php

namespace App\Controllers;

use App\Controllers\Controller as controller;
use App\Models\testModel as model;


class testController extends controller{
	function __construct(){

	}

	public function index(){

		$this->view('index');
	}
}


