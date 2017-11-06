<?php
	
	namespace App;

	require_once('j_framework.php');
	require_once('Model.php');
	require_once('Controller.php');
	require_once('Http.php');

	use App\j_Framework as framework;
	use App\Models\Model as model;
	use App\Controllers\Controller as controller;
	use App\Http as http;

	$app = new framework;

	require_once($app->theme_dir.'/routes.php');





