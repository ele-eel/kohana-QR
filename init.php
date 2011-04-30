<?php defined('SYSPATH') or die('No direct script access.');

// Accept rendering QR-image
Route::set('qr', 'qr(/<action>)')
	->defaults(array(
		'controller' => 'qrurl',
		'action' => 'encode'));
