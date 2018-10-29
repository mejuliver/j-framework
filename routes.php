<?php

	// $route['sample-model'] = [false,'sample_controller@sample_model',false];
	// $route['sample-form'] = [false,'sample_controller@sample_form',false];
	// $route['sample-form/input'] = [false,'sample_controller@sample_form_input',false];
	// $route['sample-form/ajax'] = [false,'sample_controller@sample_form_ajax',false];
	// $route['sample-form/input/ajax'] = [false,'sample_controller@ajax',false];

	$router->get('profile/:name','Sample_controller');
	$router->get('profile/:name','Sample_controller@details',['Sample_model1']);
	$router->post('profile/save','Sample_controller@save',['Sample_model1','Sample_model2']);