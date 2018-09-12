<?php
	
	// ============ A P P  S E T T I N G S ============ 

	$app['url'] = 'http://localhost:8000';

	$app['title'] = 'Welcome';
	

	// ============ D A T A B A S E ============ 

	$app['db']['mysql'] = [

							'host' => '',
							'username' => '',
							'password' => '',
							'database' => '',
							'charset' => '',

						];

	// modify error messages
	$app['error_bag'] = [
							0 => 'Please define your routes in routes.php',
						 	1 => 'Template not found',
						 	2 => 'Undefined controller',
						 	3 => 'Page does not exist',
						 	4 => 'Ops! each route must be unique, you cannot declare same route at the same time',
						 	5 => 'Config name not found!',
						 	6 => 'Route not found',
						];