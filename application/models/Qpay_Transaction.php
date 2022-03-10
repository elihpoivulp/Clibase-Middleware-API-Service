<?php
defined('BASEPATH') or exit('No direct script access allowed');

class QPay_Transaction extends CI_Model
{
	public $id = null;
	public $customer_first_name = null;
	public $customer_last_name = null;
	public $customer_email = null;
	public $customer_mobile_number = null;
	public $amount = null;
	public $currency = null;
	public $description = 'QPAY';
	public $remarks = null;
	public $date_created = null;

	protected $columns = array(
		'customer_first_name',
		'customer_last_name',
		'customer_email',
		'customer_mobile_number',
		'amount',
		'currency',
		'description',
		'remarks'
	);

	protected $table_name = 'qpay_transactions';

	public function __construct()
	{
		parent::__construct();
		$this->date_created = date('Y-m-d H:i:s');
	}

	public function init($data)
	{
		foreach ($data as $key => $value) {
			if (property_exists($this, $key)) {
				$this->$key = $value;
			}
		}
		return $this;
	}

	public function save()
	{
		$data = array();
		foreach ($this->columns as $column) {
			$data[$column] = $this->$column;
		}
		if ($this->db->insert($this->table_name, $data)) {
			$this->id = $this->db->insert_id();
			return $this;
		}
		return false;
	}

	public function get_customer_id()
	{
		return $this->id;
	}
}
