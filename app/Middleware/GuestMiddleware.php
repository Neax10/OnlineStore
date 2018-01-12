<?php

namespace OnlineStore\Middleware;

//This checks if the user has a session. If they have a session they are redirect to home. So that the user can't login again.
class GuestMiddleware extends Middleware {
	public function __invoke($request, $response, $next)
	{
		if ($this->container->auth->check()) {
			return $response->withRedirect($this->container->router->pathFor('home'));
		}

		$response = $next($request, $response);
		return $response;
	}
}