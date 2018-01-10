<?php

use Respect\Validation\Validator as v;

session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
	'settings' => [
		'displayErrorDetails' => true,
		'db' => [
			'driver' => 'mysql',
			'host' => '127.0.0.1',
			'database' => 'onlinestore',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8mb4',
			'coallition' => 'utf8mb4_general_ci',
			'prefix' => '',
		]
	],
]); 

$container = $app->getContainer();

//Eloquent for Database connection
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
	return $capsule;
};

$container['auth'] = function ($container) {
	return new \OnlineStore\Auth\Auth;
};

$container['view'] = function($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../ressources/views', [
		'cache' => false,
	]);


	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));

	$view->getEnvironment()->addGlobal('auth', [
		'check' => $container->auth->check(),
		'user' => $container->auth->user(),
	]);

	return $view;
};

$container['validator'] = function($container) {
	return new \OnlineStore\Validation\Validator;
};

$container['HomeController'] = function($container) {
	return new \OnlineStore\Controllers\HomeController($container);
};

$container['AuthController'] = function($container) {
	return new \OnlineStore\Controllers\Auth\AuthController($container);
};

$container['PasswordController'] = function($container) {
	return new \OnlineStore\Controllers\Auth\PasswordController($container);
};

$container['csrf'] = function ($container) {
	return new \Slim\Csrf\Guard;
};



$app->add(new \OnlineStore\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \OnlineStore\Middleware\OldInputMiddleware($container));
$app->add(new \OnlineStore\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);

v::with('OnlineStore\\Validation\\Rules\\');

require __DIR__ . '/../app/routes.php';