<?php namespace jframework\Controllers;

use jframework\Models\Sample_model as my_model;
use \Respect\Validation\Validator as v;	

Class Sample_controller extends controller{

	public function index(){
		
	}

	public function sample_model(){

		$model = new My_model;

		$data['from_model'] = $model->test();

		$data['sample'] = 'Sample data';

		$this->view('sample_model',$data);
	}

	public function sample_form(){

		$this->view('sample-form');
	}

	public function sample_form_input(){

		$data['input_name'] = $this->input_request('name','post');

		$this->view('sample-form',$data);
	}

	public function sample_form_ajax(){

		$data['input_name'] = $this->input_request('name','post');

		$this->view('sample-form-ajax',$data);
	}

	public function ajax(){
		header( 'Content-type: application/json' );

		echo json_encode([ $this->input_request('name','post') ]);

		return;
	}

}