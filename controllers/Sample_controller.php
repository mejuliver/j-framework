<?php namespace App\Controllers;

use App\Models\Sample_model as my_model;

Class Sample_controller extends controller{

	public function index(){

	}

	public function sample(){


		$model = new My_model;

		$data['from_model'] = $model->test();


		$this->view('index',$data);
	}

	public function ajax(){
		header( 'Content-type: application/json' );

		echo json_encode([ $this->input_request('testinput','post') ]);

		return;
	}

}