<?php

use OnlineStore\Middleware\AuthMiddleware;
use OnlineStore\Middleware\GuestMiddleware;

$app->get('/', 'HomeController:index')->setName('home');

$app->group('', function() {
	$this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
	$this->post('/auth/signup', 'AuthController:postSignUp');

	$this->get('/auth/login', 'AuthController:getLogin')->setName('auth.login');
	$this->post('/auth/login', 'AuthController:postLogin');
})->add(new GuestMiddleware($container));
	

$app->group('', function() {
	$this->get('/auth/logout', 'AuthController:getLogout')->setName('auth.logout');

	$this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
	$this->post('/auth/password/change', 'PasswordController:postChangePassword');

})->add(new AuthMiddleware($container));


