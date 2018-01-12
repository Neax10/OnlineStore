<?php

namespace OnlineStore\Product;

use OnlineStore\Models\Article;

class Product 
{
	//Returns all Articles from the Database
	public function products()
	{
		return $products = Article::all();
	}

}