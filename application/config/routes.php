<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// *--------------FRONTEND---------------
$route['service/qpay/topup'] = 'QPay/QPay';
// *-------------------------------------

// *--------------CALLBACK---------------
$route['service/qpay/api/order']['post'] = 'QPay/Callback/order';
// *-------------------------------------

$route['default_controller'] = 'Redirect';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
