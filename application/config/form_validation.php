<?php
$config = array(
	'generate_order_rules' => array (
		array (
			'field' => 'customer_first_name',
			'label' => 'First Name',
			'rules' => 'callback_validate_name'
		),
		array (
			'field' => 'customer_mobile_number',
			'label' => 'Contact Number',
			'rules' => 'callback_validate_contact_number'
		),
//		array (
//			'field' => 'currency',
//			'label' => 'Currency',
//			'rules' => 'callback_validate_currency'
//		),
		array (
			'field' => 'customer_email',
			'label' => 'Email',
			'rules' => 'callback_validate_email'
		),
		array (
			'field' => 'amount',
			'label' => 'Amount',
			'rules' => 'callback_validate_amount'
		),
	)
);
