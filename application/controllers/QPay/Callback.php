<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once BASEPATH . '../vendor/autoload.php';

use chriskacerguis\RestServer\RestController;

require 'ValidationMethods.php';

class Callback extends RestController
{

	use SanityCheck;

	private $qpay_api_base_url = 'https://api-test.qpay.ph';
	private $qpay_secret = 'a764ab66d38444f46e625565854fd197';
	private $qpay_token_bearer = 'b3ajrfPkMXdtwpNu';
	private $model;

	const INVALID_PARAMS = 'Invalid parameters';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Qpay_Transaction', 'transaction');
		$this->load->library('form_validation');
		$this->fv =& $this->form_validation;
	}

	public function order_post()
	{
		$data = $this->input->post(null, true);

		$this->form_validation->set_data($data);

		if (!$this->form_validation->run('generate_order_rules')) {
			$this->response(array(
				'status' => 'error',
				'reason' => $this::INVALID_PARAMS,
				'message' => str_replace(['<p>', '</p>'], '', validation_errors())
			), RestController::HTTP_OK);
		} else {
			if ($this->transaction->init($data)->save()) {
				$data['merchant_order_no'] = $this->transaction->get_customer_id() . '00';
				$data['customer_name'] = $data['customer_first_name'];
				$data['currency'] = strtoupper($data['currency']);
				$data['description'] = 'QPay Test';
				unset($data['customer_first_name']);
				$data['digest'] = $this->generate_digest($data, $this->qpay_secret);

				$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_URL => "$this->qpay_api_base_url/order",
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => $data,
					CURLOPT_HTTPHEADER => array(
						"Authorization: Bearer $this->qpay_token_bearer"
					),
				));

				$response = curl_exec($curl);
				curl_close($curl);
				return $response;
			}
//			$this->response(array(
//				'status' => 'success',
//				'reason' => $this::INVALID_PARAMS,
//				'message' => 'nice'
//			), RestController::HTTP_OK);
		}
	}

	private function generate_digest($params, $secret_key)
	{
		ksort($params);
		$data_string = '';
		foreach ($params as $key => $value) {
			$data_string .= $value . '|';
		}
		return sha1($data_string . $secret_key);
	}
}
