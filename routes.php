<?php

	$route['home'] = ['index',false,false]; // without the use of the controller
	$route['profile'] = [false,'Profile_controller',false]; // with the use of the controller
	$route['test'] = [ false, 'Test_controller'];
	$route['test2/home/test'] = [ false, 'Test_controller@test'];

