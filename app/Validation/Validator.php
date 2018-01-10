<?php

namespace OnlineStore\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
	public function validate($request, array $rules)
	{
		foreach ($rules as $field => $rule) {
			try {
				$rule->setName(ucfirst($field))->assert($request->getParam($field));
			} catch (NestedValidationException $e) {
				$this->errors[$field] = $e->getMessages();
			}
			
		}

		if(isset($this->errors)) {
			$_SESSION['errors'] = $this->errors;
		}

		return $this;
	}

	public function failed()
	{
		return !empty($this->errors);
	}
}