<?php

require('functions.inc.php');

require('../Crypt.class.php');

class CryptTest extends Crypt {

	function __construct($cipher, $mode) {
		parent::__construct($cipher, $mode);
	}
}

$CrypTest1 = new CryptTest();
$text1 = 'Hello World';
$enc1 = $CrypTest1->encrypt($text1);
$dec1 = $CrypTest1->decrypt($enc1);
showTest('Test 1', $text1 == $dec1 ? 'PASS' : 'ERROR');

$CrypTest2 = new CryptTest(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
$text2 = 'Hello World';
$enc2 = $CrypTest2->encrypt($text2);
$dec2 = $CrypTest2->decrypt($enc2);
showTest('Test 2', $text2 == $dec2 ? 'PASS' : 'ERROR');

$CrypTest3 = new CryptTest(MCRYPT_CAST_256, MCRYPT_MODE_CBC);
$text3 = 'Hello World';
$enc3 = $CrypTest3->encrypt($text3);
$dec3 = $CrypTest3->decrypt($enc3);
showTest('Test 3', $text3 == $dec3 ? 'PASS' : 'ERROR');

echo "\n";
