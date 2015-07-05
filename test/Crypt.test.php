<?php

require('../Crypt.class.php');
require('functions.inc.php');

/** Tests **/

function test_r256() {
	$valid = 0;

	$crypTest = new Crypt(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	$text = 'Hello World';
	$enc = $crypTest->encrypt($text);
	$dec = $crypTest->decrypt($enc);

	$valid += assertTrue(__FUNCTION__ . ": The encryption should be $enc", $dec == $text);

	return $valid;
}

function test_r128() {
	$valid = 0;

	$crypTest = new Crypt(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
	$text = '128 bits';
	$enc = $crypTest->encrypt($text);
	$dec = $crypTest->decrypt($enc);

	$valid += assertTrue(__FUNCTION__ . ": The encryption should be $enc", $dec == $text);

	return $valid;
}

function test_c256() {
	$valid = 0;

	$crypTest = new Crypt(MCRYPT_CAST_256, MCRYPT_MODE_CBC);
	$text = '128 bits';
	$enc = $crypTest->encrypt($text);
	$dec = $crypTest->decrypt($enc);

	$valid += assertTrue(__FUNCTION__ . ": The encryption should be $enc", $dec == $text);

	return $valid;
}

function getUnitTest() {
	$id = 0;

	$list[$id++] = "test_r256";
	$list[$id++] = "test_r128";
	$list[$id++] = "test_c256";

	return $list;
}
