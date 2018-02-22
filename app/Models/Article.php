<?php

namespace OnlineStore\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $table = 'article';

	protected $fillable = [
		'name',
		'description_short',
		'description_long',
		'category',
		'picture_thumb',
		'picture_large',
		'amount',
		'price',
		'created_at',
		'update_at',
		'path',
		'active'
	];
	
}