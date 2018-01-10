<?php

namespace OnlineStore\Controllers;


use OnlineStore\Models\User;

class HomeController extends Controller
{
	public function index($request, $response)
	{
		return $this->view->render($response, 'home.twig');
	}
}

