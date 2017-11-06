<?php
	namespace App\Http\Routes;
	use App as app;

	if(!defined('pixzel')) :
		die('You have no candy, get off my lawn!');
	endif;

	$app = new app\Core();

	include $app->theme_dir.'/routes.php';