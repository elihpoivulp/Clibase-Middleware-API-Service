<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Redirect extends CI_Controller {
    public function index () {
        redirect('service/qpay/topup');
    }
}