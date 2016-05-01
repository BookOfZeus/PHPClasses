<?php
/**
 * Crypt Class [ Crypt.class.php ]
 *
 * @package    PHPClasses
 * @subpackage Crypt
 * @author     Eric Potvin
 * @link       https://github.com/ericpotvin/phpclasses
 */

/**
 * Crypt class
 * 
 * Crypt module class.
 * 
 * @package     PHPClasses
 * @subpackage  Crypt
 */
class Crypt {
	
	/**
	 * Const for exception message
	 */
	const ERROR_NOT_SUPPORTED = 'mcrypt not supported';

	/**
	 * Cipher to use
	 *
	 * @var String
	 */
	private $cipher = MCRYPT_RIJNDAEL_256;
	/**
	 * Mode to use
	 *
	 * @var String
	 */
	private $mode = MCRYPT_MODE_ECB;
	/**
	 * Private Key
	 *
	 * @var String
	 */
	private $privateKey = 'mYs3Cr3tK3Y';
	/**
	 * IV
	 *
	 * @var String
	 */
	private $iv;
	
	/**
	 * Core Constructor.
	 *
	 * @param  String	$cipher	Cipher to use
	 * @param  String	$mode	Mode to use
	 */
	public function __construct($cipher = MCRYPT_RIJNDAEL_256, $mode = MCRYPT_MODE_ECB)
	{
		$this->cipher = $cipher;
		$this->mode = $mode;

		try {
			$this->iv = mcrypt_create_iv(
				mcrypt_get_iv_size($this->cipher, $this->mode),
				MCRYPT_DEV_RANDOM
			);
		}
		catch (Exception $e) {
			throw new Exception('mcrypt not supported');
		}
	}

	/**
	 * encrypt()
	 * Encrypt text
	 *
	 * @param 	string	$text	Text to encrypt.
	 * @return 	string
	 */
	public function encrypt($text)
	{
		$passcrypt = mcrypt_encrypt(
			$this->cipher,
			$this->privateKey,
			$text,
			$this->mode,
			$this->iv
		);
		return base64_encode($passcrypt);
	}

	/**
	 * decrypt()
	 * Decrypt text
	 *
	 * @param 	string	$text	Text to decrypt.
	 * @return 	string
	 */
	public function decrypt($text)
	{
		$decoded = base64_decode($text);
		$decrypted = mcrypt_decrypt(
			$this->cipher,
			$this->privateKey,
			$decoded,
			$this->mode,
			$this->iv
		);
		return rtrim($decrypted, "\0");
	}
}
