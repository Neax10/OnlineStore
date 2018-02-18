<?php

namespace OnlineStore\Controllers;

use OnlineStore\Models\Article;
use OnlineStore\Controllers\Controller;

class ProductController extends Controller
{
	public function getProduct($request, $response, $product)
	{
		$product = Article::find($product['id']);

		if(!$product) {
			return $response->withRedirect($this->router->pathFor('home'));
		}

		return $this->view->render($response, 'templates/partials/product.twig', [
			'product' => $product
		]);
	}

	public function postProduct($request, $response, $product)
	{
		$product = Article::find($product['id']);

		if ($product) {
			$cookie = $product['id'] . " " . 1 . ".";
			setcookie("shoppingcart", $cookie, time() + (86400 * 30), "/");
		}

		return $response->withRedirect($this->router->pathFor('product', [
			'id' => $product['id'],
			'name' => $product['name']
		]));

	}

	public function getShoppingcart($request, $response)
	{
		return $this->view->render($response, 'templates/shoppingcart.twig');
	}
}

