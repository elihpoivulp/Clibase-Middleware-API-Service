<?php

trait ValidationMethods
{
	protected $fv;

	public function validate_name($string)
	{
		$name = trim($string);
		$msg = '';
		if (!$name) {
			$msg = 'First Name is missing.';
		} else if ($this->has_length_less_than($name, 2)) {
			$msg = 'First Name must have at least 2 characters.';
		} else if ($this->has_length_greater_than($name, 60)) {
			$msg = 'First Name can\'t cannot exceed 60 characters in length.';
		}
		if ($msg) {
			$this->fv->set_message(__FUNCTION__, $msg);
			return false;
		}
		return true;
	}

	public function validate_contact_number($string)
	{
		$contact = trim($string);
		$msg = '';
		if (!$contact) {
			$msg = 'Contact Number is missing.';
		} else if ($this->has_length_less_than($contact, 11)) {
			$msg = 'Contact Number can\'t have less than 11 characters.';
		} else if ($this->has_length_greater_than($contact, 11)) {
			$msg = 'Contact Number can\'t exceed 11 characters in length.';
		} else if (!preg_match('/^\d{11}$/', $contact)) {
			$msg = 'Contact Number must be a valid number.';
		}
		if ($msg) {
			$this->fv->set_message(__FUNCTION__, $msg);
			return false;
		}
		return true;
	}

	public function validate_email($string)
	{
		$email = trim($string);
		$msg = '';
		if (!$email) {
			$msg = 'Email is missing.';
		} else if ($this->has_length_less_than($email, 4)) {
			$msg = 'Email can\'t have less than 4 characters.';
		} else if ($this->has_length_greater_than($email, 75)) {
			$msg = 'Email can\'t exceed 75 characters in length.';
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg = 'Email must be a valid email.';
		}
		if ($msg) {
			$this->fv->set_message(__FUNCTION__, $msg);
			return false;
		}
		return true;
	}

	public function validate_amount($string)
	{
		$amount = trim($string);
		$msg = '';
		if (!$amount) {
			$msg = 'Amount is missing.';
		} else if (!preg_match('/^\d+(.\d{2})?$/', $amount)) {
			$msg = 'Amount must be a valid money format.';
		}
		if ($msg) {
			$this->fv->set_message(__FUNCTION__, $msg);
			return false;
		}
		return true;
	}

	public function validate_currency($string)
	{
		// TODO: Only validate currency if called via API
//		$currency = trim($string);
//		$msg = '';
//		if (!$currency) {
//			$msg = 'Currency is missing.';
//		} else if (!in_array($currency, ['usd', 'php'])) {
//			$msg = 'Currency must be either \'php\' or \'usd\'';
//		}
//		if ($msg) {
//			$this->fv->set_message(__FUNCTION__, $msg);
//			return false;
//		}
//		return true;
		return true;
	}

	protected function has_length_less_than($string, $min)
	{
		return strlen($string) < $min;
	}

	protected function has_length_greater_than($string, $max)
	{
		return strlen($string) > $max;
	}

}
