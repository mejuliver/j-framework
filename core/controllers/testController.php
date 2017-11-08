<?php

namespace App\Controllers;

use App\Controllers\Controller as controller;
use App\Models\testModel as model;


class testController extends controller{
	public function __constructor(){

	}

	public function index(){

		$test2 = 'test';

		$this->view('index',[ 'test' => $test2 ]);
	}
}

