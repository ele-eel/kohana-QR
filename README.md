#QR for Kohana 3.x

##How to use

###1. Add submodule
	$ git submodule init
	$ git submodule update

###2. Edit 'QRCODE_DATA_PATH' in vendor/qrcode.php. 
	define('QRCODE_DATA_PATH', MODPATH.'kohana-qr/vendor/qr_code/qrcode_data');

###3. Enable this module at bootstrap.
	'kohana-qr' => MODPATH.'kohana-QR', // QR image module

###4. Show a sample QR image.
	your_site_url/qr?url=sample_text

