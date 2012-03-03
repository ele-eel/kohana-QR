<?php defined('SYSPATH') or die('No direct script access.');
/**
 * sample controller
 * encode $_GET string to a QR image
 */
class Controller_QrUrl extends Controller {

	public function action_encode()
	{
		try 
		{
			//Set config
			$config = array(
				'version' => 6,
				'error_correct' => 'H',
				'size' => 2,
				'quietzone' => 4,
			);
			$this->response->headers('content-type','image/png');
			$this->response->body(QR::factory($config)->render($_GET['url'], 'png'));
		}
		catch(ErrorException $e)
		{
			echo '';
		}
	}
}


