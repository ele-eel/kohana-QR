<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * QRcode_php library wrapper
 * for Kohana 3.0.x
 *
 * @package    Kohana/Kohana-QR
 * @author     ele_eel
 * @copyright  9km.jp
 * @license    http://kohanaframework.org/license
 */

class QR {

	//a instance of the QRcode_php library
	protected $_instance;
	
	//default setting
	protected static $_config = array(
			'version' => 6,
			'error_correct' => 'H',
			'size' => 3,
			'quietzone' => 5,
			'structureappend' => NULL,
		);
	
	/**
	 * Creates and returns a new model.
	 *
	 * @param array $config
	 * @return QR
	 */
	public static function factory($config = array())
	{
		return new QR(Arr::overwrite(QR::$_config, $config));
	}
	
	/**
	 * Creates new Qrcode_image.
	 *
	 * @param array $config
	 */
	public function __construct($config)
	{
		require_once Kohana::find_file('vendor', 'qrcode_php/qrcode_img');
		
		$this->_instance = new Qrcode_image;
		$this->_instance->set_qrcode_version($config['version']);
		$this->_instance->set_qrcode_error_correct($config['error_correct']);
		$this->_instance->set_module_size($config['size']); 
		$this->_instance->set_quietzone($config['quietzone']);
		if(Arr::get($config, 'structureappend'))
		{
			$this->_instance->set_structureappend($config['structureappend'][0], $config['structureappend'][1], 0);
		}
	}

	/**
	 * Sets connection parameters.
	 *
	 * @param integer $m
	 * @param integer $n
	 */
	public function append($m, $n)
	{
		$this->_instance->set_structureappend($m, $n, 0);
		return $this;
	}
	
	/**
	 * Returns a parity value from the data.
	 *
	 * @param  string $originaldata
	 * @return integer
	 */
	public function parity($originaldata)
	{
		return $this->_instance->cal_structureappend_parity($originaldata);
	}

	/**
	 * Returns a QR image binary.
	 *
	 * @param string $data	text to encode
	 * @param string $type image type (jpeg or png)
	 * @return binary
	 */
	public function render($data, $type = 'png')
	{
		if($this->_instance->qrcode_structureappend_n AND $this->_instance->qrcode_structureappend_m)
		{
			$this->_instance->qrcode_structureappend_parity = $this->_instance->cal_structureappend_parity($data);
		}
		return $this->_instance->qrcode_image_out($data, $type);
	}

}