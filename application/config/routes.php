<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Halaman detail
$route['detail/(:any)'] = 'home/detail/$1';

// Cetak report
$route['cetak/(:any)'] = 'report/cetak/$1';

// Halaman per page
$route['page/(:any)'] = 'home/index/$1';


$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
