<?php

namespace OnlineStore\Middleware;

/*
Middlewares are an extra layer like an onion around the core application, every request and responds must travel trough all the middlewares. 
Every Middleware also requires a parameter for the next middleware.
*/
class Middleware
{
	protected $container;

	public function __construct($container)
	{
		$this->container = $container;
	}
}