<?php

namespace OnlineStore\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $table = 'article';

	protected $fillable = [
		'name',
		'description',
		'category',
		'picture',
		'price'
	];
	
}