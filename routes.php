<?php

	define("public_url",$app->server('url').'/public/');

	$app->route('',false,'index2');
	$app->route('home','index@testController');


	