<?php

namespace OnlineStore\Middleware;

//Middleware to save the old inputs in forms.
class OldInputMiddleware extends Middleware {
	public function __invoke($request, $response, $next)
	{
		if (!empty($_SESSION['old'])) {
			$this->container->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
		}
		$_SESSION['old'] = $request->getParams();

		$response = $next($request, $response);

		return $response;
	}
}