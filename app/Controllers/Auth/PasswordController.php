<?php

namespace OnlineStore\Controllers\Auth;

use OnlineStore\Models\User;
use OnlineStore\Controllers\Controller;
use Respect\Validation\Validator as v;

class PasswordController extends Controller
{
	public function getChangePassword($request, $response)
	{
		return $this->view->render($response, 'auth/change.twig');
	}

	public function postChangePassword($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'password_old' => v::noWhitespace()->notEmpty()->MatchesPassword($this->auth->user()->password),
			'password_new' => v::noWhitespace()->notEmpty(),
		]);

		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('auth.password.change'));
		}

		$this->auth->user()->setPassword($request->getParam('password_new'));

		return $response->withRedirect($this->router->pathFor('home'));
	}
}

