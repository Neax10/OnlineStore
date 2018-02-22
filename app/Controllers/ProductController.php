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


		if ($product && $request->getParam('amount') > 0) {
			$cookie = $product['id'] . "." . $request->getParam('amount');
			setcookie("sc" . $product['id'], $cookie, time() + (86400 * 30), "/");
		}

		return $response->withRedirect($this->router->pathFor('product', [
			'id' => $product['id'],
			'name' => $product['name']
		]));

	}

	public function getShoppingcart($request, $response)
	{
		$product = array();
		$totalprice = 0;

		if (isset($_COOKIE)) {
			foreach ($_COOKIE as $key => $value) {
				if (preg_match("/^$key*/", "sc")) {
					$data = explode(".", $value);
					$article = Article::find($data[0]);
					$amount = $data[1];

					$totalprice += ($article['price'] * $amount);

					$product[] = array("article" => $article, "amount" => $amount);
				}
			}
		}

		return $this->view->render($response, 'templates/shoppingcart.twig', [
			'products' => $product,
			'total' => $totalprice
		]);
	}
}

