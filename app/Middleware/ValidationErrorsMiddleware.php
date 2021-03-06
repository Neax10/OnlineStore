<?php

namespace OnlineStore\Middleware;

//Middleware that adds all errors from Validation to a global variable 'errors'
class ValidationErrorsMiddleware extends Middleware {
	public function __invoke($request, $response, $next)
	{
		if (!empty($_SESSION['errors'])) {
			$this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
		}

		unset($_SESSION['errors']);

		$response = $next($request, $response);

		return $response;
	}
}