<?php

namespace OnlineStore\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'user';
	protected $primaryKey = 'email';

	protected $fillable = [
		'email',
		'password',
		'firstname',
		'lastname',
		'birthday',
		'phone',
		'billing_address_id',
		'delivery_address_id',
		'money',
		'created_at',
		'verified',
		'active'
	];

	public function setPassword($password)
	{
		$this->update([
			'password' => password_hash($password, PASSWORD_DEFAULT, ['cost' => 14])
		]);
	}
}