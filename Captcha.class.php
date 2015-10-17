<?php

/**
 * Captcha Class [ Captcha.class.php ]
 *
 * @author      Eric Potvin
 * @package 	PHPClasses
 * @subpackage  Captcha
 * @link        https://github.com/ericpotvin/phpclasses
 */

/**
 * Captcha class
 * 
 * Captcha basic module class.
 * 
 * @package     PHPClasses
 * @subpackage  Captcha
 */
class Captcha {

	/**
	 * Const for the TTF to use
	 */
	const TTF = '/home/eric/Git/PHPClasses/ttf/monofont.ttf';//'/lib/font/monofont.ttf';

	/**
	 * generateCode()
	 * Generate the captcha string
	 *
	 * @param 	Integer	$len	Length of the string.
	 * @return 	String
	 */
	private static function generateCode($len) {
		$possible = '23456789bcdfghjkmnpqrstvwxyz';
		$code = '';
		$i = 0;
		$len = abs((int)$len);
		while ($i < $len) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}

	/**
	 * getImage()
	 * Get the image
	 *
	 * @param 	Integer	$len	Length of the string.
	 * @param 	Integer	$width	Width of the image.
	 * @param 	Integer	$height	height of the image.
	 */
	public static function getImage($len = 6, $width = 120, $height = 40) {

		if (!extension_loaded('gd')) {
			die('GD is not installed');
		}

		if(!is_readable(self::TTF)) {
			die('Unable to read font file');
		}

		$code = self::generateCode($len);
		$fontSize = $height * 0.75;
		$image = imagecreate($width, $height);
		if(!$image) {
			return FALSE;
		}
		$background_color = imagecolorallocate($image, 255, 255, 255);
		$text_color = imagecolorallocate($image, 41,54,67);
		$noiseColor = imagecolorallocate($image, 150, 150, 150);
		for($i = 0; $i < ($width*$height)/3; $i++) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noiseColor);
		}
		for($i = 0; $i < ($width*$height) / 150; $i++) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noiseColor);
		}
		$textbox = imagettfbbox($fontSize, 0, self::TTF, $code);
		if(!$textbox) {
			return FALSE;
		}
		$x = ($width - $textbox[4]) / 2;
		$y = ($height - $textbox[5]) / 2;
		imagettftext($image, $fontSize, 0, $x, $y, $text_color, self::TTF, $code);
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
		$_SESSION['security_code'] = $code;
	}

}
