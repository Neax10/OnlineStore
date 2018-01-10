<?php
namespace OnlineStore\Validation\Rules;

use OnlineStore\Models\User;
use Respect\Validation\Rules\AbstractRule;

class EmailAvailable extends AbstractRule
{
	public function validate($input)
	{
		return User::where('email', $input)->count() === 0;
	}
}