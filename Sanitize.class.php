<?php
/**
 * Sanitize Class [ Sanitize.class.php ]
 *
 * @author      Eric Potvin
 * @package 	PHPClasses
 * @subpackage  Sanitize
 * @link        https://github.com/BookOfZeus/php-classes
 */

/**
 * Sanitize class
 * 
 * Remove any illegal or unwanted characters from the data.
 * 
 * NOTE: Casting variables is recommended over any sanitization, specially
 *       for numeric values.
 * 
 *       Example: $_POST['some_id'] = (int)$_POST['some_id'];
 * 
 * 
 * 
 * 
 * @package     PHPClasses
 * @subpackage  Sanitize
 */
class Sanitize {

	/**
	 * Const for default Sanitization
	 */
	const SANITIZE_DEFAULT	   = 1;

	/**
	 * Const for default Sanitization
	 */
	const SANITIZE_EMAIL	   = 2;

	/**
	 * Const for default Sanitization
	 */
	const SANITIZE_FILE_FOLDER = 3;

	/**
	 * clean()
	 * Clean and sanitize a variable.
	 *
	 * @param	Mixed	$val	The variable
	 * @return	Boolean
	 */
	public static function clean(&$val, $method = Sanitize::SANITIZE_DEFAULT) {
		$regEx = '';

		switch($method) {

			case self::SANITIZE_FILE_FOLDER:
				$regEx = "/[^A-Z0-9._-]/i";
				break;

			case self::SANITIZE_EMAIL:
				//$val = filter_var($val, FILTER_SANITIZE_EMAIL);
				// Clean the "valid" email characeters: 
				//$val = str_replace('!#$%&\'*+-/=?^`{|}~\[]', NULL, $val);
				$regEx = "/[^A-Z0-9@._-]/i";
				break;

			default:
				// Nothing to do!
		}
		if(!empty($regEx)) {
			$val = preg_replace($regEx, NULL, $val);
		}

		$val = trim(htmlentities(strip_tags(trim($val)), ENT_QUOTES, 'UTF-8'));
	}

	/**
	 * cleanAll()
	 * Clean and sanitize all variable from an array.
	 *
	 * @param	Mixed	$item	The item
	 * @return	Boolean
	 */
	public static function cleanAll(array &$arr) {
		foreach($arr as $key => $value) {
			Sanitize::clean($arr[$key]);
		}
	}

}
