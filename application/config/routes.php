<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['default_controller'] = 'home/view';
$route['update_overlay'] = 'home/UpdateOverlay';
$route['overlay'] = 'home/getOverlayStats';
$route['(:any)'] = 'home/view/$1';