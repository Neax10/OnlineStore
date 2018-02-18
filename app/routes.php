<?php

use OnlineStore\Middleware\AuthMiddleware;
use OnlineStore\Middleware\GuestMiddleware;

/*
These are the routes of the Website, every route corresponds with a function in a Controller.
So every request gets redirected to a function that then most likley sends a Redirect or 
renders a view that gets rendered to the user.

Additionally there are Middlewares here that first check if the user has access to the site, the user get redirected accordingly.
*/
$app->get('/', 'HomeController:index')->setName('home');

$app->group('', function() {
	$this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
	$this->post('/auth/signup', 'AuthController:postSignUp');

	$this->get('/auth/login', 'AuthController:getLogin')->setName('auth.login');
	$this->post('/auth/login', 'AuthController:postLogin');
})->add(new GuestMiddleware($container));
	

$app->group('', function() {
	$this->get('/product/{id}/{name}', 'ProductController:getProduct')->setName('product');
	$this->post('/product/{id}/{name}', 'ProductController:postProduct');

	$this->get('/shoppingcart', 'ProductController:getShoppingcart')->setName('shoppingcart');

	$this->get('/auth/profile', 'AuthController:getProfile')->setName('auth.profile');

	$this->get('/auth/logout', 'AuthController:getLogout')->setName('auth.logout');

	$this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
	$this->post('/auth/password/change', 'PasswordController:postChangePassword');

})->add(new AuthMiddleware($container));


