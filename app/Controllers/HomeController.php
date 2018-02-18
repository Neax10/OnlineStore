<?php

namespace OnlineStore\Controllers;
use Illuminate\Database\Eloquent\Model;
use OnlineStore\Models\Article;
use OnlineStore\Models\User;

class HomeController extends Controller
{
	public function index($request, $response)
	{
		$products = Article::all();

		return $this->view->render($response, 'home.twig', [
			'products' => $products
		]);
	}
}

