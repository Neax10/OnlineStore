<?php

namespace OnlineStore\Middleware;

//This Middleware checks if the user has a session, if not they are redirect to login else they can procced to the secured site.
class AuthMiddleware extends Middleware {
	public function __invoke($request, $response, $next)
	{
		if (!$this->container->auth->check()) {
			return $response->withRedirect($this->container->router->pathFor('auth.login'));
		}

		$response = $next($request, $response);
		return $response;
	}
}