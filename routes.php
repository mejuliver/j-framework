<?php
	
	// Defines for app use
	define( 'url', $app->url );
	define( 'theme_dir', $app->url.'/' );
	define( 'components_dir', $app->url.'/public/');
	define( 'plugins_dir', $app->url.'/public/plugins/');
	define( 'css_dir', $app->url.'/public/css/');
	define( 'js_dir', $app->url.'/public/js/');
	define( 'media_dir', $app->url.'/public/media/');

	// -------------------------------------------------------------
	//defined routes here
	$app->route('','index','testController@index');
	$app->route('home','index','testController@index');


	// -------------------------------------------------------------

