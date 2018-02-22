<?php

namespace OnlineStore\Auth;

use OnlineStore\Models\User;

class Auth 
{

	//Login attempt
	public function attempt($email, $password)
	{
		//Grab first result by username
		$user = User::where('email', $email)->first();

		if(!$user) {
			return false;
		}

		//Compares the password from the Database with the Input
		if(password_verify($password, $user->password)) {
			$_SESSION['user'] = $user->email;
			return true;
		}

		return false;
	}

	//Returns the current session of the user
	public function user()
	{
		return isset($_SESSION['user']) ? User::find($_SESSION['user']) : null;
	}

	//Checks if there is a session for the current user
	public function check()
	{
		return isset($_SESSION['user']);
	}

	//Logs the user out
	public function logout()
	{
		unset($_SESSION['user']);
	}
}