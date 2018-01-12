<?php

namespace OnlineStore\Middleware;

/*
Middleware that generates to hidden fields, ready to be inserted into post forms that protects from CSRF.
https://de.wikipedia.org/wiki/Cross-Site-Request-Forgery
*/

class CsrfViewMiddleware extends Middleware {
	public function __invoke($request, $response, $next)
	{
		$this->container->view->getEnvironment()->addGlobal('csrf', [
			'field' => '
				<input type="hidden" name="' . $this->container->csrf->getTokenNameKey() . '" value="' . $this->container->csrf->getTokenName() . '">
				<input type="hidden" name="' . $this->container->csrf->getTokenValueKey() . '" value="' . $this->container->csrf->getTokenValue() . '">
			',
		]);

		$response = $next($request, $response);
		return $response;
	}
}