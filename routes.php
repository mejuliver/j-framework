<?php
	

	var_dump($app->server('path'));
	$app->route('',false,'index');
	$app->route('home','index@testController');


	