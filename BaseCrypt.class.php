<?php

/**
 * BaseCrypt Class [ BaseCrypt.class.php ]
 *
 * @author      Eric Potvin
 * @package 	PHPClasses
 * @subpackage  Encryption
 * @link        https://github.com/ericpotvin/phpclasses
 */

/**
 * BaseCrypt class
 * 
 * BaseCrypt module class.
 * 
 * @package     PHPClasses
 * @subpackage  Encryption
 */
class BaseCrypt {
 
	/**
	 * Prime numbers
	 *
	 * @var Array
	 */
	private static $primes = array(
		1,
		41,
		2377,
		147299,
		9132313,
		566201239,
		35104476161,
		2176477521929
	);
 
	/**
	 * Ascii chars
	 * 48 -> 57 (Numbers from 0 to 9)
	 * 65 -> 90 (Letters from A to Z)
	 * 97 -> 122 (Letters from a to z)
	 *
	 * @var Array
	 */
	private static $chars = array(
		0=>48,1=>49,2=>50,3=>51,4=>52,5=>53,6=>54,7=>55,8=>56,9=>57,10=>65,
		11=>66,12=>67,13=>68,14=>69,15=>70,16=>71,17=>72,18=>73,19=>74,20=>75,
		21=>76,22=>77,23=>78,24=>79,25=>80,26=>81,27=>82,28=>83,29=>84,30=>85,
		31=>86,32=>87,33=>88,34=>89,35=>90,36=>97,37=>98,38=>99,39=>100,40=>101,
		41=>102,42=>103,43=>104,44=>105,45=>106,46=>107,47=>108,48=>109,49=>110,
		50=>111,51=>112,52=>113,53=>114,54=>115,55=>116,56=>117,57=>118,58=>119,
		59=>120,60=>121,61=>122
	);
 
	/**
	 * base62()
	 * Convert the number to base 62
	 *
	 * @param	Integer	$int	A number
	 * @return	String
	 */
	private static function base62($int) {
		$key = '';
		while($int > 0) {
			$key .= chr(self::$chars[($int - (floor($int / 62) * 62))]);
			$int = floor($int/62);
		}
		return strrev($key);
	}
 
	/**
	 * getHash()
	 * Get the hash
	 *
	 * @param	Integer	$num	A number
	 * @param	Integer	$len	Maximum lenght of the hash
	 * @return	String
	 */
	public static function getHash($num, $len = 5) {
		$len = $len > 7 ? 7 : ($len == 0) ? 1 : abs($len);
		$ceil = pow(62, $len);
		$prime = self::$primes[$len];
		$hash = self::base62(($num * $prime) - floor($num * $prime / $ceil) * $ceil);
		return str_pad($hash, $len, "0", STR_PAD_LEFT);
	}
 
}
