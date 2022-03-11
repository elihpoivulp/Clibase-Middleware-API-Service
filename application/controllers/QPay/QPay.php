<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'SanityCheck.php';

class QPay extends CI_Controller {

	use SanityCheck;

	private $service_api_base_url = 'service/qpay/api';

	public function __construct()
	{
		parent::__construct();
		$this->fv =& $this->form_validation;
	}

	public function index()
	{
		$has_error = false;
		if ($this->input->post()) {
			$this->load->library('form_validation');

			if ($this->form_validation->run('generate_order_rules')) {
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => base_url("$this->service_api_base_url/order"),
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => $this->input->post(null, true),
				));
				$response = curl_exec($curl);
				$response = json_decode($response);
				curl_close($curl);
				redirect($response->results->data->url, 'refresh');
			} else {
				$has_error = true;
			}
		}
		$this->load->view('qpay/topup', array(
			'has_error' => $has_error
		));
	}
}
