<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['default_controller'] = 'home/view';
$route['update_overlay'] = 'home/UpdateOverlay';
$route['update_dailyOverlay'] = 'home/UpdateDailyOverlay';
$route['generate'] = 'home/GenerateLink';
$route['overlay/(:any)/(:any)'] = 'home/getOverlayStats/$1/$2';
$route['overlay'] = 'home/getOverlayStats';
$route['dailyOverlay'] = 'home/getDailyStats';
$route['dailyOverlay/(:any)/(:any)'] = 'home/getDailyStats/$1/$2';
$route['(:any)'] = 'home/view/$1';