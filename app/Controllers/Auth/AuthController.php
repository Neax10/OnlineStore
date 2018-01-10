<?php

namespace OnlineStore\Controllers\Auth;

use OnlineStore\Models\User;
use OnlineStore\Controllers\Controller;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{
	public function getLogout($request, $response)
	{
		$this->auth->logout();

		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function getLogin($request, $response)
	{
		return $this->view->render($response, 'auth/login.twig');
	}

	public function postLogin($request, $response)
	{
		$auth = $this->auth->attempt(
			$request->getParam('username'),
			$request->getParam('password')
		);

		if (!$auth) {
			return $response->withRedirect($this->router->pathFor('auth.login'));
		}

		return $response->withRedirect($this->router->pathFor('home'));

	}

	public function getSignUp($request, $response)
	{
		return $this->view->render($response, 'auth/signup.twig');
	}

	public function postSignUp($request, $response)
	{
		$validation = $this->validator->validate($request, [
			'email' => v::noWhiteSpace()->notEmpty()->email()->EmailAvailable(),
			'username' => v::noWhiteSpace()->notEmpty()->alpha()->length(4,20),
			'password' => v::noWhiteSpace()->notEmpty()->length(8,72),
		]);

		if($validation->failed()){
			return $response->withRedirect($this->router->pathFor('auth.signup'));
		}

		$user = User::create([
			'username' => $request->getParam('username'),
			'email' => $request->getParam('email'),
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT, ['cost' => 14]),
		]);

		$this->auth->attempt($user->username, $request->getParam('password'));

		return $response->withRedirect($this->router->pathFor('home'));
	}
}

