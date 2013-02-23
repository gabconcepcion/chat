<?php

require '_lib/Slim/Slim.php';
require '_lib/class.Config.php';
require '_lib/class.Core.php';
require '_lib/class.AutoLoader.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->config(
	array(
		'templates.path' => './Views/'
	)
);
$controller = $app->request()->getPathInfo();

require 'Routers/IndexController.php';

$app->run();
