<?php
	namespace engine\http\routes;
	use engine as app;

	if(!defined('pixzel')) :
		die('You have no candy, get off my lawn!');
	endif;

	$app = new app\core();

	include $app->theme_dir.'/routes.php';