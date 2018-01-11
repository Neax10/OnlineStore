<?php

namespace OnlineStore\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'user';

	protected $fillable = [
		'firstname',
		'lastname',
		'email',
		'birthday',
		'street',
		'postcode',
		'state',
		'country',
		'state',
		'username',
		'password',
		'created_at',
		'update_at'
	];

	public function setPassword($password)
	{
		$this->update([
			'password' => password_hash($password, PASSWORD_DEFAULT, ['cost' => 14])
		]);
	}
}