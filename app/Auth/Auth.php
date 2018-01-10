<?php

namespace OnlineStore\Auth;

use OnlineStore\Models\User;

class Auth 
{
	public function attempt($username, $password)
	{
		//grab by username

		$user = User::where('username', $username)->first();

		if(!$user) {
			return false;
		}

		if(password_verify($password, $user->password)) {
			$_SESSION['user'] = $user->id;
			return true;
		}

		return false;
	}

	public function user()
	{
		return isset($_SESSION['user']) ? User::find($_SESSION['user']) : null;
	}

	public function check()
	{
		return isset($_SESSION['user']);
	}

	public function logout()
	{
		unset($_SESSION['user']);
	}
}