<?php namespace jframework\Controllers;

Class Test_controller extends controller{

	public function index(){

		$this->session_flash('test','test');

		$this->view('test');
		
	}

	public function test(){
		var_dump($this->input_request('name','get'));
		// $this->view('test');

	}


}