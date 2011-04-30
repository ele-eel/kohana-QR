<?php defined('SYSPATH') or die('No direct script access.');
/**
 * sample controller
 * encode $_GET string to a QR image
 */
class Controller_QrUrl extends Controller {

	public function action_encode()
	{
		try {
			//Edit the header content type.
			$this->request->headers['Content-Type'] = 'image/png';

			//Set config
			$config = array(
				'version' => 6,
				'error_correct' => 'H',
				'size' => 2,
				'quietzone' => 4,
			);
			echo QR::factory($config)->render($_GET['url'], 'png');
		} catch(ErrorException $e) {
			echo '';
		}
	}
}


