<?php

namespace OnlineStore\Controllers;

class ProductController extends Controller
{
	public function getProduct($request, $response)
	{
		return $this->view->render($response, 'templates/partials/product.twig');
	}

	public function getShoppingcart($request, $response)
	{
		return $this->view->render($response, 'templates/shoppingcart.twig');
	}
}

